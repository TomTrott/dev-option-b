<?php
require_once __DIR__ . '/../config/database.php';

// Classe de base pour tous les modèles
class Model {
// stocke la connexio ndb
    protected $db;
    public function __construct() {
        $database = new Database();
        // appelle la méthode connect() pour se connecter
        // stocke dans $db
        $this->db = $database->connect();
    }
}