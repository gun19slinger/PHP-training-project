<?php

    require __DIR__ . '/autoload.php';

    if (!empty($_GET) && !isset($_GET['submit'])) {
        if (isset($_GET['idForDelete'])) {
            $news = \Application\Models\News::findById($_GET['idForDelete']);
            $news->delete();
        }elseif (isset($_GET['forInsert'])) {
            include __DIR__ . '/temlates/edit.php';
        }elseif (isset($_GET['idForChange'])) {
            $news = \Application\Models\News::findById($_GET['idForChange']);
            include __DIR__ . '/temlates/edit.php';
        }
    }elseif (!empty($_GET) && isset($_GET['submit'])) {
        if ('' !== $_GET['id']) {
            $news = \Application\Models\News::findById($_GET['id']);
            foreach ($_GET as $key => $val) {
                if ('submit' === $key){
                    continue;
                }
                $news->$key = $val;
            }
            $news->save();
        }elseif ('' === $_GET['id']) {
            $news = new \Application\Models\News();
            foreach ($_GET as $key => $val) {
                if ('submit' === $key || 'id' === $key){
                    continue;
                }
                $news->$key = $val;
            }
            $news->save();
        }
    }else {
        include __DIR__ . '/temlates/index.php';
    }

