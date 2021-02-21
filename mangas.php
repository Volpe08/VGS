<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$visible = 'visible categorie';
$invisible = 'invisible';
$focus = 'focus';
$no_focus = '';
$input_en_cours = '';
$input_en_pause = '';
$input_termine = '';

$tous = $focus;
$en_cours = $visible;
$en_pause = $visible;
$termines = $visible;


if (isset($_POST['tous'])) {
    $tous = $focus;
    $en_cours = $visible;
    $en_pause = $visible;
    $termines = $visible;
}

if (isset($_POST['en_cours'])) {
    $tous = $no_focus;
    $input_en_cours = $focus;
    $en_cours = $visible;
    $en_pause = $invisible;
    $termines = $invisible;
}

if (isset($_POST['en_pause'])) {
    $tous = $no_focus;
    $input_en_pause = $focus;
    $en_cours = $invisible;
    $en_pause = $visible;
    $termines = $invisible;
}

if (isset($_POST['termine'])) {
    $tous = $no_focus;
    $input_termine = $focus;
    $en_cours = $invisible;
    $en_pause = $invisible;
    $termines = $visible;
}

$cours = $bdd->query('SELECT * FROM mangas WHERE status Like("en cours")');
$pause = $bdd->query('SELECT * FROM mangas WHERE status Like("en pause")');
$termine = $bdd->query('SELECT * FROM mangas WHERE status Like("termines")')

?>
<html class="" id="toggle_page">
<head>
    <title>Volp'Gang - Mangas</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/mangas.css">
</head>

<body>
<?php include 'complements/header.php' ?>

<h1>Nos mangas :</h1>

<div class="choice">
    <form class="form_choice" method="POST">
        <input class="input-select middle <?= $tous ?>" type="submit" name="tous" value="Tous" formmethod="post">
        <br>
        <input class="input-select row <?= $input_en_cours ?>" type="submit" name="en_cours" value="En cours" formmethod="post">
        <input class="input-select row <?= $input_en_pause ?>" type="submit" name="en_pause" value="En pause" formmethod="post">
        <input class="input-select row <?= $input_termine ?>" type="submit" name="termine" value="Terminés" formmethod="post">
    </form>
</div>

<div class="<?= $en_cours ?>">
    <h3><u>En Cours :</u></h3>
    <div class="group">
        <?php while ($donnees = $cours->fetch()): ?>
            <div class="solo">
                <a href="projet.php?name=<?= $donnees['nom'] ?>">
                    <img class="image_solo" src="img/mangas/<?= $donnees['nom'] ?>.jpg">
                    <p class="name"><?= $donnees['nom'] ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="<?= $en_pause ?>">
    <h3><u>En Pause :</u></h3>
    <div class="group">
        <?php while ($donnees = $pause->fetch()): ?>
            <div class="solo">
                <a href="projet.php?name=<?= $donnees['nom'] ?>">
                    <img class="image_solo" src="img/mangas/<?= $donnees['nom'] ?>.jpg">
                    <p class="name"><?= $donnees['nom'] ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="<?= $termines ?>">
    <h3><u>Termines :</u></h3>
    <div class="group">
        <?php while ($donnees = $termine->fetch()): ?>
            <div class="solo">
                <a href="projet.php?name=<?= $donnees['nom'] ?>">
                    <img class="image_solo" src="img/mangas/<?= $donnees['nom'] ?>.jpg">
                    <p class="name"><?= $donnees['nom'] ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php require 'complements/footer.php' ?>
</body>
</html>