<?php

namespace Application\Models;

use Application\Model;

class Author extends Model
{

    const TABLE = 'authors';

    public $name;
    
    public function __construct()
    {
    }

    /**
     * Whether the author is new or not (Create new Author or check the Author`s id) 
     * 
     * @param string $name Author`s name
     * @return mixed null or the authors id
     */
    public static function isNewAuthor(string $name)
    {
        if ('' === $name) {
            return null;
        } else {
            $authors = Author::findAll();
            foreach ($authors as $key => $val) {
                if ($name === $val->name) {
                    $author_id = (int)$val->id;
                    break;
                }
            }
            if (!empty($author_id)) {
                return $author_id;
            } else {
                $author = new Author();
                $author->name = $name;
                $author->save();
                return $author->id;
            }
        }
    }

}