<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class BooksController extends Controller {

    public function edit() {

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $bookManager = new BookManager();
        $livre = $bookManager->find($_GET['id']);

        if (!$livre || $livre->getUserId() != $_SESSION['user_id']) {
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        $this->view('books/edit', ['livre' => $livre]);
    }

    public function update() {

        if (!isset($_SESSION['user_id'])) {
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bookManager = new BookManager();
            $livre = $bookManager->find($_POST['id']);

            if (!$livre || $livre->getUserId() != $_SESSION['user_id']) {
                exit;
            }

            $livre->setTitle($_POST['title']);
            $livre->setAuthor($_POST['author']);
            $livre->setDescription($_POST['description']);

            $bookManager->update($livre);

            header('Location: ' . BASE_URL . 'profile');
            exit;
        }
    }

    public function toggleAvailability() {
    $bookManager = new BookManager();
    $livre = $bookManager->find($_GET['id']);

    if ($livre->getUserId() == $_SESSION['user_id']) {
        // Cast en int pour éviter le TypeError
        $isAvailable = (int) $_GET['isAvailable'];
        $bookManager->updateAvailability($_GET['id'], $isAvailable);
    }

    header('Location: ' . BASE_URL . 'profile');
}

    public function show() {

        $bookManager = new BookManager();
        $livre = $bookManager->find($_GET['id']);

        $this->view('books/view', ['livre' => $livre]);
    }

    public function create() {
        $this->view('books/create');
    }

    public function store() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            // Nettoyage du nom de fichier
            $originalName = $_FILES['image']['name'];
            
            //Remplacer les espaces par des underscores
            $cleanName = str_replace(' ', '_', $originalName);

            //Supprimer les accents et caractères
            $cleanName = iconv('UTF-8', 'ASCII//TRANSLIT', $cleanName);

            //Supprimer tout caractère sauf . _ -
            $cleanName = preg_replace('/[^A-Za-z0-9\._-]/', '', $cleanName);

            //pour éviter les doublons
            $imageName = time() . '_' . $cleanName;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/uploads/' . $imageName
            );
        }

        // Création de l'objet Book
        $book = new Book([
            'user_id' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'description' => $_POST['description'],
            'image' => $imageName
        ]);

        // Sauvegarde dans la BDD
        $bookManager = new BookManager();
        $bookManager->create($book);

        // Redirection vers le profil
        header('Location: ' . BASE_URL . 'profile');
        exit;
    }
}
}