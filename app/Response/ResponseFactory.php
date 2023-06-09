<?php

namespace App\Response;

use Psr\Http\Message\ResponseFactoryInterface;

class ResponseFactory implements ResponseFactoryInterface {
    public function createResponse(int $code = 200, string $reasonPhrase = '') : CustomResponse
    {
        return (new CustomResponse())->withStatus($code, $reasonPhrase);
    }
}
