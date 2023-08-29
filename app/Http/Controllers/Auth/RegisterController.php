<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * display register form view.
     *
     * @return View
     */
    public function registerFormView(): View
    {
        return view('page.auth.register');
    }
}
