<?php

use Core\BaseController\BaseController;

class Checkout extends BaseController
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

        $data = [];

        if (!empty($_POST['productId'])) {
            $productId = $_POST['productId'];

            $productData = $this->productModel->getCurrentProduct($productId);
            $data = ['productData' => $productData];
            $this->view('Checkout', $data);
        } else {
            header(HEADER_LOCATION . '/login/logout');
            exit;
        }
    }


    public function checkoutSuccess()
    {
        $data = [];
        if (isset($_GET['redirect_status'])) {
            if ($_GET['redirect_status'] == 'succeeded') {
                $status = $this->productModel->UpdateOrderStatus(1, $_GET['payment_intent_client_secret']);
                $data['status'] = $status ?  $_GET['redirect_status'] : [];
            }
        }
        $this->view("CheckoutSuccess", $data);
    }
}
