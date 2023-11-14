<?php

require_once __DIR__ . '/../autoload.php';

$page = $_GET['page'] ?? 'Articles';

$routeName = 'src\\Controller\\Admin\\' . ucfirst($page) . 'Controller';

try {
    if (class_exists($routeName)) {
        $controller = new $routeName();
        $controller->dispatch('defaultAction');
    }
} catch (\src\Exceptions\DbException $exception) {
    include __DIR__ . '/../../template/404.php';
}