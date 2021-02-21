<?php
include 'complements/header.php';
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$sortie = $bdd->query('SELECT * FROM mangas WHERE nom = "' . $_GET['name'] . '"');
?>
<html class="" id="toggle_page">
<link rel="stylesheet" type="text/css" href="css/mangas.css">
<title><?= $_GET['name'] ?></title>

<?php
while ($donnees = $sortie->fetch()):
    if ($_GET['name'] == $donnees['nom']) {
        ?>
        <h1 class="title_pres"><?= $donnees['nom'] ?></h1>
        <div class="pres">
            <div class="image_pres">
                <img class="image_solo" src="img/mangas/<?= $donnees['nom'] ?>.jpg">
            </div>
            <div class="texte_pres">
                <p>Nom alternatifs : <?= $donnees['nom_alternatifs'] ?></p>
                <p>Auteur(s) : <?= $donnees['auteur'] ?></p>
                <p>Artiste(s) : <?= $donnees['artiste'] ?></p>
                <p>Status : <?= $donnees['status'] ?></p>
                <p>Date de sortie : <?= $donnees['annee'] ?></p>
                <p>Genres :  <?= $donnees['genre'] ?></p>
                <p>Description : <?= $donnees['description'] ?></p>
            </div>
        </div>
        <div class="link">
            <p><?= $donnees['nom'] ?> - Liste des chapitres :</p>
            <?php
            $i = 0;
            while ($i < $donnees['nb_chap']):
                ?>
                <a href="main.php?name=<?= $donnees['nom'] ?>&chap=<?= $i += 1 ?>">Chapitre <?= $i ?></a>
            <?php endwhile; ?>
        </div>

    <?php }
endwhile;
include 'complements/footer.php'; ?>
</html>