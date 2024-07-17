<?php

require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $telefon = trim(htmlspecialchars($_POST['mobile']));
    $location = trim(htmlspecialchars($_POST['location']));

    $db = getDbConnection();
    $userController = new UserController($db);
    $userController->updateUserProfile($username, $email, $telefon, $location);
}
