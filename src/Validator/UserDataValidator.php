<?php

namespace src\Validator;

class UserDataValidator
{
    protected const MAX_VALUE = 18;
    protected const MIN_VALUE = 6;

    public static function validateUserData(array $data): bool|array
    {
        $error = [];

        if ( empty($data['username']) || empty($data['password']) || empty($data['email']) ) {
            $error[] = 'username/password/email is empty';
        }

        if ( mb_strlen($data['username']) < self::MIN_VALUE || mb_strlen($data['username']) > self::MAX_VALUE ) {
            $error[] = 'invalid length username, minimum character - (6), maximum - (18)';
        }

        if ( mb_strlen($data['password']) < self::MIN_VALUE || mb_strlen($data['password']) > self::MAX_VALUE ) {
            $error[] = 'invalid length password, minimum character - (6), maximum - (18)';
        }

        if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
            $error[] = 'No email entered, please enter correct email';
        }

        if ( empty($error) ) {
            return true;
        } else {
            return $error;
        }
    }
}