<?php

use Payment\Payment\Payment;

class StripePayment implements Payment
{
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

    public function getStatus($getData)
    {
        $status = [
            "paymentStatus" => false,
            "orderStatus" => ORDER_FAILURE_STATUS,
            "orderStatusMessage" => ORDER_FAILURE_MESSAGE
        ];
        try {
            if (isset($getData['redirect_status'])) {
                if ($getData['redirect_status'] == 'succeeded') {
                    $status = [
                        "paymentStatus" => true,
                        "orderStatus" => ORDER_SUCCESS_STATUS,
                        "orderStatusMessage" => ORDER_SUCCESS_MESSAGE,
                        "orderClientSecret" => $getData['payment_intent_client_secret']
                    ];
                }
            }
            return $status;
        } catch (Error $e) {
            return $status;
        }
    }
}
