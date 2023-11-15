<?php

namespace src\Route;


class AdminRoute extends AbstractRoute
{
    public function getRouteName(string $page): string
    {
        return 'src\\Controller\\Admin\\' . ucfirst($page) . 'Controller';
    }
}