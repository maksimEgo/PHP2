<?php

namespace src\Controller\Users;

use src\Controller\BaseController;
use src\Exceptions\AccessException;
use src\Exceptions\ExceptionFactory;
use src\Model\Users\User;
use src\Model\Users\UserRoleEnum;
use src\Validator\UserDataValidator;

class RegistrationController extends BaseController
{
    protected function defaultAction()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && true === UserDataValidator::validateUserData($_POST) )
        {
            $this->registration($_POST);
        } else {
            // выводим уведомления с ошибками
        }

        try {
            echo $this->publicView->render('registration.twig');
        } catch (AccessException) {
            throw ExceptionFactory::createAccessException(' к регистрации',
                AccessException::ACCESS_ERROR);
        }
    }

    private function registration(array $data): void
    {
        $user = new User();

        $user->setUserName($data['username']);
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setRole(UserRoleEnum::roleUser);
        $user->setCreatedAt(new \DateTime());

        $user->save();
    }
}