<?php

namespace src\model;

use PDO;

class DB
{
    protected static ?PDO $db = null;
    protected static ?DB $instance = null;

    private static string $configPath = __DIR__ . '/../../config/database.php';

    private static array $config;
    private static string $dbName;
    private static string $user;
    private static string $password;

    private const HOST = 'pgsql:host=postgres;';
    private const PORT = 'port=5432;';

    private function __construct()
    {
        $this->initializeDatabaseConnection()
            ->configureConnectionAttributes();
    }

    public function __destruct()
    {
        self::$db = null;
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::loadConfig();
            self::setConnectionParameters();
            self::$instance = new self();
        }

        return self::$instance;
    }

    private static function loadConfig(): void
    {
        if (!file_exists(self::$configPath)) {
            throw new \RuntimeException('Database configuration file does not exist.');
        }

        self::$config = include self::$configPath;
    }

    private static function setConnectionParameters(): void
    {
        if (!isset(self::$config['dbname']) || !isset(self::$config['user']) || !isset(self::$config['password'])) {
            throw new \RuntimeException('Database configuration is incomplete.');
        }

        self::$dbName = self::$config['dbname'];
        self::$user = self::$config['user'];
        self::$password = self::$config['password'];
    }

    private function initializeDatabaseConnection(): self
    {
        if (!isset(self::$db)) {
            self::$db = new PDO(DB::HOST . DB::PORT . 'dbname=' . self::$dbName,
                self::$user,
                self::$password);
        }

        return $this;
    }

    private function configureConnectionAttributes(): void
    {
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->setAttribute(PDO::ATTR_TIMEOUT, 60);
    }

    public static function query(string $sql, array $data = [], int $fetchStyle = PDO::FETCH_CLASS): array
    {
        if (self::$db === null) {
            throw new \RuntimeException('Database connection not established.');
        }

        $sth = self::$db->prepare($sql);
        $sth->execute($data);

        return $fetchStyle === PDO::FETCH_CLASS ? $sth->fetchAll($fetchStyle, static::class) : $sth->fetchAll($fetchStyle);
    }

    public static function execute(string $sql, array $data = []): bool
    {

        if (self::$db === null) {
            throw new \RuntimeException('Database connection not established.');
        }

        $sth = self::$db->prepare($sql);

        return $sth->execute($data);
    }
}