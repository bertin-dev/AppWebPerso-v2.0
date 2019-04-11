<?php



echo $msg ='
<!doctype html>
<html lang="fr">
<head>
<title>Consultant Developpeur</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Insère les mots-clés extraits de la BD dans les meta -->
    <meta name="keywords" lang="fr" content="">
    <!-- Insère la description extraite de la DB dans les meta -->
    <meta name="description" lang="fr" content="">
    <meta name="author" content="Bertin Mounok, Bertin-Mounok, Pipo, Supers-Pipo, bertin.dev, bertin-dev, Ngando Mounok Hugues Bertin">
    <meta name="copyright" content="© '.date('Y', time()).'", bertin.dev, Inc.">
</head>
<body style=" font-size: 15px; line-height: 1.42857143; font-family: \'Sansation\',\'Trebuchet MS\',Helvetica,Verdana,sans-serif,serif; color: #DDD;background: #2f2f2f url(\'Public/img/background.png\') repeat;">

<header>
    <div style="background-color: #0f6296; height: 5px;"></div>
    <nav role="navigation" style="background-color: #192730; min-height: 50px; margin-bottom: 20px; border: 1px solid transparent;">
       <div style="width: 25%; float: left;"> 
       <img src="https://'.$_SERVER['HTTP_HOST'].'/Public/img/bertin-mounok.png" alt="Logo" title="Consultant Developpeur" width="50px">
       <span style="font-size: 9px; position: relative; top: -8px" title="bertin.dev">Bertin Mounok</span>
       </div>
        <div style="width: 75%; float:left; font-variant: small-caps"><h1>Développeur Web / .NET</h1></div>
    </nav>
</header>


<div style="text-align: center!important;">
    <h2>Cher Utilisateur du site web,</h2>
    <p>Merci de vouloir être régulièrement informé des nouvelles annonces publiées
        <mark><strong>dans la categorie Projet Réalisés.</strong></mark>
    </p>
</div>

<div style="background-color: #0f6296; color: white; text-align: center!important; padding: 30px;">
    <p>S\'il vous plait confirmer votre adresse e-mail, pour éviter toute utilisation abusive par des tiers.</p>

    <button type="button" style="display: block;
    float: right;
    position: relative;
    width: auto;
    height: auto;
    padding: 7px 15px;
    margin: 10px 0 15px 0;
    background: #192730;
    text-transform: uppercase;
    text-decoration: none;
    color: #CCC;
    font-size: 12px;
    line-height: inherit;
    border: 1px solid #1b4159;
    -webkit-transition: all .2s;
    -moz-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;"
    ">
    <a href="https://'.$_SERVER['HTTP_HOST'].'/Public/index.php?id_page=8&amp;numero_id=2&clef=4" role="button" style="color: white">Confirmer l\'adresse e-mail >></a>
    </button>
</div>
<br>
<div style="margin-bottom: 30px; display: block">
    <small>si vous ne souhaitez plus recevoir d\'alertes e-mails, vous trouverez un lien de suspension <a href="pipo.php" role="button" style="color: white"> Lien</a></small>
</div>

<footer>
        <nav>
                <span style="font-variant: small-caps;" title="Consultant Développeur"><small><em>  © '.date("Y", time()).', bertin.dev, Inc.</em></small></span>
        <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li style="list-style-type: none;"><em>→ +237 694 04 89 25</em></li></small></span>
        </nav>
</footer>
</body>
</html>
';