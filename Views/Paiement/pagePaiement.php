<!-- HERO -->
<section class="resa-hero">
    <div class="resa-hero-content">
        <div class="section-label">💳 Paiement</div>
        <h1 class="section-title">Finaliser le <span style="color:var(--green)">Paiement</span></h1>
        <p>Choisissez votre mode de paiement et confirmez votre réservation.</p>
    </div>
</section>

<div class="resa-wrapper">

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
                    <span class="resa-card-icon">💳</span>
                    <div>
                        <h2>Vos informations de paiement</h2>
                        <p>Simulation — aucune transaction réelle</p>
                    </div>
                </div>

                <form action="/paiement" method="POST" class="resa-form">

                    <!-- Mode de paiement -->
                    <div class="resa-field">
                        <label>Mode de paiement</label>
                        <div class="billet-grid">
                            <label class="billet-option">
                                <input type="radio" name="modePaiement" value="Carte"
                                       <?= (!isset($_POST["modePaiement"]) || $_POST["modePaiement"] === "Carte") ? "checked" : "" ?>
                                       onchange="this.form.submit()">
                                <div class="billet-card">
                                    <span class="billet-icon">💳</span>
                                    <span class="billet-label">Carte bancaire</span>
                                </div>
                            </label>
                            <label class="billet-option">
                                <input type="radio" name="modePaiement" value="Espèces"
                                       <?= (isset($_POST["modePaiement"]) && $_POST["modePaiement"] === "Espèces") ? "checked" : "" ?>
                                       onchange="this.form.submit()">
                                <div class="billet-card">
                                    <span class="billet-icon">💵</span>
                                    <span class="billet-label">Espèces</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <?php
                        $mode = $_POST["modePaiement"] ?? "Carte";
                    ?>

                    <!-- Champs carte bancaire -->
                    <?php if($mode === "Carte") : ?>

                        <div class="resa-field">
                            <label for="carte_numero">Numéro de carte</label>
                            <input type="text" name="carte_numero" id="carte_numero"
                                   placeholder="1234 5678 9012 3456"
                                   maxlength="19"
                                   value="<?= htmlspecialchars($_POST["carte_numero"] ?? "") ?>">
                            <?php if(isset($messageError["carte_numero"])) : ?>
                                <small><?= $messageError["carte_numero"] ?></small>
                            <?php endif ?>
                        </div>

                        <div class="resa-field">
                            <label for="carte_nom">Nom sur la carte</label>
                            <input type="text" name="carte_nom" id="carte_nom"
                                   placeholder="JEAN DUPONT"
                                   value="<?= htmlspecialchars($_POST["carte_nom"] ?? "") ?>">
                            <?php if(isset($messageError["carte_nom"])) : ?>
                                <small><?= $messageError["carte_nom"] ?></small>
                            <?php endif ?>
                        </div>

                        <div class="resa-field-row">
                            <div class="resa-field">
                                <label for="carte_expiration">Date d'expiration</label>
                                <input type="text" name="carte_expiration" id="carte_expiration"
                                       placeholder="MM/AA" maxlength="5"
                                       value="<?= htmlspecialchars($_POST["carte_expiration"] ?? "") ?>">
                                <?php if(isset($messageError["carte_expiration"])) : ?>
                                    <small><?= $messageError["carte_expiration"] ?></small>
                                <?php endif ?>
                            </div>
                            <div class="resa-field">
                                <label for="carte_cvv">CVV</label>
                                <input type="text" name="carte_cvv" id="carte_cvv"
                                       placeholder="123" maxlength="3"
                                       value="<?= htmlspecialchars($_POST["carte_cvv"] ?? "") ?>">
                                <?php if(isset($messageError["carte_cvv"])) : ?>
                                    <small><?= $messageError["carte_cvv"] ?></small>
                                <?php endif ?>
                            </div>
                        </div>

                    <?php else : ?>

                        <!-- Message espèces -->
                        <div class="paiement-especes">
                            <span>💵</span>
                            <div>
                                <strong>Paiement en espèces</strong>
                                <p>Vous réglez directement sur place à l'accueil du BikePark.</p>
                                <p>Montant à prévoir : <strong style="color:var(--green-dark)"><?= number_format($_SESSION["montant_total"], 2) ?>€</strong></p>
                            </div>
                        </div>

                    <?php endif ?>

                    <!-- Récap -->
                    <div class="resa-recap">
                        <div class="recap-row">
                            <span>Client</span>
                            <span><?= htmlspecialchars($_SESSION["user"]->client_prenom . " " . $_SESSION["user"]->client_nom) ?></span>
                        </div>
                        <div class="recap-row">
                            <span>Mode de paiement</span>
                            <span><?= htmlspecialchars($mode) ?></span>
                        </div>
                        <div class="recap-row recap-total">
                            <span>Total à payer</span>
                            <span><?= number_format($_SESSION["montant_total"], 2) ?>€</span>
                        </div>
                    </div>

                    <button type="submit" name="payerBtn" class="btn-resa">
                        ✅ Confirmer le paiement
                    </button>

                </form>
            </div>
        </div>

        <!-- INFOS CÔTÉ DROIT -->
        <div class="resa-info-col">
            <div class="resa-info-card">
                <h3>🔒 Paiement sécurisé</h3>
                <ul class="info-list">
                    <li>✅ Simulation fictive uniquement</li>
                    <li>✅ Aucune transaction réelle</li>
                    <li>✅ Données non transmises</li>
                </ul>
            </div>
            <div class="resa-info-card">
                <h3>📋 Récapitulatif</h3>
                <ul class="tarif-list">
                    <li><span>Montant total</span><strong><?= number_format($_SESSION["montant_total"], 2) ?>€</strong></li>
                    <li><span>Mode</span><strong><?= htmlspecialchars($mode) ?></strong></li>
                </ul>
            </div>
            <div class="resa-info-card">
                <h3>❓ Besoin d'aide ?</h3>
                <ul class="info-list">
                    <li>📞 Appelez-nous au 04 XX XX XX XX</li>
                    <li>🕐 Lun-Ven 8h-19h</li>
                </ul>
            </div>
        </div>

    </div>
</div>