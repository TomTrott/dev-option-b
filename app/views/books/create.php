<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/books/books.css">

<div class="form-container">
    <div class="form-card">

        <h2>Ajouter un livre</h2>

        <form method="POST" action="<?= BASE_URL ?>books/store" enctype="multipart/form-data">

            <input type="text" name="title" placeholder="Titre" required>
            <input type="text" name="author" placeholder="Auteur" required>

            <textarea name="description" placeholder="Description"></textarea>

            <input type="file" name="image">

            <button type="submit">Ajouter</button>

        </form>

    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>