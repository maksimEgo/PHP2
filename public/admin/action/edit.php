<?php

require_once __DIR__ . '/../../autoload.php';

$view = new \src\View();
$article = new \src\model\Article();

if ( 'GET' === $_SERVER['REQUEST_METHOD'] ) {
    if ( isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) ) {
        $id = $_GET['id'];
        $view->article = $article::findById($id);
        if ( !$view->article ) {
            die('Статья не найдена');
        }
        echo $view->render(__DIR__ . '/../../../template/admin/action/edit.php');
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