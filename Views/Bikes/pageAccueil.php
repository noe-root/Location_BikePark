<?php /* Views/Bikes/pageAccueil.php */ ?>
<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-tag">🚵 Bienvenue au BikePark</div>
        <h1>Ride la <span>nature</span>,<br>réserve ta piste.</h1>
        <p>Louez votre VTT et réservez votre piste en quelques clics. Pour tous les niveaux, du débutant au rider confirmé.</p>
        <div class="hero-btns">
            <a href="/inscription" class="btn-primary">Commencer l'aventure</a>
            <a href="#pistes" class="btn-outline">Voir les pistes</a>
        </div>
    </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="stat">
        <div class="stat-num">6</div>
        <div class="stat-label">Pistes disponibles</div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat">
        <div class="stat-num">50+</div>
        <div class="stat-label">VTT en location</div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat">
        <div class="stat-num">3</div>
        <div class="stat-label">Niveaux de difficulté</div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat">
        <div class="stat-num">4.9★</div>
        <div class="stat-label">Note des riders</div>
    </div>
</div>

<!-- SERVICES -->
<section id="services">
    <div class="section">
        <div class="section-label">Ce qu'on propose</div>
        <h2 class="section-title">Nos services</h2>
        <p class="section-sub">Tout ce dont vous avez besoin pour une journée parfaite sur les pistes.</p>

        <div class="services-grid">
            <div class="service-card">
                <span class="service-icon">🚵</span>
                <h3>Location de VTT</h3>
                <p>Choisissez parmi notre flotte de VTT haut de gamme, entretenus quotidiennement. Casque et protections inclus dans chaque location.</p>
                <a href="/materiel" class="service-link">Réserver un VTT →</a>
            </div>
            <div class="service-card">
                <span class="service-icon">🏔️</span>
                <h3>Réservation de pistes</h3>
                <p>Réservez votre créneau sur nos pistes exclusives. Évitez l'attente et profitez pleinement de votre session en toute tranquillité.</p>
                <a href="/reservation-bikepark" class="service-link">Réserver une piste →</a>
            </div>
        </div>
    </div>
</section>

<!-- PISTES -->
<section class="pistes-section" id="pistes">
    <div class="section-label">Les terrains de jeu</div>
    <h2 class="section-title">Nos pistes</h2>
    <p class="section-sub">3 niveaux de difficulté pour des sensations adaptées à chaque rider.</p>

    <div class="pistes-grid">
        <div class="piste-card">
            <span class="piste-difficulty diff-green">Débutant</span>
            <h3>La Verte</h3>
            <p>3,2 km • Dénivelé 80m • Idéale pour débuter</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
        <div class="piste-card">
            <span class="piste-difficulty diff-green">Débutant</span>
            <h3>La Forestière</h3>
            <p>4,0 km • Dénivelé 100m • Balade en forêt</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
        <div class="piste-card">
            <span class="piste-difficulty diff-blue">Intermédiaire</span>
            <h3>La Rocheuse</h3>
            <p>5,8 km • Dénivelé 240m • Passages techniques</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
        <div class="piste-card">
            <span class="piste-difficulty diff-blue">Intermédiaire</span>
            <h3>La Cascade</h3>
            <p>6,5 km • Dénivelé 300m • Virages serrés</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
        <div class="piste-card">
            <span class="piste-difficulty diff-black">Expert</span>
            <h3>La Noire</h3>
            <p>7,1 km • Dénivelé 420m • Réservé aux experts</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
        <div class="piste-card">
            <span class="piste-difficulty diff-black">Expert</span>
            <h3>L'Extrême</h3>
            <p>9,0 km • Dénivelé 600m • Pour les meilleurs riders</p>
            <a href="/reservation-bikepark"><button class="piste-reserve">Réserver</button></a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="section-label">Prêt à rider ?</div>
    <h2 class="section-title">Réservez maintenant</h2>
    <p>Créez votre compte gratuitement et réservez votre prochaine session en quelques clics.</p>
    <a href="/inscription" class="btn-primary">Créer un compte</a>
</section>
