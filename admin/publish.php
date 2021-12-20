<?php
require '../inc/func.php';
require '../inc/pdo.php';
$dbList = ['vds_msg','vds_testimonial', 'vds_users', 'vds_vaccin', 'vds_user_vaccin'];
if (!empty($_GET['id']) && is_numeric($_GET['id'])&& !empty($_GET['table']) && in_array($_GET['table'], $dbList)) {
    $id = $_GET['id'];
    $tableName = $_GET['table'];
    getById($tableName, $id);
    changeStatus($id, $tableName,'publish');
} else { abort404();}