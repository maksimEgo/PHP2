<?php

require_once __DIR__ . '/autoload.php';

function showArticle(int $id): void {
    $view = new \src\View();
    $view->article = \src\model\Article::findById($id);

    if (!$view->article) {
        echo 'Article not found';
        return;
    }
    echo $view->render(__DIR__ . '/../template/article.php');
}

if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
    showArticle((int) $id);
} else {
    echo 'Not corrected request';
}



