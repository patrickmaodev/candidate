<?php
require_once __DIR__ . '/Database.php';

class User {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Get user by email
    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new user (optional, for admins or candidates)
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, email, password, role, created_at, updated_at)
                VALUES (:name, :email, :password, :role, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'], // should be hashed
            ':role' => $data['role']
        ]);
        return $this->conn->lastInsertId();
    }

    // Verify password
    public function verifyPassword($email, $password) {
        $user = $this->getByEmail($email);
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
