<?php

declare(strict_types=1);

use App\Controllers\Stock\StockController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api' , function (RouteCollectorProxy $group){
        $group->get('/sms', [StockController::class, 'show']);
        $group->post('/sms', [StockController::class, 'index']);
    });
};
