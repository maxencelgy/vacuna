<?php
session_start();
if (!isAdmin()){
    header('Location: 403.php');
} else {
    $id = $_SESSION['user']['id'];
    $user = $_SESSION['user'];
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La vacuna del sol</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles perso-->
    <link href="asset/css/style_b.css" rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="hand-holding-medical-solid.svg">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
            <div class="sidebar-brand-icon ">
                <img id="logo-header_b" src="../asset/img/logo2.png" alt="logo">
            </div>
            <div class="sidebar-brand-text mx-3">La vacuna del sol</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="management-user.php">
                <i class="fas fa-users"></i>
                <span>Gestion Utilisateur</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="management-vaccine.php">
                <i class="fas fa-syringe"></i>
                <span>Gestion Vaccin</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="management-testimonial.php" >
                <i class="fas fa-comments"></i>
                <!-- Counter - Alerts -->
               <!-- <p class="badge badge-danger badge-counter">3+</p>-->
                <span>Gestion Avis</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="msg_b.php" >
                <i class="fas fa-envelope"></i>
                <!-- Counter - Alerts -->
                    <!--<p class="badge badge-danger badge-counter">0</p>-->

                <span>Boite mail</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!--Add disconnect -->
        <li id="logout_h" class="nav-item">
            <a  class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Se deconnecter</span>
            </a>
        </li>

    </ul>
    <!-- End of Sidebar -->
    <!-- Layout content-->
    <div id="layoutDrawer_content">
        <!-- Main page content-->
        <main>
