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

                <?php

                if(!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){

                    echo 'VOUS ÊTES HORS LIGNE !';

                }else{
                    echo '<ul style="font-size: small;">
                              <li>Changement des configurations du service API OAUTH 2.0 de Twitter</li>
                              <li>Traitement de la mise à jour encours...</li>
                          </ul>';

                }
                ?>

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

<!-- jQuery -->

<!--<script src="../Public/js/jquery.js"></script>-->

<!--<script src="https://code.jquery.com/jquery-1.11.1.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>







<!-- Bootstrap Core JavaScript -->

<!--<script src="../Public/js/bootstrap.js"></script>-->

<!-- Latest compiled and minified JavaScript -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>









<!-- Other file JavaScript -->

<!--<script src="../Public/js/jquery.easing.min.js"></script>-->

<!-- https://cdnjs.com/libraries/jquery-easing/1.3-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.compatibility.min.js"></script>







<script src="../Public/js/jquery.timego.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.5/jquery.timeago.min.js"></script>









<!--<script src="../Public/js/jssor.slider-27.5.0.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/27.5.0/jssor.slider.min.js"></script>





<script>

    // French

    jQuery.timeago.settings.strings = {

        // environ ~= about, it's optional

        prefixAgo: "il y a",

        prefixFromNow: "d'ici",

        seconds: "moins d'une minute",

        minute: "une minute",

        minutes: "%d minutes",

        hour: "une heure",

        hours: "%d heures",

        day: "un jour",

        days: "%d jours",

        month: "un mois",

        months: "%d mois",

        year: "un an",

        years: "%d ans"

    };





    jQuery(document).ready(function() {

        $("time.timeago").timeago();

    });

    /* ==========================================================================

SYSTME DE NAVIGATION EN AJAX

   ========================================================================== */

   /* $('#menu_head a').click(function(e){

        var link = $(this).attr('href');

        /*Empeche d'éffectuer la navigation ajax pour le menu Blog qui a pour id=Portfolio?id_page=7*/

       /* var tab = link.split('=');

        if(tab[1] != 7){

            $.ajax({

                url: link,

            })

                .done(function (html) {

                    // $('#page-top').empty().append(html);

                    $('body').load(link, function() {



                    });

                })

                .fail(function () {

                    console.log('error');

                })

                .always(function(){

                    console.log('complete');

                });

            e.preventDefault();

        }

    });*/








    /*==========================================================================

    SYSTEME DE SCROLL ANIME VERS LE HAUT APRES LE CLICK SUR LE LOGO

    ==========================================================================*/



    //jQuery to collapse the navbar on scroll

    $(window).scroll(function() {

        if ($(".navbar").offset().top > 50) {

            $(".navbar-fixed-top").addClass("top-nav-collapse");

        } else {

            $(".navbar-fixed-top").removeClass("top-nav-collapse");

        }

    });



    //jQuery for page scrolling feature - requires jQuery Easing plugin

    $(function() {

        $(document).on('click', 'a.page-scroll', function(event) {

            var $anchor = $(this);

            $('html, body').stop().animate({

                scrollTop: $($anchor.attr('href')).offset().top

            }, 1500, 'easeInOutExpo');

            event.preventDefault();

        });







        /*==========================================================================

SYSTEME D'INDICATEUR BLEU PENDANT LE SCROLL

==========================================================================*/

        $.fn.prognroll = function(options) {



            var settings = $.extend({

                height: 2, //Progress bar height

                color: "#0a8de0", //Progress bar background color

                custom: false, //If you make it true, you can add your custom div and see it's scroll progress on the page.

                transition: "top .5s",

                transparenceProgessBar: "0 2px 7px #0a8de0,0 1px 2px rgba(0,0,0,.2) inset"

            }, options);



            return this.each(function() {

                if ($(this).data('prognroll')) {

                    return false;

                }

                $(this).data('prognroll', true);



                var $span = $("<span>", {

                    class: "bar"

                });

                $("body").prepend($span);



                $span.css({

                    position: "fixed",

                    top: 50,

                    left: 0,

                    width: 0,

                    height: settings.height,

                    backgroundColor: settings.color,

                    zIndex: 9999999,

                    transition: settings.transition,

                    boxShadow: settings.transparenceProgessBar

                });



                if (settings.custom === false) {



                    $(window).scroll(function(e) {

                        e.preventDefault();

                        var windowScrollTop = $(window).scrollTop();

                        var windowHeight = $(window).outerHeight();

                        var bodyHeight = $(document).height();



                        var total = (windowScrollTop / (bodyHeight - windowHeight)) * 100;



                        $(".bar").css("width", total + "%");

                    });



                } else {



                    $(this).scroll(function(e) {

                        e.preventDefault();

                        var customScrollTop = $(this).scrollTop();

                        var customHeight = $(this).outerHeight();

                        var customScrollHeight = $(this).prop("scrollHeight");



                        var total = (customScrollTop / (customScrollHeight - customHeight)) * 100;



                        $(".bar").css("width", total + "%");

                    });



                }



                /* Get scroll position  on page load */

                $(window).on('hashchange', function(e) {

                    e.preventDefault();

                    console.log($(window).scrollTop());

                });

                $(window).trigger('hashchange');



                var windowScrollTop = $(window).scrollTop();

                var windowHeight = $(window).outerHeight();

                var bodyHeight = $("body").outerHeight();



                var total = (windowScrollTop / (bodyHeight - windowHeight)) * 100;



                $(".bar").css("width", total + "%");

                /* Get scroll position on on page load */



            });

        };





        //appel de la fonction du haut

        $("body").prognroll();



        $(".content").prognroll({

            custom:true

        });



        $(window).scroll(function() {

            if( $(window).scrollTop() > 250) {

                $(".arrow-down").css("visibility","hidden");

            }else {

                $(".arrow-down").css("visibility","visible");

            }

        });











        /* ==========================================================================

        GESTION DE LA BARRE DE CHARGEMENT AUTOMATIQUE AVEC PRISE EN CHARGE DES IMAGES PENDANT LE CHARGEMENT

           ========================================================================== */





        progressBar = {

            countElmt : 0,

            loadedElmt : 0,



            init: function () {

                var that = this;

                this.countElmt = $('img').length;



                //constructeur et ajout progress bar

                var $progressBarContainer = $('<div/>').attr('id', 'progress-bar-container');

                $progressBarContainer.append($('<div/>').attr('id', 'progress-bar'));

                $progressBarContainer.appendTo($('body'));



                //Ajout container d'élements

                var $container = $('<div/>').attr('id', 'progress-bar-elements');

                $container.appendTo($('body'));



                //parcours des éléménts à prendre en compte pour le chargement



                $('img').each(function () {

                    $('<img/>')

                        .attr('src', $(this).attr('src'))

                        .on('load error', function () {

                            that.loadedElmt++;

                            that.updateProgressBar();

                        })

                        .appendTo($container);



                });

            },



            updateProgressBar: function () {

                $('#progress-bar').stop().animate({

                    'width' : (progressBar.loadedElmt / progressBar.countElmt)*100 + '%'

                }, 200, 'linear', function () {

                    if(progressBar.loadedElmt == progressBar.countElmt){

                        setTimeout(function () {

                            $('#progress-bar-container').animate({

                                'top': '-8px'

                            }, function () {

                                $('#progress-bar-container').remove();

                                $('#progress-bar-elements').remove();

                            });

                        }, 750)

                    }

                });

            }

        };



        progressBar.init();





        /* ---------------------------FIN DE LA GESTION DU CHARGEMENT AUTOMATIQUE -----------------------*/



    });

