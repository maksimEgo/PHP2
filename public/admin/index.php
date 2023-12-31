<?php

use Monolog\Logger;
use SebastianBergmann\Timer\Timer;
use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DataBaseException;
use src\Exceptions\NotFoundException;
use src\Route\AdminRoute;

include __DIR__ . '/../header.php';

$page = $_GET['page'] ?? 'Articles';

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

$timer = $container->get(Timer::class);
$timer->start();

$router = $container->get(AdminRoute::class);

try {
    $router->Routing();
} catch (DataBaseException | NotFoundException $exception) {
    $logger = $container->get(Logger::class);
    $logger->error("Error: " . $exception->getMessage() . ' Code: ' . $exception->getCode());

    $errorMessage = 'Код Ошибки: ' . $exception->getCode();
    include PathBuilder::getPath(PathConfig::publicIndexPage) . '/error.php';
}

include __DIR__ . '/../footer.php';