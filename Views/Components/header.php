<!-- NAVBAR -->
<nav>
    <div class="logo">Bike<span>Park</span></div>
    <ul>
        <li><a href="/home" class="active">Accueil</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#pistes">Pistes</a></li>
        <li><a href="/fournisseur">Fournisseur</a></li>
        <?php if(isset($_SESSION["user"])) : ?>
            <?php if(isAdmin()) : ?>
                <li><a href="/admin" style="color:var(--green);font-weight:700;">⚙️ Admin</a></li>
            <?php endif ?>
            <li><a href="/profil">Mon profil</a></li>
            <li><a href="/mes-commandes">Mes commandes</a></li>
            <li><a href="/deconnection">Déconnexion</a></li>
            <li><a href="/deleteProfil">Supprimer compte</a></li>
        <?php else : ?>
            <li><a href="/connection">Connexion</a></li>
            <li><a href="/inscription">S'inscrire</a></li>
        <?php endif ?>
    </ul>
</nav>