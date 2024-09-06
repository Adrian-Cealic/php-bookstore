<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.cofig.php';
require_once '../utils/utility.php';
$db = getDbConnection();
$productController = new ProductController($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_product'])) {
    $productId = $_POST['productId'];
    $productController->delete_product($productId);
    header('Location: ../views/main.view.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    
    header('Location: ../views/updateProduct.view.php');
    $productId = $_POST['productId'];
    $product = $productController->getProductById($productId);
    $_SESSION['product'] = $product;

}
