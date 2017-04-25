<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="./images/8GAG.png" alt="logo" class="navbar-brand">
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php

            //Si le membre est connecté on affiche
            if (isset($_SESSION['connected'])) { ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false" style="background-color:none">Mon Compte<span class="caret"></span></a>
                    <ul class="dropdown-menu pull-left">
                        <li><a href="profile.php">Aperçu de mon compte</a></li>
                        <li><a href="admin.php">Editer mon profil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Deconnexion</a></li>
                    </ul>
                </li>
            <?php }?>

            <?php
            //Si le membre n'est pas connecté on affiche
            if(empty($_SESSION['connected'])) { ?>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>