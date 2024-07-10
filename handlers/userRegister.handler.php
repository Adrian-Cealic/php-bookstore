<?php
require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim(htmlspecialchars($_POST['username']));
    $pwd = trim(htmlspecialchars($_POST['pwd']));
    $email = trim(htmlspecialchars($_POST['email']));
    $telefon = trim(htmlspecialchars($_POST['telefon']));
    $location = trim(htmlspecialchars($_POST['locatie']));


    $db = getDbConnection();
    $userController = new UserController($db);
    $userController->registerUser($username, $email, $pwd, $telefon, $location);
}