</script>



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

        //enlève entête et pied de page dans le BLOG

        $('#notif_chemin_fer').remove();

            $('footer').remove();

    });

</script>

<?php

}



if(isset($_ENV['id_page']) && $_ENV['id_page']==6){

?>

<script>

    $(function () {

        $('#notif_chemin_fer').remove();

    });

</script>



<?php

}

?>



<!--<script>

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

</script>-->











<!--  ==========================================================================

SYSTEME DE GESTION DES CHARGEMENTS CONDITIONNES EN FONCTION DES PAGES

==========================================================================  -->

<script>

<?php

        //HOMEPAGE id_page=1

       if(isset($_ENV['id_page']) && $_ENV['id_page'] == 1){



           if(isset($_SESSION['ID_USER']))

           $compte = intval($_SESSION['ID_USER']);

           else if(isset($_COOKIE['ID_USER']))

           $compte = intval($_COOKIE['ID_USER']);

           else

              $compte = 0;



     ?>



/* ==========================================================================

 SOUHAIT DE BIENVENUE AUX UTILISATEURS

========================================================================== */

$(function () {

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                id_utilisateur: <?=$compte;?>

            },

            dataType: 'text',

            success: function(data){

                if(data === 'echec'){

             console.log('bienvenue visiyeur');

                 }

                else {

                    var myDate = new Date(), etat;

                    var getDataBD = data.split("-");

                    (myDate.getHours()>=0 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';

                    $('body').notif({

                        title: etat + " " +getDataBD[0],

                        content: 'Soyez le Bienvenu',

                        img: (getDataBD[1]==='') ? 'img/homme.png' : getDataBD[1],

                        cls: 'alert-info'
                    });

                }

            },

            error: function(){

                console.log('Une erreur est survenue Lors du chargement de la HomePage');

            }

        });



});

/* ==========================================================================

SYSTEME DE VERIFICATION DU BOUTON DEVIS DE LA HOMEPAGE

   ========================================================================== */

          $(function () {

              $('#devis_service').click(function (e) {

                  e.preventDefault();

                  $.ajax({

                      url: '../Core/Controller/verification.php',

                      method: 'POST',

                      data: {

                          devis_service: 1

                      },

                      dataType: 'text',

                      success: function(data){

                          $(location).attr('href',"Portfolio?id_page=9");

                      },

                      error: function(){

                          console.log('Une erreur est survenue Lors du click sur le bouton Devis dans la HomePage');

                      }

                  });



              });

          });



/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION REALISATION

   ========================================================================== */



$(function(){

    //ZONE DE TRANSFORMATION DIGITALE

    $('#projet_distant').click(function(e){

        e.preventDefault();

        $('body').notif({

            title: 'Notification d\'Information',

            content: 'Vous devez d\'abord vous identifier !',

            img: 'img/icons/information.png',

            cls: 'alert-info'

        });

    });

    //ZONE DE CITATION A L ACCUEIL

    $('.item').first().addClass('active');

    //ZONE ENTREPRISE A L ACCUEIL

    $('#card1').removeClass('rgba-black-strong').addClass('rgba-indigo-strong');

    $('#card1 .pink-text').removeClass('pink-text').addClass('orange-text');

    $('#card0 a, #card1 a, #card2 a').remove();





    var realisation = '1';

    $('#loader_realisation').show();

    function chargement_realisation(){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                realisation: realisation

            },

            cache: false,

            success:function (data) {

                $('#last_realisation').append(data);

                $('#loader_realisation').hide();

            }

        });

    }

    chargement_realisation();



    //CHARGEMENT BOUTON PLUS DE REALISATIONS SECTION REALISATIONS



    //chargement dynamique des Archives

    $('.more_load_project').on({

        click:function(e){

            e.preventDefault();

            var content = $(this).attr('data');

            eval(content);

            $.ajax({

                url: '../Core/Controller/verification.php',

                method: 'POST',

                data: {

                    plus_realisations: project_real

                },

                dataType: 'text',

                beforeSend: function () {

                    $('#loader_realisation').show();

                    $('.more_load_project').html('<i class="fa fa-spinner left"></i>Chargement Encours...');

                },

                success:function (data) {

                    $('#last_realisation').html(data);

                },

                error: function(data){

                    console.log('Erreur de Chargement de Plus de Réalisations');

                },

                complete: function (data) {

                    $('#loader_realisation').hide();

                    $('.more_load_project').html('<i class="fa fa-play left"></i> Chargement Terminé');

                }

            });



        },

        mouseenter: function () {

            var content = $(this).attr('data'),

            load_project = $('a[id=more_load_project]');

            eval(content);

            $.ajax({

                url: '../Core/Controller/verification.php',

                method: 'POST',

                data: {

                    plus_realisations_title: project_real

                },

                dataType: 'text',

                beforeSend: function () {

                   // load_project.attr('title', 'Chargement...');

                  /* load_project.tooltip({

                        title: 'Chargement...'

                    });*/

                },

                success:function (data) {

                    load_project.tooltip({

                        title: data,

                        html: true

                    });

                },

                error: function(data){

                    console.log('Erreur de Chargement de Plus de Réalisations dans title');

                },

                complete: function (data) {

                    //console.log('Chargement de Plus de Réalisations dans title Terminé');

                }

            });

        }

    });

});







/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION FONCTIONALITES

   ========================================================================== */



$(function(){

    var fonctionnality = '1';

    $('#loader_fonctionnality').show();

    function chargement_fonctionnality(){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                fonctionnality: fonctionnality

            },

            cache: false,

            success:function (data) {

                $('.last_fonctionnality').append(data);

                $('#loader_fonctionnality').hide();

            }

        });

    }

    chargement_fonctionnality();

});









/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION QUALIFICATION

   ========================================================================== */



$(function(){

    var qualification = '1';

    $('#loader_qualification').show();

    function chargement_qualification(){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                qualification: qualification

            },

            cache: false,

            success:function (data) {

                $('#last_qualification').append(data);

                $('#loader_qualification').hide();

            }

        });

    }

    chargement_qualification();



/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION AGENDA

   ========================================================================== */



    var agenda = '1';

    $('#loader_agenda').show();

    function chargement_agenda(){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                agenda: agenda

            },

            cache: false,

            success:function (data) {

                $('#last_agenda').append(data);

                $('#loader_agenda').hide();

            }

        });

    }

    chargement_agenda();



