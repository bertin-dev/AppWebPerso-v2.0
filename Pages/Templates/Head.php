<!--ENTETE -->
<header>
    <!-- Navigation -->
    <nav role="navigation">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div id="progress-bar-container">
                    <div id="progress-bar"></div>

                </div>

                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!--Gestion du Logo-->
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <img style="float: left; width: 50px; position: relative; top: -15px;" class="img-rounded"
                             alt="Bertin-Mounok" src="<?= $_ENV['logo']; ?>" title="Logo bertin.dev"/>
                        <span title="bertin.dev"
                              style="font-size: 9px; position: relative; top: 17px;">Bertin Mounok</span>
                    </a>

                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="menu_head" class="collapse navbar-collapse navbar-ex1-collapse">
                    <?= Core\Controller\Controller::affiche_menu($id_page_accueil); ?>
                </div>
            </div>
        </div>

        <div id="notif_chemin_fer" class="container">
            <div id="inner-headline" class="row titre">
                <div class="col-xs-12 col-md-12 col-lg-12">
                    <!--suppress Annotator, Annotator, Annotator -->
                    <ul class="breadcrumb">
                        <!--<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>Accueil</li>-->
                        <li><a href="../Public/index.php" title="Accueil"><img class="img-responsive" width="15"
                                                                               align="left" title="Home Page"
                                                                               src="../Public/img/socials/home.png"></a>
                        </li>
                        <li class="active">
                            <small><em> <?php if ($_ENV['titre'] == "Accueil"){
                                $projet = App::getDB()->prepare_request('SELECT titre FROM projets_encours ORDER BY id_projet DESC LIMIT 1', array());
                                echo 'Projet Encours... : '.utf8_encode($projet['titre']);
                            }
                                    else if ($_ENV['titre'] == "Portfolio") echo utf8_encode($_ENV['titre']) . ' → Mes Réalisations.';
                                    else if (utf8_encode($_ENV['titre']) == "Compétences") echo 'Mes ' . utf8_encode($_ENV['titre']) . ' → Ce que je sais faire.';
                                    else if ($_ENV['titre'] == "Culture") echo utf8_encode($_ENV['titre']) . ' → Ce que J\'aime.';
                                    else if ($_ENV['titre'] == 'Contact') echo utf8_encode($_ENV['titre']) . ' → M\'envoyer un Email.';
                                    else if ($_ENV['titre'] == 'A Propos') echo utf8_encode($_ENV['titre']) . ' → Je parle de moi.';
                                    else if ($_ENV['titre'] == 'Blog') echo utf8_encode($_ENV['titre']) . ' → Bienvenue sur Mon Espace Interactif.';
                                    else if ($_ENV['titre'] == 'Applications Web') echo utf8_encode($_ENV['titre']) . ' → Générez votre Dévis.';
                                    else if ($_ENV['titre'] == 'Services') echo utf8_encode($_ENV['titre']) . ' → Mes prestations.';
                                    else if (!isset($_ENV['titre']) OR empty($_ENV['titre'])) echo ' → Page Introuvable.';
                                   // else echo utf8_encode($_ENV['titre']) . ' → Bienvenue sur Mon Espace Interactif.';
                                    ?>
                                </em></small>
                        </li>

                        <span class="dropdown" style="float: right;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label count" style="font-size: 65%;position: absolute; left: 50%; background-color: #FF1300;"></span>
                               <img src="img/icons8-sms-32.png" alt="Projets Réalisés" title="Projets Réalisés" class="img-circle" width="25" >
                            </a>
                            <div id="competences" class="page-container current aube menu"></div>
                        </span>

                        <!--
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                    </ul>

                    <!--<ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="label label-pill label-danger count"> </span>
                                Notification
                            </a>
                            <ul class="dropdown-menu"></ul>
                        </li>
                    </ul>-->


                </div>



            </div>
        </div>

        <!-- /.container -->
    </nav>


</header>




