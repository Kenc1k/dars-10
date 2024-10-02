<?php

class database {
    public $localhost = 'localhost';
    public $username = 'root';
    public $password = 'Kenc1k06';
    public $dbname = 'students_db';

    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=".$this->localhost.";dbname=".$this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
