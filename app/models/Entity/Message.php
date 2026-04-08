<?php
// app/models/Entity/Message.php

class Message {
    private $id;
    private $conversation_id;
    private $sender_id;
    private $content;
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

    // GETTERS
    public function getId() { return $this->id; }
    public function getConversationId() { return $this->conversation_id; }
    public function getSenderId() { return $this->sender_id; }
    public function getContent() { return $this->content; }
    public function getCreatedAt() { return $this->created_at; }

    // SETTERS
    public function setId($id) { $this->id = $id; }
    public function setConversationId($convId) { $this->conversation_id = $convId; }
    public function setSenderId($senderId) { $this->sender_id = $senderId; }
    public function setContent($content) { $this->content = $content; }
    public function setCreatedAt($createdAt) { $this->created_at = $createdAt; } //ajjout du created_at
}