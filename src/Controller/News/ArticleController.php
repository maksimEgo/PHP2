<?php

namespace src\Controller\News;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\NotFoundException;

class ArticleController extends BaseController
{
    protected function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
            $this->view->article = \src\Model\News\Article::findById($id);

            if (!$this->view->article) {
                throw new NotFoundException('Новость с ID "' . $id .  '" не найдена');
            }
            echo $this->view->render(PathBuilder::getPath(PathConfig::baseTemplatePath) . 'article.php');
        } else {
            echo 'Not corrected request';
        }
    }
}