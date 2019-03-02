
<footer class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

    <!-- Navigation -->
    <nav class="navbarRetouche navbar-default" role="navigation">
        <div class="container" style="text-align: center;">

            <div class="col-xs-12 col-md-3 col-lg-3">
                <h3 style="font-variant: small-caps;"><u>Réseaux Sociaux</u></h3>
                Je m'appelle <a title="Auteur">Bertin Mounok</a>, j'ai commencé le développement web et le web design
                pour développer un petit site perso et c'est rapidement devenu une vraie vocation.
                J'aime expérimenter, découvrir et apprendre au fur et à mesure de mes projets pros et perso.
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <h3 style="font-variant: small-caps;"><u>Informations</u></h3>
                <address>
                    <div style="text-align: center;">
                        <span style="margin-bottom: 5%;" title="lieu de localisation" class="col-lg-12"><img class="" width="20"
                                                                                  title="Lieu de Localisation"
                                                                                  src="../Public/img/socials/home.png"> → Yaoundé/Cameroun</span><br>
                        <span style="margin-bottom: 5%;" title="Adresse Email" class="col-lg-12"><img class="" width="20"
                                                                           title="Adresse Email"
                                                                           src="../Public/img/socials/email.png"> → bertin.dev@outlook.fr</span><br>
                        <span style="margin-bottom: 5%;" title="Numéro Téléphone" class="col-lg-12"><img class="" width="20"
                                                                              title="Numéro de Téléphone"
                                                                              src="../Public/img/socials/mobile.png"> → (+237) 694 048 925</span><br>
                        <span style="margin-bottom: 5%;" title="Code Postal" class="col-lg-12"><img class="" width="20"
                                                                         title="Code Postal"
                                                                         src="../Public/img/socials/Sticky_1-128.png">→ BP: 1492</span>
                    </div>
                </address>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <h3 style="font-variant: small-caps;"><u>Mes Derniers Tweets</u></h3>
                <span class="col-lg-12" title="Gestion de la paie">
                <span style="float: left;"><img class="img-responsive" width="15"
                                                src="../Public/img/socials/mobile.png"></span>
                <span style="font-size: small; float: left;">→Création d'une plate-forme web<br><small> <?= date('d, m Y'); ?>
                    Statut:<span style="color: #c9c9c9;"> Encours...</span></small></span><br>
                </span>

                <span class="col-lg-12">
                <span style="float: left;"><img class="img-responsive" width="15" title="Numéro de Téléphone"
                                                src="../Public/img/socials/mobile.png"></span>
                <span style="font-size: small; float: left;">→Création d'une plate-forme web<br><small> <?= date('d, m Y'); ?>
                    Statut:<span style="color: #c9c9c9;"> Encours...</span></small></span><br>
                </span>

                <span class="col-lg-12">
                <span style="float: left;"><img class="img-responsive" width="15" title="Numéro de Téléphone"
                                                src="../Public/img/socials/mobile.png"></span>
                <span style="font-size: small; float: left;">→Création d'une plate-forme web<br><small> <?= date('d, m Y'); ?>
                    Statut:<span style="color: #c9c9c9;"> Encours...</span></small></span><br>
                </span>

                <span class="col-lg-12">
                <span style="float: left;"><img class="img-responsive" width="15" title="Numéro de Téléphone"
                                                src="../Public/img/socials/mobile.png"></span>
                <span style="font-size: small; float: left;">→Création d'une plate-forme web<br><small> <?= date('d, m Y'); ?>
                    Statut:<span style="color: #c9c9c9;"> Encours...</span></small></span><br>
                </span>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3">
                <div class="col-xs-12 col-lg-12">
                    <h3 style="font-variant: small-caps;"><u>Ou me Trouver</u> ???</h3>
                    <img src="../Public/img/socials/Github_Bertin-Mounok.svg" alt="Github Bertin-Mounok"
                         title="Github Bertin Mounok" class="img-responsive"
                         style="float: left; margin: 0 0 0 15px;" width="32"/>

                    <img src="../Public/img/socials/LinkedIn-Bertin-Mounok.svg" alt="LinkedIn Bertin-Mounok"
                         title="LinkedIn Bertin Mounok" class="img-responsive"
                         style="float: left; margin: 0 0 0 5px;" width="32"/>


                    <img src="../Public/img/socials/Facebook-Bertin-Mounok.svg" alt="Facebook Bertin-Mounok"
                         title="Facebook Bertin Mounok" class="img-responsive"
                         style="float: left; margin: 0 0 0 5px;" width="32"/>

                    <!-- <img src="img/Twitter-Bertin-Mounok.svg" alt="twitter Bertin-Mounok" title="twitter Bertin Mounok" class="img-responsive"
                          style="float: left; margin: 0 0 0 5px;" width="32"/>-->

                    <img src="../Public/img/socials/Google+-Bertin-Mounok.svg" alt="Google+ Bertin-Mounok"
                         title="Google+ Bertin Mounok" class="img-responsive"
                         width="32" style="float: left; margin: 0 0 0 5px;"/>

                    <img src="../Public/img/socials/Viadeo-Bertin-Mounok.svg" alt="Viadeo Bertin-Mounok"
                         title="Viadeo Bertin Mounok" class="img-responsive"
                         style="float: left; margin: 0 0 0 5px;" width="32"/>
                </div>
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

    <span class="col-sm-12 col-md-6 col-lg-6" style="padding: 0; margin: 0;">
                <span style="font-variant: small-caps;" title="bertin.dev → Développeur. STATUT : Freelance"><small><em>  &copy; <?php  echo date("Y", time()); ?>
                    , bertin.dev, Inc.</em></small></span>
            </span>

    <span class="col-sm-12 col-md-6 col-lg-6">
        <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li
                style="list-style-type: none;"><em>→ +237 694 048 925</em></li></small></span>
        <span style="float: right; padding: 0; margin: 0;"><img class="img-responsive" width="15"
                                                                title="Numéro de Téléphone"
                                                                src="../Public/img/socials/mobile.png"></span>
    </span>


