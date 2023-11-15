<?php

namespace src\Repository;

use src\Controller\BaseController;

class ControllerRepository
{
    public function getController(string $routeName): BaseController
    {
        return new $routeName;
    }
}