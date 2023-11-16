<?php

namespace src\Route;

final class PublicRoute extends AbstractRoute
{
    public function getRouteName(string $page): string
    {
        return 'src\\Controller\\News\\' . ucfirst($page) . 'Controller';
    }
}