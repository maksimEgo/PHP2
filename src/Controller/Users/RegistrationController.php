<?php

namespace src\Controller\Users;

use src\Controller\BaseController;
use src\Exceptions\AccessException;
use src\Exceptions\ExceptionFactory;

class RegistrationController extends BaseController
{
    protected function defaultAction()
    {
        try {
            echo $this->publicView->render('registration.twig');
        } catch (AccessException) {
            throw ExceptionFactory::createAccessException(' к регистрации',
                AccessException::ACCESS_ERROR);
        }
    }
}