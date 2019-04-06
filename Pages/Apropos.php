<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 20/12/2018
 * Time: 22h36
 */
?>
<?php require_once('page_number.php'); ?>


<section id="" class="">
<div class="container" style="padding: initial; margin: initial; width: 100%">
    <div class="row" style="padding: initial; margin: initial; width: 100%">
        <?php
        foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Extreme Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $cover):

            echo '<div class="col-lg-12 apropos-cover" style="border-bottom: 5px solid #1073b2; margin-top: 50px; z-index: 0;
    background: url('.$cover->chemin.') no-repeat center;
    /* background-color: #2F2F2E; */
    background-repeat: no-repeat;
    background-position: center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    height: 200px;">

    </div>';
        endforeach;
        ?>

        <div class="col-lg-12" style="background: white; margin-bottom: 20px;">
            <?php
            foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $profil):
                echo '<div class="col-lg-3">
                <img src="'.$profil->chemin.'" alt="'.$profil->title.'" title="'.$profil->title.'" style="float: right; margin-top: -70px; z-index: 10;border: 2px solid #1073b2;" class="img-circle" width="130" height="130">
                </div>';
            endforeach;
            ?>
            <div class="col-lg-5" style="color: black">
            <p style="font-variant: small-caps;">
                <span style="font-size: 26px; font-weight: bold;">Bertin Mounok</span><br>
                <em>Developpeur d'Applications Informatique</em><br>
                <hr style="margin: initial; padding: initial; width: 100px;">
                <i> A l'écoute d'opportunités</i>
            </p>
            </div>
            <div class="col-lg-4" style="padding: 2% 0 2px 0;">
                <div class="col-xs-6 col-md-6 col-lg-4" style="padding: 5px 0 0 0; font-variant: small-caps;"><button  class="btn btn-primary ombrage" style="border-radius: 50%;" disabled="disabled">Me Suivre →</button></div>
                <div class="col-xs-6 col-md-6 col-lg-8" style="padding: initial; margin: initial;">
                <ul class="social_icons">
                    <li><a href="https://www.facebook.com/Ndembapipo" title="Facebook bertin-dev"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/bertin_dev" title="Twitter bertin-dev"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/u/0/?tab=wX" title="Google+ bertin-dev"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/bertin-mounok-415754120/" title="LinkedIn bertin-dev"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="index.php?id_page=<?= intval($_ENV['id_page'])+1; ?>" title="Blog bertin-dev"><i class="fa fa-comments"></i></a></li>
                </ul>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-md-3 col-lg-3" data-wow-duration="1000ms" data-wow-delay="600ms">

            <div class="col-xs-12 col-md-12 col-lg-12 mb-4 wow bounceInLeft" style="margin-bottom: 30px">
                <!-- Card -->
                <div class="card card-cascade narrower">
                    <h4 style="font-variant: small-caps;color: black;">→ Actuellement</h4>
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">
                        <p style="color: black;">
                            En formation chez Faculté Des Sciences
                            <small>Précédents : CIs , Google Developper Group (GDG)</small>
                        </p>
                    </div>

                    <div class="card-body card-body-cascade" style="Background: whitesmoke; color: black;">
                        <div class="col-xs-6 col-sm-5 col-lg-5">
                            <p><small>Poste: <em>Web Developper </em></small></p>
                        </div>
                        <div class="col-xs-6 col-sm-7 col-lg-7 right-sidebar" style="color: black;">
                            <p>
                                <small>Yaoundé, Centre
                                    Cameroun</small>
                            </p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-xs-12 col-md-12 col-lg-12 wow fadeInLeft mb-4" data-wow-duration="1000ms" data-wow-delay="600ms" style="color: black;">
                <!-- Card -->
                <div class="card card-cascade narrower col-xs-12 col-md-12 col-lg-12 wow fadeInLeft mb-4" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <h4 style="font-variant: small-caps;" >→ Projet Freelance Actuel</h4>
                    <?php $projet_encours = App::getDB()->prepare_request('SELECT titre, description FROM projets_encours ORDER BY id_projet DESC LIMIT 1', []);  ?>
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">
                        <p style="color: black;">
                            <?=utf8_encode($projet_encours['titre']);?>
                        </p>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                        <!-- Text -->
                        <p class="card-text" style="font-size: 15px"><?=utf8_encode($projet_encours['description']);?></p>
                    </div>

                </div>
            </div>

        </div>




        <div id="Apropos_content" class="col-xs-12 col-md-6 col-lg-6 wow" data-wow-duration="1000ms" data-wow-delay="600ms" style="margin-bottom: 20px; background: white;">

            <?php
            if(isset($_GET['resume']) && $_GET['resume']==1)
            {
                ?>
                <div class="col-lg-12 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade narrower">
                        <h4 style="font-variant: small-caps;color: black;" >→ Je parle de moi</h4>
                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">
                            <p style="color: black;">
                                En formation chez Faculté Des Sciences
                                <small>Précédents : CIs , Google Developper Group (GDG)</small>
                            </p>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                            <!-- Text -->
                            <p class="card-text" style="font-size: 15px">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Harum natus nobis voluptatum? Adipisci doloremque eius eveniet
                                nostrum officia reiciendis rerum sequi sunt velit? Ab aliquid magni
                                modi nam quasi quod.
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Harum natus nobis voluptatum? Adipisci doloremque eius eveniet
                                nostrum officia reiciendis rerum sequi sunt velit? Ab aliquid magni
                                modi nam quasi quod.
                            </p>
                        </div>

                    </div>
                </div>
                <?php
            }
            else if(isset($_GET['photos']) and $_GET['photos']==1)
            {
                ?>

                <div id="fullscreen">
                    <div id="fullscreen-inner">
                        <div id="fullscreen-inner-left" class="fullscreen-inner-button"><span class=""><</span></div>
                        <div id="fullscreen-inner-right" class="fullscreen-inner-button"><span class="">></span></div>
                        <div id="fullscreen-inner-close" class="fullscreen-inner-button"><span class="">X</span></div>
                        <div id="fullscreen-image"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 col-lg-4">
                    <h1>ENTREPRISE</h1>
                    <div class="wrapper-inner-content">
                        <div class="wrapper-inner-content-image" style="height: 210px;">
                            <img src="img/Accueil/Bureau/IMG_20160606_135643.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20160606_135643_1.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20170915_205132_1.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20180723_075552.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20180723_075611.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20180806_132907.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/PhotoGrid_1533609412457.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20180723_075629_1.jpg" class="img-responsive">
                            <img src="img/Accueil/Bureau/IMG_20180806_102057.jpg" class="img-responsive">

                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">
                                <div class="wrapper-inner-content-image-hover-cercle">
                                    <span class="">Aperçu</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-xs-12 col-md-4 col-lg-4">
                    <h1>COMMUNAUTE</h1>
                    <div class="wrapper-inner-content">
                        <div class="wrapper-inner-content-image" style="height: 210px;">

                            <img src="img/Accueil/Communauté/885521_679355868793283_4030499793209983404_o.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/1554437_1111230438909868_860614145231183785_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/12243442_1111244152241830_3507586583985597982_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/12278780_1111080825591496_962846189651354926_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/bertin.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/FB_IMG_1466950939173.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/FB_IMG_1466951335161.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/FB_IMG_1466951346742.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20151114_101303.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20160625_151012.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20160625_155908_1.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20170805_144011.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20170805_162815.jpg" class="img-responsive">
                            <img src="img/Accueil/Communauté/IMG_20151114_101603.jpg" class="img-responsive">

                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">
                                <div class="wrapper-inner-content-image-hover-cercle">
                                    <span class="">Aperçu</span>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-md-4 col-lg-4">
                    <h1>ECOLE</h1>
                    <div class="wrapper-inner-content">
                        <div class="wrapper-inner-content-image" style="height: 210px;">

                            <img src="img/Accueil/Ecole/10322802_1171948182838093_5736028499754761440_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/12798960_1171948812838030_1323373972826201603_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/12805728_1171948712838040_7708567062755940023_n.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/IMG-20161021-WA0017.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/IMG-20170111-WA0002.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/IMG-20170111-WA0009.jpg" class="img-responsive">
                            <img src="img/Accueil/Ecole/vlcsnap-error528.png" class="img-responsive">
                            <img src="img/Accueil/Ecole/vlcsnap-error855.png" class="img-responsive">
                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">
                                <div class="wrapper-inner-content-image-hover-cercle">
                                    <span class="">Aperçu</span>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>

                <?php
            }else{
                ?>
                <h4 style="font-variant: small-caps; color: black; background-color: whitesmoke;" >→ Mon Parcours Professionnel</h4>
                <div class="tree">

                    <ul>
                        <li>
                            <a href="#">ETUDES</a>
                            <ul>
                                <li>
                                    <a href="#">STAGE</a>
                                    <ul>
                                        <li>
                                            <a href="#">INFO-MAC</a>
                                            <ul>
                                                <li> <a href="#">Informaticien</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">EMPLOI</a>
                                    <ul>
                                        <li>
                                            <a href="#">INSTITUT<br>SALOMON</a>
                                            <ul>
                                                <li> <a href="#">Responsable<br>Formation<br>& Planification</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">SHCASP </a>
                                            <ul>
                                                <li> <a href="#">Webmaster</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">ATIDOLF<br>NIG LTD</a>
                                            <ul>
                                                <li> <a href="#">Analyste<br>Programmeur</a></li>
                                            </ul>
                                        </li>

                                        <!--<li>
                                            <a href="#">BEAC</a>
                                            <ul>
                                                <li> <a href="#">Développeur</a></li>
                                            </ul>
                                        </li>-->

                                    </ul>
                                </li>

                                <li class="visible-sm visible-md visible-lg">
                                    <a href="#">FREELANCE</a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                    <!-- Card -->
                    <div class="card card-cascade narrower col-xs-12 col-lg-12">
                        <h4 style="font-variant: small-caps;color: black;">→ Ma Story</h4>
                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">
                            <p style="color: black;">
                                <?= \App\Twitter\Twitter::autolink('#bertin-dev'); ?> un Geek de l'informatique en général et la programmation en particulier depuis
                                l'âge de 17 ans. Au début je jouais beaucoup aux Jeux Vidéos (j'étais Gamer),
                                ensuite j'ai attaqué l'installation des logiciels, des Jeux PC, des systèmes d'exploitations,
                                le crackage des logiciels, le surf illégal, les téléchargements et
                                très vite c'est devenu une passion que j'ai pu orienter vers le codage des logiciels d'entreprises
                                depuis un bout de temps. <a href="">Lire la suite</a>
                            </p>
                        </div>


                    </div>
                </div>

                <?php
            }
            ?>
        </div>


        <div class="col-xs-12 col-md-3 col-lg-3">
            <div class="col-md-12 col-lg-12 mb-4 wow bounceInRight" data-wow-duration="1000ms" data-wow-delay="600ms" style="background: white; margin-bottom: 20px; color: black;">
                <!-- Card -->
                <h4 style="font-variant: small-caps;" class="text-left">→ Mes Articles</h4>
                <div class="card card-cascade narrower">
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header peach-gradient" style="background-image: initial;">
                        <ul class="">
                            <li>
                                <a href="index.php?id_page=6" class="white-text">
                                    Mon Organigramme
                                </a>
                            </li>
                            <li>
                                <a href="index.php?id_page=6&amp;resume=1" class="white-text">
                                    Je Parle de Moi
                                </a>
                            </li>
                            <li>
                                <a href="index.php?id_page=6&amp;photos=1" class="white-text">
                                    Mes Photos
                                </a>
                            </li>
                        </ul>
                        <div class="card-body card-body-cascade text-center">
                        <h4 style="font-variant: small-caps;" class="text-left" >Mes Technologies</h4>
                        <div class="col-xs-6 col-sm-3 col-lg-6"><img src="img/apropos/Xamarin_logo_and_wordmark.png" alt="" class="img-responsive"></div>
                        <div class="col-xs-6 col-sm-3 col-lg-6"><img src="img/apropos/apple-android-windows-logos.png" alt="" class="img-responsive"></div>
                        <div class="col-xs-6 col-sm-3 col-lg-6"><img src="img/apropos/syncfusion_Logo.png" alt="" class="img-responsive"></div>
                        <div class="col-xs-6 col-sm-3 col-lg-6"><img src="img/apropos/TWD-Logo-dodgerblue.png" alt="" class="img-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="">
                <?php
                foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Extreme Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $cover):

                    echo '<div class="col-xs-12 col-md-12 col-lg-12 apropos-cover" style="height: 100px;
    background: url('.$cover->chemin.') no-repeat center;
    /* background-color: #2F2F2E; */
    background-repeat: no-repeat;
    background-position: center center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    height: 100px;">
<h4 style="position: absolute; left: 40%; top: 50%; color: #2487c7;font-variant: small-caps;">#Bertin Mounok <br> <small><em>Cameroun</em></small></h4>
    </div>';
                endforeach;
                ?>
                <div class="col-xs-12 col-md-12 col-lg-12" style="background: white; margin-bottom: 20px;">
                    <?php
                    foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $profil):
                        echo '<div class="col-xs-3 col-md-3 col-lg-5">
                <img src="'.$profil->chemin.'" alt="'.$profil->title.'" title="'.$profil->title.'" style="float: right; margin-top: -45px; z-index: 10;" class="img-thumbnail">
                </div>';
                    endforeach;
                    ?>
                    <div class="col-xs-9 col-md-9 col-lg-7" style="color: black">
                        <?php
                        foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         ORDER BY id_page DESC LIMIT 0, 3 ') AS $profil):
                            echo '<img src="'.$profil->chemin.'" alt="'.$profil->title.'" title="'.$profil->title.'" class="img-circle" width="40" height="40" style="float: left; margin-right: 2px;">';
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

        </div>








    </div>
</div>
</section>
