<?php
//Script de passage

require '../inc/func.php';
require '../inc/pdo.php';
$error=[];
$succes = false;
$avoidColumn = [];
$dbList = ['vds_msg','vds_testimonial', 'vds_users', 'vds_vaccin', 'vds_user_vaccin'];
// If exist
if (!empty($_GET['id']) && is_numeric($_GET['id'])&& !empty($_GET['table']) && in_array($_GET['table'], $dbList)) {
    $id = $_GET['id'];
    $tableName = $_GET['table'];
    $item = getById($tableName, $id);
    if ($tableName == 'vds_vaccin') {
        if (!empty($_POST['submitted'])) {
            //For vaccin
            //XSS
            $name = cleanXss('name');
            $content = cleanXss('content');
            $rappel = cleanXss('rappel');
            $mandatory = cleanXss('obligatoire');
            $status = cleanXss('status');
            //Error
            $error = validInput($error,$name, 'name', 1, 200);
            $error = validInput($error,$content, 'content', 1, 3000);
            $error = validInput($error,$rappel, 'rappel', 1, 4);
            $error = validInput($error,$mandatory, 'obligatoire', 0, 50);
            $error = validInput($error,$status, 'status', 1, 10);

            /*If not error*/
            if (count($error) == 0) {
                $sql = "UPDATE vds_vaccin SET 
                      name = :nam,
                      content = :content,
                      rappel = :rappel,
                      obligatoire = :obligatoire,
                      status = :status 
                        WHERE id = :id";
                // Prepare the request
                $query = $pdo->prepare($sql);
                // Injection SQL
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->bindValue(':nam', $name, PDO::PARAM_STR);
                $query->bindValue(':content', $content, PDO::PARAM_STR);
                $query->bindValue(':rappel', $rappel, PDO::PARAM_INT);
                $query->bindValue(':obligatoire', $mandatory, PDO::PARAM_STR);
                $query->bindValue(':status', $status, PDO::PARAM_STR);
                //execute the query
                $query->execute();
                $succes = true;
            }
        }

    }
    if ($tableName == 'vds_users'){
        if (!empty($_POST['submitted'])) {
            //For users
            //XSS
            $name = cleanXss('name');
            $prenom = cleanXss('prenom');
            $dob = cleanXss('dob');
            $sex = cleanXss('sexe');
            $email = cleanXss('email');
            $role = cleanXss('role');
            // Error
            $error = validInput($error,$name, 'name', 1, 100);
            $error = validInput($error,$prenom, 'prenom', 1, 200);
            $error = validInput($error,$dob, 'dob', 1, 50);
            $error = validInput($error, $sex, 'sexe', 0, 30);
            $error = validInput($error, $role, 'role', 1, 30);
            $error = mailValidation($error, $email, 'email');
            if ($email != $item['email']) {
                if (empty($errors['email'])) {
                    $sql = "SELECT * FROM vds_users WHERE email = :email";
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $verifEmail = $query->fetch();
                    if (!empty($verifEmail)) {
                        $error['email'] = 'Cette email existe déjà';
                    }
                }
            }
            /*If not error*/
            if (count($error) == 0) {
                $sql = "UPDATE vds_users SET 
                      name = :nam,
                      prenom = :prenom,
                      dob = :dob,
                      sexe = :sexe,
                      email = :email,
                      role = :rol
                        WHERE id = :id";

                // Prepare la request
                $query = $pdo->prepare($sql);
                // Injection SQL
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->bindValue(':nam', $name, PDO::PARAM_STR);
                $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                $query->bindValue(':dob', $dob, PDO::PARAM_STR);
                $query->bindValue(':sexe', $sex, PDO::PARAM_STR);
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->bindValue(':rol', $role, PDO::PARAM_STR);


                //executer la query
                $query->execute();
                $succes = true;
            }
        }


    }

    if (empty($item)){
        abort404();
    }
} else {abort404();}





