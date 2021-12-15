<?php

use Core\BaseModel\BaseModel;

class User extends BaseModel
{

    public function validateUserAndInitializeSession($email, $password)
    {
        $sql2 = "select name,password,email,address_line1,address_line2,city,state,country,postal_code from users where email=:email";
        $this->prepare($sql2);
        $this->bindParameter(':email', $email);
        $result = $this->execute();
        $count = $this->rowCount();

        if ($count > 0) {
            $result = $this->resultSet(PDO::FETCH_ASSOC);

            if (password_verify($password, $result[0]['password'])) {

                return SessionControl::createSession($result[0]);
            }
        } else {
            return false;
        }
    }
}
