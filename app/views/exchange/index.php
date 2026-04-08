<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/exchange/exchange.css">

<div class="exchange-container">

    <!-- HEADER -->
    <div class="exchange-header">
        <h2>Nos livres à l'échange</h2>

        <form method="GET" action="<?= BASE_URL ?>exchange/index" class="search-bar">
            <input
                type="text"
                name="search"
                placeholder="Rechercher un livre"
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
            >
        </form>
    </div>

    <!-- GRID -->
    <div class="exchange-books">
        <?php if (!empty($livres)): ?>
            <?php foreach ($livres as $livre): ?>
                <div class="book-card" onclick="window.location.href='<?= BASE_URL ?>books/show?id=<?= $livre->getId() ?>'">
                    <?php if ($livre->getImage()): ?>
                        <img src="<?= BASE_URL ?>uploads/<?= $livre->getImage() ?>" alt="<?= htmlspecialchars($livre->getTitle()) ?>">
                    <?php endif; ?>

                    <div class="book-info">
                        <h3><?= htmlspecialchars($livre->getTitle()) ?></h3>
                        <p><?= htmlspecialchars($livre->getAuthor()) ?></p>
                        <p class="seller">Vendu par : <?= htmlspecialchars($livre->getUsername() ?? 'Inconnu') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre disponible</p>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>