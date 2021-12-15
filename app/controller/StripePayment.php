<?php

use Core\BaseController\BaseController;

class StripePayment extends BaseController
{
    private $product_amount = 0;
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
        header('Content-Type: application/json');
        $this->productModel = $this->model('Product');
        $this->orderModel = $this->model('Order');
    }

    public function index()
    {
        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            $this->product_amount = $this->getAmount($jsonObj->id);
            if ($this->product_amount != 0) {

                echo json_encode($this->createPaymentIntent());
            }
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function createPaymentIntent()
    {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $this->product_amount,
            'currency' => 'inr',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        $output['clientSecret'] = $paymentIntent->client_secret ??  null;
        return $output;
    }

    private function getAmount($id): int
    {
        $amount = $this->productModel->amount($id);
        if (is_array($amount)) {
            return $amount[0]['amount'] * 100;
        }
        return 0;
    }


    public function productOrder()
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
