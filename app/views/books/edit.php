<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/profil/profil.css">

<div class="edit-book-page">
    <h2>Modifier le livre</h2>

    <form method="POST" action="<?= BASE_URL ?>books/update">
        <input type="hidden" name="id" value="<?= $livre['id'] ?>">

        <label>Titre</label>
        <input type="text" name="title" value="<?= htmlspecialchars($livre['title']) ?>" required>

        <label>Auteur</label>
        <input type="text" name="author" value="<?= htmlspecialchars($livre['author']) ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($livre['description']) ?></textarea>

        <button type="submit">Enregistrer</button>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
