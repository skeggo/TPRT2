<?php

class Student {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    

    public function getAll() {
        $sql = "SELECT s.*, sec.designation AS section_name
                FROM students s
                LEFT JOIN sections sec ON s.section_id = sec.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getById($id) {
        $sql = "SELECT s.*, sec.designation AS section_name
                FROM students s
                LEFT JOIN sections sec ON s.section_id = sec.id
                WHERE s.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

}
?>
