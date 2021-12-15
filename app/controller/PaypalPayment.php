<?php

use Core\BaseController\BaseController;

class PaypalPayment extends BaseController
{

    public function index()
    {
        try {

            if ($this->product_amount != 0) {
                $output['clientSecret'] = "successClientSecret" ??  null;
                echo json_encode($output);
            }
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
