<?php

namespace src\Controller\News;

use src\Config\PathConfig;
use src\Controller\BaseController;

class ArticlesController extends BaseController
{
    protected function defaultAction()
    {
        $this->view->articles = \src\Model\News\Article::findAll();
        echo $this->view->render(PathConfig::baseTemplatePath->getPath() . 'articles.php');
    }
}