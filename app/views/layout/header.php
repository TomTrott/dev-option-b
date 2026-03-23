<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Book Exchange</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>styles/layout/layout.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <div class="logo">TT</div>
        <span class="site-name">Tom Troc</span>

        <a href="<?= BASE_URL ?>">Accueil</a>
        <a href="<?= BASE_URL ?>exchange/index">Nos livres à l'échange</a>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="#">Messagerie</a>
            <a href="<?= BASE_URL ?>profile/index">Mon compte</a>
            <a href="<?= BASE_URL ?>auth/logout">Déconnexion</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>auth/login">Connexion</a>
        <?php endif; ?>
    </div>
</nav>