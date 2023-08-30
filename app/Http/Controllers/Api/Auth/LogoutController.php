<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Response\JsonApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * logout process for destroy the authenticated users session.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticatedUserLogout()
    {
        $process = app('LogoutFromOauthToken')->execute([
            'user_id' => auth()->id(),
        ]);

        if (!$process['success']) return JsonApiResponse::notFound($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], $process['data']);
    }
}
