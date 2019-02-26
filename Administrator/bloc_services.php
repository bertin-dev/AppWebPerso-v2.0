<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 23/02/2019
 * Time: 08h24
 */

require '../App/Config/Config_Server.php';


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
<html lang="fr">

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
    <title>Administration || SERVICES</title>

    <!-- Bootstrap Core CSS -->
    <link href="../Public/css/bootstrap.css" rel="stylesheet">
    <link href="../Public/css/design.css" rel="stylesheet">
    <link href="../Public/css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../Public/css/scrolling-nav.css" rel="stylesheet">

    <!-- Icône du site (favicon) -->
    <link rel="icon" type="image/png" href="../Public/img/bertin-mounok.png"/>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a href="#">TABLEAU DE BORD</a>
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
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>


        </ul>
    </div>
    <!-- /#sidebar-wrapper -->




    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1">
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a>
                </div>
                <div class="col-lg-11">

                    <h1 class="text-center" style="margin-bottom: 50px;"><u>SERVICES DISPONIBLES</u></h1>



<div class="col-lg-3">
    <div id="ModelsRapport" class="alert alert-danger" style="display:none;"></div>

    <form id="models" action="traitement.php?models=models" method="post">
        <div class="form-group">
            <label>MODELES DE SERVICES <b>*</b></label>
            <input type="text" name="addModels" class="form-control" required="" placeholder="MODELES">
        </div>
        <div class="form-group">
            <img src="images/ajax-loader.gif" class="modelsUploads" style="display:none;">
            <input type="submit" class="form-control" value="AJOUTER MODELS">
        </div>
    </form>

<div style="margin-bottom: 100px;"></div>
    <div id="cat_servicesRapport" class="alert alert-danger" style="display:none;"></div>
    <form id="cat_services" action="traitement.php?cat_services=cat_services" method="post" style="border-top: 2px dashed white; padding-top: 20px;">

        <div class="form-group">
            <label>CATEGORIES DE SERVICES <b>*</b></label>
            <input type="text" name="addCat_services" class="form-control" required="" placeholder="CATEGORIE">
        </div>

        <div class="form-group">
            <img src="images/ajax-loader.gif" class="cat_servicesUploads" style="display:none;">
            <input type="submit" class="form-control" value="AJOUT CATEGORIE SERVICES">
        </div>
    </form>

</div>
                    <div class="col-lg-6"  style="border-left: 2px solid white; border-right: 2px solid white;">
                        <div id="servicesRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="services" method="post" action="traitement.php?services=services">
                            <div class="form-group">
                                <label>LISTING TYPE FONCTIONNALITES <b>*</b></label>
                                <select style="background-color: white;" id="fonctionnality" name="fonctionnality" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_typeF, libelle FROM type_fonctionnalite ORDER BY id_typeF DESC') AS $cat):
                                        echo '<option value="'.$cat->id_typeF.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>LISTE DE MODELES <b>*</b></label>
                                <select style="background-color: white;" id="cat_services_models" name="cat_services_models" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_model, libelle FROM model ORDER BY id_model DESC') AS $cat):
                                        echo '<option value="'.$cat->id_model.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>LISTE DE CATEGORIES SERVICES <b>*</b></label>
                                <select style="background-color: white;" id="bloc_services" name="bloc_services" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_cat_serv, libelle FROM categorie_services ORDER BY id_cat_serv DESC') AS $cat):
                                        echo '<option value="'.$cat->id_cat_serv.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>TITRE <b>*</b></label>
                                <input type="text" name="titreServices" class="form-control" required="required" placeholder="Entrez votre Titre" value="<?php if(isset($_POST['titreService'])){echo $_POST['titreService'];}?>">
                            </div>


                            <div class="form-group">
                                <label>DESCRIPTION <b>*</b></label>
                                <textarea name="descriptionServices" class="form-control" title="Description">Entrez votre Description</textarea>
                            </div>

                            <div class="form-group">
                            <div class="col-lg-6">
                                <label>ESTIMATION FINANCIERE <b>*</b></label>
                                <input type="number" name="prixServices" class="form-control" required="required" placeholder="Entrez votre Estimation" value="<?php if(isset($_POST['prixServices'])){echo $_POST['prixServices'];}?>">
                            </div>
                                <div class="col-lg-6">
                                    <label>UNITES <b>*</b></label>
                                    <select style="background-color: white;" id="unites_services" name="unites_services" class="form-control">
                                        <option value="FCFA">FCFA</option>
                                        <option value="DOLLAR">DOLLAR</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT SERVICE">
                                <img src="images/ajax-loader.gif" class="servicesUploads" style="display:none;">
                            </div>


                        </form>
                    </div>



                    <div class="col-lg-3">
                        <div id="typeFRapport" class="alert alert-danger" style="display:none;"></div>

                        <form id="typeFonctionnalites" action="traitement.php?typeF=typeF" method="post">
                            <div class="form-group">
                                <label>TYPE DE FONCTIONNALITES <b>*</b></label>
                                <input type="text" name="addTypeF" class="form-control" required="" placeholder="TYPE DE FONCTIONNALITES">
                            </div>
                            <div class="form-group">
                                <img src="images/ajax-loader.gif" class="typeFUploads" style="display:none;">
                                <input type="submit" class="form-control" value="AJOUTER TYPE FONCTIONNALITES">
                            </div>
                        </form>

                        <div style="margin-bottom: 100px;"></div>
                       <!-- <div id="fonctionnaliteRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="fonctionnalites" action="traitement.php?fonctionnalites=fonctionnalites" method="post" style="border-top: 2px dashed white; padding-top: 20px;">
                            <div class="form-group">
                                <label>FONCTIONNALITES <b>*</b></label>
                                <input type="text" name="addfonctionnalites" class="form-control" required="" placeholder="CATEGORIE">
                            </div>

                            <div class="form-group">
                                <img src="images/ajax-loader.gif" class="fonctionnalitesUploads" style="display:none;">
                                <input type="submit" class="form-control" value="AJOUT FONCTIONNALITE">
                            </div>
                        </form>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->



</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<script src="traitement.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>


