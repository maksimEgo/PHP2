<?php

namespace src\Controller\Admin;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Validator\ArticleDataValidator;

class AddArticleController extends BaseController
{
    protected function defaultAction()
    {
        $article = new \src\Model\News\Article();

        if ('POST' === $_SERVER['REQUEST_METHOD']) {

            if (ArticleDataValidator::validate($_POST) != null) {
                //Ошибка валидации
                return;
            }
            $article->title = htmlspecialchars($_POST['title']);
            $article->content = htmlspecialchars($_POST['content']);
            $article->author_id = 1;

            $article->save();

            header('Location: /admin/index.php');
            exit;

        }

        echo $this->adminView->render(PathBuilder::getPath(PathConfig::adminActionAddPage));
    }
}