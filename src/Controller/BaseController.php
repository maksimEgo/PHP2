<?php

namespace src\Controller;


use src\View\View;

abstract class BaseController
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function dispatch($action): void
    {
        if ($this->access()) {
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                echo "Действие не найдено.";
            }
        } else {
            echo "Доступ закрыт.";
            exit;
        }
    }

    protected function access(): bool
    {
        return true;
    }

    abstract protected function defaultAction();
}
