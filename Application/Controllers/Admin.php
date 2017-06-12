<?php

namespace Application\Controllers;

use Application\Controller;
use Application\Exceptions\MultiException;
use Application\Logger;
use Application\Models\News;
use Application\Models\User;
use Application\RSS\RSS;

class Admin
    extends Controller
{

    protected function actionAdmin()
    {
        $this->view->news = \Application\Models\News::findAll();
        $this->view->display(__DIR__ . '/../../temlates/admin.php');
    }

    protected function actionEdit()
    {
        if (isset($_GET['idForChange'])) {
            $this->view->news = News::findById($_GET['idForChange']);
            $this->view->headline = 'Редактировать';
        } else {
            $this->view->news = new News();
            $this->view->headline = 'Добавить новую';
        }
        $this->view->display(__DIR__ . '/../../temlates/edit.php');
    }

    protected function actionSave()
    {
        if (isset($_GET['idForDelete'])) {
            $news = News::findById($_GET['idForDelete']);
            $news->delete();
            $this->view->operation = 'Статья успешно удалена';
        } elseif (isset($_POST['submit'])) {
            try {
                if ('' === $_POST['id']) {
                    $news = new News();
                    $this->view->operation = 'Статья успешно добавлена';
                } else {
                    $news = News::findById($_POST['id']);
                    $this->view->operation = 'Статья успешно изменена';
                }
                $news->fill($_POST);
                $news->save();
            } catch (MultiException $e) {
                $this->view->exceptions = $e;
                $log = new Logger('DB');
                foreach ($this->view->exceptions as $exception) {
                    $log->provider->put($exception->getMessage());
                }
            }
        }
        $rss = new RSS();
        $rss->createRSS();
        $this->view->display(__DIR__ . '/../../temlates/exception.php');
    }
    
    public function actionUsers()
    {
        $this->view->users = User::findAllLineByLine();
        $this->view->display(__DIR__ . '/../../temlates/users.php');
    }

    public function actionDataTable()
    {
        $models = News::findAll();
        $functions = [
            function ($model) {
                return $model->title;
            },
            function ($model) {
                return $model->article;
            },
            function ($model) {
                if (!empty($model->author_id)) {
                    return $model->getAuthorName();
                }
            }
        ];
        $news = new AdminDataTable($models, $functions);
        $this->view->table = $news->getData();
        $this->view->display(__DIR__ . '/../../temlates/data_table.php');
    }
}