<?php

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\Logger\LoggerException;
use src\Route\PublicRoute;

$page = $_GET['page'] ?? 'Articles';

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

$router = $container->get(PublicRoute::class);

try {
    $router->Routing();
} catch (DbException | NotFoundException $exception) {
    $logger = $container->get(LoggerException::class);
    $logger->log("Error: " . $exception->getMessage());

    $errorMessage = $exception->getMessage();
    include PathBuilder::getPath(PathConfig::baseTemplatePath) . '/error.php';
}