<?php

use Core\BaseController\BaseController;

class Register extends BaseController
{
    private $message = "";
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index($page = "")
    {
        $this->view('Header');
        $data = ["message" => $this->message];
        $this->view('Register', $data);
    }

    public function registerUser()
    {
        try {
            if (!isset($_POST['register'])) {
                $this->redirectUrl('register');
            }
            if (!$this->checkRequiredRegisterInput()) {
                $statusMessage = "Required fields cannot be empty";
                $this->retryRegisteration($statusMessage);
            }

            $userData = array(
                "password" => $_POST['password'],
                "confirmPassword" => $_POST['confirmPassword'],
                "email" => $_POST['email'],
                "name" => $_POST['username'],
                "phoneNumber" => $_POST['phoneNumber'],
                "addressLine1" => $_POST['addressLine1'],
                "addressLine2" => $_POST['addressLine2'],
                "city" => $_POST['city'],
                "postalCode" => $_POST['postalCode'],
                "state" => $_POST['state'],
                "country" => $_POST['country'],
            );

            if ($userData["password"] != $userData["confirmPassword"]) {

                $statusMessage = "Password Doesn't match";
                $this->retryRegisteration($statusMessage);
            }
            $acc_status = $this->userModel->createUser($userData);
            if ($acc_status == TRUE) {
                $acc_status = SessionControl::createSession($userData);
                if ($acc_status == true) {
                    $this->redirectUrl("dashboard");
                }
            } else {
                $statusMessage = "Already having an account with this data ";
                $this->retryRegisteration($statusMessage);
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function retryRegisteration($message)
    {
        $this->message = $message;
        $this->index();
        exit;
    }

    public function checkRequiredRegisterInput()
    {
        return (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST['username'])) ? true : false;
    }
}
