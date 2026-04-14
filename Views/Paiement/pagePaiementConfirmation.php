<section class="resa-hero">
    <div class="resa-hero-content">
        <div class="section-label">✅ Confirmation</div>
        <h1 class="section-title">Paiement <span style="color:var(--green)">Accepté !</span></h1>
        <p>Votre réservation est confirmée. À bientôt sur les pistes !</p>
    </div>
</section>

<div class="resa-wrapper">
    <div class="paiement-confirmation">

        <div class="confirmation-icon">✅</div>
        <h2>Merci <?= htmlspecialchars($_SESSION["user"]->client_prenom) ?> !</h2>
        <p>Votre paiement de <strong><?= number_format($_SESSION["montant_total"] ?? 0, 2) ?>€</strong> a bien été enregistré.</p>

        <div class="confirmation-details">
            <div class="recap-row">
                <span>Mode de paiement</span>
                <span><?= htmlspecialchars($_SESSION["mode_paiement"] ?? "") ?></span>
            </div>
            <div class="recap-row recap-total">
                <span>Montant payé</span>
                <span><?= number_format($_SESSION["montant_total"] ?? 0, 2) ?>€</span>
            </div>
        </div>

        <div class="confirmation-btns">
            <a href="/home" class="btn-primary">🏠 Retour à l'accueil</a>
            <a href="/profil" class="btn-resa-outline">👤 Mon profil</a>
        </div>

    </div>
</div>
<?php
    // ✅ Nettoyer la session APRÈS l'affichage
    unset($_SESSION["reservation_materiel"]);
    unset($_SESSION["montant_total"]);
    unset($_SESSION["mode_paiement"]);
?>