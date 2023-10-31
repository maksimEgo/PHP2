<?php

require_once __DIR__ . '/autoload.php';

$db = src\model\DB::getInstance();

try {
    $db->execute('CREATE TABLE IF NOT EXISTS news(
    id serial PRIMARY KEY NOT NULL,
    title varchar(100),
    content TEXT
        );');

    /*$article = new \src\model\Article();
    $article->title = 'Репозиторий';
    $article->content = 'Теперь создадим простейший репозиторий. Тоже с одним методом, который будет возвращать нам пользователя по его email:';
    $article->insert();*/

    /*$article = new \src\model\Article();
    $article->id = 1;
    $article->content = 'Тест Update';
    $article->update();*/

    /*$article = new \src\model\Article();
    $article->id = 1;
    $article->delete();*/

    echo 'Table Created...' . '<br>';
} catch ( \Exception $exception ) {
    echo $exception->getMessage();
} finally {
    echo 'Test end.';
}