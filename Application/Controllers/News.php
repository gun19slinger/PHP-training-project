<?php

namespace Application\Controllers;

use Application\Captcha\Captcha;
use Application\Controller;
use Application\Exceptions\MultiException;
use Application\Exceptions\NotFound;
use Application\Logger;
use Application\Models\User;
use Application\RSS\RSS;

class News
    extends Controller
{
    protected function actionIndex()
    {
        $this->view->news = array_slice(\Application\Models\News::findAllRevers(), 0, 3);
        $this->view->display(__DIR__ . '/../../temlates/index.php');
    }

    protected function actionOneNews()
    {
        $id = (int)$_GET['id'];
        $this->view->oneNews = \Application\Models\News::findById($id);
        if (!$this->view->oneNews) {
            throw new NotFound;
            $this->view->display(__DIR__ . '/../../temlates/index.php');
        } else {
            $this->view->display(__DIR__ . '/../../temlates/article.php');
        }
    }

    protected function actionRegistration()
    {
        $captcha = new Captcha();
        $this->view->display(__DIR__ . '/../../temlates/registration.php');
    }
    
    protected function actionSaveUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $user = new User();
                $user->addNewUser($_POST);
                $user->save();
                $this->view->operation = 'Вы успешно зарегистрированы';
            } catch (MultiException $e) {
                $this->view->exceptions = $e;
            }
            $this->view->display(__DIR__ . '/../../temlates/exception.php');
        }
    }

    protected function actionRSS()
    {
        $rss = new RSS();
        $this->view->rss_data = $rss->readRSS($_POST['url']);
        $this->view->display(__DIR__ . '/../../temlates/rss.php');
    }

    protected function actionException($e)
    {
        $this->view->exception = $e->getMessage();
        $log = new Logger('Log');
        $log->provider->put('In ' . $e->getFile() . ' on line ' . $e->getLine() . ': ' . $e->getMessage());
        $log->provider->sendLogOnMail();
        $this->view->display(__DIR__ . '/../../temlates/errors.php');
    }
    
}