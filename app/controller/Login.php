<?php

use Core\BaseController\BaseController;

class Login extends BaseController
{
    private $message = "";
    private $email;
    private $password;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index($page = "")
    {
        if (SessionControl::checkSession()) {
            $this->redirectUrl("dashboard");
        }
        $data = ["css" => ['login.css']];
        $this->view('Header', $data);
        $data = ["message" => $this->message];
        $this->view('Login', $data);
        $this->view('Footer');
    }

    public function validateUser()
    {
        try {
            if (isset($_POST['login'])) {
                $this->email = $_POST['email'];
                $this->password = $_POST['password'];
                if ($this->validateLoginInput()) {
                    $acc_status = $this->userModel->validateUserAndInitializeSession($this->email, $this->password);
                    if ($acc_status == TRUE) {
                        $this->redirectUrl("dashboard");
                    } else {
                        $this->message = "Invalid credientials";
                        $this->index();
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

    private function validateLoginInput()
    {
        return ($this->validateEmail() && $this->validatePassword()) ? true : false;
    }

    private function validateEmail()
    {
        return (!empty(filter_var($this->email, FILTER_VALIDATE_EMAIL))) ? true : false;
    }

    private function validatePassword()
    {
        return (!empty($this->password)) ? true : false;
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
