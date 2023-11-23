<?php

namespace src\Exceptions;

class ExceptionFactory
{
    public static function createDataBaseConnectionException(string $message, int $code): DataBaseException
    {
        return new DataBaseException('Ошибка подключение: ' . $message, $code);
    }

    public static function createQueryException(string $message, int $code): DataBaseException
    {
        return new DataBaseException('Ошибка при выполнение запроса: ' . $message, $code);
    }

    public static function createExecuteException(string $message, int $code): DataBaseException
    {
        return new DataBaseException('Ошибка при выполнение запроса: ' . $message, $code);
    }

    public static function createNotFoundException(string $message, int $code): NotFoundException
    {
        return new NotFoundException('Страница не найдена: ' . $message, $code);
    }

    public static function createAccessException(string $message, int $code): AccessException
    {
        return new AccessException('Ошибка доступа ' . $message, $code);
    }
}