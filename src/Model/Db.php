<?php

namespace src\Model;

use PDO;
use src\Config\ConfigDb;
use src\Exceptions\DataBaseException;
use src\Exceptions\ExceptionFactory;
use src\Service\NotificationService;

/**
 * Class Db
 *
 * This class is responsible for handling the database connection and performing queries.
 *
 * @package src\AbstractModel
 */
class Db extends ConfigDb
{
    /**
     * @var PDO|null $db Holds the PDO database connection instance.
     */
    protected static ?PDO $db = null;
    /**
     * @var Db|null $instance Holds the singleton instance of Db class.
     */
    protected static ?Db $instance = null;

    /**
     * @var string HOST The database host.
     */
    private const HOST = 'pgsql:host=postgres;';
    /**
     * @var string PORT The database port.
     */
    private const PORT = 'port=5432;';

    /**
     * Db constructor.
     * Initializes the database connection and configures connection attributes.
     * @throws DataBaseException connection Exception
     */
    private function __construct()
    {
        try {
            $this->initializeDatabaseConnection()
                ->configureConnectionAttributes();
        } catch (\PDOException $PDOException) {
            NotificationService::sendDbErrorEmail($PDOException);

            throw ExceptionFactory::createDataBaseConnectionException($PDOException->getMessage(),
                DataBaseException::CONNECTION_ERROR);
        }
    }

    /**
     * Returns a singleton instance of the Db class.
     *
     * @return Db The singleton instance.
     */
    public static function getInstance(): Db
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
     * @return $this The Db instance.
     */
    private function initializeDatabaseConnection(): self
    {
        if (!isset(self::$db)) {
            self::$db = new PDO(Db::HOST . Db::PORT . 'dbname=' . static::$dbName,
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
     */
    public function query(string $sql, array $data = [], int $fetchStyle = PDO::FETCH_CLASS, ?string $className = null): array
    {
        if (self::$db === null) {
            throw ExceptionFactory::createQueryException('query', DataBaseException::QUERY_ERROR);
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
     */
    public function execute(string $sql, array $data = []): bool
    {
        if (self::$db === null) {
            throw ExceptionFactory::createExecuteException('execute', DataBaseException::EXECUTE_ERROR);
        }

        $sth = static::$db->prepare($sql);

        return $sth->execute($data);
    }

    /**
     * Executes an SQL query and yields each row of the result set one by one.
     *
     * @param string $sql The SQL query string.
     * @param array $data Optional associative array of parameters to bind to the SQL query.
     * @param int $fetchStyle The PDO fetch style.
     * @param string|null $className Optional class name for PDO::FETCH_CLASS fetch style.
     * @return \Generator The generator for the result set rows.
     */
    public function queryEach(string $sql, array $data = [], int $fetchStyle = PDO::FETCH_CLASS, ?string $className = null): \Generator
    {
        if (self::$db === null) {
            throw ExceptionFactory::createQueryException('queryEach', DataBaseException::QUERY_ERROR);
        }

        $sth = self::$db->prepare($sql);
        $sth->execute($data);

        if ($fetchStyle === PDO::FETCH_CLASS) {
            while ($row = $sth->fetch($fetchStyle, PDO::FETCH_ORI_NEXT, 0, $className)) {
                yield $row;
            }
        } else {
            while ($row = $sth->fetch($fetchStyle)) {
                yield $row;
            }
        }
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

    public static function setPDO(PDO $pdo): void
    {
        self::$db = $pdo;
    }
}