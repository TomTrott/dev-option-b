<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/auth/auth.css">

<div class="auth-container">
    <!-- GAUCHE : FORMULAIRE -->
    <div class="auth-left">
        <div class="auth-card">
            <h2>Inscription</h2>
            <?php if (!empty($_SESSION['register_error'])): ?>
    <div class="auth-error">
        <?= $_SESSION['register_error']; ?>
    </div>
    <?php unset($_SESSION['register_error']); ?>
<?php endif; ?>
            <form method="POST" action="<?= BASE_URL ?>auth/store">
                <!-- nom utilisateur --> <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <!-- email --> <input type="email" name="email" placeholder="Adresse email" required>
                <!-- mot de passe --> <input type="password" name="password" placeholder="Mot de passe" required>
                <!-- bouton --> <button type="submit" class="btn"> S'inscrire </button>
            </form> <!-- lien connexion -->
            <p class="auth-link"> Déjà un compte ?
                <a href="<?= BASE_URL ?>auth/login">Se connecter</a>
            </p>
        </div>
    </div>
    <!-- DROITE : IMAGE -->
    <div class="auth-right">

    </div>
</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>