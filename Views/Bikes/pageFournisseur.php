<h1 class="titre">Fournisseur</h1>
<?php foreach($fournisseur as $fournisseur) : ?>
        <div class = "fournisseur">
            <h3><?= $fournisseur->fournisseur_nom ?></h3>
            <p><?= $fournisseur->fournisseur_telephone ?></p>
            <p><?= $fournisseur->fournisseur_email ?></p>
            <p><span><?= $fournisseur->fournisseur_adresse ?></span> - <span><?= $fournisseur->fournisseur_ville ?></span></p>
            <p>Evaluation du fournisseur : <?= $fournisseur->fournisseur_noteQualite ?></p>
        </div>
    <?php endforeach ?>
</div>