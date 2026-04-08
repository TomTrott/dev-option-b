<?php

class Conversation {
    private $id;
    private $user1_id;
    private $user2_id;

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
    public function getUser1Id() { return $this->user1_id; }
    public function getUser2Id() { return $this->user2_id; }

    public function setId($id) { $this->id = $id; }
    public function setUser1Id($id) { $this->user1_id = $id; }
    public function setUser2Id($id) { $this->user2_id = $id; }
}