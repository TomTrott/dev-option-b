<?php
//ma classe user (données utilisateir)
class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $bio;
// fonctio nde constructuon de l'objet user
    public function __construct($data = []) {
        if ($data) {
            $this->hydrate($data);
        }
    }
//fonction d'hydratation de user donc remplir les données avec base de données
    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // getters et setters classiques
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getBio() { return $this->bio; }

    // setters
    public function setId($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setBio($bio) { $this->bio = $bio; }
} 