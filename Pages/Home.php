<?php require_once('page_number.php'); ?>

<!-- Photos de Profil -->
<section id="" class="">
    <div class="container">
        <div class="row">
            <article class="title-big col-lg-12">
                <div class="col-lg-6 wow fadeInDown"><!-- data-wow-duration="1000ms" data-wow-delay="600ms"-->
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

                             echo '<img data-src="" alt="bertin.dev" title="'.utf8_encode($slide->title).'" class="bg img-responsive well"
                                 src="'.$slide->chemin.'">';
                            endforeach;
                            ?>
                            <!--<div class="mask"> </div>-->
                            <h3 class="text-left ecriture" style="font-size: 25px;">Sur ma Plate-forme Web. <br>Je suis Developpeur
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

                <div class="col-lg-6 wow fadeInDown" style="text-align: center;">
                    <h1>Recherchez-vous un Consultant Développeur ???</h1>
                    Ça tombe bien! j'en suis un. Je suis un Geek de l'informatique depuis l'âge de 17 ans. Si mon profil
                    vous intéresse n'hésitez pas à me
                    <a href="index.php?id_page=5" title="contactez-moi">Contacter <span class="glyphicon glyphicon-send"></span></a> ou regardez <a
                            href="index.php?id_page=2" title="Mes Réalisations">Mes Réalisations <span class="glyphicon glyphicon-hand-left"></span></a> <br>
                    <!--<span href="#" data-original-title='Informaticien'>Me Suivre</span>-->
                    <details>
                        <summary><h1 title="Solutions Informatique">TOUT PROJET EST UN CHALLENGE </h1></summary>
                        <summary><h4>Audit & Conseils</h4></summary>
                        <summary><h4>Transfert de Compétences</h4></summary>
                        <summary><h4>Analyse, Conception, Implémentation et Déploiment</h4></summary>

                    </details>
                </div>
                <!--<a class="btn btn-default page-scroll" href="#about" title="ppppppppppppppp">Click Me to Scroll Down!</a>-->
            </article>

            <article class="col-xs-12 col-md-4 col-lg-12 wow fadeInDown" style="text-align: center;">
                <h4 class="wow fadeInRightBig" style="text-align: left; font-variant: small-caps;"><em><span class="glyphicon glyphicon-asterisk"></span> MES CONVICTIONS
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
                <h4 class="wow fadeInRightBig col-lg-6" style="font-variant: small-caps;"><i class="fa fa-ticket"></i><em> TRANSFORMATION DIGITALE
                        <small>Optez Pour des Solutions sur Mesures</small></em>
                </h4>

                <h4 class="wow fadeInLeft col-lg-6 text-right visible-md visible-lg" style="font-variant: small-caps;"><span class="glyphicon glyphicon-resize-small"></span><em> DEVIS
                        <small>au format PDF dans votre boîte mail.</small></em>
                </h4>

                <div class="col-lg-4">
                    <img src="../Public/img/icons/demain-entrepreneur.png" title="Entrepreneur de demain" class="img-responsive" alt="Entrepreneur de demain">
                    <h5>Voua avez la possibilité de suivre l'évolution de votre projet à distance<small><em> Cliquez sur le bouton juste en dessous</em></small></h5>
                <div class="text-center">
                    <a id="projet" role="button" href="#" class="btn btn-primary WOW bounceInDown animated" title="Suivez votre Projets à distance"><span class="glyphicon glyphicon-folder-open"></span> Suivez Votre Projet</a>
                </div>
                </div>

                <div class="right-sidebar col-lg-4 wow fadeInDown text-center">
                    <h4 style="font-variant: small-caps; font-size: 22px;">Des Solutions pour tous vos enjeux de Transformation</h4>
                    <h5>Transformation digitale<small><em> Votre Entreprise est-elle prête ?</em></small></h5>
                   <h5>Performance de Vente <small><em> Muscler votre force de vente.</em></small></h5>
                    <h5>Une Technologie de Pointe <small><em>Adapté pour votre entreprise.</em></small></h5>
                </div>


                <div class="right-sidebar col-lg-4 wow fadeInDown">
                    <h4 style="font-variant: small-caps; font-size: 22px;">Générez Dynamiquement votre Devis</h4>
                    <div class="col-xs-3 col-lg-3">
                        <img src="../Public/img/Accueil/devis.png" class="img-responsive img-thumbnail" alt="dévis" title="Exemplaire de dévis">
                    </div>
                    <div class="col-xs-9 col-lg-9">
                        <h5>Votre offre sans engagement<small><em> dans votre boîte mail en 1 Min chrono!</em></small></h5>
                        <?php
                        if( isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER']) )
                        {
                        echo '<a id="devis_service" href="#" class="btn btn-primary WOW bounceInDown animated" title="Connexion"><span class="glyphicon glyphicon-modal-window"></span> Demander un Dévis</a>';
                        }else{
                            echo '<a href="#" onclick="return false;" class="btn btn-primary WOW bounceInDown animated" title="Connexion" data-toggle="modal" data-target="#login_1" ><span class="glyphicon glyphicon-modal-window"></span> Demander un Dévis</a>';
                        }
                        ?>
                    </div>
                </div>

            </article>

            <article class="col-xs-12 col-md-4 col-lg-12 title-big">
                <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-home"></span><em> ENTREPRISE
                        <small>L'innovation Technologique</small></em>
                </h4>
                <div class="col-lg-12 wow fadeInDown">
                    <?php
                    $i=0;
                    foreach (App::getDB()->query('SELECT title, description, chemin FROM images
                                                         INNER JOIN page
                                                         ON images.ref_id_page=page.id_page
                                                         WHERE destination="Haut" AND id_page='.$_ENV['id_page'].' ORDER BY id_page DESC LIMIT 3') AS $entreprise):
                        $enterprise = explode('-', utf8_encode($entreprise->description));
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
                                        <strong>'.utf8_encode(strtoupper($entreprise->title)).'</strong>
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
                <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-transfer"></span><em> QUALIFICATIONS
                        <small>Mon Périmètre de Compétence s'Articule Autour de</small></em>
                </h4>
                <div class="col-lg-8 wow fadeInLeft">
                    <div class = "panel panel-primary" style="background-color: inherit;">
                        <div class = "panel-heading">
                            <h3 class = "panel-title">SERVICES DISPONIBLE</h3>
                        </div>

                        <div id="last_qualification" class="panel-body">
                                <div id="loader_qualification" style="display: none;text-align: center!important;">
                                    <span class="loader loader-circle"></span>
                                    Chargement......
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInRight">
                    <div class = "panel panel-primary" style="background-color: inherit;">
                        <div class = "panel-heading">
                            <h3 class = "panel-title">FONCTIONNALITES METIERS DEPLOYES</h3>
                        </div>
                        <div class="panel-body">
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

            <article class="col-xs-12 col-md-4 col-lg-12">
                <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-floppy-saved"></span><em> MES DERNIERES REALISATIONS
                        <small> → Derniers Projets</small></em>
                </h4>
                <div id="last_realisation" class="wow fadeInUp">
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
          <h1 class="WOW bounceInDown animated" style="position: relative; top: 80px; font-variant: small-caps;">'.strtoupper(utf8_encode($title[0])). '<br>'.strtoupper(utf8_encode($title['1'])).'</h1>
          </div>';
endforeach;
?>

</section>


<section>
    <div class="container">
        <div class="row">
            <article class="col-xs-12 col-md-8 col-lg-9">
                <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-book"></span><em> CITATIONS
                        <small>Sur la Vie</small></em>
                </h4>
                <div class="col-xs-12 col-lg-12 ombrage2" style="margin-bottom: 20px;">
<!-------->
                                <div class="carousel slide" data-ride="carousel" id="quote-carousel" data-interval="180000">
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
                                                    <div class="col-sm-8 col-sm-offset-2"><p>'.utf8_encode($citations->description).'</p>
                                                            <small>'.strtoupper(utf8_encode($citations->title)).'</small>
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
                        <a class="btn btn-primary" href="index.php?id_page=6" title="Cliquez"><i class="fa fa-arrow-right"></i> Me Suivre</a>
<!-------->
                </div>

                <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-new-window"></span><em> NOUVEAUTES
                        <small>Dernières Technologies Déployés par Microsoft & Xamarin</small></em>
                </h4>
                <div class="col-xs-12 col-lg-12 view peach-gradient wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" style="margin-bottom: 20px;">
                <div class="col-xs-12 col-lg-5">
                        <ul style="text-align: center; padding: initial; margin: initial">
                        <li>Il y a tout juste <?= date('Y')-2018;?> an que j'utilise cette techno mais putin je suis hyper faciné par cette dernière.
                            Les applications universelles (Windows 10, windows 10 Mobile) et Xamarin
                            m'ont permis de déployer quelques applications crossplate-forme
                        </li>
                        </ul>
                </div>

                 <div class = "col-xs-6 col-lg-3" style="text-align: center; padding: initial; margin: initial">
                     <img src="img/Accueil/xamarin-native.png" class="img-responsive"  alt="">
                 </div>

                <div class="col-xs-6 col-lg-4" style="text-align: center; padding: initial; margin: initial">
                    <img src="img/Accueil/media-774068_960_720.png" class="img-responsive" width="196" alt="">
                </div>
                </div>

                <div class="col-xs-12 col-lg-12 wow fadeInDown" style="margin-bottom: 20px;">
                    <h4 class="wow fadeInRightBig" style="font-variant: small-caps;"><span class="glyphicon glyphicon-cloud-download"></span><em> CLOUD
                            <small>Traitement, Stockage, Restoration des Données Distantes</small></em>
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
                            <div class="view view-cascade gradient-card-header purple-gradient" style="background-image: initial;">
                                <img src="'.$facteur->chemin.'" title="'.utf8_encode($facteur->title).'" class="img-responsive" alt="">
                            </div>

                            <!-- Card content -->
                            <div class="card-body card-body-cascade text-center">
                                <!-- Text -->
                                <p class="card-text" style="font-size: 15px">'.utf8_encode($facteur->description).'</p>
                            </div>

                        </div>
                    </div>';

                    endforeach;
                    ?>
                </div>


                <?php
                //$Cache->inc(ROOT.'/twitter.php');
                if(!$variable = $Cache->read('variable')){
                    sleep(1);
                    $variable = "ici mon text";
                    $Cache->write('variable', $variable);
                }

                echo $variable;
                ?>
                <div class="col-lg-12">
                    <p>la page a mis <span class="label secondary"><?= round(microtime(TRUE) - $_SESSION['time'], 3); ?>s</span> à se générer à peu près</p>
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
                                            $evenement .= utf8_encode(strtoupper($projet->titre_programme));
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
                        <div class="card-body card-body-cascade text-center">
                            <marquee id="last_agenda" class="text-center" behavior="" direction="UP" scrollamount="1" height="50">
                                    <div id="loader_agenda" style="display: none; text-align: center!important;">
                                        <span class="loader loader-circle"></span>
                                        Chargement......
                                    </div>
                            </marquee>
                        </div>
                    </div
                    <!-- Card -->


                <h5 class="titreWidget" style="font-variant: small-caps"><span class="glyphicon glyphicon-pushpin"></span><em> Article Publié <small>
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





