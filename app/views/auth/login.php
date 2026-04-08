<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/auth/auth.css">

<div class="auth-container">

    <!-- PARTIE GAUCHE -->
    <div class="auth-left">
        <div class="auth-card">
            <h2>Connexion</h2>
<?php if (!empty($_SESSION['login_error'])): ?>
    <div class="auth-error">
        <?= $_SESSION['login_error']; ?>
    </div>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>
            <form method="POST" action="<?= BASE_URL ?>auth/authenticate">
                <input type="email" name="email" placeholder="Adresse email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit" class="btn">Se connecter</button>
            </form>

            <p class="auth-link">
                Pas de compte ? 
                <a href="<?= BASE_URL ?>auth/register">Inscrivez-vous</a>
            </p>
        </div>
    </div>

    <!-- PARTIE DROITE (image) -->
    <div class="auth-right"></div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>