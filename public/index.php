<?php

require_once __DIR__ . '/autoload.php';

$articles = \src\model\Article::findAll();

include __DIR__ . '/../template/articles.php';