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
                <div class="admin-breadcrumb">
                    <a href="/admin">Dashboard</a> ›
                    <a href="/admin/materiels">Matériels</a> › Ajouter
                </div>
                <h1 class="admin-title">Ajouter un matériel</h1>
                <p class="admin-subtitle">Remplissez les informations du nouveau matériel</p>
            </div>
            <div class="admin-header-right">
                <a href="/admin/materiels" class="admin-btn-back">← Retour à la liste</a>
            </div>
        </div>

        <?php if (!empty($formError)) : ?>
            <div class="admin-alert admin-alert-danger">⚠️ <?= htmlspecialchars($formError) ?></div>
        <?php endif ?>

        <div class="admin-section">
            <form method="POST" action="/admin/materiels/ajouter" class="admin-form">
                <div class="admin-form-grid">

                    <div class="admin-form-group">
                        <label for="fournisseur_ID">Fournisseur <span class="required">*</span></label>
                        <?php if (!empty($fournisseurs)) : ?>
                            <select id="fournisseur_ID" name="fournisseur_ID" required>
                                <option value="">— Sélectionner un fournisseur —</option>
                                <?php foreach ($fournisseurs as $f) : ?>
                                    <option value="<?= $f->fournisseur_ID ?>"
                                        <?= (isset($_POST['fournisseur_ID']) && $_POST['fournisseur_ID'] == $f->fournisseur_ID) ? 'selected' : '' ?>>
                                        #<?= $f->fournisseur_ID ?> — <?= htmlspecialchars($f->fournisseur_nom) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        <?php else : ?>
                            <input type="number" id="fournisseur_ID" name="fournisseur_ID" min="1"
                                value="<?= htmlspecialchars($_POST['fournisseur_ID'] ?? '') ?>"
                                placeholder="ID du fournisseur" required>
                        <?php endif ?>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_nom">Nom <span class="required">*</span></label>
                        <input type="text" id="materiel_nom" name="materiel_nom"
                            value="<?= htmlspecialchars($_POST['materiel_nom'] ?? '') ?>"
                            placeholder="Ex : VTT Enduro XL" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_type">Type <span class="required">*</span></label>
                        <input type="text" id="materiel_type" name="materiel_type"
                            value="<?= htmlspecialchars($_POST['materiel_type'] ?? '') ?>"
                            placeholder="Ex : VTT, Casque, Protection…" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_modele">Modèle</label>
                        <input type="text" id="materiel_modele" name="materiel_modele"
                            value="<?= htmlspecialchars($_POST['materiel_modele'] ?? '') ?>"
                            placeholder="Ex : Specialized Stumpjumper">
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_taille">Taille</label>
                        <input type="text" id="materiel_taille" name="materiel_taille"
                            value="<?= htmlspecialchars($_POST['materiel_taille'] ?? '') ?>"
                            placeholder="Ex : M, L, XL, 29 pouces…">
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_disponibilite">Disponibilité <span class="required">*</span></label>
                        <select id="materiel_disponibilite" name="materiel_disponibilite" required>
                            <option value="">— Choisir —</option>
                            <option value="1" <?= (isset($_POST['materiel_disponibilite']) && $_POST['materiel_disponibilite'] === '1') ? 'selected' : '' ?>>✓ Disponible</option>
                            <option value="0" <?= (isset($_POST['materiel_disponibilite']) && $_POST['materiel_disponibilite'] === '0') ? 'selected' : '' ?>>✗ Indisponible</option>
                        </select>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_tarifLocation">Tarif de location (€/jour) <span class="required">*</span></label>
                        <input type="number" id="materiel_tarifLocation" name="materiel_tarifLocation"
                            step="0.01" min="0"
                            value="<?= htmlspecialchars($_POST['materiel_tarifLocation'] ?? '') ?>"
                            placeholder="Ex : 25.00" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_annee">Année</label>
                        <input type="number" id="materiel_annee" name="materiel_annee"
                            min="1990" max="<?= date('Y') + 1 ?>"
                            value="<?= htmlspecialchars($_POST['materiel_annee'] ?? '') ?>"
                            placeholder="Ex : 2023">
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_etatMateriel">État du matériel <span class="required">*</span></label>
                        <input type="text" id="materiel_etatMateriel" name="materiel_etatMateriel"
                            value="<?= htmlspecialchars($_POST['materiel_etatMateriel'] ?? '') ?>"
                            placeholder="Ex : Neuf, Bon état, Usé…" required>
                    </div>

                    <div class="admin-form-group">
                        <label for="materiel_dateDerniereRevision">Date de dernière révision</label>
                        <input type="date" id="materiel_dateDerniereRevision" name="materiel_dateDerniereRevision"
                            value="<?= htmlspecialchars($_POST['materiel_dateDerniereRevision'] ?? '') ?>">
                    </div>

                </div>

                <div class="admin-form-actions">
                    <a href="/admin/materiels" class="admin-btn-cancel">Annuler</a>
                    <button type="submit" name="addMateriel" class="admin-btn-submit">➕ Ajouter le matériel</button>
                </div>
            </form>
        </div>
    </main>
</div>

<style>
.admin-form {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
}
.admin-form::before { display: none; }
.admin-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}
.admin-form-group {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}
.admin-form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text);
}
.admin-form-group .required {
    color: #e05252;
}
.admin-form-group input,
.admin-form-group select {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 0.6rem 0.85rem;
    font-size: 0.88rem;
    color: var(--text);
    font-family: inherit;
    transition: border-color var(--transition);
    width: 100%;
    box-sizing: border-box;
}
.admin-form-group input:focus,
.admin-form-group select:focus {
    outline: none;
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(76,153,76,0.1);
}
.admin-form-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 1.8rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}
.admin-btn-submit {
    background: var(--green-dark);
    color: white;
    border: none;
    border-radius: var(--radius-sm);
    padding: 0.7rem 1.6rem;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    font-family: inherit;
    transition: background var(--transition);
}
.admin-btn-submit:hover {
    background: var(--green);
}
.admin-btn-cancel {
    background: var(--bg2);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 0.65rem 1.4rem;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: background var(--transition);
}
.admin-btn-cancel:hover {
    background: var(--border);
}
.admin-btn-back {
    background: var(--bg2);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 0.65rem 1.2rem;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: background var(--transition);
}
.admin-btn-back:hover {
    background: var(--border);
}
.admin-alert {
    padding: 0.9rem 1.2rem;
    border-radius: var(--radius-sm);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}
.admin-alert-danger {
    background: #fde8e8;
    color: #a83232;
    border: 1px solid #f5b8b8;
}
@media (max-width: 768px) {
    .admin-form-grid { grid-template-columns: 1fr; }
}
</style>
