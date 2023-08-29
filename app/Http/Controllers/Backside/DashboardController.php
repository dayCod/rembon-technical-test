<?php

namespace App\Http\Controllers\Backside;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * dashboard view page.
     *
     * @return View
     */
    public function dashboardPageView(): View
    {
        return view('page.dashboard');
    }
}
