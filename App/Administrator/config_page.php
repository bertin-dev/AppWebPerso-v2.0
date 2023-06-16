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
                <?php
                if(isset($_GET['modifAgenda'])){

                    foreach (App::getDB()->query('SELECT * FROM agenda WHERE id_agenda='.$_GET['modifAgenda']) AS $agenda):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION DE L' AGENDA ANNUEL</h1>
                            <form id="modif_agenda" method="post" accept-charset="UTF-8" action="traitement.php">
                                <input type="hidden" name="id_agenda" value="<?=$agenda->id_agenda;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="addMsgAgenda">Libelle</label>
                                        <input id="addMsgAgenda" type="text" name="addMsgAgenda" placeholder="PROGRAMME" class="form-control" value="<?=$agenda->libelle;?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="debut">DEBUT</label>
                                        <input id="debut" type="datetime-local" name="debut" placeholder="DEBUT" class="form-control" value="<?=$agenda->debut;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="fin">FIN</label>
                                        <input id="fin" type="datetime-local" name="datetime-local" placeholder="FIN" class="form-control" value="<?=$agenda->fin;?>">
                                    </div>
                                    <div class="col-lg-6"><input type="submit" value="Envoyer"></div>
                                </div>
                            </form>
                        </article>

                    <?php
                    endforeach;
                }

                else if(isset($_GET['modifProjet'])){

                    foreach (App::getDB()->query('SELECT * FROM projets_encours WHERE id_projet='.$_GET['modifProjet']) AS $projet):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION DU PROJET ENCOURS</h1>
                            <form id="modif_projet" method="post" accept-charset="UTF-8" action="traitement.php">
                                <input type="hidden" name="id_projet" value="<?=$projet->id_projet;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="titre">TITRE DU PROJET</label>
                                        <input id="titre" type="text" name="titre" placeholder="TITRE DU PROJET" class="form-control" value="<?=$projet->titre;?>">
                                        <label for="description">DESCRIPTION</label>
                                        <input id="description" type="text" name="description" placeholder="DESCRIPTION" class="form-control" value="<?=$projet->description;?>">
                                        <input type="submit" value="Envoyer">
                                    </div>
                                </div>
                            </form>
                        </article>
                    <?php
                    endforeach;
                }
                else if(isset($_GET['modifImages'])){
                    foreach (App::getDB()->query('SELECT * FROM images WHERE id_img='.$_GET['modifImages']) AS $img):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION DES IMAGES</h1>
                            <form id="modif_img" method="post" accept-charset="UTF-8" action="traitement.php" enctype="multipart/form-data">
                                <input type="hidden" name="id_img" value="<?=$img->id_img;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="image">IMAGE</label>
                                        <input id="image" type="file" name="image" class="form-control">
                                        <label for="titre">TITRE</label>
                                        <input id="titre" type="text" name="titre" placeholder="TITRE" class="form-control" value="<?=$img->title;?>">
                                        <label for="description">DESCRIPTION</label>
                                        <textarea id="description" name="description" placeholder="DESCRIPTION" class="form-control"><?=$img->description;?></textarea>
                                            <label for="destination">Destination<b>*</b></label>
                                        <select style="background-color: white;" id="destination" name="destination" class="form-control">
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
                                        <input type="submit" value="Envoyer">
                                    </div>
                                </div>
                            </form>
                        </article>
                    <?php
                    endforeach;
                }

                else{
                if(isset($_GET['suppAgenda'])){
                    App::getDB()->delete('DELETE FROM agenda WHERE id_agenda=:agenda', ['agenda' =>$_GET['suppAgenda']]);
                }

                    else if(isset($_GET['suppProjet'])){
                        App::getDB()->delete('DELETE FROM projets_encours WHERE id_projet=:projet', ['projet' =>$_GET['suppProjet']]);
                    }

                    else if(isset($_GET['suppImages'])){
                        App::getDB()->delete('DELETE FROM images WHERE id_img=:img', ['img' =>$_GET['suppImages']]);
                    }
                ?>
                <div class="col-lg-12">

                    <h1 class="text-center" style="margin-bottom: 50px;"><u>CONFIGURATION DES PAGES</u></h1>
                       <!-- Bloc Agenda-->
                    <div class="col-lg-3">
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
                    <div class="col-lg-5">
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

                </div>


                <div class="col-lg-3">
                    <div class="panel panel-default" style="background-color: initial;">
                        <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                            LISTE DES AGENDAS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th width="64%">TITRE</th>
                                        <th width="5%">DEBUT</th>
                                        <th width="5%">FIN</th>
                                        <th width="5%">DUREE</th>
                                        <th width="5%">DATE_ENREG</th>
                                        <th width="5%">DATE_MODIF</th>
                                        <th width="5%">MODIFIER</th>
                                        <th width="5%">SUPPRIMER</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tbody id="tabdynamique">
                                    <?php
                                    foreach (App::getDB()->query('SELECT * FROM agenda
                                                                                     ORDER BY id_agenda DESC') AS $agenda):
                                        echo '<tr>
                                                        <td title="ID">'.$agenda->id_agenda.'</td> 
                                                        <td title="TITRE">'.$agenda->libelle.'</td> 
                                                        <td title="DEBUT">'.date('d/m/Y H:m:s', $agenda->debut).'</td> 
                                                        <td title="FIN">'.date('d/m/Y H:m:s', $agenda->fin).'</td> 
                                                        <td title="DUREE">'.$agenda->dureee_restante.'</td> 
                                                        <td title="DATE_ENREG">'.date('d/m/Y H:m:s', $agenda->date_creation).'</td> 
                                                        <td title="DATE_MODIF">'.date('d/m/Y H:m:s', $agenda->date_modif).'</td> 
                                                        <td title="MODIFIER"><a href="config_page.php?modifAgenda='.$agenda->id_agenda.'">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="config_page.php?suppAgenda='.$agenda->id_agenda.'">SUPPRIMER</a></td>
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
                <div class="col-lg-4">
                    <div class="panel panel-default" style="background-color: initial;">
                        <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                            LISTE DES PROJETS FREELANCE
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th width="29%">TITRE</th>
                                        <th width="50%">DESCRIPTION</th>
                                        <th width="5%">DATE_ENREG</th>
                                        <th width="5%">DATE_MODIF</th>
                                        <th width="5%">MODIFIER</th>
                                        <th width="5%">SUPPRIMER</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tbody id="tabdynamique">
                                    <?php
                                    foreach (App::getDB()->query('SELECT * FROM projets_encours
                                                                                     ORDER BY id_projet DESC') AS $projet):
                                        echo '<tr>
                                                        <td title="ID">'.$projet->id_projet.'</td> 
                                                        <td title="TITRE">'.$projet->titre.'</td> 
                                                        <td title="DESCRIPTION">'.$projet->description.'</td> 
                                                        <td title="DATE_ENREG">'.date('d/m/Y H:m:s', $projet->date_creation).'</td> 
                                                        <td title="DATE_MODIF">'.date('d/m/Y H:m:s', $projet->date_modif).'</td> 
                                                        <td title="MODIFIER"><a href="config_page.php?modifProjet='.$projet->id_projet.'">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="config_page.php?suppProjet='.$projet->id_projet.'">SUPPRIMER</a></td>
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
                <div class="col-lg-5">
                    <div class="panel panel-default" style="background-color: initial;">
                        <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                            LISTE D'IMAGES DISPONIBLES
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th width="40%">IMAGES</th>
                                        <th width="14%">TITRE</th>
                                        <th width="20%">DESCRIPTION</th>
                                        <th width="5%">DESTINATION</th>
                                        <th width="5%">DATE_ENREG</th>
                                        <th width="5%">DATE_MODIF</th>
                                        <th width="5%">MODIFIER</th>
                                        <th width="5%">SUPPRIMER</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tbody id="tabdynamique">
                                    <?php
                                    foreach (App::getDB()->query('SELECT * FROM images
                                                                                     ORDER BY id_img DESC') AS $images):
                                        echo '<tr>
                                                        <td title="ID">'.$images->id_img.'</td> 
                                                        <td title="IMAGES"><img src="'.$images->chemin.'" alt="" class="img-responsive"></td> 
                                                        <td title="TITRE">'.$images->title.'</td> 
                                                        <td title="DESCRIPTION">'.$images->description.'</td> 
                                                        <td title="DESTINATION">'.$images->destination.'</td> 
                                                        <td title="DATE_ENREG">'.date('d/m/Y H:m:s', $images->date_ajout).'</td> 
                                                        <td title="DATE_MODIF">'.date('d/m/Y H:m:s', $images->date_modif).'</td> 
                                                        <td title="MODIFIER"><a href="config_page.php?modifImages='.$images->id_img.'">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="config_page.php?suppImages='.$images->id_img.'">SUPPRIMER</a></td>
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
<script src="../Public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<script src="traitement.js"></script>

</body>

</html>



