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
            <a href="/admin/reservations" class="admin-nav-item"><span class="admin-nav-icon">📋</span> Réservations</a>
            <a href="/admin/materiels" class="admin-nav-item active"><span class="admin-nav-icon">🚵</span> Matériels</a>
            <a href="/admin/bikepark" class="admin-nav-item"><span class="admin-nav-icon">🏔️</span> BikePark</a>
        </nav>
        <div class="admin-sidebar-footer"><a href="/home" class="admin-back">← Retour au site</a></div>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <div class="admin-header-left">
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › Matériels</div>
                <h1 class="admin-title">Matériels</h1>
                <p class="admin-subtitle"><?= count($materiels) ?> matériels enregistrés</p>
            </div>
            <div class="admin-header-right">
                <a href="/admin/materiels/ajouter" style="display:inline-flex;align-items:center;gap:0.4rem;background:var(--green-dark);color:#fff;border-radius:var(--radius-sm);padding:0.65rem 1.2rem;font-size:0.88rem;font-weight:600;text-decoration:none;transition:background var(--transition);">➕ Ajouter un matériel</a>
            </div>
        </div>

        <div class="admin-section">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr><th>ID</th><th>Nom</th><th>Type</th><th>Taille</th><th>Tarif/j</th><th>État</th><th>Disponibilité</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($materiels as $mat) : ?>
                        <tr>
                            <td><span class="admin-id">#<?= $mat->materiel_ID ?></span></td>
                            <td><strong><?= htmlspecialchars($mat->materiel_nom) ?></strong></td>
                            <td><?= htmlspecialchars($mat->materiel_type) ?></td>
                            <td><?= htmlspecialchars($mat->materiel_taille ?? '—') ?></td>
                            <td><strong style="color:var(--green-dark)"><?= htmlspecialchars($mat->materiel_tarifLocation) ?>€</strong></td>
                            <td><?= htmlspecialchars($mat->materiel_etatMateriel) ?></td>
                            <td>
                                <?php if($mat->materiel_disponibilite == 1) : ?>
                                    <span class="admin-badge badge-success">✓ Disponible</span>
                                <?php else : ?>
                                    <span class="admin-badge badge-danger">✗ Indisponible</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <div style="display:flex; gap:0.4rem; align-items:center;">
                                    <form method="POST" action="/admin/materiels">
                                        <input type="hidden" name="materiel_ID" value="<?= $mat->materiel_ID ?>">
                                        <input type="hidden" name="materiel_disponibilite" value="<?= $mat->materiel_disponibilite == 1 ? 0 : 1 ?>">
                                        <button type="submit" name="toggleDispo" class="admin-btn-edit">
                                            <?= $mat->materiel_disponibilite == 1 ? '🔒 Désactiver' : '🔓 Activer' ?>
                                        </button>
                                    </form>
                                    <form method="POST" action="/admin/materiels" onsubmit="return confirm('Supprimer ?')">
                                        <input type="hidden" name="materiel_ID" value="<?= $mat->materiel_ID ?>">
                                        <button type="submit" name="deleteMateriel" class="admin-btn-delete">🗑️</button>
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