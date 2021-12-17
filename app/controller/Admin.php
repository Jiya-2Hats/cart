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
        // $data = ["css" => ['style.css', 'checkout.css']];
        // $this->view('Header', $data);
        // $this->view('admin/AdminHeader');
        // $this->view('admin/Home');
        // $this->view('admin/AdminFooter');
        // $this->view('Footer');
        $this->orderList();
    }
    public function changeSettings()
    {
        $data = ["css" => ['style.css', 'checkout.css']];
        $this->view('Header', $data);
        $this->view('admin/AdminHeader');
        $this->view('admin/ChangeSettings');
        $this->view('admin/AdminFooter');
        $this->view('Footer');
    }

    public function orderList()
    {
        $data = [
            "css" => ['bootstrap/twitter/bootstrap.min.css', 'bootstrap/datatables/dataTables.bootstrap5.min.css'],
            "js" => ['datatables/jquery-3.5.1.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap5.min.js', 'datatables/orders.js']
        ];

        $this->view('Header', $data);
        $this->view('admin/AdminHeader');
        $this->orderModel = $this->model("Order");
        $this->fraudMailModel = $this->model("FraudMail");
        $orderList = $this->orderModel->listOrders();
        $fraudMailList = $this->fraudMailModel->list();
        $this->orderService = $this->service('admin/OrderValidation');
        $orderList =  $this->orderService->validate($orderList, $fraudMailList);
        $data = ['orderList' => $orderList];
        $this->view('admin/Orders', $data);
        $this->view('admin/AdminFooter');
        $this->view('Footer');
    }
}
