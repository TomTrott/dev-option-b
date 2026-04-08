<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/profil/profil.css">

<div class="edit-book-page">
    <h2>Modifier le livre</h2>

    <form method="POST" action="<?= BASE_URL ?>books/update" enctype="multipart/form-data">
        <!-- ID du livre -->
        <input type="hidden" name="id" value="<?= $livre->getId() ?>">

        <!-- Titre -->
        <label>Titre</label>
        <input type="text" name="title" value="<?= htmlspecialchars($livre->getTitle()) ?>" required>

        <!-- Auteur -->
        <label>Auteur</label>
        <input type="text" name="author" value="<?= htmlspecialchars($livre->getAuthor()) ?>" required>

        <!-- Description -->
        <label>Description</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($livre->getDescription()) ?></textarea>

        <!-- Optionnel : ajouter un champ pour modifier l'image -->
        <label>Image (optionnel)</label>
        <input type="file" name="image">

        <button type="submit">Enregistrer</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>