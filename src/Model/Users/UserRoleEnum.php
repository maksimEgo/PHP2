<?php

namespace src\Model\Users;

enum UserRoleEnum
{
    case roleUser;
    case roleAdmin;

    public static function getRole(UserRoleEnum $role): string
    {
        return match ($role) {
            UserRoleEnum::roleUser => 'user',
            UserRoleEnum::roleAdmin => 'admin',
        };
    }
}
