<?php

namespace src\model;

use PDO;
use src\Config;

/**
 * Class DB
 *
 * This class is responsible for handling the database connection and performing queries.
 *
 * @package src\model
 */
class DB extends Config
{
    /**
     * @var PDO|null $db Holds the PDO database connection instance.
     */
    protected static ?PDO $db = null;
    /**
     * @var DB|null $instance Holds the singleton instance of DB class.
     */
    protected static ?DB $instance = null;

    /**
     * @var string HOST The database host.
     */
    private const HOST = 'pgsql:host=postgres;';
    /**
     * @var string PORT The database port.
     */
    private const PORT = 'port=5432;';

    /**
     * DB constructor.
     * Initializes the database connection and configures connection attributes.
     */
    private function __construct()
    {
        $this->initializeDatabaseConnection()
            ->configureConnectionAttributes();
    }

    /**
     * Returns a singleton instance of the DB class.
     *
     * @return DB The singleton instance.
     */
    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            static::loadConfig();
            static::setConnectionParameters();
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initializes the PDO database connection.
     *
     * @return $this The DB instance.
     */
    private function initializeDatabaseConnection(): self
    {
        if (!isset(self::$db)) {
            self::$db = new PDO(DB::HOST . DB::PORT . 'dbname=' . static::$dbName,
                static::$user,
                static::$password);
        }

        return $this;
    }

    /**
     * Configures the PDO connection attributes.
     *
     * @return void
     */
    private function configureConnectionAttributes(): void
    {
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->setAttribute(PDO::ATTR_TIMEOUT, 60);
    }

    /**
     * Executes an SQL query and returns the result set.
     *
     * @param string $sql The SQL query string.
     * @param array $data Optional associative array of parameters to bind to the SQL query.
     * @param int $fetchStyle The PDO fetch style.
     * @param string|null $className Optional class name for PDO::FETCH_CLASS fetch style.
     * @return array The result set as an array.
     * @throws \RuntimeException If the database connection is not established.
     */
    public function query(string $sql, array $data = [], int $fetchStyle = PDO::FETCH_CLASS, ?string $className = null): array
    {
        if (self::$db === null) {
            throw new \RuntimeException('Database connection not established.');
        }

        $sth = static::$db->prepare($sql);
        $sth->execute($data);

        return $fetchStyle === PDO::FETCH_CLASS ? $sth->fetchAll($fetchStyle, $className) : $sth->fetchAll($fetchStyle);
    }

    /**
     * Executes an SQL command and returns the status.
     *
     * @param string $sql The SQL command string.
     * @param array $data Optional associative array of parameters to bind to the SQL command.
     * @return bool True on success, false on failure.
     * @throws \RuntimeException If the database connection is not established.
     */
    public function execute(string $sql, array $data = []): bool
    {

        if (self::$db === null) {
            throw new \RuntimeException('Database connection not established.');
        }

        $sth = static::$db->prepare($sql);

        return $sth->execute($data);
    }

    /**
     * Returns the ID of the last inserted row or sequence value.
     *
     * @return false|string The last inserted row ID or sequence value. False on failure.
     */
    public static function getInsertId(): false|string
    {
        return static::$db->lastInsertId();
    }
}