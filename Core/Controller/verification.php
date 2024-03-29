<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 13/03/2018
 * Time: 09h37
 */

require '../../App/Config/Config_Server.php';
require '../../vendor/autoload.php';
/*require ('../../vendor/jbbcode/jbbcode/JBBCode/Parser.php');
$parser = new \JBBCode\Parser();
$parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());*/
//
//require ('../../vendor/jbbcode/jbbcode/JBBCode/Parser.php');
$parser = new \JBBCode\Parser();
//$parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());


session_start();


define('MIN_CHARACTER', 0);
define('MAX_CHARACTER', 500);
define('DUREE_SUSPENSION', 10);


if(isset($_SESSION['ID_USER'])) {
    $compte = intval($_SESSION['ID_USER']);
    $statut = 'utilisateur';
}
else if(isset($_COOKIE['ID_USER'])) {
    $compte = intval($_COOKIE['ID_USER']);
    $statut = 'utilisateur';
}
else {
    $compte = 0;
    $statut = 'visiteur';
}

 function nettoieProtect(){

    foreach($_POST as $k => $v){
        $v=strip_tags(trim($v));
        $_POST[$k]=$v;
    }

    foreach($_GET as $k => $v){
        $v=strip_tags(trim($v));
        $_GET[$k]=$v;
    }

    foreach($_REQUEST as $k => $v){
        $v=strip_tags(trim($v));
        $_REQUEST[$k]=$v;
    }

}

//recuperation de la veritable adresse ip du visiteur
function get_ip(){

    //IP si internet partagé
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }


    //IP derriere un proxy
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    //IP normal
    else{
        return isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
    }
}



$message='';
$success='';
$i=0;



//Système de notification
if(isset($_POST['view'])){

    $connexion = App::getDB();

    if(isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER'])){
    if($_POST['view'] != ''){
     $connexion->update('UPDATE body SET notification_vue= :statut', array('statut'=>"1"));
    }
    }

    $nbre = $connexion->rowCount('SELECT * FROM body');
    $output = '';
    if($nbre > 0){
        foreach($connexion->query('SELECT * FROM body ORDER BY id_body DESC LIMIT 4') as $con):
            $output .= '<ul id="competences-speech">
                         <li class="competence-java current">
                         <h2>'.$con->type_app.'</h2>
                         <span class="exp-duration"><strong>' .$con->type_service. '</strong></span> 
                         <span><small><em>' .$con->app_dev. '</em></small></span>   
                         </li> 
                         </ul>         
             ';
        endforeach;

    }
    else{
        $output .= '
                    <li><a href="#" style="font-weight: bold; font-style: italic;"> Aucune Notification trouvé</a> </li>
                   ';
    }

    $count = $connexion->rowCount('SELECT * FROM body WHERE notification_vue="0"');

    $data = array (
        'notification' => $output,
        'unseen_notification' => $count
    );


    echo json_encode($data);

    /*$monfichier = fopen("compteur.txt", "r+");
     $pages_vues = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
     $pages_vues++; // On augmente de 1 ce nombre de pages vues
     fseek($monfichier, 0); // On remet le curseur au début du fichier
     fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues
    fclose($monfichier);
    */
}


/*système de chargement automatique pendant le scroll*/
/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LE PORTFOLIO SECTION FONCTIONALITES
   ========================================================================== */
