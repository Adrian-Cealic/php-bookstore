<?php

require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';
require_once '../utils/utility.php';

$db = getDbConnection();
$userController = new UserController($db);
print_r($_FILES);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_update'])) {
    
    $user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
    $username = $user['username'];
    $email = trim(htmlspecialchars($_POST['email']));
    $telefon = trim(htmlspecialchars($_POST['telefon']));
    $location = trim(htmlspecialchars($_POST['location']));

    $profile_pic = $_FILES['profile_pic'];


    $result = ValidateUserFile($profile_pic, "users");

    $profile_pic_path = $result['path'];
    $errors = $result['errors'];

    if (empty($errors)) {
        if ($profile_pic_path) {
            $userController->updateUserProfileWithPic($username, $email, $telefon, $location, $profile_pic_path);
        } else {
            $userController->updateUserProfile($username, $email, $telefon, $location);
        }
        header('Location: ../views/profile.view.php?success=true');
        die();
    } else {
        $_SESSION['errors_update'] = $errors;
        header('Location: ../views/profile.view.php');
        die();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_unset();
    header('Location:../views/login.view.php');
    die();
}