include ('inc/header_b.php');
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <?php if ($succes){?>
            <div class="text-center mt-5" >
                <div class="h3 mx-auto mb-4 mt-4 text-center text-yellow font-weight-bold">Modification réussi</div>
                <a onclick="javascript:history.go(-2)" class="btn btn-primary "><p class="text-blue-500 mb-0">Revenir sur la page précédente</p></a>
            </div>
        <?php  } else {?>
        <h1 class="h3 mb-4 mt-4 text-center text-yellow font-weight-bold">Modifier</h1>
        <form class="d-flex flex-column" action="" method="post">
            <label for="name" class="form-label small"> Nom : </label>
            <input class="form-control" type="text" placeholder="<?= $item['name'];?>" name="name" aria-label="name" id="name" value="<?= showForUpdate('name', $item['name']);?>">
            <span class="error-input"><?= returnError($error, 'name');?></span>
            <?php if ($tableName == 'vds_users') { ?>
            <label for="prenom" class="form-label small"> Prénom : </label>
            <input class="form-control" type="text" placeholder="<?= $item['prenom'];?>" name="prenom" aria-label="prenom" id="prenom" value="<?= showForUpdate('prenom', $item['prenom']);?>">
            <span class="error-input"><?= returnError($error, 'prenom');?></span>

            <label for="dob" class="form-label small">DOB : </label>
            <input class="form-control" type="date" placeholder="<?= $item['dob'];?>" name="dob" aria-label="dob" id="dob" value="<?= showForUpdate('dob', $item['dob']);?>">
            <span class="error-input"><?= returnError($error, 'dob');?></span>

            <label for="sexe" class="form-label small">Sexe : </label>
                <select class="form-control" aria-label="sexe" name="sexe" id=sexe">
                    <option value="homme" <?= isSelected($item,'sexe','homme'); ?>>Homme</option>
                    <option value="femme" <?= isSelected($item,'sexe','femme'); ?>>Femme</option>
                    <option value="non indiqué" <?= isSelected($item,'sexe','non-indiqué'); ?>>Non indiqué</option>
                </select>
            <span class="error-input"><?= returnError($error, 'sexe');?></span>

            <label for="email" class="form-label small"> Email : </label>
            <input class="form-control" type="email" placeholder="<?= $item['email'];?>" name="email" aria-label="email" id="email" value="<?= showForUpdate('email', $item['email']);?>">
            <span class="error-input"><?= returnError($error, 'email');?></span>
            <?php }
                if ($tableName == 'vds_vaccin') { ?>
            <label for="content" class="form-label small">Description</label>
            <div class="input-group d-flex flex-column"><span class="input-group-text mb-1 ">Description :</span>
                <textarea class="form-control w-100" aria-label="content" name="content" id="content" ><?= showForUpdate('content', $item['content']);?></textarea>
                <span class="error-input"><?= returnError($error, 'content');?></span>
            </div>

            <label for="rappel" class="form-label small">Année entre deux doses</label>
            <input class="form-control" type="number" placeholder="Rappel" name="rappel" aria-label="rappel" id="rappel" value="<?= showForUpdate('rappel', $item['rappel']);?>" min="0" max="600" >
            <span class="error-input"><?= returnError($error, 'rappel');?></span>

            <label for="obligatoire" class="form-label small">La vaccin est-il obligatoire ?</label>
            <select class="form-control" aria-label="obligatoire" name="obligatoire" id=obligatoire">
                <option value="obligatoire" <?= isSelected($item,'obligatoire','obligatoire'); ?>>Obligatoire</option>
                <option value="non-obligatoire" <?= isSelected($item,'obligatoire','non-obligatoire'); ?>>Non-obligatoire</option>
                <option value="non indiqué" <?= isSelected($item,'obligatoire','non-indiqué'); ?>>Non indiqué</option>
            </select>
            <span class="error-input"><?= returnError($error, 'obligatoire');?></span>

            <label for="status" class="form-label small">Status</label>
            <select class="form-control" aria-label="status" name="status" id="status">
                <option value="publish" <?= isSelected($item,'status','publish'); ?>>Publier</option>
                <option value="draft" <?= isSelected($item,'status','draft'); ?>>Brouillon</option>
            </select>
            <span class="error-input"><?= returnError($error, 'status');?></span>
            <?php }
                if ($tableName == 'vds_users') { ?>
            <label for="role" class="form-label small">Rôle</label>
            <select class="form-control" aria-label="role" name="role" id="role">
                <option value="user" <?= isSelected($item,'role','user'); ?>>User</option>
                <option value="admin" <?= isSelected($item,'role','admin'); ?>>Admin</option>
            </select>
            <span class="error-input"><?= returnError($error, 'status');?></span>
                <?php } ?>
            <input type="submit" id="submitted" name="submitted" class="btn btn-primary" placeholder="Envoyer">
        </form>
        <?php }?>
        </div>

<?php
include ('inc/footer_b.php');
