<?php

namespace App\Http\Response;

use App\Constants\StatusCode;
use App\Http\Response\JsonResponse as JsonResponses;

class JsonResponse
{
    /**
     * initialized response formation
     *
     * @param int $response_code
     * @param bool $success
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    private static function response(int $response_code = 200, bool $success = false, string $message = "", array $data = []){
        return response()->json(array(
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ), $response_code);
    }

    /**
     * set response when its success
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function success(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::SUCCESS, true, $message, $data);
    }

    /**
     * set response when its bad request
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function badRequest(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::BAD_REQUEST, true, $message, $data);
    }

    /**
     * set response when its unprocessable entity
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function unprocessableEntity(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::UNPROCESSABLE_ENTITY, true, $message, $data);
    }

    /**
     * set response when its internal server error
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function internalServerError(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::INTERNAL_SERVER_ERR, true, $message, $data);
    }

    /**
     * set response when its not found
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function notFound(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::NOT_FOUND, true, $message, $data);
    }

    /**
     * set response when its unauthorized
     *
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function unauthorized(string $message = "", array $data): JsonResponses
    {
        return self::response(StatusCode::UNAUTHORIZED, true, $message, $data);
    }
}
