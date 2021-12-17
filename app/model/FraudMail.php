<?php

use Core\BaseModel\BaseModel;

class FraudMail extends BaseModel
{
    public function list()
    {
        try {
            $orderUpdate = "SELECT email from fraud_mail";
            $this->prepare($orderUpdate);
            return $this->resultSet(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
