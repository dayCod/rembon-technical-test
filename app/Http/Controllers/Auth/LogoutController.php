<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * logout process for destroy the authenticated users session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticatedUserLogout(Request $request): RedirectResponse
    {
        $process = app('DefaultLogout')->execute([
            'user_id' => auth()->id(),
        ]);

        if (!$process['success']) return redirect()->back()->with('fail', $process['message']);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login-view')->with('success', $process['message']);
    }
}
