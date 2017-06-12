<?php

require __DIR__ . '/autoload.php';

$news = new \Application\Controllers\Admin();
$action = (isset($_GET['action'])) ? $_GET['action'] : 'Admin';
$news->action($action);