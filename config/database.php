<?php

use Illuminate\Container\Container;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\Model;
use Slim\App;

return function (App $app){
    $settings = $app->getContainer()->get('db');
    $conn = Container::getInstance();
    $connFactory = new ConnectionFactory($conn);
    $conn = $connFactory->make($settings);
    $resolver = new ConnectionResolver();
    $resolver->addConnection('mysql', $conn);
    $resolver->setDefaultConnection('mysql');
    Model::setConnectionResolver($resolver);
};
