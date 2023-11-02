<?php

require_once __DIR__ . '/autoload.php';

$view = new \src\View();
$view->articles = \src\model\Article::findAll();
echo $view->render(__DIR__ . '/../template/articles.php');