<?php

require_once __DIR__ . '/../../../core/Model.php';
require_once __DIR__ . '/../Entity/Conversation.php';

class ConversationManager extends Model {

    public function getByUser($userId) {
        $stmt = $this->db->prepare("
            SELECT * FROM conversations
            WHERE user1_id = ? OR user2_id = ?
        ");
        $stmt->execute([$userId, $userId]);

        $convs = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $convs[] = new Conversation($data);
        }

        return $convs;
    }

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