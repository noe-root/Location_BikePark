<div class="admin-wrapper" style="display:block;padding:2rem">
    <div class="admin-header" style="margin-bottom:2rem">
        <div class="admin-header-left">
            <div class="admin-breadcrumb"><a href="/home">Accueil</a> › <a href="/profil">Mon profil</a> › Mes commandes</div>
            <h1 class="admin-title">Mes commandes</h1>
            <p class="admin-subtitle">Bonjour <strong><?= htmlspecialchars($_SESSION["user"]->client_prenom . " " . $_SESSION["user"]->client_nom) ?></strong>, voici l'historique de toutes vos commandes.</p>
        </div>
    </div>

    <!-- RÉSERVATIONS MATÉRIEL -->
    <div class="admin-section" style="margin-bottom:2.5rem">
        <h2 class="admin-title" style="font-size:1.2rem;margin-bottom:1rem">🚵 Réservations matériel</h2>
        <?php if (empty($reservations)) : ?>
            <p style="color:var(--text-muted)">Aucune réservation trouvée.</p>
        <?php else : ?>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matériel</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Horaires</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $r) : ?>
                    <tr>
                        <td><span class="admin-id">#<?= $r->reserve_ID ?></span></td>
                        <td>
                            <?= htmlspecialchars($r->materiel_nom ?? '-') ?><br>
                            <small style="color:var(--text-muted)"><?= htmlspecialchars($r->materiel_type ?? '') ?></small>
                        </td>
                        <td><?= htmlspecialchars($r->reserve_date) ?></td>
                        <td><?= htmlspecialchars($r->reserve_lieu) ?></td>
                        <td style="font-size:0.82rem"><?= htmlspecialchars($r->reserve_heureDebut) ?> → <?= htmlspecialchars($r->reserve_heureFin) ?></td>
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
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php endif ?>
    </div>

    <!-- PAIEMENTS BIKEPARK -->
    <div class="admin-section">
        <h2 class="admin-title" style="font-size:1.2rem;margin-bottom:1rem">🏔️ Paiements BikePark</h2>
        <?php if (empty($paiements)) : ?>
            <p style="color:var(--text-muted)">Aucun paiement trouvé.</p>
        <?php else : ?>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID paiement</th>
                        <th>Date paiement</th>
                        <th>Montant</th>
                        <th>Mode</th>
                        <th>Date entrée</th>
                        <th>Type billet</th>
                        <th>Nb pistes</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paiements as $p) : ?>
                    <tr>
                        <td><span class="admin-id">#<?= $p->payer_ID ?></span></td>
                        <td><?= htmlspecialchars($p->payer_datePaiement) ?></td>
                        <td><strong style="color:var(--green-dark)"><?= htmlspecialchars($p->payer_montantTotal) ?>€</strong></td>
                        <td><?= htmlspecialchars($p->payer_modePaiement) ?></td>
                        <td><?= htmlspecialchars($p->park_dateEntre ?? '-') ?></td>
                        <td><?= htmlspecialchars($p->park_typeBillet ?? '-') ?></td>
                        <td><?= htmlspecialchars($p->park_nombrePistes ?? '-') ?></td>
                        <td>
                            <?php if (($p->park_statutPaiement ?? '') === "Payé") : ?>
                                <span class="admin-badge badge-success">✓ Payé</span>
                            <?php else : ?>
                                <span class="admin-badge badge-warning"><?= htmlspecialchars($p->park_statutPaiement ?? '-') ?></span>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php endif ?>
    </div>
</div>
