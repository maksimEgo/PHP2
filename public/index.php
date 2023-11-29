<?php

use Monolog\Logger;
use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DataBaseException;
use src\Exceptions\NotFoundException;
use src\Route\BaseRoute;
use SebastianBergmann\Timer\Timer;

include __DIR__ . '/header.php';

$page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

$timer = $container->get(Timer::class);
$timer->start();

$router = $container->get(BaseRoute::class);

try {
    $router->Routing();
} catch (DataBaseException|NotFoundException $exception) {
    $logger = $container->get(Logger::class);
    $logger->error("Error: " . $exception->getMessage() . ' ' . $exception->getCode());

    $errorMessage = 'Код Ошибки: ' . $exception->getCode();
    include PathBuilder::getPath(PathConfig::publicIndexPage) . '/error.php';
}

include __DIR__ . '/footer.php';