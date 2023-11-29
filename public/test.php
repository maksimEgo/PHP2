<?php

require_once __DIR__ . '/../vendor/autoload.php';

$db = src\Model\Db::getInstance();

try {
    $db->execute('CREATE TABLE IF NOT EXISTS news(
    id serial PRIMARY KEY NOT NULL,
    title varchar(100),
    content TEXT,
    author_id varchar(100)
        );');

    $db->execute('CREATE TABLE IF NOT EXISTS authors(
    id serial PRIMARY KEY NOT NULL,
    name varchar(128)
        );');

    $db->execute("CREATE TYPE role_type AS ENUM ('user', 'admin')");

    $db->execute('CREATE TABLE IF NOT EXISTS users(
    id serial PRIMARY KEY NOT NULL,
    username VARCHAR(32),
    password VARCHAR(256),
    email VARCHAR(128),
    role role_type,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
        );');

    $db->execute('CREATE TABLE IF NOT EXISTS session (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT,
    created_at TIMESTAMP,
    expires_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
        );');


    /*$article = new \src\AbstractModel\Article();
    $article->title = 'Репозиторий';
    $article->content = 'Теперь создадим простейший репозиторий. Тоже с одним методом, который будет возвращать нам пользователя по его email:';
    $article->insert();*/

    /*$article = new \src\AbstractModel\Article();
    $article->id = 1;
    $article->content = 'Тест Update';
    $article->update();*/

    /*$article = new \src\AbstractModel\Article();
    $article->id = 1;
    $article->delete();*/

    echo 'Table Created...' . '<br>';
} catch ( \Exception $exception ) {
    echo $exception->getMessage();
} finally {
    echo 'Test end.';
}