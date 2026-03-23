<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {

    // page login
    public function login() {
        $this->view('auth/login');
    }

    // page register
    public function register() {
        $this->view('auth/register');
    }

    // création utilisateur
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // récup valeurs du form
            $nom = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $mdp = $_POST['password'] ?? '';

            $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

            // insertion en bdd
            (new User())->create($nom, $email, $mdpHash);
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
    }

    // connexion utilisateur
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $mdp = $_POST['password'] ?? '';

            $utilisateur = (new User())->findByEmail($email);

            if ($utilisateur && password_verify($mdp, $utilisateur['password'])) {
                // start session si pas déjà fait
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $utilisateur['id'];

                header('Location: ' . BASE_URL); // redir accueil
                exit;
            } else {
                echo "<p style='color:red;'>Email ou mot de passe incorrect</p>";
            }
        }
    }

    // deconnexion
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}