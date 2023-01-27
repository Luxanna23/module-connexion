<?php
session_start();
$message = "";
$bd = new mysqli('localhost', 'root', '', 'moduleconnexion');
$sql = 'SELECT login,password FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $mdp = $_POST['password'];
        $message = "ok";
        foreach ($result as $resultat) {
            if ($login == $resultat['login'] && $mdp == $resultat['password']) {
                $_SESSION['login'] = $login;
                if ($resultat['login'] == 'admin' && $resultat['password'] == 'admin'){
                    header('location:admin.php');
                }
                else {
                    header('location:profil.php');
                }
            } else {
                $message = "Le login et le mot de passe ne correspendent pas !";
            }
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
                        <span class="padding-bottom--15">Connexion :</span> <!-- Connexion -->

                        <form id="stripe-login" method="POST"> <!-- formulaire -->

                            <div class="field padding-bottom--24">
                                <label>Login :</label>
                                <input type="text" name="login">
                            </div>

                            <div class="field padding-bottom--24">
                                <div class="grid--50-50">
                                    <label>Mot de passe :</label>
                                    <div class="reset-pass">
                                        <a href="inscription.php">Mot de passe oublié ?</a>
                                    </div>
                                </div>
                                <input type="password" name="password">
                            </div>

                            <div class="field padding-bottom--24">
                                <input type="submit" name="submit" value="Connexion">
                            </div>

                            <div class="message"><?= $message ?></div>

                        </form>
                    </div>
                </div>
                <div class="footer-link padding-top--24">
                    <span>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></span>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>