/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION ARTICLE

   ========================================================================== */



    var article = '1';

    $('#loader_article').show();

    function chargement_article(){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                article: article

            },

            cache: false,

            success:function (data) {

                $('#last_article').append(data);

                $('#loader_article').hide();

            }

        });

    }

    chargement_article();



/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION COMMENTAIRE

   ========================================================================== */



    var load_commentaire = '1';

    function chargement_commentaire(){

        $('#loader_last_comments').show();

        $.ajax({

            url: '../Core/Controller/verification.php?comment=2',

            method: 'POST',

            data: {

                load_commentaire: load_commentaire

            },

            cache: false,

            success:function (data) {

                $('#last_comments').append(data);

                $('#loader_last_comments').hide();

            }

        });

    }

    chargement_commentaire();



    /* ==========================================================================

    SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION COMMENTAIRE BOUTON PLUS DE COMMENTAIRES

       ========================================================================== */



    /*function chargement_more_commentaire(){

        $('#loader_last_comments').show();

        $.ajax({

            url: '../Core/Controller/verification.php?more_comment=1',

            method: 'POST',

            data: {

                load_commentaire: load_commentaire

            },

            cache: false,

            success:function (data) {

                $('#last_comments').append(data);

                $('#loader_last_comments').hide();

            }
        });

    }*/



   /* var more_comment = $('#more_commentaire');

    more_comment.click(function(even){

        even.preventDefault();



        if(more_comment.text()==='Réduire Commentaires'){

            $('#last_comments').append().empty();

            chargement_commentaire();

            more_comment.text('Plus de Commentaires');

        }

        else {

            $('#last_comments').append().empty();

            chargement_more_commentaire();

            more_comment.text('Réduire Commentaires');

        }



    });*/



});







/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES SLIDES DE LA HOME PAGE

   ========================================================================== */

jQuery(document).ready(function ($) {



    var jssor_1_SlideshowTransitions = [

        {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},

        {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}

    ];



    var jssor_1_options = {

        $AutoPlay: 1,

        $SlideshowOptions: {

            $Class: $JssorSlideshowRunner$,

            $Transitions: jssor_1_SlideshowTransitions,

            $TransitionsOrder: 1

        },

        $BulletNavigatorOptions: {

            $Class: $JssorBulletNavigator$

        },

        $ThumbnailNavigatorOptions: {

            $Class: $JssorThumbnailNavigator$,

            $Orientation: 2

        }

    };



    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);



    /*#region responsive code begin*/



    var MAX_WIDTH = 980;



    function ScaleSlider() {

        var containerElement = jssor_1_slider.$Elmt.parentNode;

        var containerWidth = containerElement.clientWidth;



        if (containerWidth) {



            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);



            jssor_1_slider.$ScaleWidth(expectedWidth);

        }

        else {

            window.setTimeout(ScaleSlider, 30);

        }

    }



    ScaleSlider();



    $(window).bind("load", ScaleSlider);

    $(window).bind("resize", ScaleSlider);

    $(window).bind("orientationchange", ScaleSlider);

    /*#endregion responsive code end*/

});





