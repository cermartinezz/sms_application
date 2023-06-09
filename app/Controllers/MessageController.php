<?php

namespace App\Controllers;

use App\Controllers\BaseController as Controller;
use App\Models\Message;
use App\Request\MessageRequest;
use App\Services\GuestMessageServices;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MessageController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $cookies = $request->getCookieParams();
        $session = isset($cookies['session']) ? json_decode($cookies['session']) : null;

        $messages = Message::query()->with('response')->where('from', $session->id)->get();

        return $this->responseSuccess($response, [
            'result' => [
                'message' => 'messages',
                'data' => $messages->toArray()
            ]
        ]);
    }
    /**
     * @param \Slim\Psr7\Request $request
     * @param Response $response
     * @param GuestMessageServices $messageServices
     * @return Response
     * @throws \Throwable
     */
    public function store(Request $request, Response $response, GuestMessageServices $messageServices): Response
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

        $messages = $messageServices->createMessages($validated_data,$session);

        $data = array_map(function (Message $message) {
            return $message->load('response');
        }, $messages);


        return $this->responseSuccess($response, [
            'result' => [
                'message' => $data,
            ]
        ]);
    }
}
