<?php

namespace App\Constants;

class StatusCode
{
    /**
     * indicates that the request has succeeded.
     *
     * @return int
     */
    CONST SUCCESS = 200;

    /**
     * indicates that the action could not be processed properly due to invalid data provided.
     *
     * @return int
     */
    CONST UNPROCESSABLE_ENTITY = 422;

    /**
     * indicates that the server cannot or will not proccess the request
     * due to something that is perceived to be client error.
     *
     * @return int
     */
    CONST BAD_REQUEST = 400;

    /**
     * indicates that the server encountered an unexpected condition
     * that prevented it from fulfilling the request.
     *
     * @return int
     */
    CONST INTERNAL_SERVER_ERR = 500;

    /**
     * indicates that the server cannot find the requested resource.
     *
     * @return int
     */
    CONST NOT_FOUND = 404;

    /**
     * indicates that no credentials or invalid credentials.
     */
    CONST UNAUTHORIZED = 401;
}
