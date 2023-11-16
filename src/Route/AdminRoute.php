<?php

namespace src\Route;

final class AdminRoute extends AbstractRoute
{
    public function getRouteName(string $page): string
    {
        return 'src\\Controller\\Admin\\' . ucfirst($page) . 'Controller';
    }
}