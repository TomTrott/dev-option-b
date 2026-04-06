<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/books/view.css">

<div class="book-detail">

    <!-- IMAGE -->
    <div class="book-image">
        <img src="<?= BASE_URL ?>uploads/<?= $livre['image'] ?>" alt="">
    </div>

    <!-- INFOS -->
    <div class="book-content">

        <h1><?= htmlspecialchars($livre['title']) ?></h1>
        <p class="author">par <?= htmlspecialchars($livre['author']) ?></p>

        <div class="separator"></div>

        <h4>DESCRIPTION</h4>

        <p class="description">
            <?= nl2br(htmlspecialchars($livre['description'])) ?>
        </p>

        <!-- PROPRIETAIRE -->
        <div class="owner">
            <p>PROPRIÉTAIRE</p>

            <div class="owner-box">
                <div class="avatar"></div>
                <span><?= htmlspecialchars($livre['username']) ?></span>
            </div>
        </div>

        <?php if ($livre['user_id'] != $_SESSION['user_id']): ?>

    <a href="<?= BASE_URL ?>messages/start?user=<?= $livre['user_id'] ?>" class="btn-contact">
        Envoyer un message
    </a>

<?php else: ?>

    <p class="own-book">C'est votre livre</p>

<?php endif; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>