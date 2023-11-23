<?php

namespace src\Controller\Admin;

use src\Controller\BaseController;
use src\Exceptions\ExceptionFactory;
use src\Exceptions\NotFoundException;
use src\Model\News\Article;

class DeleteArticleController extends BaseController
{

    protected function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
            $id = $_GET['id'];
            $article = Article::findById($id);

            if (!$article) {
                throw ExceptionFactory::createNotFoundException('Новость с ID ' . $id . ' не найдена',
                    NotFoundException::NOT_FOUND_PAGE_ERROR);
            }

            $article->delete();

            header('Location: /admin/index.php');
            exit;
        }
    }
}