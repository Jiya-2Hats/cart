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
        $data = ["css" => ['style.css', 'checkout.css']];
        $this->view('Header', $data);
        $this->orderModel = $this->model("Order");
        $orderList = $this->orderModel->listOrders();
        $data = ['orderList' => $orderList];
        $this->view('admin/Orders', $data);
        $this->view('Footer');
    }
}
