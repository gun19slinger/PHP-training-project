<?php

namespace Application\Controllers;

use Application\Controller;
use Application\View;

class AdminDataTable extends Controller
{

    public $data = [];

    public function __construct(array $models, array $functions)
    {
        foreach ($models as $model) {
            $array = [];
            foreach ($functions as $function){
                $array[] = $function($model);
            }
            $this->data[] = $array;
        }
        $this->view = new View();
    }

    public function getData()
    {
        return $this->data;
    }
}