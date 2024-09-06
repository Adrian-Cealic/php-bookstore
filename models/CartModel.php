<?php
class CartModel
{
    private $db; // pdo database

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function addProductToCart($productId, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO cart (user_id,product_id) VALUES (:userId, :productId)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':productId', $productId);
        return $stmt->execute();
    }
    public function getAllCartProducts($userId){
        $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function deleteProductFromCart($productId, $userId){
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = :userId AND product_id = :productId");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':productId', $productId);
        return $stmt->execute();
    }
}
