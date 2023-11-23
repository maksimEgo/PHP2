<?php

namespace Exception;

use PHPUnit\Framework\TestCase;
use src\Exceptions\AccessException;
use src\Exceptions\DataBaseException;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;

class ExceptionFactoryTest extends TestCase
{
    public function testCreateDataBaseConnectionException(): void
    {
        $message = 'Тестовое сообщение';
        $code = 1001;

        $exception = ExceptionFactory::createDataBaseConnectionException($message, $code);

        $this->assertInstanceOf(DataBaseException::class, $exception);
        $this->assertEquals('Ошибка подключение: ' . $message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCreateQueryException(): void
    {
        $message = 'Тестовое сообщение';
        $code = 1002;

        $exception = ExceptionFactory::createQueryException($message, $code);

        $this->assertInstanceOf(DataBaseException::class, $exception);
        $this->assertEquals('Ошибка при выполнение запроса: ' . $message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCreateExecuteException(): void
    {
        $message = 'Тестовое сообщение';
        $code = 1003;

        $exception = ExceptionFactory::createExecuteException($message, $code);

        $this->assertInstanceOf(DataBaseException::class, $exception);
        $this->assertEquals('Ошибка при выполнение запроса: ' . $message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCreateNotFoundException(): void
    {
        $message = 'Тестовое сообщение';
        $code = 404;

        $exception = ExceptionFactory::createNotFoundException($message, $code);

        $this->assertInstanceOf(NotFoundException::class, $exception);
        $this->assertEquals('Страница не найдена: ' . $message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }

    public function testCreateAccessException(): void
    {
        $message = 'Тестовое сообщение';
        $code = 102;

        $exception = ExceptionFactory::createAccessException($message, $code);

        $this->assertInstanceOf(AccessException::class, $exception);
        $this->assertEquals('Ошибка доступа ' . $message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
    }
}