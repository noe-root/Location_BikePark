<!-- HERO -->
<section class="resa-hero">
    <div class="resa-hero-content">
        <div class="section-label">🎟️ Réservation</div>
        <h1 class="section-title">Réserver le <span style="color:var(--green)">BikePark</span></h1>
        <p>Choisissez votre type de billet et réservez votre entrée en quelques secondes.</p>
    </div>
</section>

<!-- CONTENU -->
<div class="resa-wrapper">

    <!-- Message succès -->
    <?php if(isset($success)) : ?>
        <div class="resa-alert alert-success">
            ✅ Votre réservation BikePark a bien été enregistrée !
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
                    <span class="resa-card-icon">🏔️</span>
                    <div>
                        <h2>Votre réservation</h2>
                        <p>Remplissez les informations ci-dessous</p>
                    </div>
                </div>

                <form action="/reservation-bikepark" method="POST" class="resa-form">

                    <!-- Date -->
                    <div class="resa-field">
                        <label for="park_dateEntre">Date d'entrée</label>
                        <input type="datetime-local" name="park_dateEntre" id="park_dateEntre"
                               min="<?= date('Y-m-d\TH:i') ?>" required>
                        <?php if(isset($messageError["park_dateEntre"])) : ?>
                            <small><?= $messageError["park_dateEntre"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Type de billet -->
                    <div class="resa-field">
                        <label for="park_typeBillet">Type de billet</label>
                        <div class="billet-grid">
                            <?php foreach($tarifs as $type => $prix) : ?>
                                <label class="billet-option">
                                    <input type="radio" name="park_typeBillet" value="<?= $type ?>"
                                           <?= $type === "Journée" ? "checked" : "" ?>>
                                    <div class="billet-card">
                                        <span class="billet-icon">
                                            <?= $type === "Journée" ? "☀️" : ($type === "Demi-journée" ? "🌤️" : "🌙") ?>
                                        </span>
                                        <span class="billet-label"><?= $type ?></span>
                                        <span class="billet-prix"><?= $prix ?>€</span>
                                    </div>
                                </label>
                            <?php endforeach ?>
                        </div>
                        <?php if(isset($messageError["park_typeBillet"])) : ?>
                            <small><?= $messageError["park_typeBillet"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Nombre de pistes -->
                    <div class="resa-field">
                        <label for="park_nombrePistes">Nombre de pistes</label>
                        <div class="resa-number-input">
                            <button type="button" onclick="changeValue('park_nombrePistes', -1)">−</button>
                            <input type="number" name="park_nombrePistes" id="park_nombrePistes"
                                   value="1" min="1" max="6" required>
                            <button type="button" onclick="changeValue('park_nombrePistes', 1)">+</button>
                        </div>
                        <?php if(isset($messageError["park_nombrePistes"])) : ?>
                            <small><?= $messageError["park_nombrePistes"] ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Récap tarif -->
                    <div class="resa-recap">
                        <div class="recap-row">
                            <span>Type de billet</span>
                            <span id="recap-type">Journée</span>
                        </div>
                        <div class="recap-row recap-total">
                            <span>Tarif</span>
                            <span id="recap-prix">35.00€</span>
                        </div>
                        <small class="recap-note">💳 Statut de paiement : <strong>Payé</strong></small>
                    </div>

                    <button type="submit" name="reserverBikepark" class="btn-resa">
                        Confirmer la réservation →
                    </button>

                </form>
            </div>
        </div>

        <!-- INFOS CÔTÉ DROIT -->
        <div class="resa-info-col">
            <div class="resa-info-card">
                <h3>🎟️ Nos tarifs</h3>
                <ul class="tarif-list">
                    <li><span>☀️ Journée</span><strong>35€</strong></li>
                    <li><span>🌤️ Demi-journée</span><strong>25€</strong></li>
                    <li><span>🌙 Soirée</span><strong>20€</strong></li>
                </ul>
            </div>
            <div class="resa-info-card">
                <h3>📋 Infos pratiques</h3>
                <ul class="info-list">
                    <li>✅ Réservation confirmée immédiatement</li>
                    <li>✅ Accès à toutes les pistes inclus</li>
                    <li>✅ Casque obligatoire (location disponible)</li>
                    <li>✅ Ouvert 7j/7 de 8h à 20h</li>
                </ul>
            </div>
            <div class="resa-info-card resa-info-link">
                <h3>🚵 Besoin d'un vélo ?</h3>
                <p>Réservez aussi votre matériel en même temps !</p>
                <a href="/reservation-materiel" class="btn-resa-outline">Réserver un vélo →</a>
            </div>
        </div>

    </div>
</div>

<script>
    const tarifs = { "Journée": 35, "Demi-journée": 25, "Soirée": 20 };

    // Mise à jour récap en temps réel
    document.querySelectorAll('input[name="park_typeBillet"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.getElementById('recap-type').textContent = radio.value;
            document.getElementById('recap-prix').textContent = tarifs[radio.value] + '.00€';
        });
    });

    // Boutons +/-
    function changeValue(id, delta) {
        const input = document.getElementById(id);
        const newVal = parseInt(input.value) + delta;
        if (newVal >= input.min && newVal <= input.max) input.value = newVal;
    }
</script>