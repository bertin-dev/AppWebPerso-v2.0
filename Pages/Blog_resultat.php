<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 16/02/2019
 * Time: 04h41
 */
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Encodage des caractères -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Insère les mots-clés extraits de la BD dans les meta -->
    <meta name="keywords" lang="fr" content="Bertin.dev, Apropos de moi, Informaticien, Programmeur, Consultant informatique, developpeur peur ">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="apres avoir appri sur internet, quoi de plus normal de partager mes connaissances � mon tour">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">
    <meta name="copyright" content="© 2018, bertin.dev, Inc">
    <!--Programme ou système ayant généré le contenu. Ne doit pas être utilisé si le document est conçu « à la main ».-->
    <!--<meta name="generator" content="PhpStorm 2018.1.4">-->

    <!-- rafraichi la page web apres chaque 60 secondes -->
    <!-- <meta http-equiv="Refresh" content="60">-->

    <!-- Redirection vers une autre URL au bout de 60 secondes -->
    <!--<meta http-equiv="refresh" content="60;url=http://www.blup.fr" />-->

    <!-- Pour une application web seulement -->
    <meta name="Application-Web-Portfolio" content="Mes Réalisations">

    <!-- Insère le titre extrait de la DB dans la balise correspondante -->
    <title>Blog | Bertin Mounok</title>

    <!-- Bootstrap Core CSS -->
    <link href="../Public/css/bootstrap.css" rel="stylesheet">
    <link href="../Public/css/design.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../Public/css/scrolling-nav.css" rel="stylesheet">
    <link href="../Public/css/bertin.dev.css" rel="stylesheet">

    <!-- Icon and Animate Core CSS -->
    <link href="../Public/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Public/css/animate.min.css" rel="stylesheet">

    <!-- Icône du site (favicon) -->
    <link rel="icon" type="image/png" href="../Public/img/bertin-mounok.png">

    <!-- Fil RSS du site -->
    <!--<link rel="alternate" type="application/rss+xml" title="News de mon site" href="news.xml" />-->

    <!-- Page d'aide du site -->
    <!--<link rel="help" title="Politique d'accessibilité" href="accessibilite.html" />-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<section id="blog" class="blog-section">
        <?php
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            echo '<div id="blog-list"></div>';
        }
        ?>


</section>


<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.js"></script>

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





        /* ==========================================================================
    GESTION DU SYSTEME DE RECHERCHE INSTANTANE SUR LE BLOG
    ========================================================================== */
        $('#search_contenu').keyup(function () {
            search();
        });

        //fonction de verification du Nom en ajax
        function search() {
            $.ajax({
                type: 'GET',
                url: '../Core/Controller/verification.php?search=search',
                data: {
                    'search_contenu': $('#search_contenu').val()
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

                        /*setTimeout(function () {
                            $('#output_search').hide();

                        }, 7000);*/
                    }
                    else
                    {
                        //$('#output_search').empty();
                        $('#blog-list').load('../Pages/Blog_resultat.php?id=1', function() {
                            $('#blog-list').html(data.resultat);
                        });
                        $('#output_search').css({
                            'font-weight': 'bold',
                            'margin': 'initial',
                            'padding': 'initial',
                            'font-size': '65%'
                        }).html(data.compteur + ' résultats trouvés');

                    }

                }
            });

        }


    });
</script>



<!-- Other file JavaScript
<script src="../Public/js/fonctions.js"></script>-->




</body>
</html>