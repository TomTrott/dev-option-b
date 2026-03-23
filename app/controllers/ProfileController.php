<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Book.php'; 

class ProfileController extends Controller {

    public function index() {
    $userModel = new User();
    $bookModel = new Book();

    $user = $userModel->findById($_SESSION['user_id']);
    $livres = $bookModel->getByUser($_SESSION['user_id']);

    $this->view('profile/index', [
        'user' => $user,
        'livres' => $livres ?? [] 
    ]);
}


    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        $utilisateur = (new User())->findById($_SESSION['user_id']);

        $this->view('profile/edit', ['user' => $utilisateur]);
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['username'] ?? '');
            $bio = trim($_POST['bio'] ?? '');

            if (empty($nom)) {
                header('Location: ' . BASE_URL . 'profile/edit');
                exit;
            }

            (new User())->updateProfile($_SESSION['user_id'], $nom, $bio);

            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        header('Location: ' . BASE_URL . 'profile/edit');
        exit;
    }
}