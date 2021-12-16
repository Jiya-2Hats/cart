<?php

use Core\BaseController\BaseController;

class Dashboard extends BaseController
{
    private $productModel;
    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            $this->redirectUrl("login");
        }

        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        try {
            $data = ["css" => ['style.css', 'checkout.css']];
            $this->view('Header', $data);
            $data = ["productData" => $this->productModel->list()];
            $this->view('Home', $data);
            $this->view('Footer');
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
