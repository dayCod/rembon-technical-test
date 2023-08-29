<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * display order index view page.
     *
     * @return View
     */
    public function orderIndexView(): View
    {
        return view('page.pesanan.index');
    }
}
