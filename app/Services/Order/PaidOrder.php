<?php

namespace App\Services\Order;

use App\Models\Pesanan;
use App\Services\BaseService;
use App\Services\BaseServiceInterface;

class PaidOrder extends BaseService implements BaseServiceInterface
{
    /**
     * update order status to paid process.
     *
     * @param array $dto
     */
    public function process(array $dto)
    {
        $find_order = Pesanan::where('uuid', $dto['pesanan_uuid'])->first();

        if (!empty($find_order)) {
            $find_order->update([
                'tgl_pembayaran_lunas' => now(),
                'tgl_dibatalkan' => null,
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Pesanan Berhasil Di Lunasi';
            $this->results['data'] = $find_order;
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Pesanan Yang Dimaksud Tidak Ditemukan';
            $this->results['data'] = [];
        }
    }
}
