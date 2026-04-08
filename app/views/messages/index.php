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
                <div class="conversation <?= ($currentConv == $conv->getId()) ? 'active' : '' ?>"
                     onclick="window.location.href='<?= BASE_URL ?>messages?conv=<?= $conv->getId() ?>'">

                    <div class="avatar"></div>

                    <div class="conv-info">
                        <div class="top">
                            <!-- Utilisation du getter getUsername() au lieu de l'accès tableau -->
                            <span class="name"><?= htmlspecialchars($conv->getUsername() ?? 'Inconnu') ?></span>
                            <span class="time">
                                <!-- Utilisation du getter getTime() -->
                                <?= $conv->getTime() ? date('H:i', strtotime($conv->getTime())) : '' ?>
                            </span>
                        </div>

                        <p>
                            <!-- Utilisation du getter getLastMessage() -->
                            <?= !empty($conv->getLastMessage()) 
                                ? htmlspecialchars(substr($conv->getLastMessage(), 0, 30)) . '...' 
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
                        // Correction du header pour utiliser les getters
                        foreach ($conversations as $conv) {
                            if ($conv->getId() == $currentConv) {
                                echo htmlspecialchars($conv->getUsername() ?? 'Inconnu');
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
                        <div class="message <?= $msg->getSenderId() == $_SESSION['user_id'] ? 'right' : 'left' ?>">

                            <?php if ($msg->getSenderId() != $_SESSION['user_id']): ?>
                                <div class="avatar small"></div>
                            <?php endif; ?>

                            <div>
                                <span class="time">
                                    <?= date('d/m H:i', strtotime($msg->getCreatedAt())) ?>
                                </span>

                                <div class="bubble">
                                    <?= htmlspecialchars($msg->getContent()) ?>
                                </div>

                                <?php if ($msg->getSenderId() == $_SESSION['user_id']): ?>
                                    <a href="<?= BASE_URL ?>messages/delete?id=<?= $msg->getId() ?>&conv=<?= $currentConv ?>" 
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