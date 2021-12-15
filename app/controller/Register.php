<?php

use Core\BaseController\BaseController;

class Register extends BaseController
{
    private $message = "";
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

        if (isset($_POST['register'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'] && !empty($_POST['confirmPassword']) && !empty($_POST['username']))) {

                $userData = array(
                    "password" => $_POST['password'],
                    "confirmPassword" => $_POST['confirmPassword'],
                    "email" => $_POST['email'],
                    "name" => $_POST['username'],
                    "addressLine1" => $_POST['addressLine1'],
                    "addressLine2" => $_POST['addressLine2'],
                    "city" => $_POST['city'],
                    "postalCode" => $_POST['postalCode'],
                    "state" => $_POST['state'],
                    "country" => $_POST['country'],
                );


                if ($userData["password"] == $userData["confirmPassword"]) {
                    $acc_status = $this->userModel->createUser($userData);
                    if ($acc_status == TRUE) {
                        $acc_status = SessionControl::createSession($userData);
                        if ($acc_status == true) {
                            $this->redirectUrl("dashboard");
                        }
                    } else {
                        $this->message = "Already having an account with this data ";
                        $this->index();
                    }
                }
            }
        }
    }
}
