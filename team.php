<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$leader = $bdd->query('SELECT * FROM team WHERE grade = "Leader"');
$chef = $bdd->query('SELECT * FROM team WHERE grade Like ("Chef%") OR ("Cheffe%")');
$sous_chef = $bdd->query('SELECT * FROM team WHERE grade Like ("Sous-chef%") OR ("Sous-cheffe%")');
$trad = $bdd->query('SELECT * FROM team WHERE role Like("%trad%")');
$check = $bdd->query('SELECT * FROM team WHERE role Like("%check%")');
$clean = $bdd->query('SELECT * FROM team WHERE role Like("%clean%")');
$edit = $bdd->query('SELECT * FROM team WHERE role Like("%edit%")');
$coloriste = $bdd->query('SELECT * FROM team WHERE role Like("%coloriste%")');
$dev = $bdd->query('SELECT * FROM team WHERE grade = "Développeur"');
?>
<html class="" id="toggle_page">
<head>
    <title>Volp'Gang - La Team</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/team.css">
</head>

<body class="team">
<?php include 'complements/header.php' ?>

<h1>La team :</h1>

<div class="team">
    <!--leader-->
    <div class="categorie">
        <h3><u>Chef suprême :</u></h3>
        <div class="group">
            <?php while ($donnees = $leader->fetch()): ?>
            <div class="solo" style="padding: 7px;">
                <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                <p class="name"><?= $donnees['pseudo'] ?></p>
                <p class="desc">Chef de la team</p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--chef-->
    <div class="categorie">
        <h3><u>Chef de rôle :</u></h3>
        <div class="group">
            <?php while ($donnees = $chef->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                    <p><?= $donnees['grade'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--sous-chef-->
    <div class="categorie">
        <h3><u>Sous-chef de rôle :</u></h3>
        <div class="group">
            <?php while ($donnees = $sous_chef->fetch()): ?>
                <div class="solo souschef">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                    <p><?= $donnees['grade'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--traducteur-->
    <div class="categorie">
        <h3><u>Traducteurs :</u></h3>
        <div class="group">
            <?php while ($donnees = $trad->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--checkeur-->
    <div class="categorie">
        <h3><u>Checkeurs :</u></h3>
        <div class="group">
            <?php while ($donnees = $check->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--cleaneur-->
    <div class="categorie">
        <h3><u>Cleaneurs :</u></h3>
        <div class="group">
            <?php while ($donnees = $clean->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--editeur-->
    <div class="categorie">
        <h3><u>Editeurs :</u></h3>
        <div class="group">
            <?php while ($donnees = $edit->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!--coloriste-->
    <div class="categorie">
        <h3><u>Coloristes :</u></h3>
        <div class="group">
            <?php while ($donnees = $coloriste->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="categorie">
        <h3><u>Dev :</u></h3>
        <div class="group">
            <?php while ($donnees = $dev->fetch()): ?>
                <div class="solo">
                    <img src="img/team/<?= $donnees['pseudo'] ?>.jpg">
                    <p><?= $donnees['pseudo'] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</div>

<?php require 'complements/footer.php' ?>
</body>
</html>