<?php

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use src\Repository\ControllerRepository;
use src\Route\AdminRoute;
use src\Route\PublicRoute;
use SebastianBergmann\Timer\Timer;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Logger::class => function () {
        $logger = new Logger('my_logger');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/errorLog.txt', Level::Warning));
        return $logger;
    },
    Timer::class => function () {
        return new Timer();
    },
    ControllerRepository::class => function () {
        return new ControllerRepository();
    },
    PublicRoute::class => function ($container) use ($page) {
        return new PublicRoute(
            $container->get(Logger::class),
            $container->get(ControllerRepository::class),
            $page
        );
    },
    AdminRoute::class => function ($container) use ($page) {
        return new AdminRoute(
            $container->get(Logger::class),
            $container->get(ControllerRepository::class),
            $page
        );
    },
]);

$container = $containerBuilder->build();