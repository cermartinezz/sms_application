<?php

namespace App\Controllers;

use App\Controllers\BaseController as Controller;
use App\Request\MessageRequest;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MessageController extends Controller
{

    /**
     * @param \Slim\Psr7\Request $request
     * @param Response $response
     * @return Response
     */
    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        [
            'to'         => $to,
            'message'      => $message,
        ] = $data;

        $validator = (new MessageRequest())->validate($data);

        if($validator->isNotValid()) {
            return $this->responseErrorValidation($response,$validator->errors());
        }
        
        return $this->responseSuccess($response, $data);
    }
}
