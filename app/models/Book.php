<?php
require_once __DIR__ . '/../../core/Model.php';

class Book extends Model {

    // Récupère tous les livres d'un utilisateur
    public function getByUser($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute un livre
    public function create($user_id, $title, $author, $description, $image) {
        $stmt = $this->db->prepare("
            INSERT INTO books (user_id, title, author, description, image)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$user_id, $title, $author, $description, $image]);
    }

    // Supprime un livre
    public function delete($id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

    // Récupère un livre
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour un livre
    public function update($id, $title, $author, $description) {
        $stmt = $this->db->prepare("
            UPDATE books SET title = ?, author = ?, description = ?
            WHERE id = ?
        ");
        return $stmt->execute([$title, $author, $description, $id]);
    }

    // Récupère les derniers livres
    public function getLastBooks($limit = 4) {
    $stmt = $this->db->prepare("
        SELECT books.*, users.username
        FROM books
        JOIN users ON books.user_id = users.id
        ORDER BY books.created_at DESC
        LIMIT $limit
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Met à jour la disponibilité d'un livre
    public function updateAvailability($id, $isAvailable) {
        $stmt = $this->db->prepare("UPDATE books SET is_available = ? WHERE id = ?");
        return $stmt->execute([$isAvailable, $id]);
    }

    // Récupère les livres disponibles avec le nom de l'utilisateur
    public function getAvailableBooks() {
        $stmt = $this->db->prepare("
            SELECT books.*, users.username
            FROM books
            JOIN users ON books.user_id = users.id
            WHERE books.is_available = 1
            ORDER BY books.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Recherche des livres disponibles avec le nom de l'utilisateur
    public function searchAvailable($search) {
        $stmt = $this->db->prepare("
            SELECT books.*, users.username
            FROM books
            JOIN users ON books.user_id = users.id
            WHERE books.is_available = 1
            AND books.title LIKE ?
        ");
        $stmt->execute(['%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
