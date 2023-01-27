<?php
session_start();
$message = "";
// $message = $_SESSION["message"];
$bd = new mysqli('localhost', 'root', '', 'moduleconnexion');

if (isset($_POST['submit'])) {
  if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
    $sql = 'SELECT login FROM utilisateurs';
    $request = $bd->query($sql);
    $result = $request->fetch_all(MYSQLI_ASSOC);
    $i = 0;
    foreach ($result as $value) {
      if ($value["login"] == $_POST['login']) {
        $message = "Ce login existe deja, utilisez un autre login !";
        $i++;
      }
    }
      if ($i==0){
        if ($_POST['password1'] == $_POST['password2']) {
          $login = $_POST['login'];
          $prenom = $_POST['prenom'];
          $nom = $_POST['nom'];
          $mdp = $_POST['password1'];
          $sql = "INSERT INTO utilisateurs(login, prenom, nom, password) VALUES ('$login','$prenom', '$nom', '$mdp')";
          $request = $bd->query($sql);
          header('location:connexion.php');
        } 
        else {
          $message = "Les deux mots de passe ne sont pas identiques !";
        }
        echo $message;
      
    }
  } else {
    $message = "Vous devez remplir tous les champs !";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style1.css" />
  <title>Site de coaching</title>
</head>

<body>
  <!-- Body -->
  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="index.php">COACH YUUMI</a></h1> <!-- titre -->
        </div>

        <div class="formbg">
          <div class="formbg-inner padding-horizontal--48">
            <span class="padding-bottom--15">Inscription :</span> <!-- Inscription -->

            <form id="stripe-login" method="POST"> <!-- formulaire -->
              <div class="field">
                <label>Login :</label>
                <input type="text" name="login">
              </div>
              <div class="field">
                <label>Prenom :</label>
                <input type="text" name="prenom">
              </div>
              <div class="field">
                <label>Nom :</label>
                <input type="text" name="nom">
              </div>
              <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password1">
              </div>
              <div class="field">
                <label>Confirmez le mot de passe :</label>
                <input type="password" name="password2">
              </div>
              <div class="field">
                <input type="submit" name="submit" value="Connexion">
              </div>
              <div class="message"><?= $message ?></div>
            </form>
          </div>
        </div>
        <div class="footer-link padding-top--24">
          <span>Vous avez deja un compte ? <a href="connexion.php">Connectez-vous !</a></span>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>


</html>