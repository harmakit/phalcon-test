<?php

/**
 * @var $router \Phalcon\Mvc\RouterInterface
 * @var $di Phalcon\DiInterface
 **/
$router = $di->getRouter();

$router->add(
    '/people/{id:[0-9]+}',
    [
        'controller' => 'people',
        'action' => 'getById'
    ]
);

$router->add(
    '/people/region/{id:[0-9]+}',
    [
        'controller' => 'people',
        'action' => 'getByRegionId'
    ]
);

$router->add(
    '/region/children/{id:[0-9]+}',
    [
        'controller' => 'region',
        'action' => 'getChildrenRegionId'
    ]
);


$router->handle();