if(isset($_POST['limit'], $_POST['start'])){

    $content = '';

    foreach (\App::getDB()->query('
         SELECT * FROM body
         INNER JOIN page
         ON body.ref_id_page = page.id_page
         WHERE statut="1" AND id_page=2 
         ORDER BY id_body DESC LIMIT '.$_POST['start'].','.$_POST['limit']) as $portfolio):

        $content .= '<div class="col-lg-12 well" style="background: url("img/pattern15.png");">';
                         $content .='<ul class="nav nav-tabs">';
                         $content .='<li class="active"><a href="#freelance'.$portfolio->id_body.'"';
                         $content .='title="'.$portfolio->type_service.'"  data-toggle="tab">';
                         $content .='<i class="icon-briefcase"></i>'.$portfolio->type_service.'</a></li>';
                         $content .='<li><a href="#travaux'.$portfolio->id_body.'" title="Travaux" data-toggle="tab">DESCRIPTION</a></li>';
                         $content .='<li><a href="#captures'.$portfolio->id_body.'" title="Captures" data-toggle="tab">CAPTURES</a></li>';
                         $content .='<li><a href="#fonctionalites'.$portfolio->id_body.'" title="Fonctionalités" data-toggle="tab">FONCTIONALITES</a></li>';
                         $content .='</ul>';


                           $content .='<div class="tab-content">';
                           $content .='<div class="tab-pane active" id="freelance'.$portfolio->id_body.'">';
                           $content .='<div class="col-lg-6">';
                           $content .='<strong><u>Date de sortie</u>: </strong><em>';
                           $content .='<small>'.date('d/m/Y', strtotime($portfolio->annee)).'</small></em><br>';
                           $content .='<strong><u>Type de Service</u>: </strong><em>';
                           $content .='<small>'.$portfolio->type_service.'</small></em><br>';
                           $content .='<strong><u>Entite</u>: </strong><em>';
                           $content .='<small>'.$portfolio->entite.'</small></em><br>';
                           $content .='</div>';
                           $content .='<div class="col-lg-6">';
                           $content .='<strong><u>Nom d\'Entité</u>: </strong> <em>';
                           $content .='<small>'.$portfolio->nom_entite.'</small></em><br>';
                           $content .='<strong><u>Activité</u>: </strong><em>';
                           $content .='<small>'.$portfolio->activite.'</small></em><br>';
                           $content .='<strong><u>Ville</u>: </strong> <em>';
                           $content .='<small>'.$portfolio->ville.'</small></em>';
                           $content .='</div></div>';

                           $content .='<div class="tab-pane" id="travaux'.$portfolio->id_body.'">';
                           $content .='<p><em>'.$portfolio->travaux_effectue.'</em></p>';
                           $content .='</div>';

                           $content .='<div class="tab-pane" id="captures'. $portfolio->id_body.'">';


                                $img = explode('-', $portfolio->screenshot_App);
                                for($i=0;$i<count($img)-1;$i++) //var_dump(count($img)-1);
                                    $content .='<br><img src="'.$img[$i].'" class="img-responsive" title="'.$portfolio->nom_entite.'"alt="'.$portfolio->nom_entite.'"/>';

                                $content .='</div>';
                           $content .='<div class="tab-pane" id="fonctionalites'.$portfolio->id_body.'">';

                            $content .='<div class=" col-lg-6">';
                            $content .='<h4 align="center"><u>Fonctionalités</u>:</h4>';
                            $content .='<em>';
                            $tab = explode('-', $portfolio->fonctionnalites);
                            for($j=1; $j<count($tab); $j++){
                            $content .= '#'.$j.'-'.$tab[$j].'<br>';
                            }
                             $content .= '</em>';
                             $content .='</div>';

                             $content .='<div class="right-sidebar col-lg-6" style="margin-top: initial;">';
                             $content .='<h4 align="center"><u>Caractéristiques</u>:</h4>';
                             $content .='<strong><u>Technologie</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->app_dev.'</small></em><br>';
                             $content .='<strong><u>Type</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->type_app.'</small></em><br>';
                             $content .=' <strong><u>Architecture</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->architecture.'</small></em><br>';
                             $content .='<strong><u>Méthode d\'Analyse</u>: </strong><em>';
                             $content .='<small>'.$portfolio->methode_analyse.'</small></em><br>';
                             $content .=' <strong>IDE:</strong><em>';
                             $content .='<small>'.$portfolio->ide.'</small></em><br>';
                             $content .='<strong><u>Langage</u>: </strong><em>';
                             $content .=' <small>'.$portfolio->langage.'</small></em><br>';
                             $content .='<strong><u>SGBD</u>: </strong><em>';
                             $content .='<small>'.$portfolio->sgbd.'</small></em><br>';
                             $content .='<strong><u>Outils</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->outils.'</small></em><br>';
                             $content .='<strong><u>Framework/CMS</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->framework.'</small></em><br>';
                             $content .='<strong><u>Déploiement</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->deploiement.'</small></em><br>';
                             $content .='<strong><u>Taille</u>: </strong> <em>';
                             $content .='<small>'.$portfolio->taille.' Mo</small></em><br>';
                             $content .='<strong><u>URL</u>: </strong> <em>';
                             $content .='<small><a href="'.$portfolio->url.'" alt="'.$portfolio->url.'" title="'.$portfolio->url.'">'.$portfolio->url.'</a></small></em><br>';
                             $content .='<strong><u>Code source</u>: </strong> <em>';
                             $content .='<small><a href="'.$portfolio->code_source.'" alt="'.$portfolio->code_source.'" title="'.$portfolio->code_source.'">'.$portfolio->code_source.'</a></small><br>';
                             $content .='</em></div></div></div></div>';

endforeach;
echo $content;
}



/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION REALISATION
   ========================================================================== */
if(isset($_POST['realisation'])){
    $info = '';
    foreach (\App::getDB()->query('
                            SELECT * FROM body
                            INNER JOIN page
                            ON body.ref_id_page=page.id_page
                            ORDER BY id_body DESC LIMIT 0, 4') as $projet):

        $info .= '<div class="col-lg-3">';
        $info .= '<div class="cta externe event-type center-element-container no-transition" style="background-color:#1b1b1b;">';
        $info .= '<a href="Portfolio?id_page=' . $projet->id_page . '#entreprise' . $projet->id_body . '" data-toggle="" data-target="" title=' . $projet->app_dev . ' class="transition page-scroll">';
        $info .= '<img data-src="" alt="Projet de Développement" class="bg img_responsive bg1" width="280" height="280"
                        title=' . $projet->app_dev . ' src="';
               $img = explode('-', $projet->screenshot_App);
               $info .= $img[0]. '">';
        $info .= '<div class="mask"></div><h3 class="text-center" style="font-size: small"><br><br><br><u>LIRE LA SUITE</u></h3>';
        $info .= '<div class="bottom">SORTIE:<div class="date">' . date('d/m/Y', strtotime($projet->annee)) . '</div></div>';
        $info .= '<div class="contentHover" style="font-size:small;"><i class="';
        if(strstr(strtolower($projet->type_app), "web")==true) $info .= 'fa fa-globe fa-2x'; else if(strstr(strtolower($projet->type_app), "mobile")==true) $info .= 'fa fa-mobile-phone fa-2x'; else $info .= 'fa fa-laptop fa-2x';
        $info .='"></i>Langage: ' . $projet->langage . '<br>IDE: ' . $projet->ide . '<br>SGBD: ' . $projet->sgbd . '<br>Framework: ' . $projet->framework . '<br>URL:' .  \App\Link\Parser_Link::urllink($projet->url) . '</div>';
        $info .= '<span class="border border-1"></span>
                        <span class="border border-2"></span>
                        <span class="border border-3"></span>
                        <span class="border border-4"></span>';
        $info .= '</a>';
        $info .= '</div>';
        $info .= '</div>';
    endforeach;

    echo $info;
}

/* ==========================================================================
SYSTEME DE CHARGEMENT APRES UN CLICK SUR LE BOUTON DANS LA HOMEPAGE SECTION REALISATION
   ========================================================================== */
if(isset($_POST['plus_realisations'])){
    $info = '';
    foreach (\App::getDB()->query('
                            SELECT * FROM body
                            INNER JOIN page
                            ON body.ref_id_page=page.id_page
                            ORDER BY id_body DESC') as $projet):

        $info .= '<div class="col-lg-3" style="margin-bottom: 25px;">';
        $info .= '<div class="cta externe event-type center-element-container no-transition" style="background-color:#1b1b1b;">';
        $info .= '<a href="Portfolio?id_page=' . $projet->id_page . '#entreprise' . $projet->id_body . '" data-toggle="" data-target="" title=' . $projet->app_dev . ' class="transition page-scroll">';
        $info .= '<img data-src="" alt="Projet de Développement" class="bg img_responsive" width="280" height="280"
                        title=' . $projet->app_dev . ' src="';
        $img = explode('-', $projet->screenshot_App);
        $info .= $img[0]. '">';
        $info .= '<div class="mask"></div><h3 class="text-center" style="font-size: small"><br><br><br><u>LIRE LA SUITE</u></h3>';
        $info .= '<div class="bottom">SORTIE:<div class="date">' . date('d/m/Y', strtotime($projet->annee)) . '</div></div>';
        $info .= '<div class="contentHover" style="font-size:small;"><i class="';
        if(strstr(strtolower($projet->type_app), "web")==true) $info .= 'fa fa-globe fa-2x'; else if(strstr(strtolower($projet->type_app), "mobile")==true) $info .= 'fa fa-mobile-phone fa-2x'; else $info .= 'fa fa-laptop fa-2x';
        $info .='"></i>Langage: ' . $projet->langage . '<br>IDE: ' . $projet->ide . '<br>SGBD: ' . $projet->sgbd . '<br>Framework: ' . $projet->framework . '<br>URL:' . \App\Link\Parser_Link::urllink($projet->url) . '</div>';
        $info .= '<span class="border border-1"></span>
                        <span class="border border-2"></span>
                        <span class="border border-3"></span>
                        <span class="border border-4"></span>';
        $info .= '</a>';
        $info .= '</div>';
        $info .= '</div>';
    endforeach;

    echo $info;
}


/* ==========================================================================
SYSTEME DE CHARGEMENT APRES UN PASSAGE AVEC LA SOURIS SUR LE BOUTON DANS LA HOMEPAGE SECTION REALISATION
   ========================================================================== */
if(isset($_POST['plus_realisations_title'])){
    $info = '';
    foreach (\App::getDB()->query('
                            SELECT id_body ,app_dev FROM body
                            INNER JOIN page
                            ON body.ref_id_page=page.id_page
                            ORDER BY id_body') as $projet):

        $info .= $projet->id_body.'# '.$projet->app_dev.'<br>';
    endforeach;

    echo $info;
}
/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION FONCTIONALITES
   ========================================================================== */
if(isset($_POST['fonctionnality']))
{
    $info = '';
     $i = 0;
    foreach (\App::getDB()->query('
                            SELECT type_app, app_dev, fonctionnalites FROM body
                            INNER JOIN page
                            ON body.ref_id_page=page.id_page
                            ORDER BY id_body DESC ') as $projet):

        $info .= '<div class="panel panel-default" style="background-color: inherit;">';
        $info .= '<div class="panel-heading" style="background-color: inherit; color: inherit;">';
        $info .= '<h6 class="panel-title">';
        $info .= '<a data-toggle="collapse" title="'.$projet->type_app.'" data-parent="#accordion" href="#collapse'.$i.'">'.$projet->app_dev.'</a>';
        $info .= '</h6>';
        $info .= '</div>';
        $info .= '<div id="collapse'.$i.'" class="panel-collapse collapse">';
        $tab = explode('-', $projet->fonctionnalites);
        $info .= '<div class="panel-body">';
           for($j=1; $j<count($tab); $j++){
               $info .= '#'.$j.'-'.$tab[$j].'<br>';
           }
        $info .='</div>';
        $info .= '</div>';
        $info .= '</div>';
        $i++;
    endforeach;

    echo $info;
}




/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION QUALIFICATION
   ========================================================================== */
if(isset($_POST['qualification']))
{
    $info = '';
    //Bloc Conception ou Intégration
    $requete1 = 'SELECT id_solutions,id_cat_solution, solutions.intitule AS titre_solution, solutions.description AS solution_description,
       categorie_solution.intitule AS titre_cat, categorie_solution.description AS description_cat FROM solutions
                            INNER JOIN categorie_solution
                            ON solutions.ref_cat_solution=categorie_solution.id_cat_solution
                            WHERE LOWER(categorie_solution.id_cat_solution)=1
                            ORDER BY id_solutions';

    $conception = \App::getDB()->prepare_request($requete1, []);
    $info .= '<h4 class="text-left col-lg-12" style="font-variant: small-caps;padding-top: initial; margin-top: initial"><em>#'.strtoupper($conception['id_cat_solution'].' '.$conception['titre_cat']).'</em></h4>';
    //D'Applications Mobile CrossPlate-Forme pour Android, Windows Phone, IOS et Universal Windows Plate-forme(UWP de Windows 10)
    foreach (\App::getDB()->query($requete1) as $projet):
        $info .= '<div class="col-lg-4" style="margin-bottom: 10px;">'.$projet->titre_solution.'</div>';
    endforeach;

    //BLOC maintenance
    $requete2 = 'SELECT id_solutions, id_cat_solution, solutions.intitule AS titre_solution, solutions.description AS solution_description,
       categorie_solution.intitule AS titre_cat, categorie_solution.description AS description_cat FROM solutions
                            INNER JOIN categorie_solution
                            ON solutions.ref_cat_solution=categorie_solution.id_cat_solution
                            WHERE LOWER(categorie_solution.id_cat_solution)=2
                            ORDER BY id_solutions';

   $maintenance = \App::getDB()->prepare_request($requete2, []);
   $info .= '<h4 class="text-left col-lg-12" style="font-variant: small-caps;padding-top: initial; margin-top: initial"><em>#'.strtoupper($maintenance['id_cat_solution'].' '.$maintenance['titre_cat']).'</em></h4>';
    foreach (\App::getDB()->query($requete2) as $projet):
        $info .= '<div class="col-lg-4" style="margin-bottom: 10px;">'.$projet->titre_solution.'</div>';
    endforeach;


    //BLOC maintenance
    $requete3 = 'SELECT id_solutions, id_cat_solution, solutions.intitule AS titre_solution, solutions.description AS solution_description,
       categorie_solution.intitule AS titre_cat, categorie_solution.description AS description_cat FROM solutions
                            INNER JOIN categorie_solution
                            ON solutions.ref_cat_solution=categorie_solution.id_cat_solution
                            WHERE LOWER(categorie_solution.id_cat_solution)=4
                            ORDER BY id_solutions';

    $maintenance = \App::getDB()->prepare_request($requete3, []);
    $info .= '<h4 class="text-left col-lg-12" style="font-variant: small-caps;padding-top: initial; margin-top: initial"><em>#'.strtoupper($maintenance['id_cat_solution'].' '.$maintenance['titre_cat']).'</em></h4>';
    foreach (\App::getDB()->query($requete3) as $projet):
        $info .= '<div class="col-lg-4" style="margin-bottom: 10px;">'.$projet->titre_solution.'</div>';
    endforeach;

    //BLOC INTEGRATION
    $requete4 = 'SELECT id_solutions, id_cat_solution, solutions.intitule AS titre_solution, solutions.description AS solution_description,
       categorie_solution.intitule AS titre_cat, categorie_solution.description AS description_cat FROM solutions
                            INNER JOIN categorie_solution
                            ON solutions.ref_cat_solution=categorie_solution.id_cat_solution
                            WHERE LOWER(categorie_solution.id_cat_solution)=5
                            ORDER BY id_solutions';

    $maintenance = \App::getDB()->prepare_request($requete4, []);
    $info .= '<h4 class="text-left col-lg-12" style="font-variant: small-caps;padding-top: initial; margin-top: initial"><em>#'.strtoupper($maintenance['id_cat_solution'].' '.$maintenance['titre_cat']).'</em></h4>';
    foreach (\App::getDB()->query($requete4) as $projet):
        $info .= '<div class="col-lg-4" style="margin-bottom: 10px;">'.$projet->titre_solution.'</div>';
    endforeach;

    echo $info;
}



/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION AGENDA ANNUEL
   ========================================================================== */
if(isset($_POST['agenda']))
{
    $info = '';
    foreach (\App::getDB()->query('
                            SELECT debut, fin, agenda.libelle AS titre_programme FROM agenda
                            ORDER BY id_agenda DESC ') as $projet):

        $info .= '<h5>Du '.date('d', $projet->debut).' au '.date('d M Y', $projet->fin).'</h5>
                  <p class="card-text">'.$projet->titre_programme.'</p>';
    endforeach;

    echo $info;
}


/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION ARTICLES
   ========================================================================== */
if(isset($_POST['article']))
{
    $info = '';
    foreach (\App::getDB()->query('
                            SELECT titre, categorie.libelle AS cat_libelle FROM sujets
                            INNER JOIN categorie
                            ON sujets.ref_id_categorie=categorie.id_categorie
                            ORDER BY id_sujet DESC 
                            LIMIT 1 ') as $projet):

        $info .= '<!-- Title -->
                        <h2 class="card-header-title mb-3">'.$projet->titre.'</h2>
                        <!-- Text -->
                        <p class="mb-0"><i class="fa fa-globe mr-2"></i> '.$projet->cat_libelle.'
                           <br><a style="margin: initial;padding: initial;" class="btn btn-primary homeArticleAside" href="Portfolio?id_page=7" title="Cliquez-Ici"><i class="fa fa-eye"></i> Voir</a>
                        </p>';
    endforeach;

    echo $info;
}


/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION COMMENTAIRES
   ========================================================================== */
if(isset($_POST['load_commentaire'])) {
    $info = '';

    if(isset($_GET['comment'])){
    foreach (App::getDB()->query('SELECT id_sujet, titre, commentaires, image, prenom, data_ajout_commentaires  FROM sujets
                                                                INNER JOIN comments
                                                                ON sujets.id_sujet=comments.ref_id_sujet
                                                                INNER JOIN compte
                                                                ON compte.id_compte=comments.ref_id_compte
                                                                ORDER BY data_ajout_commentaires DESC 
                                                                LIMIT 0, 2') AS $lastComment):

        $info .= ' <li class="list-group-item wow fadeInDown">
                                                <div class="row" style="word-wrap: break-word;">
                                                    <div class="col-xs-2 col-md-3" style="padding: initial; margin: initial;">
                                                        <img src="' . $lastComment->image . '" class="img-thumbnail" alt="' . $lastComment->titre . '" /></div>
                                                    <div class="col-xs-10 col-md-9" style="padding: initial; margin: initial;">
                                                        <div>
                                                            <a href="#" onclick="return false;">
                                                                ' . $lastComment->titre . '</a>
                                                            <div class="mic-info" style="font-size: 10px;">
                                                                By: <a href="#" onclick="return false;">' . $lastComment->prenom . '</a> le ' . date('d/m/Y à h\H i', $lastComment->data_ajout_commentaires) . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="comment-text">
                                                            ' . $lastComment->commentaires . '<br>
                                                            <div style="text-align: center!important"><u><a class="lireSuiteCommentaire" role="button" href="Portfolio?id_page=7&comments=' . $lastComment->id_sujet . '">Lire la Suite</a></u></div>
                                                        </div>
                                                </div>
                                            </li>';
    endforeach;
    echo $info;
}


    if(isset($_GET['more_comment']) && !empty($_GET['more_comment'])){

        foreach (App::getDB()->query('SELECT id_sujet, titre, commentaires, image, prenom, data_ajout_commentaires  FROM sujets
                                                                INNER JOIN comments
                                                                ON sujets.id_sujet=comments.ref_id_sujet
                                                                INNER JOIN compte
                                                                ON compte.id_compte=comments.ref_id_compte
                                                                ORDER BY data_ajout_commentaires DESC ') AS $lastComment):

            $info .= ' <li class="list-group-item wow fadeInDown">
                                                <div class="row" style="word-wrap: break-word;">
                                                    <div class="col-xs-2 col-md-3" style="padding: initial; margin: initial;">
                                                        <img src="'.$lastComment->image.'" class="img-thumbnail" alt="'.$lastComment->titre.'" /></div>
                                                    <div class="col-xs-10 col-md-9" style="padding: initial; margin: initial;">
                                                        <div>
                                                            <a href="#" onclick="return false;">
                                                                '.$lastComment->titre.'</a>
                                                            <div class="mic-info" style="font-size: 10px;">
                                                                By: <a href="#" onclick="return false;">'.$lastComment->prenom.'</a> le '.date('d/m/Y à h\H i', $lastComment->data_ajout_commentaires).'
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="comment-text">
                                                            '.$lastComment->commentaires.'<br>
                                                            <center><u><a role="button" href="Portfolio?id_page=7&comments='.$lastComment->id_sujet.'">Lire la Suite</a></u></center>
                                                        </div>
                                                </div>
                                            </li>';
        endforeach;

        echo $info;
    }

}





if(isset($_GET['singIn']))
{
    if(isset($_POST['emailSingIn'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['emailSingIn']) < 4 || strlen($_POST['emailSingIn']) > 20 ){
            echo '<br>L\'adresse Email est compris entre 3 et 16 caractères';
            exit;
        }

        if(is_numeric($_POST['emailSingIn'][0])){
            echo '<br>L\'adresse email doit commencer par une lettre';
            exit;
        }

        if(!filter_var($_POST['emailSingIn'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }


        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['emailSingIn'].'"');
        if($nbre <= 0){
            echo '<br>Votre Email n\'existe pas';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['passwordSingIn'])){

        nettoieProtect();
        extract($_POST);
        $passwordSingIn = preg_replace('#[^a-z0-9_-]#i', '', $passwordSingIn); //filter everything
        // Connexion à la base de données

        $connexion = App::getDB();
        if(strlen($passwordSingIn) < 4 || strlen($passwordSingIn) > 30 ){
            echo '<br>Le Mot de Passe est compris entre 4 et 30 caractères';
            exit;
        }

        $passwordSingIn = sha1($passwordSingIn);
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE password="'.$passwordSingIn.'"');
        if($nbre <= 0){
            echo '<br>Ce Mot de Passe n\'existe pas';
            exit;
        }
        else{
            echo 'success';
        }
    }

}



/* ==========================================================================
SYSTEME DE VERIFICATION DU FORMULAIRE INSCRIPTION
   ========================================================================== */
if(isset($_GET['singUp']))
{
    if(isset($_POST['nomSingUp'])){

        nettoieProtect();
        extract($_POST);
        $nomSingUp = preg_replace('#[^a-z0-9-_ ]#i', '', $nomSingUp); //filter everything

        if(strlen($nomSingUp) < 4 || strlen($nomSingUp) > 50 ){
            echo '<br>Le Nom est compris entre 3 et 50 caractères';
            exit;
        }

        if(is_numeric($nomSingUp[0])){
            echo '<br>Le Nom doit commencer par une lettre';
            exit;
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE nom="'.$nomSingUp.'"');
        if($nbre > 0){
            echo '<br> Ce Nom est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }

    if(isset($_POST['prenomSingUp'])){

        nettoieProtect();
        extract($_POST);
        $prenomSingUp = preg_replace('#[^a-z0-9-_ ]#i', '', $prenomSingUp); //filter everything

        if(strlen($prenomSingUp) < 4 || strlen($prenomSingUp) > 50 ){
            echo '<br>Le Prenom est compris entre 3 et 50 caractères';
            exit;
        }

        if(is_numeric($prenomSingUp[0])){
            echo '<br>Le Prenom doit commencer par une lettre';
            exit;
        }
        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE prenom="'.$prenomSingUp.'"');
        if($nbre > 0){
            echo '<br> Ce Prenom est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['emailSingUp'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['emailSingUp']) < 4 || strlen($_POST['emailSingUp']) > 50 ){
            echo '<br>L\'adresse Email est compris entre 3 et 50 caractères';
            exit;
        }

        if(is_numeric($_POST['emailSingUp'][0])){
         echo '<br>L\'adresse email doit commencer par une lettre';
         exit;
          }

        if(!filter_var($_POST['emailSingUp'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['emailSingUp'].'"');
        if($nbre > 0){
            echo '<br> Cet Email est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    /*if(isset($_POST['passwordSingUp'])){

        nettoieProtect();
        extract($_POST);
        $passwordSingUp = preg_replace('#[^a-z0-9]#i', '', $passwordSingUp); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../../App/Config/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($passwordSingUp) < 4 || strlen($passwordSingUp) > 16 ){
            echo '<br>Le Mot de Passe est compris entre 3 et 16 caractères';
            exit;
        }

        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE password="'.$passwordSingUp.'"');
        if($nbre > 0){
            echo '<br> Ce Mot de Passe est déjà utilisé';
            exit;
        }
        else{

            file_put_contents('password.txt', '');
            file_put_contents('password.txt', $passwordSingUp);
           /* $monfichier = fopen("password.txt", "r+");
            fputs($monfichier, $passwordSingUp); // On écrit le nouveau nombre de pages vues
            fclose($monfichier);*/
      /*      echo 'success';
        }
    }*/


        if(isset($_POST['passwordConfirmSingUp']) && isset($_POST['passwordSingUp'])){

            nettoieProtect();
            extract($_POST);
           /* $passwordConfirmSingUp = preg_replace('#[^a-z0-9]#i', '', $passwordConfirmSingUp); //filter everything
            $monfichier = fopen("password.txt", "r+");
            $mdp = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
            fclose($monfichier);*/


            if(strlen($passwordConfirmSingUp) < 5 || strlen($passwordSingUp) < 5 ){
                echo '<br>Trop court (5 caractères Minimum)';
                exit;
            }

            if($passwordConfirmSingUp != $passwordSingUp){
                echo '<br>Les deux mots de passe sont différents';
                exit;
            }

            else{
                echo 'success';
            }
        }
}


/* ==========================================================================
SYSTEME DE VERIFICATION DE LA SECTION NEWSLETTER
   ========================================================================== */

if(isset($_GET['newsletter']))
{

    if(isset($_POST['newsletter'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['newsletter']) < 4 || strlen($_POST['newsletter']) > 20 ){
            echo 'L\'adresse Email est compris entre 3 et 16 caractères<br>';
            exit;
        }

        if(!filter_var($_POST['newsletter'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo 'Votre Adresse E-mail n\'est pas valide<br>';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_newsletter FROM newsletter WHERE email_newsletter="'.$_POST['newsletter'].'"');
        if($nbre > 0){
            echo 'Cet Email est déjà utilisé<br>';
            exit;
        }
        else{
            echo 'success';
        }
    }
}







/* ==========================================================================
SYSTEME DE VERIFICATION DE LA SECTION CONTACT
   ========================================================================== */

if(isset($_GET['visitor']))
{

    if(isset($_POST['identite_visitor'])){

        nettoieProtect();
        extract($_POST);
        $identite_visitor = preg_replace('#[^a-z0-9]#i', '', $identite_visitor); //filter everything

        if(strlen($identite_visitor) < 4 || strlen($identite_visitor) > 16 ){
            echo 'Le Nom est compris entre 3 et 16 caractères';
            exit;
        }

        if(is_numeric($identite_visitor[0])){
            echo 'Le Nom doit commencer par une lettre';
            exit;
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_visiteur FROM visiteur WHERE nom_prenom_visiteur="'.$identite_visitor.'"');
        if($nbre > 0){
            echo '<br> Ce Nom est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['email_visitor'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['email_visitor']) < 4 || strlen($_POST['email_visitor']) > 20 ){
            echo 'L\'adresse Email est compris entre 3 et 16 caractères<br>';
            exit;
        }

        if(!filter_var($_POST['email_visitor'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo 'Votre Adresse E-mail n\'est pas valide<br>';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_visiteur  FROM visiteur WHERE email_visiteur="'.$_POST['email_visitor'].'"');
        if($nbre > 0){
            echo 'Cet Email est déjà utilisé<br>';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['message_visitor'])){

        nettoieProtect();
        extract($_POST);
        $message_visitor = preg_replace('#[^a-z0-9]#i', '', $message_visitor); //filter everything

        if(strlen($message_visitor) < 4 || strlen($message_visitor) > 1000 ){
            echo 'Le Message est compris entre 3 et 1000 caractères';
            exit;
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_visiteur FROM visiteur WHERE message_visiteur="'.$message_visitor.'"');
        if($nbre > 0){
            echo '<br> Ce Message est déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }
}


/* ==========================================================================
SYSTEME DE RECUPERATION DU MOT DE PASSE
   ========================================================================== */
if(isset($_GET['getEmail'])){

    if(isset($_POST['getEmail'])){

        nettoieProtect();
        extract($_POST);

        if(strlen($_POST['getEmail']) < 4 || strlen($_POST['getEmail']) > 20 ){
            echo '<br>L\'adresse Email est compris entre 3 et 16 caractères';
            exit;
        }

        if(!filter_var($_POST['getEmail'], FILTER_VALIDATE_EMAIL)) { //Validation d'une adresse de messagerie.
            echo '<br>Votre Adresse E-mail n\'est pas valide';
            exit();
        }

        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['getEmail'].'"');
        if($nbre <= 0){
            echo '<br>Votre Adresse Email n\'existe pas dans nos données';
            exit;
        }
        else{
            echo 'success';
        }
    }
}


if(isset($_GET['commentaire']))
{
    nettoieProtect();
    extract($_POST);
    $contenuCommentaireUser = preg_replace('#[^a-z0-9]#i', '', $contenuCommentaireUser); //filter everything

    if(strlen($contenuCommentaireUser) < 4 || strlen($contenuCommentaireUser) > 5000 ){
        echo 'Le Commentaire est compris entre 3 et 5000 caractères';
        exit;
    }

    /*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;*/

    $connexion = App::getDB();
    /*$id_visiteur = $connexion->query('SELECT id_visiteur FROM compte
                                              INNER JOIN visiteur
                                              ON compte.id_compte=visiteur.ref_id_compte','', true);*/

    $nbre = $connexion->rowCount('SELECT id_commentaires FROM comments WHERE commentaires="'.$contenuCommentaireUser.'" AND ref_id_compte="'.$compte.'"');
    if($nbre > 0){
        echo '<br> vous avez déjà écrit un Message identique';
        exit;
    }
    else{
        echo 'success';
    }
}


/* ==========================================================================
SYSTEME DE GESTION DES REPONSES DES COMMENTAIRES
   ========================================================================== */
if(isset($_POST['reponse_commentaire_contenu']))
{
    nettoieProtect();
    extract($_POST);
    $_POST['reponse_commentaire_contenu'] = preg_replace('#[^a-z0-9]#i', '', $_POST['reponse_commentaire_contenu']); //filter everything

    if(strlen($_POST['reponse_commentaire_contenu']) < 4 || strlen($_POST['reponse_commentaire_contenu']) > 5000 ){
        echo '<br>Le Commentaire est compris entre 3 et 5000 caractères';
        exit;
    }

    /*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;*/

    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_feedback FROM feedback_comments WHERE reactions_commentaires="'.$_POST['reponse_commentaire_contenu'].'" AND ref_id_compte="'.$compte.'"');
    if($nbre > 0){
        echo '<br> Vous avez déjà écrit un message identique';
        exit;
    }
    else{
        echo 'success';
    }
}





if(isset($_POST['vue_commentaires'])){
    $output = '';
    $i = 0;

    /*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;
    $connexion = App::getDB();
    $info = $connexion->prepare_request('SELECT prenom FROM compte WHERE id_compte=:id', ['id'=>$compte]);*/

    foreach (App::getDB()->query('SELECT id_commentaires, commentaires, data_ajout_commentaires, prenom FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$_SESSION['id_sujet'].'"
                                            ORDER BY id_commentaires DESC') AS $comment):
        $output .= '<article class="commentaire">
            <div class="commentaire-wrapper">
                <header>
                    <img class="commentaire-avatar" src="../Public/img/blog_img/avatar.png" alt="Gravatar de Malnux Starck" width="25">
                    <span class="commentaire-auteur">'.$comment->prenom.'</span>
                    <time datetime="2016-07-10CEST04:09:09">'.date('d/m/Y à H\hi', $comment->data_ajout_commentaires).' </time>
                </header>

                <div class="commentaire-contenu">'.\App\Link\Parser_Link::urllink(nl2br($comment->commentaires)).'</div>
                <a href="#" data="'.$comment->id_commentaires.'" class="commentaire-repondre" data-toggle="collapse" data-target="#commentaire-reponses'.$i.'">Répondre</a>
            </div>

          <div id="commentaire-reponses'.$i.'" class="commentaire-reponses collapse" style="margin: 25px 0 0">';
        /*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
        else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
        else $compte = 0;*/
        $connexion = App::getDB();
        $info = $connexion->prepare_request('SELECT prenom, email FROM compte WHERE id_compte=:id', ['id'=>$compte]);

              $output .='<form id="reponse_commentaires_form'.$i.'"  method="post" class="ajouter-commentaire" onsubmit="return false;">
                <img class="commentaire-avatar" src="../Public/img/blog_img/avatar.png" alt="Votre gravatar" width="25">
                <input type="text" id="reponse_username" name="reponse_username" required="required" placeholder="'.$info['prenom'].'" class="commentaire-input commentaire-pseudo neutral_input" disabled>
                <input type="email" id="reponse_email" name="reponse_email" required="required" placeholder="'.$info['email'].'" class="commentaire-input commentaire-email neutral_input" disabled>
                        
                <textarea data="'.$i.'" id="reponse_commentaire_contenu'.$i.'" name="reponse_commentaire_contenu'.$i.'" required="required" placeholder="Commentaire" rows="3" class="neutral_input" style="overflow: hidden; min-height: 3em; height: 32px;"></textarea>
                <div class="autogrow-textarea-mirror" style="display: none; overflow-wrap: break-word; padding: 10px 3.48438px; width: 343.031px; font-family: Sansation, &quot;Trebuchet MS&quot;, Helvetica, Verdana, sans-serif, serif; font-size: 16px; line-height: normal;">.<br>.</div><div class="autogrow-textarea-mirror" style="display: none; overflow-wrap: break-word; padding: 10px 3.48438px; width: 343.031px; font-family: Sansation, &quot;Trebuchet MS&quot;, Helvetica, Verdana, sans-serif, serif; font-size: 16px; line-height: normal;">.<br>.</div>
                
                <span class="commentaire-error-msg-reponse"></span>

                <input id="enreg_reponse_commentaires'.$i.'" type="submit" value="Répondre" class="neutral_input" style="margin: 10px 30px 15px 0">
                </form>
               </div>';

        foreach (App::getDB()->query('SELECT id_feedback, reactions_commentaires, date_ajout_react, prenom FROM feedback_comments
                                                     INNER JOIN compte
                                                     ON feedback_comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN comments
                                                     ON feedback_comments.ref_id_commentaires=comments.id_commentaires
                                                     WHERE feedback_comments.ref_id_commentaires="'.$comment->id_commentaires.'"
                                            ORDER BY id_feedback DESC') AS $feedback):

            $output .= '<div class="reaction" style="margin: 25px 0 0">
              <div class="commentaire-wrapper">
                <header>
                    <img class="commentaire-avatar" src="../Public/img/blog_img/avatar.png" alt="Gravatar de Malnux Starck" width="25">
                    <span class="commentaire-auteur">'.$feedback->prenom.'</span>
                    <time datetime="2016-07-10CEST04:09:09">'.date('d/m/Y à H\hi', $feedback->date_ajout_react).' </time>
                </header>

                <div class="commentaire-contenu">'.\App\Link\Parser_Link::urllink(nl2br($feedback->reactions_commentaires)).'</div>

            </div>
            </div>';
            endforeach;

        $output .= '</article>';
        $i++;
    endforeach;
  //  $count = $connexion->rowCount('SELECT * FROM body WHERE notification_vue="0"');
    $data = array (
        'notifOnComments' => $output/*,
        'unseen_notification' => $count*/
    );


    echo json_encode($data);

    /*$monfichier = fopen("compteur.txt", "r+");
     $pages_vues = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
     $pages_vues++; // On augmente de 1 ce nombre de pages vues
     fseek($monfichier, 0); // On remet le curseur au début du fichier
     fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues
    fclose($monfichier);
    */
}





/* ==========================================================================
SYSTEME DE GESTION DES REPONSES DES COMMENTAIRES
   ========================================================================== */
/*if(isset($_GET['reponse'])) {

    if(strlen($_POST['reponse_commentaire_contenu']) < 4 || strlen($_POST['reponse_commentaire_contenu']) > 5000 ){
        echo 'Le Commentaire est compris entre 3 et 5000 caractères';
        exit;
    }

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/
  //  $_POST['reponse_commentaire_contenu'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['reponse_commentaire_contenu'])))), ENT_QUOTES);


    // Connexion à la base de données
    /*$connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_reactions FROM feedback_comments WHERE reactions_commentaires="'.$_POST['reponse_commentaire_contenu'].'"');

    if($nbre > 0){
        echo 'Ce Commentaire existe déjà';
        exit;
    }

    else {
        nettoieProtect();
        extract($_POST);
        /* $connexion->query('
                             SELECT id_compte FROM compte
                             ');*/

        /*$connexion->insert('
         INTO feedback_comments(reactions_commentaires, date_ajout_react) VALUES (:comments, :temps)',
            ['comments'=>$_POST['reponse_commentaire_contenu'], 'temps'=>time()]);*/
        /* $newsletter = $connexion->prepare_request('SELECT id_newsletter FROM newsletter WHERE email_newsletter=:email', array('email'=>$_POST['email_visitor']));
         if($newsletter['id_newsletter'] == null)
         {
             $newsletter['id_newsletter'] = 0;
             $connexion->insert('INSERT INTO visiteur(ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur)
                                       VALUES(?,?,?,?,?,?)', [$newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
         }
         else{
             $connexion->insert('INSERT INTO visiteur(ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur)
                                       VALUES(?,?,?,?,?,?)', [$newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
         }*/
        /*header('location: ../../Public/Portfolio?id_page=7');
    }

}*/




/* ==========================================================================
SYSTEME DE GESTION DE RECHERCHES INSTANTANEES
========================================================================== */

 if(isset($_GET['search_contenu']))
{
        $result = '';
        $_GET['search_contenu'] = htmlentities((stripslashes(htmlspecialchars($_GET['search_contenu']))), ENT_QUOTES);
        $_GET['search_contenu'] = strip_tags(trim($_GET['search_contenu'])); //supprimes balises html et supprime les espaces
        $connexion = App::getDB();
        $nbre = $connexion->rowCount('SELECT sujets.titre, sujets.paragraphe, categorie.libelle FROM sujets
                                                    INNER JOIN categorie
                                                    ON sujets.ref_id_categorie=categorie.id_categorie
                                                    WHERE sujets.paragraphe LIKE "%'.$_GET['search_contenu'].'%" OR sujets.titre LIKE "%'.$_GET['search_contenu'].'%" OR categorie.libelle LIKE "%'.$_GET['search_contenu'].'%" ');

        if($nbre <= 0){
            $result .= 'Aucun';
        }
        else{
            foreach (App::getDB()->query('SELECT id_sujet, sujets.titre, sujets.paragraphe, sujets.mot_cles, sujets.image,
                                                     sujets.date_enreg, categorie.libelle FROM sujets
                                                    INNER JOIN categorie
                                                    ON sujets.ref_id_categorie=categorie.id_categorie
                                                    WHERE sujets.paragraphe LIKE "%'.$_GET['search_contenu'].'%" 
                                                    OR sujets.titre LIKE "%'.$_GET['search_contenu'].'%"
                                                     OR categorie.libelle LIKE "%'.$_GET['search_contenu'].'%"
                                                     ORDER BY id_sujet DESC ') AS $blog_item):

                $result .= '
<article class="col-xs-12 col-sm-10 col-lg-10">
                         <!--BLOC 1-->
          <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a data="articles=' . intval($blog_item->id_sujet) . '" href="#" class="link_articles" title="' . $blog_item->titre . '">' .
                    $blog_item->titre
                    . '</a>
        </h1>
         <p class="blog-article-1-p-1">';
                $parser->parse(substr($blog_item->paragraphe, MIN_CHARACTER, MAX_CHARACTER));
                $result .= \App\Link\Parser_Link::urllink($parser->getAsHTML());
                $result .= '</p>';
                $result .= '<p class="blog-article-1-p-2">
            <a data="articles=' . intval($blog_item->id_sujet) . '" href="#" class="link_articles" tabindex="-1" title="' . $blog_item->titre . '">Lire la suite</a>
        </p>
        </div>
                         <!--BLOC 2-->
          <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">' . date('d', strtotime($blog_item->date_enreg)) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', strtotime($blog_item->date_enreg)) . '</span><br>
                                <span class="year">' . date('Y', strtotime($blog_item->date_enreg)) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', strtotime($blog_item->date_enreg)) . ':' . date('i', strtotime($blog_item->date_enreg)) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie '.$blog_item->libelle.'">'.$blog_item->libelle.'</a>
        <a data="articles=' . intval($blog_item->id_sujet) . '" href="#" class="comments link_articles">';
                $resultat = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.intval($blog_item->id_sujet).'"');
                if($resultat==1)
                    $result .= ' Un Commentaire';
                else if($resultat==0)
                    $result .= $resultat.' Commentaire';
                else
                    $result .= $resultat .' Commentaires';
                $result .= '</a>
                <a style="top: 130px;" href="#" onclick="return false;" data-title="Lire Les Réactions des Commentaires" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     INNER JOIN feedback_comments
                                                     ON comments.id_commentaires=feedback_comments.ref_id_commentaires
                                                     WHERE sujets.id_sujet="'.$blog_item->id_sujet.'"');
                if($totalComments==1)
                    $result .=' Un Commentaire Réagit';
                else if($totalComments==0)
                    $result .= $totalComments.' Commentaire Réagit';
                else
                    $result .= $totalComments.' Commentaires Réagit';
                $result .= '</a>
                <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
                <a href="#" onclick="return false;" class="nav-js" data-destination="blog" data-title="'.$blog_item->mot_cles.'">';
                $keyword = explode(';', $blog_item->mot_cles);
                for($j=0; $j<count($keyword); $j++)
                    $result .= '#'.$keyword[$j].'<br>';
                $result.='</a>
                <br>
            </p>
        </div>
      <!---------------------------------->
       </div>
    </div>
                         <!--BLOC 3-->
          <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a data="articles=' . intval($blog_item->id_sujet) . '" class="link_articles" href="#" tabindex="-1">
                <img class="img-responsive" src="' . $blog_item->image . '" alt="' . $blog_item->titre . '" title="' . $blog_item->titre . '">
            </a>
    </div>
</article>
        ';
            endforeach;


        }
        $data = array (
            'resultat' => $result,
            'compteur' => $nbre
        );


        echo json_encode($data);

}




/* ==========================================================================
SYSTEME DE GESTION DES ARTICLES CLIQUES PAR L'UTILISATEUR
========================================================================== */

if(isset($_POST['articles_click']))
{
    $_SESSION['id_sujet'] = $_POST['articles_click'];
    foreach (App::getDB()->query('SELECT id_sujet, titre, paragraphe, mot_cles, image, sujets.date_enreg, libelle FROM sujets
                                            INNER JOIN categorie
                                            ON categorie.id_categorie=sujets.ref_id_categorie
                                            WHERE id_sujet="'.intval($_POST['articles_click']).'" ORDER BY id_sujet DESC') AS $blog_item):

        echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                       <!--BLOC 1-->
            <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a data="articles='.intval($blog_item->id_sujet) . '" href="#" class="link_articles" title="'.$blog_item->titre.'">'.
            $blog_item->id_sujet.'# '.$blog_item->titre
            .'</a>
        </h1>
            <p class="blog-article-1-p-1">';
    /*$affichage = new \App\BBCodeParser\AfficheBBCode();
    echo $affichage->getHtmlFromBBCode($blog_item->paragraphe);*/
        //$parser = new JBBCode\Parser();
        $parser->addBBCode("quote", '<div class="quote">{param}</div>', true, true);
        $parser->addBBCode("quote", '<div class="quote">{param}</div>', false, false);
        $parser->addBBCode("size", '<span style="font-size:{option}%;">{param}</span>', true, true);
        $parser->addBBCode("code", '<pre class="code">{param}</pre>', false, false, 1);
        $parser->addBBCode("video", '<div style="overflow:hidden; "><iframe width="300" height="200" src="http://www.youtube.com/embed/{param}" frameborder="0" allowfullscreen></iframe></div>', false, false, 1);
        $parser->addBBCode("img", '<a href="{param}" class="imagebox" rel="imagebox" style="overflow: hidden;"><img class="bbimage img-responsive" alt="" src="{param}"></a>');        $parser->addBBCode("url", '<a href="{param}" target="_blank" rel="nofollow">{param}</a>', false, false);
        $parser->addBBCode("url", '<a href="{option}" target="_blank" rel="nofollow">{param}</a>', true, true);
        $parser->addBBCode("center", '<div align="center">{param}</div>');
        $parser->addBBCode("left", '<div align="left">{param}</div>');
        $parser->addBBCode("right", '<div align="right">{param}</div>');
        $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
        $resultatEncode= str_replace("&lt;br /&gt;", " ", nl2br($blog_item->paragraphe));
        $parser->parse($resultatEncode);
        echo \App\Link\Parser_Link::urllink($parser->getAsHtml());
        echo '</p>
        <aside class="social">
        <div class="col-xs-12 col-md-3 col-lg-6">
                    Par <cite itemprop="author">bertin.dev <span class="screen">(Bertin Mounok)</span></cite>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-2">
                       <button title="partager sur Facebook" class="button share_facebook btn btn-primary" style="width: 100%; background-color: #3b5998;font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=7&article='.intval($blog_item->id_sujet) . '">
                        Facebook</button>
                        </div>
                        <div class="col-xs-12 col-md-3 col-lg-2">
                        <button title="partager sur Twitter" style="width: 100%; background-color: #00aced;font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" class="button share_twitter btn btn-primary" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=7&article='.intval($blog_item->id_sujet) . '">
                        <i class="fa fa-share"></i>Twitter</button>
                        </div>
                        <div class="col-xs-12 col-md-3 col-lg-2">
                        <button title="partager sur LinkedIn" style="width: 100%; background-color: #0077b5; font-size: 10px; margin-bottom: 2px; padding: 6px 1px;" class="button share_linkedin btn btn-primary" data-url="https://www.bertin-mounok.com/Public/Portfolio?id_page=7&article='.intval($blog_item->id_sujet) . '">
                        <i class="fa fa-share"></i>LinkedIn</button>
                        </div>
         </aside>
        </div>
                       <!--BLOC 2-->
            <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">'.date('d', strtotime($blog_item->date_enreg)).'</span>
                            <span class="month-year">
                                <span class="month">'.date('M', strtotime($blog_item->date_enreg)).'</span><br>
                                <span class="year">'.date('Y', strtotime($blog_item->date_enreg)).'</span>
                            </span>
                        </span>
            <span class="time">'.date('H', strtotime($blog_item->date_enreg)).':'.date('i', strtotime($blog_item->date_enreg)).'</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie '.$blog_item->libelle.'">'.$blog_item->libelle.'</a>
   

        <a data="articles=' . intval($blog_item->id_sujet) . '" data-title="Lire les Commentaires" href="#" class="comments link_articles">';
        $resultComment =  App::getDB()->rowCount('SELECT commentaires, data_ajout_commentaires, prenom FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$_SESSION['id_sujet'].'"');
        if($resultComment==1)
            echo ' Un Commentaire';
        else if($resultComment==0)
            echo $resultComment.' Commentaire';
        else
            echo $resultComment .' Commentaires';
        echo '</a>
        <a style="top: 130px;" href="#" onclick="return false;" data-title="Lire Les Réactions des Commentaires" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     INNER JOIN feedback_comments
                                                     ON comments.id_commentaires=feedback_comments.ref_id_commentaires
                                                     WHERE sujets.id_sujet="'.$blog_item->id_sujet.'"');
                if($totalComments==1)
                    echo ' Un Commentaire Réagit';
                else if($totalComments==0)
                    echo $totalComments.' Commentaire Réagit';
                else
                    echo $totalComments.' Commentaires Réagit';
                echo '</a>
          <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
              <a href="#" onclick="return false;" class="nav-js" data-destination="blog" data-title="'.$blog_item->titre.'">';
                $keyword = explode(';', $blog_item->mot_cles);
                for($j=0; $j<count($keyword); $j++)
                    echo '#'.$keyword[$j].'<br>';
              echo '</a>
                <br>
            </p>
        </div>
      <!---------------------------------->
       </div>
    </div>   
                      <!--BLOC 3-->
            <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a data="articles=' . intval($blog_item->id_sujet) . '" class="link_articles" href="#" tabindex="-1">
                <img class="img-responsive" src="'.$blog_item->image.'" alt="'.$blog_item->titre.'" title="'.$blog_item->titre.'">
            </a>
            <!----------------->
         
            <div id="commentaires" class="commentaires">';
        /*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
        else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
        else $compte = 0;*/
        $connexion = App::getDB();
        $info = $connexion->prepare_request('SELECT prenom, email, profil FROM compte WHERE id_compte=:id', ['id'=>$compte]);

        echo '<form id="commentaire_user" action="" method="post" class="ajouter-commentaire" onsubmit="return false;">
        <img class="commentaire-avatar" src="'; echo (isset($info['profil']) && !empty($info['profil']))?$info['profil']:'../Public/img/blog_img/avatar.png'; echo '" alt="Votre gravatar" width="25">
        <input type="text" id="username" name="username" required="required" placeholder="'.$info['prenom'].'" class="commentaire-input commentaire-pseudo neutral_input" disabled>
        <input type="email" id="emailuser" name="emailuser" required="required" placeholder="'.$info['email'].'" class="commentaire-input commentaire-email neutral_input" value="" disabled>

        <textarea id="contenuCommentaireUser" name="contenuCommentaireUser" required="required" placeholder="Commentaire" rows="3" class="neutral_input" style="overflow: hidden; min-height: 3em; height: 32px;"></textarea>
        <div class="autogrow-textarea-mirror" style="display: none; overflow-wrap: break-word; padding: 10px 3.39063px; width: 333.219px; font-family: Sansation, &quot;Trebuchet MS&quot;, Helvetica, Verdana, sans-serif, serif; font-size: 16px; line-height: normal;">.<br>.</div>
        <input type="hidden" id="tokenuser" name="tokenuser" value="$tokenuser" class="neutral_input">

        <span class="commentaire-error-msg"></span>
        <input id="enreg_commentaires" type="submit" value="Envoyer" class="neutral_input" style="margin: 10px 30px 10px 5px;"> 
        
    </form>
    <div class="commentaires-liste"></div>
    
          </div>
</article>
        ';
    endforeach;
}

/* ==========================================================================
SYSTEME DE LA ZONE CATEGORIE DU BLOG
   ========================================================================== */
if(isset($_POST['categorie']))
{
    $blog = App::getDB()->compteur_start_end('SELECT id_sujet, titre, paragraphe, mot_cles, image, sujets.date_enreg, id_categorie, libelle FROM sujets
                                                  INNER JOIN categorie 
                                                  ON categorie.id_categorie=sujets.ref_id_categorie
                                                  WHERE id_categorie=:id_cat
                                                  ORDER BY id_sujet DESC');
    $blog->bindParam(':id_cat', intval($_POST['categorie']) , PDO::PARAM_INT);
    $blog->execute();
    while ($blog_item = $blog->fetch()) {
        echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                         <!--BLOC 1-->
          <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" title="' . $blog_item['titre'] . '">' .
            $blog_item['titre']
            . '</a>
        </h1>
                  <p class="blog-article-1-p-1">';
                $parser->parse(substr($blog_item['paragraphe'], MIN_CHARACTER, MAX_CHARACTER));
                echo \App\Link\Parser_Link::urllink($parser->getAsHTML());
               echo '</p>';
         echo '<p class="blog-article-1-p-2">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" tabindex="-1" title="' . $blog_item['titre'] . '">Lire la suite</a>
        </p>
        </div>
                         <!--BLOC 2-->
          <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">' . date('d', strtotime($blog_item['date_enreg'])) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', strtotime($blog_item['date_enreg'])) . '</span><br>
                                <span class="year">' . date('Y', strtotime($blog_item['date_enreg'])) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', strtotime($blog_item['date_enreg'])) . ':' . date('i', strtotime($blog_item['date_enreg'])) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie '.$blog_item['libelle'] .'">'.$blog_item['libelle'] .'</a>
        <a data="articles=' . intval($blog_item['id_sujet']) . '" data-title="Lire les Commentaires" href="#" class="comments link_articles">';
        $resultat = App::getDB()->rowCount('SELECT * FROM comments 
                                                         INNER JOIN sujets
                                                         ON comments.ref_id_sujet=sujets.id_sujet
                                                         INNER JOIN categorie
                                                         ON categorie.id_categorie=sujets.ref_id_categorie
                                                        WHERE sujets.id_sujet = "'.$blog_item['id_sujet'].'" AND categorie.id_categorie="'.intval($_POST['categorie']).'"');
        if($resultat==1)
            echo ' Un Commentaire';
        else if($resultat==0)
            echo $resultat.' Commentaire';
        else
            echo $resultat .' Commentaires';
        echo '</a>
        <a style="top: 130px;" href="#" onclick="return false;" data-title="Lire Les Réactions des Commentaires" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     INNER JOIN feedback_comments
                                                     ON comments.id_commentaires=feedback_comments.ref_id_commentaires
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
                if($totalComments==1)
                    echo ' Un Commentaire Réagit';
                else if($totalComments==0)
                    echo $totalComments.' Commentaire Réagit';
                else
                    echo $totalComments.' Commentaires Réagit';
                echo '</a>
        <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
               <a href="#" onclick="return false;" class="nav-js" data-destination="blog" data-title="'.$blog_item['titre'].'">';
                $keyword = explode(';', $blog_item['mot_cles']);
                for($j=0; $j<count($keyword); $j++)
                    echo '#'.$keyword[$j].'<br>';
              echo '</a>
                <br>
            </p>
        </div> 
      <!---------------------------------->
       </div>
    </div>
                         <!--BLOC 3-->
          <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" tabindex="-1" class="link_articles">
                <img class="img-responsive" src="' . $blog_item['image'] . '" alt="' . $blog_item['titre'] . '" title="' . $blog_item['titre'] . '">
            </a>
    </div>
</article>
        ';
    }//fin de while
}


/* ==========================================================================
SYSTEME DE LA ZONE ARCHIVE DU BLOG
   ========================================================================== */
if(isset($_POST['m']) && isset($_POST['y']))
{
    extract($_REQUEST);
    $blog = App::getDB()->compteur_start_end('SELECT id_sujet, titre, paragraphe, mot_cles, image, sujets.date_enreg, libelle FROM sujets 
                                                            INNER JOIN categorie
                                                            ON categorie.id_categorie=sujets.ref_id_categorie
                                                            WHERE YEAR(sujets.date_enreg)=:annee AND MONTH(sujets.date_enreg)=:mois              
                                                            ORDER BY id_sujet DESC');
    $blog->bindParam(':annee', $y , PDO::PARAM_INT);
    $blog->bindParam(':mois', $m , PDO::PARAM_INT);
    $blog->execute();
    while ($blog_item = $blog->fetch()) {
        echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                         <!--BLOC 1-->
          <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" title="' . $blog_item['titre'] . '">' .
            $blog_item['titre']
            . '</a>
        </h1>
              <p class="blog-article-1-p-1">';
                $parser->parse(substr($blog_item['paragraphe'], MIN_CHARACTER, MAX_CHARACTER));
                echo \App\Link\Parser_Link::urllink($parser->getAsHTML());
               echo '</p>';
         echo '<p class="blog-article-1-p-2">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" class="link_articles" href="#" tabindex="-1" title="' . $blog_item['titre'] . '">Lire la suite</a>
        </p>
        </div>
                         <!--BLOC 2-->
          <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">' . date('d', strtotime($blog_item['date_enreg'])) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', strtotime($blog_item['date_enreg'])) . '</span><br>
                                <span class="year">' . date('Y', strtotime($blog_item['date_enreg'])) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', strtotime($blog_item['date_enreg'])) . ':' . date('i', strtotime($blog_item['date_enreg'])) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie '.$blog_item['libelle'].'">'.$blog_item['libelle'].'</a>
        <a data="articles=' . intval($blog_item['id_sujet']) . '" data-title="Lire les Commentaires" href="#" class="comments link_articles">';
        $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
        if($totalComments==1)
            echo ' Un Commentaire';
        else if($totalComments==0)
            echo $totalComments.' Commentaire';
        else
            echo $totalComments.' Commentaires';
        echo '</a>
        <a style="top: 130px;" href="#" onclick="return false;" data-title="Lire Les Réactions des Commentaires" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     INNER JOIN feedback_comments
                                                     ON comments.id_commentaires=feedback_comments.ref_id_commentaires
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
                if($totalComments==1)
                    echo ' Un Commentaire Réagit';
                else if($totalComments==0)
                    echo $totalComments.' Commentaire Réagit';
                else
                    echo $totalComments.' Commentaires Réagit';
                echo '</a>
        
          <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
           <a href="#" onclick="return false;" class="nav-js" data-destination="blog" data-title="'.$blog_item['titre'].'">';
                $keyword = explode(';', $blog_item['mot_cles']);
                for($j=0; $j<count($keyword); $j++)
                    echo '#'.$keyword[$j].'<br>';
              echo '</a>
            <br>
            </p>
        </div>
      <!---------------------------------->
       </div>
    </div>
                         <!--BLOC 3-->
          <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" tabindex="-1" class="link_articles">
                <img class="img-responsive" src="' . $blog_item['image'] . '" alt="' . $blog_item['titre'] . '" title="' . $blog_item['titre'] . '">
            </a>
    </div>
</article>
        ';
    }//fin de while
   // require '../../Pages/Blog_Aside.php';
}



/* ==========================================================================
SYSTEME DE GESTION LA ZONE PAGINATION DU BLOG
   ========================================================================== */
if(isset($_POST['pagination']) && isset($_POST['nbre_Article']))
{
    $nombreDeMessagesParPage = intval($_POST['nbre_Article']);
    $pages = intval($_POST['pagination']);

    // On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
    $premierMessageAafficher = ($pages - 1) * $nombreDeMessagesParPage;

    $blog = App::getDB()->compteur_start_end('SELECT id_sujet, titre, paragraphe, mot_cles, image, sujets.date_enreg, libelle FROM sujets 
                                                            INNER JOIN categorie
                                                            ON categorie.id_categorie=sujets.ref_id_categorie
                                                            ORDER BY id_sujet DESC LIMIT :offset , :limit');
    $blog->bindParam(':offset', $premierMessageAafficher , PDO::PARAM_INT);
    $blog->bindParam(':limit', $nombreDeMessagesParPage, PDO::PARAM_INT);
    $blog->execute();
    while ($blog_item = $blog->fetch()) {
        echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                         <!--BLOC 1-->
          <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" title="' . $blog_item['titre'] . '">' .
            $blog_item['titre']
            . '</a>
        </h1>
            <p class="blog-article-1-p-1">';
        $parser->parse(substr($blog_item['paragraphe'], MIN_CHARACTER, MAX_CHARACTER));
        echo \App\Link\Parser_Link::urllink($parser->getAsHTML());
        echo '</p>';
        echo '<p class="blog-article-1-p-2">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" tabindex="-1" title="' . $blog_item['titre'] . '">Lire la suite</a>
        </p>
        </div>
                         <!--BLOC 2-->
          <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">' . date('d', strtotime($blog_item['date_enreg'])) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', strtotime($blog_item['date_enreg'])) . '</span><br>
                                <span class="year">' . date('Y', strtotime($blog_item['date_enreg'])) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', strtotime($blog_item['date_enreg'])) . ':' . date('i', strtotime($blog_item['date_enreg'])) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie '.$blog_item['libelle'].'">'.$blog_item['libelle'].'</a>
        <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" data-title="Lire Les commentaires" class="comments link_articles">';
        $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
        if($totalComments==1)
            echo ' Un Commentaire';
        else if($totalComments==0)
            echo $totalComments.' Commentaire';
        else
            echo $totalComments.' Commentaires';
        echo '</a>
        <a style="top: 130px;" href="#" onclick="return false;" data-title="Lire Les Réactions des Commentaires" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     INNER JOIN feedback_comments
                                                     ON comments.id_commentaires=feedback_comments.ref_id_commentaires
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
                if($totalComments==1)
                    echo ' Un Commentaire Réagit';
                else if($totalComments==0)
                    echo $totalComments.' Commentaire Réagit';
                else
                    echo $totalComments.' Commentaires Réagit';
                echo '</a>
        <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
              <a href="#" onclick="return false;" class="nav-js" data-destination="blog" data-title="'.$blog_item['titre'].'">';
                $keyword = explode(';', $blog_item['mot_cles']);
                for($j=0; $j<count($keyword); $j++)
                    echo '#'.$keyword[$j].'<br>';
                echo '</a> 
                <br>
            </p>
        </div>
      <!---------------------------------->
       </div>
    </div>
                         <!--BLOC 3-->
          <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" tabindex="-1" class="link_articles">
                <img class="img-responsive" src="' . $blog_item['image'] . '" alt="' . $blog_item['titre'] . '" title="' . $blog_item['titre'] . '">
            </a>
    </div>
</article>
        ';
    }//fin de while
}


/* ==========================================================================
SYSTEME DE GESTION DU CLICK SUR LES BOUTONS REPONDRE DANS LE BLOG
   ========================================================================== */
if(isset($_GET['id_comment'])){
    $_SESSION['id_comment'] =  $_GET['id_comment'];
}

//ZONE HOMEPAGE DU SITE WEB
/* ==========================================================================
SYSTEME DE GESTION DU CLICK SUR LES BOUTONS Devis PAGE D'ACCUEIL
   ========================================================================== */
if(isset($_POST['devis_service'])){
    $connexion = App::getDB();
   /* if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;*/

    $retour = $connexion->prepare_request('SELECT id_bouton_devis, nbre_access FROM bouton_devis WHERE ref_id_compte=:id_compte', ['id_compte'=>$compte]);
   // $retour['nbre_access'] = intval($retour['nbre_access']) + 1;

    $result = $connexion->rowCount('SELECT id_bouton_devis FROM bouton_devis WHERE ref_id_compte="'.$compte.'"');
    if($result == 0 )
    {
        $connexion->insert('INSERT INTO bouton_devis(ref_id_compte, nbre_access, date_ajout) 
                                               VALUES(?, ?, ?)', array($compte, intval($retour['nbre_access']) + 1, time()));
    }else{
        $connexion->update('UPDATE bouton_devis SET nbre_access=:compteur, date_modif=:modif WHERE ref_id_compte=:compte', array('compteur'=>intval($retour['nbre_access'])+1, 'modif'=>time(), 'compte'=>$compte));
    }
     echo 'success';
}

//ZONE SERVICE DU SITE WEB

/* ==========================================================================
SYSTEME DE GESTION DU CLICK SUR LES BOUTONS DES SERVICES DISPONIBLES
   ========================================================================== */

if(isset($_POST['projet_conception'])){
    $connexion = App::getDB();
    $_SESSION['nom_service'] = strtolower($_POST['projet_conception']);
    $retour = $connexion->prepare_request('SELECT id_bouton_devis FROM bouton_devis WHERE ref_id_compte=:id_compte', ['id_compte'=>$compte]);
    $service = $connexion->rowCount('SELECT id_services FROM services         
                                                      WHERE services.libelle="'.strtolower($_POST['projet_conception']).'"');

    if($service > 0){
        $retour2 = $connexion->prepare_request('SELECT services.nbre_access AS nbre FROM services             
                                                      WHERE services.libelle=:lbl', ['lbl'=>strtolower($_POST['projet_conception'])]);

        $connexion->update('UPDATE services SET ref_id_bouton_devis=:id_bouton_devis, nbre_access=:compteur, date_modif=:modif WHERE services.libelle=:lbl',
            array('id_bouton_devis'=>$retour['id_bouton_devis'], 'compteur'=>intval($retour2['nbre']+1) ,'modif'=>time(), 'lbl'=>strtolower($_POST['projet_conception'])));
    }
}



//ZONE APPLICATIONS WEB (id_page=11) DU SITE WEB

/* ==========================================================================
SYSTEME DE GESTION DE LA SELECTION DU MODULE CLIENT
   ========================================================================== */

if(isset($_POST['id_module_admin'])){
    $con = App::getDB();

    $result = $con->rowCount('SELECT ref_id_module_admin FROM `module_client` WHERE ref_id_module_admin="'.intval($_POST['id_module_admin']).'" AND ref_id_compte="'.$compte.'"');

    // Si une erreur survient
    if($result > 0 )
    {
        echo 'Vous avez déjà ajouté cette Fonctionnalité';
    }
    else{
       /* if(isset($_SESSION['ID_USER']))
            $compte = intval($_SESSION['ID_USER']);
        else if(isset($_COOKIE['ID_USER']))
            $compte = intval($_COOKIE['ID_USER']);
        else
            $compte = 0;*/

        $serv_compteur = $con->prepare_request('SELECT id_module_admin, ref_id_cat_module_client, libelle, description, estimation, unites FROM module_admin
                                                                                     WHERE id_module_admin=:id_module_ad
                                                                                     ORDER BY id_module_admin DESC', ['id_module_ad'=>$_POST['id_module_admin']]);

        $con->insert('INSERT INTO `module_client` (ref_id_cat_module_client, ref_id_compte, ref_id_module_admin, libelle, description, estimation, unites, date_enreg) VALUES (:id_cat_module_client, :id_compte, :id_module_admin, :libelle, :descriptions, :estimation, :unites, :date_enreg)',
            [
                'id_cat_module_client'=>intval($serv_compteur['ref_id_cat_module_client']),
                'id_compte'=>$compte,
                'id_module_admin'=>intval($_POST['id_module_admin']),
                'libelle'=>$serv_compteur['libelle'],
                'descriptions'=>$serv_compteur['description'],
                'estimation'=>$serv_compteur['estimation'],
                'unites'=>$serv_compteur['unites'],
                'date_enreg'=>time()
            ]);
        echo 'success';
    }
}

/* ==========================================================================
SYSTEME DE GESTION DE LA SUPPRESSION DU MODULE PAR LE CLIENT
   ========================================================================== */
if(isset($_POST['id_module_client'])){
    $con = App::getDB();

    $result = $con->rowCount('SELECT id_module_client FROM `module_client` WHERE id_module_client="'.intval($_POST['id_module_client']).'"');

    // Si une erreur survient
    if($result <= 0 )
    {
        echo 'Cette Fonctionnalité n\'existe pas ou a déjà été supprimé';
    }
    else{
        $con->delete('DELETE FROM module_client WHERE id_module_client=:id_module_client', ['id_module_client' =>$_POST['id_module_client']]);
        echo 'success';
    }
}

if(isset($_POST['list_cat_mod'])){
//var_dump($_POST['id_service']);
/*if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
else $compte = 0;*/

?>
    <thead>
    <tr role="row">
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 162px;">PROJET</th>
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 197px;">DESIGNATION</th>
        <th class="sorting_desc text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 180px;" aria-sort="descending">ESTIMATION</th>

    </tr>
    </thead>
<tbody>
    <tr id="blocG1" class="gradeC odd" role="row">
    <td rowspan="<?=
    $j = App::getDB()->rowCount('SELECT DISTINCT id_module_client 
FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['id_service']).'"                   
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client="'.$_POST['list_cat_mod'].'"');
    ?>" class="text-center">
        <?php
        $resultats = App::getDB()->prepare_request('SELECT DISTINCT cat_module_client.libelle AS model 
FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services=:serv
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('serv'=>intval($_POST['id_service']), 'compte'=>$compte, 'id_cat_mod'=>$_POST['list_cat_mod']));
        echo strtoupper($resultats['model']);
        ?>
    </td>
    <?php
$retour1 = App::getDB()->compteur_start_end('SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model 
FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services=:serv
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
$retour1->execute(array('serv'=>intval($_POST['id_service']), 'compte'=>$compte, 'id_cat_mod'=>$_POST['list_cat_mod']));
while ($retour2 = $retour1->fetch()) {
    ?>
        <td class="text-center"><?= $retour2['titre'];?></td>
        <td class="text-center"><?= number_format($retour2['estimation'], 1).' '.$retour2['unites'];?></td>
        <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
    </tr>
    <?php
}
?>
</tbody>
    <tfoot>
    <tr class="gradeA odd" role="row">
        <th colspan="2" class="text-center">ESTIMATION DU BUDGET TOTAL</th>
        <th colspan="2" class="text-center">
            <?php $nbre = App::getDB()->prepare_request('SELECT SUM(module_client.estimation) AS total, module_client.unites FROM module_client
INNER JOIN cat_module_client
ON module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client
INNER JOIN compte
ON module_client.ref_id_compte=compte.id_compte
INNER JOIN module_admin
ON module_client.ref_id_module_admin=module_admin.id_module_admin
WHERE compte.id_compte=:compte AND module_client.ref_id_cat_module_client=:cat_id', ['compte'=>$compte, 'cat_id'=>$_POST['list_cat_mod']]);
            echo number_format($nbre['total'], 2).' '.$nbre['unites'];?>
        </th>
    </tr>
    </tfoot>
<?php
}


//SYSTEME D'ACTUALISATION DES DONNEES DU TABLEAU CLIENT
if(isset($_POST['actualisation_client'])){

    define('MAINTENANCE', 1);
    define('FONCTIONNALITES', 2);
    define('WEBMARKETING', 3);
    define('GESTION_DES_PROJETS', 4);
    define('DESIGN_ET_MISE_EN_PAGE', 5);
    define('TECHNOLOGIES_UTILISEES', 6);
	
	$totalMaintenance = 0;
    $totalFonctionnalites = 0;
    $totalWebMarketing = 0;
    $totalGestionProjets = 0;
    $totalDesign = 0;
    $totalTechnologies = 0;
    $total = 0;
    ?>

    <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline tab1 tab-min" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
    <!--<tr class="gradeA even" role="row">-->
    <?php
    if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;

    $connexion = App::getDB();
    $maintenance = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.MAINTENANCE;



    $fonctionnalites = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.FONCTIONNALITES;


    $webmarketing = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.WEBMARKETING;

    $gestion_des_projets = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.GESTION_DES_PROJETS;

    $design_et_mise_en_page = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.DESIGN_ET_MISE_EN_PAGE;

    $technologies_utilisees = 'SELECT DISTINCT id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.TECHNOLOGIES_UTILISEES;
    ?>
    <thead>
    <tr role="row">
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 162px;">PROJET</th>
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 197px;">DESIGNATION</th>
        <th class="sorting_desc text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 180px;" aria-sort="descending">ESTIMATION</th>

    </tr>
    </thead>

    <tbody>
    <?php
    //BLOC 1 MAINTENANCE
    if(isset($maintenance) && $connexion->rowCount($maintenance)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($maintenance)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>MAINTENANCE));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end(' 
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>MAINTENANCE));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalMaintenance = $totalMaintenance + intval($retour2['estimation']);  echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 2 FONCTIONNALITES
    if(isset($fonctionnalites) && $connexion->rowCount($fonctionnalites)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($fonctionnalites)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>FONCTIONNALITES));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end(' 
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>FONCTIONNALITES));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalFonctionnalites = $totalFonctionnalites + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" href="#" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 3 WEBMARKETING
    if(isset($webmarketing) && $connexion->rowCount($webmarketing)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($webmarketing)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>WEBMARKETING));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end('
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>WEBMARKETING));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalWebMarketing = $totalWebMarketing + intval($retour2['estimation']);  echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 4 GESTION DES PROJETS
    if(isset($gestion_des_projets) && $connexion->rowCount($gestion_des_projets)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($gestion_des_projets)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>GESTION_DES_PROJETS));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end('
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>GESTION_DES_PROJETS));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalGestionProjets = $totalGestionProjets + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 5 DESIGN ET MISE EN PAGE
    if(isset($design_et_mise_en_page) && $connexion->rowCount($design_et_mise_en_page)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($design_et_mise_en_page)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>DESIGN_ET_MISE_EN_PAGE));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end(' 
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>DESIGN_ET_MISE_EN_PAGE));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalDesign = $totalDesign + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 6 TECHNOLOGIES UTILISEES
    if(isset($technologies_utilisees) && $connexion->rowCount($technologies_utilisees)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($technologies_utilisees)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request(' 
SELECT DISTINCT cat_module_client.libelle AS model 
FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>TECHNOLOGIES_UTILISEES));
                echo strtoupper($resultats['model']);
                ?>
            </td>
        </tr>

        <?php
        $retour1 = App::getDB()->compteur_start_end('
SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model 
FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_POST['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>TECHNOLOGIES_UTILISEES));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalTechnologies = $totalTechnologies + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    ?>
    </tbody>
    <tfoot>
    <tr class="gradeA odd" role="row">
        <th colspan="2" class="text-center">ESTIMATION DU BUDGET TOTAL</th>
        <th colspan="2" class="text-center">
            <?php
            if(isset($_POST['service']) && intval($_POST['service']) == 1) {
                $requete = '
SELECT SUM(module_client.estimation) AS total, module_client.unites FROM module_client
INNER JOIN cat_module_client
ON module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client
INNER JOIN compte
ON module_client.ref_id_compte=compte.id_compte
INNER JOIN module_admin
ON module_client.ref_id_module_admin=module_admin.id_module_admin
WHERE compte.id_compte=:compte';
                  $nbre = App::getDB()->prepare_request($requete, ['compte' => $compte]);

$total = $totalMaintenance + $totalFonctionnalites + $totalWebMarketing + $totalGestionProjets + $totalDesign + $totalTechnologies;
			echo number_format($total, 1, ',', ' ') . ' ' . $nbre['unites'];
			
           // echo number_format($nbre['total'], 1, ',', ' ') . ' ' . $nbre['unites'];
            }
            ?>
        </th>
    </tr>
    </tfoot>
<?php
}


//INSERTION DES DONNEES POUR LE DEVIS D'UN PARTICULIER
if(isset($_GET['devisParticulier'])){

    $connexion = App::getDB();
    $_POST['activiteP'] = htmlentities(stripslashes($_POST['activiteP']));
    $_POST['telP'] = htmlentities(stripslashes($_POST['telP']));

    if(!is_numeric($_POST['telP'])){
        echo 'Votre numéro contient une ou plusieurs lettres.';
        exit;
    }
    $nbreDevis = $connexion->prepare_request('SELECT date_modif, nbre_devis_genere FROM compte WHERE id_compte=:id', ['id'=>$compte]);
    if($nbreDevis['date_modif'] == ''){
         $nbreDevis['nbre_devis_genere']++;

        $connexion->update('UPDATE compte SET date_modif=:modif, statut_social=:statut_s, domaine_activite=:activite, ville=:vil, telephone=:tel, nbre_devis_genere=:devis WHERE id_compte=:id',
            array('modif'=>time(), 'statut_s' => $_POST['statut_social'], 'activite' => $_POST['activiteP'], 'vil' => $_POST['villeP'], 'tel' => $_POST['telP'], 'devis'=>$nbreDevis['nbre_devis_genere'], 'id' => $compte));
        echo 'success';
    }else {
        $prochaine_generation = intval($nbreDevis['date_modif']) + DUREE_SUSPENSION; //dans une heure de temps
        if(time() >= $prochaine_generation){
            $nbreDevis['nbre_devis_genere']++;

            $connexion->update('UPDATE compte SET date_modif=:modif, statut_social=:statut_s, domaine_activite=:activite, ville=:vil, telephone=:tel, nbre_devis_genere=:devis WHERE id_compte=:id',
                array('modif'=>time(), 'statut_s' => $_POST['statut_social'], 'activite' => $_POST['activiteP'], 'vil' => $_POST['villeP'], 'tel' => $_POST['telP'], 'devis'=>$nbreDevis['nbre_devis_genere'], 'id' => $compte));
            echo 'success';
        }else{
            echo 'Vous pourrez générer un autre dévis dans 1h de temps encore';
        }

    }
}

//INSERTION DES DONNEES POUR LE DEVIS D'UNE ENTREPRISE
if(isset($_GET['devisEntreprise'])){

    $connexion = App::getDB();
    $_POST['nomE'] = htmlentities(stripslashes($_POST['nomE']));
    $_POST['activiteE'] = htmlentities(stripslashes($_POST['activiteE']));
    $_POST['bpE'] = htmlentities(stripslashes($_POST['bpE']));
    $_POST['telE'] = htmlentities(stripslashes($_POST['telE']));
    $_POST['emailE'] = htmlentities(stripslashes($_POST['emailE']));
    $_POST['siteE'] = htmlentities(stripslashes($_POST['siteE']));

    if(!is_numeric($_POST['telE'])){
        echo 'Votre numéro contient une ou plusieurs lettres.';
        exit;
    }

    /*if (isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if (isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;*/

    $nbreDevis = $connexion->prepare_request('SELECT date_modif, nbre_devis_genere FROM compte WHERE id_compte=:id', ['id'=>$compte]);
    if($nbreDevis['date_modif'] == ''){
        $nbreDevis['nbre_devis_genere']++;

        $connexion->update('UPDATE compte SET date_modif=:modif, statut_social=:statut_s, nom_entreprise=:nomEntreprise, domaine_activite=:activite, bp=:bpEtreprise, ville=:vil, telephone=:tel, email_entreprise=:emailE, site_web=:siteE, nbre_devis_genere=:devis WHERE id_compte=:id',
            array('modif'=>time(), 'statut_s' => $_POST['statut_social'], 'nomEntreprise' => $_POST['nomE'], 'activite' => $_POST['activiteE'], 'bpEtreprise' => $_POST['bpE'], 'vil' => $_POST['villeE'], 'tel' => $_POST['telE'],
                'emailE' => $_POST['emailE'], 'siteE' => $_POST['siteE'], 'devis'=>$nbreDevis['nbre_devis_genere'], 'id' => $compte));

        echo 'success';
    }else {
        $prochaine_generation = intval($nbreDevis['date_modif']) + DUREE_SUSPENSION; //dans une heure de temps
        if(time() >= $prochaine_generation){
            $nbreDevis['nbre_devis_genere']++;

            $connexion->update('UPDATE compte SET date_modif=:modif, statut_social=:statut_s, nom_entreprise=:nomEntreprise, domaine_activite=:activite, bp=:bpEtreprise, ville=:vil, telephone=:tel, email_entreprise=:emailE, 
                  site_web=:siteE, nbre_devis_genere=:devis WHERE id_compte=:id',
                array('modif'=>time(), 'statut_s' => $_POST['statut_social'], 'nomEntreprise' => $_POST['nomE'], 'activite' => $_POST['activiteE'], 'bpEtreprise' => $_POST['bpE'], 'vil' => $_POST['villeE'], 'tel' => $_POST['telE'],
                    'emailE' => $_POST['emailE'], 'siteE' => $_POST['siteE'], 'devis'=>$nbreDevis['nbre_devis_genere'], 'id' => $compte));
            echo 'success';
        }else{
            echo 'Vous pourrez générer un autre dévis dans 1h de temps encore';
        }

    }
}



//ZONE ADMINISTRATION DU SITE WEB

/* ==========================================================================
SYSTEME DE VERIFICATION DE LA SECTION FREELANCE DANS LA PAGE ADMINISTRATION
   ========================================================================== */


// Une fois le formulaire envoyé
if(isset($_GET['freelance']))
{

 if(isset($_POST['entite'])){

     nettoieProtect();
     extract($_POST);
     $connexion = App::getDB();
      if(strlen($entite) < 2 || strlen($entite) > 100 ){
         echo '<br>L\' entité est compris entre 3 et 100 caractères';
         exit;
     }
      if(is_numeric($entite[0])){
         echo '<br>L\' Entite doit commencer par une lettre';
         exit;
     }
     $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entite="'.$entite.'"');
     if($nbre > 0){
         echo '<br> Entite déjà utilisé';
         exit;
     }
     else{
         echo 'success';
     }
 }



    if(isset($_POST['valeurEntite'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($valeurEntite) < 2 || strlen($valeurEntite) > 100 ){
            echo '<br>Valeur de L\'Entité compris entre 3 et 100 caractères';
            exit;
        }
        if(is_numeric($valeurEntite[0])){
            echo '<br>La valeur de L\' Entite doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE nom_entite="'.$valeurEntite.'"');
        if($nbre > 0){
            echo '<br> Valeur de l\'Entité déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['activite'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($activite) < 2 || strlen($activite) > 100 ){
            echo '<br>L\' activité est compris entre 3 et 100 caractères';
            exit;
        }
        if(is_numeric($activite[0])){
            echo '<br>L\' activité doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE activite="'.$activite.'"');        if($nbre > 0){
            echo '<br> Activité déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['ville'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($ville) < 2 || strlen($ville) > 100 ){
            echo '<br>La ville est comprise entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($ville[0])){
            echo '<br>La ville doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE ville="'.$ville.'"');
        if($nbre > 0){
            echo '<br> Ville déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['travaux'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($travaux) < 2 || strlen($travaux) > 1000 ){
            echo '<br>Les Travaux sont compris entre 2 et 1000 caractères';
            exit;
        }
        if(is_numeric($travaux[0])){
            echo '<br>Les Travaux doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE travaux_effectue="'.$travaux.'"');
        if($nbre > 0){
            echo '<br> Travaux déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['app_dev'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($app_dev) < 2 || strlen($app_dev) > 100 ){
            echo '<br>L\' APP Développé est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($app_dev[0])){
            echo '<br>L\' App Developpé doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE app_dev="'.$app_dev.'"');
        if($nbre > 0){
            echo '<br> App développé déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['type_app'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($type_app) < 2 || strlen($type_app) > 100 ){
            echo '<br>Type d\'APP compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($type_app[0])){
            echo '<br>Le Type d\'App doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE type_app="'.$type_app.'"');
        if($nbre > 0){
            echo '<br> Type d\'App déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['architecture'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($architecture) < 2 || strlen($architecture) > 100 ){
            echo '<br>L\' Architecture est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($architecture[0])){
            echo '<br>L\' Achitecture doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE architecture="'.$architecture.'"');
        if($nbre > 0){
            echo '<br> Architecture déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['analyse'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($analyse) < 2 || strlen($analyse) > 100 ){
            echo '<br>L\' analyse est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($analyse[0])){
            echo '<br>L\' analyse doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE methode_analyse="'.$analyse.'"');
        if($nbre > 0){
            echo '<br> Analyse déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['ide'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($ide) < 2 || strlen($ide) > 100 ){
            echo '<br>L\' IDE est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($ide[0])){
            echo '<br>L\' IDE doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE ide="'.$ide.'"');
        if($nbre > 0){
            echo '<br> IDE déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['langage'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($langage) < 1 || strlen($langage) > 100 ){
            echo '<br>Langage compris entre 1 et 100 caractères';
            exit;
        }
        if(is_numeric($langage[0])){
            echo '<br>Le langage doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE langage="'.$langage.'"');
        if($nbre > 0){
            echo '<br> Langage déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['sgbd'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($sgbd) < 2 || strlen($sgbd) > 100 ){
            echo '<br>Le SGBD est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($sgbd[0])){
            echo '<br>LE SGBD doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE sgbd="'.$sgbd.'"');
        if($nbre > 0){
            echo '<br> Le SGBD déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }





    if(isset($_POST['outils'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($outils) < 2 || strlen($outils) > 100 ){
            echo '<br>L\' outils est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($outils[0])){
            echo '<br>L\' outil doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE outils="'.$outils.'"');
        if($nbre > 0){
            echo '<br> Entite déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['framework'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($framework) < 2 || strlen($framework) > 100 ){
            echo '<br>Le Framework est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($framework[0])){
            echo '<br>Le Framework doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entite="'.$framework.'"');
        if($nbre > 0){
            echo '<br> Framework déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['url'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($url) < 2 || strlen($url) > 100 ){
            echo '<br>L\' URL est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($url[0])){
            echo '<br>L\' URL doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE url="'.$url.'"');
        if($nbre > 0){
            echo '<br> URL déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['deploiement'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($deploiement) < 2 || strlen($deploiement) > 100 ){
            echo '<br>Le Déploiement est compris entre 2 et 100 caractères';
            exit;
        }
        if(is_numeric($deploiement[0])){
            echo '<br>Le Deploiement doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE deploiement="'.$deploiement.'"');
        if($nbre > 0){
            echo '<br> Déploiement déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['taille'])){

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        if(strlen($taille) < 1 || strlen($taille) > 100 ){
            echo '<br>L\' APP Développé est compris entre 1 et 100 caractères';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE taille>=1024');
        if($nbre > 0){
            echo '<br> Taille App développé superieur à 1GB';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['fonctionnalites'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($fonctionnalites) < 2 || strlen($fonctionnalites) > 1000 ){
            echo '<br>Les fonctionnalités sont comprises entre 2 et 1000 caractères';
            exit;
        }
        if(is_numeric($fonctionnalites[0])){
            echo '<br>Les fonctionnalités doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE fonctionnalites="'.$fonctionnalites.'"');
        if($nbre > 0){
            echo '<br> fonctionnalités déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




   /* if(isset($_POST['capture'])){

        nettoieProtect();
        extract($_POST);
        $capture = preg_replace('#[^a-z0-9]#i', '', $capture); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($capture) < 4 || strlen($capture) > 16 ){
            echo '<br>Les captures sont comprises entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($capture[0])){
            echo '<br>Les captures doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entite="'.$capture.'"');
        if($nbre > 0){
            echo '<br> capture déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }*/




}


/*-----------------------------------------ENTREPRISE-------------------------------*/

if(isset($_GET['entreprise'])){

    if(isset($_POST['entreprise'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($entreprise) < 2 || strlen($entreprise) > 20 ){
            echo '<br>L\' entreprise est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($entreprise[0])){
            echo '<br>L\' entreprise doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entreprise="'.$entreprise.'"');
        if($nbre > 0){
            echo '<br> Entreprise déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['activite'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($activite) < 2 || strlen($activite) > 20 ){
            echo '<br>L\' activité est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($activite[0])){
            echo '<br>L\' activité doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE activite="'.$activite.'"');
        if($nbre > 0){
            echo '<br> Activité déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['ville'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($ville) < 2 || strlen($ville) > 20 ){
            echo '<br>La ville est comprise entre 2 et 20 caractères';
            exit;
        }
        if(is_numeric($ville[0])){
            echo '<br>La ville doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE ville="'.$ville.'"');
        if($nbre > 0){
            echo '<br> Ville déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['section'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($section) < 2 || strlen($section) > 50 ){
            echo '<br>Les section sont compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($section[0])){
            echo '<br>La section doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE section="'.$section.'"');
        if($nbre > 0){
            echo '<br> Section déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }

    if(isset($_POST['matricule'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($matricule) < 2 || strlen($matricule) > 50 ){
            echo '<br>Le matricule est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($matricule[0])){
            echo '<br>Les Travaux doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE matricule="'.$matricule.'"');
        if($nbre > 0){
            echo '<br> matricule déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }

    if(isset($_POST['poste'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($poste) < 2 || strlen($poste) > 50 ){
            echo '<br>Le poste est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($poste[0])){
            echo '<br>Le poste doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE poste_occupe="'.$poste.'"');
        if($nbre > 0){
            echo '<br> poste déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['travaux'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($travaux) < 2 || strlen($travaux) > 1000 ){
            echo '<br>Les Travaux sont compris entre 2 et 1000 caractères';
            exit;
        }
        if(is_numeric($travaux[0])){
            echo '<br>Les Travaux doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE travaux_effectue="'.$travaux.'"');
        if($nbre > 0){
            echo '<br> Travaux déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['app_dev'])){

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        if(strlen($app_dev) < 2 || strlen($app_dev) > 50 ){
            echo '<br>L\' APP Développé est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($app_dev[0])){
            echo '<br>L\' App Developpé doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE app_dev="'.$app_dev.'"');
        if($nbre > 0){
            echo '<br> App développé déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['type_app'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($type_app) < 2 || strlen($type_app) > 50 ){
            echo '<br>Type d\'APP compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($type_app[0])){
            echo '<br>Le Type d\'App doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE type_app="'.$type_app.'"');
        if($nbre > 0){
            echo '<br> Type d\'App déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['architecture'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($architecture) < 2 || strlen($architecture) > 50 ){
            echo '<br>L\' Architecture est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($architecture[0])){
            echo '<br>L\' Achitecture doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE architecture="'.$architecture.'"');
        if($nbre > 0){
            echo '<br> Architecture déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['analyse'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($analyse) < 2 || strlen($analyse) > 50 ){
            echo '<br>L\' analyse est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($analyse[0])){
            echo '<br>L\' analyse doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE methode_analyse="'.$analyse.'"');
        if($nbre > 0){
            echo '<br> Analyse déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['ide'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($ide) < 2 || strlen($ide) > 50 ){
            echo '<br>L\' IDE est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($ide[0])){
            echo '<br>L\' IDE doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE ide="'.$ide.'"');
        if($nbre > 0){
            echo '<br> IDE déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['langage'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($langage) < 1 || strlen($langage) > 50 ){
            echo '<br>Langage compris entre 1 et 50 caractères';
            exit;
        }
        if(is_numeric($langage[0])){
            echo '<br>Le langage doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE langage="'.$langage.'"');
        if($nbre > 0){
            echo '<br> Langage déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }




    if(isset($_POST['sgbd'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($sgbd) < 2 || strlen($sgbd) > 50 ){
            echo '<br>Le SGBD est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($sgbd[0])){
            echo '<br>LE SGBD doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE sgbd="'.$sgbd.'"');
        if($nbre > 0){
            echo '<br> Le SGBD déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }





    if(isset($_POST['outils'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($outils) < 2 || strlen($outils) > 50 ){
            echo '<br>L\' outils est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($outils[0])){
            echo '<br>L\' outil doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE outils="'.$outils.'"');
        if($nbre > 0){
            echo '<br> Entite déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['framework'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($framework) < 2 || strlen($framework) > 50 ){
            echo '<br>Le Framework est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($framework[0])){
            echo '<br>Le Framework doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entite="'.$framework.'"');
        if($nbre > 0){
            echo '<br> Framework déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['url'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($url) < 2 || strlen($url) > 50 ){
            echo '<br>L\' URL est compris entre 2 et 50 caractères';
            exit;
        }
        if(is_numeric($url[0])){
            echo '<br>L\' URL doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE url="'.$url.'"');
        if($nbre > 0){
            echo '<br> URL déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['deploiement'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($deploiement) < 2 || strlen($deploiement) > 20 ){
            echo '<br>Le Déploiement est compris entre 2 et 20 caractères';
            exit;
        }
        if(is_numeric($deploiement[0])){
            echo '<br>Le Deploiement doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE deploiement="'.$deploiement.'"');
        if($nbre > 0){
            echo '<br> Déploiement déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['taille'])){

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        if(strlen($taille) < 1 || strlen($taille) > 20 ){
            echo '<br>L\' APP Développé est compris entre 1 et 20 caractères';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE taille>=1024');
        if($nbre > 0){
            echo '<br> Taille App développé superieur à 1GB';
            exit;
        }
        else{
            echo 'success';
        }
    }



    if(isset($_POST['detail'])){

        nettoieProtect();
        extract($_POST);
        $connexion = App::getDB();
        if(strlen($detail) < 2 || strlen($detail) > 1000 ){
            echo '<br>Les fonctionnalités sont comprises entre 2 et 1000 caractères';
            exit;
        }
        if(is_numeric($detail[0])){
            echo '<br>Les fonctionnalités doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE fonctionnalites="'.$detail.'"');
        if($nbre > 0){
            echo '<br> fonctionnalités déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    /* if(isset($_POST['capture'])){

         nettoieProtect();
         extract($_POST);
         $capture = preg_replace('#[^a-z0-9]#i', '', $capture); //filter everything
         // Connexion à la base de données
         // Valeurs à modifier selon vos paramètres de configuration
         require '../configuration/Config_Server.php';
         $connexion = App::getDB();
         if(strlen($capture) < 4 || strlen($capture) > 16 ){
             echo '<br>Les captures sont comprises entre 3 et 16 caractères';
             exit;
         }
         if(is_numeric($capture[0])){
             echo '<br>Les captures doivent commencer par une lettre';
             exit;
         }
         $nbre = $connexion->rowCount('SELECT id_body FROM body WHERE entite="'.$capture.'"');
         if($nbre > 0){
             echo '<br> capture déjà utilisé';
             exit;
         }
         else{
             echo 'success';
         }
     }*/





}


//INSERTION DES DONNEES DANS LE FICHIER JOURNAL
    if(isset($_GET['log'])){

        if(isset($_POST['lien'])){
            $titre = $_POST['title'];
            $lien = $_POST['lien'];
        }
        else if(isset($_POST['buttonUrl'])){
            $titre = $_POST['title'];
            $lien = $_POST['buttonUrl'];
        }
        else if(isset($_POST['type'])){
            $titre = $_POST['type'];
            $lien = '';
        }
        else{
            $titre = '';
            $lien = '';
        }

        $connexion = App::getDB();
        $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, $titre, $lien, $statut, get_ip(), time()));

    }






/* ==========================================================================
 SOUHAIT DE BIENVENUE AUX UTILISATEURS
========================================================================== */
if(isset($_POST['id_utilisateur'])){
    $connexion = App::getDB();
    $retour = $connexion->prepare_request('SELECT nom, profil FROM compte WHERE id_compte=:id_compte', ['id_compte'=>$_POST['id_utilisateur']]);
    // $retour['nbre_access'] = intval($retour['nbre_access']) + 1;

    $result = $connexion->rowCount('SELECT id_compte FROM compte WHERE id_compte="'.$_POST['id_utilisateur'].'"');
    if($result == 0 )
    echo 'echec';
        else
    echo strtoupper($retour['nom']).'-'.$retour['profil'];
}
