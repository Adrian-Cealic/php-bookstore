<?php
require_once '../models/CartModel.php';


class CartController
{
    private $cartModel;

    public function __construct($db)
    {
        $this->cartModel = new CartModel($db);
    }
    public function addProductToCart($productId,$userId){
        $this->cartModel->addProductToCart($productId,$userId);
    }
    public function getAllCartProducts($userId){
        return $this->cartModel->getAllCartProducts($userId);
    }
    public function deleteProductFromCart($productId,$userId){
        $this->cartModel->deleteProductFromCart($productId,$userId);
    }
}
