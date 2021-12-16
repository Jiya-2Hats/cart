<?php

use Core\BaseController\BaseController;

class Checkout extends BaseController
{
    private  $paymentService = "";
    private $productModel;
    private $orderModel;

    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            $this->redirectUrl("login");
        }
        $this->paymentService = $this->service('payments/' . PAYMENT_GATEWAY . 'Payment');
        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
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
            unset($data);
            $data = [
                'js' => PAYMENT_GATEWAY_JS
            ];
            $this->view('Footer', $data);
        } else {
            $this->redirectUrl("login/logout");
        }
    }

    public function initialise()
    {
        $jsonObj = json_decode(file_get_contents('php://input'));
        $this->product_amount = $this->getAmount($jsonObj->id);
        if ($this->product_amount != 0) {

            $serviceStatus =  $this->paymentService->createPaymentIntent($this->product_amount);
            if (isset($serviceStatus['error'])) {
                http_response_code(500);
            }
            echo  json_encode($serviceStatus);
        }
    }

    private function getAmount($id): int
    {
        $amount = $this->productModel->amount($id);
        if (is_array($amount)) {
            return $amount[0]['amount'] * 100;
        }
        return 0;
    }

    public function successPaymentURL()
    {
        try {
            $data = [];
            $this->view('Header', $data);

            $orderStatus = $this->paymentService->getStatus($_GET);

            if ($orderStatus['paymentStatus']) {
                $status = $this->orderModel->updateStatus($orderStatus['orderStatus'], $orderStatus['orderClientSecret']);
                $data['status'] = $status ? $orderStatus['orderStatusMessage'] : [];
            }

            $this->view("CheckoutSuccess", $data);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }
}
