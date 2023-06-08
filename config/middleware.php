<?php

use App\Middleware\JsonBodyParserMiddleware;
use App\Models\User;
use Slim\App;

return function (App $app){

    $app->add(new JsonBodyParserMiddleware());


    $displayErrorDetails = env('ENV') == 'dev';

    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, true, true);

    // Error Handler
    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->forceContentType('application/json');
};
