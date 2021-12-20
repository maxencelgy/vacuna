<?php


require '../inc/func.php';
require '../inc/pdo.php';

$error = [];

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
            $sql = "INSERT INTO vds_vaccin (name, content, rappel,obligatoire, status, created_at) 
                VALUES (:nam ,:content,:rappel,:obligatoire,:status, NOW())";

            // Prepare the request
            $query = $pdo->prepare($sql);
            // Injection SQL
            $query->bindValue(':nam', $name, PDO::PARAM_STR);
            $query->bindValue(':content', $content, PDO::PARAM_STR);
            $query->bindValue(':rappel', $rappel, PDO::PARAM_INT);
            $query->bindValue(':obligatoire', $mandatory, PDO::PARAM_STR);
            $query->bindValue(':status', $status, PDO::PARAM_STR);


            //execute the query
            $query->execute();
            // return to the table
            header('Location: management-vaccine.php');

        }
}


include 'inc/header_b.php';
?>
    <div class="container-fluid" id="add_value">
        <h1>Ajoute un Vaccin</h1>
        <form action="" method="post" class="d-flex flex-column">
            <label for="name" class="form-label small">Nom du vaccin</label>
            <input class="form-control" type="text" placeholder="Nom du vaccin" name="name" aria-label="name" id="name" value="<?= returnValue('name');?>">
            <span class="error-input mb-3 mt-1"><?= returnError($error, 'name');?></span>

            <label for="content" class="form-label small">Description</label>
            <div class="input-group d-flex flex-column" ><span class="input-group-text mb-1">Description :</span>
                <textarea class="form-control w-100 h-50" aria-label="content" name="content" id="content" ><?= returnValue('content');?></textarea>
                <span class="error-input mb-3 mt-1"><?= returnError($error, 'content');?></span>
            </div>

            <label for="rappel" class="form-label small">Nombre de mois entre deux doses</label>
            <input class="form-control" type="number" placeholder="Nombre de mois" name="rappel" aria-label="rappel" id="rappel" value="<?= returnValue('rappel');?>" min="0" max="240" >
            <span class="error-input mb-3 mt-1"><?= returnError($error, 'rappel');?></span>

            <label for="obligatoire" class="form-label small">La vaccin est-il obligatoire ?</label>
            <select class="form-control" aria-label="obligatoire" name="obligatoire" id=obligatoire">
                <option value="">Choisir</option>
                <option value="obligatoire">Obligatoire</option>
                <option value="non-obligatoire">Non-obligatoire</option>
                <option value="non indiqué">Non indiqué</option>
            </select>
            <span class="error-input mb-3 mt-1"><?= returnError($error, 'obligatoire');?></span>



            <label for="status" class="form-label small">Status</label>
            <select class="form-control" aria-label="status" name="status" id="status">
                <option value="">Choisir</option>
                <option value="publish">Publier</option>
                <option value="draft">Brouillon</option>
            </select>
            <span class="error-input mb-3 mt-1"><?= returnError($error, 'status');?></span>
        <input type="submit" id="submitted" name="submitted" class="btn btn-primary" placeholder="Envoyer">
        </form>
    </div>

<?php
include ('inc/footer_b.php');
