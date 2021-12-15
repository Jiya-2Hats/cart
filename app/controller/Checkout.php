<?php

use Core\BaseController\BaseController;

class Checkout extends BaseController
{
    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            $this->redirectUrl("login");
        }
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $data = [];
        if (!empty($_POST['productId'])) {
            $productId = $_POST['productId'];

            $productData = $this->productModel->getCurrentProduct($productId);
            $data = ['productData' => $productData];
            $this->view('Checkout', $data);
        } else {
            $this->redirectUrl("login/logout");
        }
    }
}
