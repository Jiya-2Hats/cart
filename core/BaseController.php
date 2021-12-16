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

    public function redirectUrl($path)
    {
        header(HEADER_LOCATION . "/" . $path);
        exit;
    }

    public function service($serviceFile)
    {

        if (file_exists('app/service/' . $serviceFile . '.php')) {
            require_once 'app/service/' . $serviceFile . '.php';

            $serviceFile = explode('/', filter_var($serviceFile, FILTER_SANITIZE_URL));
            $serviceFile = end($serviceFile);

            return new $serviceFile();
        } else {
            die("Service does not exists.");
        }
    }
}
