<?php

use DI\ContainerBuilder;

return function(ContainerBuilder $containerBuilder) {
    // Initialize app with PHP-DI
    $container = $containerBuilder->build();

    $container->set('db', config('settings.db'));

    return $container;
};

