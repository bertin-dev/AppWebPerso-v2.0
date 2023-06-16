<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 27/05/2019
 * Time: 07h25
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
    <div id="page-content-wrapper" style="padding: initial;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-3"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a></div>

                </div>
                <!-- /#page-content-wrapper -->
                <?php
                if(isset($_GET['modifEntreprise'])){
                    foreach (App::getDB()->query('SELECT * FROM body WHERE id_body='.$_GET['modifEntreprise']) AS $ccompte):
                        ?>
                        <article class="col-lg-offset-3">
                            <h1>MODIFICATION PROJETS ENTREPRISE</h1>
                            <form id="modif_compte" method="post" accept-charset="UTF-8" action="traitement.php" enctype="multipart/form-data">
                                <input type="hidden" name="id_bodyEntreprise" value="<?=$ccompte->id_body;?>">
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="nom">ANNEE</label>
                                        <input id="annee" type="date" name="annee" placeholder="ANNEE" class="form-control" value="<?=$ccompte->annee;?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="entreprise">ENTREPRISE</label>
                                        <input id="entreprise" type="text" name="entreprise" placeholder="ENTREPRISE" class="form-control" value="<?=utf8_encode($ccompte->entreprise);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="activite">ACTIVITE</label>
                                        <input id="activite" type="text" name="activite" placeholder="ACTIVITE" class="form-control" value="<?=utf8_encode($ccompte->activite);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="matricule">MATRICULE</label>
                                        <input id="matricule" type="text" name="matricule" class="form-control" placeholder="MATRICULE" value="<?=utf8_encode($ccompte->matricule);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="section">SECTION</label>
                                        <input id="section" type="text" name="section" placeholder="SECTION" class="form-control" value="<?=utf8_encode($ccompte->section);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="poste_occupe">POSTE_OCCUPE</label>
                                        <input id="poste_occupe" type="text" name="poste_occupe" class="form-control" placeholder="POSTE_OCCUPE" value="<?=utf8_encode($ccompte->poste_occupe);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="ville">VILLE</label>
                                        <input id="ville" type="text" name="ville" class="form-control" placeholder="VILLE" value="<?=utf8_encode($ccompte->ville);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="app_dev">APP_DEV</label>
                                        <input id="app_dev" type="text" name="app_dev" class="form-control" value="<?=utf8_encode($ccompte->app_dev);?>" placeholder="APP_DEV">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="type_app">TYPE_APP</label>
                                        <input id="type_app" type="text" name="type_app" class="form-control" placeholder="TYPE_APP" value="<?=utf8_encode($ccompte->type_app);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="analyse">ANALYSE</label>
                                        <input id="analyse" type="text" name="analyse" class="form-control" placeholder="ANALYSE" value="<?=utf8_encode($ccompte->methode_analyse);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="architecture">ARCHITECTURE</label>
                                        <input id="architecture" type="text" name="architecture" class="form-control" placeholder="ARCHITECTURE" value="<?=utf8_encode($ccompte->architecture);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="travaux">TRAVAUX</label>
                                        <textarea id="travaux" name="travaux" class="form-control" placeholder="TRAVAUX"><?=utf8_encode($ccompte->travaux_effectue);?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="ide">IDE</label>
                                        <input id="ide" type="text" name="ide" class="form-control" placeholder="IDE" value="<?=utf8_encode($ccompte->ide);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="langage">LANGAGE</label>
                                        <input id="langage" type="text" name="langage" class="form-control" placeholder="LANGAGE" value="<?=utf8_encode($ccompte->langage);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="sgbd">SGBD</label>
                                        <input id="sgbd" type="text" name="sgbd" class="form-control" placeholder="sgbd" value="<?=utf8_encode($ccompte->sgbd);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="outils">OUTILS</label>
                                        <input id="outils" type="text" name="outils" class="form-control" placeholder="OUTILS" value="<?=utf8_encode($ccompte->outils);?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="framework">FRAMEWORK</label>
                                        <input id="framework" type="text" name="framework" class="form-control" placeholder="FRAMEWORK" value="<?=utf8_encode($ccompte->framework);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="fonctionnalites">FONCTIONNALITES</label>
                                        <textarea id="fonctionnalites" name="fonctionnalites" class="form-control" placeholder="FONCTIONNALITES"><?=utf8_encode($ccompte->fonctionnalites);?></textarea>
                                        <small>Delimiteur (-)</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="capture">CAPTURE</label>
                                        <input id="capture" type="file" name="capture[]" class="form-control" multiple>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="url">URL</label>
                                        <input id="url" type="text" name="url" class="form-control" placeholder="URL" value="<?=utf8_encode($ccompte->url);?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <label for="deploiement">DEPLOIEMENT</label>
                                        <input id="deploiement" type="text" name="deploiement" class="form-control" placeholder="DEPLOIEMENT" value="<?=utf8_encode($ccompte->deploiement);?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="taille">TAILLE</label>
                                        <input id="taille" type="text" name="taille" class="form-control" placeholder="TAILLE" value="<?=$ccompte->taille;?>">
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
                else{
                    if(isset($_GET['suppEntreprise'])){
                        App::getDB()->delete('DELETE FROM body WHERE id_body=:id', ['id' =>$_GET['suppEntreprise']]);
                    }
                    ?>
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                MODIFICATION DES PROJETS D'ENTREPRISES
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th width="5%">ANNEE</th>
                                            <th width="5%">ENTREPRISE</th>
                                            <th width="5%">ACTIVITE</th>
                                            <th width="5%">VILLE</th>
                                            <th width="5%">MATRICULE</th>
                                            <th width="5%">SECTION</th>
                                            <th width="5%">POSTE_OCCUPE</th>
                                            <th width="5%">APP_DEV</th>
                                            <th width="5%">TYPE_APP</th>
                                            <th width="4%">ANALYSE</th>
                                            <th width="4%">ARCHITECTURE</th>
                                            <th width="3%">TRAVAUX</th>
                                            <th width="3%">IDE</th>
                                            <th width="3%">LANGAGE</th>
                                            <th width="5%">SGBD</th>
                                            <th width="5%">OUTILS</th>
                                            <th width="3%">FRAMEWORK</th>
                                            <th width="5%">FONCTIONNALITES</th>
                                            <th width="5%">CAPTURE</th>
                                            <th width="5%">DEPLOIMENT</th>
                                            <th width="5%">TAILLE</th>
                                            <th width="5%">URL</th>
                                            <th width="3%">MODIFIER</th>
                                            <th width="3%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM body
                                                                                INNER JOIN page
                                                                                ON body.ref_id_page = page.id_page
                                                                                WHERE statut="0" AND id_page="2"
                                                                                ORDER BY id_body DESC') AS $body):
                                            echo '<tr>
                                                        <td title="ID">'.$body->id_body.'</td> 
                                                        <td title="ANNEE">'.date('d/m/Y H:i:s', (strtotime($body->annee))).'</td> 
                                                        <td title="ENTREPRISE">'.$body->entreprise.'</td> 
                                                        <td title="ACTIVITE">'.$body->activite.'</td> 
                                                        <td title="VILLE">'.$body->ville.'</td> 
                                                        <td title="MATRICULE">'.$body->matricule.'</td>
                                                        <td title="SECTION">'.$body->section.'</td>
                                                        <td title="POSTE_OCCUPE">'.$body->poste_occupe.'</td>
                                                        <td title="APP_DEV">'.$body->app_dev.'</td> 
                                                        <td title="TYPE_APP">'.$body->type_app.'</td> 
                                                        <td title="ANALYSE">'.$body->methode_analyse.'</td> 
                                                        <td title="ARCHITECTURE">'.$body->architecture.'</td> 
                                                        <td title="TRAVAUX">'.$body->travaux_effectue.'</td> 
                                                        <td title="IDE">'.$body->ide.'</td> 
                                                        <td title="LANGAGE">'.$body->langage.'</td> 
                                                        <td title="SGBD">'.$body->sgbd.'</td> 
                                                        <td title="OUTILS">'.$body->outils.'</td> 
                                                        <td title="FRAMEWORK">'.$body->framework.'</td> 
                                                        <td title="FONCTIONNALITES">'.$body->fonctionnalites.'</td> 
                                                        <td title="CAPTURE">';

                                            $img = explode('-', $body->screenshot_App);
                                            for($i=0;$i<count($img)-1;$i++)
                                                echo '<br><img src="../Public/'.$img[$i].'" class="img-responsive" title="" alt=""/>';

                                            echo '</td> 
                                                        <td title="DEPLOIEMENT">'.$body->deploiement.'</td>
                                                        <td title="TAILLE">'.$body->taille.'</td>
                                                        <td title="URL">'.$body->url.'</td>                          
                                                        <td title="MODIFIER"><a href="tableau_entreprise.php?modifEntreprise='.$body->id_body.'">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="tableau_entreprise.php?suppEntreprise='.$body->id_body.'">SUPPRIMER</a></td>
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
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../Public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../Public/js/bootstrap.min.js"></script>

<script src="traitement.js"></script>

</body>

</html>

