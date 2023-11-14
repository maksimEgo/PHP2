<?php

use \src\Exceptions\DbException;
use \src\Exceptions\NotFoundException;
use \src\Logger\LoggerException;

require_once __DIR__ . '/autoload.php';

$page = $_GET['page'] ?? 'Articles';

$routeName = 'src\\Controller\\News\\' . ucfirst($page) . 'Controller';
$logger = new LoggerException();

try {
    if (class_exists($routeName)) {
        $controller = new $routeName;
        $controller->dispatch('defaultAction');
    }
} catch (DbException $exceptionDb) {
    $logger->log("Database error: "
        . $exceptionDb->getMessage());

    $errorMessage = $exceptionDb->getMessage();
    include __DIR__ . '/../template/error.php';
} catch (NotFoundException $exceptionNotFound) {
    $logger->log("Not Found error: "
        . $exceptionNotFound->getMessage());

    $errorMessage = $exceptionNotFound->getMessage();
    include __DIR__ . '/../template/error.php';
}