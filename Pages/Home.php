<?php require_once('page_number.php'); ?>

<!-- Photos de Profil -->
<section id="" class="">
    <div class="container">
        <div class="row">
            <article class="title-big col-lg-12">
                <div class="col-lg-6"><!-- data-wow-duration="1000ms" data-wow-delay="600ms"-->
                    <div class="enTeteBienvenue backgroundColor2 openSans-extrabold couleurBlanc font-size-30" >
                        Bienvenue
                    </div>
                    <!--- <img src="img/bertin.dev.jpg" title="Programmation" class="img-responsive well" width="379" />-->
                    <div class="cta large event-type center-element-container no-transition"
                         style="background-color:#1b1b1b;">

                        <a href="#" title="Consultant en Développement .NET / WEB" class="transition">
                            <?php
                            foreach (App::getDB()->query('SELECT title,chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Extreme Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $slide):

                             echo '<img data-src="" alt="bertin.dev" title="'.$slide->title.'" class="bg img-responsive well"
                                 src="'.$slide->chemin.'">';
                            endforeach;
                            ?>
                            <!--<div class="mask"> </div>-->
                            <h3 class="text-left ecriture" style="font-size: 25px;color:#1b4159;">Sur ma Plate-forme Web. <br>Je suis Developpeur
                                <i class="fa fa-windows"></i> /
                                <i class="fa fa-globe"></i>
                            </h3>

                            <div class="bottom ecriture">
                                Plate-forme
                                <span class="text-center" style="margin: initial; padding: initial; position: absolute; left: 50%; top: 80%">
                                    <i class="fa fa-linkedin"></i>
                                    <i class="fa fa-instagram"></i>
                                    <i class="fa fa-twitter"></i>

                                </span>
                                <div class="date" style="font-size: 20px;">
                                    <i class="fa fa-globe"></i>
                                    <i class="fa fa-laptop"></i>
                                    <i class="fa fa-mobile-phone" style="margin-right: 5px;"></i>
                                </div>
                            </div>

                            <div class="contentHover ecriture">
                                <i class="fa fa-user-md"> </i>
                                <i class="fa fa-envelope" style="font-size: 30px;">→bertin.dev@outlook.fr</i> <br>
                                <i class="fa fa-phone-square" style="font-size: 30px;">→+237 694 04 89 25</i>
                            </div>


                            <span class="border border-1"> </span>
                            <span class="border border-2"> </span>
                            <span class="border border-3"> </span>
                            <span class="border border-4"> </span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" style="text-align: center;">
                    <h1>Recherchez-vous un Consultant Développeur ???</h1>
                    Ça tombe bien! j'en suis un. Je suis un Geek de l'informatique depuis l'âge de 17 ans. Si mon profil
                    vous intéresse n'hésitez pas à me
                    <a href="Portfolio?id_page=5" title="contactez-moi">Contacter <span class="glyphicon glyphicon-send"></span></a> ou regardez <a
                            href="Portfolio?id_page=2" title="Mes Réalisations">Mes Réalisations <span class="glyphicon glyphicon-hand-left"></span></a> <br>
                    <!--<span href="#" data-original-title='Informaticien'>Me Suivre</span>-->
                    <details>
                        <summary><h1 title="Solutions Informatique">CREATEUR DE VALEURS POUR LES ENTREPRISES. </h1></summary>
                        <summary><h4>Audit & Conseils</h4></summary>
                        <summary><h4>Transfert de Compétences</h4></summary>
                        <summary><h4>Analyse, Conception, Implémentation et Déploiment</h4></summary>
                    </details>
                </div>
                <!--<a class="btn btn-default page-scroll" href="#about" title="ppppppppppppppp">Click Me to Scroll Down!</a>-->
            </article>

            <article class="col-xs-12 col-md-4 col-lg-12" style="text-align: center;">
                <h4 style="text-align: left; font-variant: small-caps;"><em><span class="glyphicon glyphicon-asterisk"></span> MES CONVICTIONS
                        <small>Facteur de Motivation</small></em>
                </h4>
                <div class="ombrage col-lg-3">
                    <h1>PASSION</h1>
                    <p>Plus qu'un métier, le développement est pour moi une passion qui me pousse à me dépasser.</p>
                </div>

                <div class="ombrage col-lg-3">
                    <h1>QUALITE</h1>
                    <p>Je respecte les derniers standards et les bonnes pratiques afin de produire un code de qualité.</p>
                </div>

                <div class="ombrage col-lg-3">
                    <h1>VEILLE</h1>
                    <p>Je me tiens au courant des dernières nouveautés techniques grâce à une veille quotidienne.</p>
                </div>

                <div class="ombrage col-lg-3">
                    <h1>POLYVALENCE</h1>
                    <p>Familier avec plusieurs méthodes de travail et différentes technologies, je sais m'adapter aux projets.</p>
                </div>

            </article>

            <article class="title-big col-xs-12 col-md-4 col-lg-12">
                <h4 class="col-lg-6" style="font-variant: small-caps;"><i class="fa fa-ticket"></i><em> TRANSFORMATION DIGITALE
                        <small>Optez Pour des Solutions sur Mesures</small></em>
                </h4>

                <h4 class="col-lg-6 text-right visible-md visible-lg" style="font-variant: small-caps;"><span class="glyphicon glyphicon-resize-small"></span><em> DEVIS
                        <small>au format PDF dans votre boîte mail.</small></em>
                </h4>

                <div class="col-lg-4">
                    <img src="../Public/img/icons/demain-entrepreneur.png" title="Entrepreneur de demain" class="img-responsive" alt="Entrepreneur de demain">
                    <h5>Vous avez la possibilité de suivre l'évolution de votre projet à distance<small><em> Cliquez sur le bouton juste en dessous</em></small></h5>
                <div class="text-center">
                    <a id="projet_distant" role="button" href="#" class="btn btn-primary" title="Suivez votre Projets à distance"><span class="glyphicon glyphicon-folder-open"></span> Suivez Votre Projet</a>
                </div>
                </div>

                <div class="right-sidebar col-lg-4 text-center">
                    <h4 style="font-variant: small-caps; font-size: 22px;">Des Solutions pour tous vos enjeux de Transformation</h4>
                    <h5>Transformation digitale<small><em> Votre Entreprise est-elle prête ?</em></small></h5>
                   <h5>Performance de Vente <small><em> Muscler votre force de vente.</em></small></h5>
                    <h5>Une Technologie de Pointe <small><em>Adapté pour votre entreprise.</em></small></h5>
                </div>


                <div class="right-sidebar col-lg-4">
                    <h4 style="font-variant: small-caps; font-size: 22px;">Générez Dynamiquement votre Devis</h4>
                    <div class="col-xs-3 col-lg-3" style="padding:0">
                        <img src="../Public/img/Accueil/devis.png" class="img-responsive img-thumbnail" alt="dévis" title="Exemplaire de dévis">
                    </div>
                    <div class="col-xs-9 col-lg-9" style="padding:5px">
                        <h5>Votre offre sans engagement<small><em> dans votre boîte mail en 1 Min chrono!</em></small></h5>
                        <?php
                        if( isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER']) )
                        {
                        echo '<a id="devis_service" href="#" class="btn btn-primary" title="Connexion"><span class="glyphicon glyphicon-modal-window"></span> Demander un Dévis</a>';
                        }else{
                            echo '<a href="#" onclick="return false;" class="btn btn-primary" title="Connexion" data-toggle="modal" data-target="#login_1" ><span class="glyphicon glyphicon-modal-window"></span> Demander un Dévis</a>';
                        }
                        ?>
                    </div>
                </div>

            </article>

            <article class="col-xs-12 col-md-4 col-lg-12 title-big">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-home"></span><em> ENTREPRISE
                        <small>L'innovation Technologique</small></em>
                </h4>
                <div class="col-lg-12">
                    <?php
                    $i=0;
                    foreach (App::getDB()->query('SELECT title, description, chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 3') AS $entreprise):
                        $enterprise = explode('-', $entreprise->description);
                        echo '<div class="col-lg-4">
                        <div class="card card-image mb-3" style="background-image: url('.$entreprise->chemin.');">
                            <!-- Content -->
                            <div id="card'.$i.'" class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
                                <div>
                                    <h5 class="pink-text">';
                                    switch ($i){
                                        case 1:
                                            echo '<i class="fa fa-laptop"></i>';
                                            break;
                                        case 2:
                                            echo '<i class="fa fa-mobile"></i>';
                                            break;
                                        default:
                                            echo '<i class="fa fa-desktop"></i>';
                                    }
                                        echo ' '.$enterprise[0].'</h5>
                                    <h3 class="card-title pt-2">
                                        <strong>'.strtoupper($entreprise->title).'</strong>
                                    </h3>
                                    <p>'.$enterprise[1].'</p>
                                    <a class="btn-pink waves-effect waves-light btn-customizable"
                                    title="'.$enterprise[2].'">
                                        <i class="fa fa-play left"></i> Voir Les Projets</a>
                                </div>
                            </div>
                            <!-- Content -->
                        </div>
                    </div>';
                                    $i++;
                         endforeach;
                    ?>
                </div>
            </article>


            <article class="col-xs-12 col-md-4 col-lg-12 title-big">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-certificate"></span><em> MES CERTIFICATIONS
                        <small> → Derniers cours suivi</small></em>
                </h4>
                <!--<div id="last_realisation">
                    <div id="loader_realisation" style="display: none;text-align: center!important;">
                        <span class="loader loader-circle"></span>
                        Chargement......
                    </div>
                </div>-->

                <div class="sliderCertification">
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/918836/918836_teaser_picture_1680854700.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Concevez votre site web avec PHP et MySQL </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/5134573127" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/1603881/1603881_teaser_picture_1680854710.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Créez votre site web avec HTML5 et CSS3 </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/4024995037" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/1665806/1665806_teaser_picture_1680854720.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Programmez en orienté objet en PHP </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/6463447382" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/2035766/2035766_teaser_picture_1680854470.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Optimisez votre déploiement en créant des conteneurs avec Docker </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/1075090089" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/3504441/3504441_teaser_picture_1680854812.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Introduction à jQuery </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/2370983318" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/0/4482986.png?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Quel parcours est fait pour vous ? </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/4602511733" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/5011666/5011666_teaser_picture_1680856272.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Quel métier du web est fait pour vous ?</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/9853485767" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/5559091/5559091_teaser_picture_1680854681.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Déboguez vos applications C# </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/7765376585" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/5641796/5641796_teaser_picture_1680858178.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Adoptez Visual Studio comme environnement de développement </p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/9069949915" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/6173491/6173491_teaser_picture_1680857143.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Apprenez à utiliser la ligne de commande dans un terminal</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/3238267186" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/6204541/6204541_teaser_picture_1680858147.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Initiez-vous à Python pour l'analyse de données</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/1917986200" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/6971126/6971126_teaser_picture_1680858589.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Implémentez vos bases de données relationnelles avec SQL</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/6113682008" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7162856/7162856_teaser_picture_1680858619.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Gérez du code avec Git et GitHub</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/2949519568" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7168871/7168871_teaser_picture_1687249906.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Apprenez les bases du langage Python</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/7163418582" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7192596/7192596_teaser_picture_1680859337.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Mettez en ligne votre site web</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/7733720433" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7688581/7688581_teaser_picture_1680859417.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Devenez un expert de Git et GitHub</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/8761567374" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7818671/7818671_teaser_picture_1680859310.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Requêtez une base de données avec SQL</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/6276227897" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7959326/7959326_teaser_picture_1680859849.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Écrivez du code C# maintenable avec MVC et SOLID</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/1006621594" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/7973891/7973891_teaser_picture_1680859812.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Apprenez à programmer en C#</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/1997120941" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/8028391/8028391_teaser_picture_1680860095.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Développez une application ASP.NET Core avec le modèle MVC</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/6154306348" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/8028921/8028921_teaser_picture_1680860057.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Sécurisez votre application .NET</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/6812025222" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://oc-course.imgix.net/courses/8039181/8039181_teaser_picture_1681717998.jpg?auto=compress,format&q=80" alt="">
                        <span class="courseHit__author">
                            <span class="courseHit__authorOriginal">Original</span>
                            <span class="courseHit__authorOC">OpenClassrooms</span>
                       </span>
                        <p> Implémentez votre base de données relationnelle avec ASP.NET Core</p>
                        <div class="showCertification">
                            <span><a href="https://openclassrooms.com/fr/course-certificates/share/7238558083" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>
                    <div class="itemCertification">
                        <img class="img-responsive" src="https://assets-global.website-files.com/60870cca519aca7849a9262d/60f942de994bfc4a31c57acf_545b62da-7847-4ab7-87bc-a48b61fe9d4b_Testdome.png" alt="">
                        <p> Android Developer</p>
                        <div class="showCertification">
                            <span><a href="https://app.testdome.com/cert/cbf3b1492dd64f5baae2d6c8913fd788" target="_blank">Voir le certificat</a></span>
                        </div>
                    </div>

                    <button id="nextCertification">></button>
                    <button id="prevCertification"><</button>
                </div>

            </article>



            <article class="col-xs-12 col-md-4 col-lg-12 title-big">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-transfer"></span><em> QUALIFICATIONS
                        <small>Mon Périmètre de Compétence s'Articule Autour de quelques services</small></em>
                </h4>
                <div class="col-lg-8">
                    <div class = "panel panel-primary" style="background-color: inherit;">
                        <div class = "panel-heading">
                            <h3 class = "panel-title">SERVICES DISPONIBLE</h3>
                        </div>

                        <div id="last_qualification" class="panel-body" style="max-height: 250px;display: block;overflow-y: auto;">
                                <div id="loader_qualification" style="display: none;text-align: center!important;">
                                    <span class="loader loader-circle"></span>
                                    Chargement......
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class = "panel panel-primary" style="background-color: inherit;">
                        <div class = "panel-heading">
                            <h3 class = "panel-title">SOLUTIONS ET MODULES DEPLOYES</h3>
                        </div>
                        <div class="panel-body" style="max-height: 250px;display: block;overflow-y: auto;">
                            <div class="panel-group last_fonctionnality" id="accordion">
                                    <div id="loader_fonctionnality" style="display: none;text-align: center!important;">
                                        <span class="loader loader-circle"></span>
                                        Chargement......
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="col-xs-12 col-md-4 col-lg-12 title-big">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-floppy-saved"></span><em> MES DERNIERES REALISATIONS
                        <small> → Derniers Projets</small></em>
                </h4>
                <div id="last_realisation">
                        <div id="loader_realisation" style="display: none;text-align: center!important;">
                            <span class="loader loader-circle"></span>
                            Chargement......
                        </div>
                </div>
                    <div class="text-center" style="margin-bottom: initial; padding-bottom: initial;">
                        <a id="more_load_project" data-placement="bottom" data-toggle="tooltip" data="project_real=1" class="btn-primary waves-effect waves-light btn-customizable more_load_project" style="margin-bottom: initial;">
                        <i class="fa fa-play left"></i> Voir Plus De Réalisations
                        </a>
                    </div>

            </article>

            <article class="col-xs-12 col-md-4 col-lg-12">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-play"></span><em> DIAPORAMA
                        <small> → Travaux Effectués</small></em>
                </h4>
                <div class="text-center" style="margin-bottom: initial; padding-bottom: initial;">
                 <?php require ('Home_Slide.php');?>
                </div>

            </article>
        </div>
    </div>
</section>

<section class="title-big" style="padding-top: initial">
<?php
foreach (App::getDB()->query('SELECT title, chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Milieu" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 1') AS $parallax):
      $title = explode('-', $parallax->title);
    echo '<div class="parallax" style="background: url('.$parallax->chemin.') no-repeat center;background-size: cover;background-attachment: fixed;height: 200px;text-align: center">
          <h1 style="position: relative; top: 80px; font-variant: small-caps;">'.strtoupper($title[0]). '<br>'.strtoupper($title['1']).'</h1>
          </div>';
endforeach;
?>

</section>


<section>
    <div class="container">
        <div class="row">
            <article class="col-xs-12 col-md-8 col-lg-9">
                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-book"></span><em> CITATIONS
                        <small>Sur la Vie</small></em>
                </h4>
                <div class="col-xs-12 col-lg-12 ombrage2" style="margin-bottom: 20px;">
<!-------->
                                <div class="carousel slide" data-ride="carousel" id="quote-carousel" data-interval="10000">
                                    <!-- Carousel Slides / Quotes -->
                                    <div class="carousel-inner text-center">
                                        <!-- Quote 1 -->
                                        <?php
                                        foreach (App::getDB()->query('SELECT title, description FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Bas" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 4') AS $citations):
                                            echo '<div class="item">
                                            <blockquote>
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2"><p>'.$citations->description.'</p>
                                                            <small>'.strtoupper($citations->title).'</small>
                                                    </div>
                                                </div>
                                            </blockquote>
                                                  </div>';
                                        endforeach;
                                        ?>
                                    </div>
                                    <!-- Bottom Carousel Indicators -->
                                    <ol class="carousel-indicators" style="margin-bottom: 0;">
                                        <?php
                                         $i = 0;
                                        foreach (App::getDB()->query('SELECT chemin, title FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Bas" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 4') AS $citations):
                                                         echo ' <li data-target="#quote-carousel" data-slide-to="'.$i.'" class="active"><img class="img-responsive " src="'.$citations->chemin.'" alt="'.$citations->title.'"></li>';
                                        endforeach;
                                        ?>
                                    </ol>

                                    <!-- Carousel Buttons Next/Prev -->
                                    <a data-slide="prev" href="#quote-carousel" class="left carousel-control visible-lg"><i class="fa fa-chevron-left"></i></a>
                                    <a data-slide="next" href="#quote-carousel" class="right carousel-control visible-lg"><i class="fa fa-chevron-right"></i></a>
                                </div>
                        <a class="btn btn-primary" href="Portfolio?id_page=6" title="Cliquez"><i class="fa fa-arrow-right"></i> Me Suivre</a>
<!-------->
                </div>

                <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-dashboard"></span><em> OPTIMISATION
                        <small>Reporting pour décideurs & tableaux de bord pour manager</small></em>
                </h4>
                <div class="col-xs-12 col-lg-12 view peach-gradient" style="margin-bottom: 20px;">
                <div class="col-xs-12 col-lg-5">
                        <ul style="text-align: center; padding: initial; margin: initial">
                        <li>Grâce à l’intégration des solutions innovantes et extensibles (pour la plupart OpenSource),
                            nous réduisons considérablement le temps de mis en service des SI en les rendant financièrement
                            accessible aux entreprises de toute taille.
                        </li>
                        </ul>
                </div>

                 <div class = "col-xs-6 col-lg-3" style="text-align: center; padding: initial; margin: initial">
                     <img src="img/Accueil/reporting.jpg" class="img-responsive"  alt="">
                 </div>

                <div class="col-xs-6 col-lg-4" style="text-align: center; padding: initial; margin: initial">
                    <img src="img/Accueil/media-774068_960_720.png" class="img-responsive" width="196" alt="">
                </div>
                </div>

                <div class="col-xs-12 col-lg-12" style="margin-bottom: 20px;">
                    <h4 style="font-variant: small-caps;"><span class="glyphicon glyphicon-cloud-download"></span><em> FACILITER L'INNOVATION
                            <small>Processus Métier et Système d’Information</small></em>
                    </h4>
                    <?php
                    foreach (App::getDB()->query('SELECT chemin, title, description FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Extreme Bas" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 3') AS $facteur):

                        echo '<div class="col-md-4 col-lg-4 mb-4">
                        <!-- Card -->
                        <div class="card card-cascade narrower">
                            <!-- Card image -->
                            <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;text-align: center">
                                <img src="'.$facteur->chemin.'" title="'.$facteur->title.'" class="img-responsive" alt="'.$facteur->title.'">
                            </div>

                            <!-- Card content -->
                            <div class="card-body card-body-cascade text-center">
                                <!-- Text -->
                                <p class="card-text" style="font-size: 15px">'.$facteur->description.'</p>
                            </div>

                        </div>
                    </div>';

                    endforeach;
                    ?>
                </div>




            </article>

<!----TRAITEMENT DE LA BARRE LATERALE-->
            <aside class="col-xs-12 col-md-4 col-lg-3 mb-4">
                <h5 class="titreWidget" style="font-variant: small-caps"><span class="glyphicon glyphicon-calendar"></span><em> Agenda Annuel</em></small> </h5>
                    <!-- Card -->
                    <div style="margin-top: 60px" class="card card-cascade narrower">
                        <!-- Card image -->
                        <div style="margin-top: -45px" class="view view-cascade gradient-card-header peach-gradient">
                            <!-- Title
                            <h2 class="card-header-title">Ally Cook</h2>-->
                            <!-- Subtitle -->
                            <h5 class="mb-0 pb-3 pt-2" style="margin-top: initial;">
                                <?php
                                $evenement = '';
                                $now_time = time();
                                foreach (App::getDB()->query(' SELECT debut, fin, agenda.libelle AS titre_programme FROM agenda ORDER BY debut ASC LIMIT 1 ') as $projet):

                                    if(isset($projet->debut) && $projet->debut!=''){
                                        $result_diff = Diff_entre_2Jours($now_time, $projet->debut);
                                        if($result_diff==0){
                                            App::getDB()->delete('DELETE FROM agenda WHERE debut =:date_D', ['date_D' => $projet->debut]);
                                            $evenement .= $projet->titre_programme;
                                        }else{
                                            $evenement .= strtoupper($projet->titre_programme);
                                        }
                                    }
                                endforeach;
                                    if($evenement == '') $evenement .= 'Aucun Evénement</h5>';
                                        else{
                                            $evenement .= '</h5>';
                                            $evenement .= '<p style="padding: initial; margin: initial;">Du '.date('d', $projet->debut).' au '.date('d M Y', $projet->fin).'</p>';
                                        }
                                echo $evenement;
                                ?>
                        </div>
                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center" style="margin-top: 25px;">
                            <marquee id="last_agenda" class="text-center" behavior="" direction="UP" scrollamount="1" height="50">
                                    <div id="loader_agenda" style="display: none; text-align: center!important;">
                                        <span class="loader loader-circle"></span>
                                        Chargement......
                                    </div>
                            </marquee>
                        </div>
                    </div
                    <!-- Card -->


                <h5 class="titreWidget" style="font-variant: small-caps;margin-top: 22px;"><span class="glyphicon glyphicon-pushpin"></span><em> Article Publié <small>
                            <!--il y a-->
                            <?php
                            $now = time();
                            foreach (\App::getDB()->query('
                            SELECT id_sujet, sujets.date_enreg AS D_enreg_Article FROM sujets
                            INNER JOIN categorie
                            ON sujets.ref_id_categorie=categorie.id_categorie
                            ORDER BY id_sujet DESC LIMIT 1') as $projet):
                                echo str_replace('O', '', App\Twitter\Twitter::timeTag($projet->D_enreg_Article));
                           /* echo Diff_entre_2Jours($now, strtotime($projet->D_enreg_Article));
                               echo Diff_entre_2Jours($now, strtotime($projet->D_enreg_Article))==1 ? ' Jour' : ' Jours';*/
                            endforeach;


                            function Diff_entre_2Jours($dateNow, $dateEnreg){
                                $diff = abs($dateNow - $dateEnreg);
                                $result = array();
                                $tmp = $diff;

                                $result['second'] = $tmp % 60; // renvoi le reste de la div

                                $tmp = floor(($tmp - $result['second']) / 60);
                                $result['minute'] = $tmp % 60;

                                $tmp = floor(($tmp - $result['minute']) / 60);
                                $result['heure'] = $tmp % 24;

                                $tmp = floor(($tmp - $result['heure']) / 24);
                                $result['jour'] = $tmp;

                                return $result['jour'];
                            }
                            ?>
                            </em></small> </h5>
                <div class="card card-cascade wider">
                    <!-- Card image -->
                    <div id="last_article" class="view view-cascade gradient-card-header peach-gradient">
                            <div id="loader_article" style="display: none; text-align: center!important;">
                                <span class="loader loader-circle"></span>
                                Chargement......
                            </div>
                    </div>
                </div>

                <h5 class="titreWidget" style="font-variant: small-caps"><span class="glyphicon glyphicon-comment"></span><em> Derniers Commentaires</em></small> </h5>
                <div class="widget">
                                <div class="panel panel-default widget">
                                    <div class="panel-heading" style="background-color: #337ab7; color: white;">
                                        <h3 class="panel-title">
                                            Récent</h3>
                                        <span class="label label-info">
                                            <?php
                                           echo $decompte = App::getDB()->rowCount('SELECT id_sujet, titre, commentaires, image, prenom, data_ajout_commentaires  FROM sujets
                                                                INNER JOIN comments
                                                                ON sujets.id_sujet=comments.ref_id_sujet
                                                                INNER JOIN compte
                                                                ON compte.id_compte=comments.ref_id_compte
                                                                ORDER BY data_ajout_commentaires DESC ');
                                            ?>
                                             <span class="glyphicon glyphicon-option-vertical"></span></span>
                                    </div>
                                    <div class="panel-body">
                                        <ul id="last_comments" class="list-group"> </ul>
                                            <div id="loader_last_comments" style="display: none; text-align: center!important;">
                                                <span class="loader loader-circle"></span>
                                                Chargement......
                                            </div>
                                        <a id="more_commentaire" href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> Plus de Commentaires</a>
                                    </div>
                                </div>
                </div>
            </aside>
        </div>
    </div>
</section>





