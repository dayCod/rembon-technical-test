<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Response\JsonApiResponse;
use App\Http\Requests\User\CreateUserRequest;

class RegisterController extends Controller
{
    /**
     * store user data to user table.
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function registUserAndStoreToUserTable(CreateUserRequest $request)
    {
        $process = app('CreateUser')->execute($request->validated());

        return JsonApiResponse::success($process['message'], $process['data']);
    }
}
