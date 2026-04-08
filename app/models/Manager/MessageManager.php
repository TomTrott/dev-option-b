<?php

require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/Message.php';

class MessageManager extends Model {

    public function getByConversation($convId) {
        $stmt = $this->db->prepare("
            SELECT * FROM messages
            WHERE conversation_id = ?
            ORDER BY created_at ASC
        ");
        $stmt->execute([$convId]);

        $messages = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($data);
        }

        return $messages;
    }

    public function send(Message $message) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (conversation_id, sender_id, content)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $message->getConversationId(),
            $message->getSenderId(),
            $message->getContent()
        ]);
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("
            DELETE FROM messages WHERE id = ? AND sender_id = ?
        ");

        return $stmt->execute([$id, $userId]);
    }
}