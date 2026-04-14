<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-icon">⚙️</div>
            <div><div class="admin-brand-title">Administration</div><div class="admin-brand-sub">BikePark</div></div>
        </div>
        <nav class="admin-nav">
            <span class="admin-nav-label">Menu</span>
            <a href="/admin" class="admin-nav-item"><span class="admin-nav-icon">📊</span> Dashboard</a>
            <a href="/admin/utilisateurs" class="admin-nav-item active"><span class="admin-nav-icon">👥</span> Utilisateurs</a>
            <a href="/admin/reservations" class="admin-nav-item"><span class="admin-nav-icon">📋</span> Réservations</a>
            <a href="/admin/materiels" class="admin-nav-item"><span class="admin-nav-icon">🚵</span> Matériels</a>
            <a href="/admin/bikepark" class="admin-nav-item"><span class="admin-nav-icon">🏔️</span> BikePark</a>
        </nav>
        <div class="admin-sidebar-footer"><a href="/home" class="admin-back">← Retour au site</a></div>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <div class="admin-header-left">
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › Utilisateurs</div>
                <h1 class="admin-title">Utilisateurs</h1>
                <p class="admin-subtitle"><?= count($clients) ?> comptes enregistrés</p>
            </div>
        </div>

        <div class="admin-section">
            <form method="POST" action="/admin/utilisateurs" onsubmit="return confirmBatchDelete('clients[]', 'Supprimer les utilisateurs sélectionnés ?')">
                <div style="margin-bottom:10px;">
                    <button type="submit" name="deleteClientsBatch" class="admin-btn-delete">
                        🗑️ Supprimer sélection
                    </button>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllClients" onclick="toggleAll(this, 'clients[]')" aria-label="Sélectionner tous les utilisateurs"></th>
                                <th>ID</th><th>Nom</th><th>Email</th><th>Login</th>
                                <th>Ville</th><th>Abonnement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($clients as $client) : ?>
                            <tr>
                                <td>
                                    <?php if($client->client_login !== "admin") : ?>
                                        <input type="checkbox" name="clients[]" value="<?= $client->client_ID ?>" aria-label="Sélectionner <?= htmlspecialchars($client->client_prenom . ' ' . $client->client_nom) ?>">
                                    <?php else : ?>
                                        <span></span>
                                    <?php endif ?>
                                </td>
                                <td><span class="admin-id">#<?= $client->client_ID ?></span></td>
                                <td><strong><?= htmlspecialchars($client->client_prenom . " " . $client->client_nom) ?></strong></td>
                                <td><?= htmlspecialchars($client->client_email) ?></td>
                                <td>
                                    <?php if($client->client_login === "admin") : ?>
                                        <span class="admin-badge badge-admin">👑 admin</span>
                                    <?php else : ?>
                                        <?= htmlspecialchars($client->client_login) ?>
                                    <?php endif ?>
                                </td>
                                <td><?= htmlspecialchars($client->client_ville) ?></td>
                                <td>
                                    <?php if($client->client_abonnementActif == 1) : ?>
                                        <span class="admin-badge badge-success">✓ Actif</span>
                                    <?php else : ?>
                                        <span class="admin-badge badge-neutral">Inactif</span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
function toggleAll(source, name) {
    document.querySelectorAll('input[name="' + name + '"]').forEach(function(cb) {
        cb.checked = source.checked;
    });
}
function confirmBatchDelete(name, message) {
    var checked = document.querySelectorAll('input[name="' + name + '"]:checked');
    if (checked.length === 0) {
        alert('Veuillez sélectionner au moins un élément.');
        return false;
    }
    return confirm(message);
}
</script>