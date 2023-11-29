<?php

namespace src\Controller\News;

use src\Controller\BaseController;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;

class ArticleController extends BaseController
{
    protected function defaultAction()
    {
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $id = $parts[2] ?? null;

        if ('GET' === $_SERVER['REQUEST_METHOD'] && ctype_digit($id)) {
            $this->publicView->article = \src\Model\News\Article::findById($id);

            if (!$this->publicView->article) {
                throw ExceptionFactory::createNotFoundException('Новость с ID "' . $id . '" не найдена',
                    NotFoundException::NOT_FOUND_PAGE_ERROR);
            }
            echo $this->publicView->render('article.twig');
        } else {
            throw ExceptionFactory::createNotFoundException('Некорретный запрос',
                NotFoundException::NOT_FOUND_ACTION);
        }
    }
}