<?php session_start();
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 04/02/2019
 * Time: 07h01
 */
?>

<?php

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
    <title>Administration</title>

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

                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a>

                <div class="col-lg-12">

                    <h1 class="text-center" style="margin-bottom: 50px;"><u>ADMINISTRATION DU FORUM</u></h1>



<div class="col-lg-3">
    <div id="categorieRapport" class="alert alert-danger" style="display:none;"></div>
                    <form id="categorie" action="traitement.php?categorie=categorie" method="post">
                        <div class="form-group">
                            <label>AJOUT DES CATEGORIES <b>*</b></label>
                        <input type="text" name="addCategorie" class="form-control" required="" placeholder="CATEGORIE">
                        </div>
                        <div class="form-group">
                            <img src="images/ajax-loader.gif" class="categorieUploads" style="display:none;">
                        <input type="submit" class="form-control" value="AJOUTER">
                        </div>
                    </form>
</div>


                    <div class="col-lg-9"  style="border-left: 2px solid white;">
                        <div id="blogRapport" class="alert alert-danger" style="display:none;"></div>
                    <form id="blog" method="post" action="traitement.php?blog=blog" enctype="multipart/form-data">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>TITRE <b>*</b></label>
                                <input type="text" id="blogTitre" name="blogTitre" class="form-control" required="required" placeholder="Entrez votre Titre" value="<?php if(isset($_POST['blogTitre'])){echo $_POST['blogTitre'];}?>">
                            </div>


                            <div class="form-group">
                                <label>PARAGRAPHE <b>*</b></label>
                                <textarea name="blogParagraphe" id="blogParagraphe" class="form-control" title="paragraphe">Entrez votre Paragraphe</textarea>
                            </div>

                            <div class="form-group">
                                <input id="blogEnvoi" type="submit" class="btn btn-primary btn-lg" required="" value="AJOUT SUJET">
                                <img src="images/ajax-loader.gif" class="blogUploads" style="display:none;">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>CATEGORIES <b>*</b></label>
                                <select style="background-color: white;" id="blogCategorie" name="blogCategorie" class="form-control">
                                <?php
                                foreach (App::getDB()->query('SELECT id_categorie, libelle FROM categorie ORDER BY id_categorie DESC') AS $cat):
                                    echo '<option value="'.$cat->id_categorie.'">'.$cat->libelle.'</option>';
                                endforeach;
                                ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>IMAGE <b>*</b></label>
                                <input type="file" name="blogImage" class="form-control" id="picture_file">
                            </div>

                            <div class="form-group">
                                <?php
                               foreach (App::getDB()->query('SELECT id_blog FROM blog') AS $blog):
                                echo '<input type="hidden" name="id_blog" value="'.$blog->id_blog.'">';
                               endforeach;
                                ?>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
                <!--AJOUT D UN TWEET-->
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


