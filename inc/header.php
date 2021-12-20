<?php

// Check if he is connected
if (isLogged()){
    $id = $_SESSION['user']['id'];
    $user = $_SESSION['user'];
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link href="https://srmahour.github.io/custom-testimonial-slider-and-blog/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://srmahour.github.io/custom-testimonial-slider-and-blog/css/slick.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/reset.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/responsive.css">
    <title>La vacuna del sol</title>
</head>
<body>

<!--Header-->

<header id="navbar" class="nav">
        <div class="wrap">
            <div class="logo">
                <a href="index.php">
                    <img src="asset/img/logo.png" alt="logo">
                </a>
            </div>
            <nav>
                <a class="icon" onclick="myFunction()">&#9776;</a>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php#details">A propos</a></li>
                    <?php if (!isAdmin()){?>
                    <li><a href="contact.php">Contact</a></li>
                    <?php }?>

                    <?php if (isLogged()) { ?>
                    <li><a href="profil.php">Mon carnet</a></li>
                        <?php if (isAdmin()){?>
                            <li><a href="admin/index.php" class="box_header admin_link">Admin</a></li>
                        <?php }?>
                    <li><a href="inc/logout.php" class="box_header">Deconnexion</a></li>
                    <?php } else { ?>
                        <li><a href="index.php#connexion" class="box_header">Connexion</a></li>
                        <li><a href="inscription.php" class="box_header">Inscription</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>

</header>



