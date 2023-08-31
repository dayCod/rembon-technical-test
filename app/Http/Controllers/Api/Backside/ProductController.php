<?php

namespace App\Http\Controllers\Api\Backside;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateAndUpdateProductRequest;
use App\Http\Response\JsonApiResponse;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * display product index.
     *
     * @return JsonResponse
     */
    public function showAllProduct()
    {
        $products = Produk::orderBy('id', 'desc')->get();

        if ($products->count() < 1) return JsonApiResponse::notFound('Data Produk Tidak Ditemukan', []);

        return JsonApiResponse::success('Data Produk Berhasil Diambil', $products->toArray());
    }

    /**
     * display not empty product index.
     *
     * @return JsonResponse
     */
    public function showAllNotEmptyProduct()
    {
        $products = Produk::with('stokProduk')->orderBy('id', 'desc')->get()->filter(function ($value) {
            return $value->stokProduk->stok > 0;
        })->values();

        if ($products->count() < 1) return JsonApiResponse::notFound('Data Produk Tidak Ditemukan', []);

        return JsonApiResponse::success('Data Produk Berhasil Diambil', $products->toArray());
    }

    /**
     * store product data to produk table.
     *
     * @param CreateAndUpdateProductRequest $request
     * @return JsonResponse
     */
    public function storeProductToProdukTable(CreateAndUpdateProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $process = app('CreateProduct')->execute($request->validated());

            DB::commit();

            return JsonApiResponse::success($process['message'], $process['data']);

        } catch (\Exception $ex) {

            DB::rollBack();

            return JsonApiResponse::response($ex->getCode(), false, $ex->getMessage(), ['file' => $ex->getFile()]);
        }
    }

    /**
     * show specified product view.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function findSpecificProduct(string $uuid)
    {
        $find_product = Produk::with('stokProduk')->where('uuid', $uuid)->first();

        if (empty($find_product)) JsonApiResponse::notFound('Produk Tidak Ditemukan', []);

        return JsonApiResponse::success('Produk Berhasil Ditemukan', $find_product->toArray());
    }

    /**
     * update specified product record.
     *
     * @param CreateAndUpdateProductRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function updateProductAction(CreateAndUpdateProductRequest $request, string $uuid)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['produk_uuid'] = $uuid;
            $process = app('UpdateProduct')->execute($data);

            if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

            DB::commit();

            return JsonApiResponse::success($process['message'], $process['data']);
        } catch (\Exception $ex) {

            DB::rollBack();

            return JsonApiResponse::response($ex->getCode(), false, $ex->getMessage(), ['file' => $ex->getFile()]);

        }
    }

    /**
     * soft delete specified product.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function softDeleteProduct(string $uuid)
    {
        $process = app('SoftDeleteProduct')->execute([
            'produk_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], ['uuid' => $uuid]);
    }

    /**
     * show list of trashed product.
     *
     * @return JsonResponse
     */
    public function showAllTrashedProduct()
    {
        $trashed_products_data = Produk::onlyTrashed()->get();

        if ($trashed_products_data->count() < 1) return JsonApiResponse::notFound('Data Produk Tidak Ditemukan', []);

        return JsonApiResponse::success('Berhasil Ambil Data Produk Yang Telah Dihapus', $trashed_products_data->toArray());
    }

    /**
     * restore trashed product data.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function restoreTrashedProduct(string $uuid)
    {
        $process = app('RestoreProduct')->execute([
            'produk_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], ['uuid' => $uuid]);
    }

    /**
     * delete specified product permanently.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function deleteProductPermanently(string $uuid)
    {
        $process = app('DeleteProductPermanently')->execute([
            'produk_uuid' => $uuid,
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], $process['data']);
    }
}
