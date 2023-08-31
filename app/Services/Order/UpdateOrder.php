<?php

namespace App\Services\Order;

use Exception;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Services\BaseService;
use InvalidArgumentException;
use App\Services\BaseServiceInterface;

class UpdateOrder extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to cancel process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_order = Pesanan::with('produkPesanan')->where('uuid', $dto['pesanan_uuid'])->first();

        if (!empty($find_order)) {

            // Pesanan Model / Order Mapping Process
            $order_product_map = $find_order->produkPesanan->mapWithKeys(function ($item, $key) {
                return [
                    $key => [
                        'uuid' => $item->uuid,
                        'pesanan_id' => $item->pesanan_id,
                        'produk_id' => $item->produk_id,
                        'jumlah' => $item->jumlah
                    ],
                ];
            });

            // Dto Mapping Process
            $dto_mapping_process = collect($dto['produk_id'])->mapWithKeys(function ($product_id, $index) use ($dto, $find_order, $order_product_map) {
                return [
                    $index => [
                        'uuid' => $order_product_map[$index]['uuid'] ?? null,
                        'pesanan_id' => $find_order->id,
                        'produk_id' => $product_id,
                        'jumlah' => $dto['jumlah'][$index],
                    ]
                ];
            });

            // Sum Total Amount Of Ordered Product With Group by produk_id
            $get_total_amount_of_each_product = $dto_mapping_process->groupBy('produk_id')->mapWithKeys(function ($item, $key) {
                return [
                    $key => collect($item)->sum('jumlah'),
                ];
            });

            // Checking Process, For Make Sure there is no greater than Stock of Product
            $get_total_amount_of_each_product->each(function ($product_amount, $product_id) {
                $find_related_product = Produk::with('stokProduk')->where('id', $product_id)->first();

                if ($product_amount > $find_related_product->stokProduk->stok) {
                    throw new Exception('Total Produk Yang Dipesan Tidak Boleh Lebih dari Stok Produk yang Tersedia');
                }
            });

            if (count($dto['produk_id']) > $order_product_map->count()) {

                // Create Or Update, If Related Data Doesn't Have Uuid
                $dto_mapping_process->each(function ($value) use ($find_order) {
                    if (is_null($value['uuid'])) {
                        $find_order->produkPesanan()->create([
                            'pesanan_id' => $value['pesanan_id'],
                            'produk_id' => $value['produk_id'],
                            'jumlah' => $value['jumlah'],
                        ]);
                    } else {
                        $find_order->produkPesanan()->where('uuid', $value['uuid'])->update([
                            'pesanan_id' => $value['pesanan_id'],
                            'produk_id' => $value['produk_id'],
                            'jumlah' => $value['jumlah'],
                        ]);
                    }
                });

            } elseif (count($dto['produk_id']) < $order_product_map->count()) {
                $get_deleted_data = $order_product_map->splice($dto_mapping_process->count());
                $get_remaining_data = collect($dto_mapping_process->all());

                // Delete Unused Data
                $get_deleted_data->each(function ($value) use ($find_order) {
                    $find_order->produkPesanan()->where('uuid', $value['uuid'])->delete();
                });

                // Update Remaining Data
                $get_remaining_data->each(function ($value) use ($find_order) {
                    $find_order->produkPesanan()->where('uuid', $value['uuid'])->update([
                        'pesanan_id' => $value['pesanan_id'],
                        'produk_id' => $value['produk_id'],
                        'jumlah' => $value['jumlah'],
                    ]);
                });

            } else {

                $dto_mapping_process->each(function ($value) use ($find_order) {
                    $find_order->produkPesanan()->where('uuid', $value['uuid'])->update([
                        'pesanan_id' => $value['pesanan_id'],
                        'produk_id' => $value['produk_id'],
                        'jumlah' => $value['jumlah'],
                    ]);
                });

            }

            // dd(count($dto['produk_id']), $order_product_map->count());
            // dd($dto, $order_product_map);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Pesanan Berhasil Di Ubah';
            $this->results['data'] = [
                'order' => $find_order,
            ];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
