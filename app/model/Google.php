<?php

use Core\BaseModel\BaseModel;

class Google extends BaseModel
{
    public function insert($apiKey)
    {
        try {
            $sql = "INSERT INTO google_api(api_key) values(:apiKey)";
            $this->prepare($sql);
            $this->bindParameter(':apiKey', $apiKey);
            return $this->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function key()
    {
        try {
            $sql = "SELECT api_key as apiKey from google_api";
            $this->prepare($sql);

            return $this->single(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
