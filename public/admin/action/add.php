<?php

ob_start();

require_once __DIR__ . '/../../autoload.php';

$article = new \src\model\Article();

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['title'], $_POST['content'])) {
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];

        $article->save();

        header('Location: /admin/index.php');
        exit;
    }
}

include __DIR__ . '/../../../template/admin/action/add.php';
