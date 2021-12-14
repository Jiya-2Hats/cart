<?php

use Core\BaseController\BaseController;

class Product extends BaseController
{
    public function __construct()
    {
        if (!SessionControl::checkSession()) {
            header(HEADER_LOCATION . '/login');
            exit;
        }
        $this->productModel = $this->model('Product');
    }
    public function productOrder()
    {
        try {
            $getRequest = file_get_contents('php://input');
            $getData = json_decode($getRequest);

            $placeOrder = $this->productModel->placeOrder($getData);
            if ($placeOrder == true) {
                $output = [
                    'status' => 'success',
                ];
            } else {
                $output = [
                    'status' => 'failed',
                ];
            }
            json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }
}
