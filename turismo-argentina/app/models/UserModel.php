<?php

class UserModel {
    private $db;

    public function __construct() {
        require_once 'config.php';
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);

    }


    public function getUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$email]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insertUser($email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = $this->db->prepare('INSERT INTO usuarios (email, password) VALUES (?, ?)');
        $query->execute([$email, $hash]);
    }

}
