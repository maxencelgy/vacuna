<?php

$error = [];
$succes = false;
if (!empty($_POST['submitted'])) {
    //For users
    //XSS
    $name = cleanXss('name');
    $prenom = cleanXss('prenom');
    $dob = cleanXss('dob');
    $sex = cleanXss('sexe');
    $email = cleanXss('email');
    $password = cleanXss('password');
    $password_confirm = cleanXss('password_confirm');

    $password_valid = samePassword($error,$password, $password_confirm, 'password_confirm');
    // Error
    $error = validInput($error,$name, 'name', 1, 100);
    $error = validInput($error,$prenom, 'prenom', 1, 200);
    $error = validInput($error,$dob, 'dob', 1, 50);
    $error = validInput($error, $sex, 'sexe', 0, 30);
    $error = mailValidation($error, $email, 'email');
    if(empty($error['email'])) {
        $sql = "SELECT * FROM vds_users WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifEmail = $query->fetch();
        if(!empty($verifEmail)) {
            $error['email'] = 'Cette email existe déjà';
        }
    }

    $error = validInput($error,$password_confirm, 'password_confirm', 3, 255);
    /*If not error*/
    if (count($error) == 0) {
        $token = generateRandomString(100);
        $password_valid = password_hash($password_confirm, PASSWORD_DEFAULT);
        $sql = "INSERT INTO vds_users (name, prenom, dob, sexe, email, password, token, created_at, role) 
                VALUES (:nam,:prenom,:dob,:sexe,:email, :password, :token, NOW(), 'user' )";

        // Prepare la request
        $query = $pdo->prepare($sql);
        // Injection SQL
        $query->bindValue(':nam', $name, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':dob', $dob, PDO::PARAM_STR);
        $query->bindValue(':sexe', $sex, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $password_valid, PDO::PARAM_STR);
        $query->bindValue(':token', $token, PDO::PARAM_STR);

        //executer la query
        $query->execute();
        $succes = true;
    }
}


