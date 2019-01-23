<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 04/02/2018
 * Time: 21h52

 */


/* ------------------------------------------------------------------------
    Auteur: Bertin Mounok (http://www.bertin-dev.fr)
    Version: 1.0.0
    Foncton: inclus l' entête, le corps et le pied de page
------------------------------------------------------------------------- */
if(isset($_SESSION['time']))
    unset($_SESSION['time']);
$_SESSION['time'] = microtime(TRUE);

?>


<!DOCTYPE html>
<html lang="fr_en">

<head>
    <!-- Encodage des caractères -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Insère les mots-clés extraits de la BD dans les meta -->
    <meta name="keywords" lang="fr" content="<?= $_ENV['mots_cles']; ?>">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="<?= $_ENV['description']; ?>">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">
    <meta name="copyright" content="© 2018, bertin.dev, Inc">
    <!--Programme ou système ayant généré le contenu. Ne doit pas être utilisé si le document est conçu « à la main ».-->
    <!--<meta name="generator" content="PhpStorm 2018.1.4">-->

    <!-- rafraichi la page web apres chaque 60 secondes -->
   <!-- <meta http-equiv="Refresh" content="60">-->

    <!-- Redirection vers une autre URL au bout de 60 secondes -->
    <!--<meta http-equiv="refresh" content="60;url=http://www.blup.fr" />-->

    <!-- Pour une application web seulement -->
    <meta name="Application-Web-Portfolio" content="Mes Réalisations">

    <!-- Insère le titre extrait de la DB dans la balise correspondante -->
    <title><?php if($_ENV['titre']=="Accueil") echo 'Bertin Mounok | '.$_ENV['titre'].' → Portfolio';
             else echo $_ENV['titre'].' | Bertin Mounok'?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../Public/css/bootstrap.css" rel="stylesheet">
    <link href="../Public/css/design.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../Public/css/scrolling-nav.css" rel="stylesheet">
    <link href="../Public/css/bertin.dev.css" rel="stylesheet">

    <!-- Icon and Animate Core CSS -->
    <link href="../Public/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Public/css/animate.min.css" rel="stylesheet">

    <!-- Icône du site (favicon) -->
    <link rel="icon" type="image/png" href="../Public/img/bertin-mounok.png"/>

    <!-- Fil RSS du site -->
    <!--<link rel="alternate" type="application/rss+xml" title="News de mon site" href="news.xml" />-->

    <!-- Page d'aide du site -->
    <!--<link rel="help" title="Politique d'accessibilité" href="accessibilite.html" />-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature -
 the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target="navbar-fixed-top">

<?php include('Head.php'); ?>


<div id="menu_pipo">
<?= $contenu; ?>
</div>


<?php include('Footer.html');?>

</body>

</html>