<?php

        if(isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER'])){

            ?>

            $(function(){

                var more_comment = $('#more_commentaire');

                more_comment.click(function(even){

                    even.preventDefault();



                    if(more_comment.text()==='Réduire Commentaires'){

                        $('#last_comments').append().empty();

                        var load_commentaire = '1';



                            $('#loader_last_comments').show();

                            $.ajax({

                                url: '../Core/Controller/verification.php?comment=2',

                                method: 'POST',

                                data: {

                                    load_commentaire: load_commentaire

                                },

                                cache: false,

                                success:function (data) {

                                    $('#last_comments').append(data);

                                    $('#loader_last_comments').hide();

                                }

                            });



                        more_comment.text('Plus de Commentaires');

                    }

                    else {

                        $('#last_comments').append().empty();

                        var load_commentaires = '1';

                        $('#loader_last_comments').show();

                        $.ajax({

                            url: '../Core/Controller/verification.php?more_comment=1',

                            method: 'POST',

                            data: {

                                load_commentaire: load_commentaires

                            },

                            cache: false,

                            success:function (data) {

                                $('#last_comments').append(data);

                                $('#loader_last_comments').hide();

                            }

                        });



                        more_comment.text('Réduire Commentaires');

                    }



                });

            });

       <?php

        }else{

            ?>





//----------------

$(function () {



    var lien = $('#more_commentaire');

    lien.on({

        click: function(even){

            even.preventDefault();

            lien.attr({

                'data-toggle': 'modal',

                'data-target': '#login_1'

            });

        }

    });



    $('#last_comments').on('click', '.lireSuiteCommentaire', function(e){

        e.preventDefault();

        $('#last_comments').attr({

            'data-toggle': 'modal',

            'data-target': '#login_1'

        });

    });



    $('#last_article').on('click', '.homeArticleAside', function(e){

        e.preventDefault();

        $('#last_article').attr({

            'data-toggle': 'modal',

            'data-target': '#login_1'

        });

    });

});

//------------------

       <?php

       }



       } //END $_ENV['id_page'] == 1

           //PORFOLIO id_page=2

        if(isset($_ENV['id_page']) && $_ENV['id_page'] == 2){

          ?>



/* ==========================================================================

SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA PAGE PORFOLIO SECTION FREELANCE

   ========================================================================== */



$(function () {



    var limit = 2;

    var start = 0;

    var action = 'inactive';



    function chargement_data(limit, start){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                limit: limit,

                start: start

            },

            cache: false,

            success:function (data) {

                $('#load_more_data').append(data);

                if(data == ''){

                    $('#load_data_message').html('<div style="display: none;">\n' +

                        '                                    <span class="loader loader-circle"></span>\n' +

                        '                                    Chargement......\n' +

                        '                                </div>');

                    action = 'active';

                }

                else

                {

                    $('#load_data_message').html('<div id="loader_qualification" style="display: block;">\n' +

                        '                                    <span class="loader loader-circle"></span>\n' +

                        '                                    Chargement......\n' +

                        '                                </div>');

                    action = 'inactive';

                }

            }

        });

    }





    if(action === 'inactive')

    {

        action = 'active';

        chargement_data(limit, start);

    }





    $(window).scroll(function () {

        if($(window).scrollTop() + $(window).height() > $('#load_more_data').height() && action==='inactive'){

            action = 'active';

            start = start + limit;

            setTimeout(function () {

                chargement_data(limit, start);

            }, 3000);

        }

    });



    /*





     $('.music').on({

            click:function(e){

                e.preventDefault();

                body.notif({

                    title: 'NGUEA LAROUTE',

                    content: 'ARTISTE FAVORIS',

                    img: 'img/culture/musique/nguea.jpg',

                    cls: 'alert-info'

                });



}

});

     */

    

});

          <?php

        }

            //CONTACT id_page=5

          if(isset($_ENV['id_page']) && $_ENV['id_page'] == 5){

           ?>



/* ==========================================================================

GESTION DU SYSTEME D'ENVOI DE DONNEES DANS LA MENU CONTACT

========================================================================== */

$(function () {



    $('#identite_visitor').keyup(function () {

        identite_visitor();

    });



    $('#email_visitor').keyup(function () {

        email_visitor();

    });



    $('#message_visitor').keyup(function () {

        message_visitor();

    });

    //fonction de verification du Nom en ajax

    function identite_visitor() {

        $.ajax({

            type: 'post',

            url: '../Core/Controller/verification.php?visitor=visitor',

            data: {

                'identite_visitor': $('#identite_visitor').val()

            },

            success: function (data) {

                if(data=='success'){

                    $('#output_identite_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');

                    return true;

                }

                else{

                    $('#output_identite_visitor').css({

                        'color': 'red',

                        'font-weight': 'bold',

                        'margin': 'initial',

                        'padding': 'initial',

                        'font-size': '65%'

                    }).html(data);



                    /* setTimeout(function () {

                         $('#output_visitor').hide();



                     }, 7000);*/

                }

            }

        });





    }





    //fonction de verification du Nom en ajax

    function email_visitor() {

        $.ajax({

            type: 'post',

            url: '../Core/Controller/verification.php?visitor=visitor',

            data: {

                'email_visitor': $('#email_visitor').val()

            },

            success: function (data) {

                if(data=='success'){

                    $('#output_email_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');

                    return true;

                }

                else{

                    $('#output_email_visitor').css({

                        'color': 'red',

                        'font-weight': 'bold',

                        'margin': 'initial',

                        'padding': 'initial',

                        'font-size': '65%'

                    }).html(data);



                    /* setTimeout(function () {

                         $('#output_email_visitor').hide();



                     }, 7000);*/

                }

            }

        });





    }



    //fonction de verification du MESSAGE en ajax

    function message_visitor() {

        $.ajax({

            type: 'post',

            url: '../Core/Controller/verification.php?visitor=visitor',

            data: {

                'message_visitor': $('#message_visitor').val()

            },

            success: function (data) {

                if(data=='success'){

                    $('#output_message_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');

                    return true;

                }

                else{

                    $('#output_message_visitor').css({

                        'color': 'red',

                        'font-weight': 'bold',

                        'margin': 'initial',

                        'padding': 'initial',

                        'font-size': '65%'

                    }).html(data);



                    /* setTimeout(function () {

                         $('#output_message_visitor').hide();



                     }, 7000);*/

                }

            }

        });





    }





    $('#contact_visitor').submit(function () {

        var identite_visitor = $('#identite_visitor').val(), email_visitor = $('#email_visitor').val(), message_visitor = $('#message_visitor').val();





        if (identite_visitor == '' || email_visitor == '' || message_visitor == '') {

            $('body').notif({

                title: 'Message d\'erreur',

                content: 'Veuillez Remplir le Champs !',

                img: 'img/bertin-mounok.png',

                cls: 'error1'

            });

        }

        else {

            var $form = $(this);

            var formdata = (window.FormData) ? new FormData($form[0]) : null;

            var donnee = (formdata !== null) ? formdata : $form.serialize();



            $.ajax({

                type: 'post',

                url: '../Core/Controller/submit.php?visitor=visitor',

                contentType: false, // obligatoire pour de l'upload

                processData: false, // obligatoire pour de l'upload

                data: donnee,

                beforeSend: function () {

                    $('#enreg_visitor').attr('value', 'En cours...');

                    $('#load_data_visitor').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');

                },

                success: function (data) {

                    if(data != 'success'){

                        $('#enreg_visitor').attr('value', 'Envoyer');

                        $('#load_data_visitor').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                        $('body').notif({

                            title: 'Message d\'erreur',

                            content: data,

                            img: 'img/bertin-mounok.png',

                            cls: 'error1'

                        });

                    }

                    else {

                        $('#enreg_visitor').attr('value', 'Envoyer');

                        $('#load_data_visitor').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                        $('body').notif({

                            title: 'Opération Réussie',

                            content: 'Merci de Nous avoir fait Confiance !',

                            img: 'img/bertin-mounok.png',

                            cls: 'success1'

                        });

                        /* setTimeout(function () {

                             $('#output_visitor').fadeOut().hide();



                         }, 7000);*/

                    }

                }



            });



        }





    });







});

          <?php

          }





          //APROPOS id_page=6 && photos=1

          if(isset($_GET['photos']) && $_GET['photos'] == 1){

          ?>



/* ==========================================================================

SYSTEME DE GESTION DES IMAGES SOUS FORME DE PANORAMA SUR LA PAGE APROPOS

   ========================================================================== */

$(window).load(function () {

    $('#wrapper-inner-selection-button').click(function() {

        event.stopPropagation();

        $('#wrapper-inner-selection-button-dropdown').fadeToggle(250);

    });



    $('html').click(function() {

        $('#wrapper-inner-selection-button-dropdown').fadeOut(250);

    });



    $('.wrapper-inner-content-image').each(function() {

        var this_element = $(this);

        this_element.height(this_element.find('img:first-child').height());

        this_element.find('.wrapper-inner-content-image-hover').height(this_element.find('img:first-child').height());

        ;});



    function resize_popup(){

        var window_width = window.innerWidth;

        var window_height = window.innerHeight;

        var max_image_width = window.innerWidth - ((35*2)+(window_width/100*40));

        var max_image_height = window.innerHeight - 200;

        var image_width = $('#fullscreen-image img').width();

        var image_height = $('#fullscreen-image img').height();

        var image_WH_ratio = image_width/image_height;

        var image_HW_ratio = image_height/image_width;

        var image_new_width = max_image_height*image_WH_ratio;

        var image_new_height = max_image_width*image_HW_ratio;



        $('#fullscreen-image').width(max_image_width);

        $('#fullscreen-image').height(max_image_height);



        if(max_image_width > 2 && max_image_height > 2){

            if(image_new_height>max_image_height){





                $('#fullscreen-image img').width(image_new_width);

                $('#fullscreen-image img').height(max_image_height);

                $('#fullscreen-image img').css('margin-top',-max_image_height/2);

                $('#fullscreen-image img').css('margin-left',-image_new_width/2);

            }else{

                $('#fullscreen-image img').width(max_image_width);

                $('#fullscreen-image img').height(image_new_height);

                $('#fullscreen-image img').css('margin-top',-image_new_height/2);

                $('#fullscreen-image img').css('margin-left',-max_image_width/2);

            }

        }

    }





    function open_close_gallery(){



        var this_element = '';



        $('.wrapper-inner-content-image-hover').click(function() {

            $('#fullscreen-image').find('img').remove();

            this_element = $(this);

            this_element.parent().find('img').clone().appendTo('#fullscreen-image');



            $('#fullscreen').show();

            $('#fullscreen').removeClass('fadeOut').addClass('fadeIn');

            $('#fullscreen-image').removeClass('fadeOutDown').addClass('fadeInDown');

            resize_popup();



        });



        $('#fullscreen-inner-close').click(function() {

            $('#fullscreen').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);

            $('#fullscreen-image').removeClass('fadeInDown').addClass('fadeOutDown');

        });



    }



    function next_slide(){

        $('#fullscreen-image img:last-child').insertBefore( $('#fullscreen-image img:first-child') );

    }





    function previous_slide(){

        $('#fullscreen-image img:first-child').insertAfter( $('#fullscreen-image img:last-child') );

    }



    $(document).keydown(function(e) {

        switch(e.which) {

            case 37: // left

                previous_slide();

                break;



            case 38: // up

                next_slide();

                break;



            case 39: // right

                next_slide();

                break;



            case 40: // down

                previous_slide();

                break;



            default: return; // exit this handler for other keys

        }

        e.preventDefault(); // prevent the default action (scroll / move caret)

    });



    resize_popup();

    $( window ).resize(function() {

        resize_popup();

    });

    open_close_gallery();



    $('#fullscreen-inner-right').click(function() {

        next_slide();

    });

    $('#fullscreen-inner-left').click(function() {

        previous_slide();

    });

});



