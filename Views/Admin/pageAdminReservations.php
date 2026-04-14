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
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th><th>Client</th><th>Matériel</th><th>Date</th>
                            <th>Lieu</th><th>Horaires</th><th>Statut</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reservations as $r) : ?>
                        <tr>
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
                                <div style="display:flex; gap:0.4rem; align-items:center;">
                                    <form method="POST" action="/admin/reservations" style="display:flex;gap:0.4rem;align-items:center">
                                        <input type="hidden" name="reserve_ID" value="<?= $r->reserve_ID ?>">
                                        <select name="reserve_statut" class="admin-select-small">
                                            <option value="Confirmée" <?= $r->reserve_statut === "Confirmée" ? "selected" : "" ?>>Confirmée</option>
                                            <option value="Annulé"    <?= $r->reserve_statut === "Annulé"    ? "selected" : "" ?>>Annulé</option>
                                            <option value="Terminée"  <?= $r->reserve_statut === "Terminée"  ? "selected" : "" ?>>Terminée</option>
                                        </select>
                                        <button type="submit" name="updateStatut" class="admin-btn-edit">✏️</button>
                                    </form>
                                    <form method="POST" action="/admin/reservations" onsubmit="return confirm('Supprimer ?')">
                                        <input type="hidden" name="reserve_ID" value="<?= $r->reserve_ID ?>">
                                        <button type="submit" name="deleteReservation" class="admin-btn-delete">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>