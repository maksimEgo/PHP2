<?php

namespace src\Controller\Admin;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;

class ArticlesController extends BaseController
{
    public function defaultAction()
    {
        try {
            $this->adminView->articles = \src\Model\News\Article::findAll();
            echo $this->adminView->render(PathBuilder::getPath(PathConfig::adminIndexPage));
        } catch (NotFoundException $notFoundException) {
            throw ExceptionFactory::createNotFoundException('Новости не найдены ' . $notFoundException->getMessage(),
                NotFoundException::NOT_FOUND_PAGE_ERROR);
        }
    }
}