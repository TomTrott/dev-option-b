<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/books/view.css">

<div class="book-detail">

    <!-- IMAGE -->
    <div class="book-image">
        <?php if ($livre->getImage()): ?>
            <img src="<?= BASE_URL ?>uploads/<?= $livre->getImage() ?>" alt="<?= htmlspecialchars($livre->getTitle()) ?>">
        <?php endif; ?>
    </div>

    <!-- INFOS -->
    <div class="book-content">

        <h1><?= htmlspecialchars($livre->getTitle()) ?></h1>
        <p class="author">par <?= htmlspecialchars($livre->getAuthor()) ?></p>

        <div class="separator"></div>

        <h4>DESCRIPTION</h4>

        <p class="description">
            <?= nl2br(htmlspecialchars($livre->getDescription())) ?>
        </p>

        <!-- PROPRIETAIRE -->
        <div class="owner">
            <p>PROPRIÉTAIRE</p>

            <div class="owner-box">
                <div class="avatar"></div>
                <span><?= htmlspecialchars($livre->getUsername() ?? 'Inconnu') ?></span>
            </div>
        </div>

        <?php if ($livre->getUserId() != $_SESSION['user_id']): ?>

            <a href="<?= BASE_URL ?>messages/start?user=<?= $livre->getUserId() ?>" class="btn-contact">
                Envoyer un message
            </a>

        <?php else: ?>

            <p class="own-book">C'est votre livre</p>

        <?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>