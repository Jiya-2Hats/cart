<?php

class Core
{

  protected $currentController;
  protected $currentMethod;
  protected $params;

  public function __construct()
  {
    $this->currentController = DEFAULT_CONTROLLER;
    $this->currentMethod = DEFAULT_METHOD;
    $this->params = DEFAULT_PARAMETERS;
    $this->currentService = "";
    $path = $this->getPath();
    if (ucwords($path[0]) == "service") {

      if (file_exists('app/service/' . $path[1] . ucwords($path[2]) . '.php')) {
        $this->currentService = ucwords($path[2]);
        unset($path);
        require_once 'app/service/' . $this->currentService . '.php';
        $this->currentService = new $this->currentService;
        call_user_func_array([$this->currentService, 'index'], []);
      }
    }

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

      require_once 'app/controller/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
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
