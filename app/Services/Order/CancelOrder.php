<?php

namespace App\Services\Order;

use App\Models\Pesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class CancelOrder extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to cancel process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_order = Pesanan::where('uuid', $dto['pesanan_uuid'])->first();

        if (!empty($find_order)) {
            $find_order->update([
                'tgl_pembayaran_lunas' => null,
                'tgl_dibatalkan' => now(),
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Pesanan Berhasil Di Batalkan';
            $this->results['data'] = $find_order;
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
