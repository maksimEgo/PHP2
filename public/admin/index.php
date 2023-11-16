<?php

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\Logger\LoggerException;
use src\Repository\ControllerRepository;

require_once __DIR__ . '/../autoload.php';

$logger = new LoggerException();
$controllerRep = new ControllerRepository();
$page = $_GET['page'] ?? 'Articles';

$router = new src\Route\AdminRoute($logger, $controllerRep, $page);

try {
    $router->Routing();
} catch (DbException | NotFoundException $exception) {
    $this->loggerException
        ->log("Error: "
            . $exception->getMessage());

    $errorMessage = $exception->getMessage();
    include PathBuilder::getPath(PathConfig::baseTemplatePath) . '/error.php';
}