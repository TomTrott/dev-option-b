<?php

class Message {
    private $id;
    private $conversation_id;
    private $sender_id;
    private $content;

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
    public function getConversationId() { return $this->conversation_id; }
    public function getSenderId() { return $this->sender_id; }
    public function getContent() { return $this->content; }

    public function setId($id) { $this->id = $id; }
    public function setConversationId($id) { $this->conversation_id = $id; }
    public function setSenderId($id) { $this->sender_id = $id; }
    public function setContent($content) { $this->content = $content; }
}