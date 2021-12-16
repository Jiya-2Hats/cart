<?php

use Payment\Payment\Payment;

class PaypalPayment implements Payment
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
            "paymentStatus" => true,
            "orderStatus" => ORDER_SUCCESS_STATUS,
            "orderStatusMessage" => ORDER_SUCCESS_MESSAGE,
            "orderClientSecret" => $getData['payment_intent_client_secret']
        ];
        return $status;
    }
}
