<?php
require ('func_connect.php');
require ('func_table.php');

//Important to put in the toolbox
function debug(array $array){
    echo '<pre style="height: 200px; overflow-y: scroll; font-size: .7rem; padding: .6rem; font-family: Consolas,monospace; background: #000000; color: #ffffff;">';
    print_r($array);
    echo '</pre>';
}

function getById($table ,$id){
    global $pdo;
    $sql = "SELECT * FROM $table WHERE  id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function cleanXss($key){
    return trim(strip_tags($_POST[$key]));
}

/*Return value in input if no error and value*/
function returnValue($id){
    if (!empty($_POST[$id])){
        return $_POST[$id];
    }
}
/*Return error*/
function returnError($error, $id){
    if (!empty($error[$id])){
        return $error[$id];
    }
}
/*Value value for error clean, adapt the text error*/
function validInput($error, $value, $key, $min, $max){
    if (!empty($value)){
        if (mb_strlen($value) < $min){
            $error[$key] = 'Erreur, Veuillez remplir le champ'.$key.' avec un contenu entre  '.$min.' et '.$max.' caractere !';
        } elseif (mb_strlen($value) > $max){
            $error[$key] = 'Erreur, Veuillez remplir le champ'.$key.' avec un contenu entre  '.$min.' et '.$max.' caractere !';
        }
    } else {
        $error[$key] = 'Veuillez remplir ce champ !';
    }
    return $error;
}

/* Clean delete element of the table*/
function deleteById($id, $table){
    if (!empty($id)) {
        global $pdo;
        $sql = "DELETE FROM $table WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        //Change location
        header("Refresh:0");
    } else{
        abort404();
    }
}


/*Return the date in DD/MM/YYYY*/
function transformDate($column, $key){
    return date('d/m/y',strtotime($column[$key]));
}

/* Return error 404*/
function abort404(){
    header('HTTP/1.1 404 Not Found');
    header('Location: 404.php');
}


function getDb($table){
    global $pdo;
    $sql= "SELECT * FROM  $table";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}



function mailValidation($error,$value,$key){
    if(!empty($value)){
        if (filter_var($value, FILTER_VALIDATE_EMAIL)==false) {
            $error[$key]='Veuillez renseigner un email valide';
        }
    } else{
        $error[$key]='Veuillez renseigner ce champ';
    }
    return $error;
}

function samePassword($error, $password1, $password2, $key){
    if ($password1 === $password2){
        return $password1;
    }else {
        $error[$key] = 'Mot de passe différent';
    }
    return $error;
}



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function joinUserId($join){
    global $pdo;
    $sql= "SELECT vds_users.id,vds_users.name as name, vds_users.prenom as prenom, $join.*
    FROM vds_users
    INNER JOIN $join
    ON vds_users.id = $join.id_user";
    $query = $pdo->prepare($sql);
    $query->execute();
    return  $query->fetchAll();
}

function getTestiRandomLimit($limit){
    global $pdo;
    $sql= "SELECT vds_users.id,vds_users.name as name, vds_users.prenom as prenom, vds_testimonial.* 
    FROM vds_users 
    INNER JOIN vds_testimonial
    ON vds_users.id = vds_testimonial.id_user
    WHERE status = 'publish'
    ORDER BY vds_testimonial.created_at LIMIT :limit
    ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}


function joinUserVaccin($id){
    global $pdo;
    $sql= "SELECT vds_vaccin.name as vaccin_name, vds_vaccin.rappel as rappel, vds_vaccin.obligatoire as obligatoire, vds_vaccin.status as status,
    vds_user_vaccin.*
    FROM vds_users 
    INNER JOIN vds_user_vaccin
    ON vds_users.id = vds_user_vaccin.id_user
    INNER JOIN vds_vaccin
    ON vds_vaccin.id = vds_user_vaccin.id_vaccin
    WHERE id_user = :id_user
    ORDER BY vaccin_name";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_user', $id, PDO::PARAM_INT);
    $query->execute();
    return  $query->fetchAll();
}


function ageOfUser($bithdayDate)
{
    $date = new DateTime($bithdayDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}
function getDbOrderAscAndPublish($table){
    global $pdo;
    $sql= "SELECT * FROM  $table WHERE status = 'publish' ORDER BY name asc";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function countTable($table){
    global $pdo;
    $sql= "SELECT COUNT(id) FROM $table";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchColumn();
}
function countTableByStatus($table, $value){
    global $pdo;
    $sql= "SELECT count(status)  FROM $table WHERE status = :val";
    $query = $pdo->prepare($sql);
    $query->bindValue(':val', $value, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchColumn();
}