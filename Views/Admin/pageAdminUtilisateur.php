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
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › <a href="/admin/utilisateurs">Utilisateurs</a> › <?= htmlspecialchars($client->client_prenom . " " . $client->client_nom) ?></div>
                <h1 class="admin-title"><?= htmlspecialchars($client->client_prenom . " " . $client->client_nom) ?></h1>
                <p class="admin-subtitle">Fiche client <span class="admin-id">#<?= $client->client_ID ?></span></p>
            </div>
            <div class="admin-header-right">
                <a href="/admin/utilisateurs" class="admin-btn" style="text-decoration:none;">← Retour à la liste</a>
            </div>
        </div>

        <!-- Informations client -->
        <div class="admin-section">
            <h2 class="admin-section-title">👤 Informations du client</h2>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <tbody>
                        <tr><th>ID</th><td><span class="admin-id">#<?= $client->client_ID ?></span></td></tr>
                        <tr><th>Nom</th><td><?= htmlspecialchars($client->client_nom) ?></td></tr>
                        <tr><th>Prénom</th><td><?= htmlspecialchars($client->client_prenom) ?></td></tr>
                        <tr><th>Email</th><td><?= htmlspecialchars($client->client_email) ?></td></tr>
                        <tr><th>Téléphone</th><td><?= htmlspecialchars($client->client_telephone ?? "—") ?></td></tr>
                        <tr><th>Âge</th><td><?= htmlspecialchars($client->client_age ?? "—") ?></td></tr>
                        <tr><th>Ville</th><td><?= htmlspecialchars($client->client_ville ?? "—") ?></td></tr>
                        <tr><th>Niveau</th><td><?= htmlspecialchars($client->client_niveau ?? "—") ?></td></tr>
                        <tr><th>Abonnement actif</th><td>
                            <?php if ($client->client_abonnementActif == 1) : ?>
                                <span class="admin-badge badge-success">✓ Actif</span>
                            <?php else : ?>
                                <span class="admin-badge badge-neutral">Inactif</span>
                            <?php endif ?>
                        </td></tr>
                        <tr><th>Date d'inscription</th><td><?= htmlspecialchars($client->client_dateInscription ?? "—") ?></td></tr>
                        <tr><th>Login</th><td>
                            <?php if ($client->client_login === "admin") : ?>
                                <span class="admin-badge badge-admin">👑 admin</span>
                            <?php else : ?>
                                <?= htmlspecialchars($client->client_login) ?>
                            <?php endif ?>
                        </td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Réservations matériel -->
        <div class="admin-section" style="margin-top:30px;">
            <h2 class="admin-section-title">🚵 Réservations Matériel</h2>
            <?php if (empty($reservations)) : ?>
                <p>Aucune réservation pour ce client.</p>
            <?php else : ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th><th>Matériel</th><th>Date</th><th>Lieu</th>
                                <th>Horaires</th><th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $r) : ?>
                            <tr>
                                <td><span class="admin-id">#<?= $r->reserve_ID ?></span></td>
                                <td><?= htmlspecialchars($r->materiel_nom ?? "—") ?> <small>(<?= htmlspecialchars($r->materiel_type ?? "") ?>)</small></td>
                                <td><?= htmlspecialchars($r->reserve_date ?? "—") ?></td>
                                <td><?= htmlspecialchars($r->reserve_lieu ?? "—") ?></td>
                                <td><?= htmlspecialchars($r->reserve_heureDebut ?? "—") ?> → <?= htmlspecialchars($r->reserve_heureFin ?? "—") ?></td>
                                <td><?= htmlspecialchars($r->reserve_statut ?? "—") ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>

        <!-- Entrées BikePark -->
        <div class="admin-section" style="margin-top:30px;">
            <h2 class="admin-section-title">🏔️ Entrées BikePark</h2>
            <?php if (empty($commandesBikepark)) : ?>
                <p>Aucun paiement BikePark pour ce client.</p>
            <?php else : ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID Paiement</th><th>Date Paiement</th><th>Montant</th><th>Mode</th>
                                <th>Date Entrée</th><th>Type Billet</th><th>Nb pistes</th><th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandesBikepark as $p) : ?>
                            <tr>
                                <td><span class="admin-id">#<?= $p->payer_ID ?></span></td>
                                <td><?= htmlspecialchars($p->payer_datePaiement ?? "—") ?></td>
                                <td><?= htmlspecialchars($p->payer_montantTotal ?? "—") ?>€</td>
                                <td><?= htmlspecialchars($p->payer_modePaiement ?? "—") ?></td>
                                <td><?= htmlspecialchars($p->park_dateEntre ?? "—") ?></td>
                                <td><?= htmlspecialchars($p->park_typeBillet ?? "—") ?></td>
                                <td><?= htmlspecialchars($p->park_nombrePistes ?? "—") ?></td>
                                <td><?= htmlspecialchars($p->park_statutPaiement ?? "—") ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
        </div>
    </main>
</div>
