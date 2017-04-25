<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
require 'connexion.php';
if (!empty($_POST['name']) && !empty($_POST['first_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $_SESSION['name'] = htmlentities($_POST['name']);
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
} elseif (!isset($_POST)) {
    echo 'error';
}

$verif_tmp = $dbh->prepare("SELECT id_user from users where email like '" . $_SESSION['email'] . "';");
$verif_tmp->execute();
$verif = $verif_tmp->fetchAll();

if ($verif == NULL){
// TEST
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {
            $stmt = $dbh->prepare('INSERT INTO users (name,email,password,first_name) VALUE (:name, :email, :password,:first_name)');
            $stmt->execute([
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                ':name' => $_POST['name'],
                ':first_name' => $_POST['first_name']
            ]);
            header('Location:admin.php');
            $users = $stmt->fetchAll();
        }
    } else {
        echo("$email is not a valid email address");
    }
}
}
else {
    echo 'Cet e-mail est deja utilise<br>';
    echo '<a href="index.php">Retour</a>';
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
    <h2>S'inscrire</h2>
</div>  <!-- title -->

<div class="row">
    <form method="post">
        <div class="formulaire col-xs-10 col-xs-offset-1">
            <div class="form-group">
                <label for="first_name">Prénom *</label>
                <input type="text" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="name">Nom *</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="email">Identifiant ou adresse e-mail *</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" name="password" id="mdp">
            </div>
            <div class="row">
                <button type="submit" class="button col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">Inscription
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