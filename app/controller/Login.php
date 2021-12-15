<?php

use Core\BaseController\BaseController;

class Login extends BaseController
{
    private $message = "";
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index($page = "")
    {

        if (SessionControl::checkSession()) {
            $this->redirectUrl("dashboard");
        }


        $data = ["message" => $this->message];
        $this->view('Login', $data);
    }

    public function validateUser()
    {
        try {
            if (isset($_POST['login'])) {

                if (!empty(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && !empty($_POST['password'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $acc_status = $this->userModel->validateLogin($email, $password);
                    if ($acc_status == TRUE) {
                        $this->redirectUrl("dashboard");
                    } else {
                        $this->message = "Invalid credientials";
                        $data = ["message" => $this->message];
                    }
                } else {
                    $this->message = "Please provide valid credientials";
                    $this->index();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function validateGuest()
    {
        try {
            $GuestData = ['email' => GUEST_EMAIL, 'name' => GUEST_NAME];
            $acc_status = SessionControl::createSession($GuestData);
            if ($acc_status == TRUE) {
                $this->redirectUrl("dashboard");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        SessionControl::sessionDestroy();
        $this->redirectUrl("login");
    }
}
