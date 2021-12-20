<?php
// Check if he is connected

require ('../inc/func.php');
require ('../inc/pdo.php');
// Check if he got a rank admin!

// Set PHP here
$title = 'Boite mail';
$headTitle = 'Mail';
$listFunc = ['marquer lu','repondu', 'supprimer'];
$avoidColumn = ['id', 'id_user'];
$add = '';

/* Get DB*/
$tableName = 'vds_msg';
$table = getDbOrderAsc($tableName);
//if contact update
//$table =  joinUserId('vds_msg');


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