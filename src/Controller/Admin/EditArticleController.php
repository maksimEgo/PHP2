<?php

namespace src\Controller\Admin;

use src\Config\PathConfig;
use src\Controller\BaseController;

class EditArticleController extends BaseController
{
    protected function defaultAction()
    {
        $article = new \src\Model\News\Article();

        if ( 'GET' === $_SERVER['REQUEST_METHOD'] ) {
            if ( isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) ) {
                $id = $_GET['id'];
                $this->view->article = $article::findById($id);
                if ( !$this->view->article ) {
                    die('Статья не найдена');
                }
                echo $this->view->render(PathConfig::adminTemplatePath->getPath() . 'action/edit.php');
            } else {
                die('Неверный ID статьи');
            }
        } elseif ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
            if ( isset($_POST['id'], $_POST['title'], $_POST['content']) ) {
                $article->id = $_POST['id'];
                $article->title = $_POST['title'];
                $article->content = $_POST['content'];
                $article->author_id = $_POST['author_id'];

                $article->save();

                header('Location: /admin/index.php');
                exit;
            }
        }
    }
}