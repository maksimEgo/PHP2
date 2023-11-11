<?php

namespace src\Controller\News;

use src\Config\PathConfig;
use src\Controller\BaseController;

class ArticleController extends BaseController
{
    protected function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
            $this->view->article = \src\Model\News\Article::findById($id);

            if (!$this->view->article) {
                echo 'Article not found';
                return;
            }
            echo $this->view->render(PathConfig::baseTemplatePath->getPath() . 'article.php');
        } else {
            echo 'Not corrected request';
        }
    }

}