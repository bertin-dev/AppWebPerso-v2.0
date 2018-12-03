<?php require_once('page_number.php'); ?>

<!-- Photos de Profil -->
<section id="" class="">
    <div class="container">
        <div class="row">
            <article class="title-big col-lg-12">
                <div class="col-lg-6">
                    <div class="enTeteBienvenue backgroundColor2 openSans-extrabold couleurBlanc font-size-30">
                        Bienvenue
                    </div>
                    <!--- <img src="img/bertin.dev.jpg" title="Programmation" class="img-responsive well" width="379" />-->
                    <div class="cta large event-type center-element-container no-transition"
                         style="background-color:#1b1b1b;">

                        <a href="#" title="Analyste Programmeur" class="transition">
                            <img data-src="" alt="bertin.dev" title="Programmation" class="bg img-responsive well"
                                 src="img/bertin.dev.jpg">
                            <!--<div class="mask"> </div>-->
                            <h3 class="text-left" style="font-size: 25px;">Bertin Mounok<br>Contact: →(+237) 694 048 925<br>
                            </h3>

                            <div class="bottom">
                                Profil
                                <div class="date">
                                    bertin.dev
                                </div>
                            </div>

                            <div class="contentHover">
                                <i class="fa fa-arrow-circle-right"> </i>Email: →Bertmoun@yahoo.fr<br>BP: →1492<br>Ville:
                                →Yaoundé.
                            </div>


                            <span class="border border-1"> </span>
                            <span class="border border-2"> </span>
                            <span class="border border-3"> </span>
                            <span class="border border-4"> </span>
                        </a>
                    </div>


                </div>

                <div class="col-lg-6" style="text-align: center;">
                    <h1>Recherchez-vous un Informaticien Programmeur ???</h1>
                    Ça tombe bien! j'en suis un. Je suis un Geek de l'informatique depuis l'âge de 17 ans. Si mon profil
                    vous intéresse n'hésitez pas à me
                    <a href="index.php?id_page=5" title="contactez-moi">Contacter</a> ou regardez <a
                            href="index.php?id_page=2" title="Mes Réalisations">Mes Réalisations →</a> <br>
                    <!--<span href="#" data-original-title='Informaticien'>Me Suivre</span>-->
                    <details>
                        <summary><h1 title="Solutions Informatique">INNOVATION PAR L'EXPERIENCE</h1></summary>
                        <summary><h2>Conseils</h2></summary>
                        <summary><h3>Développent</h3></summary>
                        <summary><h4>Intégration des Solutions</h4></summary>
                    </details>
                </div>
                <!--<a class="btn btn-default page-scroll" href="#about" title="ppppppppppppppp">Click Me to Scroll Down!</a>-->
            </article>


            <article class="col-lg-12" style="text-align: center;">

                <div class="col-lg-3">
                    <h1>PASSION</h1>
                    <p>Plus qu'un métier, le développement est pour moi une passion qui me pousse à me dépasser.</p>
                </div>

                <div class="col-lg-3">
                    <h1>QUALITE</h1>
                    <p>Je respecte les derniers standards et les bonnes pratiques afin de produire un code de qualité</p>
                </div>

                <div class="col-lg-3">
                    <h1>VEILLE</h1>
                    <p>Je me tiens au courant des dernières nouveautés techniques grâce à une veille quotidienne.</p>
                </div>

                <div class="col-lg-3">
                    <h1>POLYVALENCE</h1>
                    <p>Familier avec plusieurs méthodes de travail et différentes technologies, je sais m'adapter aux projets.</p>
                </div>

            </article>

            <article class="title-big col-lg-12">

                <div class="col-lg-6" style="text-align: center;">
                    <h4>A propos
                        <small><em>A propos de moi</em></small>
                    </h4>
                    Je m'appelle Jonathan Boyer, j'ai commencé le développement web et le web design pour développer
                    un petit site perso et c'est rapidement devenu une vraie vocation. J'aime expérimenter,
                    découvrir et apprendre au fur et à mesure de mes projets pros et perso.
                    En plus de mon activité de Freelance j'enregistre des Formations Vidéos.
                </div>


                <div class="right-sidebar col-lg-6" style="text-align: center;">
                    <h4>Devis Dynamique en 5 Min</h4>
                   <p>Votre offre sans engagement dans votre boîte mail sous 5 Min chrono!</p>
                    <button class="btn btn-info">Demamder un Dévis</button>
                </div>
            </article>
            <article class="title-big col-lg-12">
                <h4>Mes dernières réalisations
                    <small><em>Mes derniers projets</em></small>
                </h4>


                <?php
                foreach (\App::getDB()->query('
                            SELECT * FROM contenu
                            INNER JOIN page
                            ON contenu.code_page=page.id_page
                            ORDER BY id_contenu DESC LIMIT 0, 4') as $projet):

                    $info = '<div class="col-lg-3">';

                    $info .= '<div class="cta externe event-type center-element-container no-transition" style="background-color:#1b1b1b;">';
                    $info .= '<a href="index.php?id_page=' . $projet->id_page . '#entreprise' . $projet->id_contenu . '" data-toggle="" data-target="" title=' . $projet->app_dev . ' class="transition page-scroll">';
                    $info .= '<img data-src="" alt="Projet de Développement" class="bg img_responsive" width="280" height="280"
                        title=' . $projet->app_dev . ' src="' . $projet->screenshot_App . '">';
                    $info .= '<div class="mask"></div> <h4><u>' . $projet->app_dev . '</u></h4><h3 class="text-center" style="font-size: small">' . substr(strtoupper(nl2br(stripslashes($projet->fonctionnalites))), 0, 50) . '<br><u>LIRE LA SUITE</u></h3>';
                    $info .= '<div class="bottom">Publié:<div class="date">' . $projet->annee . '</div></div>';
                    $info .= '<div class="contentHover" style="font-size:small;"><i class="fa fa-laptop fa-2x"></i>Langage: ' . $projet->langage . '<br>IDE: ' . $projet->ide . '<br>SGBD: ' . $projet->sgbd . '<br>Framework: ' . $projet->framework . '<br>URL: ' . $projet->url . '</div>';
                    $info .= '<span class="border border-1"></span>
                        <span class="border border-2"></span>
                        <span class="border border-3"></span>
                        <span class="border border-4"></span>';
                    $info .= '</a>';
                    $info .= '</div>';
                    $info .= '</div>';


                    echo $info;
                endforeach;
                ?>
            </article>
        </div>
    </div>
</section>



