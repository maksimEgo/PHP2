<?php

namespace src\Controller;
use src\Exceptions\AccessException;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;
use src\Validator\ArticleDataValidator;
use src\View\AdminView;
use src\View\PublicView;


abstract class BaseController
{
    protected PublicView $publicView;
    protected AdminView $adminView;
    protected ArticleDataValidator $validator;

    public function __construct()
    {
        $this->publicView = new PublicView();
        $this->adminView = new AdminView();
        $this->validator = new ArticleDataValidator();
    }

    public function dispatch($action): void
    {
        if ($this->access()) {
            if (method_exists($this, $action)) {
                $this->$action();
            } else {
                throw ExceptionFactory::createNotFoundException('Невозможно выполнить действие',
                    NotFoundException::NOT_FOUND_ACTION);
            }
        } else {
            throw ExceptionFactory::createAccessException(' к действию контроллера',
                AccessException::ACCESS_ERROR);
        }
    }

    protected function access(): bool
    {
        return true;
    }

    abstract protected function defaultAction();
}
