<!-- HERO BANNIÈRE -->
<section class="shop-hero">
    <div class="shop-hero-content">
        <div class="section-label">🛒 Notre catalogue</div>
        <h1 class="section-title">Matériels & <span style="color:var(--green)">Équipements</span></h1>
        <p>Location de VTT, casques, protections et accessoires. Tout le nécessaire pour rider en toute sécurité.</p>
    </div>
</section>

<!-- FILTRES -->
<div class="shop-filters-bar">
    <div class="shop-filters">
        <button class="filter-btn active" onclick="filterCards(this, 'all')">Tout voir</button>
        <button class="filter-btn" onclick="filterCards(this, 'VTT')">🚵 VTT</button>
        <button class="filter-btn" onclick="filterCards(this, 'Protection')">🦺 Protections</button>
        <button class="filter-btn" onclick="filterCards(this, 'Accessoire')">🧤 Accessoires</button>
    </div>
    <div class="shop-count">
        <span id="product-count"><?= count($materiel) ?></span> produits
    </div>
</div>

<!-- GRILLE PRODUITS -->
<div class="shop-wrapper">
    <div class="shop-grid" id="shop-grid">
        <?php foreach($materiel as $item) : ?>
        <div class="product-card" data-type="<?= htmlspecialchars($item->materiel_type) ?>">

            <!-- Image placeholder selon le type -->
            <div class="product-img">
                <div class="product-img-placeholder">
                    <?php
                        $id = $item -> materiel_ID;
                        $type = strtolower($item->materiel_type);
                        if (str_contains($type, 'vtt') || str_contains($type, 'vélo')) echo '<img src="images/'.$id.'.jpeg" alt="">';
                        elseif (str_contains($type, 'protection')) echo '<img src="images/'.$id.'.jpeg" alt="">';
                        elseif (str_contains($type, 'gant')) echo '🧤';
                        elseif (str_contains($type, 'lunette')) echo '🥽';
                        else echo '<img src="images/'.$id.'.jpeg" alt="">';
                    ?>
                </div>

                <!-- Badge disponibilité -->
                <?php if($item->materiel_disponibilite == 1) : ?>
                    <span class="product-badge badge-available">Disponible</span>
                <?php else : ?>
                    <span class="product-badge badge-unavailable">Indisponible</span>
                <?php endif ?>

                <!-- Badge état -->
                <span class="product-state"><?= htmlspecialchars($item->materiel_etatMateriel) ?></span>
            </div>

            <!-- Infos produit -->
            <div class="product-body">
                <div class="product-type"><?= htmlspecialchars($item->materiel_type) ?></div>
                <h3 class="product-name"><?= htmlspecialchars($item->materiel_nom) ?></h3>

                <div class="product-meta">
                    <?php if($item->materiel_modele) : ?>
                        <span class="meta-tag">📋 <?= htmlspecialchars($item->materiel_modele) ?></span>
                    <?php endif ?>
                    <?php if($item->materiel_taille) : ?>
                        <span class="meta-tag">📐 Taille <?= htmlspecialchars($item->materiel_taille) ?></span>
                    <?php endif ?>
                    <?php if($item->materiel_annee) : ?>
                        <span class="meta-tag">📅 <?= htmlspecialchars($item->materiel_annee) ?></span>
                    <?php endif ?>
                </div>

                <div class="product-revision">
                    🔧 Dernière révision : <?= htmlspecialchars($item->materiel_dateDerniereRevision) ?>
                </div>
            </div>

            <!-- Prix + bouton -->
            <div class="product-footer">
                <div class="product-price">
                    <span class="price-amount"><?= htmlspecialchars($item->materiel_tarifLocation) ?>€</span>
                    <span class="price-unit">/ jour</span>
                </div>
                <?php if($item->materiel_disponibilite == 1) : ?>
                    <a href="/reservation-materiel"><button class="btn-reserve">Réserver →</button></a>
                <?php else : ?>
                    <button class="btn-reserve btn-reserve-disabled" disabled>Indisponible</button>
                <?php endif ?>
            </div>

        </div>
        <?php endforeach ?>
    </div>
</div>

<script>
function filterCards(btn, type) {
    // Mise à jour boutons actifs
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Filtrage des cartes
    const cards = document.querySelectorAll('.product-card');
    let count = 0;
    cards.forEach(card => {
        const cardType = card.dataset.type.toLowerCase();
        if (type === 'all' || cardType.includes(type.toLowerCase())) {
            card.style.display = 'flex';
            count++;
        } else {
            card.style.display = 'none';
        }
    });
    document.getElementById('product-count').textContent = count;
}
</script>