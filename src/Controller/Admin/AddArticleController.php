<?php

namespace src\Controller\Admin;

use src\Config\PathConfig;
use src\Controller\BaseController;

class AddArticleController extends BaseController
{
    protected function defaultAction()
    {
        $article = new \src\Model\News\Article();

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (isset($_POST['title'], $_POST['content'])) {
                $article->title = $_POST['title'];
                $article->content = $_POST['content'];

                $article->save();

                header('Location: /admin/index.php');
                exit;
            }
        }

        echo $this->view->render(PathConfig::adminTemplatePath->getPath() . 'action/add.php');
    }
}