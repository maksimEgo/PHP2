<?php

namespace src\Route;

use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use Monolog\Logger;
use src\Repository\ControllerRepository;

abstract class AbstractRoute
{
    private ControllerRepository $controllerRepository;
    private Logger $logger;
    private string $basePage;

    public function __construct(
        Logger $logger,
        ControllerRepository $controllerRepository,
        string $page

    )
    {
        $this->logger = $logger;
        $this->controllerRepository = $controllerRepository;
        $this->basePage = $page;
    }

    public function Routing(): void
    {
        $routeName = $this->getRouteName($this->basePage);

        try {
            if (class_exists($routeName)) {
                $controller = $this->controllerRepository->getController($routeName);
                $controller->dispatch('defaultAction');
            } else {
                throw new NotFoundException("Controller not found");
            }
        } catch (DbException | NotFoundException $exception) {
            $this->logger->error(get_class($exception) . ": " . $exception->getMessage());
            throw $exception;
        }
    }

    abstract public function getRouteName(string $page);
}