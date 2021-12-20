<?php
session_start();
require ('inc/func.php');
require ('inc/pdo.php');
// Set PHP here
if (!isLogged()){
    header('Location: index.php');
} else {
    $id = $_SESSION['user']['id'];
    $user = $_SESSION['user'];
}
$listVaccinUser = joinUserVaccin($id);
$vaccinAvailible = getDbOrderAscAndPublish('vds_vaccin');



$error = [];
$success = false;
$newVaccin = false;
if (!empty($_POST['submitted-vaccin'])) {
    //For add vaccin
    //XSS
    $idVaccin = cleanXss('vaccin-select');
    $dateAdd = cleanXss('date-add');

    // Error
    $error = validInput($error,$idVaccin, 'vaccin-select', 0, 99999999999);
    $error = validInput($error,$dateAdd, 'date-add', 1, 200);
    /*If not error*/
    if(empty($error['vaccin-select'])) {
        $sql = "SELECT * FROM vds_vaccin WHERE id = :id_vaccin";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id_vaccin',$idVaccin,PDO::PARAM_STR);
        $query->execute();
        $idVerif = $query->fetch();
        if(empty($idVerif)) {
            $error['vaccin-select'] = 'Vaccin non disponible';
        }
    }
    if (count($error) == 0) {
        $sql = "INSERT INTO vds_user_vaccin (id_user, id_vaccin, vaccin_at, created_at) 
                VALUES (:id_user, :id_vaccin, :vaccin_at, NOW())";

        // Prepare la request
        $query = $pdo->prepare($sql);
        // Injection SQL
        $query->bindValue(':id_user', $id, PDO::PARAM_INT);
        $query->bindValue(':id_vaccin', $idVaccin, PDO::PARAM_INT);
        $query->bindValue(':vaccin_at', $dateAdd, PDO::PARAM_STR);


        //executer la query
        $query->execute();
        $success = true;
        header("Refresh:0");
    }
}

if (!empty($_POST['submitted-new'])) {
    //For vaccin
    //XSS
    $name = cleanXss('name');
    $rappel = cleanXss('rappel');
    $mandatory = cleanXss('obligatoire');
    $dateAjt = cleanXss('date-ajt');


    //Error
    $error = validInput($error,$name, 'name', 1, 200);
    $error = validInput($error,$rappel, 'rappel', 1, 4);
    $error = validInput($error,$mandatory, 'obligatoire', 0, 50);
    $error = validInput($error,$dateAjt, 'date-ajt', 1, 200);

    /*If not error*/
    if (count($error) == 0) {
        $sql = "INSERT INTO vds_vaccin (name, rappel,obligatoire, created_at) 
                VALUES (:nam ,:rappel,:obligatoire, NOW())";

        // Prepare the request
        $query = $pdo->prepare($sql);
        // Injection SQL
        $query->bindValue(':nam', $name, PDO::PARAM_STR);
        $query->bindValue(':rappel', $rappel, PDO::PARAM_INT);
        $query->bindValue(':obligatoire', $mandatory, PDO::PARAM_STR);


        //execute the query
        $query->execute();
        // return to the table

        $lastAdd = $pdo->lastInsertId();
        if (!empty($lastAdd)){
            $sql = "INSERT INTO vds_user_vaccin (id_user, id_vaccin, vaccin_at, created_at) 
                VALUES (:id_user, :id_vaccin, :vaccin_at, NOW())";

            // Prepare la request
            $query = $pdo->prepare($sql);
            // Injection SQL
            $query->bindValue(':id_user', $id, PDO::PARAM_INT);
            $query->bindValue(':id_vaccin', $lastAdd, PDO::PARAM_INT);
            $query->bindValue(':vaccin_at', $dateAjt, PDO::PARAM_STR);


            //executer la query
            $query->execute();
            $newVaccin = true;
            header("Refresh:0");
        }

    }
}

