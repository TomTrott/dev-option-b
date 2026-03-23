<?php

require_once __DIR__ . '/../../core/Model.php';

class User extends Model {
// recherche par mail
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
// crée un profil
    public function create($username, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $password]);
    }
// edit profil
    public function updateProfile($id, $username, $bio) {
    $stmt = $this->db->prepare("UPDATE users SET username = ?, bio = ? WHERE id = ?");
    return $stmt->execute([$username, $bio, $id]);
    }
// recherche par id
    public function findById($id) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
}