<h1>Profil</h1>
<form action="" method="post">
    <div class = "espace">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_nom ?><?php endif ?>">
        <?php if(isset($messageError["nom"])) : ?><small><?= $messageError["nom"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_prenom ?><?php endif ?>">
         <?php if(isset($messageError["prenom"])) : ?><small><?= $messageError["prenom"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
             <label for="adressMail">Adresse Mail</label>
             <input type="email" name="adressMail" id="adressMail" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_email ?><?php endif ?>">
             <?php if(isset($messageError["adressMail"])) : ?><small><?= $messageError["adressMail"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="telephone">Telephone</label>
        <input type="tel" name="telephone" id="telephone" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_telephone ?><?php endif ?>">
        <?php if(isset($messageError["telephone"])) : ?><small><?= $messageError["telephone"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_age ?><?php endif ?>">
        <?php if(isset($messageError["age"])) : ?><small><?= $messageError["age"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_ville ?><?php endif ?>">
        <?php if(isset($messageError["ville"])) : ?><small><?= $messageError["ville"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="niveau">Niveau d'experience</label>
        <input type="text" name="niveau" id="niveau" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_niveauExperience ?><?php endif ?>">
        <?php if(isset($messageError["niveau"])) : ?><small><?= $messageError["niveau"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="abonement">Abonement actif (0 ou 1)</label>
        <input type="text" name="abonement" id="abonement" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_abonnementActif ?><?php endif ?>">
        <?php if(isset($messageError["abonement"])) : ?><small><?= $messageError["abonement"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="dateInscription">Date d'inscription</label>
        <input type="date" name="dateInscription" id="dateInscription" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_dateInscription ?><?php endif ?>">
        <?php if(isset($messageError["dateInscription"])) : ?><small><?= $messageError["dateInscription"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_login ?><?php endif ?>">
         <?php if(isset($messageError["login"])) : ?><small><?= $messageError["login"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <label for="password">Mot de passe</label>
        <input type="<?php if(isset($_SESSION["user"])) : ?>text<?php else : ?>password<?php endif ?>" name="password" id="password" value="<?php if(isset($_SESSION["user"])) : ?><?=  $_SESSION["user"]->client_password ?><?php endif ?>">
        <?php if(isset($messageError["password"])) : ?><small><?= $messageError["password"] ?></small><?php endif ?>
    </div>
    <div class = "espace">
        <button type="submit" name="envoyer" value="envoyer">Modifier</button>
    </div>
</form>