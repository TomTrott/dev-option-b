<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'book_exchange';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur DB : " . $e->getMessage());
        }

        return $this->conn;
    }
}