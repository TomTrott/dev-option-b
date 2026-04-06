<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/messages/messages.css">

<div class="messages-page">

    <!-- SIDEBAR -->
    <div class="messages-sidebar">

        <h2>Messagerie</h2>

        <?php if (empty($conversations)): ?>
            <p class="no-conv">Aucune conversation pour le moment</p>
        <?php else: ?>

            <?php foreach ($conversations as $conv): ?>
                <div class="conversation <?= ($currentConv == $conv['id']) ? 'active' : '' ?>"
                     onclick="window.location.href='<?= BASE_URL ?>messages?conv=<?= $conv['id'] ?>'">

                    <div class="avatar"></div>

                    <div class="conv-info">
                        <div class="top">
                            <span class="name"><?= htmlspecialchars($conv['username']) ?></span>
                            <span class="time">
                                <?= isset($conv['time']) ? date('H:i', strtotime($conv['time'])) : '' ?>
                            </span>
                        </div>

                        <p>
                            <?= !empty($conv['last_message']) 
                                ? htmlspecialchars(substr($conv['last_message'], 0, 30)) . '...' 
                                : 'Aucun message' ?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <!-- CHAT -->
    <div class="messages-chat">

        <?php if (!$currentConv): ?>

            <div class="no-chat">
                <p>Sélectionne une conversation pour commencer</p>
            </div>

        <?php else: ?>

            <!-- HEADER -->
            <div class="chat-header">
                <div class="avatar"></div>
                <span>
                    <?php
                        foreach ($conversations as $conv) {
                            if ($conv['id'] == $currentConv) {
                                echo htmlspecialchars($conv['username']);
                                break;
                            }
                        }
                    ?>
                </span>
            </div>

            <!-- MESSAGES -->
            <div class="chat-body">

                <?php if (empty($messages)): ?>
                    <p class="no-msg">Aucun message pour le moment</p>
                <?php else: ?>

                    <?php foreach ($messages as $msg): ?>

                        <div class="message <?= $msg['sender_id'] == $_SESSION['user_id'] ? 'right' : 'left' ?>">

                            <?php if ($msg['sender_id'] != $_SESSION['user_id']): ?>
                                <div class="avatar small"></div>
                            <?php endif; ?>

                            <div>
                                <span class="time">
                                    <?= date('d/m H:i', strtotime($msg['created_at'])) ?>
                                </span>

                                <div class="bubble">
                                    <?= htmlspecialchars($msg['content']) ?>
                                </div>

                                <?php if ($msg['sender_id'] == $_SESSION['user_id']): ?>
                                    <a href="<?= BASE_URL ?>messages/delete?id=<?= $msg['id'] ?>&conv=<?= $currentConv ?>" 
                                       class="delete-msg">
                                        supprimer
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <!-- INPUT -->
            <div class="chat-input">
                <form method="POST" action="<?= BASE_URL ?>messages/send">
                    <input type="hidden" name="conversation_id" value="<?= $currentConv ?>">
                    <input type="text" name="content" placeholder="Tapez votre message ici" required>
                    <button type="submit">Envoyer</button>
                </form>
            </div>

        <?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>