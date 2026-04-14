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
            <a href="/admin/materiels" class="admin-nav-item"><span class="admin-nav-icon">🚵</span> Matériels</a>
            <a href="/admin/bikepark" class="admin-nav-item active"><span class="admin-nav-icon">🏔️</span> BikePark</a>
        </nav>
        <div class="admin-sidebar-footer"><a href="/home" class="admin-back">← Retour au site</a></div>
    </aside>

    <main class="admin-main">
        <div class="admin-header">
            <div class="admin-header-left">
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › BikePark</div>
                <h1 class="admin-title">BikePark</h1>
                <p class="admin-subtitle"><?= count($bikeparks) ?> entrées enregistrées</p>
            </div>
        </div>

        <div class="admin-section">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr><th>ID</th><th>Date d'entrée</th><th>Type billet</th><th>Tarif</th><th>Nb pistes</th><th>Paiement</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach($bikeparks as $bp) : ?>
                        <tr>
                            <td><span class="admin-id">#<?= $bp->bikepark_ID ?></span></td>
                            <td><?= htmlspecialchars($bp->park_dateEntre) ?></td>
                            <td><?= htmlspecialchars($bp->park_typeBillet) ?></td>
                            <td><strong style="color:var(--green-dark)"><?= htmlspecialchars($bp->park_tarifEntre) ?>€</strong></td>
                            <td><?= htmlspecialchars($bp->park_nombrePistes) ?></td>
                            <td>
                                <?php if($bp->park_statutPaiement === "Payé") : ?>
                                    <span class="admin-badge badge-success">✓ Payé</span>
                                <?php else : ?>
                                    <span class="admin-badge badge-warning"><?= htmlspecialchars($bp->park_statutPaiement) ?></span>
                                <?php endif ?>
                            </td>
                            <td>
                                <form method="POST" action="/admin/bikepark" onsubmit="return confirm('Supprimer cette entrée ?')">
                                    <input type="hidden" name="bikepark_ID" value="<?= $bp->bikepark_ID ?>">
                                    <button type="submit" name="deleteBikepark" class="admin-btn-delete">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>