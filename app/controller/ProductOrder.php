<?php

use Core\BaseController\BaseController;

class ProductOrder extends BaseController
{
    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            $this->redirectUrl("login");
        }
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        try {
            $getRequest = file_get_contents('php://input');
            $getData = json_decode($getRequest);
            $getData->orderStatus = $this->getOrderFailureStatus();
            $placeOrder = $this->orderModel->orderPlaced($getData);
            if ($placeOrder == true) {
                $output = $this->getOrderSuccessMessage('status');
            } else {
                $output = $this->getOrderFailureMessage('failed');
            }
            json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    public function updateOrderOnCheckoutSuccess()
    {
        try {
            $data = [];
            $this->view('Header', $data);
            if (isset($_GET['redirect_status'])) {
                if ($_GET['redirect_status'] == 'succeeded') {
                    $status = $this->orderModel->updateStatus($this->getOrderSuccessStatus(), $_GET['payment_intent_client_secret']);
                    $data['status'] = $status ?  $_GET['redirect_status'] : [];
                }
            }

            $this->view("CheckoutSuccess", $data);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }

    private function getOrderSuccessStatus()
    {
        return ORDER_SUCCESS_STATUS;
    }
    private function getOrderFailureStatus()
    {
        return ORDER_FAILURE_STATUS;
    }

    private function getOrderSuccessMessage($messageIndex)
    {
        $orderStatus = [$messageIndex => ORDER_SUCCESS_MESSAGE];
        return $orderStatus;
    }

    private function getOrderFailureMessage($messageIndex)
    {
        $orderStatus = [$messageIndex => ORDER_FAILURE_MESSAGE];
        return $orderStatus;
    }
}
