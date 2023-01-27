<?php
session_start();
$bd = new mysqli('localhost', 'root', '', 'moduleconnexion');
$sql = 'SELECT * FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message= "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Site de coaching</title>
</head>

<body class="body2">
    <div>
        <h1><?= 'Bonjour, ' . $_SESSION['login'] ?></h1>
        <hr style="margin:auto;width:40%">
    </div>
<?php 
foreach ($result as $key => $value){
    if ($value['login'] == $_SESSION['login']){
        $id = $value['id'];
        $login = $value['login'];
        $prenom = $value['prenom'];
        $nom = $value['nom'];
        $mdp = $value['password'];
    }
}
if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['login']) || !empty($_POST['prenom']) || !empty($_POST['nom'])) {
        $login = !empty($_POST['login'])? $_POST['login']:$_SESSION['login'];
        $prenom = !empty($_POST['prenom'])? $_POST['prenom']:$value['prenom'];
        $nom = !empty($_POST['nom'])? $_POST['nom']:$value['nom'];
        $log = $_SESSION['login'];
        $sql = "UPDATE utilisateurs SET login = '$login', prenom = '$prenom', nom = '$nom' WHERE id = '$id'";
        if ($request = $bd->query($sql)) {
            $_SESSION['login']= $login;
            header('refresh:0');
        }
    } 
    // if (!empty($_POST['prenom'])){
    //     $prenom = $_POST['prenom'];
    //     $sql = "UPDATE utilisateurs SET prenom = '$prenom'  WHERE prenom = '$prenom'";
    //     $request = $bd->query($sql);
    // } 
    // if (!empty($_POST['nom'])){
    //     $nom = $_POST['nom'];
    //     $sql = "UPDATE utilisateurs SET nom = '$nom' WHERE nom = '$nom'";
    //     $request = $bd->query($sql);
    // }
    if (!empty($_POST['password1']) && !empty($_POST['password2'])){
        if ($_POST['password1'] == $_POST['password2']) {
        $mdp = $_POST['password1'];
        $sql = "UPDATE utilisateurs SET password = '$mdp' WHERE id = '$id'";
        $request = $bd->query($sql);
        } 
        else {
        $message = "Les deux mots de passe ne sont pas identiques !";
        }
    }
    else {
        $message = "Il faut remplir tous les champs de mot de passe !";
    }
}
?>
    <div class="profil">
        <div class="contenair">
            <h2>Votre Profil :</h2> <!-- Inscription -->
        </div>
        <form method="POST"> <!-- formulaire -->
            <div class="field">
                <label>Login : </label>
                <input type="text" name="login" placeholder="<?php echo $login;?>">
            </div>
            <div class="field">
                <label>Prenom :</label>
                <input type="text" name="prenom" placeholder="<?php echo $prenom;?>">
            </div>
            <div class="field">
                <label>Nom :</label>
                <input type="text" name="nom" placeholder="<?php echo $nom ;?>">
            </div>
            <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password1">
            </div>
            <div class="field">
                <label>Confirmez le mot de passe :</label>
                <input type="password" name="password2">
            </div>
            <div>
                <input class="fieldd" type="submit" name="enregistrer" value="Enregistrer">
            </div>
            <div class="message"><?= $message ?></div>
        </form>
    </div>
    <?php
    if (isset($_POST['deconnexion'])){
        session_destroy();
        header('location:connexion.php');
    }
    ?>
    <div class="contenair">
        <form class="lienbutton" method="POST">
            <input class="button1" type="submit" name="deconnexion" value="Deconnexion">
    </form>
    </div>
</body>

</html>