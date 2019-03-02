<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 07/03/2018
 * Time: 01h19
 */
?>
<?php

require '../Core/Controller/Contact.class.php';
require '../App/Config/Config_Server.php';
use \Core\Controller\Contact;


// Extrait les informations correspondantes à la page en cours de la DB
foreach(\App::getDB()->query('
         SELECT * FROM headers 
         INNER JOIN page
         ON headers.id_headers=page.ref_id_headers
         WHERE id_page=1') as $con):
    $_ENV['logo'] = $con->logo;
    $_ENV['titre'] = $con->titre;
endforeach;
?>


<!DOCTYPE html>
<html lang="fr_en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Insère les mots-clés extraits de la DB dans les meta -->
    <meta name="keywords" lang="fr" content="">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo, Supers-Pipo">

    <!-- Insère le titre extrait de la DB dans la balise correspondante -->
    <title>Administration || Freelance</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="../css/bootstrap.css" rel="stylesheet">-->
    <link href="../Public/css/design.css" rel="stylesheet">
    <link href="../Public/css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <!--<link href="style.css" rel="stylesheet">-->

    <!-- Custom CSS-->
    <!--<link href="../css/scrolling-nav.css" rel="stylesheet">-->

    <!-- Icône du site (favicon) -->
    <link rel="icon" type="image/png" href="../Public/img/bertin-mounok.png"/>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<style>
    .{margin: 0; padding: 0;}

    html{
        height: 100%;
        background: url();
        background: linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)),
        url();
    }

    body{
        font-family: Miramonte, Arial, Verdana ;
    }
</style>


</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">

                <a class="navbar-brand page-scroll" href="#page-top">
                    <img style="float: left; width: 50px; position: relative; top: -15px;" class="img-rounded"
                         alt="Bertin-Mounok" src="../Public/<?=$_ENV['logo']; ?>" title="Logo Bertin-Mounok"/>
                    <span title="Bertin Mounok" style="font-size: 9px; position: relative; top: 17px;">Bertin Mounok</span>
                </a>

            </li>
            <li>
                <a href="index.php">TABLEAU DE BORD</a>
            </li>
            <li>
                <a href="entreprise.php">ENTREPRISE</a>
            </li>
            <li>
                <a href="freelance.php">FREELANCE</a>
            </li>
            <li>
                <a href="blog.php">BLOG</a>
            </li>

            <li>
                <a href="bloc_services.php">SERVICES</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper  style="position: absolute; left: 26%;"-->

<section>
    <article>
    <button id="menu-toggle" class="action-button" type="button" title="DEROULER LE MENU">MENU</button>
    </article>

</section>



                <form id="msform" method="post" onsubmit="return false;" accept-charset="UTF-8" enctype="multipart/form-data">

                    <ul id="progressbar">
                        <li class="active">SERVICE</li>
                        <li>ACTIVITE</li>
                        <li>FONCTIONNALITES</li>
                        <li>CAPTURE DES TRAVAUX</li>
                        <span id="statut" style="color: red; z-index: 999999;"> Veuillez-remplir tous les champs</span>
                    </ul>


                    <fieldset>

                        <h2 class="fs-title">SERVICE</h2>
                        <h3 class="fs-subtitle">Etape 1</h3>
                        <?php
                        $enregistrement = new Contact($_POST);
                        echo $enregistrement->input('date','dateF', '', '', 'dateF');
                        echo $enregistrement->select('typeServiceF', 'typeService');
                        echo $enregistrement->input('text','entiteF', 'ENTITE', '', 'entite', 'output_checkentite');
                        ?>
                        <input id="next0" type="button" class="next action-button" value="SUIVANT" title="Cliquez Suivant" name="next0">

                    </fieldset>






                    <fieldset>
                        <h2 class="fs-title">ACTIVITE</h2>
                        <h3 class="fs-subtitle">Etape 2</h3>
                        <?php
                        echo $enregistrement->input('text','valeurEntite', 'VALEUR-ENTITE', '', 'valeurEntite', 'output_checkvaleur');
                        echo $enregistrement->input('text','activiteF', 'ACTIVITE', '', 'activite', 'output_checkactivite');
                        echo $enregistrement->input('text','ville', 'VILLE', '', 'ville', 'output_checkville');
                        echo $enregistrement->textarea('travaux','TRAVAUX', 'travaux', 'output_checktravaux');
                        ?>

                        <input id="previous0" type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous0">
                        <input id="next1" type="button" class="next action-button" value="SUIVANT" title="suivant" name="next1">
                    </fieldset>



                    <fieldset>
                        <h2 class="fs-title">FONCTIONNALITES</h2>
                        <h3 class="fs-subtitle">Etape 3</h3>
                        <?php
                        echo '<div style="float: left; width: 50%; margin">';
                        echo $enregistrement->input('text','app_dev', 'APPS-DEVELOPPE', '', 'app_dev', 'output_checkappdev');
                        echo $enregistrement->input('text','type_app', 'TYPE-APP', '', 'type_app', 'output_checktype_app');
                        echo $enregistrement->input('text','architecture', 'ARCHITECTURE', '', 'architecture', 'output_checkarchitecture');
                        echo $enregistrement->input('text','analyse', 'METHODE-ANALYSE', '', 'analyse', 'output_checkanalyse');
                        echo $enregistrement->input('text','ide', 'IDE', '', 'ide', 'output_checkide');
                        echo '</div>';

                        echo '<div style="float: left; width: 50%;">';
                        echo $enregistrement->input('text','langage', 'LANGAGE', '', 'langage', 'output_checklangage');
                        echo $enregistrement->input('text','sgbd', 'SGBD', '', 'sgbd', 'output_checksgbd');
                        echo $enregistrement->input('text','outils', 'OUTILS', '', 'outils', 'output_checkoutils');
                        echo $enregistrement->input('text','framework', 'FRAMEWORK', '', 'framework', 'output_checkframework');
                        echo $enregistrement->input('url','url', 'URL', '', 'url', 'output_checkurl');
                        echo '</div>';
                        ?>
                        <input id="previous1" type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous1">
                        <input id="next2" type="button" class="next action-button" value="SUIVANT" title="suivant" name="next2">
                    </fieldset>


                    <fieldset>

                        <h2 class="fs-title">IMPORTATION</h2>
                        <h3 class="fs-subtitle">Etape 4 - Fin</h3>
                        <?php
                        echo $enregistrement->textarea('fonctionnalites','Détails-Fonctionnalités', 'fonctionnalites', 'output_checkfonctionnalites');
                        echo $enregistrement->input('file','capture[]', 'Screenshot', 'multiple', 'capture', 'output_checkcapture');
                        ?>
                        <input id="previous2" type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous2">
                        <input id="enreg" type="submit" class="submit action-button" value="ENVOYER" title="submit">

                    </fieldset>
                </form>




</div>

<!-- /#wrapper -->

<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>
<script src="../Public/js/jquery.easing.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script src="../Public/js/check_formulaire.js"></script>
<script src="traitement.js"></script>






</body>

</html>




