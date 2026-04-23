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
                <div class="admin-breadcrumb"><a href="/admin">Dashboard</a> › <a href="/admin/materiels">Matériels</a> › Ajouter</div>
                <h1 class="admin-title">Ajouter un matériel</h1>
                <p class="admin-subtitle">Remplissez les informations du nouveau matériel</p>
            </div>
        </div>

        <?php if (!empty($errors)) : ?>
            <div class="admin-alert admin-alert-danger">
                <ul style="margin:0; padding-left:1.2rem;">
                    <?php foreach ($errors as $err) : ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <div class="admin-section">
            <form method="POST" action="/admin/materiels/ajouter" class="admin-form">
                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_nom">Nom du matériel <span style="color:red">*</span></label>
                    <input class="admin-form-input" type="text" id="materiel_nom" name="materiel_nom"
                           value="<?= htmlspecialchars($old['materiel_nom'] ?? '') ?>"
                           required placeholder="Ex : VTT Enduro, Casque S…">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_type">Type <span style="color:red">*</span></label>
                    <input class="admin-form-input" type="text" id="materiel_type" name="materiel_type"
                           value="<?= htmlspecialchars($old['materiel_type'] ?? '') ?>"
                           required placeholder="Ex : VTT, Casque, Protection…">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_taille">Taille <span style="color:var(--gray-500); font-size:.85em">(optionnel)</span></label>
                    <input class="admin-form-input" type="text" id="materiel_taille" name="materiel_taille"
                           value="<?= htmlspecialchars($old['materiel_taille'] ?? '') ?>"
                           placeholder="Ex : S, M, L, XL ou 26″…">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_tarifLocation">Tarif de location (€/jour) <span style="color:red">*</span></label>
                    <input class="admin-form-input" type="number" id="materiel_tarifLocation" name="materiel_tarifLocation"
                           value="<?= htmlspecialchars($old['materiel_tarifLocation'] ?? '') ?>"
                           required min="0" step="0.01" placeholder="Ex : 25.00">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_etatMateriel">État du matériel <span style="color:red">*</span></label>
                    <input class="admin-form-input" type="text" id="materiel_etatMateriel" name="materiel_etatMateriel"
                           value="<?= htmlspecialchars($old['materiel_etatMateriel'] ?? '') ?>"
                           required placeholder="Ex : Neuf, Bon état, Usé…">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_disponibilite">Disponibilité <span style="color:red">*</span></label>
                    <select class="admin-form-input" id="materiel_disponibilite" name="materiel_disponibilite" required>
                        <option value="1" <?= (isset($old['materiel_disponibilite']) && $old['materiel_disponibilite'] == '1') || !isset($old) ? 'selected' : '' ?>>✓ Disponible</option>
                        <option value="0" <?= (isset($old['materiel_disponibilite']) && $old['materiel_disponibilite'] == '0') ? 'selected' : '' ?>>✗ Indisponible</option>
                    </select>
                </div>

                <div style="display:flex; gap:1rem; margin-top:1.5rem;">
                    <button type="submit" name="addMateriel" class="admin-btn-add">✅ Enregistrer</button>
                    <a href="/admin/materiels" class="admin-btn-delete" style="text-decoration:none; display:inline-flex; align-items:center;">✖ Annuler</a>
                </div>
            </form>
        </div>
    </main>
</div>
