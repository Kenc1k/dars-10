<?php

class database{
    public $localhost = 'localhost';
    public $username = 'root';
    public $password = 'Kenc1k06';
    public $dbname = 'students_db';

    public $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=this->localhost;dbname=this->dbname" , $this->username,$this->password);
    }

    public function conn(){
        return $this->conn();
    } 
}
?>