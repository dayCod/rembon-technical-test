<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
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
        return view('page.produk.index');
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
     * show specified product view.
     *
     * @param string $uuid
     * @return View
     */
    public function editProductFormView(string $uuid): View
    {
        return view('page.produk.edit');
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
