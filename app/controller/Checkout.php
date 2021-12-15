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
        if (!empty($_POST['productId'])) {
            $productId = $_POST['productId'];
            $productData = $this->productModel->select($productId);
            $data = [
                "css" => ['style.css', 'checkout.css'],
                'js' => ['Config.js']
            ];
            $this->view('Header', $data);
            $data = ['productData' => $productData];
            $this->view('Checkout', $data);
            $data = [
                'js' => ['Checkout.js', 'CheckoutFormTemplate.js']
            ];
            $this->view('Footer', $data);
        } else {
            $this->redirectUrl("login/logout");
        }
    }
}
