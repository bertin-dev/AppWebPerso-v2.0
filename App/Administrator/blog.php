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
    <link href="wysibb/default/wbbtheme.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" />-->

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
                <?php
                if(isset($_GET['modifCategorie'])){
                foreach (App::getDB()->query('SELECT * FROM categorie WHERE id_categorie='.$_GET['modifCategorie']) AS $categorie):
                ?>
                <article class="col-lg-offset-3">
                    <h1>MODIFICATION D'UNE CATEGORIE</h1>
                    <form method="post" accept-charset="UTF-8" action="traitement.php">
                        <input type="hidden" name="modif_categorie" value="<?=$categorie->id_categorie;?>">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="libelle">LIBELLE</label>
                                <select style="background-color: white;" id="libelle" name="libelle" class="form-control">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_categorie, libelle FROM categorie ORDER BY id_categorie DESC') AS $cat):
                                        echo '<option value="'.$cat->libelle.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                                <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                            </div>
                        </div>
                    </form>
                </article>

                <?php
                endforeach;
                }

                else if(isset($_GET['modifCommentaire'])){
                    foreach (App::getDB()->query('SELECT * FROM comments WHERE id_commentaires='.$_GET['modifCommentaire']) AS $comment):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION D'UN COMMENTAIRE</h1>
                            <form method="post" accept-charset="UTF-8" action="traitement.php">
                                <input type="hidden" name="modif_commentaire" value="<?=$comment->id_commentaires;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="commentaire">COMMENTAIRE</label>
                                        <input id="commentaire" type="text" name="commentaire" placeholder="COMMENTAIRE" class="form-control" value="<?=$comment->commentaires;?>">
                                        <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                                    </div>
                                </div>
                            </form>
                        </article>

                    <?php
                    endforeach;
                }

                else if(isset($_GET['modifFeedback'])){
                    foreach (App::getDB()->query('SELECT * FROM feedback_comments WHERE id_feedback='.$_GET['modifFeedback']) AS $feedback):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION D'UNE REACTION SUR UN COMMENTAIRE</h1>
                            <form method="post" accept-charset="UTF-8" action="traitement.php">
                                <input type="hidden" name="modif_reaction" value="<?=$feedback->id_feedback;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="reaction">REACTION</label>
                                        <input id="reaction" type="text" name="reaction" placeholder="REACTION" class="form-control" value="<?=$feedback->reactions_commentaires;?>">
                                        <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                                    </div>
                                </div>
                            </form>
                        </article>

                    <?php
                    endforeach;
                }

                else if(isset($_GET['modifArticle'])){
                    foreach (App::getDB()->query('SELECT * FROM sujets WHERE id_sujet='.$_GET['modifArticle']) AS $article):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION D'UN ARTICLE</h1>
                            <form method="post" accept-charset="UTF-8" action="traitement.php" enctype="multipart/form-data">
                                <input type="hidden" name="modif_article" value="<?=$article->id_sujet;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="titre">TITRE</label>
                                        <input id="titre" type="text" name="titre" placeholder="TITRE" class="form-control" value="<?=$article->titre;?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="paragraphe">PARAGRAPHE</label>
                                        <textarea id="paragraphe" name="paragraphe" placeholder="PARAGRAPHE" class="form-control"><?=$article->paragraphe;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="mot_cles">MOTS CLES</label>
                                        <input id="mot_cles" type="text" name="mot_cles" placeholder="MOTS CLES" class="form-control" value="<?=$article->mot_cles;?>">
                                    <small>Séparer chaque mot par un (;) point virgule.</small>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="imageArticle">IMAGE ARTICEL</label>
                                        <input type="file" id="imageArticle" name="imageArticle" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12"><input type="submit" value="Envoyer"></div>
                                </div>
                            </form>
                        </article>

                    <?php
                    endforeach;
                }
                else {

                    if (isset($_GET['suppCategorie'])) {
                        App::getDB()->delete('DELETE FROM categorie WHERE id_categorie=:categorie', ['categorie' => $_GET['suppCategorie']]);
                    }

                    if (isset($_GET['suppCommentaire'])) {
                        App::getDB()->delete('DELETE FROM comments WHERE id_commentaires=:commentaire', ['commentaire' => $_GET['suppCommentaire']]);
                    }

                    if (isset($_GET['suppFeedback'])) {
                        App::getDB()->delete('DELETE FROM feedback_comments WHERE id_feedback=:feedback', ['feedback' => $_GET['suppFeedback']]);
                    }

                    if (isset($_GET['suppArticle'])) {
                        App::getDB()->delete('DELETE FROM sujets WHERE id_sujet=:article', ['article' => $_GET['suppArticle']]);
                    }
                    ?>
                    <div class="col-lg-12">

                        <h1 class="text-center" style="margin-bottom: 50px;"><u>ADMINISTRATION DU FORUM</u></h1>


                        <div class="col-lg-2" style="padding: initial">
                            <div id="categorieRapport" class="alert alert-danger" style="display:none;"></div>
                            <form id="categorie" action="traitement.php?categorie=categorie" method="post">
                                <div class="form-group">
                                    <label>AJOUT DES CATEGORIES <b>*</b></label>
                                    <input type="text" name="addCategorie" class="form-control" required=""
                                           placeholder="CATEGORIE">
                                </div>
                                <div class="form-group">
                                    <img src="images/ajax-loader.gif" class="categorieUploads" style="display:none;">
                                    <input type="submit" class="form-control" value="AJOUTER">
                                </div>
                            </form>
                        </div>


                        <div class="col-lg-10" style="border-left: 2px solid white;">
                            <div id="blogRapport" class="alert alert-danger" style="display:none;"></div>
                            <form id="blog" method="post" action="traitement.php?blog=blog"
                                  enctype="multipart/form-data">
                                <div class="col-sm-9">

                                    <div class="form-group">
                                        <label>TITRE <b>*</b></label>
                                        <input type="text" id="blogTitre" name="blogTitre" class="form-control"
                                               required="required" placeholder="Entrez votre Titre"
                                               value="<?php if (isset($_POST['blogTitre'])) {
                                                   echo $_POST['blogTitre'];
                                               } ?>">
                                    </div>


                                    <div class="form-group" style="color: black;">
                                        <label style="color: white">PARAGRAPHE <b>*</b></label>
                                        <textarea name="blogParagraphe" id="blogParagraphe"
                                                   title="paragraphe" placeholder="Entrez votre paragraphe"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>AJOUT DES MOTS CLES <b>*</b></label>
                                        <input type="text" name="addkeyWord" class="form-control" required=""
                                               placeholder="AJOUT DES MOTS CLES">
                                    </div>
                                    <div class="form-group">
                                        <h6>
                                            <small>Séparer chaque mot par un (;) point virgule.</small>
                                        </h6>
                                    </div>

                                    <div class="form-group">
                                        <input id="blogEnvoi" type="submit" class="btn btn-primary btn-lg" required=""
                                               value="AJOUT SUJET">
                                        <img src="images/ajax-loader.gif" class="blogUploads" style="display:none;">
                                    </div>
                                </div>

                                <div class="col-sm-3" style="padding: initial;">
                                    <div class="form-group">
                                        <label>CATEGORIES <b>*</b></label>
                                        <select style="background-color: white;" id="blogCategorie" name="blogCategorie"
                                                class="form-control">
                                            <?php
                                            foreach (App::getDB()->query('SELECT id_categorie, libelle FROM categorie ORDER BY id_categorie DESC') AS $cat):
                                                echo '<option value="' . $cat->id_categorie . '">' . $cat->libelle . '</option>';
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
                                            echo '<input type="hidden" name="id_blog" value="' . $blog->id_blog . '">';
                                        endforeach;
                                        ?>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: 25px">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading"
                                 style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                LISTE DES COMMENTAIRES
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="30%">ARTICLE</th>
                                            <th width="15%">COMMENTE</th>
                                            <th width="30%">COMMENTAIRE</th>
                                            <th width="5%">DATE_AJOUT</th>
                                            <th width="5%">DATE_MODIF</th>
                                            <th width="5%">MODIFIER</th>
                                            <th width="5%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM comments
                                                                                     INNER JOIN sujets
                                                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                                                     INNER JOIN compte
                                                                                     on comments.ref_id_compte=compte.id_compte             
                                                                                     ORDER BY id_commentaires DESC') AS $commentaire):
                                            echo '<tr>
                                                        <td title="ID">' . $commentaire->id_commentaires . '</td> 
                                                        <td title="ARTICLE">' . $commentaire->titre . '</td> 
                                                        <td title="COMMENTE PAR:">' . $commentaire->prenom . ' ' . $commentaire->nom . '</td> 
                                                        <td title="COMMENTAIRE">' . $commentaire->commentaires . '</td> 
                                                        <td title="DATE_AJOUT">' . date('d/m/Y H:i;s', $commentaire->data_ajout_commentaires) . '</td> 
                                                        <td title="DATE_MODIF">' . date('d/m/Y H:i;s', $commentaire->date_modif_commentaires) . '</td> 
                                                        <td title="MODIFIER"><a href="blog.php?modifCommentaire=' . $commentaire->id_commentaires . '">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="blog.php?suppCommentaire=' . $commentaire->id_commentaires . '">SUPPRIMER</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
                                        </tbody>
                                        <!---------------------------------------------------------------------------------------------------------------------------------->
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: 25px">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading"
                                 style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                LISTE DES REACTIONS AUX COMMENTAIRES
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="30%">COMMENTAIRE</th>
                                            <th width="15%">COMMENTE</th>
                                            <th width="30%">REACTIONS</th>
                                            <th width="5%">DATE_AJOUT</th>
                                            <th width="5%">DATE_MODIF</th>
                                            <th width="5%">MODIFIER</th>
                                            <th width="5%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM feedback_comments
                                                                                     INNER JOIN comments
                                                                                     ON feedback_comments.ref_id_commentaires=comments.id_commentaires
                                                                                     INNER JOIN compte
                                                                                     on feedback_comments.ref_id_compte=compte.id_compte             
                                                                                     ORDER BY id_feedback DESC') AS $reaction):
                                            echo '<tr>
                                                        <td title="ID">' . $reaction->id_feedback . '</td> 
                                                        <td title="COMMENTAIRE">' . $reaction->commentaires . '</td> 
                                                        <td title="COMMENTE PAR:">' . $reaction->prenom . ' ' . $reaction->nom . '</td> 
                                                        <td title="REACTIONS">' . $reaction->reactions_commentaires . '</td> 
                                                        <td title="DATE_AJOUT">' . date('d/m/Y H:i;s', $reaction->date_ajout_react) . '</td> 
                                                        <td title="DATE_MODIF">' . date('d/m/Y H:i;s', $reaction->date_modif_react) . '</td> 
                                                        <td title="MODIFIER"><a href="blog.php?modifFeedback=' . $reaction->id_feedback . '">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="blog.php?suppFeedback=' . $reaction->id_feedback . '">SUPPRIMER</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
                                        </tbody>
                                        <!---------------------------------------------------------------------------------------------------------------------------------->
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: 25px">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading"
                                 style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                LISTE DES ARTICLES PUBLIES
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="4%">ID</th>
                                            <th width="5%">POSTE</th>
                                            <th width="5%">CATEGORIE</th>
                                            <th width="20%">TITRE</th>
                                            <th width="40%">PARAGRAPHE</th>
                                            <th width="2%">MOT_CLES</th>
                                            <th width="5%">IMAGES</th>
                                            <th width="5%">DATE_ENREG</th>
                                            <th width="5%">DATE_MODIF</th>
                                            <th width="3%">MODIFIER</th>
                                            <th width="3%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT id_sujet, prenom, libelle, titre, paragraphe, mot_cles, image,
                                                                                   sujets.date_enreg AS enreg, sujets.date_modif AS modif FROM sujets
                                                                                     INNER JOIN admin
                                                                                     ON sujets.ref_id_admin=admin.id_admin
                                                                                     INNER JOIN categorie
                                                                                     on sujets.ref_id_categorie=categorie.id_categorie             
                                                                                     ORDER BY id_sujet DESC') AS $article):
                                            echo '<tr>
                                                        <td title="ID ARTICLE">' . $article->id_sujet . '</td> 
                                                        <td title="POSTE PAR:">' . $article->prenom . '</td> 
                                                        <td title="CATEGORIE ARTICLE">' . $article->libelle . '</td> 
                                                        <td title="TITRE ARTICLE">' . $article->titre . '</td> 
                                                        <td title="PARAGRAPHE ARTICLE">' . $article->paragraphe . '</td> 
                                                        <td title="MOT_CLES">' . $article->mot_cles . '</td> 
                                                        <td title="IMAGE ARTICLE"><img src="' . $article->image . '" alt="" width="50" class="img-responsive"> </td> 
                                                        <td title="DATE_ENREG">' . $article->enreg . '</td> 
                                                        <td title="DATE_MODIF">' . $article->modif . '</td> 
                                                        <td title="MODIFIER"><a href="blog.php?modifArticle=' . $article->id_sujet . '">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="blog.php?suppArticle=' . $article->id_sujet . '">SUPPRIMER</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
                                        </tbody>
                                        <!---------------------------------------------------------------------------------------------------------------------------------->
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: 25px">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading"
                                 style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                LISTE DES CATEGORIES
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="65%">LIBELLE</th>
                                            <th width="10%">DATE_ENREG</th>
                                            <th width="10%">DATE_MODIF</th>
                                            <th width="5%">MODIFIER</th>
                                            <th width="5%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT *FROM categorie             
                                                                                     ORDER BY id_categorie DESC') AS $categorie):
                                            echo '<tr>
                                                        <td title="ID CATEGORIE">' . $categorie->id_categorie . '</td> 
                                                        <td title="LIBELLE">' . $categorie->libelle . '</td> 
                                                        <td title="DATE ENREGISTREMENT">' . date('d/m/Y H:i:s', $categorie->date_enreg) . '</td> 
                                                        <td title="DATE DE MODIFICATION">' . date('d/m/Y H:i:s', $categorie->date_modif) . '</td>
                                                        <td title="MODIFIER"><a href="blog.php?modifCategorie=' . $categorie->id_categorie . '">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="blog.php?suppCategorie=' . $categorie->id_categorie . '">SUPPRIMER</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
                                        </tbody>
                                        <!---------------------------------------------------------------------------------------------------------------------------------->
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->



</div>
<!-- /#wrapper -->

<!-- jQuery -->
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="../Public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<script src="traitement.js"></script>

<script src="wysibb/jquery.wysibb.min.js"></script>
<script src="wysibb/lang/fr.js"></script>
<!--<script src="http://cdn.wysibb.com/js/jquery.wysibb.min.js"></script> -->

<!-- Init WysiBB BBCode editor -->
<script>
    $(document).ready(function() {
        var wbbOpt = {
            //buttons: "bold,italic,underline,|,img,link,|,code,quote",
            allButtons: {
                quote: {
                    transform: {
                        '<div class="quote">{SELTEXT}</div>':'[quote]{SELTEXT}[/quote]',
                        '<div class="quote"><cite>{AUTHOR} wrote:</cite>{SELTEXT}</div>':'[quote={AUTHOR}]{SELTEXT}[/quote]'
                    }
                }
            },
            lang:'fr'
        }
        $("#blogParagraphe").wysibb(wbbOpt);
    });
</script>

</body>
</html>


