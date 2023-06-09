<?php

namespace App\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class BaseController
{
    /**
     * @param Response $response
     * @param $data
     * @param array $headers
     * @return Response
     */
    public function responseSuccess($response, $data, $headers = []): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_OK, $headers);
    }

    /**
     * @param Response $response
     * @param $data
     * @param array $headers
     * @return Response
     */
    public function responseCreated(Response $response, $data, $headers = []): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_CREATED, $headers);
    }

    /**
     * @param Response $response
     * @param $data
     * @param array $headers
     * @return Response
     */
    public function responseBadRequest(Response $response, $data, $headers = []): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_BAD_REQUEST, $headers);
    }

    /**
     * @param Response $response
     * @param $data
     * @param array $headers
     * @return Response
     */
    public function responseErrorValidation(Response $response, $data, $headers = []): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $headers);
    }

    /**
     * @param Response $response
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     * @return Response
     */
    public function json(Response $response, $data = null, int $statusCode = StatusCodeInterface::STATUS_OK, $headers = []): Response
    {
        $data = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $headers = array_merge($headers, ['Content-Type' => 'application/json']);

        foreach ($headers as $key => $value){
            $response = $response->withHeader($key,$value);
        }

        $response->withStatus($statusCode);

        $response->getBody()->write($data);

        return $response;
    }
}
