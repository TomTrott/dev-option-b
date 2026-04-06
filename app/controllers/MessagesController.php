<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Conversation.php';
require_once __DIR__ . '/../models/Message.php';

class MessagesController extends Controller {

    public function index() {

        $userId = $_SESSION['user_id'];

        $convModel = new Conversation();
        $msgModel = new Message();

        $conversations = $convModel->getByUser($userId);

        $currentConv = $_GET['conv'] ?? null;
        $messages = [];

        if ($currentConv) {
            $messages = $msgModel->getByConversation($currentConv);
        }

        $this->view('messages/index', [
            'conversations' => $conversations,
            'messages' => $messages,
            'currentConv' => $currentConv
        ]);
    }

    // envoyer message
    public function send() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $msgModel = new Message();

            $msgModel->send(
                $_POST['conversation_id'],
                $_SESSION['user_id'],
                $_POST['content']
            );

            header('Location: ' . BASE_URL . 'messages?conv=' . $_POST['conversation_id']);
        }
    }

    // supprimer message
    public function delete() {

        $msgModel = new Message();

        $msgModel->delete($_GET['id'], $_SESSION['user_id']);

        header('Location: ' . BASE_URL . 'messages?conv=' . $_GET['conv']);
    }

    // bouton depuis page livre
    public function start() {

    $userId = $_SESSION['user_id'];
    $otherUser = $_GET['user'];

    // AUTO-CONVERSATION
    if ($userId == $otherUser) {
        header('Location: ' . BASE_URL . 'exchange');
        exit;
    }

    $convModel = new Conversation();
    $convId = $convModel->findOrCreate($userId, $otherUser);

    header('Location: ' . BASE_URL . 'messages?conv=' . $convId);
}
}