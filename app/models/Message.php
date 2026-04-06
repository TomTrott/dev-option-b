<?php

require_once __DIR__ . '/../../core/Model.php';

class Message extends Model {

    public function getByConversation($convId) {
        $stmt = $this->db->prepare("
            SELECT m.*, u.username 
            FROM messages m
            JOIN users u ON u.id = m.sender_id
            WHERE conversation_id = ?
            ORDER BY created_at ASC
        ");
        $stmt->execute([$convId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function send($convId, $senderId, $content) {
        $stmt = $this->db->prepare("
            INSERT INTO messages (conversation_id, sender_id, content)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$convId, $senderId, $content]);
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("
            DELETE FROM messages WHERE id = ? AND sender_id = ?
        ");
        return $stmt->execute([$id, $userId]);
    }
}