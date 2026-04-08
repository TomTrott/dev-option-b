<?php

require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/Conversation.php';

class Conversation {
    private $id;
    private $user1_id;
    private $user2_id;
    private $last_message; // pour la vue messagerie
    private $time;         // pour la vue messagerie
    private $username;     // pour la vue messagerie

    public function __construct($data = []) {
        if ($data) $this->hydrate($data);
    }

    private function hydrate($data) {
        foreach ($data as $key => $value) {
            // transforme les clés snake_case en PascalCase pour les setters
            $key = str_replace('_', '', ucwords($key, '_'));
            $method = 'set' . $key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId() { return $this->id; }
    public function getUser1Id() { return $this->user1_id; }
    public function getUser2Id() { return $this->user2_id; }
    public function getLastMessage() { return $this->last_message; }
    public function getTime() { return $this->time; }
    public function getUsername() { return $this->username; }

    //SETTERS
    public function setId($id) { $this->id = $id; }
    public function setUser1Id($id) { $this->user1_id = $id; }
    public function setUser2Id($id) { $this->user2_id = $id; }
    public function setLastMessage($msg) { $this->last_message = $msg; }
    public function setTime($time) { $this->time = $time; }
    public function setUsername($username) { $this->username = $username; }
}