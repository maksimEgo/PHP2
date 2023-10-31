<?php

namespace src\model;

use PDO;
use src\Config;

class DB extends Config
{
    protected static ?PDO $db = null;
    protected static ?DB $instance = null;

    private const HOST = 'pgsql:host=postgres;';
    private const PORT = 'port=5432;';

    private function __construct()
    {
        $this->initializeDatabaseConnection()
            ->configureConnectionAttributes();
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            static::loadConfig();
            static::setConnectionParameters();
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function initializeDatabaseConnection(): self
    {
        if (!isset(self::$db)) {
            self::$db = new PDO(DB::HOST . DB::PORT . 'dbname=' . static::$dbName,
                static::$user,
                static::$password);
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

    public static function getInsertId(): false|string
    {
        return static::$db->lastInsertId();
    }
}