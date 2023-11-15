<?php

use src\Logger\LoggerException;

require_once __DIR__ . '/../autoload.php';

$router = new src\Route\AdminRoute();
$router->Routing();