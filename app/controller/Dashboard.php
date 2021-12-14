<?php

use Core\BaseController\BaseController;

class Dashboard extends BaseController
{

    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            header(HEADER_LOCATION . '/login');
            exit;
        }

        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $data = ["productData" => $this->productModel->getProductList()];
        $this->view('Home', $data);
    }
}
