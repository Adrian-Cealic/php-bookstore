<?php
require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = trim(htmlspecialchars($_POST['username']));
    $pwd = trim(htmlspecialchars($_POST['pwd']));
    $email = trim(htmlspecialchars($_POST['email']));
    $telefon = trim(htmlspecialchars($_POST['telefon']));
    $location = trim(htmlspecialchars($_POST['locatie']));

    $query = "username=" . urlencode($username) . "&email=" . urlencode($email) . "&telefon=" . urlencode($telefon) . "&locatie=" . urlencode($location);

    header("Location: ../views/success.view.php?" . $query);

    $db = getDbConnection();
    $userController = new UserController($db);
    $userController->registerUser($username, $email, $pwd, $telefon, $location);
}

