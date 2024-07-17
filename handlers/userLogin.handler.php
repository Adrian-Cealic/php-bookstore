<?php
require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim(htmlspecialchars($_POST['username']));
    $pwd = trim(htmlspecialchars($_POST['pwd']));


    $db = getDbConnection();
    $userController = new UserController($db);
    $userController->loginUser($username, $pwd);
}
