<?php

namespace src\Controller\Admin;

use src\Config\PathConfig;
use src\Controller\BaseController;

class ArticlesController extends BaseController
{
    public function defaultAction()
    {
        $this->view->articles = \src\Model\News\Article::findAll();
        echo $this->view->render(PathConfig::adminTemplatePath->getPath() . 'index.php');
    }
}