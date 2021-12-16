
<?php

use Core\BaseController\BaseController;

class ProductOrder extends BaseController
{
    private $orderModel = "";

    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            $this->redirectUrl("login");
        }

        $this->orderModel = $this->model('Order');
    }

    public function placeOrder()
    {
        try {
            $getRequest = file_get_contents('php://input');
            $getData = json_decode($getRequest);
            $getData->orderStatus = ORDER_FAILURE_STATUS;
            $placeOrder = $this->orderModel->orderPlaced($getData);
            if ($placeOrder == true) {
                $output = ['status' => ORDER_SUCCESS_MESSAGE];
            } else {
                $output = ['status' => ORDER_FAILURE_MESSAGE];
            }
            json_encode($output);
        } catch (Exception $exception) {
            http_response_code(500);
            echo json_encode($exception->getMessage());
        }
    }
}
