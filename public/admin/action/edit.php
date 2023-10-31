<?php

require_once __DIR__ . '/../../autoload.php';

$article = new \src\model\Article();

if ( 'GET' === $_SERVER['REQUEST_METHOD'] ) {
    if ( isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) ) {
        $id = $_GET['id'];
        $article = $article::findById($id);
        if ( !$article ) {
            die('Статья не найдена');
        }
        include __DIR__ . '/../../../template/admin/action/edit.php';
    } else {
        die('Неверный ID статьи');
    }
} elseif ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
    if ( isset($_POST['id'], $_POST['title'], $_POST['content']) ) {
        $article->id = $_POST['id'];
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];

        $article->save();

        header('Location: /admin/index.php');
        exit;
    }
}