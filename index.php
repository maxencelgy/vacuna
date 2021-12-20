<?php
require ('inc/func.php');
require ('inc/pdo.php');
// Set PHP here
session_start();

require ('inc/connection.php');
$testimonialRandom = getTestiRandomLimit(5);

if (isLogged()){
    $id = $_SESSION['user']['id'];
    $user = $_SESSION['user'];
}
include ('inc/header.php');
?>
    <!--MAIN INDEX USER-->
<?php if (!isLogged()) { ?>
    <section id="connexion">
    <div class="wrap2">
        <div class="box">
            <div class="rond"></div>
            <div class="hotesse">
                <img src="asset/img/accueil.png" alt="">
            </div>
        </div>

        <div class="cadre">
            <form action="" method="post" class="wrapform" novalidate>
                <label for="login">E-mail</label>
                <input type="text" id="login" name="login" value="<?= returnValue('login') ?>" class="input" placeholder="&#xf007;  Entrez votre email" style="font-family:Arial, FontAwesome">
                <span class="error"><?= returnError($error,'login')?></span>

                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" value="<?= returnValue('password') ?>" class="input" placeholder="&#xf023; Entrez votre mot de passe" style="font-family:Arial, FontAwesome">
                <span class="error"><?= returnError($error,'password')?></span>
                <input type="submit" name="submitted" value="Connexion" class="submit input2">
                <a href="lost-pwd.php">Mot de passe oublié ?</a>
                <p class="inscription">Si vous n'avez pas de compte <a href="inscription.php">inscrivez vous-ici</a></p>
            </form>
        </div>
    </div>
<?php } ?>
    </section>

    <section id="parallax">
        <div class="wrap_para">
            <h1>Rejoignez nous</h1>
            <div class="separator"></div>
            <p>Tout comme nos 11 millions d'utilisateurs inscrivez-vous et utiliser la Vacuna Del Sol pour garder la main sur vos vaccins, bénéficiez de mails de rappels lorsque un de vos vaccins doit être renouvelé, un service à disposition 7 jours sur 7 de 8h à 21h. </p>
            <?php if (!isLogged()){ ?>
            <a href="inscription.php">Inscrivez vous ici</a>
            <?php } ?>
        </div>
    </section>

    <section id="details">
        <div class="wrap3">
            <div class="title">
                <h2>Vaccinez vous chez la meilleure équipe</h2>
            </div>
            <div class="cards">
                <div class="card">
                    <i class="fas fa-bookmark"></i>
                    <h3>Pourquoi nous choisir ?</h3>
                   <p>Nous sommes une équipe attentive et à l’écoute de nos utilisateurs et adhérents leur bien-être et leur avis est vital pour nous pour installer un climat de confiance.</p>
                </div>
                <div class="card">
                    <i class="fas fa-binoculars"></i> <h3>Qu’est -ce que la Vacuna Del Sol ?</h3>
                    <p>Une équipe professionnelle, nous misons sur l’efficacité et la rapidité afin de répondre aux demandes le plus rapidement, avec notre interface dynamique et fluide pour maximiser l’interactivité avec nos adhérents et les personnes en hésitations.</p>
                </div>
                <div class="card">
                    <i class="fas fa-shield-alt"></i> <h3> Une équipe de confiance</h3>
                    <p>Vos données sont stockées et sécurisées avec nous, chaque jour une veille est faite afin de maximiser le confort de nos utilisateurs.</p>
                </div>
                <div class="card">
                    <i class="fas fa-comment-medical"></i> <h3>Vaccination</h3>
                    <p>Grâce à notre carnet de vaccination digital, ne perdez rien sur vos vaccins, vous serez toujours à jour et des rappels se feront afin que vous n’oubliiez rien.</p>
                </div>
                <div class="card">
                    <i class="fas fa-hand-holding-heart"></i>
                    <h3> Nous le faire savoir</h3>
                   <p> Vos avis nous intéressent, alors n’hésitez pas à laisser des commentaires afin que nous puissions nous améliorer, et vous donner plus de confiance en notre service.</p>
                </div>
                <div class="card">
                    <i class="fas fa-desktop"> </i>
                    <h3>Développeur</h3>
                    <p>Avec son équipe de développeur la Vacuna Del Sol met tout en œuvre afin de garder au maximum un site dynamique et facile d’accès, votre bien être est notre sourire.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="slider">
        <div class="wrap4">
            <div class="title">
                <h2>Avis de nos clients </h2>
            </div>
            <div class="container">
                <div class="wrapper">
                    <!--Need at least 5 element-->
                    <?php foreach ($testimonialRandom as $testi) { ?>
                    <div class="card">
                        <div class="card-body">
                            <p class="review"><i class="fas fa-quote-left"></i> <?= substr($testi['content'], 0, 150); ?> <i class="fas fa-quote-right"></i></p>
                            <p><?= $testi['name'];?></p>
                            <p><?= $testi['prenom'];?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="indicators">
                    <button class="active"></button>
                    <button ></button>
                    <button ></button>
                    <button ></button>
                    <button ></button>
                </div>
            </div>
        </div>
    </section>

<?php include ('inc/footer.php');
