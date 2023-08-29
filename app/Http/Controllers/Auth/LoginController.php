<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * display login form view.
     *
     * @return View
     */
    public function loginFormView(): View
    {
        return view('page.auth.login');
    }
}
