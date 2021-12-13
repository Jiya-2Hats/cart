<?php

class Core
{

  protected $currentController = 'Login';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {

    $path = $this->getPath();

    if (file_exists('app/controller/' . ucwords($path[0]) . '.php')) {
      $this->currentController = ucwords($path[0]);
      unset($path[0]);
      require_once 'app/controller/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;
      if (isset($path[1])) {
        if (method_exists($this->currentController, $path[1])) {
          $this->currentMethod = $path[1];
          unset($path[1]);
        }
      }
      $this->params = $path ? array_values($path) : [];
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    } else {
      echo "Page not Found";
    }
  }

  public function getPath()
  {
    if (isset($_GET['path'])) {
      $path = rtrim($_GET['path'], '/');
      $path = explode('/', filter_var($path, FILTER_SANITIZE_URL));
      return  $path;
    }
  }
}
