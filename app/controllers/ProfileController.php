<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/UserManager.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class ProfileController extends Controller {

    public function index() {
    // Vérification de la connexion
    if (!isset($_SESSION['user_id'])) {
        http_response_code(404);
        $this->view('errors/404');
        exit;
    }

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

    public function update() 
{
    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        exit;
    }

    $userManager = new UserManager();
$user = $userManager->findById($_SESSION['user_id']);

$user->setUsername($_POST['username']);
$user->setEmail($_POST['email']);

$updatePassword = false;

if (!empty($_POST['password'])) {
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->setPassword($hashedPassword);
    $updatePassword = true;
}

$userManager->updateProfile($user, $updatePassword);

header('Location: ' . BASE_URL . 'profile');
exit;
}
}