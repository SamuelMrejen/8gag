<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require 'connexion.php';
if (!empty($_POST)) {
    $stmt = $dbh->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([
        ':email' => $_POST['email'],
    ]);
    $users = $stmt->fetchAll();
    if (count($users) > 0) {
        if (password_verify($_POST['password'],$users[0]['password']))
        {
            $_SESSION['connected']=true;
        }
        else{
            $_SESSION['connected']=false;
        }
        $_SESSION['connected'] = true;
        $_SESSION['id_user'] = $users[0]['id_user'];
        header('Location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>8GAG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/body.css">
</head>
<body>
<?php
include 'navbar.php';
?>
<div class="title col-xs-10 col-xs-offset-1">
    <h2>Se connecter</h2>
</div>  <!-- title -->

<div class="row">
    <form method="post">
        <div class="formulaire col-xs-10 col-xs-offset-1">
            <div class="form-group">
                <label for="name">Identifiant ou adresse e-mail *</label>
                <input type="email" name="email" id="name">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" name="password" id="mdp">
            </div>
            <div class="row">
                <button type="submit" class="button col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3" style="margin-bottom:0px;">Connexion
                </button>
            </div>
            <div class="row">
                <div class="mdp col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                    <a href="inscription.php">Pas encore membre ?<br> Créez un compte</a>
                </div>    <!-- mdp -->
            </div>
        </div>
    </form>
</div>
</body>