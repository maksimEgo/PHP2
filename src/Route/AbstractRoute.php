<?php

namespace src\Route;

use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\Logger\LoggerException;
use src\Repository\ControllerRepository;

abstract class AbstractRoute
{
    private LoggerException $loggerException;
    private ControllerRepository $controllerRepository;
    private string $basePage;

    public function __construct(
        LoggerException $loggerException,
        ControllerRepository $controllerRepository,
        string $page
    )
    {
        $this->loggerException = $loggerException;
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
            $this->loggerException->log(get_class($exception) . ": " . $exception->getMessage());
            throw $exception;
        }
    }

    abstract public function getRouteName(string $page);
}