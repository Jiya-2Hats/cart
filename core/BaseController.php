<?php

namespace Core\BaseController;

class BaseController
{
    public function model($model)
    {
        require_once 'app/model/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists('app/views/' . $view . '.php')) {
            require_once 'app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
