<?php

use Core\BaseController\BaseController;

class ProductOrder extends BaseController
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

        try {
            $getRequest = file_get_contents('php://input');
            $getData = json_decode($getRequest);

            $placeOrder = $this->productModel->orderPlaced($getData);
            if ($placeOrder == true) {
                $output = [
                    'status' => 'success',
                ];
            } else {
                $output = [
                    'status' => 'failed',
                ];
            }
            json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
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
