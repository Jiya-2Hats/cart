<?php

use Core\BaseModel\BaseModel;

class User extends BaseModel
{

    public function validateUserAndInitializeSession($email, $password)
    {
        try {
            $sql2 = "select name,password,email,phone,address_line1,address_line2,city,state,country,postal_code from users where email=:email";
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
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function createUser($userData)
    {
        try {
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            unset($userData['confirmPassword']);

            $sql = "INSERT INTO users (email, name, password,phone,address_line1,address_line2,city,state,country,postal_code) 
                VALUES (:email, :name, :password,:phoneNumber,:addressLine1,:addressLine2,:city,:state,:country,:postalCode) ";
            $this->prepare($sql);
            $this->bindPDOParameter($userData);
            $result = $this->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    private function bindPDOParameter($userData)
    {
        foreach ($userData as $userKey => $userValue) {
            $this->bindParameter(':' . $userKey, $userValue);
        }
    }
}
