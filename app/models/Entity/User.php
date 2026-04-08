<?php
class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $bio;
    private $created_at; 

    public function __construct($data = []) {
        if ($data) $this->hydrate($data);
    }

    private function hydrate($data) {
        foreach ($data as $key => $value) {
            $key = str_replace('_', '', ucwords($key, '_'));
            $method = 'set' . $key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getBio() { return $this->bio; }
    public function getCreatedAt() { return $this->created_at; } // Getter ajouté

    public function setId($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setBio($bio) { $this->bio = $bio; }
    public function setCreatedAt($created_at) { $this->created_at = $created_at; } // Setter ajouté
}