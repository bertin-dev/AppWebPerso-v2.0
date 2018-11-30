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
         SELECT * FROM page
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
                <a href="#">ENTREPRISE</a>
            </li>
            <li>
                <a href="freelance.php">FREELANCE</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper  style="position: absolute; left: 26%;"-->

    <section>
        <article>
            <button id="menu-toggle" class="action-button" type="button" title="DEROULER LE MENU">MENU</button>
        </article>
    </section>

    <form id="msform" method="post" action="../Core/Controller/verification.php?entreprise=entreprise" accept-charset="UTF-8" enctype="multipart/form-data">

        <ul id="progressbar">
            <li class="active">ENTREPRISE</li>
            <li>FONCTION OCCUPEE</li>
            <li>OUTILS</li>
            <li>CAPTURE DES TRAVAUX</li>
        </ul>


        <fieldset>

            <h2 class="fs-title">ENTREPRISE</h2>
            <h3 class="fs-subtitle">Etape 1</h3>
            <?php
            $enregistrement = new Contact($_POST);
            echo $enregistrement->input('date','dateE');
            echo $enregistrement->select('typeService');
            echo $enregistrement->input('text','entreprise', 'ENTREPRISE');
            echo $enregistrement->input('text','activite', 'ACTIVITE');
            echo $enregistrement->input('text','ville', 'VILLE');
            ?>
            <input type="button" class="next action-button" value="SUIVANT" title="Cliquez Suivant" name="next">

        </fieldset>






        <fieldset>
            <h2 class="fs-title">FONCTION OCCUPEE</h2>
            <h3 class="fs-subtitle">Etape 2</h3>
            <?php
            echo $enregistrement->input('text','section', 'SECTION');
            echo $enregistrement->input('text','matricule', 'MATRICULE');
            echo $enregistrement->input('text','poste', 'POSTE-OCCUPE');
            echo $enregistrement->textarea('travaux','TRAVAUX');
            ?>

            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input type="button" class="next action-button" value="SUIVANT" title="suivant" name="next">
        </fieldset>



        <fieldset>
            <h2 class="fs-title">OUTILS</h2>
            <h3 class="fs-subtitle">Etape 3</h3>
            <?php
            echo '<div style="float: left; width: 50%; margin">';
            echo $enregistrement->input('text','app_dev', 'APPS-DEVELOPPE');
            echo $enregistrement->input('text','type_app', 'TYPE APP');
            echo $enregistrement->input('text','architecture', 'ARCHITECTURE');
            echo $enregistrement->input('text','analyse', 'METHODE-ANALYSE');
            echo $enregistrement->input('text','ide', 'IDE');
            echo '</div>';

            echo '<div style="float: left; width: 50%;">';
            echo $enregistrement->input('text','langage', 'LANGAGE');
            echo $enregistrement->input('text','sgbd', 'SGBD');
            echo $enregistrement->input('text','outils', 'OUTILS');
            echo $enregistrement->input('text','framework', 'FRAMEWORK');
            echo $enregistrement->input('url','url', 'URL');
            echo '</div>';
            ?>
            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input type="button" class="next action-button" value="SUIVANT" title="suivant" name="next">
        </fieldset>


        <fieldset>

            <h2 class="fs-title">IMPORTATION</h2>
            <h3 class="fs-subtitle">Etape 4 - Fin</h3>
            <?php
            echo $enregistrement->textarea('detail','Détails-Fontionnalités');
            echo $enregistrement->input('file','capture', 'Screenshot', 'multiple');
            ?>
            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
            <input type="submit" class="submit action-button" value="ENVOYER" title="submit" name="submit">
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

<script src="../Public/js/fonctions.js"></script>

</body>

</html>




