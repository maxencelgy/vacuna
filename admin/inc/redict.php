<?php
session_status();
//Script de passage

require '../../inc/func.php';
require '../../inc/pdo.php';


$tableName = urldecode($_GET['table']);
$dbList = ['vds_msg','vds_testimonial', 'vds_users', 'vds_vaccin', 'vds_user_vaccin'];

if (!empty($tableName) && in_array($tableName,$dbList)){
    if ($tableName == 'vds_vaccin') {
   header('location: ../add-vaccin.php');
}
    if ($tableName == 'vds_users'){
    header('location: ../add-users.php');
}
}
else {
    //redirection is false
   // header('location: 404.php');
}