<?php

namespace src\model;

use src\Model;

class Article extends Model
{
    protected const TABLE = 'news';

    public string $title;
    public string $content;
}