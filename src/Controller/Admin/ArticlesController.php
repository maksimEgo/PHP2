<?php

namespace src\Controller\Admin;

use src\Config\PathConfig;
use src\Controller\BaseController;

class ArticlesController extends BaseController
{
    protected function defaultAction()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'edit':
                    $editController = new EditArticleController();
                    $editController->defaultAction();
                    return;
                case 'add':
                    $addController = new AddArticleController();
                    $addController->defaultAction();
                    return;
                case 'delete':
                    if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                        $this->deleteAction($_GET['id']);
                        return;
                    }
                    header('Location: /admin/index.php');
                    exit;
            }
        }
        $this->view->articles = \src\Model\News\Article::findAll();
        echo $this->view->render(PathConfig::adminTemplatePath->getPath() . 'index.php');
    }

    protected function deleteAction(int $id)
    {
        $article = \src\Model\News\Article::findById($id);

        if ($article) {
            $article->delete();
        }

        header('Location: /admin/index.php');
        exit;
    }

}