<?php

namespace Application;

class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action, $e = null)
    {
        $methodName = 'action' . $action;
        return $this->$methodName($e);
    }

}