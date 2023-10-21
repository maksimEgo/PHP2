<?php

namespace src;

use src\model\DB;
use PDO;

abstract class Model
{
    public int $id;

    public static function findById(int $id) : array|object|false
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM ' . static::TABLE
            . ' WHERE id =:id';

        $data = [
            'id' => $id,
        ];

        $result = $db->query($sql, $data, PDO::FETCH_CLASS);

        return $result[0] ?? false;
    }

    public static function findAll(): array|false
    {
        $db = DB::getInstance();

        $sql = 'SELECT * FROM ' . static::TABLE;

        $result = $db->query($sql, fetchStyle: PDO::FETCH_CLASS);

        return $result ?? false;
    }
}