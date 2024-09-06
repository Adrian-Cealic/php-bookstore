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
    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteProduct($productId)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :productId");
        $stmt->bindParam(':productId', $productId);
        return $stmt->execute();
    }
    public function updateProduct($id, $name, $author, $price, $description, $qty)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = :name, author = :author, price = :price, description = :description, qty = :qty WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':qty', $qty);

        return $stmt->execute();
    }
    public function updateProductWithPic($id, $name, $author, $price, $description, $qty, $product_img)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = :name, author = :author, price = :price, description = :description, qty = :qty, img = :img WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':img', $product_img);

        return $stmt->execute();
    }
}
