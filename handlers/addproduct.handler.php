<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.cofig.php';
require_once '../utils/utility.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(htmlspecialchars($_POST['name']));
    $author = trim(htmlspecialchars($_POST['author']));
    $price = trim(htmlspecialchars($_POST['price']));
    $description = trim(htmlspecialchars($_POST['description']));
    $qty = trim(htmlspecialchars($_POST['qty']));
    $product_img = $_FILES['img'];

    $db = getDbConnection();
    $ProductController = new ProductController($db);
    $product_path = ValidateUserFile($product_img, "products");

    $product_pic_path = $product_path['path'];
    $errors = $product_path['errors'];

    $validation_errors = $ProductController->validateProduct($name, $author, $price, $description, $qty);
    $errors = array_merge($errors, $validation_errors);
    if (empty($errors)) {

        if ($product_pic_path) {
            $ProductController->addProduct($name, $author, $price, $description, $qty, $product_pic_path);
            header('Location: ../views/addProduct.view.php');
            exit();
        } else {
            $errors[] = 'Failed to upload product image.';
        }
    }else{
        header('Location: ../views/addProduct.view.php');
    }
    $_SESSION['errors'] = $errors;
    header('Location: ../views/addProduct.view.php');


    exit();
}

