<?php

namespace src\Controller\News;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\NotFoundException;

class ArticlesController extends BaseController
{
    protected function defaultAction()
    {
        try {
            $this->view->articles = \src\Model\News\Article::findAll();
            echo $this->view->render( PathBuilder::getPath(PathConfig::baseTemplatePath) . 'articles.php');
        } catch (NotFoundException $notFoundException) {
            throw new NotFoundException('Новости не найдены');
        }
    }
}