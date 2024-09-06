<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.cofig.php';
require_once '../utils/utility.php';
$db = getDbConnection();
$productController = new ProductController($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_update'])) {
    $productId = $_POST['productId'];
    $product = $productController->getProductById($productId);
    $_SESSION['product'] = $product;
    $product_pic = $_FILES['img'];
    $result = ValidateUserFile($product_pic, 'products');

    $product_pic_path = $result['path'];

    $errors = $result['errors'];

    if (empty($errors)) {
        print_r($_POST);

        //Update product in the database with picture
        if ($product_pic_path) {
            $productController->update_product_with_pic(
                $product['id'],
                $_POST['name'],
                $_POST['author'],
                $_POST['price'],
                $_POST['description'],
                $_POST['qty'],
                $product_pic_path
            );
        } else {
            // Update product in the database without picture
            $productController->update_product(
                $product['id'],
                $_POST['name'],
                $_POST['author'],
                $_POST['price'],
                $_POST['description'],
                $_POST['qty'],
            );
        }
        header('Location: ../views/updateProduct.view.php');
        die();
    } else {
        $_SESSION['errors_product_update'] = $errors;
        header('Location: ../views/updateProduct.view.php');
        exit;
    }
}
