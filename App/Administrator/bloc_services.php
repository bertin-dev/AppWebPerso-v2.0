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
    <meta name="keywords" lang="fr" content="CV, Developpeur, Professionnel, Startup, Programmeur, Analyste, Geek, CEO, Curriculm Vitae">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo, Supers-Pipo, bertin.dev, Ngando Mounok Hugues Bertin">

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
    <?php require ('Sidebar.php');?>
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
    <h1><small>BLOC</small> SERVICES</h1>
    <div id="servicesDispoRapport" class="alert alert-danger" style="display:none;"></div>
    <form id="servicesDispo" action="traitement.php?servicesDispo=servicesDispo" method="post">
        <div class="form-group">
            <label>SERVICES <b>*</b></label>
            <input type="text" name="addServicesDispo" class="form-control" required="" placeholder="Ex: Projet de Conception d'Applications Web"><br>
            <input type="text" name="addDescriptionServicesDispo" class="form-control" required="" placeholder="DESCRIPTION">
        </div>
        <div class="form-group">
            <img src="images/ajax-loader.gif" class="servicesDispoUploads" style="display:none;">
            <input type="submit" class="form-control" value="AJOUT SERVICES">
        </div>
    </form>

<div style="margin-bottom: 100px;"></div>
    <h1><small>BLOC</small> CATEGORIE D'OUTILS</h1>
    <div id="cat_outils_TechRapport" class="alert alert-danger" style="display:none;"></div>
    <form id="cat_outils_Tech" action="traitement.php?cat_outils_Tech=cat_outils_Tech" method="post" style="border-top: 2px dashed white; padding-top: 20px;">

        <div class="form-group">
            <label>CATEGORIES D' OUTILS TECHNIQUES <b>*</b></label>
            <input type="text" name="addCat_outils_Tech" class="form-control" required="" placeholder="Ex: FRAMEWORK, CMS"><br>
            <input type="text" name="addDescriptionCat_outils_Tech" class="form-control" required="" placeholder="DESCRIPTION">
        </div>

        <div class="form-group">
            <img src="images/ajax-loader.gif" class="cat_outils_TechUploads" style="display:none;">
            <input type="submit" class="form-control" value="AJOUT CATEGORIE OUTILS TECHNIQUES">
        </div>
    </form>

    <div style="margin-bottom: 100px;"></div>
    <h1><small>BLOC</small> CATEGORIE DE SOLUTIONS</h1>
    <div id="cat_solutionRapport" class="alert alert-danger" style="display:none;"></div>
    <form id="cat_solution" action="traitement.php?cat_solution=cat_solution" method="post" style="border-top: 2px dashed white; padding-top: 20px;">

        <div class="form-group">
            <label>CATEGORIES DE SOLUTIONS <b>*</b></label>
            <input type="text" name="addCat_solution" class="form-control" required="" placeholder="Ex: ERP, CRM"><br>
            <input type="text" name="addDescriptionCat_solution" class="form-control" required="" placeholder="DESCRIPTION">
        </div>

        <div class="form-group">
            <img src="images/ajax-loader.gif" class="cat_solutionUploads" style="display:none;">
            <input type="submit" class="form-control" value="AJOUT CATEGORIE SOLUTION">
        </div>
    </form>


