<?php

namespace src;

class Config
{
    protected static string $configPath = __DIR__ . '/../config/database.php';

    protected static array $config;
    protected static string $dbName;
    protected static string $user;
    protected static string $password;

    protected static function setConnectionParameters(): void
    {
        if (!isset(static::$config['dbname']) || !isset(static::$config['user']) || !isset(static::$config['password'])) {
            throw new \RuntimeException('Database configuration is incomplete.');
        }

        static::$dbName = static::$config['dbname'];
        static::$user = static::$config['user'];
        static::$password = static::$config['password'];
    }

    protected static function loadConfig(): void
    {
        if (!file_exists(static::$configPath)) {
            throw new \RuntimeException('Database configuration file does not exist.');
        }

        static::$config = include static::$configPath;
    }
}