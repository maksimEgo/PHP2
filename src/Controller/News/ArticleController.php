<?php

namespace src\Controller\News;

use src\Controller\BaseController;
use src\Exceptions\NotFoundException;

class ArticleController extends BaseController
{
    protected function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
            $this->publicView->article = \src\Model\News\Article::findById($id);

            if (!$this->publicView->article) {
                throw new NotFoundException('Новость с ID "' . $id .  '" не найдена');
            }
            echo $this->publicView->render('article.twig');
        } else {
            echo 'Not corrected request';
        }
    }
}