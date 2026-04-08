<?php

class Book {
    private $id;
    private $user_id;
    private $title;
    private $author;
    private $description;
    private $image;
    private $is_available;
    private $username; 

//constructeur
    public function __construct($data = []) {
        if ($data) $this->hydrate($data);
    }
//hydrate fonction
    private function hydrate($data) {
        foreach ($data as $key => $value) {
            $key = str_replace('_', '', ucwords($key, '_'));
            $method = 'set' . $key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS
    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getTitle() { return $this->title; }
    public function getAuthor() { return $this->author; }
    public function getDescription() { return $this->description; }
    public function getImage() { return $this->image; }
    public function getIsAvailable() { return $this->is_available; }
    public function getUsername() {
    return $this->username;
}


    // SETTERS
    public function setId($id) { $this->id = $id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function setTitle($title) { $this->title = $title; }
    public function setAuthor($author) { $this->author = $author; }
    public function setDescription($description) { $this->description = $description; }
    public function setImage($image) { $this->image = $image; }
    public function setIsAvailable($is_available) { $this->is_available = $is_available; }
    public function setUsername($username) {
    $this->username = $username;
}
}