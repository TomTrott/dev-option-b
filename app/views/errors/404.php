<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/404/404.css">

<main class="main-content">
        <div class="error-page">
            <div class="error-card">
                <h1>404</h1>
                <h2>Page introuvable</h2>
                <p>La page que vous cherchez n'existe pas ou accès interdit.</p>
                <a href="<?= BASE_URL ?>" class="btn-home">Retour à l'accueil</a>
            </div>
        </div>
    </main>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>