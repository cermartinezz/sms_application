<?php

namespace App\Controllers;

use App\Controllers\BaseController as Controller;
use App\Models\Message;
use App\Request\MessageRequest;
use Carbon\Carbon;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Cookies;

class MessageController extends Controller
{

    /**
     * @param \Slim\Psr7\Request $request
     * @param Response $response
     * @return Response
     */
    public function store(Request $request, Response $response): Response
    {
        $cookies = $request->getCookieParams();
        $session = isset($cookies['session']) ? json_decode($cookies['session']) : null;

        $data = $request->getParsedBody();

        [
            'to'        => $to,
            'message'   => $message,
        ] = $data;

        $validator = (new MessageRequest())->validate($data);

        if($validator->isNotValid()) {
            return $this->responseErrorValidation($response,$validator->errors());
        }

        $validated_data = $validator->validated();

        $data_to_save = array_map(function ($number) use ($validated_data,$session) {
            return [
                'to' => $number,
                'message' => $validated_data['message'],
                'from' => $session->id
            ];
        },$validated_data['numbers']);

        $saved = Message::query()->insert($data_to_save);

        if($saved){
            $messages = Message::query()->where('from',$session->id)->get();
            $data = [
                'id' => $session->id,
                'messages' => json_encode($messages)
            ];
            $cookie = (new Cookies())->set('session', [
                'value'   => json_encode($data),
                'domain'  => $request->getUri()->getHost(),
                'path'    => '/',
                'expires' => time() + 3600,
            ]);

            return $this->responseSuccess($response,[
                'result' => [
                    'message' => 'messages sent',
                    'data' => $messages
                ]
            ], ['Set-Cookie' => $cookie->toHeaders()]);
        }


        return $this->responseBadRequest($response, [
            'result' => [
                'message' => 'Something when wrong',
            ]
        ]);
    }
}
