<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$scan = $bdd->query('SELECT * FROM mangas');
$chemin = "img/scan/" . $_GET['name'] . "/" . $_GET['chap'] . "/";
$filezip = $chemin . $_GET['name'] . " - " . $_GET['chap'] . '.zip';
$compteur = "img/scan/" . $_GET['name'] . "/";

$files = glob("img/scan/" . $_GET['name'] . "/" . $_GET['chap'] . "/*.*");
$count = count($files);
$count -= 1;

//voir si le dossier existe
$chap_suivant = $_GET['chap'] + 1;
$chemin_suivant = "img/scan/" . $_GET['name'] . "/" . $chap_suivant . "/1.jpg";
$existe = file_exists($chemin_suivant);
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/complements.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="icon" type="image/png" href="../img/vgs.png">
</head>

<body>

<div align="center" class="container">
    <div align="center" class="text">
        <p><a class="text" href="projet.php?name=<?= $_GET['name'] ?>"><?= $_GET['name'] ?></a> - Chapitre <?= $_GET['chap'] ?></p>
    </div>
    <p id='numero_de_page'>numero de page : 1/<?= $count ?></p>
    <p style="color: white"><?= $chap_suivant ?></p>
    <p style="color: white"><?= $chemin_suivant ?></p>
    <!-- <?php if ($existe) {?>
        <p style="color:white">Le chemin existe</p>
    <?php } else {?>
        <p style="color: white">Le chamin n'existe pas</p>
    <?php } ?>-->
    <img onclick="suivant()" id="page" class="page" src='<?= $chemin ."1.jpg"; ?>'>
    <br>
    <a class="arrow left" onclick="precedent()"><img src="img/previous.png" width="50" height="50"></a>
    <a class="arrow right" onclick="suivant()"><img src="img/next.png" width="50" height="50"></a>

</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let page = 1;
    var fso=new ActiveXObject("Scripting.FileSystemObject")

    document.addEventListener("keypress", function(event) {
        key = event.key;
        if (key == 'ArrowLeft'  )
        {
            $('html, body').animate({
                scrollTop: $("div.container").offset().top
            }, 0);
            suivant();
            console.log('page suivante');
        } else if (key == 'ArrowRight' )
        {
            $('html, body').animate({
                scrollTop: $("div.container").offset().top
            }, 0);
            precedent();
            console.log('page précedente');
        }


    });
    jQuery(document).keydown(function(eventObject)
    {
        if (eventObject.which == 37)
        { //fleche gauche
            $('html, body').animate(
                {
                    scrollTop: $("div.container").offset().top
                }, 0);
            precedent();
            console.log('page précedente');
        }
        if (eventObject.which == 39)
        { //fleche droite
            $('html, body').animate(
                {
                    scrollTop: $("div.container").offset().top
                }, 0);
            suivant();
            console.log('page suivante');
        }
    });

    object.onkeypress = function(){suivant};

    function suivant() {
        if (page == <?php echo $count ?> )
        {
            page == <?php echo $count ?>
        }
        else
        {
            page += 1
        }

        changer_page(page);
        console.log("test");
    }
    function precedent() {
        if (page == 1) {
            page += 0
        } else {
            page -= 1;
        }
        changer_page(page);
    }
    function changer_page(page) {
        if (page == <?php echo $count ?>)
        {
            let chap = fso.FileExists(<?php $chemin_suivant ?>);
            if (chap)
            {
                document.location.href="main.php?name=<?php echo $_GET['name'] ?>&chap<?= $_GET['chap'] + 1 ?>"
            }
            else
            {
                document.location.href="projet.php?name=<?php echo $_GET['name'] ?>"
            }

        }
        else if (page <= 0 && <?php echo $_GET['chap'] ?> != 1)
        {
            document.location.href="main.php?name=<?php echo $_GET['name'] ?>&chap=<?php echo $_GET['chap'] - 1 ?>"
        }
        else
        {
            document.getElementById('page').src = '<?php echo $chemin ?>/' + page + '.jpg';
            document.getElementById('numero_de_page').textContent = 'numero de page : ' + page + '/<?php echo $count ?>'
        }
    }
</script>

</html>
