<?php

require_once __DIR__ . '/../autoload.php';

$page = $_GET['page'] ?? 'Articles';

$routeName = 'src\\Controller\\Admin\\' . ucfirst($page) . 'Controller';

if (class_exists($routeName)) {
    $controller = new $routeName;
    $controller->dispatch('defaultAction');
} else {
    echo '404 ошибка';
}
