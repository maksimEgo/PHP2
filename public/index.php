<?php

use Monolog\Logger;
use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\Route\PublicRoute;
use SebastianBergmann\Timer\Timer;

$page = $_GET['page'] ?? 'Articles';

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

$timer = $container->get(Timer::class);
$timer->start();

$router = $container->get(PublicRoute::class);

try {
    $router->Routing();
} catch (DbException | NotFoundException $exception) {
    $logger = $container->get(Logger::class);
    $logger->error("Error: " . $exception->getMessage());

    $errorMessage = $exception->getMessage();
    include PathBuilder::getPath(PathConfig::baseTemplatePath) . '/error.php';
}

include __DIR__ . '/footer.php';