<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class BooksController extends Controller 
{
    private $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
    }

    // Éditer un livre
    public function edit() 
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $livre = $this->bookManager->find($_GET['id']);

        if (!$livre || $livre->getUserId() != $_SESSION['user_id']) {
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        $this->view('books/edit', ['livre' => $livre]);
    }

    // Mettre à jour un livre
    public function update() 
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit;
        }

        $livre = $this->bookManager->find($_POST['id']);

        if (!$livre || $livre->getUserId() != $_SESSION['user_id']) {
            exit;
        }

        $livre->setTitle($_POST['title']);
        $livre->setAuthor($_POST['author']);
        $livre->setDescription($_POST['description']);

        $this->bookManager->update($livre);

        header('Location: ' . BASE_URL . 'profile');
        exit;
    }

    // Supprimer un livre
    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $bookId = $_GET['id'] ?? null;

        if (!$bookId) {
            $_SESSION['error'] = "Livre introuvable.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        $livre = $this->bookManager->find($bookId);

        if (!$livre) {
            $_SESSION['error'] = "Livre introuvable.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        if ($livre->getUserId() != $_SESSION['user_id']) {
            $_SESSION['error'] = "Vous n'avez pas la permission de supprimer ce livre.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        // Supprime l'image si elle existe
        $imagePath = __DIR__ . '/../../public/uploads/' . $livre->getImage();
        if ($livre->getImage() && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $this->bookManager->delete($bookId);

        $_SESSION['success'] = "Livre supprimé avec succès.";
        header('Location: ' . BASE_URL . 'profile');
        exit;
    }

    // Rendre un livre disponible ou indisponible
    public function toggleAvailability() 
    {
        if (!isset($_SESSION['user_id'])) {
            exit;
        }

        $livre = $this->bookManager->find($_GET['id']);

        if ($livre && $livre->getUserId() == $_SESSION['user_id']) {
            $isAvailable = (int) $_GET['isAvailable'];
            $this->bookManager->updateAvailability($_GET['id'], $isAvailable);
        }

        header('Location: ' . BASE_URL . 'profile');
        exit;
    }

    // Afficher les détails d'un livre
    public function show() 
    {
        $livre = $this->bookManager->find($_GET['id']);
        $this->view('books/view', ['livre' => $livre]);
    }

    // Afficher le formulaire de création
    public function create() 
    {
        $this->view('books/create');
    }

    // Ajouter un livre
    public function store() 
    {
        if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit;
        }

        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            $originalName = $_FILES['image']['name'];
            $cleanName = str_replace(' ', '_', $originalName);
            $cleanName = iconv('UTF-8', 'ASCII//TRANSLIT', $cleanName);
            $cleanName = preg_replace('/[^A-Za-z0-9\._-]/', '', $cleanName);
            $imageName = time() . '_' . $cleanName;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/uploads/' . $imageName
            );
        }

        $book = new Book([
            'user_id' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'description' => $_POST['description'],
            'image' => $imageName
        ]);

        $this->bookManager->create($book);

        header('Location: ' . BASE_URL . 'profile');
        exit;
    }
}