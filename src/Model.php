<?php

namespace src;

use src\model\DB;
use PDO;

/**
 * Class Model
 *
 * This abstract class represents the base model for interacting with the database.
 *
 * @package src
 */
abstract class Model
{
    /**
     * @var int $id Unique identifier for the model.
     */
    public int $id;

    /**
     * Finds a model by its ID.
     *
     * @param int $id The ID of the model to find.
     * @return array|object|false The found model as an object, array if multiple results, or false if not found.
     */
    public static function findById(int $id) : array|object|false
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM ' . static::TABLE
            . ' WHERE id =:id';

        $data = [
            'id' => $id,
        ];

        $result = $db->query($sql, $data, PDO::FETCH_CLASS, className: static::class);

        return $result[0] ?? false;
    }

    /**
     * Finds all models in the database.
     *
     * @return array|false The found models as an array of objects, or false if none found.
     */
    public static function findAll(): array|false
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM ' . static::TABLE;

        $result = $db->query($sql, fetchStyle: PDO::FETCH_CLASS, className: static::class);

        return $result ?? false;
    }


    /**
     * Inserts the current model instance into the database.
     *
     * @return void
     */
    public function insert(): void
    {
        $db = DB::getInstance();

        $columns = [];
        $data = [];

        foreach (get_object_vars($this) as $prop => $value ) {
            if ('id' == $prop ) {
                continue;
            }
            $columns[] = $prop;
            $data [':' . $prop] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
            ' (' . implode(',', $columns) . ') 
            VALUES (' . implode(',', array_keys($data)) .')
            ';

        $db->execute($sql, $data);

        $this->id = $db->getInsertId();
    }

    /**
     * Updates the current model instance in the database.
     *
     * @return bool True on success, false on failure.
     */
    public function update(): bool
    {
        $db = DB::getInstance();

        $data = [];
        $id = null;

        foreach (get_object_vars($this) as $prop => $value) {
            if ('id' == $prop) {
                $id = $value;
                continue;
            }
            $data[':' . $prop] = $value;
        }

        if ($id === null) {
            throw new \RuntimeException('ID must be set for update');
        }

        $setPart = implode(', ', array_map(function ($key) {
            $key = ltrim($key, ':');
            return "$key = :$key";
        }, array_keys($data)));

        $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . $setPart .
            ' WHERE id = :id';

        $data[':id'] = $id;

        return $db->execute($sql, $data);
    }

    /**
     * Deletes the current model instance from the database.
     *
     * @return void
     */
    public function delete(): void
    {
        if (!isset($this->id)) {
            throw new \RuntimeException('ID must be set for delete');
        }

        $db = DB::getInstance();

        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id =:id';
        $data = [':id' => $this->id];

        $db->execute($sql, $data);
    }

    /**
     * Saves the current model instance to the database.
     *
     * @return void
     */
    public function save(): void
    {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }
}