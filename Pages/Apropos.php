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

                <span style="font-size: 26px; font-weight: bold;"><small>Bertin Mounok</small></span><br>

                <em>Developpeur d'Applications</em><br>

                <hr style="margin: initial; padding: initial; width: 100px;">

                <i> A l'écoute d'opportunités</i>

            </p>

            </div>

            <div class="col-lg-4" style="padding: 2% 0 2px 0;">

                <div class="col-xs-6 col-md-6 col-lg-4" style="padding: 5px 0 0 0; font-variant: small-caps;"><button  class="btn btn-primary ombrage" style="border-radius: 50%;" disabled="disabled">Me Suivre →</button></div>

                <div class="col-xs-6 col-md-6 col-lg-8" style="padding: initial; margin: initial;">

                <ul class="social_icons">

                    <li><a href="https://www.facebook.com/bertin.dev" title="Facebook bertin.dev"><i class="fa fa-facebook"></i></a></li>

                    <li><a href="https://twitter.com/bertin_dev" title="Twitter bertin.dev"><i class="fa fa-twitter"></i></a></li>

                    <li><a href="https://www.linkedin.com/in/bertin-mounok-415754120/" title="LinkedIn bertin-dev"><i class="fa fa-linkedin"></i></a></li>

                    <li><a href="Portfolio?id_page=<?= intval($_ENV['id_page'])+1; ?>" title="Blog bertin-dev"><i class="fa fa-comments"></i></a></li>

                </ul>

                </div>

            </div>

        </div>





        <div class="col-xs-12 col-md-3 col-lg-3" data-wow-duration="1000ms" data-wow-delay="600ms">



            <div class="col-xs-12 col-md-12 col-lg-12 mb-4 wow bounceInLeft" style="margin-bottom: 30px">

                <!-- Card -->

                <div class="card card-cascade narrower">

                    <h4 style="font-variant: small-caps;color: black;">→ Actuellement Chez</h4>

                    <!-- Card image -->

                    <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial; margin: initial; padding: initial;">

                        <?php $actuellement = App::getDB()->prepare_request('SELECT * FROM admin ORDER BY id_admin DESC LIMIT 1', []);  ?>

                        <h4 style="color: black; margin: initial; padding: initial;"><?=$actuellement['entreprise'];?></h4>

                        <p style="color: black; padding: 0 5px 0;"><?=$actuellement['specialite_entreprise'];?></p>

                    </div>



                    <div class="card-body card-body-cascade" style="Background: whitesmoke; color: black; margin: initial; padding: initial;">

                        <div class="col-xs-6 col-sm-5 col-lg-5">

                            <p><small>Poste: <em><?=$actuellement['poste_occupe'];?></em></small></p>

                        </div>

                        <div class="col-xs-6 col-sm-7 col-lg-7 right-sidebar" style="color: black; margin-top: initial;">

                            <p>

                                <small><?=$actuellement['lieu_de_travail'];?>,

                                    <?=$actuellement['ville'];?>, <?=$actuellement['pays'];?></small>

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

                        <p style="color: black; font-weight:bold;">

                            <?=$projet_encours['titre'];?>

                        </p>

                    </div>



                    <!-- Card content  -->

                    <div class="view view-cascade card-body card-body-cascade text-center" style="color: black; margin: initial; padding: initial;">

                        <!-- Text -->

                        <p class="card-text" style="font-style: italic;font-size: 16px;color:black;"><small><?=$projet_encours['description'];?></small></p>

                    </div>



                </div>

            </div>



            <div class="visible-lg visible-md col-md-12 col-lg-12 wow fadeInLeft mb-4" data-wow-duration="1000ms" data-wow-delay="600ms" style="color: black; padding: 0; margin: 0">



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

