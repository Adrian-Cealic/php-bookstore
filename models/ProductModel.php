<?php

class ProductModel
{
    private $db; // pdo database

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createProduct($name, $author, $price, $description, $qty, $product_img)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, author, price, description, qty, img) VALUES (:name, :author, :price, :description, :qty, :img)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':img', $product_img);
        return $stmt->execute();
    }
    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
