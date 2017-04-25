<?php

require 'connexion.php';
session_start();
if (empty($_SESSION['connected'])) {
    header('Location:Login.php');
}

if (!empty($_POST)) {
    $stmt = $dbh->prepare('UPDATE users SET first_name = :first_name, name = :name, email = :email, password = :password WHERE id_user = :id_user');
    $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
        ':id_user' => $_SESSION['id_user']
    ]);
}
$stmt = $dbh->prepare('SELECT * FROM users WHERE id_user = :id_user');
$stmt->execute([
    ':id_user' => $_SESSION['id_user']
]);
$user = $stmt->fetch();
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
<div class="container">
    <div class="row">
        <div class="title col-xs-10 col-xs-offset-1">
            <h2>Mes coordonnées</h2>
        </div>  <!-- title -->
    </div>  <!-- row -->
</div>

<div class="container">
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
                <button type="submit" class="button col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">Modifier
                </button>
            </div>
        </form>
    </div>
</div>  <!-- container -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- JavaScript Includes -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="js/script.js"></script>
</html>