</footer>

<?php require('login.php'); ?>
<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.js"></script>

<!-- Other file JavaScript -->
<script src="../Public/js/jquery.easing.min.js"></script>
<script src="../Public/js/scrolling-nav.js"></script>
<script src="../Public/js/scrollindicator.js"></script>
<script src="../Public/js/infobulle.js."></script>
<script src="../Public/js/wow.min.js"></script>
<script src="../Public/js/mustache.js"></script>
<script src="../Public/js/fonctions.js"></script>

<!--
  ==========================================================================
Affiche le service devis si tu es authentifié
   ==========================================================================
  -->
<?php
if( (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) OR (isset($_COOKIE['ID']) && !empty($_COOKIE['ID'])) )
{
?>
<script>
    $('#devis_service').on('click', function () {
        $(location).attr('href',"index.php?id_page=9");
    });
    </script>
<?php
}
?>




<!--
  ==========================================================================
Empêche l'affichage du pied de page (footer) et (du chemin de fer + Notification) dans le blog
   ==========================================================================
  -->
<?php
if(isset($_ENV['id_page']) && $_ENV['id_page']==7)
{
?>
<script>
    $(function () {
       // $('#notif_chemin_fer').addClass('collapse');
       // $('#notif_chemin_fer').attr('style', 'display: none');
        //$('footer').attr('style', 'display: none');

        /*2 eme methode*/
        //$('#notif_chemin_fer').addClass('collapse');
        $('#notif_chemin_fer').remove();
          //  $('footer').addClass('collapse');
            $('footer').remove();

           /* $('a').on('click', function () {

            });*/

          /* $('section article a, aside a').each(function () {
              $('section article a, aside a').attr({
                  'data-toggle': 'modal',
                  'data-target': '#login_1'
              });
           });*/

    });

</script>
<?php
}

if(isset($_ENV['id_page']) && $_ENV['id_page']==6){
?>
<script>
    $(function () {
      //  $('#notif_chemin_fer').addClass('collapse');
        $('#notif_chemin_fer').remove();
    });
</script>

<?php
}
?>

<script>
    $(function () {
        $('.page a').click(function(e){
            var link = $(this).attr('href');
            $.ajax({
                url: link,
            })
                .done(function (html) {
                   // $('body').empty().append(html);
                    $('body').load(link, function() {

                    });
                });
            e.preventDefault();

        });


    });
</script>


<?php
if(isset($_SESSION['model']) && $_SESSION['model']=="Gestion de Projets")
{
?>
<script>
$(function () {
    const element = $('#blocG1');
    if(element.hasClass('collapse')){
        //alert('1');
        element.toggleClass('collapse')
    }
});

</script>
<?php
    unset($_SESSION['model']);
}
if(isset($_SESSION['uniq_model']) && $_SESSION['uniq_model']=="Gestion de Projets")
{
    ?>
    <script>
        $(function () {
            const element = $('#blocG1');
            if(element.hasClass('collapse')){
                alert('2');
                element.addClass('collapse');
            }
        });
    </script>
<?php
    unset($_SESSION['uniq_model']);
}
?>







