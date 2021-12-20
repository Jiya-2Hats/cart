<?php

use Core\BaseModel\BaseModel;

class Order extends BaseModel
{

    public function orderPlaced($orderData)
    {
        try {
            $order = 'INSERT INTO orders(product_id, email,bill_name, bill_address_line1, bill_address_line2, bill_city, bill_state,bill_country,bill_postal_code,ship_name,ship_phone,ship_address_line1, ship_address_line2, ship_city,ship_state, ship_country, ship_postal_code,order_status, stripe_client_secret) 
                                        values(:productId,:email,:billName,:billLine1,:billLine2,:billCity,:billState,:billCountry,:billPostalCode,:shipName,:shipPhone,:shipLine1,:shipLine2,:shipCity,:shipState,:shipCountry,:shipPostalCode,:orderStatus,:clientSecretKey) ';
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

    public function listOrders()
    {
        try {
            $orderUpdate = "SELECT orders.email,products.name,products.amount,concat(orders.ship_address_line1,' ',orders.ship_address_line2,' ',orders.ship_city,' ',orders.ship_state,' ',orders.ship_country) as shipAddress,CASE WHEN orders.order_status = 1 THEN 'Success' ELSE 'Failed' END  as orderStatus FROM orders left join products on orders.product_id=products.id";
            $this->prepare($orderUpdate);
            return $this->resultSet(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
