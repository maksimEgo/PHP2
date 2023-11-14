<?php

namespace src\Controller\Admin;

use JetBrains\PhpStorm\NoReturn;
use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\NotFoundException;
use src\Model\News\Article;
use src\Validator\ArticleDataValidator;

class EditArticleController extends BaseController
{
    public function defaultAction()
    {
        if ('GET' === $_SERVER['REQUEST_METHOD']) {
            $this->handleGet();
        } elseif ('POST' === $_SERVER['REQUEST_METHOD']) {
            $this->handlePost();
        }
    }

    private function handleGet()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            throw new NotFoundException('Неверный ID: ' . $id);
        }

        $article = Article::findById($id);
        if (!$article) {
            throw new NotFoundException('Новость с ID "' . $id .  '" не найдена');
        }

        $this->view->article = $article;
        echo $this->view->render(PathBuilder::getPath(PathConfig::adminTemplatePath) . 'action/edit.php');
    }

    #[NoReturn] private function handlePost()
    {
        if ( ArticleDataValidator::validate($_POST) != null) {
            //Ошибка валидации
            return;
        }

        $article = new Article();
        $article->id = $_POST['id'];
        $article->title = htmlspecialchars($_POST['title']);
        $article->content = htmlspecialchars($_POST['content']);
        $article->author_id = $_POST['author_id'];

        $article->save();

        header('Location: /admin/index.php');
        exit;
    }
}