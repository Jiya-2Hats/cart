<?php

use Payment\Payment\Payment;

class StripePayment implements Payment
{
    private $product_amount = 0;
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(PAYMENT_API_KEY);
    }

    public function createPaymentIntent($amount)
    {
        try {

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'inr',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            $output['clientSecret'] = $paymentIntent->client_secret ??  null;
            return $output;
        } catch (Error $e) {
            $output = ['error' => $e->getMessage()];
            return $output;
        }
    }

    public function getStatus()
    {
        $status = [
            "paymentStatus" => false,
            "orderStatus" => ORDER_FAILURE_STATUS,
            "orderStatusMessage" => ORDER_FAILURE_MESSAGE
        ];
        try {
            if (isset($_GET['redirect_status'])) {
                if ($_GET['redirect_status'] == 'succeeded') {
                    $status = [
                        "paymentStatus" => true,
                        "orderStatus" => ORDER_SUCCESS_STATUS,
                        "orderStatusMessage" => ORDER_SUCCESS_MESSAGE,
                        "orderClientSecret" => $_GET['payment_intent_client_secret']
                    ];
                }
            }
            return $status;
        } catch (Error $e) {
            return $status;
        }
    }
}
