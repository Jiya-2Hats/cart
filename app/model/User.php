<?php

class User extends BaseModel
{

    public function validateLogin($email, $password)
    {
        $sql2 = "select * from users where email=:email";
        $this->prepare($sql2);
        $this->bindParameter(':email', $email);
        $result = $this->execute();
        $count = $this->rowCount();

        if ($count > 0) {
            $result = $this->resultSet(PDO::FETCH_ASSOC);

            if (password_verify($password, $result[0]['password'])) {

                return SessionControl::createSession($email, $result[0]['name']);
            }
        } else {
            return false;
        }
    }
}
