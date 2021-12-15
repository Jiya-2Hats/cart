<?php

use Core\BaseModel\BaseModel;

class User extends BaseModel
{

    public function validateUserAndInitializeSession($email, $password)
    {
        try {
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
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createUser($userData)
    {
        if (!ctype_alpha($userData['name'])) {
            return false;
        }

        $email = $userData['email'];
        $name = $userData['name'];

        $address_line1 = $userData['addressLine1'];
        $address_line2 = $userData['addressLine1'];
        $city = $userData['city'];
        $postal_code = $userData['postalCode'];
        $state = $userData['state'];
        $country = $userData['country'];

        $pswd = password_hash($userData['password'], PASSWORD_DEFAULT);
        try {

            $sql = "INSERT INTO users (email, name, password,address_line1,address_line2,city,state,country,postal_code) 
                VALUES (:email, :name, :password,:address_line1,:address_line2,:city,:state,:country,:postal_code) ";
            $stmt = $this->prepare($sql);
            $this->bindParameter(':email', $email);
            $this->bindParameter(':name', $name);
            $this->bindParameter(':password', $pswd);
            $this->bindParameter(':address_line1', $address_line1);
            $this->bindParameter(':address_line2', $address_line2);
            $this->bindParameter(':city', $city);
            $this->bindParameter(':state', $state);
            $this->bindParameter(':country', $country);
            $this->bindParameter(':postal_code', $postal_code);
            $result = $this->execute();

            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}
