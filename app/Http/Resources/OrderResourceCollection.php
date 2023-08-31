<?php

namespace App\Http\Resources;

class OrderResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public static function collectionData($collection)
    {
        $result = array();

        foreach($collection as $collect) {
            $result[] = [
                'id' => $collect->id,
                'kode_pesanan' => $collect->kode_pesanan,
                'tgl_pesanan' => (string) $collect->tgl_pesanan,
                'nama_lengkap_pembeli' => $collect->user->getFullName(),
                'total_harga' => $collect->getTotalPriceOfProductOrder(),
                'jumlah_produk' => $collect->countTotalOrderedProduct(),
                'status' => $collect->getOrderStatus(),
            ];
        }

        return $result;
    }
}
