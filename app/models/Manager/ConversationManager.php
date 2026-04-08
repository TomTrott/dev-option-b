<?php

require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/Conversation.php';

class ConversationManager extends Model {

    // Récupère toutes les conversations d'un utilisateur avec le username de l'autre
    public function getByUser($userId) {
        $stmt = $this->db->prepare("
            SELECT c.*, u.username,
                   m.content AS last_message, m.created_at AS time
            FROM conversations c
            -- on joint le username de l'autre utilisateur
            JOIN users u ON u.id = CASE WHEN c.user1_id = ? THEN c.user2_id ELSE c.user1_id END
            -- on joint le dernier message
            LEFT JOIN messages m ON m.id = (
                SELECT id FROM messages 
                WHERE conversation_id = c.id 
                ORDER BY created_at DESC 
                LIMIT 1
            )
            WHERE c.user1_id = ? OR c.user2_id = ?
            ORDER BY time DESC
        ");
        $stmt->execute([$userId, $userId, $userId]);

        $convs = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $convs[] = new Conversation($data);
        }

        return $convs;
    }

    // Trouve ou crée une conversation entre deux utilisateurs
    public function findOrCreate($user1, $user2) {
        $stmt = $this->db->prepare("
            SELECT * FROM conversations 
            WHERE (user1_id = ? AND user2_id = ?)
               OR (user1_id = ? AND user2_id = ?)
        ");
        $stmt->execute([$user1, $user2, $user2, $user1]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) return $data['id'];

        $stmt = $this->db->prepare("
            INSERT INTO conversations (user1_id, user2_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$user1, $user2]);

        return $this->db->lastInsertId();
    }
}