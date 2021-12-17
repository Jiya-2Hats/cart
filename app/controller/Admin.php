<?php

use Core\BaseController\BaseController;

class Admin extends BaseController
{
    private $orderModel;
    private $fraudMailModel;
    private $googleModel;
    public function __construct()
    {

        $this->fraudMailModel = $this->model("FraudMail");
        $this->googleModel = $this->model("Google");
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
        $data['apiKey'] = $this->googleModel->key();
        $fraudMailList = $this->fraudMailModel->list();
        $fraudMailList = array_column($fraudMailList, 'email');

        $data['emailList'] = implode(',', $fraudMailList);
        $this->view('admin/ChangeSettings', $data);
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
        $orderList = $this->orderModel->listOrders();
        $fraudMailList = $this->fraudMailModel->list();
        $this->orderService = $this->service('admin/OrderValidation');
        $orderList =  $this->orderService->validate($orderList, $fraudMailList);
        $data = ['orderList' => $orderList];
        $this->view('admin/Orders', $data);
        $this->view('admin/AdminFooter');
        $this->view('Footer');
    }

    public function saveMailList()
    {
        if ($_POST['submitList']) {
            $emailList = $this->getEmailListArray($_POST['emailList']);

            $status = $this->fraudMailModel->insert($emailList);
            $data['status'] = $status ? "List Saved" : [];
            $this->changeSettings();
        }
    }
    private function getEmailListArray($emailList)
    {
        $emailList = explode(',', $emailList);
        foreach ($emailList as $key => $listItem) {
            if (!filter_var($listItem, FILTER_VALIDATE_EMAIL)) {
                unset($emailList[$key]);
            }
        }
        return $emailList;
    }

    public function savekey()
    {
        if ($_POST['submitKey']) {

            $status = $this->googleModel->insert($_POST['key']);
            $data['status'] = $status ? "Saved" : [];
            $this->changeSettings();
        }
    }
}