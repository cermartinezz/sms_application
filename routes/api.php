<?php

declare(strict_types=1);

use App\Controllers\MessageController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api' , function (RouteCollectorProxy $group){
        $group->get('/messages', [MessageController::class, 'index']);
        $group->post('/messages', [MessageController::class, 'store']);
    });
};
