<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BooksController extends Controller {
    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $bookModel = new Book();
        $livre = $bookModel->find($_GET['id']);

        if (!$livre || $livre['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Livre introuvable ou accès refusé.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        $this->view('books/edit', ['livre' => $livre]);
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $description = trim($_POST['description']);

            $bookModel = new Book();
            $livre = $bookModel->find($id);

            if (!$livre || $livre['user_id'] != $_SESSION['user_id']) {
                $_SESSION['error'] = "Livre introuvable ou accès refusé.";
                header('Location: ' . BASE_URL . 'profile');
                exit;
            }

            $bookModel->update($id, $title, $author, $description);
            $_SESSION['success'] = "Livre mis à jour avec succès.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        header('Location: ' . BASE_URL . 'profile');
        exit;
    }

    public function toggleAvailability() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $id = $_GET['id'];
        $isAvailable = $_GET['isAvailable'] == '1' ? 1 : 0;

        $bookModel = new Book();
        $livre = $bookModel->find($id);

        if (!$livre || $livre['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Livre introuvable ou accès refusé.";
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        $bookModel->updateAvailability($id, $isAvailable);
        $_SESSION['success'] = "Disponibilité mise à jour avec succès.";
        header('Location: ' . BASE_URL . 'profile');
        exit;
    }

    public function show() {

        if (!isset($_GET['id'])) {
            header('Location: ' . BASE_URL . 'exchange');
            exit;
        }

        $id = $_GET['id'];

        $bookModel = new Book();
        $livre = $bookModel->find($id);

        if (!$livre) {
            header('Location: ' . BASE_URL . 'exchange');
            exit;
        }

        $this->view('books/view', [
            'livre' => $livre
        ]);
    }

    public function create() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }

    $this->view('books/create');
}

public function store() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $description = trim($_POST['description']);

        // upload image
        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/uploads/' . $imageName
            );
        }

        $bookModel = new Book();
        $bookModel->create(
            $_SESSION['user_id'],
            $title,
            $author,
            $description,
            $imageName
        );

        header('Location: ' . BASE_URL . 'profile');
        exit;
    }
}
}
