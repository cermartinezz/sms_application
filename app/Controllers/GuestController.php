<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\BaseController as Controller;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Cookies;

class GuestController extends Controller
{
    public function index(Request $request, Response $response): Response
    {
        $cookies = $request->getCookieParams();
        $data = isset($cookies['session']) ? json_decode($cookies['session']) : null;

        if(!$data){
            $uuid = Uuid::uuid4();

            $data = [
                'id' => $uuid->toString(),
                'messages' => []
            ];

            $cookies = (new Cookies())
                ->set('session', [
                    'value'   => json_encode($data),
                    'domain'  => $request->getUri()->getHost(),
                    'path'    => '/',
                    'expires' => time() + 3600,
                ]);

            return $this->responseSuccess($response, $data, [ 'Set-Cookie' => $cookies->toHeaders()]);
        }

        return $this->responseSuccess($response, $data);

    }
}
