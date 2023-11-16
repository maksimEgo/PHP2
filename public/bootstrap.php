<?php

use DI\ContainerBuilder;
use src\Logger\LoggerException;
use src\Repository\ControllerRepository;
use src\Route\AdminRoute;
use src\Route\PublicRoute;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    LoggerException::class => function () {
        return new LoggerException();
    },
    ControllerRepository::class => function () {
        return new ControllerRepository();
    },
    PublicRoute::class => function ($container) use ($page) {
        return new PublicRoute(
            $container->get(LoggerException::class),
            $container->get(ControllerRepository::class),
            $page
        );
    },
    AdminRoute::class => function ($container) use ($page) {
        return new AdminRoute(
            $container->get(LoggerException::class),
            $container->get(ControllerRepository::class),
            $page
        );
    },
]);


$container = $containerBuilder->build();