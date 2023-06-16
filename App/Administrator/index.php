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
        <div id="page-content-wrapper" style="padding: initial;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a></div>

                    </div>
        <!-- /#page-content-wrapper -->
        <?php
        if(isset($_GET['modif'])){
            foreach (App::getDB()->query('SELECT * FROM compte WHERE id_compte='.$_GET['modif']) AS $ccompte):
                ?>
                <article class="col-lg-offset-3">
                    <h1>MODIFICATION D'UN COMPTE</h1>
                    <form id="modif_compte" method="post" accept-charset="UTF-8" action="traitement.php">
                        <input type="hidden" name="id_compte" value="<?=$ccompte->id_compte;?>">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="nom">NOM</label>
                                <input id="nom" type="text" name="nom" placeholder="NOM" class="form-control" value="<?=$ccompte->nom;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="prenom">PRENOM</label>
                                <input id="prenom" type="text" name="prenom" placeholder="PRENOM" class="form-control" value="<?=$ccompte->prenom;?>">
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="col-lg-6">
                                <label for="email">EMAIL</label>
                                <input id="email" type="email" name="email" placeholder="EMAIL" class="form-control" value="<?=$ccompte->email;?>">
                           </div>
                            <div class="col-lg-6">
                                <label for="url">SITE WEB</label>
                                <input id="url" type="url" name="url" class="form-control" placeholder="https://www.bertin-mounok.com" value="<?=$ccompte->site_web;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="password">PASSWORD</label>
                                <input id="password" type="password" name="password" class="form-control" placeholder="789456123" value="<?=$ccompte->password;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="etat_compte">ETAT COMPTE</label>
                                <input id="etat_compte" type="text" name="etat_compte" class="form-control" value="<?=$ccompte->etat_compte;?>" placeholder="0 ou 1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="privilege">PRIVILEGE</label>
                                <input id="privilege" type="text" name="privilege" class="form-control" placeholder="utlisateur" value="<?=$ccompte->privileges;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="statut_social">STATUT SOCIAL</label>
                                <input id="statut_social" type="text" name="statut_social" class="form-control" placeholder="Entreprise ou Particulier" value="<?=$ccompte->statut_social;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="activite">DOMAINE D'ACTIVITE</label>
                                <input id="activite" type="text" name="activite" class="form-control" placeholder="informatique" value="<?=$ccompte->domaine_activite;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="nomEntreprise">NOM DE L'ENTREPRISE</label>
                                <input id="nomEntreprise" type="text" name="nomEntreprise" class="form-control" placeholder="bertin-dev" value="<?=$ccompte->nom_entreprise;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="bp">BOÎTE POSTALE</label>
                                <input id="bp" type="text" name="bp" class="form-control" placeholder="1492" value="<?=$ccompte->bp;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="ville">VILLE</label>
                                <input id="ville" type="text" name="ville" class="form-control" placeholder="Douala" value="<?=$ccompte->ville;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="telephone">TELEPHONE</label>
                                <input id="telephone" type="number" name="telephone" class="form-control" placeholder="+222 222 222" value="<?=$ccompte->telephone;?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="emailEntreprise">EMAIL D'ENTREPRISE</label>
                                <input id="emailEntreprise" type="email" name="emailEntreprise" class="form-control" placeholder="bertmoun@yahoo.fr" value="<?=$ccompte->email_entreprise;?>">
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
            if(isset($_GET['supp'])){
                App::getDB()->delete('DELETE FROM compte WHERE id_compte=:compte', ['compte' =>$_GET['supp']]);
            }
            ?>
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                TABLEAU DE BORD
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th width="5%">NOM</th>
                                            <th width="5%">PRENOM</th>
                                            <th width="5%">EMAIL</th>
                                            <th width="5%">PASSWORD</th>
                                            <th width="5%">DATE_ENREG</th>
                                            <th width="5%">DATE_MODIF</th>
                                            <th width="3%">NBRE CONNEXION</th>
                                            <th width="5%">DERNIERE CONNEXION</th>
                                            <th width="3%">CLE ACTIVATION</th>
                                            <th width="1%">ETAT COMPTE</th>
                                            <th width="3%">PRIVILEGE</th>
                                            <th width="3%">TOKEN ACCESS</th>
                                            <th width="3%">STATUT SOCIAL</th>
                                            <th width="5%">DOMAINE ACTIVITE</th>
                                            <th width="5%">NOM ENTREPRISE</th>
                                            <th width="3%">BP</th>
                                            <th width="5%">VILLE</th>
                                            <th width="5%">TEL</th>
                                            <th width="5%">EMAIL ENTREPRISE</th>
                                            <th width="5%">URL</th>
                                            <th width="1%">DEVIS</th>
                                            <th width="3%">MODIFIER</th>
                                            <th width="3%">SUPPRIMER</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM compte
                                                                                     ORDER BY id_compte DESC') AS $ccompte):
                                            echo '<tr>
                                                        <td title="ID">'.$ccompte->id_compte.'</td> 
                                                        <td title="NOM">'.$ccompte->nom.'</td> 
                                                        <td title="PRENOM">'.$ccompte->prenom.'</td> 
                                                        <td title="EMAIL">'.$ccompte->email.'</td> 
                                                        <td title="PASSWORD">'.$ccompte->password.'</td> 
                                                        <td title="DATE_ENREG">'.date('d/m/Y H:m:s', $ccompte->date_enreg).'</td> 
                                                        <td title="DATE_MODIF">'.date('d/m/Y H:m:s', $ccompte->date_modif).'</td> 
                                                        <td title="NOMBRE DE CONNEXION">'.$ccompte->nbre_connexion.'</td> 
                                                        <td title="DERNIERE CONNEXION">'.date('d/m/Y H:m:s', $ccompte->derniere_consult).'</td> 
                                                        <td title="CLE D\'ACTIVATION">'.$ccompte->clef_activation.'</td> 
                                                        <td title="ETAT COMPTE">'.$ccompte->etat_compte.'</td> 
                                                        <td title="PRIVILEGES">'.$ccompte->privileges.'</td> 
                                                        <td title="TOKEN ACCESS">'.$ccompte->token_compte.'</td> 
                                                        <td title="STATUT SOCIAL">'.$ccompte->statut_social.'</td> 
                                                        <td title="DOMAINE D\ACTIVITE">'.$ccompte->domaine_activite.'</td> 
                                                        <td title="NOM DE L\'ENTREPRISE">'.$ccompte->nom_entreprise.'</td> 
                                                        <td title="BP">'.$ccompte->bp.'</td> 
                                                        <td title="VILLE">'.$ccompte->ville.'</td> 
                                                        <td title="TEL">'.$ccompte->telephone.'</td> 
                                                        <td title="EMAIL D\'ENTRPRISE">'.$ccompte->email_entreprise.'</td> 
                                                        <td title="SITE WEB">'.$ccompte->site_web.'</td> 
                                                        <td title="NOMBRE DE DEVIS">'.$ccompte->nbre_devis_genere.'</td>                          
                                                        <td title="MODIFIER"><a href="index.php?modif='.$ccompte->id_compte.'"  class="modifElementTab">MODIFIER</a></td>
                                                        <td title="SUPPRIMER"><a href="index.php?supp='.$ccompte->id_compte.'"  class="suppElementTab">SUPPRIMER</a></td>
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

