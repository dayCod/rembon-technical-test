<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

    /**
     * authenticate the users credential.
     *
     * @return View
     */
    public function authenticateCredential(LoginRequest $request): RedirectResponse
    {
        $process = app('DefaultLogin')->execute($request->validated());

        if (!$process['success']) return back()->with('fail', $process['message']);

        $request->session()->regenerate();

        return redirect()->route('backside.dashboard')->with('success', $process['message']);
    }
}
