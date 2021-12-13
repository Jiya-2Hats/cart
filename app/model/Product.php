<?php

use Core\BaseModel\BaseModel;

class Product extends BaseModel
{


    public function getProductList()
    {
        try {
            $sql2 = "SELECT * FROM products";
            $this->prepare($sql2);
            $result = $this->execute();
            if ($this->rowCount() > 0) {
                $result = $this->resultSet(PDO::FETCH_OBJ);
                return $result;
            }
            return false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
