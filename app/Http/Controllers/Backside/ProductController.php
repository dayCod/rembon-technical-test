<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateAndUpdateProductRequest;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * display product index view.
     *
     * @return View
     */
    public function productIndexView(): View
    {
        $products = Produk::orderBy('id', 'desc')->get();

        return view('page.produk.index', compact('products'));
    }

    /**
     * display create product form.
     *
     * @return View
     */
    public function createProductFormView(): View
    {
        return view('page.produk.create');
    }

    /**
     * store product data to produk table.
     *
     * @param CreateAndUpdateProductRequest $request
     * @return RedirectResponse
     */
    public function storeProductToProdukTable(CreateAndUpdateProductRequest $request): RedirectResponse
    {
        $process = app('CreateProduct')->execute($request->validated());

        return redirect()->route('backside.product.index-view')->with('success', $process['message']);
    }

    /**
     * show specified product view.
     *
     * @param string $uuid
     * @return View
     */
    public function editProductFormView(string $uuid): View
    {
        $find_product = Produk::with('stokProduk')->where('uuid', $uuid)->first();

        return view('page.produk.edit', compact('find_product'));
    }

    /**
     * update specified product record.
     *
     * @param CreateAndUpdateProductRequest $request
     * @param string $uuid
     * @return RedirectResponse
     */
    public function updateProductAction(CreateAndUpdateProductRequest $request, string $uuid): RedirectResponse
    {
        $data = $request->validated();
        $data['produk_uuid'] = $uuid;
        $process = app('UpdateProduct')->execute($data);

        return redirect()->route('backside.product.index-view')->with('success', $process['message']);
    }

    /**
     * soft delete specified product.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function softDeleteProduct(string $uuid): JsonResponse
    {
        $process = app('SoftDeleteProduct')->execute([
            'produk_uuid' => $uuid,
        ]);

        return response()->json(['success' => $process['message']]);
    }

    /**
     * show list of trashed product.
     *
     * @return View
     */
    public function trashedProductView(): View
    {
        $trashed_products_data = Produk::onlyTrashed()->get();

        return view('page.produk.trashed-product', compact('trashed_products_data'));
    }

    /**
     * restore trashed product data.
     *
     * @param string $uuid
     * @return RedirectResponse
     */
    public function restoreTrashedProduct(string $uuid): RedirectResponse
    {
        $process = app('RestoreProduct')->execute([
            'produk_uuid' => $uuid,
        ]);

        return redirect()->route('backside.product.index-view')->with('success', $process['message']);
    }

    /**
     * delete specified product permanently.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function deleteProductPermanently(string $uuid): JsonResponse
    {
        $process = app('DeleteProductPermanently')->execute([
            'produk_uuid' => $uuid,
        ]);

        return response()->json(['success' => $process['message']]);
    }
}
