<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

    /**
     * store user data to user table.
     *
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function registUserAndStoreToUserTable(CreateUserRequest $request): RedirectResponse
    {
        $process = app('CreateUser')->execute($request->validated());

        return redirect()->route('auth.login-view')->with('success', 'Registrasi User Berhasil');
    }
}
