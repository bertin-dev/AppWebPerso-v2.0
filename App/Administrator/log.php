<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 19/05/2019
 * Time: 08h55
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
                    <div class="col-lg-6">
                        <!--bloc 1-->
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                UTILISATEURS ACTUELLEMENT EN LIGNE
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="1%">IP</th>
                                            <th width="5%">CONTINENT</th>
                                            <th width="5%">PAYS</th>
                                            <th width="5%">VILLE</th>
                                            <th width="5%">REGION</th>
                                            <th width="5%">REGION_NAME</th>
                                            <th width="5%">TIME_ZONE</th>
                                            <th width="5%">SYMBOLE</th>
                                            <th width="5%">STATUT</th>
                                            <th width="5%">HEURE</th>
                                            <th width="4%">LATITUDE</th>
                                            <th width="4%">LONGITUDE</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM online_user
                                                                                WHERE statut_visiteur="2"
                                                                                ORDER BY heure_arrive_visiteur DESC') AS $online):
                                            echo '<tr>
                                                        <td title="IP">'.$online->ip_visiteur.'</td> 
                                                        <td title="CONTINENT">'.$online->continent.'</td> 
                                                        <td title="PAYS">'.$online->pays.'</td> 
                                                        <td title="VILLE">'.$online->ville.'</td> 
                                                        <td title="REGION">'.$online->region.'</td> 
                                                        <td title="REGION_NAME">'.$online->region_name.'</td>
                                                        <td title="TIME_ZONE">'.$online->time_zone.'</td>
                                                        <td title="SYMBOLE">'.$online->symbole.'</td>
                                                        <td title="STATUT">'.$online->statut_visiteur.'</td> 
                                                        <td title="HEURE">'.date('d/m/Y H:i:s', $online->heure_arrive_visiteur ).'</td> 
                                                        <td title="LATITUDE">'.$online->latitude.'</td> 
                                                        <td title="LONGITUDE">'.$online->longitude.'</td> 
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
                                   <!--bloc 2-->
                        <div class="panel panel-default" style="background-color: initial;">
                            <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                                UTILISATEURS(ENREGISTRES) EN LIGNE
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th width="1%">IP</th>
                                            <th width="5%">CONTINENT</th>
                                            <th width="5%">PAYS</th>
                                            <th width="5%">VILLE</th>
                                            <th width="5%">REGION</th>
                                            <th width="5%">REGION_NAME</th>
                                            <th width="5%">TIME_ZONE</th>
                                            <th width="5%">SYMBOLE</th>
                                            <th width="5%">STATUT</th>
                                            <th width="5%">ARRIVEE</th>
                                            <th width="5%">DEPART</th>
                                            <th width="5%">DUREE</th>
                                            <th width="4%">LATITUDE</th>
                                            <th width="4%">LONGITUDE</th>
                                            <th width="5%">CONVERSION</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tbody id="tabdynamique">
                                        <?php
                                        foreach (App::getDB()->query('SELECT * FROM all_visitor
                                                                                WHERE statut_visitor="2"
                                                                                ORDER BY heure_arrive_visitor DESC') AS $online):
                                            echo '<tr>
                                                        <td title="ID">'.$online->id_visitor.'</td>
                                                        <td title="IP">'.$online->ip_visitor.'</td> 
                                                        <td title="CONTINENT">'.$online->continent.'</td> 
                                                        <td title="PAYS">'.$online->pays.'</td> 
                                                        <td title="VILLE">'.$online->ville.'</td> 
                                                        <td title="REGION">'.$online->region.'</td> 
                                                        <td title="REGION_NAME">'.$online->region_name.'</td>
                                                        <td title="TIME_ZONE">'.$online->time_zone.'</td>
                                                        <td title="SYMBOLE">'.$online->symbole.'</td>
                                                        <td title="STATUT">'.$online->statut_visitor.'</td> 
                                                        <td title="ARRIVEE">'.date('d/m/Y H:i:s', $online->heure_arrive_visitor ).'</td> 
                                                        <td title="DEPART">'.date('d/m/Y H:i:s', $online->heure_depart ).'</td>
                                                        <td title="DUREE">'. $online->duree .'</td>
                                                        <td title="LATITUDE">'.$online->latitude.'</td> 
                                                        <td title="LONGITUDE">'.$online->longitude.'</td> 
                                                        <td title="CONVERSION">'.$online->convert_money_in_fcfa.'</td> 
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



                <div class="col-lg-6">

                    <div class="panel panel-default" style="background-color: initial;">
                        <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                            TABLEAU DE BORD JOURNAL
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th width="5%">DATE</th>
                                        <th width="5%">LIBELLE</th>
                                        <th width="5%">PAGE</th>
                                        <th width="5%">STATUT</th>
                                        <th width="5%">IP</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tbody id="tabdynamique">
                                    <?php
                                    foreach (App::getDB()->query('SELECT * FROM journal
                                                                                ORDER BY id_journal DESC') AS $journal):
                                        echo '<tr>
                                                        <td title="ID">'.$journal->id_journal.'</td> 
                                                        <td title="DATE">'.date('d/m/Y H:i:s', $journal->date_creation).'</td>
                                                        <td title="LIBELLE">'.$journal->libelle.'</td> 
                                                        <td title="PAGE">'.$journal->page.'</td> 
                                                        <td title="STATUT">'.$journal->statut.'</td> 
                                                        <td title="IP">'.$journal->ip.'</td>
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