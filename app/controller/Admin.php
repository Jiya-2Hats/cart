<?php

use Core\BaseController\BaseController;

class Admin extends BaseController
{
    private $orderModel;
    public function __construct()
    {
    }

    public function index()
    {
        $data = ["css" => ['style.css', 'checkout.css']];
        $this->view('Header', $data);
        $this->view('admin/Home');
        $this->view('Footer');
    }

    public function orderList()
    {
        $data = [
            "css" => ['bootstrap/twitter/bootstrap.min.css', 'bootstrap/datatables/dataTables.bootstrap5.min.css'],
            "js" => ['datatables/jquery-3.5.1.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap5.min.js', 'datatables/orders.js']
        ];

        $this->view('Header', $data);
        $this->orderModel = $this->model("Order");
        $orderList = $this->orderModel->listOrders();
        $this->orderService = $this->service('admin/OrderValidation');
        $this->orderService->validate($orderList);
        $data = ['orderList' => $orderList];
        $this->view('admin/Orders', $data);
        $this->view('Footer');
    }
}
