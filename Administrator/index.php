<?php

require '../App/Config/Config_Server.php';


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
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
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
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->


        <li id="users"></li>


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../Public/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../Public/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });


    $(function(){
        function getonline(){
            $('#users').load('user_online.php', function() {

            });
        }
        setInterval(getonline, 3000);

    });
    </script>

</body>

</html>

