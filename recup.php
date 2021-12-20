<?php
session_start();
require('inc/func.php');
require('inc/pdo.php');
// Set PHP here
if (isLogged()) {
    header('Location: index.php');
}
$error = [];
$succes = false;
$token = $_GET['token'];
$email = $_GET['email'];


if (!empty($token) && !empty($email)) {
    $sql = "SELECT * FROM vds_users WHERE email = :email AND token = :token";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':token', $token, PDO::PARAM_STR);
    $query->execute();
    $verifEmail = $query->fetch();
    if (!empty($verifEmail)) {



        if (!empty($_POST['submitted'])) {
            //For users
            //XSS
            $password = cleanXss('pwd');
            $password_confirm = cleanXss('pwd_confirmed');

            $password_valid = samePassword($error,$password, $password_confirm, 'pwd_confirmed');
            // Error
            $error = mailValidation($error, $email, 'email');
            $error = validInput($error,$password_confirm, 'password_confirm', 3, 255);
            /*If not error*/
            if (count($error) == 0) {
                $newToken = generateRandomString(100);
                $password_valid = password_hash($password_confirm, PASSWORD_DEFAULT);
                $sql = "UPDATE vds_users 
                SET password = :password,token= :token, modified_at = NOW() 
                WHERE email = :email";

                // Prepare la request
                $query = $pdo->prepare($sql);
                // Injection SQL
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->bindValue(':password', $password_valid, PDO::PARAM_STR);
                $query->bindValue(':token', $newToken, PDO::PARAM_STR);

                //executer la query
                $query->execute();
                $succes = true;
            }

        }
    }
} else {
    header('Location: index.php');
}
include('inc/header.php');
?>

    <section id="lost-token">
        <div class="wrap_contact">
            <?php if ($succes) { ?>
                <div class="msg">
                    <p>Mot de passe modifié</p>
                    <a href="index.php">Retour à l'accueil</a>
                </div>
            <?php } else { ?>
                <form action="" method="post" class="wrapform" novalidate>
                    <label for="pwd">Saissisez votre nouveau mots de passe :</label>
                    <input type="password" name="pwd" id="pwd" placeholder="Votre mots de passe ...">
                    <label for="pwd_confirmed">Saissisez à nouveau votre mots de passe :</label>
                    <input type="password" name="pwd_confirmed" id="pwd_confirmed"
                           placeholder="Confirmer votre mots de passe...">
                    <span class="error"><?= returnError($error, 'pwd_confirmed'); ?></span>
                    <input type="submit" class="submit" name="submitted" value="Demander">
                </form>
            <?php } ?>
        </div>
    </section>

<?php
include('inc/footer.php');