<h4 style="position: absolute; left: 40%; top: 50%; color: white;font-variant: small-caps; font-weight: bold;">#Bertin Mounok <br> <small><em style="font-weight: bold;color: white;">Cameroun</em></small></h4>

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

                            <p style="color: black;">LES GRANDES LIGNES QUI ONT FAIT DE MOI UN GEEK.</p>

                        </div>



                        <!-- Card content -->

                        <div class="view view-cascade card-body card-body-cascade text-center">

                            <!-- Text -->

                            <p class="card-text" style="font-size: 15px; text-align: justify; text-indent: 20px; color: black;">

                                <?php

                            if(isset($_GET['contenu']) && $_GET['contenu']==2)

                            {

                                ?>

                                Aucours  de cette année, j'avais fais également la rencontre d'un jeune comme moi <strong>Jason Cross</strong>. Plus passionné que moi de l'informatique et surtout hyperbalaise sur internet.

                                c'est ainsi que lui et moi commencions à parler technologies, échangions les jeux vidéos, les logiciels, téléchargions des contenus dans l'illégalité etc...<br> C'est avec lui que j'ai appris beaucoup de choses

                                dans le digital. <br> Plutard, je fus contraint d'aller m'installer à Douala compte tenu du fait que mes parents avaient été affectés à Douala pour des raisons professionnelles.

                                C'étais le début d'une nouvelle vie, des nouvelles connaissances, de nouvelles mentalités etc...

                                Face à ce changement, l'adaptation ne fus pas facile les deux premières années. Pendant ces 2 ans, j'ai casiment abandonné les autres aspects informatique que j'éxerçais excepté la programmation en C car les études scientifiques me prenaient extrêmement le temps.

                                Pour commencer à étudier le langage C, j'ai dû chercher sur internet les meilleurs cours c'est ainsi que j'étais tombé sur un bon site web autrefois appelé site du zéros, mais aujourd'hui appelé openclassrooms. Dans ce site les cours sont disponibles gratuitement et en premium avec

                                possibilité d'obtention des certifications dans plusieurs branches.

                                Ces cours sont extrêmement bien détaillés surtout excellents pour l'introduction en programmation. voilà c'est comme cela que je m'étais jetté.

                                Pendant 1an je réalisais de multiples petits programmes qui devaient m'être bénéfique plutard.

                                C'est ainsi que j'ai pu acquérir une bonne logique dans la résolution d'algorithmes. Plutard, j'ai commencé à réaliser  un petit jeux vidéo avec la bibliothèque SDL et le langage C.

                                faute de temps je n'ai jamais réussit à achever ce projet. Un peut plutard, Après avoir eu mon diplôme de l'enseignement secondaire en Mathématiques et science physique, ensuite je suis entré en faculté des sciences pour étudier les mathématiques et l'informatique. bien qu'étant l'une des rares personnes qui savait ce qu'elle voulait devenir depuis, des années à l'avance.<br>

                                Pendant mon cursus, je fis la connaissances d'autres geek de l'informatique comme moi la 1ère année mais parmi eux nous n'étions que 2 qui avions un niveau acceptable en programmation pour les autres c'étais les jeux vidéos, logiciels, internet etc.....

                                Avec cet ami qui lui faisait du PHP et moi du C et deux autres, nous avions entrepris de travailler sur le projet d'un autre ami <strong>Steve</strong> qui consistait à la conception d'un site web pour une église catholique.

                                <br> Puisque je n'étais pas apte en PHP

                                c'est donc <strong>Harry</strong> qui ménait le projet et nous étions en charge de l'accompagner. Mais hélas, ce projet s'était arrêté en chemin à cause du non respects des clauses de départs. Mais de ce projet inachevé j'ai eu l'enthousiasme de me lancer dans le PHP

                                vue que j'avais des prérequis acquis au lycée en HTML/CSS et C, ce fut pas trop compliquer de m'intégrer dans le PHP.

                                Deux ans après pendant que j'étais toujours étudiant, je me suis lancé dans une formation en tant que développeur d'application pendants 1 an, ce qui m'a value une attestion de fin de formation et plutard

                                j'ai obtenu un diplôme du ministère de l'emploi et la formation professionnelle. Après ce cesame, je n'ai pas voulu m'arrêter en si bon chemin. Faisant partie du GDG(Google developers Group de Douala), un programme de formation organsé par le géant de la technologie Google fut lancé.

                                C'est ainsi que je m'étais inscrit à ce programme où j'avais eu le 2<sup>ème</sup> meilleur prix muni d'une certification délivré par Google entant que Développeur Android. Ce fut une grande joie. Les photos de ma gallerie en témoigne les faits.

                                Cette nouvelle certification incrémentait mon compteur de certifications qui était déjà au nombre de 3.

                                <br>Toujours cette même année, je fis la connaissance de mon enseignant de l'université qui me fit confiance en me confiant des travaux de conception

                                dans le web ce qui se passait souvent bien. De cette belle collaboration naquis une idée d'accélerer la mise en place d'un centre de formation professionnel agrée

                                j'ai nommé <a href="http://www.the-builders.org" title="IS">INSTITUT SALOMON</a>. J' étais chargé de la conception et l'administration du site web mais aussi<strong><em> Responsable formation et planification</em></strong>.

                                Tout ceci en étant toujours étudiant. <br> Après avoir travaillé plus d'un an avec le prof, mais aussi après l'obtention de mon diplôme de l'enseignement supérieur,

                                je fus contacté par une start-up du côté de yaoundé ou j'ai passé plusieurs test (Téléphonique, théorique, pratique, oral), je fus l'unique candidat retenu sur une centaine.

                                preuve que la compétence y est. C'étais le grand retour dans ma ville d'origine. je travaillais comme <strong><em title="WEBMASTER">Spécialiste en création et design des sites web.</em></strong> <br>

                                Malheureusement je n'avais pas mi long dans cette start-up car j'avais été contacté par une grande entreprise qui exerce dans les

                                <abbr title="Bâtiments et Travaux Publics">BTP</abbr>. je travaillais comme <strong><em>Analyste Programmeur</em></strong> et j'avais des missions qui m'avaient été assignés pour une durée assez déterminée.

                                    c'est-à-dire Concevoir une <abbr title="Enterprise Ressources Planning">ERP</abbr> qui intégre la Gestion (des Ressources humaines, de la caisse, du stock matériel de chantier, du gasoil et droits d'accès utilisateurs)

                                objectifs que j'avais rempli avec succès. vous pouvez vérifier dans le menu Porfolio de l'application web<br>

                                Aujourd'hui je travaille comme <strong><em>Développeur Android</em></strong> dans une <abbr title="Technologie au service des Finances">FINTECH</abbr> Je suis chargé de participer au développement du site web de l'entreprise avec laravel, et développer des Applications Android qui sont capables de communiquer

                                avec des cartes bancaires de type NFC(VISA CARD, MASTER CARD, PAYPASS, UNIONPAY, RUPAY, AMEX CARD, DISCOVER CARD, JCB CARD), MAGNETIQUES, IC, RFID, ensuite utiliser des APIs afin de se connecter aux serveurs afin d'effectuer des transactions financières des opérateurs et tout ceci via des <abbr title="TPE">Terminaux de paiement Electroniques</abbr>.

                                <br> ça se passe plutôt bien jusqu'ici.

                                <br> Ainsi donc s'achève de manière brève le résumé de mon pacours depuis l'âge de 17 ans ou j'ai débuté dans les TIC.



                                <?php

                            }

                            ?>

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



                <div class="col-xs-12 col-sm-6 col-lg-6">

                    <h1 style="color: black" >ENTREPRISE</h1>

                    <div class="wrapper-inner-content">

                        <div class="wrapper-inner-content-image" style="height: 210px;">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0043.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0117.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0116.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0108.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0114.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0097.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0099.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0096copie.jpg" class="img-responsive">

                            <img src="img/apropos/Entreprise/IMG-20190624-WA0095.jpg" class="img-responsive">

							 <img src="img/apropos/Entreprise/IMG-20190624-WA0093.jpg" class="img-responsive">

							  <img src="img/apropos/Entreprise/IMG-20190624-WA0082.jpg" class="img-responsive">

							   <img src="img/apropos/Entreprise/IMG-20190624-WA0075.jpg" class="img-responsive">

							    <img src="img/apropos/Entreprise/IMG-20190624-WA0074.jpg" class="img-responsive">

								 <img src="img/apropos/Entreprise/IMG-20190624-WA0072.jpg" class="img-responsive">

								<img src="img/apropos/Entreprise/IMG-20190624-WA0059.jpg" class="img-responsive">

								 <img src="img/apropos/Entreprise/IMG-20190624-WA0055.jpg" class="img-responsive">

								 <img src="img/apropos/Entreprise/IMG-20190624-WA0050.jpg" class="img-responsive">

								 <img src="img/apropos/Entreprise/IMG-20190624-WA0048.jpg" class="img-responsive">



                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">

                                <div class="wrapper-inner-content-image-hover-cercle">

                                    <span class="">Aperçu</span>

                                </div>

                            </div>

                        </div>



                    </div>



                </div>





                <div class="col-xs-12 col-sm-6 col-lg-6">

                    <h1 style="color: black">COMMUNAUTE</h1>

                    <div class="wrapper-inner-content">

                        <div class="wrapper-inner-content-image" style="height: 210px;">



                            <img src="img/apropos/Communaute/IMG-20190624-WA0049.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0057.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0061.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0064.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0073.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0076.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0081.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0083.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0092.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0100.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0102.jpg" class="img-responsive">

                            <img src="img/apropos/Communaute/IMG-20190624-WA0105.jpg" class="img-responsive">



                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">

                                <div class="wrapper-inner-content-image-hover-cercle">

                                    <span class="">Aperçu</span>

                                </div>

                            </div>







                        </div>



                    </div>

                </div>



                <div class="col-xs-12 col-sm-6 col-lg-6">

                    <h1 style="color: black">ECOLE</h1>

                    <div class="wrapper-inner-content">

                        <div class="wrapper-inner-content-image" style="height: 210px;">



                            <img src="img/apropos/Ecole/IMG-20190624-WA0038.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0039.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0042.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0046.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0051.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0053.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0054.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0056.jpg" class="img-responsive">

							<img src="img/apropos/Ecole/IMG-20190624-WA0060.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0063.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0065.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0066.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0067.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0071.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0079.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0080.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0090.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0094.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0104.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0111.jpg" class="img-responsive">

                            <img src="img/apropos/Ecole/IMG-20190624-WA0112.jpg" class="img-responsive">

                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">

                                <div class="wrapper-inner-content-image-hover-cercle">

                                    <span class="">Aperçu</span>

                                </div>

                            </div>







                        </div>



                    </div>

                </div>







				 <!-- <div class="col-xs-12 col-sm-6 col-lg-6">

                    <h1 style="color: black">LOISIRS</h1>

                    <div class="wrapper-inner-content">

                        <div class="wrapper-inner-content-image" style="height: 210px;">



                            <img src="img/apropos/IMG-20190624-WA0103.jpg" class="img-responsive">

                            <img src="img/apropos/Loisirs/IMG-20190624-WA0109.jpg" class="img-responsive">

                            <img src="img/apropos/Loisirs/IMG-20190624-WA0110.jpg" class="img-responsive">

                            <img src="img/apropos/Loisirs/IMG-20190624-WA0113.jpg" class="img-responsive">

                            <img src="img/apropos/Loisirs/IMG-20190624-WA0118.jpg" class="img-responsive">



                            <div class="wrapper-inner-content-image-hover" style="height: 210px;">

                                <div class="wrapper-inner-content-image-hover-cercle">

                                    <span class="">Aperçu</span>

                                </div>

                            </div>







                        </div>



                    </div>

                </div>-->



                <?php

            }else{

                ?>

                <h4 style="font-variant: small-caps; color: black; background-color: whitesmoke;" >→ Mon Parcours Professionnel</h4>

                <div class="tree">



                    <ul class="tree1" style="font-family: Merriweather, serif;font-style: italic;font-size: 15px;">

                        <li>

                            <a href="#" title="Etudes supérieur">ETUDES</a>

                            <ul>

                                <li>

                                    <a href="#" title="Stage Académique">STAGE</a>

                                    <ul>

                                        <li>

                                            <a href="#" title="Fabrication et commercialisation des agendas">INFO-MAC</a>

                                            <ul>

                                                <li> <a href="#" title="Service infographie et production">Informaticien</a></li>

                                            </ul>

                                        </li>

                                    </ul>

                                </li>



                                <li>

                                    <a href="#" title="Employé plein temps">EMPLOI</a>

                                    <ul>

                                        <li>

                                            <a href="#" title="Centre de formation professionnelle agrée">INSTITUT<br>SALOMON</a>

                                            <ul>

                                                <li> <a href="#" title="Direction">Responsable<br>Formation<br>& Planification</a></li>

                                            </ul>

                                        </li>

                                        <li>

                                            <a href="#" title="Bâtiments et Travaux Publics">ATIDOLF<br>NIG LTD</a>

                                            <ul>

                                                <li>

                                                    <a href="#" title="Direction Administrative">Analyste<br>Programmeur</a>

                                                    <ul>

                                                        <li> <a href="#" title="methode agile">Analyse <br> S.I</a></li>

                                                        <li> <a href="#" title="Langage .NET">C#</a></li>

                                                        <li> <a href="#" title="SGBD">SQL <br> SERVER</a></li>

                                                    </ul>

                                                </li>

                                            </ul>

                                        </li>



                                        <li>

                                            <a href="#" title="Financial Technology">SMOPAYE<br>SARL</a>

                                            <ul>

                                                <li>

                                                    <a href="#" title="Service de développement">Développeur<br>Android</a>

                                                    <ul>

                                                        <li> <a href="#" title="Langage Java & XML">Java SE</a></li>

                                                        <li> <a href="#" title="Web service & Laravel">PHP</a></li>

                                                    </ul>

                                                </li>

                                            </ul>

                                        </li>



                                    </ul>

                                </li>



                                <li>

                                    <a href="#" title="Travaux hors Entreprise">FREELANCE</a>

                                    <ul>

                                        <li>

                                            <a href="#" title="HTML/CSS, PHP, MySQL, Js, JQUERY, ANDROID / XAMARIN">WEB</a>

                                        </li>

                                        <li>

                                            <a href="#" title="C#, Windform, WPF, UWP, ASP.NET">WINDOWS</a>

                                        </li>

                                    </ul>

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

                                <?= \App\Twitter\Twitter::autolink('#bertin_dev'); ?> <?=$actuellement['story'];?>.<br>

                            </p>

                            <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">

                                <p style="color: black;">LES GRANDES LIGNES QUI ONT FAIT DE MOI UN GEEK.</p>

                            </div>

                            <p style="color: black; text-align: justify; text-indent: 15px">

                                Bonjour et soyez les bienvenus dans mon espace personnel.

                                Dans cette rubrique il sera question de parler de mon parcours (d'où je viens et où je vais), et ceux de mon jeune âge, jusqu'a maintenant.

                                A l'école primaire je suis un passionné de l'électronique (démontage et paramétrage d'appareils).

                                c'est ainsi qu'après avoir eu mon <abbr title="C.E.P">Certificat d'étude primaire</abbr>, j'avais demandé à mes parents de m'orienter vers une école spécialisé en électronique. Mais

                                ces derniers refusèrent car ils estimaient qu'il me fallait d'abord avoir le strict minimum à l'enseignant général c'est-à-dire le

                                <abbr title="B.E.P.C">Brevet d'étude premier cycle</abbr>.

                                C'est ainsi que je continuais mes études en classe de 6ème tout en continuant mon bidouillage.

                                Lorsque j'étais arrivé en classe de 3ème au <abbr title="LBY">Lycée Bilingue de yaoundé</abbr>, mes parents m'avaient trouvés un repétiteur.

                                Ce dernier m'enseignait les mathématiques, physique mais aussi l'informatique et croyez-moi ce grand frère a orienté mon coté bidouilleur électronicien vers l'informatique

                                car lui même était étudiant en <abbr title="Mathématiques et Informatique">Math-Info</abbr> à l'université de ydé 1 à cette époque. C'est ainsi que lui et moi parlions tout le temps de l'informatique

                                il me faisait resoudre des algorithmes mathématiques tout en étant en 3ème je peux même dire que mes cours de repétitions parlaient de l'info à 60%.

                                <br>

                                <?php

                                if(!isset($_GET['contenu'])){echo '<div style="text-align: center;"><a href="Portfolio?id_page='.$_ENV['id_page'].'&resume=1&contenu=2" title="En savoir plus">LIRE LA SUITE</a></div>

                            ';}?>

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

                        <ul class="" style="font-family: Merriweather, serif;font-style: italic;font-size: 14px;">

                            <li>

                                <a href="Portfolio?id_page=<?=$_ENV['id_page'];?>" class="white-text" title="Parcours professionnel">

                                    Mon Organigramme

                                </a>

                            </li>

                            <li>

                                <a href="Portfolio?id_page=<?=$_ENV['id_page'];?>&amp;resume=1&contenu=2" class="white-text" title="d'où je viens où je vais">

                                    Je Parle de Moi

                                </a>

                            </li>

							 <!--<li>

                                <a href="Portfolio?id_page=6&amp;resume=1" class="white-text" title="Tous les aspects ayant conduit à ça création">

                                    Je Parle du site

                                </a>

                            </li>-->

                            <li>

                                <a href="Portfolio?id_page=<?=$_ENV['id_page'];?>&amp;photos=1" class="white-text" title="Pause sur les temps fort">

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





            <!-- Card -->

            <div class="card card-cascade narrower col-xs-12 col-md-12 col-lg-12 wow fadeInLeft mb-4" data-wow-duration="1000ms" data-wow-delay="600ms">

                <!-- <h4 style="font-variant: small-caps; color: black;" >→ SI et Processus Métier</h4>-->

                <!-- Card -->

                <h4 style="font-variant: small-caps; color: black; padding: 0" class="text-left">→ Formations En ligne</h4>

                <!-- Card image -->

                <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">

                    <small style="font-variant: small-caps; color: #000; float: left; padding: 0;" class="text-left">→ Livres que j'ai lus</small>

                       <br>

                    <ul style="color: #000;">

                        <li title="Documentation en programmation pour les nuls"><small>Site du Zeros</small></li>

                        <!--<li title="Documentation complète sur les requêtes SQL"><small>Sql.sh</small></li>-->

                        <li title="Rogers Cadenhead & Laura Lemay"><small>Le Programmeur</small></li>

                        <li title="Documentation sur un ensemble de solutions informatique"><small>Collection Eyrolles Pratique</small></li>

                    </ul>



                    <small style="font-variant: small-caps; color: #000; float: left; padding: 0;" class="text-left">→ Développeurs qui m'éclairent</small>

                    <br>

                    <ul style="color: #000;">

                        <li title="Développeur Web"><small>Grafikart (France)</small></li>

                        <li title="Développeur .NET"><small>Houssem Dellai (Maroc)</small></li>

                        <li title="Développeur Web"><small>Honoré Hounwanou (Senegal)</small></li>

                    </ul>



                    <small style="font-variant: small-caps; color: #000; float: left; padding: 0;" class="text-left">→ Forum que je Suis</small>

                    <br>

                    <ul style="color: #000;">

                        <li><small><a href="https://www.openclassrooms.com" title="Forum et doc pour débuter en programmation">https://www.openclassrooms.com</a></small></li>

                        <li><small><a href="https://www.developpez.com" title="Forum et doc sur l'informatique">https://www.developpez.com</a></small></li>

                        <li><small><a href="https://www.stackoverflow.com" title="Forum de partage de solutions aux problèmes">https://www.stackoverflow.com</a></small></li>

                        <li><small><a href="https://www.github.com" title="Forum et dépot de codes sources">https://www.github.com</a></small></li>

						<li><small><a href="https://developer.android.com/docs" title="Forum et doc sur Android">https://developer.android.com/docs</a></small></li>

						<li><small><a href="https://docs.microsoft.com/" title="Forum et doc sur Microsoft">https://docs.microsoft.com/en-us/xamarin</a></small></li>

						<li><small><a href="https://www.w3schools.com/" title="Forum et doc sur le Web">https://www.w3schools.com</a></small></li>

                        <li><small><a href="https://www.alsacreation.com/" title="Forum et doc sur le Web">https://www.alsacreation.com</a></small></li>

                    </ul>



                    <small style="font-variant: small-caps; color: #000; float: left; padding: 0;" class="text-left">→ Actualité High Tech que je suis</small>

                    <br>

                    <ul style="color: #000;">

                        <li><small><a href="https://www.cnetfrance.fr" title="Actualité Web et du numérique">https://www.cnetfrance.fr</a></small></li>

                        <li><small><a href="https://www.01net.com" title="Actualité Tecnologie du web">https://www.01net.com</a></small></li>

                        <li><small><a href="https://www.clubic.com" title="Industrie du logiciel et des technologies">https://www.clubic.com</a></small></li>

                        <!--<li><small><a href="https://www.futura-sciences.com" title="magazine des technologies de demain">https://www.futura-sciences.com</a></small></li>-->

                    </ul>



                    <!--<small style="font-variant: small-caps; color: #000; float: left; padding: 0;" class="text-left">→ Télécharger mes codes Sources</small>

                    <br>

                    <ul style="color: #000;">

                        <li><small><a href="https://github.com/bertin-dev">Projets Web/Mobile</a></small></li>

                        <li><small><a href="https://bertin-dev.visualstudio.com">Projets Windows</a></small></li>

                    </ul>-->

                </div>

            </div>

        </div>

    </div>

</div>

</section>

