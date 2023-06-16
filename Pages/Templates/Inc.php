<footer class="wow fadeInUp">



    <!-- Navigation -->

    <nav class="navbarRetouche navbar-default" role="navigation">

        <div class="container" style="text-align: center;">



            <div class="col-xs-12 col-md-3 col-lg-3 text-center">

                <h3 style="font-variant: small-caps;"><i class="fa fa-link"></i> <u>Réseaux Sociaux</u></h3>



                <div class="col-xs-12 col-lg-4">

                    <button title="partager sur LinkedIn" style="width: 100%; background-color: #0077b5; font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" class="button share_linkedin btn btn-primary" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=<?=$_ENV['id_page'];?>">

                        <i class="fa fa-share"></i>LinkedIn</button>

                </div>

                <div class="col-xs-12 col-lg-4">

                    <button title="partager sur Twitter" style="width: 100%; background-color: #00aced;font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" class="button share_twitter btn btn-primary" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=<?=$_ENV['id_page'];?>">

                        <i class="fa fa-share"></i>Twitter</button>

                </div>

                <div class="col-xs-12 col-lg-4">

                    <button title="partager sur Facebook" class="button share_facebook btn btn-primary" style="width: 100%; background-color: #3b5998;font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=<?=$_ENV['id_page'];?>">

                        Facebook</button>

                </div>



                <div class="col-lg-12">

                    <form action="" role="form" class="form-group">

                        <label for="langue"><i class="fa fa-globe"></i> Choisir La Langue</label>

                        <select name="langue" id="langue" class="form-control" style="background-color: #fff;color: #555;">

                            <option value="francais">Français</option>

                            <option value="Anglais">Anglais</option>

                        </select>

                    </form>

                </div>

                <a data-toggle="modal" href="#infos" class="white-text">Statistiques du Site</a>

            </div>

            <div class="col-xs-12 col-md-3 col-lg-3">

                <h3 style="font-variant: small-caps;"><i class="fa fa-info"></i> <u>Informations</u></h3>

                <?php $actuellement = App::getDB()->prepare_request('SELECT * FROM admin ORDER BY id_admin DESC LIMIT 1', []);  ?>

                <address>

                    <div style="text-align: center;">

                        <span style="margin-bottom: 5%;" title="lieu de localisation" class="col-lg-12"><img class="" width="20"

                                                                                                             title="Lieu de Localisation"

                                                                                                             src="../Public/img/socials/home.png"> → <?=$actuellement['ville'];?>/<?=$actuellement['pays'];?></span><br>

                        <span style="margin-bottom: 5%;" title="Adresse Email" class="col-lg-12"><img class="" width="20"

                                                                                                      title="Adresse Email"

                                                                                                      src="../Public/img/socials/email.png"> → <?=$actuellement['email'];?></span><br>

                        <span style="margin-bottom: 5%;" title="Numéro Téléphone" class="col-lg-12"><img class="" width="20"

                                                                                                         title="Numéro de Téléphone"

                                                                                                         src="../Public/img/socials/mobile.png"> → <?=$actuellement['tel'];?></span><br>

                        <span style="margin-bottom: 5%;" title="Code Postal" class="col-lg-12"><img class="" width="20"

                                                                                                    title="Code Postal"

                                                                                                    src="../Public/img/socials/Sticky_1-128.png">→ BP: <?=$actuellement['boite_postale'];?></span>

                    </div>

                </address>

            </div>

            <div class="col-xs-12 col-md-3 col-lg-3">

                <h3 style="font-variant: small-caps;"><i class="fa fa-twitter"></i> <u>Mes Derniers Tweets</u></h3>


                <!------------------------------------------------------->

            </div>

            <div class="col-xs-12 col-md-3 col-lg-3 text-center">



                <h3 style="font-variant: small-caps;"><i class="fa fa-search-plus"></i> <u>Où me Trouver</u> ???</h3>

                <a class="col-xs-3 col-lg-3" href="https://github.com/bertin-dev/AppWebPerso-v2.0"><img src="../Public/img/socials/Github_Bertin-Mounok.svg" alt="Github Bertin-Mounok"

                                                                                                        title="Github bertin.dev" class="img-responsive"

                                                                                                        width="32"/>

                </a>

                <a class="col-xs-3 col-lg-3" href="https://www.linkedin.com/in/bertin-mounok-415754120/">

                    <img src="../Public/img/socials/LinkedIn-Bertin-Mounok.svg" alt="LinkedIn Bertin-Mounok"

                         title="LinkedIn bertin.dev" class="img-responsive"

                         width="32"/>

                </a>

                <a class="col-xs-3 col-lg-3" href="https://www.facebook.com/bertin.dev">

                    <img src="../Public/img/socials/Facebook-Bertin-Mounok.svg" alt="Facebook Bertin-Mounok"

                         title="Facebook bertin.dev" class="img-responsive"

                         width="32"/>

                </a>



                <!--<a class="col-xs-3 col-lg-3" href="http://www.viadeo.com/p/0021658i7bpwsd5p">

                    <img src="../Public/img/socials/Viadeo-Bertin-Mounok.svg" alt="Viadeo Bertin-Mounok"

                         title="Viadeo Bertin Mounok" class="img-responsive"

                          width="32"/>

                </a>-->



                <a class="col-xs-3 col-lg-3" href="https://bertin-dev.visualstudio.com/">

                    <img src="../Public/img/socials/Windows bertin-mounok.png" alt="Microsoft Azure Devops"

                         title="Azure Devops bertin.dev" class="img-responsive"

                         width="32"/>

                </a>



                <strong>Entrez votre Email </strong>



                <form id="newsletters" method="post" onsubmit="return false;" accept-charset="UTF-8">

                    <div class="control-group">



                        <input class="form-control" type="email" placeholder="email@domaine.com" required

                               title="Entrez votre Email" name="newsletter" id="newsletter"/>

                        <small id="output_newsletter"></small>

                        <input id="enreg_newsletter" class="btn btn-primary" type="submit" title="Envoyez" value="Envoyer">

                        <div id="load_data_newsletter"></div>

                    </div>

                </form>

                <br>

                <small>Pour recevoir nos newsletters</small>

            </div>



        </div>

        <!-- /.container -->

    </nav>



    <span class="col-sm-12 col-md-6 col-lg-6 redefPadding" style="padding: 0; margin: 0;">

                <span style="font-variant: small-caps;" title="Consultant Développeur"><small><em>  &copy; <?php  echo date("Y", time()); ?>, bertin.dev, Inc.</em></small></span>

    </span>



    <span class="col-sm-12 col-md-6 col-lg-6">

        <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li

                    style="list-style-type: none;"><em>→ <?=$actuellement['tel'];?></em></li></small></span>

        <span style="float: right; padding: 0; margin: 0;"><i class="fa fa-mobile"></i></span>

    </span>


</footer>

<?php require('login.php'); ?>

<?php require('statistiques.php'); ?>