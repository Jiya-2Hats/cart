<?php

class User extends BaseModel
{

    public function validateUser($email, $pswd)
    {
        $sql2 = "select * from users where email=:email";
        $this->prepare($sql2);
        $this->bindParameter(':email', $email);
        $result = $this->execute();
        echo $count = $result->rowCount();

        if ($count > 0) {
            $result = $this->resultSet(PDO::FETCH_ASSOC);

            if (password_verify($pswd, $result[0]['password'])) {

                $name = $result[0]['name'];
                // session_start();
                // $_SESSION['email'] = $email;
                // $_SESSION['username'] = $name;
                // $_SESSION['sessionFlag'] = 1;
                // $ses = SessionCheck::createSession($result[0]);
                // return $ses;
                return true;
            }
        } else {
            return false;
        }
    }
}
