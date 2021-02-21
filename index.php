<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$mangas = $bdd->query('SELECT nom, nb_chap FROM mangas ORDER BY date_update DESC');
$mangas->execute();

//$chap = $bdd->query('SELECT nb_chap FROM mangas WHERE nom = ?');
//$chap->execute(array($donnees['nom']));
//$number = $chap->fetch();

?>

<!DOCTYPE html>
<html class="" id="toggle_page">
<head>
	<title>Volp'Gang - Accueil</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mangas.css">
</head>
<body>
	<?php include 'complements/header.php' ?>

    <div align="center">

        <p class="title_container">Actualités</p>

        <div class="announces">
            <p><u>Création du site de la VGS !</u></p>
        </div>
    </div>

    <div align="center">
        <p class="title_container">Dernières sorties</p>
    </div>
        <div align="center">
            <?php
            $affiche = 5;
            $count = 0;
            while ($donnees = $mangas->fetch() and $count < $affiche):
            $count += 1; ?>
                <div class="solo">
                    <a href="main.php?name=<?= $donnees['nom'] ?>&chap=<?= $donnees['nb_chap'] ?>">
                        <img class="image_solo" src="img/mangas/<?= $donnees['nom'] ?>.jpg">
                        <p class="name"><?= $donnees['nom'] ?></p>
                        <p class="name">Chapitre <?= $donnees['nb_chap'] ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

</body>
    <?php include 'complements/footer.php' ?>
</html>

