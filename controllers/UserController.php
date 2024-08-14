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
        } elseif (!preg_match("/^[a-zA-Z0-9_]{3,15}$/", $username)) {
            $errors['username'] = "Username must be between 3 and 15 characters and contain only alphanumeric characters and underscores";
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
            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['loggedInUser'] = $user;
            header('Location: ../views/main.view.php');
            die();
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: ../views/register.view.php');
            die();
        }
    }

    public function loginUser($username, $pwd)
    {

        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($pwd, $user['pwd'])) {
            $_SESSION['loggedInUser'] = $user;
            if ($user['role'] == 'admin') {
                header('Location: ../views/admin.view.php');
            } else {
                header('Location:../views/main.view.php');
            }
            die();
        } else {
            $errors['login'] = 'Invalid username or password';
            $_SESSION['errors_login'] = $errors;
            header('Location: ../views/login.view.php');
            die();
        }
    }

    public function updateUserProfile($username, $email, $telefon, $locatie)
    {
        $errors = $this->validateUserUpdate($email, $telefon, $locatie);
        if (empty($errors)) {

            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['loggedInUser'] = $user;

            $this->userModel->updateUserProfile($username, $email, $telefon, $locatie);
            $_SESSION['loggedInUser']['email'] = $email;
            $_SESSION['loggedInUser']['telefon'] = $telefon;
            $_SESSION['loggedInUser']['locatie'] = $locatie;
            header('Location:../views/profile.view.php');
            die();
        } else {
            $_SESSION['errors_update'] = $errors;
            header('Location:../views/profile.view.php');
            die();
        }
    }

    public function updateUserProfileWithPic($username, $email, $telefon, $locatie, $profile_pic)
    {
        $errors = $this->validateUserUpdate($email, $telefon, $locatie);

        if (empty($errors) && $profile_pic) {

            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['loggedInUser'] = $user;

            $this->userModel->updateUserProfileWithPic($username, $email, $telefon, $locatie, $profile_pic);

            $_SESSION['loggedInUser']['email'] = $email;
            $_SESSION['loggedInUser']['username'] = $username;
            $_SESSION['loggedInUser']['telefon'] = $telefon;
            $_SESSION['loggedInUser']['locatie'] = $locatie;
            $_SESSION['loggedInUser']['profile_pic'] = $profile_pic;
            header('Location:../views/profile.view.php');
            die();
        } else {
            $_SESSION['errors_update'] = $errors;
            header('Location:../views/profile.view.php');
            die();
        }
    }

    public function validateUserUpdate($email, $telefon, $locatie)
    {
        $errors = [];

        // validate username
        // if (empty($username)) {
        //     $errors['username'] = 'Username is required for update';
        // } elseif (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
        //     $errors['username'] = "Username must be between 5 and 15 characters and contain only alphanumeric characters and underscores";
        // }

        // validate email
        if (empty($email)) {
            $errors['email'] = 'Email is required for update';
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
    public function ValidateUserFile()
    {
        $profile_pic = $_FILES['profile_pic'];
        $upload_dir = '../assets/users/';
        $allowed_types = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
        $errors = [];
        $profile_pic_path = null;

        if ($profile_pic['error'] == UPLOAD_ERR_OK) {
            if (in_array($profile_pic['type'], $allowed_types)) {
                $file_ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
                $file_name = uniqid() . '.' . $file_ext;
                $file_path = $upload_dir . $file_name;

                if (move_uploaded_file($profile_pic['tmp_name'], $file_path)) {
                    $profile_pic_path = $file_name;
                } else {
                    $errors[] = 'Failed to upload profile picture.';
                }
            } else {
                $errors[] = 'Invalid file type. Only PNG, JPEG, GIF, and JPG are allowed.';
            }
        } elseif ($profile_pic['error'] != UPLOAD_ERR_NO_FILE) {
            $errors[] = 'No profile picture uploaded.';
        }

        return ['path' => $profile_pic_path, 'errors' => $errors];
    }
}
