<?php

namespace App\Response;

use Slim\Psr7\Response as BaseResponse;
use Slim\Psr7\Cookies;

class CustomResponse extends BaseResponse {
    public function withCookies(Cookies $cookies) : self {
        return $this->withHeader('Set-Cookie', $cookies->toHeaders());
    }
}
