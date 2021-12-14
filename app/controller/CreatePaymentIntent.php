<?php

use Core\BaseController\BaseController;

class CreatePaymentIntent extends BaseController
{


    public function __construct()
    {
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
        header('Content-Type: application/json');
        $this->productModel = $this->model('Product');
    }

    private function getAmount($id): int
    {
        $amount = $this->productModel->getProductAmount($id);
        if (is_array($amount)) {
            return $amount[0]['amount'] * 100;
        }
        return 0;
    }

    public function index()
    {
        try {

            $jsonStr = file_get_contents('php://input');

            $jsonObj = json_decode($jsonStr);

            $product_amount = $this->getAmount($jsonObj->id);
            if ($product_amount != 0) {
                $paymentIntent = \Stripe\PaymentIntent::create([

                    'amount' => $product_amount,
                    'currency' => 'inr',
                    'automatic_payment_methods' => [
                        'enabled' => true,
                    ],
                ]);

                $output = [
                    'clientSecret' => $paymentIntent->client_secret,
                ];
            } else {
                $output = [
                    'clientSecret' => null,
                ];
            }

            echo json_encode($output);
        } catch (Error $e) {

            http_response_code(500);

            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
