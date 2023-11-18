<?php

namespace src\Controller\News;

use src\Controller\BaseController;
use src\Exceptions\NotFoundException;

class ArticlesController extends BaseController
{
    protected function defaultAction()
    {
        try {
            $this->publicView->articles = \src\Model\News\Article::findAll();
            echo $this->publicView->render('articles.twig');
        } catch (NotFoundException $notFoundException) {
            throw new NotFoundException('Новости не найдены');
        }
    }
}