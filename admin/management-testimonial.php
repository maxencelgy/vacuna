<?php
// Check if he is connected

require ('../inc/func.php');
require ('../inc/pdo.php');
// Check if he got a rank admin!

// Set PHP here
// Set PHP here
$title = 'Gestion des Avis';
$headTitle = 'Avis';
$listFunc = ['publier', 'supprimer'];
$avoidColumn = ['id', 'id_user'];

$add = '';

/*Get DB*/
$tableName = 'vds_testimonial';

$table =  joinUserId('vds_testimonial');


include ('inc/header_b.php');
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 mt-4 text-center text-yellow font-weight-bold"><?= $title; ?></h1>

        <?php
        include ('inc/table.php');
        ?>
    </div>



<?php
include ('inc/footer_b.php');
