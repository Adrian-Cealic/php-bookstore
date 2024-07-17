<?php

class UserModel
{
    private $db; // pdo database

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function registerUser($username, $email, $pwd, $telefon, $locatie)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, pwd, telefon, locatie) VALUES (:username, :email, :pwd, :telefon, :locatie)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':locatie', $locatie);

        $stmt->bindParam(':pwd', $hashed_pwd);

        return $stmt->execute();
    }
    public function loginUser($username, $password)
    {
        $stmt = $this->db->prepare("SELECT password,username FROM users where username=:username and password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function checkUsernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT username FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); //return array with all columns from db table
    }

    public function updateUserProfile($username, $email, $telefon, $locatie)
    {
        $stmt = $this->db->prepare("UPDATE users SET email = :email, telefon = :telefon, locatie = :locatie WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':locatie', $locatie);

        return $stmt->execute();
    }

    public function updateUserProfileWithPic($username, $email, $telefon, $locatie, $profile_pic)
    {
        $stmt = $this->db->prepare("UPDATE users SET email = :email, telefon = :telefon, locatie = :locatie, profile_pic = :profile_pic WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':locatie', $locatie);
        $stmt->bindParam(':profile_pic', $profile_pic);

        return $stmt->execute();
    }
}
