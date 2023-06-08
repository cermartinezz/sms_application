<?php

namespace App\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class BaseController
{
    /**
     * @param Response $response
     * @param $data
     * @return Response
     */
    public function responseSuccess(Response $response, $data): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_OK);
    }

    /**
     * @param Response $response
     * @param $data
     * @return Response
     */
    public function responseCreated(Response $response, $data): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param Response $response
     * @param $data
     * @return Response
     */
    public function responseBadRequest(Response $response, $data): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_BAD_REQUEST);
    }

    /**
     * @param Response $response
     * @param $data
     * @return Response
     */
    public function responseErrorValidation(Response $response, $data): Response
    {
        return $this->json($response, $data, StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param Response $response
     * @param $data
     * @param $statusCode
     * @return Response
     */
    public function json(Response $response, $data, $statusCode = StatusCodeInterface::STATUS_OK): Response
    {
        $data = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $response = $response->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode);

        $response->getBody()->write($data);

        return $response;
    }
}
