<?php

require 'connexion.php';
session_start();
if (empty($_SESSION['connected'])) {
    header('Location:Login.php');
}
$stmt = $dbh->prepare('SELECT * FROM users WHERE id_user = :id_user');
$stmt->execute([
    ':id_user' => $_SESSION['id_user']
]);
$user = $stmt->fetch();
$stmt = $dbh->prepare('SELECT * FROM users u,pictures p  WHERE u.id_user = p.id_user AND u.id_user = :id_user');
$stmt->execute([
    ':id_user' => $_SESSION['id_user']
]);
$user = $stmt->fetchAll();
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<?php
include 'navbar.php';
?>
<div class="container">
    <div class="row">
        <div class="title col-xs-10 col-xs-offset-1">
            <h2>Mes images</h2>
        </div>  <!-- title -->


        <div class="container">
            <div class="row">
                <div class="last col-xs-10 col-xs-offset-1 text-center">
                    <?php
                    foreach ($user as $picture) {
                        echo '<div class="bloc">
<a href="uploads/' . $picture['name'] . '" target="_blank"><img src="uploads/' . $picture['name'] . '" height="200"></a>
</div>';
                    }
                    ?>
                </div>
            </div>  <!-- row -->
        </div>  <!-- container -->

        <div class="container">
            <div class="row">
                <a href="admin.php">
                    <button type="submit" href="admin.php"
                            class="button col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">Modifier mes coordonnées
                    </button>
                </a>
            </div>
        </div>
    </div>  <!-- row -->
</div>  <!-- container -->

    <?php
    include 'footer.php'
    ?>
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