<?php
$bdd = new PDO('mysql:host=127.0.0.1;port=3308;dbname=vgs', 'root', '');

if(isset($_POST['formconnexion'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mdpconnect = md5($_POST['mdpconnect']);
   if(!empty($pseudo) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
      $requser->execute(array($pseudo, $mdpconnect));
      $userexist = $requser->rowCount();
      if ($userexist == 1) {
          session_start();
          $_SESSION['connecte'] = 1;
          require_once 'function/auth.php';
          if(est_connecte()) {
              $userinfo = $requser->fetch();
              $_SESSION['pseudo'] = $userinfo['pseudo'];
              header("Location: admin/dashboard.php");
              exit();
          }
      } else {
         $erreur = "Pseudo ou mot de passe incorrect";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
require 'complements/header.php';
?>
<html class="" id="toggle_page">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/upload.css">
    <title>Connexion</title>
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

<div align="center">
    <h2>Connexion</h2>
    <br><br>
    <form method="POST">
        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo :</label>
                </td>
                <td>
                    <input autocomplete="on" class="text" type="text" placeholder="pseudo" name="pseudo" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mdpconnect">Mot de passe :</label>
                </td>
                <td>
                    <input autocomplete="off" class="text" type="password" placeholder="mot de passe" name="mdpconnect" />
                </td>
            </tr>
        </table>
        <br><br>
        <input class="button" type="submit" name="formconnexion" value="Se connecter !" />
    </form>
    <div align="center">
        <a href="motdepasse.php" class="oublie">Mot de passe oublié !</a>
    </div>
    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?>
</div>
    <br>
<div align="center" style="color: red;">
    <p><u>Si t'as pas de compte, inscris toi sur cette page <a style="color: darkred" href="inscription.php">ici</a></u></p>
</div>

</body>
</html>
