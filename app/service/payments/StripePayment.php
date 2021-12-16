<?php



use Core\BaseController\BaseController;

class StripePayment
{
    private $product_amount = 0;
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
        header('Content-Type: application/json');
    }

    public function index($amount)
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

    public function createIntent()
    {
    }
    public function statusUpdate()
    {
    }
}
