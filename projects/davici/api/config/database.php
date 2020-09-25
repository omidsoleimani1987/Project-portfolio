<?php

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "ecommerce-project";

    public function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $pdo;
    }
}