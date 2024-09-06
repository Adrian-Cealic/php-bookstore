<?php
require_once '../models/ProductModel.php';

session_start();

class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    public function validateProduct($name, $author, $price, $description, $qty)
    {
        $errors = [];

        // Validate name
        if (empty($name)) {
            $errors['name'] = 'Name is required';
        } elseif (!preg_match('/^[a-zA-Z0-9_ ]{3,200}$/', $name)) {
            $errors['name'] = "Name must be between 3 and 40 characters and contain only alphanumeric characters, spaces, and underscores.";
        }
        //author
        if (empty($author)) {
            $errors['author'] = 'Author Name is required';
        } elseif (!preg_match('/^[a-zA-Z0-9_ ]{3,200}$/', $author)) {
            $errors['author'] = "Author Name must be between 3 and 40 characters and contain only alphanumeric characters, spaces, and underscores.";
        }

        // Validate price
        if (empty($price)) {
            $errors['price'] = "Price is required";
        } elseif (!preg_match('/^(?!0$)(\d{1,4})(\.\d{1,2})?$/', $price)) {
            $errors['price'] = "Price must be greater than 0 and less than or equal to 9999, with up to two decimal places.";
        }

        // Validate description
        if (empty($description)) {
            $errors['description'] = "Description is required";
        } elseif (!preg_match('/^.{5,2000}$/', $description)) {
            $errors['description'] = "Description must be between 10 and 130 characters long.";
        }

        // Validate quantity
        if (empty($qty)) {
            $errors['qty'] = "Quantity is required";
        } elseif (!preg_match('/^(?:[1-9][0-9]?|100)$/', $qty)) {
            $errors['qty'] = "Quantity must be between 1 and 100.";
        }
        return $errors;
    }


    public function addProduct($name, $author, $price, $description, $qty, $product_img)
    {
        $errors = $this->validateProduct($name, $author, $price, $description, $qty);
        if (empty($errors)) {
            $this->productModel->createProduct($name, $author, $price, $description, $qty, $product_img);
            header('Location: ../views/addProduct.view.php');
            die();
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: ../handlers/addProduct.handler.php');
            die();
        }
    }
    public function getAllProducts()
    {
        return $this->productModel->getAllProducts();
    }
    public function getProductById($id)
    {
        return $this->productModel->getProductById($id);
    }
    public function delete_product($id)
    {
        $this->productModel->deleteProduct($id);
        header('Location:../views/main.view.php');
        die();
    }
    public function update_product($id, $name, $author, $price, $description, $qty){
        $errors = $this->validateProduct($name, $author, $price, $description, $qty);
        if (empty($errors)) {
            $this->productModel->updateProduct($id, $name, $author, $price, $description, $qty);
            header('Location:../views/updateProduct.view.php');
            die();
        } else {
            $_SESSION['errors_product_update'] = $errors;
            header('Location:../views/updateProduct.view.php');
            die();
        }
    }
    public function update_product_with_pic($id, $name, $author, $price, $description, $qty, $product_img)
    {
        $errors = $this->validateProduct($name, $author, $price, $description, $qty);
        if (empty($errors)) {
            $this->productModel->updateProductWithPic($id, $name, $author, $price, $description, $qty, $product_img);
            header('Location:../views/updateProduct.view.php');
            die();
        } else {
            $_SESSION['errors_product_update'] = $errors;
            header('Location:../handlers/updateProduct.handler.php');
            die();
        }
    }
}
