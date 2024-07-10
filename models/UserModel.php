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

    public function checkUsernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT username FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);


    }
}