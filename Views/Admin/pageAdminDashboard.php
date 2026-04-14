<div class="admin-wrapper">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-icon">⚙️</div>
            <div>
                <div class="admin-brand-title">Administration</div>
                <div class="admin-brand-sub">BikePark</div>
            </div>
        </div>
        <nav class="admin-nav">
            <span class="admin-nav-label">Menu</span>
            <a href="/admin" class="admin-nav-item active">
                <span class="admin-nav-icon">📊</span> Dashboard
            </a>
            <a href="/admin/utilisateurs" class="admin-nav-item">
                <span class="admin-nav-icon">👥</span> Utilisateurs
            </a>
            <a href="/admin/reservations" class="admin-nav-item">
                <span class="admin-nav-icon">📋</span> Réservations
            </a>
            <a href="/admin/materiels" class="admin-nav-item">
                <span class="admin-nav-icon">🚵</span> Matériels
            </a>
            <a href="/admin/bikepark" class="admin-nav-item">
                <span class="admin-nav-icon">🏔️</span> BikePark
            </a>
        </nav>
        <div class="admin-sidebar-footer">
            <a href="/home" class="admin-back">← Retour au site</a>
        </div>
    </aside>

    <!-- CONTENU -->
    <main class="admin-main">

        <div class="admin-header">
            <div class="admin-header-left">
                <div class="admin-breadcrumb">
                    <a href="/home">BikePark</a> › Administration
                </div>
                <h1 class="admin-title">Dashboard</h1>
                <p class="admin-subtitle">Bonjour <strong><?= htmlspecialchars($_SESSION["user"]->client_prenom) ?></strong>, voici un aperçu de votre site.</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="admin-stat-top">
                    <div class="admin-stat-icon stat-icon-green">👥</div>
                    <span class="admin-stat-trend trend-up">↑ actifs</span>
                </div>
                <div class="admin-stat-num"><?= $stats["clients"] ?></div>
                <div class="admin-stat-label">Utilisateurs</div>
                <a href="/admin/utilisateurs" class="admin-stat-link">Voir les comptes →</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-top">
                    <div class="admin-stat-icon stat-icon-blue">📋</div>
                    <span class="admin-stat-trend trend-up">↑ total</span>
                </div>
                <div class="admin-stat-num"><?= $stats["reservations"] ?></div>
                <div class="admin-stat-label">Réservations</div>
                <a href="/admin/reservations" class="admin-stat-link">Voir les réservations →</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-top">
                    <div class="admin-stat-icon stat-icon-orange">🚵</div>
                    <span class="admin-stat-trend trend-up">disponibles</span>
                </div>
                <div class="admin-stat-num"><?= $stats["materiels_dispo"] ?></div>
                <div class="admin-stat-label">Matériels dispo</div>
                <a href="/admin/materiels" class="admin-stat-link">Gérer les matériels →</a>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-top">
                    <div class="admin-stat-icon stat-icon-purple">🏔️</div>
                    <span class="admin-stat-trend trend-up">↑ entrées</span>
                </div>
                <div class="admin-stat-num"><?= $stats["bikeparks"] ?></div>
                <div class="admin-stat-label">Entrées BikePark</div>
                <a href="/admin/bikepark" class="admin-stat-link">Voir les entrées →</a>
            </div>
        </div>

        <!-- Accès rapides -->
        <div class="admin-section">
            <h2 class="admin-section-title">Accès rapides</h2>
            <div class="admin-quick-grid">
                <a href="/admin/utilisateurs" class="admin-quick-card">
                    <div class="admin-quick-icon">👥</div>
                    <strong>Utilisateurs</strong>
                    <p>Voir et supprimer les comptes</p>
                </a>
                <a href="/admin/reservations" class="admin-quick-card">
                    <div class="admin-quick-icon">📋</div>
                    <strong>Réservations</strong>
                    <p>Changer les statuts, supprimer</p>
                </a>
                <a href="/admin/materiels" class="admin-quick-card">
                    <div class="admin-quick-icon">🚵</div>
                    <strong>Matériels</strong>
                    <p>Disponibilité, suppression</p>
                </a>
                <a href="/admin/bikepark" class="admin-quick-card">
                    <div class="admin-quick-icon">🏔️</div>
                    <strong>BikePark</strong>
                    <p>Voir et supprimer les entrées</p>
                </a>
            </div>
        </div>

    </main>
</div>