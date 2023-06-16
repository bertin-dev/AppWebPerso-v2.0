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
    <title>Administration || Entreprise</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="../css/bootstrap.css" rel="stylesheet">-->
    <link href="../Public/css/design.css" rel="stylesheet">
    <link href="../Public/css/simple-sidebar.css" rel="stylesheet">
   <link href="style.css" rel="stylesheet">

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
    <?php require ('Sidebar.php');?>
    <!-- /#sidebar-wrapper  style="position: absolute; left: 26%;"-->

    <section>
        <article>
            <button id="menu-toggle" class="action-button" type="button" title="DEROULER LE MENU">MENU</button>
            <button id="entreprise" class="action-button" type="button" title="TABLEAU DE BORD ENTREPRISE"><a href="tableau_entreprise.php">TABLEAU DE BORD ENTREPRISE</a></button>
        </article>
    </section>

    <form id="msform" class="msformE" method="post" onsubmit="return false;" accept-charset="UTF-8" enctype="multipart/form-data">

        <ul id="progressbar">
            <li class="active">ENTREPRISE</li>
            <li>FONCTION OCCUPEE</li>
            <li>OUTILS</li>
            <li>CAPTURE DES TRAVAUX</li>
            <span id="statutE" style="color: red; z-index: 999999;"> Veuillez-remplir tous les champs</span>
        </ul>


        <fieldset>

            <h2 class="fs-title">ENTREPRISE</h2>
            <h3 class="fs-subtitle">Etape 1</h3>
            <?php
            $enregistrement = new Contact($_POST);
            echo $enregistrement->input('date','dateE', '', '', 'dateE');
            echo $enregistrement->select('typeService', 'typeService');
            echo $enregistrement->input('text','entreprise', 'ENTREPRISE', '', 'entreprise1', 'output_checkEntreprise');
            echo $enregistrement->input('text','activite', 'ACTIVITE', '', 'activite', 'output_checkActivite');
            echo $enregistrement->input('text','ville', 'VILLE', '', 'ville', 'output_checkVille');
            ?>
            <input type="button" class="next action-button" value="SUIVANT" title="Cliquez Suivant" name="next">
        </fieldset>

        <fieldset>
            <h2 class="fs-title">FONCTION OCCUPEE</h2>
            <h3 class="fs-subtitle">Etape 2</h3>
            <?php
            echo $enregistrement->input('text','section', 'SECTION', '', 'section', 'output_checkSection');
            echo $enregistrement->input('text','matricule', 'MATRICULE', '', 'matricule', 'output_checkMatricule');
            echo $enregistrement->input('text','poste', 'POSTE-OCCUPE', '', 'poste', 'output_checkPost');
            echo $enregistrement->textarea('travaux','TRAVAUX', 'travaux', 'output_checkTravaux', '');
            echo '<small>Délimiteur(-)</small><br>';
            ?>
            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input type="button" class="next action-button" value="SUIVANT" title="suivant" name="next">
        </fieldset>



        <fieldset>
            <h2 class="fs-title">OUTILS</h2>
            <h3 class="fs-subtitle">Etape 3</h3>
            <?php
            echo '<div style="float: left; width: 50%; margin">';
            echo $enregistrement->input('text','app_dev', 'APPS-DEVELOPPE', '', 'app_dev', 'output_checkappdev');
            echo $enregistrement->input('text','type_app', 'TYPE APP', '', 'type_app', 'output_checktype_app');
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
            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input type="button" class="next action-button" value="SUIVANT" title="suivant" name="next">
        </fieldset>


        <fieldset>
            <h2 class="fs-title">IMPORTATION</h2>
            <h3 class="fs-subtitle">Etape 4 - Fin</h3>
            <?php
            echo $enregistrement->input('text','deploiement', 'DEPLOIEMENT', '', 'deploiement', 'output_checkDeploiement');
            echo $enregistrement->input('text','taille', 'TAILLE MO', '', 'taille', 'output_checkTaille');
            echo $enregistrement->textarea('detail','Détails-Fontionnalités', 'detail', 'output_checkfonctionnalites', '');
            echo '<small>Délimiteur(-)</small>';
            echo $enregistrement->input('file','capture[]', 'Screenshot', 'multiple', 'capture', 'output_checkcapture');
            ?>
            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input id="enregE" type="submit" class="submit action-button" value="ENVOYER" title="submit">
        </fieldset>
    </form>

</div>

<!-- /#wrapper -->

<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>
<script src="../Public/js/jquery.easing.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<script src="../Public/js/check_formulaire_entreprise.js"></script>

<script src="traitement.js"></script>



</body>

</html>




