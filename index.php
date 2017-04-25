<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require 'connexion.php';


if (!empty($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $mime_valid = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $extension_valid = ['jpeg', 'jpg', 'png', 'gif'];
    $extension = pathinfo($_FILES['picture']['name'])['extension'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['picture']['tmp_name']);
    $newName = uniqid() . '.' . $extension;
    if (in_array($extension, $extension_valid) && in_array($mime, $mime_valid)) {
        move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/' . $newName);
    }

    $stmt = $dbh->prepare('INSERT INTO pictures (name, date, ip_adress, id_user) VALUES (:name, NOW(), :ip_adress, :id_user');
    $stmt->execute([
        ':name' => $newName,
        ':ip_adress' => $_SERVER['REMOTE_ADDR'],
        ':id_user' => $_SESSION['id_user']
    ]);
}


$stmt = $dbh->prepare('SELECT name FROM pictures ORDER BY id DESC LIMIT 4');
$stmt->execute();
$pictures = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>8GAG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/body.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- Google web fonts -->
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include 'navbar.php'
?>

<div class="container">
    <div class="row">
        <form id="upload" method="post" action="./draganddrop.php" enctype="multipart/form-data">
            <div id="drop">
                Glissez ici
                <a>Parcourir</a>
                <input type="file" name="upl" multiple/>
            </div>
            <ul>
                <!-- The file uploads will be shown here -->
            </ul>
        </form>
    </div>  <!-- row -->
</div>


<h2>Dernières images importées</h2>
<div class="container">
    <div class="row">
        <div class="last col-xs-10 col-xs-offset-1 text-center">
            <?php
            foreach ($pictures as $picture) {   //5 dernieres photos
                echo '<div class="bloc">
<a href="uploads/' . $picture['name'] . '" target="_blank"><img src="uploads/' . $picture['name'] . '" height="200"></a>
</div>';
            }
            ?>
        </div>
    </div>  <!-- row -->
</div>

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