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

    public function getProductAmount($id)
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

    public function getCurrentProduct($id)
    {

        $sql = "SELECT * FROM products where id=:id";
        $this->prepare($sql);
        $this->bindParameter(':id', $id, PDO::PARAM_INT);
        $result = $this->execute();
        $result = $this->resultSet(PDO::FETCH_ASSOC);
        return $result;
    }

    public function placeOrder($orderData)
    {
        try {

            $productId =  (int)$orderData->productId;
            $billPostalCode =  (int)$orderData->billPostalCode;
            $shipPostalCode = (int)$orderData->shipPostalCode;
            $orderStatus = 0;

            $order = 'INSERT INTO product_order(product_id, bill_name, bill_address_line1, bill_address_line2, bill_city, bill_state,bill_country,bill_postal_code,ship_name,ship_phone,ship_address_line1, ship_address_line2, ship_city,ship_state, ship_country, ship_postal_code,order_status, stripe_client_secret) 
                                        values(:productId,:billName,:billLine1,:billLine2,:billCity,:billState,:billCountry,:billPostalCode,:shipName,:shipPhone,:shipLine1,:shipLine2,:shipCity,:shipState,:shipCountry,:shipPostalCode,:orderStatus,:clientSecretKey) ';

            $this->prepare($order);
            $this->bindParameter(':productId', $productId);
            $this->bindParameter(':billName',   $orderData->billName);
            $this->bindParameter(':billLine1',   $orderData->billLine1);
            $this->bindParameter(':billLine2',   $orderData->billLine2);
            $this->bindParameter(':billCity', $orderData->billCity);
            $this->bindParameter(':billState', $orderData->billState);
            $this->bindParameter(':billCountry', $orderData->billCountry);
            $this->bindParameter(':billPostalCode', $billPostalCode);

            $this->bindParameter(':shipName',  $orderData->shipName);
            $this->bindParameter(':shipPhone', $orderData->shipPhone);
            $this->bindParameter(':shipLine1', $orderData->shipLine1);
            $this->bindParameter(':shipLine2',  $orderData->shipLine2);
            $this->bindParameter(':shipCity', $orderData->shipCity);
            $this->bindParameter(':shipState', $orderData->shipState);
            $this->bindParameter(':shipCountry', $orderData->shipCountry);
            $this->bindParameter(':shipPostalCode', $shipPostalCode);
            $this->bindParameter(':clientSecretKey', $orderData->clientSecretKey);
            $this->bindParameter(':orderStatus', $orderStatus);

            $result = $this->execute();

            return $result;
        } catch (Error $e) {
            return $e->getMessage();
        }
    }

    public function UpdateOrderStatus($status, $clientSecret)
    {

        $orderUpdate = 'UPDATE product_order SET order_status = :status WHERE  stripe_client_secret=:clientSecret ';

        $this->prepare($orderUpdate);
        $this->bindParameter(':status', $status);
        $this->bindParameter(':clientSecret', $clientSecret);
        return $this->execute();
    }
}
