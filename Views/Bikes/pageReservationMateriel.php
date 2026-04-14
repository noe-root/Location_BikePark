<!-- HERO -->
<section class="resa-hero">
    <div class="resa-hero-content">
        <div class="section-label">🚵 Réservation</div>
        <h1 class="section-title">Réserver un <span style="color:var(--green)">Vélo</span></h1>
        <p>Choisissez votre matériel, votre lieu et vos horaires. C'est prêt en quelques clics !</p>
    </div>
</section>

<!-- CONTENU -->
<div class="resa-wrapper">

    <!-- Message succès -->
    <?php if(isset($success)) : ?>
        <div class="resa-alert alert-success">
            ✅ Votre réservation a bien été enregistrée ! On vous attend sur les pistes 🚵
        </div>
    <?php endif ?>

    <!-- Message erreur -->
    <?php if(isset($error)) : ?>
        <div class="resa-alert alert-error">
            ❌ <?= htmlspecialchars($error) ?>
        </div>
    <?php endif ?>

    <div class="resa-layout">

        <!-- FORMULAIRE -->
        <div class="resa-form-col">
            <div class="resa-card">
                <div class="resa-card-header">
                    <span class="resa-card-icon">🚵</span>
                    <div>
                        <h2>Votre réservation</h2>
                        <p>Remplissez les informations ci-dessous</p>
                    </div>
                </div>

                <form action="/reservation-materiel" method="POST" class="resa-form">

                    <!-- ✅ Champ caché bikepark_ID - Change la valeur par un ID qui existe dans ta table bikepark -->
                    <input type="hidden" name="bikepark_ID" value="1">

                    <!-- Choix matériel -->
                    <div class="resa-field">
                        <label for="materiel_ID">Matériel</label>
                        <select name="materiel_ID" id="materiel_ID" required>
                            <option value="" disabled selected>-- Choisissez un matériel --</option>
                            <?php foreach($materiels as $mat) : ?>
                                <option value="<?= $mat->materiel_ID ?>">
                                    <?= htmlspecialchars($mat->materiel_nom) ?>
                                    — <?= htmlspecialchars($mat->materiel_type) ?>
                                    (<?= htmlspecialchars($mat->materiel_taille ?? 'Taille unique') ?>)
                                    — <?= htmlspecialchars($mat->materiel_tarifLocation) ?>€/j
                                </option>
                            <?php endforeach ?>
                        </select>
                        <?php if(isset($messageError["materiel_ID"])) : ?>
                            <small><?= $messageError["materiel_ID"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Lieu -->
                    <div class="resa-field">
                        <label for="reserve_lieu">Lieu</label>
                        <select name="reserve_lieu" id="reserve_lieu" required>
                            <option value="" disabled selected>-- Choisissez un BikePark --</option>
                            <?php foreach($lieux as $lieu) : ?>
                                <option value="<?= htmlspecialchars($lieu->reserve_lieu) ?>">
                                    <?= htmlspecialchars($lieu->reserve_lieu) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <?php if(isset($messageError["reserve_lieu"])) : ?>
                            <small><?= $messageError["reserve_lieu"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Date -->
                    <div class="resa-field">
                        <label for="reserve_date">Date de réservation</label>
                        <input type="date" name="reserve_date" id="reserve_date"
                               min="<?= date('Y-m-d') ?>" required>
                        <?php if(isset($messageError["reserve_date"])) : ?>
                            <small><?= $messageError["reserve_date"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Heures -->
                    <div class="resa-field-row">
                        <div class="resa-field">
                            <label for="reserve_heureDebut">Heure de début</label>
                            <input type="time" name="reserve_heureDebut" id="reserve_heureDebut"
                                   min="08:00" max="20:00" value="09:00" required>
                            <?php if(isset($messageError["reserve_heureDebut"])) : ?>
                                <small><?= $messageError["reserve_heureDebut"] ?></small>
                            <?php endif ?>
                        </div>
                        <div class="resa-field">
                            <label for="reserve_heureFin">Heure de fin</label>
                            <input type="time" name="reserve_heureFin" id="reserve_heureFin"
                                   min="08:00" max="20:00" value="17:00" required>
                            <?php if(isset($messageError["reserve_heureFin"])) : ?>
                                <small><?= $messageError["reserve_heureFin"] ?></small>
                            <?php endif ?>
                        </div>
                    </div>

                    <!-- Commentaire -->
                    <div class="resa-field">
                        <label for="reserve_commentaire">Commentaire <span class="label-optional">(optionnel)</span></label>
                        <textarea name="reserve_commentaire" id="reserve_commentaire"
                                  rows="3" placeholder="Informations supplémentaires..."></textarea>
                    </div>

                    <!-- Récap -->
                    <div class="resa-recap">
                        <div class="recap-row">
                            <span>Statut</span>
                            <span class="badge-statut">Confirmée</span>
                        </div>
                        <div class="recap-row">
                            <span>Client</span>
                            <span>
                                <?= isset($_SESSION["user"])
                                    ? htmlspecialchars($_SESSION["user"]->client_prenom . " " . $_SESSION["user"]->client_nom)
                                    : "Non connecté" ?>
                            </span>
                        </div>
                    </div>

                    <button type="submit" name="reserverMateriel" class="btn-resa">
                        Confirmer la réservation →
                    </button>

                </form>
            </div>
        </div>

        <!-- INFOS CÔTÉ DROIT -->
        <div class="resa-info-col">
            <div class="resa-info-card">
                <h3>📋 Comment ça marche ?</h3>
                <ol class="steps-list">
                    <li><strong>1.</strong> Choisissez votre matériel</li>
                    <li><strong>2.</strong> Sélectionnez votre BikePark</li>
                    <li><strong>3.</strong> Choisissez votre créneau</li>
                    <li><strong>4.</strong> Confirmez la réservation</li>
                </ol>
            </div>
            <div class="resa-info-card">
                <h3>⏰ Horaires d'ouverture</h3>
                <ul class="info-list">
                    <li>🟢 Lun - Ven : 8h00 - 19h00</li>
                    <li>🟢 Sam - Dim : 8h00 - 20h00</li>
                    <li>🔴 Fermeture : jours fériés</li>
                </ul>
            </div>
            <div class="resa-info-card resa-info-link">
                <h3>🎟️ Pas encore d'entrée ?</h3>
                <p>Réservez aussi votre accès BikePark !</p>
                <a href="/reservation-bikepark" class="btn-resa-outline">Réserver une entrée →</a>
            </div>
        </div>

    </div>
</div>