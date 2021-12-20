<?php

function getDbOrderAsc($table){
    global $pdo;
    $sql= "SELECT * FROM  $table ORDER BY name asc";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

// If null put it in Publish, replace the current value.
function changeStatus($id, $from, $status  = 'publish'){
if (!empty($id)) {
global $pdo;
$sql = "UPDATE $from
SET modified_at	= NOW(), status = :status
WHERE  id = :id";
$query = $pdo->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':status', $status, PDO::PARAM_STR);
$query->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);;
} else{
abort404();
}
}
function changeRole($id, $from, $role  = 'user'){
if (!empty($id)) {
global $pdo;
$sql = "UPDATE $from
SET modified_at	= NOW(), role = :role
WHERE  id = :id";
$query = $pdo->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':role', $role, PDO::PARAM_STR);
$query->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);;
} else{
abort404();
}
}

function tableName($table){
    $tablesList = ['vds_msg' => 'Message', 'vds_testimonial'=> 'Avis', 'vds_users' => 'Utilisateur', 'vds_vaccin' =>'Vaccin', 'vds_user_vaccin' => 'Find name'];
    foreach ($tablesList as $tableList => $value) {
        if ($tableList == $table){

            return $value;
        }
    }
}


function getNameTable ($funcTable){
    if ($funcTable == 'supprimer') {
        $name = 'delete';
    }
    if ($funcTable == 'modifier') {
        $name = 'update';
    }
    if ($funcTable == 'marquer lu') {
        $name = 'read';
    }
    if ($funcTable == 'publier') {
        $name = 'publish';
    }
    if ($funcTable == 'repondu') {
        $name = 'answer';
    }
    return $name;
}
function getTableIcons($funcTable)
{
    if ($funcTable == 'supprimer') {
        $icon = 'fas fa-trash-alt';
    }
    if ($funcTable == 'modifier') {
        $icon = 'fas fa-edit';
    }
    if ($funcTable == 'marquer lu') {
        $icon = 'fas fa-envelope-open';
    }
    if ($funcTable == 'publier') {
        $icon = 'fas fa-paper-plane';
    }
    if ($funcTable == 'repondu') {
        $icon = 'fas fa-check-square';
    }
    return $icon;
}
function renameKey($key){
    $name = $key;
    if ($key == 'name') {
        $name = 'nom';
    }
    if ($key == 'prenom') {
        $name = 'prenom';
    }

    if ($key == 'created_at') {
        $name = 'créée le';
    }
    if ($key == 'modified_at') {
        $name = 'modifié le';
    }
    if ($key == 'content') {
        $name = 'description';
    }
    if ($key == 'last_log') {
        $name = 'derniere connection';
    }
    return $name;
}
function valueFormat($key, $value){
    $valuePrepare =$value;
    if ($key == 'dob') {
        $valuePrepare = date('d/m/Y', strtotime($value));
    }
    if ($key == 'created_at') {
        $valuePrepare = date('d/m/Y', strtotime($value));
    }
    if ($key == 'modified_at') {
        $valuePrepare = date('d/m/Y', strtotime($value));
    }
    if ($key == 'last_log') {
        $valuePrepare = date('d/m/Y', strtotime($value));
    }
    if ($key == 'status'){
        switch ($value){
            case 'draft':
                $valuePrepare = "Brouillon";
                break;
            case 'publish':
                $valuePrepare = "Publier";
                break;
            case 'answered':
                $valuePrepare = "Répondu";
                break;
            case 'read':
                $valuePrepare = "Lu";
                break;
            case 'delivered':
                $valuePrepare = "Non lu";
                break;
        }
    }

    return $valuePrepare;
}
function showColumnSelectedValue ($key, $value, $avoidColumn){
    if (!in_array($key, $avoidColumn)) {
        $adapt = valueFormat($key, $value);
        echo  '<td>'. $adapt. '</td>';
    }
}
function showColumnSelectedKey ($list,$avoidColumn){
    foreach ($list as $key => $value){
        if (!in_array($key, $avoidColumn)){
            $name = renameKey($key);
            echo  '<th>'. $name . '</th>';
        } }
}

function showForUpdate ($key, $data){
    if(!empty($_POST[$key])) {
        echo $_POST[$key];
    } else {
        echo $data;
    }
}

function isSelected ($item, $key, $value){
    if ($item[$key] == $value) {
        echo 'selected';
    }
}
/*Paginator*/
function getArticlesWithLimit($table, $limit = 10, $status = 'all', $offset){
    global $pdo;
    if($status == 'all') {
        $sql = "SELECT * FROM $table ORDER BY status DESC ,created_at DESC LIMIT $limit OFFSET $offset";
        if($table == 'vds_users') {
            $sql = "SELECT * FROM $table ORDER BY role DESC ,created_at DESC LIMIT $limit OFFSET $offset";
        }
            if ($table == 'vds_testimonial'){
        $sql= "SELECT vds_users.id,vds_users.name as name, vds_users.prenom as prenom,vds_testimonial.*
    FROM vds_users
    INNER JOIN vds_testimonial
    ON vds_users.id = vds_testimonial.id_user
    ORDER BY status DESC ,created_at DESC
    LIMIT $limit OFFSET $offset
    ";
    }
    }
    else {
        $sql = "SELECT * FROM $table WHERE status = '$status' ORDER BY status DESC ,created_at DESC LIMIT $limit OFFSET $offset";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();

}