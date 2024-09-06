<?php
require_once '../controllers/CartController.php';
require_once '../config/db.cofig.php';
require_once '../utils/utility.php';

$db = getDbConnection();
$cartControler = new CartController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    $cartControler->addProductToCart($productId,$userId);
    header('Location: ../views/main.view.php');
}
else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_button'])) {
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    $cartControler->deleteProductFromCart($productId, $userId);
    header('Location:../views/cart.view.php');
}


