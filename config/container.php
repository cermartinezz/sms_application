<?php

use DI\ContainerBuilder;
use Illuminate\Database\Capsule\Manager as Capsule;

return function(ContainerBuilder $containerBuilder) {
    // Initialize app with PHP-DI
    $container = $containerBuilder->build();

    $settings = config('settings.db');

    $capsule = new Capsule;
    $capsule->addConnection($settings);
    $capsule->bootEloquent();


    $container->set('db', config('settings.db'));
    $container->set(\App\Adapters\MessageInterface::class, new \App\Adapters\TwilioAdapter());
    $container->set(\Illuminate\Database\DatabaseManager::class, $capsule->getDatabaseManager());

    return $container;
};