<?php

      }

//CULTURE id_page=4

       if(isset($_ENV['id_page']) && $_ENV['id_page'] == 4){

     ?>

     $(function(){



        /*const  context = new window.AudioContext();

         function playFile(filepath){

             fetch(filepath)

                 .then(response=>response.arrayBuffer());

             data

                 .then(arrayBuffer=>context.decodeAudioData(arrayBuffer))

                 .then(audioBuffer=>{

                 const soundSource = context.createBufferSource();

                 soundSource.buffer = audioBuffer;

                 soundSource.connect(context.destination);

                 soundSource.start();

             });

         }



         let successButton = document.querySelector('#good');

         successButton.addEventListener('click', function(){

             playFile('song/door-6-close.mp3');



             let errorButton = document.querySelector('#bad');

             errorButton.addEventListener('click', function(){

                 playFile();

             });

         });*/







        var body = $('body');



       /* $(document).ready(function () {

             body.notif({

                 title: 'CULTURE',

                 content: 'CE QUE J\'AIME',

                 img: 'img/icons/success-notif.jpg',

                 cls: 'alert-success'

             });

         });*/



        $('.music').on({

            click:function(e){

                e.preventDefault();

                body.notif({

                    title: 'NGUEA LAROUTE',

                    content: 'ARTISTE FAVORIS',

                    img: 'img/culture/musique/nguea.jpg',

                    cls: 'alert-info'

                });

                /*body.notif({

                    title: 'BEN DECCA',

                    content: 'ARTISTE',

                    img: 'img/culture/musique/Ben_Decca.jpg',

                    cls: 'alert-info'

                });*/

            }

        });



        $('.series').on({

             click: function (e) {

                 e.preventDefault();

                 body.notif({

                     title: 'ONE PIECE',

                     content: 'EPISODE 895 VOSTFR HDTV ENCOURS...',

                     img: 'img/culture/series/Luffy_contra_Big_Mom_en_Hope.png',

                     cls: 'alert-info'

                 });



                 body.notif({

                     title: 'SOUTH PARK',

                     content: 'SAISON 22 VOSTFR HDTV ENCOURS...',

                     img: 'img/culture/series/park.jpg',

                     cls: 'alert-info'

                 });



                 body.notif({

                     title: 'THE ORIGINALS',

                     content: 'SAISON 5 VOSTFR HDTV ENCOURS...',

                     img: 'img/culture/series/originals.jpg',

                     cls: 'alert-info'

                 });

             }

     });

         $('.jeux').click(function (e) {

             e.preventDefault();

             body.notif({

                 title: 'ONE PIECE WARRIORS 3',

                 content: 'JEU QUE JE JOUS ACTUELLEMENT',

                 img: 'img/culture/jeux/one_piece.jpg',

                 cls: 'alert-info'

             });

         });



         $('.emissionTV').click(function (e) {

             e.preventDefault();

             body.notif({

                 title: 'EQUINOXE SOIR',

                 content: 'CE QUE JE REGARDES REGULIEREMENT',

                 img: 'img/culture/emission%20tv/equinoxsoir.jpg',

                 cls: 'alert-info'

             });

             body.notif({

                 title: '10-12H LE ZENITH',

                 content: 'CE QUE JE REGARDES SOUVENT',

                 img: 'img/culture/emission%20tv/10-12hzenith.jpg',

                 cls: 'alert-info'

             });

         });



         $('.sport').click(function (e) {

             e.preventDefault();

             body.notif({

                 title: 'FC BAYER MUNICH',

                 content: 'MON EQUIPE PREFERE',

                 img: 'img/culture/sport/bayern.png',

                 cls: 'alert-info'

             });

             body.notif({

                 title: 'THIERRY HENRY',

                 content: 'MON JOUEUR FAVORIS',

                 img: 'img/culture/sport/henry.jpg',

                 cls: 'alert-info'

             });

         });



     });

     <?php

      }

         //BLOG id_page=7

      if(isset($_ENV['id_page']) && $_ENV['id_page'] == 7){



          //SYSTEME D'AUTHENTIFICATION DE TOUS LES LIEN DU BLOG

          if(!isset($_SESSION['ID_USER']) && !isset($_COOKIE['ID_USER'])){

           ?>

$(function () {



    var lien = $('section article a, aside a, .blog-article-1-p-2 a, .papou a, span a, #search_contenu');

    lien.on({

        click: function(even){

            even.preventDefault();

            if(lien.hasClass('link_articles')){

                lien.removeClass('pagination_link link_articles');

                lien.removeAttr('data');



                lien.each(function () {

                    lien.attr({

                        'data-toggle': 'modal',

                        'data-target': '#login_1'

                    });

                });



            }

        },

        focus: function(){

            if(lien.hasClass('link_articles')){

                lien.removeClass('pagination_link link_articles');

                lien.removeAttr('data');



                lien.each(function () {

                    lien.attr({

                        'data-toggle': 'modal',

                        'data-target': '#login_1'

                    });

                });



            }

            $('#search_contenu').prop('disabled', true);

        }



    });

});

          <?php

          }

       ?>



/* ==========================================================================

SYSTEME DE GESTION DES COMMENTAIRES UTILISATEURS DU BLOG

========================================================================== */

$(function(){

    var content_blog = $('#articles');

    content_blog.on('keyup', '#contenuCommentaireUser', function () {

        commentaire();

    });



    //fonction de verification du Commentaire en ajax

    function commentaire() {

        $.ajax({

            type: 'post',

            url: '../Core/Controller/verification.php?commentaire=commentaire',

            data: {

                'contenuCommentaireUser': $('#contenuCommentaireUser').val()

            },

            success: function (data) {

                if(data=='success'){

                    $('.commentaire-error-msg').html('');

                    //  $('.commentaire-error-msg').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');

                    return true;

                }

                else{

                    $('.commentaire-error-msg').css({

                        'font-size': '8px',

                        'margin-top': '-5px',

                        'margin-bottom': '-20px'

                    }).html(data);



                    /* setTimeout(function () {

                         $('#output_message_visitor').hide();



                     }, 7000);*/

                }

            }

        });





    }







    content_blog.on('submit', '#commentaire_user', function () {

        var contentComments = $('#contenuCommentaireUser').val();





        if (contentComments == '') {

            $('body').notif({

                title: 'Message d\'erreur',

                content: 'Veuillez Remplir le Champs Commentaire !',

                img: 'img/icons/error-notif.png',

                cls: 'error1'

            });

        }

        else {

            var $form = $(this);

            var formdata = (window.FormData) ? new FormData($form[0]) : null;

            var donnee = (formdata !== null) ? formdata : $form.serialize();



            $.ajax({

                type: 'post',

                url: '../Core/Controller/submit.php?commentaire=commentaire',

                contentType: false, // obligatoire pour de l'upload

                processData: false, // obligatoire pour de l'upload

                data: donnee,

                beforeSend: function () {

                    /*var $timer = setInterval(function () {

                        load_comments();

                    }, 1000);*/

                    load_comments();

                    $('#enreg_commentaires').attr('value', 'En cours...');

                    $('.commentaire-error-msg').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');

                },

                success: function (data) {

                    if(data != 'success'){

                        $('#enreg_commentaires').attr('value', 'Envoyer');

                        $('.commentaire-error-msg').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                        $('body').notif({

                            title: 'Message d\'erreur',

                            content: data,

                            img: 'img/icons/error-notif.png',

                            cls: 'error1'

                        });

                    }

                    else {

                        $('#enreg_commentaires').attr('value', 'Envoyer');

                        $('.commentaire-error-msg').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                        $('body').notif({

                            title: 'Opération Réussie',

                            content: 'Merci de Nous avoir fait Confiance !',

                            img: 'img/icons/success-notif.jpg',

                            cls: 'success1'

                        });

                        load_comments();

                        //clearInterval($timer);

                        // $('#contenuCommentaireUser').val("");

                        /* setTimeout(function () {

                             $('#output_visitor').fadeOut().hide();



                         }, 7000);*/

                        // load_comments();



                        // load_comments();

                    }



                    /*$timer = setInterval(function () {

                        load_comments();

                    }, 3000);*/

                }



            });



        }





    });









    //SYSTEME D AFFICHAGE DES MESSAGES INSTANTANEES

    function load_comments(vue_commentaires = ''){

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'post',

            data: {vue_commentaires: vue_commentaires},

            dataType: 'json',

            success: function (data) {

                $('.commentaires-liste').html(data.notifOnComments).delay(1000).fadeIn();



                /* if (data.unseen_notification > 0) {

                     $('.count').html(data.unseen_notification);

                 }*/





            }/*,

            error: function(data){

                console.log(data.unseen_notification);

            }*/

        });

    }



    //capture l'id du commentaire apres un click sur le bouton repondre du blog

    content_blog.on('click', '.commentaire-wrapper a', function (e) {

        e.preventDefault();

        var id_commentaire = $(this).attr('data');

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'GET',

            data: {

                id_comment: eval(id_commentaire)

            },

            dataType: 'text',

            success:function (data) {

            return true;

            },

            error: function(){

                console.log('Erreur de Chargement de l\'id du commentaire créé dynamiquement dans le bouton repondre du blog');

            }

        });

    });



