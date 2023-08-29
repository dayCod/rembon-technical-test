<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateAndUpdateProductRequest;
use App\Models\Produk;
use Illuminate\Contracts\View\View;
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
        $kumpulan_produk = Produk::orderBy('id', 'desc')->get();

        return view('page.produk.index', compact('kumpulan_produk'));
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
     * show list of trashed product.
     *
     * @param string $uuid
     * @return View
     */
    public function trashedProductView(string $uuid): View
    {
        return view('page.produk.trashed-product');
    }
}
