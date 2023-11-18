<?php

namespace src\Controller;
use src\View\AdminView;
use src\View\PublicView;


abstract class BaseController
{
    protected PublicView $publicView;
    protected AdminView $adminView;

    public function __construct()
    {
        $this->publicView = new PublicView();
        $this->adminView = new AdminView();
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
