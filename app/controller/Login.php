<?php
class Login extends BaseController
{
    private $message = "";
    public function __construct()
    {
        if (isset($_SESSION['sessionFlag'])) {
            header('Location: dashboard.php');
            exit;
        }
        $this->model('User');
    }

    public function index()
    {

        $data = ["message" => $this->message];

        $this->view('login', $data);
    }

    public function validateUser()
    {
        if (isset($_POST['login'])) {

            if (!empty(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                // $acc_status = LoginUser::validateUser($email, $_POST['password']);
                $acc_status = $this->validateUser($email, $password);
                if ($acc_status == TRUE) {
                    header('Location: dashboard.php');
                    exit;
                } else {

                    $this->message = "Invalid credientials";
                    $this->index();
                }
            } else {
                $this->message = "Please provide valid credientials";
                $this->index();
            }
        }
    }
}
