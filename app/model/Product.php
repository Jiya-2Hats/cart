<?php

use Core\BaseModel\BaseModel;

class Product extends BaseModel
{


    public function list()
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

    public function amount($id)
    {
        try {
            $sql = "SELECT amount FROM products where id=:id";
            $this->prepare($sql);
            $this->bindParameter(':id', $id);
            $result = $this->execute();
            if ($this->rowCount()) {
                $result = $this->resultSet(PDO::FETCH_ASSOC);
                return $result;
            }
            return false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function select($id)
    {

        $sql = "SELECT id,name,description,amount FROM products where id=:id";
        $this->prepare($sql);
        $this->bindParameter(':id', $id, PDO::PARAM_INT);
        $result = $this->execute();
        $result = $this->resultSet(PDO::FETCH_ASSOC);
        return $result;
    }
}
