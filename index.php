<?php

require __DIR__ . '/autoload.php';

$news = new \Application\Controllers\News();
$action = (isset($_GET['action'])) ? $_GET['action'] : 'Index';

try {
    $news->action($action);
} catch (Exception $e) {
    $news->action('Exception', $e);
}
