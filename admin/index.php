<?php
// Check if he is connected
require('../inc/func.php');
require('../inc/pdo.php');


// Check if he got a rank admin!
    $recupMsg = countTableByStatus('vds_msg', 'delivered');
    $recupVac = countTable('vds_vaccin');
    $recupTesti = countTableByStatus('vds_testimonial', 'draft');
    $recupUsers = countTable('vds_users');

include('inc/header_b.php');
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="text-center mt-5 mb-4">Bonjour, <?= $user['prenom']; ?></h1>
        <h3 class="text-center"> Comment allez-vous aujourd'hui ? </h3>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mt-4 mb-4 text-gray-800">Voici les données du jour :</h1>
        </div>

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <a href="msg_b.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombres de messages non lu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $recupMsg ?></div>
                            </div>
                            <div class="col-auto">
                               <i class="fas fa-envelope fa-2x text-primary -600"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <a href="management-vaccine.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Nombres de vaccin sur le site
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $recupVac ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-syringe fa-2x text-success -600"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <a href="management-testimonial.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Nombre d'avis non lu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $recupTesti ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-info -600"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <a href="management-user.php">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Nombres total d'utilisateurs sur le site
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $recupUsers ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-warning "></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container text-center w-75">
            <img src="asset/img/dash.png" class="img-fluid w-25" alt="">
        </div>


        </div>


<?php
include('inc/footer_b.php');
