<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/UserManager.php';

class AuthController extends Controller {

    public function login() {
        $this->view('auth/login');
    }

    public function register() {
        $this->view('auth/register');
    }

    public function store() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = new User([
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);

            $userManager = new UserManager();
            $userManager->create($user);

            header('Location: ' . BASE_URL . 'auth/login');
        }
    }

    public function authenticate() {

        $userManager = new UserManager();
        $user = $userManager->findByEmail($_POST['email']);

        if ($user && password_verify($_POST['password'], $user->getPassword())) {

            $_SESSION['user_id'] = $user->getId();

            header('Location: ' . BASE_URL);
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}