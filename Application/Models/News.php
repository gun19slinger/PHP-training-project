<?php

namespace Application\Models;

use Application\Exceptions\MultiException;
use Application\Model;

class News extends Model
{
    const TABLE = 'news';

    public $title;
    public $article;
    public $author_id;
    private $author = null;

    public function __construct()
    {
        if ($this->author_id !== null) {
            $this->author = Author::findById((int)$this->author_id);
        }
    }

    public function setTitle(string $title)
    {
        $this->title = trim(strip_tags($title));
    }

    public function setArticle(string $article)
    {
        $this->article = trim(strip_tags($article));
    }

    public function setAuthorId(string $author_name)
    {
        $this->author_id = Author::isNewAuthor(trim(strip_tags($author_name)));
    }

    public function fill(array $array)
    {
        $e = new MultiException();
        if ('' === $array['title'] || '' === $array['article']) {
            if ('' === $array['title']) {
                $e[] = new \Exception('Вы не указали заголовок статьи');
            }
            if ('' === $array['article']) {
                $e[] = new \Exception('Вы не добавили текст статьи');
            }
            throw $e;
        }
        $this->setTitle($array['title']);
        $this->setArticle($array['article']);
        $this->setAuthorId($array['author_name']);
    }

    public function getAuthorName()
    {
        return $this->author->name;
    }

}