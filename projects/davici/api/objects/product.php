<?php

class Product {
    private $conn;
    private $table_name;

    public function __construct($db, $tn) {
        $this->conn = $db;
        $this->table_name = $tn;
    }

    // read from tables based on given table name
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}