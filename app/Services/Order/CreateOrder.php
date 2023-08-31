<?php

namespace App\Services\Order;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\ProdukPesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;
use Exception;

class CreateOrder extends BaseService implements BaseServiceInterface
{
    /**
     * create order process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $dto_mapping_process = collect($dto['produk_id'])->mapWithKeys(function ($product_id, $index) use ($dto) {
            return [
                $index => [
                    'produk_id' => $product_id,
                    'jumlah' => $dto['jumlah'][$index],
                ]
            ];
        });

        $get_total_amount_of_each_product = $dto_mapping_process->groupBy('produk_id')->mapWithKeys(function ($item, $key) {
            return [
                $key => collect($item)->sum('jumlah'),
            ];
        });

        $create_order = Pesanan::create([
            'user_id' => $dto['buyer_id'],
        ]);

        $create_product_order = $dto_mapping_process->each(fn($product_order) => $create_order->produkPesanan()->create($product_order) );

        $get_total_amount_of_each_product->each(function ($product_amount, $product_id) {
            $find_related_product = Produk::with('stokProduk')->where('id', $product_id)->first();
            $find_related_ordered_product_amount = ProdukPesanan::where('produk_id', $product_id)->whereNull('tgl_dihapus')->whereHas('pesanan', function ($query) {
                return $query->whereNull('tgl_dibatalkan');
            })->pluck('jumlah')->sum();

            if ($product_amount > ($find_related_product->stokProduk->stok - $find_related_ordered_product_amount)) {
                throw new Exception('Total Produk Yang Dipesan Tidak Boleh Lebih dari Stok Produk yang Tersedia');
            }
        });

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'Pesanan Berhasil Dibuat';
        $this->results['data'] = [
            'pesanan' => $create_order,
            'produk_pesanan' => $create_product_order,
        ];
    }
}
