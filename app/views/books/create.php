<?php require_once __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/profil/profil.css">

<div class="edit-book-page">
    <h2>Ajouter un livre</h2>

    <form method="POST" action="<?= BASE_URL ?>books/store" enctype="multipart/form-data">

        <label>Titre</label>
        <input type="text" name="title" required>

        <label>Auteur</label>
        <input type="text" name="author" required>

        <label>Description</label>
        <textarea name="description" rows="4"></textarea>

        <label>Image</label>
        <input type="file" name="image">

        <label>Disponibilité</label>
        <select name="isAvailable">
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>

        <button type="submit">Ajouter</button>

    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>