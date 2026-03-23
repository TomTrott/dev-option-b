<?php

// Classe de base pour tous les contrôleurs
class Controller {
    // Fonction pour afficher une vue
    public function view($view, $data = []) {
        //  ['name' => 'John'] devient $name = 'John' donc transfo de tableau en variables
        extract($data);
        require_once __DIR__ . '/../app/views/' . $view . '.php';
    }
}