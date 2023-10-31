<?php

require_once __DIR__ . '/../../autoload.php';

if ( 'GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) ) {
    $id = $_GET['id'];

    $article = new \src\model\Article();

    $article->id = $id;
    $article->delete();

    header('Location: /admin/index.php');
}
