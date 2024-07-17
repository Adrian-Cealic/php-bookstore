<?php
// session_start();

require_once '../controllers/UserController.php';
require_once '../config/db.cofig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
    $username = $user['username'];
    $email = trim(htmlspecialchars($_POST['email']));
    $telefon = trim(htmlspecialchars($_POST['telefon']));
    $location = trim(htmlspecialchars($_POST['location']));

    $db = getDbConnection();
    $userController = new UserController($db);

    $result = $userController->ValidateUserFile();


    $profile_pic_path = $result['path'];
    $errors = $result['errors'];


    if (empty($errors)) {
        if ($profile_pic_path) {
            $userController->updateUserProfileWithPic($username, $email, $telefon, $location, $profile_pic_path);
        } else {
            $userController->updateUserProfile($username, $email, $telefon, $location);
        }
    } else {
        $_SESSION['errors_update'] = $errors;
        header('Location:../views/profile.view.php');
        die();
    }
}
