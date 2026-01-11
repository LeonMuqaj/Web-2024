<?php
class Product {
    private $conn;
    private $product_table = 'produktet';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->product_table . " WHERE ID_Produktit = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class Order {
    private $conn;
    private $order_table = 'porosite';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createOrder($user_id, $product_id, $quantity) {
        $query = "INSERT INTO " . $this->order_table . " (User_ID, Product_ID, Sasia) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function getUserOrders($user_id) {
        $query = "SELECT p.ID_Porosit, p.Sasia, pr.Emri_Produktit, pr.Qmimi 
                  FROM " . $this->order_table . " p 
                  JOIN produktet pr ON p.Product_ID = pr.ID_Produktit 
                  WHERE p.User_ID = :user_id AND p.Status = 'Pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeOrder($order_id) {
        $query = "DELETE FROM " . $this->order_table . " WHERE ID_Porosit = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        return $stmt->execute();
    }

    public function finishOrder($user_id) {
        $query = "UPDATE " . $this->order_table . " SET Status = 'Ordered' WHERE User_ID = :user_id AND Status = 'Pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateOrderQuantity($order_id, $quantity) {
        $query = "UPDATE " . $this->order_table . " SET Sasia = :quantity WHERE ID_Porosit = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }
}

?>



