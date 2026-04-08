<?php
require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/User.php';
//classe gestion des données utilisateur)
class UserManager extends Model {
//recherche par email
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new User($data) : null;
    }
//recherche par id
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new User($data) : null;
    }
//crée un nouvel utilisateur
    public function create(User $user) {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }
//met à jour le profil 
   public function updateProfile(User $user, $updatePassword = false) {

    if ($updatePassword) {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET username = ?, email = ?, password = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getId()
        ]);
    }

    $stmt = $this->db->prepare("
        UPDATE users 
        SET username = ?, email = ?
        WHERE id = ?
    ");

    return $stmt->execute([
        $user->getUsername(),
        $user->getEmail(),
        $user->getId()
    ]);
}
}
