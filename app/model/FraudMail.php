<?php

use Core\BaseModel\BaseModel;

class FraudMail extends BaseModel
{
    public function list()
    {
        try {
            $list = "SELECT email from fraud_mail";
            $this->prepare($list);
            return $this->resultSet(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert($emailList)
    {
        try {
            $sql = "DELETE FROM fraud_mail";
            $this->prepare($sql);
            $status = $this->execute();
            foreach ($emailList as $email) {
                $sql = "INSERT INTO fraud_mail(email) values(:email)";
                $this->prepare($sql);
                $this->bindParameter(':email', $email);
                $status = $this->execute();
            }
            return $status;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