//REPONSES DES COMMENTAIRES UTILISATEURS

    var I, reponse_comment_content;

    content_blog.on('keyup', '.commentaire-reponses form textarea', function () {

        I = $(this).attr('data');

        reponse_comment_content = $('#reponse_commentaire_contenu' + I).val();

        reponse_commentaire();

        });



        function reponse_commentaire() {

            $.ajax({

                type: 'POST',

                url: '../Core/Controller/verification.php',

                data: {

                    'reponse_commentaire_contenu': reponse_comment_content

                },

                success: function (data) {

                    if(data=='success'){

                        $('.commentaire-error-msg-reponse').html('');

                        return true;

                    }

                    else{

                        $('.commentaire-error-msg-reponse').css({

                            'font-size': '8px',

                            'margin-top': '-5px',

                            'margin-bottom': '-20px'

                        }).html(data);

                    }

                }

            });

        }





    content_blog.on('submit', '.commentaire-reponses form', function () {

            if (reponse_comment_content === '') {

                $('body').notif({

                    title: 'Message d\'erreur',

                    content: 'Veuillez Remplir le Champs vide !',

                    img: 'img/icons/error-notif.png',

                    cls: 'error1'

                });

            }

            else {

                // On encode le message pour faire passer les caractères spéciaux comme +

                var message = encodeURIComponent(reponse_comment_content);

                $.ajax({

                    type: 'POST',

                    url: '../Core/Controller/submit.php?reponse_commentaires=reponse_commentaires',

                    data: "message="+message,

                    beforeSend: function () {

                        $('#enreg_reponse_commentaires' + I).attr('value', 'En cours...');

                        $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');

                    },

                    success: function (data) {

                        if(data != 'success'){

                            $('#enreg_reponse_commentaires' + I).attr('value', 'Envoyer');

                            $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                            $('body').notif({

                                title: 'Message d\'erreur',

                                content: data,

                                img: 'img/icons/error-notif.png',

                                cls: 'error1'

                            });

                        }



                        else {

                            //clearInterval($timer);

                            $('#enreg_reponse_commentaires' + I).attr('value', 'Envoyer');

                            $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');



                            $('body').notif({

                                title: 'Opération Réussie',

                                content: 'Merci de Nous avoir fait Confiance !',

                                img: 'img/icons/success-notif.jpg',

                                cls: 'success1'

                            });

                            load_comments();

                            reponse_comment_content.val("");

                        }

                    }



                });



            }





        });







    /* ==========================================================================

GESTION DU SYSTEME DE RECHERCHE INSTANTANE SUR LE BLOG

========================================================================== */

    $('#search_contenu').keyup(function () {

        search();

    });



    //fonction de verification du Nom en ajax

    function search() {

        var contenu =  $('#search_contenu').val();

        var retour = '';

        $.ajax({

            type: 'GET',

            url: '../Core/Controller/verification.php',

            data: {

                'search_contenu': contenu

            },

            dataType: 'json',

            success: function (data) {

                if(data.resultat=='Aucun'){

                    $('#output_search').css({

                        'font-weight': 'bold',

                        'margin': 'initial',

                        'padding': 'initial',

                        'font-size': '65%'

                    }).html('Aucun résultat trouvé');

                    content_blog.empty();

                    /*setTimeout(function () {

                        $('#output_search').hide();



                    }, 7000);*/

                }

                else

                {

                    if(data.compteur <= 1)

                        retour += data.compteur + ' résultat trouvé';

                    else

                        retour += data.compteur + ' résultats trouvés';



                    content_blog.html(data.resultat);

                    $('#output_search').css({

                        'font-weight': 'bold',

                        'margin': 'initial',

                        'padding': 'initial',

                        'font-size': '65%'

                    }).html(retour);



                }



            }

        });



    }





    //chargement dynamique des Articles

    content_blog.on('click', '.link_articles', function (e) {

        e.preventDefault();

        var content = $(this).attr('data');

        var tab = content.split('&');

        eval(tab[0]);

        if(articles==='')

            return;

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                articles_click: articles

            },

            dataType: 'text',

            beforeSend: function () {

                $('.loader_blog').show();

            },

            success:function (data) {

                content_blog.html(data);

                $('.loader_blog').hide();

            },

            error: function(){

                console.log('Erreur de Chargement des Articles');

            },

            complete: function () {

                $('.loader_blog').hide();

                load_comments();

            }

        });



    });



    //chargement dynamique des Catégories

    $('.categorie').on('click', function (e) {

        e.preventDefault();

        var content = $(this).attr('data');

        var tab = content.split('&');

        eval(tab[0]);

        if(cat==='')

            return;

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                categorie: cat

            },

            dataType: 'text',

            beforeSend: function () {

                $('.loader_blog').show();

            },

            success:function (data) {

                content_blog.html(data);

            },

            error: function(data){

                console.log('Erreur de Chargement des Catégories');

            },

            complete: function (data) {

                $('.loader_blog').hide();

            }

        });



    });



    //chargement dynamique des Archives

    $('.archive').click(function (e) {

        e.preventDefault();

        var content = $(this).attr('data');

        var tab = content.split('&');

        eval(tab[0]);

        eval(tab[1]);

        if(mois==='' || annee==='')

            return;

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                m: mois,

                y: annee

            },

            dataType: 'text',

            beforeSend: function () {

                $('.loader_blog').show();

            },

            success:function (data) {

                content_blog.html(data);

            },

            error: function(data){

                console.log('Erreur de Chargement des Archives');

            },

            complete: function (data) {

                $('.loader_blog').hide();

            }

        });



    });





    //chargement dynamique de la Pagination

    $('.pagination_link').on('click', function (e) {

        e.preventDefault();

        var content = $(this).attr('data');

        var tab = content.split('&');

        eval(tab[0]);

        eval(tab[1]);

        if(pages==='' || MessagesParPage==='')

            return;

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                pagination: pages,

                nbre_Article: MessagesParPage

            },

            dataType: 'text',

            beforeSend: function () {

                $('.loader_blog').show();

            },

            success:function (data) {

                content_blog.html(data);

            },

            error: function(data){

                console.log('Erreur de Chargement des Paginations');

            },

            complete: function (data) {

                $('.loader_blog').hide();

            }

        });



    });



    //EVENEMENT SUR LES ELEMENTS CREES DYNAMIQUE(CATEGORIES, ARCHIVES, PAGINATION) AVEC L UTILISATION DES DELEGATES DE JQUERY

    content_blog.on('click','.link_articles' , function (e) {

        e.preventDefault();

        var content = $(this).attr('data');

        var tab = content.split('&');

        eval(tab[0]);

        if(articles==='')

            return;

        $.ajax({

            url: '../Core/Controller/verification.php',

            method: 'POST',

            data: {

                articles_click: articles

            },

            dataType: 'text',

            beforeSend: function () {

                $('.loader_blog').show();

            },

            success:function (data) {

                content_blog.html(data);

            },

            error: function(data){

                console.log('Erreur de Chargement des éléments créé dynamiquement');

            },

            complete: function (data) {

                $('.loader_blog').hide();

            }

        });

    });