</div>
                    <div class="col-lg-6"  style="border-left: 2px solid white; border-right: 2px solid white;">

                        <div id="outils_TechRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="outils_Technique" method="post" action="traitement.php?outils_Tech=outils_Tech">
                            <div class="form-group">
                                <label for="list_servicesDispo">LISTE DES SERVICES <b>*</b></label>
                                <select style="background-color: white;" id="list_servicesDispo" name="list_servicesDispo" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_services, libelle FROM services ORDER BY id_services DESC') AS $cat):
                                        echo '<option value="'.$cat->id_services.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="list_cat_outils_tech">LISTE DES CATEGORIES D' OUTILS TECHNIQUES <b>*</b></label>
                                <select style="background-color: white;" id="list_cat_outils_tech" name="list_cat_outils_tech" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_outils_tech, libelle FROM cat_outils_tech ORDER BY id_outils_tech DESC') AS $cat):
                                        echo '<option value="'.$cat->id_outils_tech.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="addNomOutils_tech">OUTILS TECHNIQUE <b>*</b></label>
                                <input type="text" id="addNomOutils_tech" name="addNomOutils_tech" class="form-control" required="required" placeholder="Ex: LARAVEL, WORDPRESS" value="<?php if(isset($_POST['titreService'])){echo $_POST['titreService'];}?>">
                            </div>


                            <div class="form-group">
                                <label>DESCRIPTION <b>*</b></label>
                                <textarea name="addDescriptionOutils_tech" class="form-control" title="Description" placeholder="Entrez votre Description"></textarea>
                            </div>

                            <div class="form-group">
                                    <label>VERSION <b>*</b></label>
                                    <input type="text" name="addVersionOutils_tech" class="form-control" required="required" placeholder="Entrez la version de Techno" value="<?php if(isset($_POST['prixServices'])){echo $_POST['prixServices'];}?>">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT OUTILS TECHNIQUES">
                                <img src="images/ajax-loader.gif" class="outils_TechUploads" style="display:none;">
                            </div>
                        </form>

                        <br>
                        <br>

                        <h1><small>BLOC</small> MODULE ADMIN COMMUN</h1>
                        <div id="moduleTechCommunRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="moduleTechCommun" action="traitement.php?moduleTechCommun=moduleTechCommun" method="post" style="border-top: 2px dashed white; padding-top: 20px;">
                            <div class="form-group">
                                <label for="list_TechCommun">OUTILS TECHNIQUES <b>*</b></label>
                                <select style="background-color: white;" id="list_TechCommun" name="list_TechCommun" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_outils, libelle FROM outils_technique ORDER BY id_outils DESC') AS $cat):
                                        echo '<option value="'.$cat->id_outils.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="list_ModuleCommun">MODULE ADMIN <b>*</b></label>
                                <select style="background-color: white;" id="list_ModuleCommun" name="list_ModuleCommun" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_module_admin, libelle FROM module_admin ORDER BY id_module_admin DESC') AS $cat):
                                        echo '<option value="'.$cat->id_module_admin.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT MODULE COMMUN">
                                <img src="images/ajax-loader.gif" class="moduleTechCommunUploads" style="display:none;">
                            </div>
                        </form>

                        <br>
                        <br>

                        <!---------------->
                        <h1><small>BLOC</small> SOLUTION</h1>
                        <div id="solutionRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="solution" method="post" action="traitement.php?solution=solution">

                            <div class="form-group">
                                <label for="list_catModuleClient">CATEGORIE DE SOLUTIONS <b>*</b></label>
                                <select style="background-color: white;" id="list_catSolution" name="list_catSolution" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_cat_solution, intitule FROM categorie_solution ORDER BY id_cat_solution DESC') AS $cat):
                                        echo '<option value="'.$cat->id_cat_solution.'">'.$cat->intitule.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="addTitreSolution">TITRE <b>*</b></label>
                                <input type="text" id="addTitreSolution" name="addTitreSolution" class="form-control" required="required" placeholder="Ex: Gestion commerciale" value="<?php if(isset($_POST['addTitreSolution'])){echo $_POST['addTitreSolution'];}?>">
                            </div>


                            <div class="form-group">
                                <label for="addDescriptionSolution">DESCRIPTION <b>*</b></label>
                                <textarea id="addDescriptionSolution" name="addDescriptionSolution" class="form-control" title="Description" placeholder="Entrez votre Description"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT SOLUTION">
                                <img src="images/ajax-loader.gif" class="solutionUploads" style="display:none;">
                            </div>


                        </form>
                        <!-------------->


                    </div>



                    <div class="col-lg-3">
                        <!---------------->
                        <h1><small>BLOC</small> MODULE ADMINISTRATEUR</h1>
                        <div id="moduleAdminRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="moduleAdmin" method="post" action="traitement.php?moduleAdmin=moduleAdmin">

                            <div class="form-group">
                                <label for="list_catModuleClient">LISTE DE CATEGORIE MODULE  <b>*</b></label>
                                <select style="background-color: white;" id="list_catModuleClient" name="list_catModuleClient" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_cat_module_client, libelle FROM cat_module_client ORDER BY id_cat_module_client DESC') AS $cat):
                                        echo '<option value="'.$cat->id_cat_module_client.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="addTitreModuleAdmin">TITRE <b>*</b></label>
                                <input type="text" id="addTitreModuleAdmin" name="addTitreModuleAdmin" class="form-control" required="required" placeholder="Ex: Newsletter, Compteur de Visiteur" value="<?php if(isset($_POST['titreService'])){echo $_POST['titreService'];}?>">
                            </div>


                            <div class="form-group">
                                <label for="addDescriptionModuleAdmin">DESCRIPTION <b>*</b></label>
                                <textarea id="addDescriptionModuleAdmin" name="addDescriptionModuleAdmin" class="form-control" title="Description" placeholder="Entrez votre Description"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="addEstimationModuleAdmin">ESTIMATION FINANCIERE <b>*</b></label>
                                    <input id="addEstimationModuleAdmin" type="number" name="addEstimationModuleAdmin" class="form-control" required="required" placeholder="Entrez votre Estimation" value="<?php if(isset($_POST['prixServices'])){echo $_POST['prixServices'];}?>">
                                </div>
                                <div class="col-lg-6">
                                    <label for="addUnitesModuleAdmin">UNITES <b>*</b></label>
                                    <select style="background-color: white;" id="addUnitesModuleAdmin" name="addUnitesModuleAdmin" class="form-control">
                                        <option value="FCFA">FCFA</option>
                                        <option value="DOLLAR">DOLLAR</option>
                                        <option value="EURO">EURO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT MODULE ADMIN">
                                <img src="images/ajax-loader.gif" class="moduleAdminUploads" style="display:none;">
                            </div>


                        </form>
                        <!-------------->


                        <div style="margin-top: 150px;"></div>
                        <h1><small>BLOC</small> CATEGORIE MODULE CLIENT</h1>
                        <div id="catModuleClientRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="catModuleClient" action="traitement.php?catModuleClient=catModuleClient" method="post" style="border-top: 2px dashed white;">
                            <div class="form-group">
                                <label for="addcatModuleClient">TITRE <b>*</b></label>
                                <input id="addcatModuleClient" type="text" name="addcatModuleClient" class="form-control" required="" placeholder="Ex: Maintenance, Fonctionnalités">
                            </div>
                            <div class="form-group">
                                <img src="images/ajax-loader.gif" class="catModuleClientUploads" style="display:none;">
                                <input type="submit" class="form-control" value="AJOUTE CATEGORIE MODULE CLIENT">
                            </div>
                        </form>
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
</body>

</html>


