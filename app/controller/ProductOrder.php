
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
            $this->fraudMailModel = $this->model("FraudMail");
            $fraudMailList = $this->fraudMailModel->list();
            $this->googleModel = $this->model("Google");
            $key = $this->googleModel->key();
            $this->orderService = $this->service('admin/OrderValidation');
            $address = $getData->shipLine1 . $getData->shipLine2 . $getData->shipCity . $getData->shipState . $getData->shipCountry . $getData->shipPostalCode;
            $validateData = ['address' => $address, 'email' => $getData->email];
            $violationList =  $this->orderService->validateEmailAndAddresss($validateData, $fraudMailList, $key);
            $placeOrder = $this->orderModel->orderPlaced($getData, $violationList);
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

    public function update()
    {
        if (isset($_POST)) {
            var_dump($_POST);
        }
    }
}
