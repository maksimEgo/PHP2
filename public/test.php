<?php

require_once __DIR__ . '/autoload.php';

$db = src\model\DB::getInstance();

try {
    $db->execute('CREATE TABLE IF NOT EXISTS news(
    id serial PRIMARY KEY NOT NULL,
    title varchar(100),
    content TEXT
        );');

    echo 'Table Created...' . '<br>';
} catch ( \Exception $exception ) {
    echo $exception->getMessage();
} finally {
    echo 'Test end.';
}