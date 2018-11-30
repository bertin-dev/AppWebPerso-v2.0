<?php require_once('page_number.php'); ?>

<!-- Photos de Profil -->
<section id="" class="">
    <div class="container">
        <div class="row">
            <div class="title-big col-lg-12">

                <div class="col-lg-6">
                   <!--- <img src="img/bertin.dev.jpg" title="Programmation" class="img-responsive well" width="379" />-->
                    <div class="cta large event-type center-element-container no-transition" style="background-color:#1b1b1b;">
                        <div class="enTeteBienvenue backgroundColor2 openSans-extrabold couleurBlanc font-size-30">Bienvenue</div>
                        <a href="#" title="Analyste Programmeur" class="transition">
                            <img data-src="" alt="bertin.dev" title="Programmation" class="bg img-responsive well" src="img/bertin.dev.jpg">
                            <!--<div class="mask"> </div>-->
                           <h3 class="text-left" style="font-size: 25px;">Bertin Mounok<br>Contact: →(+237) 694 048 925<br> </h3>

                            <div class="bottom">
                                Profil
                                <div class="date">
                                    bertin.dev
                                </div>
                            </div>

                            <div class="contentHover">
                                <i class="fa fa-arrow-circle-right"> </i>Email: →Bertmoun@yahoo.fr<br>BP: →1492<br>Ville: →Yaoundé.</div>


                            <span class="border border-1"> </span>
                            <span class="border border-2"> </span>
                            <span class="border border-3"> </span>
                            <span class="border border-4"> </span>
                        </a>
                    </div>


                </div>
                
                <div class="col-lg-6" style="text-align: center;">
                    <h1>Recherchez-vous un Informaticien Programmeur ???</h1>
                    Ça tombe bien! j'en suis un. Je suis un Geek de l'informatique depuis l'âge de 17 ans. Si mon profil vous intéresse n'hésitez pas à me
                    <a href="index.php?id_page=5" title="contactez-moi">Contacter</a> ou regardez <a href="index.php?id_page=2" title="Mes Réalisations">Mes Réalisations →</a> <br>
                    <!--<span href="#" data-original-title='Informaticien'>Me Suivre</span>-->
                </div>
                <!--<a class="btn btn-default page-scroll" href="#about" title="ppppppppppppppp">Click Me to Scroll Down!</a>-->
            </div>
        </div>
    </div>
</section>



<!-- A Propos de Moi -->
<section id="">
    <div class="container">
        <div class="row">
            <div class="title-big col-lg-12">

                <div class="col-lg-6" style="text-align: center;">
                    <h4>A propos <small><em>A propos de moi</em></small></h4>
                    Je m'appelle Jonathan Boyer, j'ai commencé le développement web et le web design pour développer
                    un petit site perso et c'est rapidement devenu une vraie vocation. J'aime expérimenter,
                    découvrir et apprendre au fur et à mesure de mes projets pros et perso.
                    En plus de mon activité de Freelance j'enregistre des Formations Vidéos.
                </div>


                <div class="right-sidebar col-lg-6" style="text-align: center;">
                    <h4>Mon tarif</h4>
                    Je suis actuellement Freelance sous le statut d'EURL.
                    Mon tarif journalier est de 350€ HT/jours.
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Mes dernières Réalisations -->
<section id="">
    <div class="container">
        <div class="row">
            <div class="title-big col-lg-12">
                <h4>Mes dernières réalisations <small><em>Mes derniers projets</em></small></h4>


                <?php
                   foreach(\App::getDB()->query('
                            SELECT * FROM contenu
                            INNER JOIN page
                            ON contenu.code_page=page.id_page
                            ORDER BY id_contenu DESC LIMIT 0, 4') as $projet):

                       $info = '<div class="col-lg-3">';

                       $info .= '<div class="cta externe event-type center-element-container no-transition" style="background-color:#1b1b1b;">';
                       $info .= '<a href="index.php?id_page='.$projet->id_page.'#entreprise'.$projet->id_contenu.'" data-toggle="" data-target="" title='.$projet->app_dev.' class="transition page-scroll">';
                       $info .= '<img data-src="" alt="Projet de Développement" class="bg img_responsive" width="280" height="280"
                        title='.$projet->app_dev.' src="'.$projet->screenshot_App.'">';
                       $info .= '<div class="mask"></div> <h4><u>'.$projet->app_dev.'</u></h4><h3 class="text-center" style="font-size: small">'. substr(strtoupper(nl2br(stripslashes($projet->fonctionnalites))), 0, 50).'<br><u>LIRE LA SUITE</u></h3>';
                       $info .= '<div class="bottom">Publié:<div class="date">'.$projet->annee.'</div></div>';
                       $info .= '<div class="contentHover" style="font-size:small;"><i class="fa fa-laptop fa-2x"></i>Langage: '.$projet->langage.'<br>IDE: '.$projet->ide.'<br>SGBD: '.$projet->sgbd.'<br>Framework: '.$projet->framework.'<br>URL: '.$projet->url.'</div>';
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













            </div>
        </div>
    </div>
</section>


