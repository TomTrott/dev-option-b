<?php require_once __DIR__ . '/../layout/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>styles/profil/profil.css">

<div class="profile-page">
    <h2 class="page-title">Mon compte</h2>

    <div class="profile-top">
        <!-- CARD GAUCHE -->
        <div class="profile-left">
            <div class="avatar"></div>
            <p class="edit-link">modifier</p>
            <hr>
            <h3><?= htmlspecialchars($user['username']) ?></h3>
            <?php
            $createdAt = new DateTime($user['created_at']);
            $now = new DateTime();
            $interval = $createdAt->diff($now);

            if ($interval->y > 0) {
                $membreDepuis = $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
            } elseif ($interval->m > 0) {
                $membreDepuis = $interval->m . ' mois';
            } else {
                $membreDepuis = $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
            }
            ?>
            <p class="member">Membre depuis <?= $membreDepuis ?></p>
            <p class="library-count"><?= count($livres ?? []) ?> livres</p>
        </div>

        <!-- CARD DROITE -->
        <div class="profile-right">
            <h3>Vos informations personnelles</h3>
            <form method="POST" action="<?= BASE_URL ?>profile/update">
                <label>Pseudo</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

                <label>Bio</label>
                <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>

                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- TABLE LIVRES -->
    <div class="profile-books">

    <div class="profile-books-header">
        <h3>Ma bibliothèque</h3>
        <a href="<?= BASE_URL ?>books/create" class="btn-add">+ Ajouter un livre</a>
    </div>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($livres)): ?>
                    <?php foreach ($livres as $livre): ?>
                        <tr>
                            <td>
                                <?php if (!empty($livre['image'])): ?>
                                    <img src="<?= BASE_URL ?>uploads/<?= $livre['image'] ?>" alt="">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($livre['title']) ?></td>
                            <td><?= htmlspecialchars($livre['author']) ?></td>
                            <td>
                                <?= !empty($livre['description'])
                                    ? htmlspecialchars(substr($livre['description'], 0, 80)) . '...'
                                    : '-' ?>
                            </td>
                            <td>
                                <span class="status <?= $livre['is_available'] ? 'ok' : 'no' ?>">
                                    <?= $livre['is_available'] ? 'disponible' : 'non dispo.' ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>books/edit?id=<?= $livre['id'] ?>">Éditer</a>
                                <a href="<?= BASE_URL ?>books/toggleAvailability?id=<?= $livre['id'] ?>&isAvailable=<?= !$livre['is_available'] ?>">
                                    <?= $livre['is_available'] ? 'Rendre indisponible' : 'Rendre disponible' ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Aucun livre</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
