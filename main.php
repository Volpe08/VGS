<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

$scan = $bdd->query('SELECT * FROM mangas');
$chemin = "img/scan/" . $_GET['name'] . "/" . $_GET['chap'] . "/";
$filezip = $chemin . $_GET['name'] . " - " . $_GET['chap'] . '.zip';

$files = glob("img/scan/" . $_GET['name'] . "/" . $_GET['chap'] . "/*.*");
$count = count($files);
$count -= 1;
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
</head>

<body>

<div align="center" class="container">
    <div align="center" class="text">
        <p><a class="text" href="projet.php?name=<?= $_GET['name'] ?>"><?= $_GET['name'] ?></a> - Chapitre <?= $_GET['chap'] ?></p>
    </div>
    <p id='numero_de_page'>numero de page : 1/<?= $count ?></p>
    <img onclick="suivant()" id="page" class="page" src='<?= $chemin ?>'>
    <br>
    <a class="arrow left" onclick="precedent()"><img src="img/previous.png" width="50" height="50"></a>
    <a class="arrow right" onclick="suivant()"><img src="img/next.png" width="50" height="50"></a>
</div>

</body>


<script>
    let page = 1;
    document.addEventListener("keypress", function(event) {
        key = event.key;
        if (key == 'ArrowLeft'  ) {
            suivant();
            console.log('page suivante');
        } else if (key == 'ArrowRight') {
            precedent();
            console.log('page précedente');
        }


    })

    object.onkeypress = function(){suivant};

    function suivant() {
        page += 1
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
    function changer_page() {
        if (page > <?php echo $count ?>) {
            document.location.href="projet.php?name=<?php echo $_GET['name'] ?>";
        } else {
            document.getElementById('page').src = '<?php echo $chemin ?>/' + page + '.jpg';
            document.getElementById('numero_de_page').textContent = 'numero de page : ' + page + '/<?php echo $count ?>';
        }
    }
</script>

</html>