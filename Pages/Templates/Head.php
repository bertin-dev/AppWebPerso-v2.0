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
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!--Gestion du Logo-->
            <a class="navbar-brand page-scroll" href="#page-top">
                <img style="float: left; width: 50px; position: relative; top: -15px;" class="img-rounded"
                     alt="Bertin-Mounok" src="<?=$_ENV['logo']; ?>" title="Logo Bertin-Mounok"/>
                <span title="Bertin Mounok" style="font-size: 9px; position: relative; top: 17px;">Bertin Mounok</span>
            </a>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
             <?=  Core\Controller\Controller::affiche_menu($id_page_accueil);?>
        </div>
    </div>
    </div>

        <div class="container">
        <div id="inner-headline" class="row titre">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <!--<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>Accueil</li>-->
                    <li><a href="../Public/index.php" title="Accueil"><img class="img-responsive" width="15" align="left" title="Lieu de Localisation" src="../Public/img/socials/home.png"></a></li>
                    <li class="active"> <small><em> <?php if($_ENV['titre']=="ACCUEIL") echo '';
                                else if($_ENV['titre']=="PORTFOLIO") echo $_ENV['titre'].' → Mes Réalisations';
                                else if($_ENV['titre']=="COMPETENCES") echo 'Mes '.$_ENV['titre'].' → Ce que je sais faire';
                                else if($_ENV['titre']=="CULTURE") echo $_ENV['titre'].' → Ce que J\'aime';
                                else if($_ENV['titre']=='CONTACT') echo $_ENV['titre'].' → M\'envoyer un Email';
                                else if(!isset($_ENV['titre']) OR empty($_ENV['titre'])) echo ' → Page Introuvable';
                                else echo $_ENV['titre'].' → Je parle de moi';
                                ?>

                            </em></small></li>
                    <span style="margin-left: 150px; "><small><em>Projet Encours... : Conception et implémentation d'une ERP </em></small></></span>



                    <li class="dropdown" style="float: right;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="label label-pill label-danger count"></span> Notification</a>
                        <ul class="dropdown-menu menu"></ul>
                    </li>

                    <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
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

            <style>
                #competences.aube {
                    background: -webkit-gradient(linear,0 0,0 100%,from(#3c5f75),color-stop(0.55,#9c5273),to(#34576c));
                    background: -webkit-linear-gradient(#3c5f75,#9c5273 55%,#34576c);
                    background: -moz-linear-gradient(#3c5f75,#9c5273 55%,#34576c);
                    background: -o-linear-gradient(#3c5f75,#9c5273 55%,#34576c);
                    background: linear-gradient(#3c5f75,#9c5273 55%,#34576c);
                }
                #competences {
                    background: linear-gradient(#7ca6c1,#4a80a3);
                }
                .page-container.current {
                    display: block;
                }

                .page-container {
                    display: none;
                    position: absolute;
                    /*height: 100%;
                    width: 100%;*/
                    z-index: 1;
                }

                #competences-speech li.current {
                    top: 0;
                }
                #competences-speech li {
                    position: absolute;
                    top: -300px;
                    left: 700px;
                    width: 450px;
                    background: rgba(0,0,0,.5);
                    padding: 10px 20px;
                    -webkit-box-shadow: 0 0 17px rgba(0,0,0,.3);
                    box-shadow: 0 0 17px rgba(0,0,0,.3);
                    border: 1px solid #0f6296;
                    -webkit-transition: top .5s;
                    -moz-transition: top .5s;
                    -o-transition: top .5s;
                    -ms-transition: top .5s;
                    transition: top .5s;
                }
                li {
                    display: list-item;
                    text-align: -webkit-match-parent;
                }

                #competences-speech {
                    position: absolute;
                    right: 20px;
                    top: 50px;
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    height: 160px;
                }




                #competences-speech li h2,#competences-job h2{font-size:24px;font-weight:normal;color:#EEE;width:50%}
                #competences-speech li h2:after,.not-mobile #competences-job h2:after{content:" ";display:block;width:3px;height:24px;background:#EEE;position:absolute;top:31px;left:48%;-webkit-transform:rotate(20deg);-moz-transform:rotate(20deg);-o-transform:rotate(20deg);-ms-transform:rotate(20deg);transform:rotate(20deg)}
                .not-computer #competences-speech li h2:after{top:2px}
                #competences-speech li h3{margin:25px 0 0;padding:0}
                #competences-speech li .exp-duration,#competences-job .exp-duration{color:#FFF;position:absolute;top:35px;left:53%}
                #competences-speech li h3+.exp-duration{top:auto;margin-top:-17px}.not-computer #competences-speech li .exp-duration{top:6px;left:51%}#competences-speech li p,#competences-speech li>a
                .competence-java{background-position:-210px 0}
                .competence-java:hover,.competence-java:focus,.competence-java.current,.not-computer .competence-java{background-position:-210px -70px}
            </style>
            <div id="competences" class="page-container current aube">
                <ul id="competences-speech">
                    <li class="competence-java current">
                        <h2>JAVA</h2>
                        <span class="exp-duration">3 ans d'expérience</span>
                        <p>
                            Langage très répandu découvert au cours de ma formation scolaire. Il permet notamment de supporter des sites web à gros trafic.
                        </p>
                    </li>
                </ul>
            </div>

        </div>
        </div>

    <!-- /.container -->
</nav>



    <script>
        $(function () {
            $("#competences").click(function(){
                var c=$(this).attr("class").replace("current","").replace("competence-","").trim();
            }
        });
    </script>
</header>




