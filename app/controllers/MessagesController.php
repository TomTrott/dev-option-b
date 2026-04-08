<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/ConversationManager.php';
require_once __DIR__ . '/../models/Manager/MessageManager.php';

class MessagesController extends Controller {

    public function index() {

        $userId = $_SESSION['user_id'];

        $convManager = new ConversationManager();
        $msgManager = new MessageManager();

        $conversations = $convManager->getByUser($userId);

        $currentConv = $_GET['conv'] ?? null;
        $messages = [];

        if ($currentConv) {
            $messages = $msgManager->getByConversation($currentConv);
        }

        $this->view('messages/index', [
            'conversations' => $conversations,
            'messages' => $messages,
            'currentConv' => $currentConv
        ]);
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $msgManager = new MessageManager();

            $message = new Message([
                'conversation_id' => $_POST['conversation_id'],
                'sender_id' => $_SESSION['user_id'],
                'content' => $_POST['content']
            ]);

            $msgManager->send($message);

            header('Location: ' . BASE_URL . 'messages?conv=' . $_POST['conversation_id']);
        }
    }

    public function delete() {
        $msgManager = new MessageManager();
        $msgManager->delete($_GET['id'], $_SESSION['user_id']);

        header('Location: ' . BASE_URL . 'messages?conv=' . $_GET['conv']);
    }

    public function start() {

        $userId = $_SESSION['user_id'];
        $otherUser = $_GET['user'];

        if ($userId == $otherUser) {
            header('Location: ' . BASE_URL . 'exchange');
            exit;
        }

        $convManager = new ConversationManager();
        $convId = $convManager->findOrCreate($userId, $otherUser);

        header('Location: ' . BASE_URL . 'messages?conv=' . $convId);
    }
}