include ('inc/header.php');
?>
    <div class="text_contact">
        <h2 class="title">Profil</h2>
    </div>
    <!--USER Profil-->
    <section id="profil">
        <div class="wrap_profil">
            <div class="profil_left">
                <div class="information_contact">
                    <div class="title_profil">
                        <h2>Information</h2>
                    </div>
                    <div class="profil_name">
                        <h3 class="profil_h3">Votre nom :</h3>
                        <p><?= $user['name'];?></p>
                    </div>
                    <div class="profil_name">
                        <h3 class="profil_h3">Votre prénom :</h3>
                        <p><?= $user['prenom'];?></p>
                    </div>
                    <div class="profil_name">
                        <h3 class="profil_h3">Votre email :</h3>
                        <p><?= $user['email'];?></p>
                    </div>
                    <div class="profil_name">
                        <h3 class="profil_h3">Votre âge :</h3>
                        <p><?= ageOfUser($user['dob']);?></p>
                    </div>
                </div>
            </div>
            <div class="profil_right">
                <img src="./asset/img/profil.png" alt="">
            </div>
        </div>
    </section>

    <section id="vaccin">
        <div class="wrap_vaccin">
            <div class="add_vac">
                <a class="btn" onclick="myFunctions()">Ajoutez un vaccin a votre liste</a>
                <form action="" class="add_form" method="post" id="add">
                    <div class="colonne">
                        <label for="vaccin-select">Choisissez un vaccin :</label>
                        <select name="vaccin-select" id="vaccin-select">
                            <option value="">--SVP Choisissez un vaccin--</option>
                            <?php foreach ($vaccinAvailible as $vaccin){?>
                                <option value="<?= $vaccin['id'];?>"><?= ucfirst($vaccin['name']); ?></option>
                            <?php }?>
                            <span class="error"><?= returnError($error, 'vaccin-select');?></span>
                        </select>
                        <label for="date-add">Date de votre dernier vaccin :</label>
                        <input class="date-add" type="date" name="date-add" id="date-add" value="<?php if (!empty($_POST['date-add'])){ echo transformDate($_POST, 'date-add');} ;?>">
                        <span class="error"><?= returnError($error, 'date-add');?></span>

                        <input type="submit" name="submitted-vaccin" value="Envoyer">
                    </div>
                </form>
                <a href="testimonial.php">Laissez nous un avis <i class="fas fa-sun"></i></a>
            </div>
            <div class="right">
                <?php if (empty($listVaccinUser)) { ?>
                    <div><p>Vous n'avez pas répertorié de vaccin</p></div>
                <?php } else { ?>
                <div class="text_vaccin">
                    <p>Les informations sur vos vaccinations</p>
                </div>

                <div class="grid">
                    <div class="head_grid gridflex">
                        <h2>Nom du vaccin</h2>
                        <h2>Date de la dernière dose</h2>
                        <h2 class="colonne_hiden">Séparation entre les doses (mois*)</h2>
                        <h2>Votre prochaine dose</h2>
                        <h2 class="colonne_hiden">Obligatoire</h2>
                        <!--Ask for, if he do a second shot. what that can do-->
                    </div>
                    <?php foreach ($listVaccinUser as $listVaccin){
                        $date = strtotime($listVaccin['vaccin_at']); ?>
                        <div class="body_grid gridflex">
                            <p><?= ucfirst($listVaccin['vaccin_name']); ?></p>
                            <p><?= date('d/m/Y', $date); ?></p>
                            <p class="colonne_hiden"><?= $listVaccin['rappel']; ?></p>
                            <p><?= date('d/m/Y', strtotime('+'.$listVaccin['rappel'].'month', $date)); ?></p>
                            <p class="colonne_hiden"><?= ucfirst($listVaccin['obligatoire']); ?></p>
                        </div>
                    <?php } ?>
                    <div class="footer_grid gridflex">
                        <h2>Nom du vaccin</h2>
                        <h2>Date de la dernière dose</h2>
                        <h2 class="colonne_hiden">Séparation entre les doses</h2>
                        <h2>Votre prochaine dose</h2>
                        <h2 class="colonne_hiden">Obligatoire</h2>

                    </div>
                </div>
                <?php if($newVaccin){ ?>



                    <p>Merci pour l'ajout, nous allons vérifier ces informations, retrouvez le dans la liste de vaccin !</p>
                <?php }?>
                <p class="addnew">Vous souhaitez ajouter un vaccin qui n'est pas sur la liste <a class="btn" onclick="myFunction3()">cliquez ici.</a></p>
                <form action="" class="add_form" method="post" id="ads">
                    <div class="form_add">
                        <label for="name">Nom du vaccin :</label>
                        <input class="nam_vac" type="text" name="name" placeholder="Le nom de votre vaccin ici" value="<?= returnValue('name'); ?>">
                        <span class="error"><?= returnError($error, 'name');?></span>

                        <label for="rappel">Nombre de mois pour rappels :</label>
                        <input type="number" name="rappel" placeholder="entrez le nombre de mois ici" value="<?= returnValue('rappel'); ?>">
                        <span class="error"><?= returnError($error, 'rappel');?></span>

                        <label for="date-ajt">Date de votre dernier vaccin :</label>
                        <input class="date-ajt" type="date" name="date-ajt" id="date-ajt" value="<?php if (!empty($_POST['date-ajt'])){ echo transformDate($_POST, 'date-ajt');} ;?>">
                        <span class="error"><?= returnError($error, 'date-ajt');?></span>

                        <label for="obligatoire" class="form-label small">La vaccin est-il obligatoire ?</label>
                        <select class="form-control" aria-label="obligatoire" name="obligatoire" id=obligatoire">
                            <option value="">Choisir</option>
                            <option value="obligatoire">Obligatoire</option>
                            <option value="non-obligatoire">Non-obligatoire</option>
                            <option value="non indiqué">Non indiqué</option>
                        </select>
                        <span class="error"><?= returnError($error, 'obligatoire');?></span>

                        <input class="submit" type="submit" name="submitted-new" value="Envoyer">
                    </div>

                </form>
            </div>
            <?php } ?>
    </section>


<?php include ('inc/footer.php');


