<?php

use Core\BaseModel\BaseModel;

class Order extends BaseModel
{

    public function orderPlaced($orderData, $violationList)
    {
        try {
            $order = 'INSERT INTO orders(product_id, email,bill_name, bill_address_line1, bill_address_line2, bill_city, bill_state,bill_country,bill_postal_code,ship_name,ship_phone,ship_address_line1, ship_address_line2, ship_city,ship_state, ship_country, ship_postal_code,order_status, stripe_client_secret,email_structure_violation,email_domain_violation,email_fraud_violation,address_violation,order_date) 
                                        values(:productId,:email,:billName,:billLine1,:billLine2,:billCity,:billState,:billCountry,:billPostalCode,:shipName,:shipPhone,:shipLine1,:shipLine2,:shipCity,:shipState,:shipCountry,:shipPostalCode,:orderStatus,:clientSecretKey,:emailStructure,:emailDomain,:fraudEmail,:invalidAddress,:orderDate) ';
            $this->prepare($order);
            $this->bindPDOParameter($orderData);
            $this->bindPDOParameter($violationList);
            $orderDate = new DateTime('NOW');
            $this->bindParameter(':orderDate', $orderDate->format('c'));
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
            $orderUpdate = "SELECT orders.email,products.name,products.amount,concat(orders.ship_address_line1,' ',orders.ship_address_line2,' ',orders.ship_city,' ',orders.ship_state,' ',orders.ship_country,' ',orders.ship_postal_code) as shipAddress,CASE WHEN orders.order_status = 1 THEN 'Success' ELSE 'Failed' END  as orderStatus FROM orders left join products on orders.product_id=products.id";
            $this->prepare($orderUpdate);
            return $this->resultSet(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function listWithViolation()
    {
        try {
            $orderUpdate = "SELECT orders.id,orders.email,products.name,products.amount,concat(orders.ship_address_line1,' ',orders.ship_address_line2,' ',orders.ship_city,' ',orders.ship_state,' ',orders.ship_country,' ',orders.ship_postal_code) as shipAddress,CASE WHEN orders.order_status = 1 THEN 'Success' ELSE 'Failed' END as orderStatus,orders.email_structure_violation as emailStructureViolation, orders.email_domain_violation as emailDomainViolation,orders.email_fraud_violation as fraudEmailViolation,orders.address_violation as addressViolation ,orders.address_violation+orders.email_fraud_violation+orders.email_domain_violation+orders.email_structure_violation as score FROM orders left join products on orders.product_id=products.id WHERE order_date > now() - interval 2 week LIMIT 25";
            $this->prepare($orderUpdate);
            return $this->resultSet(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrderById($id)
    {
        try {
            $orderUpdate = "SELECT orders.id,orders.email,orders.ship_address_line1 as shipAddressLine1,orders.ship_address_line2 as shipAddressLine2,orders.ship_city as shipCity,orders.ship_state as shipState,orders.ship_country as shipCountry,orders.ship_postal_code as shipPostalCode FROM orders where id=:id";
            $this->prepare($orderUpdate);
            $this->bindParameter(':id', $id);
            return $this->resultSet(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function updateOrderById($updateData, $violationList)
    {
        try {
            $orderUpdate = "UPDATE  orders set email=:email,ship_address_line1=:shipLine1,ship_address_line2=:shipLine2,ship_city=:shipCity,ship_state=:shipState,ship_country =:shipCountry,ship_postal_code=:shipPostalCode,email_structure_violation=:emailStructure,email_domain_violation=:emailDomain,email_fraud_violation=:fraudEmail,address_violation=:invalidAddress where id=:id";
            $this->prepare($orderUpdate);
            $this->bindPDOParameter($updateData);
            $this->bindPDOParameter($violationList);
            return $this->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
