<?php
require_once __DIR__ . '/Database.php';

class Candidate {
    private $conn;
    private $table = 'candidates';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Create new candidate
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (full_name, email, phone, cv, status, created_at, updated_at)
                VALUES (:full_name, :email, :phone, :cv, 'applied', NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':cv' => $data['cv']
        ]);
        return $this->conn->lastInsertId();
    }

    // Get all candidates
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get candidate by ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update candidate status
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET status = :status, updated_at = NOW() WHERE id = :id");
        $stmt->execute([':status' => $status, ':id' => $id]);
        return $stmt->rowCount();
    }
}
