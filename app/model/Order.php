<?php

use Core\BaseModel\BaseModel;

class Order extends BaseModel
{

    public function orderPlaced($orderData)
    {
        try {
            $order = 'INSERT INTO orders(product_id, bill_name, bill_address_line1, bill_address_line2, bill_city, bill_state,bill_country,bill_postal_code,ship_name,ship_phone,ship_address_line1, ship_address_line2, ship_city,ship_state, ship_country, ship_postal_code,order_status, stripe_client_secret) 
                                        values(:productId,:billName,:billLine1,:billLine2,:billCity,:billState,:billCountry,:billPostalCode,:shipName,:shipPhone,:shipLine1,:shipLine2,:shipCity,:shipState,:shipCountry,:shipPostalCode,:orderStatus,:clientSecretKey) ';
            $this->prepare($order);
            $this->bindPDOParameter($orderData);
            $result = $this->execute();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function bindPDOParameter($orderData)
    {
        foreach ($orderData as $orderKey => $orderItem) {
            $this->bindParameter(':' . $orderKey, $orderItem);
        }
    }

    public function updateStatus($status, $clientSecret)
    {
        try {
            $orderUpdate = 'UPDATE orders SET order_status = :status WHERE  stripe_client_secret=:clientSecret ';
            $this->prepare($orderUpdate);
            $this->bindParameter(':status', $status);
            $this->bindParameter(':clientSecret', $clientSecret);
            return $this->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
