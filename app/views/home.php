<?php require_once __DIR__ . '/layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/home/home.css">
<!-- hero accueil -->
<div class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Rejoignez nos <br> lecteurs passionnés</h1>
            <p>
                Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture.
                Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
            </p>
            <a class="btn" href="<?= BASE_URL ?>exchange/index">Découvrir</a>
        </div>
        <div class="hero-image">
            <img src="<?= BASE_URL ?>uploads/banniere.png" alt="bannière">
        </div>
    </div>
</div>

<!-- dernier livres -->
<div class="last-book">
    <div class="section-title">
        <h2>Les derniers livres ajoutés</h2>
    </div>

    <div class="latest-books">
        <?php if (!empty($livres)): ?>
            <?php foreach ($livres as $livre): ?>
    <div class="book-card">
        <?php if ($livre->getImage()): ?>
            <img src="<?= BASE_URL ?>uploads/<?= $livre->getImage() ?>" alt="<?= htmlspecialchars($livre->getTitle()) ?>">
        <?php endif; ?>

        <div class="book-info">
            <h3><?= htmlspecialchars($livre->getTitle()) ?></h3>
            <p>Auteur: <em><?= htmlspecialchars($livre->getAuthor()) ?></em></p>
            <p class="seller">Vendu par : <?= htmlspecialchars($livre->getUsername() ?? 'Inconnu') ?></p> <!-- gestion d'erreur si username est null -->
        </div>
    </div>
<?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre pour le moment</p>
        <?php endif; ?>
    </div>

    <!-- Conteneur pour centrer le bouton -->
    <div class="btn-container">
        <a class="btn-2" href="<?= BASE_URL ?>exchange/index">Voir tous les livres</a>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
