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
                <p class="admin-subtitle">Remplissez tous les champs obligatoires pour enregistrer un nouveau matériel.</p>
            </div>
        </div>

        <?php if (!empty($errors)) : ?>
            <div class="admin-section" style="background:var(--red-light,#fef2f2);border:1px solid var(--red,#ef4444);border-radius:0.5rem;padding:1rem;margin-bottom:1rem;">
                <ul style="margin:0;padding-left:1.2rem;color:var(--red,#ef4444);">
                    <?php foreach ($errors as $err) : ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <div class="admin-section">
            <form method="POST" action="/admin/materiels/ajouter" class="admin-form">

                <div class="admin-form-group">
                    <label class="admin-form-label" for="fournisseur_ID">Fournisseur <span style="color:red">*</span></label>
                    <?php if (!empty($fournisseurs)) : ?>
                        <select id="fournisseur_ID" name="fournisseur_ID" class="admin-form-input" required>
                            <option value="">— Sélectionner un fournisseur —</option>
                            <?php foreach ($fournisseurs as $f) : ?>
                                <option value="<?= $f->fournisseur_ID ?>"
                                    <?= (isset($_POST["fournisseur_ID"]) && $_POST["fournisseur_ID"] == $f->fournisseur_ID) ? "selected" : "" ?>>
                                    #<?= $f->fournisseur_ID ?> — <?= htmlspecialchars($f->fournisseur_nom ?? $f->fournisseur_ID) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    <?php else : ?>
                        <input type="number" id="fournisseur_ID" name="fournisseur_ID" class="admin-form-input"
                               value="<?= htmlspecialchars($_POST["fournisseur_ID"] ?? "") ?>"
                               placeholder="ID du fournisseur" min="1" required>
                    <?php endif ?>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_nom">Nom <span style="color:red">*</span></label>
                    <input type="text" id="materiel_nom" name="materiel_nom" class="admin-form-input"
                           value="<?= htmlspecialchars($_POST["materiel_nom"] ?? "") ?>"
                           placeholder="Ex : VTT Enduro Pro" required maxlength="100">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_type">Type <span style="color:red">*</span></label>
                    <select id="materiel_type" name="materiel_type" class="admin-form-input" required>
                        <option value="">— Sélectionner un type —</option>
                        <?php foreach (["VTT", "Vélo de route", "Vélo électrique", "Trottinette", "Casque", "Protection", "Autre"] as $type) : ?>
                            <option value="<?= $type ?>"
                                <?= (isset($_POST["materiel_type"]) && $_POST["materiel_type"] === $type) ? "selected" : "" ?>>
                                <?= $type ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_modele">Modèle <span style="color:red">*</span></label>
                    <input type="text" id="materiel_modele" name="materiel_modele" class="admin-form-input"
                           value="<?= htmlspecialchars($_POST["materiel_modele"] ?? "") ?>"
                           placeholder="Ex : Trek Slash 9.9" required maxlength="100">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_taille">Taille <span style="color:red">*</span></label>
                    <select id="materiel_taille" name="materiel_taille" class="admin-form-input" required>
                        <option value="">— Sélectionner une taille —</option>
                        <?php foreach (["XS", "S", "M", "L", "XL", "XXL", "Unique"] as $taille) : ?>
                            <option value="<?= $taille ?>"
                                <?= (isset($_POST["materiel_taille"]) && $_POST["materiel_taille"] === $taille) ? "selected" : "" ?>>
                                <?= $taille ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_tarifLocation">Tarif de location (€/jour) <span style="color:red">*</span></label>
                    <input type="number" id="materiel_tarifLocation" name="materiel_tarifLocation" class="admin-form-input"
                           value="<?= htmlspecialchars($_POST["materiel_tarifLocation"] ?? "") ?>"
                           placeholder="Ex : 35.00" min="0" step="0.01" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_annee">Année <span style="color:red">*</span></label>
                    <input type="number" id="materiel_annee" name="materiel_annee" class="admin-form-input"
                           value="<?= htmlspecialchars($_POST["materiel_annee"] ?? date("Y")) ?>"
                           placeholder="Ex : 2024" min="2000" max="<?= date("Y") + 1 ?>" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_etatMateriel">État <span style="color:red">*</span></label>
                    <select id="materiel_etatMateriel" name="materiel_etatMateriel" class="admin-form-input" required>
                        <option value="">— Sélectionner un état —</option>
                        <?php foreach (["Neuf", "Très bon", "Bon", "Correct", "À réviser"] as $etat) : ?>
                            <option value="<?= $etat ?>"
                                <?= (isset($_POST["materiel_etatMateriel"]) && $_POST["materiel_etatMateriel"] === $etat) ? "selected" : "" ?>>
                                <?= $etat ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="materiel_dateDerniereRevision">Date dernière révision <span style="color:red">*</span></label>
                    <input type="date" id="materiel_dateDerniereRevision" name="materiel_dateDerniereRevision" class="admin-form-input"
                           value="<?= htmlspecialchars($_POST["materiel_dateDerniereRevision"] ?? date("Y-m-d")) ?>" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                        <input type="checkbox" name="materiel_disponibilite" value="1"
                               <?= (!isset($_POST["addMateriel"]) || isset($_POST["materiel_disponibilite"])) ? "checked" : "" ?>
                               style="width:1.1rem;height:1.1rem;">
                        Disponible immédiatement
                    </label>
                </div>

                <div style="display:flex;gap:1rem;margin-top:1.5rem;">
                    <button type="submit" name="addMateriel" class="admin-btn-add">✅ Enregistrer le matériel</button>
                    <a href="/admin/materiels" class="admin-btn-edit" style="text-decoration:none;display:inline-flex;align-items:center;">← Annuler</a>
                </div>

            </form>
        </div>
    </main>
</div>
