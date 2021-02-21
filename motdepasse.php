<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

if (isset($_POST['formmotdepasse'])) {
    $mail = $_POST['mail'];
    if(!empty($mail)) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $reqmail = $bdd->prepare("SELECT mail FROM membres WHERE mail = ?");
            $reqmail->execute(array($mail));
            $mailexist = $reqmail->rowCount();

            $reqpseudo = $bdd->prepare("SELECT pseudo FROM membres WHERE mail = ?");
            $reqpseudo->execute(array($mail));
            $pseudoexist = $reqpseudo->rowCount();

            if ($mailexist == 1) {
                $objet = 'Nouveau mot de passe';
                $new_pass = rand();
                $new_pass_crypt = crypt($new_pass, "LaVolpGangC4éLABEST!");

                $header = "From: volpgangscantrad@gmail.com \n";
                $header .= "Reply-To: ".$mail."\n";
                $header .= "MIME-version: 1.0\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit";
                $contenu =
                    "<html>".
                    "<body>".
                    "<p style='font-size: 18px'><b>Bonjour Mr, Mme ".$pseudoexist."</b>,</p><br/>".
                    "<p style='text-align: justify'><i><b>Nouveau mot de passe : </b></i>".$new_pass."</p><br/>".
                    "</body>".
                    "</html>";
                mail($mail, $objet, $contenu, $header);
                $erreur="Votre mail a bien été envoyer !";
            } else {
                $erreur = "Votre mail n'existe pas dans la base de donnée";
            }
        } else {
            $erreur = "Votre mail est invalide";
        }
    } else {
        $erreur = "Le champ de votre mail n'est pas rempli";
    }
}
require 'complements/header.php';
?>

<html class="" id="toggle_page">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/upload.css">
    <title>Mot de passe perdu</title>
    <meta charset="utf-8">
</head>
<body>

<style type="text/css">
    input.button{
        font-size: 20px;
        background: #1E1E1E;
        border: 2px solid #3E3E3E;
        border-radius: 20px;
        padding: 15px;
        color: #444544;
        outline: none;
    }
</style>

<div class="connexion">

    <div align="center" class="connexion-box">
        <h2>Mot de passe perdu :</h2>
        <br><br>
        <form method="POST">
            <table>
                <tr>
                    <td align="right">
                        <label for="mail">Votre mail :</label>
                    </td>
                    <td>
                        <input autocomplete="on" class="text" type="text" placeholder="mail" name="mail">
                    </td>
                </tr>
            </table>
            <br><br>
            <input class="button" type="submit" name="formmotdepasse" value="Envoyer !" />
        </form>
        <?php
        if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
        }
        ?>
    </div>
    <br>
</div>