<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 04/03/2019
 * Time: 19h14
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
    <title>Config_Page || SERVICES</title>

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
                <div class="col-lg-12">

                    <h1 class="text-center" style="margin-bottom: 50px;"><u>CONFIGURATION DES PAGES</u></h1>


                       <!-- Bloc Agenda-->
                    <div class="col-lg-5">
                        <h1>BLOC AGENDA</h1>
                        <div id="agendaRapport" class="alert alert-danger" style="display:none;"></div>

                        <form id="program_annuel" action="traitement.php?agenda=agenda" method="post">
                            <div class="form-group">
                                <label>AGENDA ANNUEL <b>*</b></label>
                                <input type="text" name="addMsgAgenda" class="form-control" required="" placeholder="Programme">
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="debut">DEBUT <b>*</b></label>
                                    <input id="debut" type="datetime-local" name="addDAgenda" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fin">FIN <b>*</b></label>
                                    <input id="fin" type="datetime-local" name="addFAgenda" class="form-control" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <img src="images/ajax-loader.gif" class="agendaUploads" style="display:none;">
                                <input type="submit" class="form-control" value="AJOUTER UN PROGRAMME">
                            </div>
                        </form>
                        <div style="margin-bottom: 150px;"></div>

                        <h1>BLOC IMAGES</h1>
                        <div id="imgRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="img" action="traitement.php?img=img" method="post">
                            <div class="form-group col-lg-6">
                                <label for="numPageImg">PAGE CORRESPONDANTE <b>*</b></label>
                                <select style="background-color: white;" id="numPageImg" name="numPage" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_page, titre FROM page 
                                                                                          INNER JOIN headers 
                                                                                          ON page.ref_id_headers=headers.id_headers 
                                                                                          WHERE id_page <=7') AS $cat):
                                        echo '<option value="'.$cat->id_page.'">'.utf8_encode($cat->titre).'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>


                            <div class="form-group col-lg-6">
                                <label for="destinationImg">LIEU DE DESTINATION <b>*</b></label>
                                <select style="background-color: white;" id="destinationImg" name="destinationImg" class="form-control">
                                    <option value="Extreme Haut">Extrême Haut</option>
                                    <option value="Haut">Haut</option>
                                    <option value="Milieu">Milieu</option>
                                    <option value="Bas">Bas</option>
                                    <option value="Extreme Bas">Extrême Bas</option>
                                    <option value="Gauche">Gauche</option>
                                    <option value="Extreme Gauche">Extrême Gauche</option>
                                    <option value="Droit">Droit</option>
                                    <option value="Extreme Droit">Extrême Droit</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>TITRE <b>*</b></label>
                                <input type="text" name="titreImg" class="form-control" required="" placeholder="TITRE">
                            </div>

                            <div class="form-group">
                                <label>DESCRIPTION <b>*</b></label>
                                <textarea name="descriptionImg" class="form-control" title="Description">Entrez votre Description</textarea>
                            </div>


                            <div class="form-group">
                                <label for="blocImg">IMAGE <b>*</b></label>
                                <input type="file" name="blocImg" class="form-control" id="blocImg">
                            </div>

                            <div class="form-group">
                                <img src="images/ajax-loader.gif" class="imgUploads" style="display:none;">
                                <input type="submit" class="form-control" value="AJOUTEZ UNE IMAGE">
                            </div>
                        </form>


                    </div>

                    <div class="col-lg-4"  style="border-left: 2px solid white; border-right: 2px solid white;">
                        <h2>BLOC ACTIVITE ENCOURS...</h2>
                        <div id="activiteRapport" class="alert alert-danger" style="display:none;"></div>
                        <form id="activite" method="post" action="traitement.php?activite=activite">

                            <div class="form-group">
                                <label>TITRE <b>*</b></label>
                                <input type="text" name="titreActivite" class="form-control" required="required" placeholder="Entrez votre Titre" value="<?php if(isset($_POST['titreActivite'])){echo $_POST['titreActivite'];}?>">
                            </div>


                            <div class="form-group">
                                <label>DESCRIPTION <b>*</b></label>
                                <textarea name="descriptionActtivite" class="form-control" title="Description" placeholder="Entrez votre Description"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT ACTIVITE">
                                <img src="images/ajax-loader.gif" class="activiteUploads" style="display:none;">
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