//fermeture jquery

});

      <?php

      }

      if($_ENV['id_page']==10 || $_ENV['id_page']==11 || $_ENV['id_page']==12){

          ?>

          $(function () {



              // id_page=11 Apps_Web

              //choix entre entreprise et particulier

              $('input[type=checkbox][name=onoffswitch]').change(function(){

                  if(this.checked) {

                      $('input[type=checkbox][name=onoffswitch]').addClass('check');

                      $('#form_entreprise').removeClass('collapse').delay(500).fadeOut();

                      $('#form_particulier').addClass('collapse').delay(500).fadeIn();

                  }

                  else {

                      $('input[type=checkbox][name=onoffswitch]').removeClass('check');

                      $('#form_entreprise').addClass('collapse').delay(500).fadeIn();

                      $('#form_particulier').removeClass('collapse').delay(500).fadeOut();

                  }

              });



              //Click sur le bouton ajout dans la liste de fonctionnalités dispo(Apps_web id_page=11)

              $('#tabdynamique').on('click', '.addElementTab', function (e) {

                  e.preventDefault();

                  var content = $(this).attr('data');

                  var part = content.split('&');

                  eval(part[0]);

                  if(AddServ==='')

                      return;

                  $.ajax({

                      url: '../Core/Controller/verification.php',

                      method: 'POST',

                      data: {

                          id_module_admin: AddServ

                      },

                      dataType: 'text',

                      success:function (data) {

                          if(data!=='success'){

                              $('body').notif({

                                  title: 'Erreur Survenue',

                                  content: data,

                                  img: 'img/icons/error-notif.png',

                                  cls: 'error1'

                              });

                          }else{

                              $('body').notif({

                                  title: 'Opération Réussie',

                                  content: 'Element Ajouté avec Success',

                                  img: 'img/icons/success-notif.jpg',

                                  cls: 'success1'

                              });

                              refresh_Tableau_Client(eval(part[1]));

                          }

                      },

                      error: function(){

                          console.log('Erreur d\'ajout du module par le client');

                      }

                  });

              });



              //Click sur le bouton Supprimer dans la liste de fonctionnalités dispo(Apps_web id_page=11)

              $('.tab1').on('click', '.delElementTab', function (e) {

                  e.preventDefault();

                  var content = $(this).attr('data');

                  var part = content.split('&');

                  eval(part[0]);

                  if(del==='')

                      return;

                  $.ajax({

                      url: '../Core/Controller/verification.php',

                      method: 'POST',

                      data: {

                          id_module_client: del

                      },

                      dataType: 'text',

                      success:function (data) {

                          if(data!=='success'){

                              $('body').notif({

                                  title: 'Erreur Survenue',

                                  content: data,

                                  img: 'img/icons/error-notif.png',

                                  cls: 'error1'

                              });

                          }else{

                              $('body').notif({

                                  title: 'Opération Réussie',

                                  content: 'Element Supprimé avec Success',

                                  img: 'img/icons/success-notif.jpg',

                                  cls: 'success1'

                              });

                              refresh_Tableau_Client(eval(part[1]));

                          }

                      },

                      error: function(){

                          console.log('Erreur de Suppression du module par le client');

                      }

                  });

              });



              var list_cat = $('#list_cat_mod_cli');

              list_cat.change(function () {

                  $.ajax({

                      url: '../Core/Controller/verification.php',

                      method: 'POST',

                      data: {

                          list_cat_mod: list_cat.val(),

                          id_service: list_cat.attr('data')

                      },

                      dataType: 'text',

                      success:function (data) {

                          $('.tab1').html(data);

                      },

                      error: function(){

                          console.log('Erreur survenue lors du filtre de la categorie par le client');

                      }

                  });

              });





              //AFFICHAGE COMPLET SOUS FORME DE REFRESH DU TABELAU CLIENT JUSTE APRES AJOUT D'UN NOUVEAU MODULE

              function refresh_Tableau_Client (id_service) {

                  $.ajax({

                      url: '../Core/Controller/verification.php',

                      method: 'POST',

                      data: {

                          actualisation_client: 'refresh',

                          service: id_service

                      },

                      dataType: 'text',

                      success:function (data) {

                          $('.tab1').html(data);

                      },

                      error: function(){

                          console.log('Erreur survenue lors de l\'actualisation des données');

                      }

                  });

              }



              //SYSTEME DE GENERATION DU DEVIS APRES CLIQUE SUR UN BOUTON

              var form_devis = $('#form_devis');

              var id_serv = form_devis.attr('data');



              form_devis.click('submit', function () {



                  if($('input[type=checkbox][name=onoffswitch]').hasClass('check')){



                      if($('#activiteParticulier').val()==='' || $('#telParticulier').val()===''){

                          $('body').notif({

                              title: 'Erreur Survenue',

                              content: 'Un ou plusieurs Champs sont Vides',

                              img: 'img/icons/error-notif.png',

                              cls: 'error1'

                          });

                      }else{

                          $.ajax({

                              url: '../Core/Controller/verification.php?devisParticulier=1',

                              method: 'POST',

                              data: {

                                  statut_social: 'particulier',

                                  activiteP: $('#activiteParticulier').val(),

                                  villeP: $('#villeParticulier').val(),

                                  telP: $('#telParticulier').val()

                              },

                              dataType: 'text',

                              beforeSend:function(){

                              $('#form_devis').attr('value', 'Génération Encours....');

                              },

                              success:function (data) {

                                  if(data!=='success'){

                                      $('body').notif({

                                          title: 'Erreur Survenue',

                                          content: data,

                                          img: 'img/icons/error-notif.png',

                                          cls: 'error1'

                                      });

                                  }else{

                                      $('body').notif({

                                          title: 'Génération Effectué avec Success',

                                          content: 'Un Email vous a été envoyé avec votre Dévis',

                                          img: 'img/icons/success-notif.jpg',

                                          cls: 'alert-info'

                                      });


                                      setTimeout(function () {

                                          /*$('body').load('../Pages/Services/generation_devis.php?service=' + id_serv, function() {

                                          });*/

                                          location.href='../Pages/Services/generation_devis.php?service=' + id_serv;

                                          $('#form_devis').attr('value', 'Génération Terminé');

                                      }, 6000);

                                  }

                              },

                              error: function(){

                                  console.log('Erreur de génération du devis par le client');

                              },

                              complete:function(){



                                  setTimeout(function () {

                                      $('#form_devis').attr('value', 'Générer Votre Dévis');

                                      refresh_Tableau_Client(id_serv);

                                  }, 10000);





                                  //refresh_Tableau_Client (id_service);

                              }

                          });



                      }



                  }else{



                      if($('#nomEntreprise').val()==='' || $('#activiteEntreprise').val()==='' || $('#bpEntreprise').val()===''

                          || $('#telEntreprise').val()==='' || $('#EmailEntreprise').val()==='' || $('#sitewebEntreprise').val()===''){

                          $('body').notif({

                              title: 'Erreur Survenue',

                              content: 'Un ou plusieurs Champs sont Vides',

                              img: 'img/icons/error-notif.png',

                              cls: 'error1'

                          });

                      }else{

                          $.ajax({

                              url: '../Core/Controller/verification.php?devisEntreprise=2',

                              method: 'POST',

                              data: {

                                  statut_social: 'entreprise',

                                  nomE: $('#nomEntreprise').val(),

                                  activiteE: $('#activiteEntreprise').val(),

                                  bpE: $('#bpEntreprise').val(),

                                  villeE: $('#villeEntreprise').val(),

                                  telE: $('#telEntreprise').val(),

                                  emailE: $('#EmailEntreprise').val(),

                                  siteE: $('#sitewebEntreprise').val()

                              },

                              dataType: 'text',

                              beforeSend:function(){

                                  $('#form_devis').attr('value', 'Génération Encours....');

                              },

                              success:function (data) {

                                  if(data!=='success'){

                                      $('body').notif({

                                          title: 'Erreur Survenue',

                                          content: data,

                                          img: 'img/icons/error-notif.png',

                                          cls: 'error1'

                                      });

                                  }else{

                                      $('body').notif({

                                          title: 'Génération Effectué avec Success',

                                          content: 'Un Email vous a été envoyé avec votre Dévis',

                                          img: 'img/icons/success-notif.jpg',

                                          cls: 'success1'

                                      });

                                      setTimeout(function () {

                                          location.href='../Pages/Services/generation_devis.php?service=' + id_serv;

                                          $('#form_devis').attr('value', 'Génération Terminé');

                                      }, 6000);

                                  }

                              },

                              error: function(){

                                  console.log('Erreur de génération du devis par le client');

                              },

                              complete:function(){



                                  setTimeout(function () {

                                      $('#form_devis').attr('value', 'Générer Votre Dévis');

                                      refresh_Tableau_Client(id_serv);

                                      }, 10000);

                              }

                          });



                      }

                  }





              });



          });

<?php

      }



?>

</script>





<!-- Global site tag (gtag.js) - Google Analytics (PERMET D'AVOIR LES STATISTIQUES SUR LE SITE WEB)-->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136685527-1"></script>

<script>

    window.dataLayer = window.dataLayer || [];

    function gtag(){dataLayer.push(arguments);}

    gtag('js', new Date());

    gtag('config', 'UA-136685527-1');

</script>



<!--<script src="../Public/js/wow.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.9/wow.min.js"></script>





<!--<script src="../Public/js/mustache.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>





<!-- MDB core JavaScript -->

<!--<script src="../Public/js/mdb.min.js"></script>-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>





<!--<script src="../Public/js/fonctions.js"></script>-->

<script src="../Public/js/fonctions.min.js"></script>

<?php
if(isset($_ENV['id_page']) && $_ENV['id_page'] != 7){
	?>
	<!-- Bouton de partage -->
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5d28acfa07f9ac0012ebd81a&product=sticky-share-buttons' async='async'></script>
	<?php
}
?>




