<?php

require_once __DIR__ . '/../../core/Model.php';

class User extends Model {

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $password]);
    }

    public function updateProfile($id, $username, $bio) {
    $stmt = $this->db->prepare("UPDATE users SET username = ?, bio = ? WHERE id = ?");
    return $stmt->execute([$username, $bio, $id]);
    }

    public function findById($id) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
}