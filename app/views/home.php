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

<!-- Comment ça marche -->
<div class="how-it-works">
    <div class="container">
        <h2>Comment ça marche ?</h2>
        <p class="subtitle">
            Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
        </p>

        <div class="steps">
            <div class="step">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="step">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="step">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </div>
            <div class="step">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </div>
        </div>

        <a href="<?= BASE_URL ?>exchange/index" class="btn-main">
            Voir tous les livres
        </a>
    </div>
</div>

<!-- Image bibliothèque -->
<div class="library-banner"></div>

<!-- Nos valeurs -->
<div class="values">
    <div class="container values-content">
        <div class="text">
            <h2>Nos valeurs</h2>

            <p>
                Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté.
                Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs.
                Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
            </p>

            <p>
                Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
            </p>

            <p>
                Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter,
                de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
            </p>

            <span class="signature">L’équipe Tom Troc</span>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
