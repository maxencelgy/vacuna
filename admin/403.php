<?php
session_start();
require('../inc/pdo.php');
require('../inc/func.php');

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>403 Forbidden access</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="asset/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- 404 Error Text -->
        <div class="text-center mt-5" >
            <div class="error mx-auto" data-text="403">403</div>
            <p class="lead text-blue-800 mb-4">Access denied</p>
            <p class="text-blue-500 mb-0">Please go back to the </p>
            <a href="../index.php">Homepage</a>
        </div>
    </div>
