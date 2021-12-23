<?php

use Core\BaseController\BaseController;

class Admin extends BaseController
{
    private $orderModel;
    private $fraudMailModel;
    private $googleModel;
    private $status = "";
    private $apiStatus = "";

    public function __construct()
    {
        $this->fraudMailModel = $this->model("FraudMail");
        $this->googleModel = $this->model("Google");
    }

    public function index()
    {
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
        $data['status'] = $this->status;
        $data['apiStatus'] = $this->apiStatus;
        $this->view('admin/ChangeSettings', $data);
        $this->view('admin/AdminFooter');
        $this->view('Footer');
    }

    public function orderList()
    {
        $data = [
            "css" => ['bootstrap/twitter/bootstrap.min.css', 'bootstrap/dataTables.bootstrap5.min.css', 'style.css'],
            "js" => ['datatables/jquery-3.5.1.js', 'datatables/jquery.dataTables.min.js', 'datatables/dataTables.bootstrap5.min.js', 'datatables/orders.js', 'Admin.js']
        ];

        $this->view('Header', $data);
        $this->view('admin/AdminHeader');

        $this->orderModel = $this->model("Order");
        $orderList = $this->orderModel->listWithViolation();
        $data = ['orderList' => $orderList, 'status' => $this->status];
        $this->view('admin/Orders', $data);
        $this->view('admin/AdminFooter');
        $this->view('Footer');
    }

    public function saveMailList()
    {
        if ($_POST['submitList']) {
            $emailList = $this->getEmailListArray($_POST['emailList']);
            $status = $this->fraudMailModel->insert($emailList);
            $this->status = $status ? "Email List Saved" : [];
            $this->changeSettings();
        }
    }
    private function getEmailListArray($emailList)
    {
        $emailList = rtrim($emailList, ',');
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
            $this->apiStatus = $status ? "Api Key Updated" : [];
            $this->changeSettings();
        }
    }

    public function updateOrder()
    {
        if (isset($_POST)) {
            $updateOrderData = [
                'id' => $_POST['orderId'],
                'email' => $_POST['email'],
                'shipLine1' => $_POST['shippingLine1'],
                'shipLine2' => $_POST['shippingLine2'],
                'shipCity' => $_POST['shippingCity'],
                'shipCountry' => $_POST['shippingCountry'],
                'shipPostalCode' => $_POST['shippingPostalCode'],
            ];



            $this->fraudMailModel = $this->model("FraudMail");
            $fraudMailList = $this->fraudMailModel->list();
            $this->googleModel = $this->model("Google");
            $key = $this->googleModel->key();
            $this->orderService = $this->service('admin/OrderValidation');
            $address = trim($updateOrderData['shipLine1']) . " " . trim($updateOrderData['shipLine2']) . ", " . trim($updateOrderData['shipCity']) . ", " . trim($updateOrderData['shipPostalCode']) . ", " .  trim($updateOrderData['shipCountry']);
            $validateData = ['address' => $address, 'email' => $updateOrderData['email']];
            $violationList =  $this->orderService->validateEmailAndAddresss($validateData, $fraudMailList, $key);
            $this->orderModel = $this->model('Order');
            $updateStatus = $this->orderModel->updateOrderById($updateOrderData, $violationList);
            $this->status = $updateStatus ? "Order Updated" : "";

            $this->redirectUrl('admin');
        }
    }

    public function editOrder()
    {
        try {
            $getRequest = file_get_contents('php://input');
            $getData = json_decode($getRequest);
            $this->orderModel = $this->model('Order');
            $orderData = $this->orderModel->getOrderById($getData->id);
            echo json_encode($orderData);
        } catch (Exception $exception) {
            http_response_code(500);
            echo json_encode($exception->getMessage());
        }
    }
}
