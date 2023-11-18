<?php

namespace src\Controller\Admin;

use src\Builder\PathBuilder;
use src\Config\PathConfig;
use src\Controller\BaseController;
use src\Exceptions\NotFoundException;

class ArticlesController extends BaseController
{
    public function defaultAction()
    {
        try {
            $this->adminView->articles = \src\Model\News\Article::findAll();
            echo $this->adminView->render(PathBuilder::getPath(PathConfig::adminTemplatePath) . 'index.php');
        } catch (NotFoundException $notFoundException) {
            throw new NotFoundException('Новости не найдены');
        }
    }
}