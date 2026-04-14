<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-icon">⚙️</div>
            <div><div class="admin-brand-title">Administration</div><div class="admin-brand-sub">BikePark</div></div>
        </div>
        <nav class="admin-nav">
            <span class="admin-nav-label">Menu</span>
            <a href="/admin" class="admin-nav-item"><span class="admin-nav-icon">📊</span> Dashboard</a>
            <a href="/admin/utilisateurs" class="admin-nav-item"><span class="admin-nav-icon">👥</span> Utilisateurs</a>
            <a href="/admin/reservations" class="admin-nav-item active"><span class="admin-nav-icon">📋</span> Réservations</a>
            <a href="/admin/materiels" class="admin-nav-item"><span class="admin-nav-icon">🚵</span> Matériels</a>
            <a href="/admin/bikepark" class="admin-nav-item"><span class="admin-nav-icon">🏔️</span> BikePark</a>
        </nav>
        <div class="admin-sidebar-footer"><a href="/home" class="admin-back">← Retour au site</a></div>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <div class="admin-header-left">
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › Réservations</div>
                <h1 class="admin-title">Réservations</h1>
                <p class="admin-subtitle"><?= count($reservations) ?> réservations au total</p>
            </div>
        </div>

        <div class="admin-section">
            <form method="POST" action="/admin/reservations" onsubmit="return confirmBatchDelete('reservations[]', 'Supprimer les réservations sélectionnées ?')">
                <div style="margin-bottom:10px;">
                    <button type="submit" name="deleteReservationsBatch" class="admin-btn-delete">
                        🗑️ Supprimer sélection
                    </button>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAllReservations" onclick="toggleAll(this, 'reservations[]')" aria-label="Sélectionner toutes les réservations"></th>
                                <th>ID</th><th>Client</th><th>Matériel</th><th>Date</th>
                                <th>Lieu</th><th>Horaires</th><th>Statut</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reservations as $r) : ?>
                            <tr>
                                <td><input type="checkbox" name="reservations[]" value="<?= $r->reserve_ID ?>" aria-label="Sélectionner réservation #<?= $r->reserve_ID ?>"></td>
                                <td><span class="admin-id">#<?= $r->reserve_ID ?></span></td>
                                <td><strong><?= htmlspecialchars($r->client_prenom . " " . $r->client_nom) ?></strong></td>
                                <td>
                                    <?= htmlspecialchars($r->materiel_nom) ?><br>
                                    <small style="color:var(--text-muted)"><?= htmlspecialchars($r->materiel_type) ?></small>
                                </td>
                                <td><?= htmlspecialchars($r->reserve_date) ?></td>
                                <td><?= htmlspecialchars($r->reserve_lieu) ?></td>
                                <td>
                                    <span style="font-size:0.82rem">
                                        <?= htmlspecialchars($r->reserve_heureDebut) ?> → <?= htmlspecialchars($r->reserve_heureFin) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $badgeClass = match($r->reserve_statut) {
                                            "Confirmée" => "badge-success",
                                            "Annulé"    => "badge-danger",
                                            "Terminée"  => "badge-neutral",
                                            default     => "badge-warning"
                                        };
                                    ?>
                                    <span class="admin-badge <?= $badgeClass ?>"><?= htmlspecialchars($r->reserve_statut) ?></span>
                                </td>
                                <td>
                                    <form method="POST" action="/admin/reservations" style="display:flex;gap:0.4rem;align-items:center">
                                        <input type="hidden" name="reserve_ID" value="<?= $r->reserve_ID ?>">
                                        <select name="reserve_statut" class="admin-select-small">
                                            <option value="Confirmée" <?= $r->reserve_statut === "Confirmée" ? "selected" : "" ?>>Confirmée</option>
                                            <option value="Annulé"    <?= $r->reserve_statut === "Annulé"    ? "selected" : "" ?>>Annulé</option>
                                            <option value="Terminée"  <?= $r->reserve_statut === "Terminée"  ? "selected" : "" ?>>Terminée</option>
                                        </select>
                                        <button type="submit" name="updateStatut" class="admin-btn-edit">✏️</button>
                                    </form>
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