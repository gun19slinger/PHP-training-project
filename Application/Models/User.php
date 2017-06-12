<?php

namespace Application\Models;

use Application\Exceptions\MultiException;
use Application\Model;

class User extends Model
    implements HasEmail
{

    const TABLE = 'users';

    public $name;
    public $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setName(string $name)
    {
        $this->name = trim($name);
    }

    public function setEmail(string $email)
    {
        $this->email = trim($email);
    }

    public function checkForm(array $array)
    {
        $e = new MultiException();
        session_start();
        $captcha = $_SESSION['captcha'];

        if ('' === $array['name']) {
            $e[] = new \Exception('Вы не указали свое имя');
        }
        if ('' === $array['email']) {
            $e[] = new \Exception('Вы не указали свой email');
        } elseif (!filter_var($array['email'], FILTER_VALIDATE_EMAIL)) {
            $e[] = new \Exception('Вы ввели некорректный email');
        }
        if ('' === $array['captcha']) {
            $e[] = new \Exception('Вы не ввели текст с картинки');
        } elseif ($array['captcha'] !== $captcha) {
            $e[] = new \Exception('Вы ввели неправильный текст');
        }

        if (!$e->isEmpty()) {
            throw $e;
        }

        session_destroy();

    }

    public function addNewUser(array $array)
    {
        $this->checkForm($array);
        $this->setName($array['name']);
        $this->setEmail($array['email']);

    }

}