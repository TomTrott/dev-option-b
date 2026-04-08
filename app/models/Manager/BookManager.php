<?php

require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/Book.php';
//class BookManager
class BookManager extends Model {

 //crée un livre
    public function create(Book $book) {
        $stmt = $this->db->prepare("
            INSERT INTO books (user_id, title, author, description, image)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $book->getUserId(),
            $book->getTitle(),
            $book->getAuthor(),
            $book->getDescription(),
            $book->getImage()
        ]);
    }

//supprime un livre
    public function delete($id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

//met à jour un livre
    public function update(Book $book) {
        $stmt = $this->db->prepare("
            UPDATE books SET title = ?, author = ?, description = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getDescription(),
            $book->getId()
        ]);
    }

    //trouve un livre par son id
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Book($data) : null;
    }

//recherche tous les livres d'un utilisateur
    public function getByUser($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $books = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($data);
        }

        return $books;
    }
//récupère les 4derniers livres ajoutés
public function getLastBooks($limit = 4) {
    $stmt = $this->db->prepare("
    SELECT books.*, users.username
    FROM books
    JOIN users ON books.user_id = users.id
    ORDER BY books.created_at DESC
    LIMIT $limit
");
$stmt->execute();

    $books = [];

    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $book = new Book($data);
    if(isset($data['username'])) {
        $book->setUsername($data['username']);
    }
    $books[] = $book;
}

    return $books;
}
}