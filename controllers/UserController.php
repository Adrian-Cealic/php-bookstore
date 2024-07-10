<?php
require_once '../models/UserModel.php';
session_start();

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function validateUserRegister($username, $email, $pwd, $telefon, $locatie)
    {
        $errors = [];

        // validate username
        if (empty($username)) {
            $errors['username'] = 'Username is required';
        } elseif (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
            $errors['username'] = "Username must be between 5 and 15 characters and contain only alphanumeric characters and underscores";
        } elseif ($this->userModel->checkUsernameExists($username)) {
            $errors['username'] = 'Username already exists';
        }

        // validate password
        if (empty($pwd)) {
            $errors['pwd'] = 'Password is required';
        } elseif (strlen($pwd) < 6) {
            $errors['pwd'] = "Password must be at least 6 characters";
        }

        // validate email
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        // validate telefon (optional)
        if (!empty($telefon) && !preg_match('/^[0-9]+$/', $telefon)) {
            $errors['telefon'] = 'Mobile phone number must contain only numbers';
        }

        // validate locatie (optional)
        if (!empty($locatie) && !preg_match('/^[a-zA-Z]+$/', $locatie)) {
            $errors['locatie'] = 'Location must contain only alphabetic characters';
        }

        return $errors;
    }

    public function registerUser($username, $email, $pwd, $telefon, $locatie)
    {
        $errors = $this->validateUserRegister($username, $email, $pwd, $telefon, $locatie);
        if (empty($errors)) {
            $this->userModel->registerUser($username, $email, $pwd, $telefon, $locatie);
            header('Location: ../views/success.view.php?' . http_build_query(['username' => $username, 'email' => $email, 'telefon' => $telefon, 'locatie' => $locatie]));
            die();
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: ../views/register.view.php');
            die();
        }
    }
}
