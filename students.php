<?php

class students{
    public $id;
    public $familiya;
    public $ism;
    public $manzil;
    public $image;

    protected $table = "students";

    public $conn;

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function getAll(){
        $sql = "Select * from this->table";
        $statement = $this->conn->query($sql);
        
    }
}

?>