<?php

namespace src\Route;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\Logger\LoggerException;
use src\Repository\ControllerRepository;

abstract class AbstractRoute
{
    private LoggerException $loggerException;
    private ControllerRepository $controllerRepository;
    private string $basePage;

    public function __construct()
    {
        $this->loggerException = new LoggerException();
        $this->controllerRepository = new ControllerRepository();
        $this->basePage = $_GET['page'] ?? 'Articles';
    }

    public function Routing(): void
    {
        $routeName = $this->getRouteName($this->basePage);

        try {
            if (class_exists($routeName)) {
                $controller = $this->controllerRepository->getController($routeName);
                $controller->dispatch('defaultAction');
            }
        } catch (DbException $exceptionDb) {
            $this->loggerException
                ->log("Database error: "
                    . $exceptionDb->getMessage());

            $errorMessage = $exceptionDb->getMessage();
            include PathBuilder::getPath(PathConfig::baseTemplatePath) . '/error.php';
        } catch (NotFoundException $exceptionNotFound) {
            $this->loggerException
                ->log("Not Found error: "
                    . $exceptionNotFound->getMessage());

            $errorMessage = $exceptionNotFound->getMessage();
            include PathBuilder::getPath(PathConfig::baseTemplatePath) . '/error.php';
        }
    }

    abstract public function getRouteName(string $page);
}