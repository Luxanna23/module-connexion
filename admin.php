<?php
session_start();
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
    $bd = new mysqli('localhost', 'root', '', 'moduleconnexion');
    $sql = 'SELECT * FROM utilisateurs';
    $request = $bd->query($sql);
    $result = $request->fetch_all(MYSQLI_ASSOC);
    ?>

    <table class="tab">
        <thead>
            <tr>
                <th  class="ptab1">id</th>
                <th  class="ptab1">Login</th>
                <th  class="ptab1">Prenom</th>
                <th  class="ptab1">Nom</th>
                <th  class="ptab1">Mot de passe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($result as $key => $value) { ?>
                    <td class='ptab2'><?php echo $value['id']; ?></td>
                    <td class='ptab2'><?php echo $value['login']; ?></td>
                    <td class='ptab2'><?php echo $value['prenom']; ?></td>
                    <td class='ptab2'><?php echo $value['nom']; ?></td>
                    <td class='ptab2'><?php echo $value['password']; ?></td>
            </tr><?php } ?>
        </tbody>
    </table>
    <?php
    if (isset($_POST['deconnexion'])){
        session_destroy();
        header('location:connexion.php');
    }
    ?>
    <div class="contenair">
        <form method="POST">
            <input type="submit" name="deconnexion" value="Deconnexion">
        </form>
    </div>
</body>

</html>