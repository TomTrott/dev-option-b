<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/UserManager.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class ProfileController extends Controller {

    public function index() {

        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);
        $livres = $bookManager->getByUser($_SESSION['user_id']);

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

        $userManager = new UserManager();
        $utilisateur = $userManager->findById($_SESSION['user_id']);

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

            $userManager = new UserManager();
            $user = $userManager->findById($_SESSION['user_id']);

            $user->setUsername($nom);
            $user->setBio($bio);

            $userManager->updateProfile($user);

            header('Location: ' . BASE_URL . 'profile');
            exit;
        }

        header('Location: ' . BASE_URL . 'profile/edit');
        exit;
    }
}