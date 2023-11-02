<?php

namespace src;

/**
 * Class Config
 *
 * This class is responsible for loading and providing configuration settings for the database connection.
 *
 * @package src
 */
class Config
{
    /**
     * @var string The path to the database configuration file.
     */
    protected static string $configPath = __DIR__ . '/../config/database.php';

    /**
     * @var array The array storing database configuration settings.
     */
    protected static array $config;
    /**
     * @var string The database name.
     */
    protected static string $dbName;
    /**
     * @var string The username for the database connection.
     */
    protected static string $user;
    /**
     * @var string The password for the database connection.
     */
    protected static string $password;

    /**
     * Set the parameters required for the database connection.
     *
     * @return void
     * @throws \RuntimeException If the database configuration is incomplete.
     */
    protected static function setConnectionParameters(): void
    {
        if (!isset(static::$config['dbname']) || !isset(static::$config['user']) || !isset(static::$config['password'])) {
            throw new \RuntimeException('Database configuration is incomplete.');
        }

        static::$dbName = static::$config['dbname'];
        static::$user = static::$config['user'];
        static::$password = static::$config['password'];
    }

    /**
     * Load the database configuration settings from a file.
     *
     * @return void
     * @throws \RuntimeException If the database configuration file does not exist.
     */
    protected static function loadConfig(): void
    {
        if (!file_exists(static::$configPath)) {
            throw new \RuntimeException('Database configuration file does not exist.');
        }

        static::$config = include static::$configPath;
    }
}