<?php

namespace src\Route;

final class BaseRoute extends AbstractRoute
{
    private array $routes = [
        'news' => 'src\\Controller\\News\\',
        'users' => 'src\\Controller\\Users\\',
    ];

    public function getRouteName(string $path): string
    {
        $parts = explode('/', trim($path, '/'));
        $categoryPath = $parts[0] ?? 'news';

        $category = $this->routes[$categoryPath] ?? 'src\\Controller\\News\\';

        $controllerName = isset($parts[1]) ? ucfirst($parts[1]) : 'Articles';
        $controllerName .= 'Controller';

        return $category . $controllerName;
    }
}
