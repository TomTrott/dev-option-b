<?php

require_once __DIR__ . '/../../core/Model.php';

class Conversation extends Model {

    // récupérer conversations utilisateur
    public function getByUser($userId) {
        $stmt = $this->db->prepare("
            SELECT c.*,
                   u.username,
                   m.content as last_message,
                   m.created_at as time
            FROM conversations c
            JOIN users u 
                ON u.id = IF(c.user1_id = ?, c.user2_id, c.user1_id)
            LEFT JOIN messages m 
                ON m.id = (
                    SELECT id FROM messages 
                    WHERE conversation_id = c.id 
                    ORDER BY created_at DESC LIMIT 1
                )
            WHERE c.user1_id = ? OR c.user2_id = ?
            ORDER BY m.created_at DESC
        ");
        $stmt->execute([$userId, $userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // créer ou récupérer conversation
    public function findOrCreate($user1, $user2) {

        $stmt = $this->db->prepare("
            SELECT * FROM conversations 
            WHERE (user1_id = ? AND user2_id = ?)
               OR (user1_id = ? AND user2_id = ?)
        ");
        $stmt->execute([$user1, $user2, $user2, $user1]);

        $conv = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($conv) return $conv['id'];

        $stmt = $this->db->prepare("
            INSERT INTO conversations (user1_id, user2_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$user1, $user2]);

        return $this->db->lastInsertId();
    }
}