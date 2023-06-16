<?php

/**

 * Created by PhpStorm.

 * User: Supers-Pipo

 * Date: 04/02/2018

 * Time: 21h52



 */





/* ------------------------------------------------------------------------

    Auteur: Bertin Mounok (https://www.bertin-mounok.com)

    Version: 2.0.0

    Foncton: inclus l' entête, le corps et le pied de page

------------------------------------------------------------------------- */

?>





<!DOCTYPE html>

<html xmlns:og="http://ogp.me/ns#" lang="fr_FR">



<head>

    <!-- Encodage des caractères -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Insère les mots-clés extraits de la BD dans les meta -->

    <meta name="keywords" lang="fr" content="<?= isset($_ENV['mots_cles']) ? $_ENV['mots_cles']:''; ?>">

    <!-- Insère la description extraite de la DB dans les meta -->

    <meta name="description" lang="fr" content="<?= isset($_ENV['description']) ? $_ENV['description']:'Consultant Développeur front &amp; back-end'; ?>">

    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo Ndemba, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">

    <meta name="copyright" content="© <?=date('Y', time());?>, bertin.dev, Inc.">

    <meta name="language" content="fr">

    <!--Programme ou système ayant généré le contenu. Ne doit pas être utilisé si le document est conçu « à la main ».-->

    <!--<meta name="generator" content="PhpStorm 2018.1.4">-->



    <!-- rafraichi la page web apres chaque 60 secondes -->

   <!-- <meta http-equiv="Refresh" content="60">-->



    <!-- Redirection vers une autre URL au bout de 60 secondes -->

    <?php if(!isset($_ENV['titre'])){

        echo '<meta http-equiv="refresh" content="30;url=index.php"';

    }?>

    <!--<meta http-equiv="refresh" content="60;url=http://www.bertin-mounok.com" />-->



    <!-- Pour une application web seulement -->

    <meta name="Application-Web-Portfolio" content="Mes Réalisations">





    <meta property="og:site_name" content="AppWebPerso@Project-v2.0 / Bertin.dev, Inc.">

    <meta property="og:title" content="<?=$_ENV['titre'];?>">

    <meta property="og:url" content="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">

    <meta property="og:type" content="<?= isset($_ENV['type']) ? $_ENV['type']: 'website';?>">

	<meta property="og:locale" content="fr_FR">

	<meta property="og:locale:alternate" content="en_US">

	<meta property="og:image" content="<?= isset($_ENV['image']) ? 'https://'.$_SERVER['HTTP_HOST'].'/'.$_ENV['image']: 'https://'.$_SERVER['HTTP_HOST'].'Public/img/apropos/Entreprise/profil.jpg';?>">

	<meta property="fb:app_id" content="361124424614569">

	<meta property="fb:admins" content="bertin-dev">



    <meta name="twitter:domain" content="<?=$_SERVER['HTTP_HOST'];?>">

    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:url" content="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">

    <meta name="twitter:title" content="bertin_dev / Bertin Mounok">

    <meta name="twitter:description" content="<?= isset($_ENV['description']) ? $_ENV['description']:'Consultant Développeur front &amp; back-end'; ?>">

    <meta name="twitter:site" content="@bertin_dev">

    <meta name="twitter:creator" content="@bertin_dev">

    <meta name="twitter:image" content="<?= isset($_ENV['image']) ? 'https://'.$_SERVER['HTTP_HOST'].'/'.$_ENV['image']: 'https://'.$_SERVER['HTTP_HOST'].'Public/img/apropos/Entreprise/profil.jpg';?>">



    <!-- Insère le titre extrait de la DB dans la balise correspondante -->

    <title><?php if(isset($_ENV['titre']) && $_ENV['titre']=="Accueil") echo 'Bertin Mounok | '.$_ENV['titre'].' → Portfolio';

             else if(isset($_ENV['titre'])) echo $_ENV['titre'].' | Bertin Mounok';

             else echo 'Page N°'.$_ENV['id_page'].' Introuvable'; ?></title>



    <link rel="canonical" href="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">

    <link rel="<?= isset($_ENV['url']) ? $_ENV['titre']: '';?>" href="<?= isset($_ENV['url']) ? $_ENV['url']: '';?>">





    <!-- Bootstrap Core CSS -->

     <!--<link href="../Public/css/bootstrap.css" rel="stylesheet">-->

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"

          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



    <!--<link href="../Public/css/design.css" rel="stylesheet">-->

    <link href="../Public/css/design.min.css" rel="stylesheet">



    <!-- Custom CSS -->

    <link href="../Public/css/scrolling-nav.css" rel="stylesheet">

    <!--<link href="../Public/css/bertin.dev.css" rel="stylesheet">-->

    <link href="../Public/css/bertin.dev.min.css" rel="stylesheet">



    <!-- Icon and Animate Core CSS -->

    <!--<link href="../Public/css/font-awesome.min.css" rel="stylesheet">-->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">



    <!--<link href="../Public/css/animate.min.css" rel="stylesheet">-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">





    <!-- Icône du site (favicon) -->

    <link rel="icon" type="image/png" href="../Public/img/bertin-mounok.png"/>



    <!-- Fil RSS du site -->

    <link rel="alternate" type="application/rss+xml" title="Carte de Mon site" href="sitemap.xml" />



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



<div id="alert_notifications"></div>



<div id="menu_pipo">

<?= $contenu; ?>

</div>




<?php //include('user_online.php');?>
<?php include('Footer.php');?>



</body>



</html>



