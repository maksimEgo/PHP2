<?php

namespace src\Controller\Admin;

use src\Controller\BaseController;

class DeleteArticleController extends BaseController
{

    protected function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) ) {
            $id = $_GET['id'];
            $article = \src\Model\News\Article::findById($id);

            if ($article) {
                $article->delete();
            }

            header('Location: /admin/index.php');
            exit;
        }
    }
}