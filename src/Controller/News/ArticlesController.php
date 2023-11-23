<?php

namespace src\Controller\News;

use src\Controller\BaseController;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;

class ArticlesController extends BaseController
{
    protected function defaultAction()
    {
        try {
            $this->publicView->articles = \src\Model\News\Article::findAll();
            echo $this->publicView->render('articles.twig');
        } catch (NotFoundException $notFoundException) {
            throw ExceptionFactory::createNotFoundException('Новости не найдены ' . $notFoundException->getMessage(),
                NotFoundException::NOT_FOUND_PAGE_ERROR);
        }
    }
}