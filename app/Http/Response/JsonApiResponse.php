<?php

namespace App\Http\Response;

use App\Constants\StatusCode;

class JsonApiResponse
{
    /**
     * initialized response formation
     *
     * @param int $response_code
     * @param bool $success
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function response(int $response_code = 200, bool $success = false, string|array $message = "", array $data = []){
        return response()->json(array(
            'response_code' => $response_code,
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ), $response_code);
    }

    /**
     * set response when its success
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function success(string|array $message = "", array $data)
    {
        return self::response(StatusCode::SUCCESS, true, $message, $data);
    }

    /**
     * set response when its bad request
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function badRequest(string|array $message = "", array $data)
    {
        return self::response(StatusCode::BAD_REQUEST, false, $message, $data);
    }

    /**
     * set response when its unprocessable entity
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function unprocessableEntity(string|array $message = "", array $data)
    {
        return self::response(StatusCode::UNPROCESSABLE_ENTITY, false, $message, $data);
    }

    /**
     * set response when its internal server error
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function internalServerError(string|array $message = "", array $data)
    {
        return self::response(StatusCode::INTERNAL_SERVER_ERR, false, $message, $data);
    }

    /**
     * set response when its not found
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function notFound(string|array $message = "", array $data)
    {
        return self::response(StatusCode::NOT_FOUND, false, $message, $data);
    }

    /**
     * set response when its unauthorized
     *
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function unauthorized(string|array $message = "", array $data)
    {
        return self::response(StatusCode::UNAUTHORIZED, false, $message, $data);
    }
}
