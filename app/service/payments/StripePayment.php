<?php



use Core\BaseController\BaseController;

class StripePayment implements Payment
{
    private $product_amount = 0;
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);
        header('Content-Type: application/json');
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
        $amount = 500;
        if (is_array($amount)) {
            return $amount[0]['amount'] * 100;
        }
        return 0;
    }

    public function createIntent()
    {
    }
    public function statusUpdate()
    {
    }
}
