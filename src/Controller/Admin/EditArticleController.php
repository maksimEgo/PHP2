<?php

namespace src\Controller\Admin;

use JetBrains\PhpStorm\NoReturn;
use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\ExceptionFactory;
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
            throw ExceptionFactory::createNotFoundException('Неверный ID: ' . $id,
                NotFoundException::NOT_FOUND_PAGE_ERROR);
        }

        $article = Article::findById($id);
        if (!$article) {
            throw ExceptionFactory::createNotFoundException('Новость с ID "' . $id . '" не найдена',
                NotFoundException::NOT_FOUND_PAGE_ERROR);
        }

        $this->adminView->article = $article;
        echo $this->adminView->render(PathBuilder::getPath(PathConfig::adminActionEditPage));
    }

    #[NoReturn] private function handlePost()
    {
        if (ArticleDataValidator::validate($_POST) != null) {
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