<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Response\JsonApiResponse;

class LoginController extends Controller
{
    /**
     * authenticate the users credential.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function authenticateCredential(LoginRequest $request)
    {
        $process = app('LoginWithOauthToken')->execute($request->validated());

        if (!$process['success']) return JsonApiResponse::unprocessableEntity($process['message'], $process['data']);

        return JsonApiResponse::success($process['message'], $process['data']);
    }
}
