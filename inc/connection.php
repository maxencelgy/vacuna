<?php
$error = [];
if (!empty($_POST['submitted'])) {

    $login = cleanXss('login');
    $password = cleanXss('password');

    $sql = "SELECT * FROM vds_users WHERE email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($user)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = array(
                'id' => $user['id'],
                'name' => $user['name'],
                'prenom' => $user['prenom'],
                'dob' => $user['dob'],
                'email' => $user['email'],
                'role' => $user['role'],
                'ip' => $_SERVER['REMOTE_ADDR'] // ::1
            );
            header('Location: profil.php');
        } else {
            $error['login'] = 'Mots de passe incorrect';
        }
    } else {
        $error['login'] = 'Veuillez entrer un e-mail correct';
    }
}