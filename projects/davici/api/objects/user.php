<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // read from tables based on given table name
    public function read() {
        $query = "SELECT username, password FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // register user
    public function register($firstname, $lastname, $email, $username, $password) {
        $sql = 'INSERT INTO user (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);         
        $stmt->execute([$firstname, $lastname, $email, $username, $password]);
        if(!$stmt) {
            throw new Exception('unable to query to database');
        }
    }
}