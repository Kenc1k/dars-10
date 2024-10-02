<?php

class students {
    public $id;
    public $familiya;
    public $ism;
    public $manzil;
    public $image;

    protected $table = "students";
    public $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPaginated($limit, $offset) {
        $sql = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount() {
        $sql = "SELECT COUNT(*) as count FROM " . $this->table;
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function getById() {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $this->id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update() {
        $sql = "UPDATE " . $this->table . " SET familiya = :familiya, ism = :ism, manzil = :manzil, image = :image WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':familiya', $this->familiya);
        $statement->bindParam(':ism', $this->ism);
        $statement->bindParam(':manzil', $this->manzil);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':id', $this->id);
        return $statement->execute();
    }
    
}
?>
