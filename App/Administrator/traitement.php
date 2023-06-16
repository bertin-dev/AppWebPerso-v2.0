<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 04/02/2019
 * Time: 09h14
 */
session_start();
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



//function
function Diff_entre_2Jours($date2, $date1){
    $diff = abs($date2 - $date1);
    $result = array();
    $tmp = $diff;

    $result['second'] = $tmp % 60; // renvoi le reste de la div

    $tmp = floor(($tmp - $result['second']) / 60);
    $result['minute'] = $tmp % 60;

    $tmp = floor(($tmp - $result['minute']) / 60);
    $result['heure'] = $tmp % 24;

    $tmp = floor(($tmp - $result['heure']) / 24);
    $result['jour'] = $tmp;

    return $result['jour'];
}

    $message='';
    $success='';
    $i=0;

// Connexion à la base de données
require '../App/Config/Config_Server.php';

/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES CATEGORIE DANS LE BD
========================================================================== */

    // Une fois le formulaire envoyé
    if(isset($_GET['categorie']))
    {

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addCategorie']))
    {
    $i++;
    $message .= "Catégorie Invalid<br />\n";
    }

    else
    {

    nettoieProtect();
    extract($_POST);

   $connexion = App::getDB();
   $result = $connexion->rowCount('SELECT id_categorie FROM categorie WHERE libelle="'.$_POST['addCategorie'].'"');

    // Si une erreur survient
    if($result > 0 )
    {
    $i++;
    $message .= "Cette Catégorie Existe déjà<br/>";
    }
    else
    {
        $connexion->insert('INSERT INTO categorie(libelle, date_enreg) 
                                               VALUES(?, ?)', array($_POST['addCategorie'], time()));
        $message .= 'success';
    }
    }

if(isset($message)&& $message!='')
{

    if($i==1)
    {
        echo 'il y a '. $i .' erreur<br/>';
        echo $message;
    }
    else if($i>1)
    {
        echo 'il y a '. $i .' erreurs<br/>';
        echo $message;
    }
    else echo $message;
}
}



/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES SUJETS DANS LE BD
========================================================================== */

if(isset($_GET['blog']))
{

        $_POST['blogTitre'] = strtolower(stripslashes(htmlspecialchars($_POST['blogTitre'])));
        $_POST['blogParagraphe'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['blogParagraphe'])))), ENT_QUOTES);
        $_POST['addkeyWord'] = strtolower(stripslashes(htmlspecialchars($_POST['addkeyWord'])));

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_sujet FROM sujets WHERE titre="'.$_POST['blogTitre'].'" OR paragraphe="'.$_POST['blogParagraphe'].'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Titre ou alors ce Paragraphe Existe déjà<br/>";
        }
        else
        {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['blogImage']['name']) AND !empty($_FILES['blogImage']['name']))
            {
                //on verifi la taille de l'image
                if($_FILES['blogImage']['size']>=1000)
                {
                    $extensions_valides=Array('jpg','jpeg','png');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['blogImage']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $chemin="../Public/img/blog_img/{$token}.{$extension_upload}";
                       // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['blogImage']['tmp_name'],$chemin))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg'){$source = imagecreatefromjpeg($chemin);}
                            else{$source = imagecreatefrompng($chemin);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $chemin0="../Public/img/blog_img/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$chemin0);
                        }
                        else
                            {
                                $i++;
                                $message .= "no deplace<br/>";
                            }
                    }
                    else
                        {
                            $i++;
                            $message .= "no extensions<br/>";
                        }
                }
                else
                    {
                        $i++;
                        $message .= "no size<br/>";
                    }
            }
            else
                {
                    $i++;
                    $message .= "no defined<br/>";
                }


            $connexion->insert('INSERT INTO sujets(ref_id_blog, ref_id_categorie, titre, paragraphe, mot_cles, image)
                                               VALUES(:blog, :cat, :titre, :paragraphe, :keyword, :img)',
                                               array('blog'=>intval($_POST['id_blog']),
                                                   'cat'=>intval($_POST['blogCategorie']),
                                                   'titre'=>$_POST['blogTitre'],
                                                   'paragraphe'=>$_POST['blogParagraphe'],
                                                   'keyword'=>$_POST['addkeyWord'],
                                                   'img'=>$chemin
                                               ));
            $message .= 'success';
        }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}




/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES SERVICES DANS LE BD
========================================================================== */
if(isset($_GET['servicesDispo']))
{
         $_POST['addServicesDispo'] = strtolower(htmlentities(stripslashes($_POST['addServicesDispo']), ENT_QUOTES));
         $_POST['addDescriptionServicesDispo'] = strtolower(htmlentities(stripslashes($_POST['addDescriptionServicesDispo']), ENT_QUOTES));

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_services FROM services WHERE libelle="'.$addServicesDispo.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Service Existe déjà<br/>";
        }
        else
        {
            if(isset($_SESSION['ID_USER']))
                $compte = intval($_SESSION['ID_USER']);
            else if($_COOKIE['ID_USER'])
                $compte = intval($_COOKIE['ID_USER']);
            else
                $compte = 0;

            $retour = $connexion->prepare_request('SELECT id_bouton_devis FROM bouton_devis WHERE ref_id_compte=:numCompte', ['numCompte'=>$compte]);
            if(isset($retour['id_bouton_devis']))
                $id_btn_devis = $retour['id_bouton_devis'];
            else
                $id_btn_devis = 0;

            $connexion->insert('INSERT INTO services(ref_id_bouton_devis ,libelle, description, nbre_access, date_ajout) 
                                               VALUES(?, ?, ?, ?, ?)', array($id_btn_devis, $addServicesDispo, $addDescriptionServicesDispo, 0, time()));
            $message .= 'success';
        }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}


/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES CATEGORIES D' OUTILS TECHNIQUES DANS LE BD
========================================================================== */

if(isset($_GET['cat_outils_Tech']))
{
    $_POST['addCat_outils_Tech'] = strtolower(htmlentities(stripslashes($_POST['addCat_outils_Tech']), ENT_QUOTES));
    $_POST['addDescriptionCat_outils_Tech'] = strtolower(htmlentities(stripslashes($_POST['addDescriptionCat_outils_Tech']), ENT_QUOTES));

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_outils_tech FROM cat_outils_tech WHERE libelle="'.$addCat_outils_Tech.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Cette Catégorie d\'outils Technique Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO cat_outils_tech(libelle, description, date_ajout) 
                                               VALUES(?, ?, ?)', array($addCat_outils_Tech, $addDescriptionCat_outils_Tech, time()));
            $message .= 'success';
        }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}



/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES OUTILS TECHNIQUES DANS LE BD
========================================================================== */

if(isset($_GET['outils_Tech']))
{

    // Vérification de la validité des champs
        $_POST['addNomOutils_tech'] = stripslashes(htmlspecialchars($_POST['addNomOutils_tech']));
        $_POST['addDescriptionOutils_tech'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['addDescriptionOutils_tech'])))), ENT_QUOTES);
        $_POST['addVersionOutils_tech'] = stripslashes(htmlspecialchars($_POST['addVersionOutils_tech']));

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_outils FROM outils_technique WHERE libelle="'.$_POST['addNomOutils_tech'].'" OR description="'.$_POST['addDescriptionOutils_tech'].'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Cet Outil ou alors cette Description Existe déjà<br/>";
        }
        else
        {

            $connexion->insert('INSERT INTO outils_technique(ref_id_cat_outils_tech, ref_id_services, libelle, description, version, date_ajout)
                                               VALUES(:id_cat_outils_tech, :id_services, :titre, :descript, :version, :temps)',
                array('id_cat_outils_tech'=>intval($_POST['list_cat_outils_tech']),
                    'id_services'=>intval($_POST['list_servicesDispo']),
                    'titre'=>$_POST['addNomOutils_tech'],
                    'descript'=>$_POST['addDescriptionOutils_tech'],
                    'version'=>$_POST['addVersionOutils_tech'],
                    'temps'=>time()
                ));
            $message .= 'success';
        }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}


/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES MODULES ADMIN DANS LE BD
========================================================================== */

if(isset($_GET['moduleTechCommun']))
{
    if(!isset($_POST['list_TechCommun']) || !isset($_POST['list_ModuleCommun']))
        $message .= 'Un ou plusieurs champs de selection sont vides.';
    // Connexion à la base de données
    else{

    nettoieProtect();
    extract($_POST);

    $connexion = App::getDB();
        $connexion->insert('INSERT INTO module_outils(ref_id_outils_tech, ref_id_module_admin, date_ajout) 
                                               VALUES(?, ?, ?)', array($list_TechCommun, $list_ModuleCommun, time()));
        $message .= 'success';
    }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}



/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES MODULES ADMIN DANS LE BD
========================================================================== */

if(isset($_GET['moduleAdmin']))
{
    // Vérification de la validité des champs
    $_POST['addTitreModuleAdmin'] = stripslashes(htmlspecialchars($_POST['addTitreModuleAdmin']));
    $_POST['addDescriptionModuleAdmin'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['addDescriptionModuleAdmin'])))), ENT_QUOTES);
    $_POST['addEstimationModuleAdmin'] = stripslashes(htmlspecialchars($_POST['addEstimationModuleAdmin']));
    $_POST['addUnitesModuleAdmin'] = stripslashes(htmlspecialchars($_POST['addUnitesModuleAdmin']));
        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_module_admin FROM module_admin WHERE libelle="'.$addTitreModuleAdmin.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Module Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO module_admin(ref_id_admin, ref_id_cat_module_client, libelle, description, estimation, unites, date_ajout) 
                                               VALUES(?, ?, ?, ?, ?, ?, ?)', array(1, $list_catModuleClient, $addTitreModuleAdmin, $addDescriptionModuleAdmin, $addEstimationModuleAdmin, $addUnitesModuleAdmin, time()));
            $message .= 'success';
        }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}

/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES CATEGORIES MODULE CLIENT DANS LE BD
========================================================================== */

if(isset($_GET['catModuleClient']))
{
    $_POST['addcatModuleClient'] = strtolower(htmlentities(stripslashes($_POST['addcatModuleClient']), ENT_QUOTES));

    nettoieProtect();
    extract($_POST);

    $connexion = App::getDB();
    $result = $connexion->rowCount('SELECT id_cat_module_client FROM cat_module_client WHERE libelle="'.$addcatModuleClient.'"');

    // Si une erreur survient
    if($result > 0 )
    {
        $i++;
        $message .= "Cette Catégorie Module Client Existe déjà<br/>";
    }
    else
    {
        $connexion->insert('INSERT INTO cat_module_client(libelle, date_ajout) 
                                               VALUES(?, ?)', array($addcatModuleClient, time()));
        $message .= 'success';
    }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}


/* ==========================================================================
GESTION DE L'AJOUT DE L'AGENDA DANS LA ZONE CONFIG PAGE
========================================================================== */
if(isset($_GET['agenda']))
{
    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addMsgAgenda']))
    {
        $i++;
        $message .= "Programme Invalid<br />\n";
    }

    else
    {
        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_agenda FROM agenda WHERE libelle="'.$addMsgAgenda.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Programme Existe déjà<br/>";
        }
        else
        {
            $addDAgenda = strtotime($_POST['addDAgenda']);
            $addFAgenda = strtotime($_POST['addFAgenda']);
            if($addFAgenda < $addDAgenda){
                $i++;
                $message .= "La difference de dates est négative<br/>";
            }
            else{
                $duree = Diff_entre_2Jours($addFAgenda, $addDAgenda);
                $connexion->insert('INSERT INTO agenda(ref_id_admin, libelle, debut, fin, duree_restante, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array(1, $addMsgAgenda, $addDAgenda, $addFAgenda, $duree, time()));
                $message .= 'success';
            }

        }
    }



    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}





/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES IMAGES DANS LE BD
========================================================================== */

if(isset($_GET['img']))
{

    // Vérification de la validité des champs
    if(!isset($_POST['titreImg']))
    {
        $i++;
        $message .= "Titre Inexistant<br />\n";
    }
    else
    {
        $_POST['titreImg'] = strtolower(stripslashes(htmlspecialchars($_POST['titreImg'])));
        $_POST['descriptionImg'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['descriptionImg'])))), ENT_QUOTES);

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_img FROM images WHERE title="'.$_POST['titreImg'].'" ');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Titre ou alors cette Description Existe déjà<br/>";
        }
        else
        {

            //on verifi si l'adresse de l'image a ete bien definit
            if(isset($_FILES['blocImg']['name']) AND !empty($_FILES['blocImg']['name']))
            {
                //on verifi la taille de l'image
                if($_FILES['blocImg']['size']>=1000)
                {
                    $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                    //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                    //la fonction strtolower($chaine) renvoit la chaine en minuscule
                    $extension_upload=strtolower(substr(strrchr($_FILES['blocImg']['name'],'.'),1));
                    //on verifi si l'extension_upload est valide

                    if(in_array($extension_upload,$extensions_valides))
                    {
                        $token=md5(uniqid(rand(),true));
                        $chemin="../Public/img/Accueil/{$token}.{$extension_upload}";
                        // $chemin="blog_img/{$token}.{$extension_upload}";
                        //on deplace du serveur au disque dur

                        if(move_uploaded_file($_FILES['blocImg']['tmp_name'],$chemin))
                        {
                            // La photo est la source
                            if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                            {$source = imagecreatefromjpeg($chemin);}
                            else{$source = imagecreatefrompng($chemin);}
                            $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                            $chemin0="../Public/img/Accueil/miniature/{$token}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            imagejpeg($destination,$chemin0);
                        }
                        else
                        {
                            $i++;
                            $message .= "no deplace<br/>";
                        }
                    }
                    else
                    {
                        $i++;
                        $message .= "no extensions<br/>";
                    }
                }
                else
                {
                    $i++;
                    $message .= "no size<br/>";
                }
            }
            else
            {
                $i++;
                $message .= "no defined<br/>";
            }


            $connexion->insert('INSERT INTO images(ref_id_admin, ref_id_page, chemin, title, description, destination, date_ajout)
                                               VALUES(:id_admin, :id_page, :chemin, :title, :description, :destination, :date_ajout)',
                array('id_admin'=>1,
                    'id_page'=>intval($_POST['numPage']),
                    'chemin'=>$chemin,
                    'title'=>$_POST['titreImg'],
                    'description'=>$_POST['descriptionImg'],
                    'destination'=>$_POST['destinationImg'],
                    'date_ajout'=>time()
                ));
            $message .= 'success';
        }
    }

    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}



/* ==========================================================================
GESTION DU SYSTEME DE L'ACTIVITE ENCOURS...
========================================================================== */

if(isset($_GET['activite']))
{

    // Vérification de la validité des champs
    if(!isset($_POST['titreActivite']))
    {
        $i++;
        $message .= "Titre Inexistant<br />\n";
    }
    else
    {
        $_POST['titreActivite'] = strtolower(stripslashes(htmlspecialchars($_POST['titreActivite'])));
        $_POST['descriptionActtivite'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['descriptionActtivite'])))), ENT_QUOTES);

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_projet FROM projets_encours WHERE titre="'.$_POST['titreActivite'].'" ');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Titre Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO projets_encours(ref_id_admin, titre, description, date_creation)
                                               VALUES(:id_admin, :title, :description, :date_ajout)',
                array('id_admin'=>1,
                    'title'=>$_POST['titreActivite'],
                    'description'=>$_POST['descriptionActtivite'],
                    'date_ajout'=>time()
                ));
            $message .= 'success';
        }
    }

    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}

/* ==========================================================================
GESTION DE L'AJOUT DE L'AGENDA DANS LA ZONE CONFIG PAGE
========================================================================== */
if(isset($_GET['specialite']))
{
    $_POST['addspecialite'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['addspecialite'])))), ENT_QUOTES);

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_specialite FROM specialite WHERE description="'.$addspecialite.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Cette Spécialité Existe déjà<br/>";
        }
        else
        {
                $connexion->insert('INSERT INTO specialite(ref_id_admin, ref_id_model, description, date_creation) 
                                               VALUES(?, ?, ?, ?)', array(1, $cat_serv_models, $addspecialite, time()));
                $message .= 'success';


        }




    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}


//GESTION DES MODIFICATIONS APPORTEES A UN COMPTE
if(isset($_POST['id_compte'])){
    App::getDB()->update('UPDATE compte SET nom=:nom, prenom=:prenom, email=:email, password=:password1, date_modif=:modif,
                  etat_compte=:etat_compte, privileges=:privilege, statut_social=:statut_social, domaine_activite=:activite, nom_entreprise=:nomEntreprise,
                  bp=:bp, ville=:ville, telephone=:telephone, email_entreprise=:emailEntreprise, site_web=:url WHERE id_compte=:id',
        array('nom'=>$_POST['nom'], 'prenom'=>$_POST['prenom'], 'email'=>$_POST['email'], 'password1'=>$_POST['password'], 'modif'=>time(),
            'etat_compte'=>$_POST['etat_compte'], 'privilege'=>$_POST['privilege'], 'statut_social'=>$_POST['statut_social'], 'activite'=>$_POST['activite'], 'nomEntreprise'=>$_POST['nomEntreprise'],
            'bp'=>$_POST['bp'], 'ville'=>$_POST['ville'], 'telephone'=>$_POST['telephone'], 'emailEntreprise'=>$_POST['emailEntreprise'], 'url'=>$_POST['url'], 'id' => $_POST['id_compte']));
header('Location: index.php');
}



//GESTION DES MODIFICATIONS APPORTEES A UNE CATEGORIE
if(isset($_POST['modif_categorie'])){
    App::getDB()->update('UPDATE categorie SET libelle=:lbl, date_modif=:modif WHERE id_categorie=:id',
        array('lbl'=>$_POST['libelle'], 'modif'=>time(), 'id' => $_POST['modif_categorie']));
    header('Location: blog.php');
}

//GESTION DES MODIFICATIONS APPORTEES A UN COMMENTAIRE
if(isset($_POST['modif_commentaire'])){
    App::getDB()->update('UPDATE comments SET commentaires=:comments, date_modif_commentaires=:modif WHERE id_commentaires=:id',
        array('comments'=>$_POST['commentaire'], 'modif'=>time(), 'id' => $_POST['modif_commentaire']));
    header('Location: blog.php');
}

//GESTION DES MODIFICATIONS APPORTEES A UNE REACTION
if(isset($_POST['modif_reaction'])){
    App::getDB()->update('UPDATE feedback_comments SET reactions_commentaires=:reaction, date_modif_react=:modif WHERE id_feedback=:id',
        array('reaction'=>$_POST['commentaire'], 'modif'=>time(), 'id' => $_POST['modif_reaction']));
    header('Location: blog.php');
}


//GESTION DES MODIFICATIONS APPORTEES A UN ARTICLE
if(isset($_POST['modif_article'])){

    //on verifi si l'adresse de l'image a ete bien definit
    if(isset($_FILES['imageArticle']['name']) AND !empty($_FILES['imageArticle']['name']))
    {
        //on verifi la taille de l'image
        if($_FILES['imageArticle']['size']>=1000)
        {
            $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
            //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
            //la fonction strtolower($chaine) renvoit la chaine en minuscule
            $extension_upload=strtolower(substr(strrchr($_FILES['imageArticle']['name'],'.'),1));
            //on verifi si l'extension_upload est valide

            if(in_array($extension_upload,$extensions_valides))
            {
                $token=md5(uniqid(rand(),true));
                $chemin="../Public/img/blog_img/{$token}.{$extension_upload}";
                // $chemin="blog_img/{$token}.{$extension_upload}";
                //on deplace du serveur au disque dur

                if(move_uploaded_file($_FILES['imageArticle']['tmp_name'],$chemin))
                {
                    // La photo est la source
                    if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                    {$source = imagecreatefromjpeg($chemin);}
                    else{$source = imagecreatefrompng($chemin);}
                    $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                    $largeur_source = imagesx($source);
                    $hauteur_source = imagesy($source);
                    $largeur_destination = imagesx($destination);
                    $hauteur_destination = imagesy($destination);
                    //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                    $chemin0="../Public/img/blog_img/miniature/{$token}.{$extension_upload}";
                    // On crée la miniature
                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                    imagejpeg($destination,$chemin0);
                }
                else
                {
                    echo "no deplace<br/>";
                    exit();
                }
            }
            else
            {
                echo "no extensions<br/>";
                exit();
            }
        }
        else
        {
            echo "no size<br/>";
            exit();
        }
    }
    else
    {
        $chemin = "";
    }

    App::getDB()->update('UPDATE sujets SET titre=:titre, paragraphe=:paragraphe, mot_cles=:mot_cles, image=:image, date_modif=:modif WHERE id_sujet=:id',
        array('titre'=>$_POST['titre'], 'paragraphe'=>$_POST['paragraphe'], 'mot_cles'=>$_POST['mot_cles'], 'image'=>$chemin, 'modif'=>date('Y-m-d H:i:s', time()), 'id' => $_POST['modif_article']));
    header('Location: blog.php');
}


//GESTION DES MODIFICATIONS APPORTEES A UNE IMAGE
if(isset($_POST['id_img'])){

    //on verifi si l'adresse de l'image a ete bien definie
    if(isset($_FILES['image']['name']) AND !empty($_FILES['image']['name']))
    {
        //on verifi la taille de l'image
        if($_FILES['image']['size']>=1000)
        {
            $extensions_valides=Array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
            //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
            //la fonction strtolower($chaine) renvoit la chaine en minuscule
            $extension_upload=strtolower(substr(strrchr($_FILES['image']['name'],'.'),1));
            //on verifi si l'extension_upload est valide

            if(in_array($extension_upload,$extensions_valides))
            {
                $token=md5(uniqid(rand(),true));
                $chemin="../Public/img/blog_img/{$token}.{$extension_upload}";
                // $chemin="blog_img/{$token}.{$extension_upload}";
                //on deplace du serveur au disque dur

                if(move_uploaded_file($_FILES['image']['tmp_name'],$chemin))
                {
                    // La photo est la source
                    if($extension_upload=='jpg' OR $extension_upload=='jpeg' OR $extension_upload=='JPG' OR $extension_upload=='JPEG')
                    {$source = imagecreatefromjpeg($chemin);}
                    else{$source = imagecreatefrompng($chemin);}
                    $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                    // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                    $largeur_source = imagesx($source);
                    $hauteur_source = imagesy($source);
                    $largeur_destination = imagesx($destination);
                    $hauteur_destination = imagesy($destination);
                    //$chemin0="blog_img/miniature/{$token}.{$extension_upload}";
                    $chemin0="../Public/img/blog_img/miniature/{$token}.{$extension_upload}";
                    // On crée la miniature
                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                    imagejpeg($destination,$chemin0);
                }
                else
                {
                    echo "no deplace<br/>";
                    exit();
                }
            }
            else
            {
                echo "no extensions<br/>";
                exit();
            }
        }
        else
        {
            echo "no size<br/>";
            exit();
        }
    }
    else
    {
        $chemin = "";
    }

    App::getDB()->update('UPDATE images SET title=:titre, description=:paragraphe, destination=:mot_cles, chemin=:image, date_modif=:modif WHERE id_img=:id',
        array('titre'=>$_POST['titre'], 'paragraphe'=>$_POST['description'], 'mot_cles'=>$_POST['destination'], 'image'=>$chemin, 'modif'=>time(), 'id' => $_POST['id_img']));
    header('Location: config_page.php');
}

//GESTION DES MODIFICATIONS APPORTEES A UN PROJET
if(isset($_POST['id_projet'])){
    App::getDB()->update('UPDATE projets_encours SET titre=:titre, description=:descript, date_modif=:modif WHERE id_projet=:id',
        array('titre'=>$_POST['titre'], 'descript'=>$_POST['description'], 'modif'=>time(), 'id' => $_POST['id_projet']));
    header('Location: config_page.php');
}

//GESTION DES MODIFICATIONS APPORTEES A UN AGENDA
if(isset($_POST['id_agenda'])){
    App::getDB()->update('UPDATE agenda SET libelle=:titre, debut=:debut, fin=:fin, date_modif=:modif WHERE id_agenda=:id',
        array('titre'=>$_POST['addMsgAgenda'], 'debut'=>$_POST['debut'],'fin'=>$_POST['fin'], 'modif'=>time(), 'id' => $_POST['id_agenda']));
    header('Location: config_page.php');
}


//GESTION DES MODIFICATIONS APPORTEES AUX PROJETS FREELANCES
if(isset($_POST['id_bodyFreelance'])){


    $phpFileUploadErrors = array(
        0=>'Il y a aucune erreur fichier upload avec success',
        1=>'taille du fichier supérieur à la taille minimale requise',
        2=>'fichier trop grand par rapport au format specifié',
        3=>'les fichiers ont partiellement été uploadé',
        4=>'aucun fichier n\'a été uploadé',
        5=>'dossier de destination n\existe pas',
        6=>'impossible d\écrire les fichiers dans le serveur',
        7=>'une extension php a stoppé le chargement des fichiers'
    );


    function reArrayFiles( $file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0;$i<$file_count;$i++){
            foreach ($file_keys as $key){
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    //on verifi si l'adresse de l'image a ete bien definit
    $out_path_img = '';
    if(isset($_FILES['capture']['name']) AND !empty($_FILES['capture']['name']))
    {
        $file_array = reArrayFiles($_FILES['capture']);
        for($i=0;$i<count($file_array);$i++)
        {
            if($file_array[$i]['error'])
            {
                echo 'Erreur: ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];
            }
            else{
                if($file_array[$i]['size']<1000){
                    echo 'Taille de l\'image inférieur à 1ko';
                }
                else{
                    $extension = array('jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF', 'JPEG');
                    //renvoi l extension
                    //$extension_upload=strtolower(substr(strrchr($file_array[$i]['name'],'.'),1));
                    //renvoi aussi l extension
                    //$file_ext[1]

                    $file_ext = explode('.', $file_array[$i]['name']);
                    $name = $file_ext[0];
                    $file_ext = end($file_ext); ////renvoi dernier élement du tableau c-a-d l extension


                    if(!in_array($file_ext, $extension))
                    {
                        echo 'Erreur: ' .$file_array[$i]['name']. ' - Extension Invalid';
                    }
                    else
                    {
                        // $img_dir = 'files/'.$file_array[$i]['name'];
                        $id=md5(uniqid(rand(),true));
                        $chemin="../Public/img/portfolio/{$id}.{$file_ext}";
                        //on deplace du serveur au disque dur
                        if(!move_uploaded_file($file_array[$i]['tmp_name'], $chemin)){
                            echo 'impossible d\'upload les fichiers';
                        }
                        else{

                            // La photo est la source
                            if($file_ext=='jpg' OR $file_ext=='jpeg' OR $file_ext=='JPG' OR $file_ext=='JPEG')
                            {$source = imagecreatefromjpeg($chemin);}
                            else if($file_ext=='gif' OR $file_ext=='GIF'){$source = imagecreatefromgif($chemin);}
                            else{$source = imagecreatefrompng($chemin);}
                            $destination = imagecreatetruecolor(460, 380); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            $chemin0="../Public/img/portfolio/miniature/{$id}.{$file_ext}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            // On enregistre la miniature sous le nom

                            imagejpeg($destination,$chemin0);
                            //$chemin1= str_replace('../Public/', '', $chemin0);
                            $out_path_img .= $chemin0.'-';
                        }

                    }
                    // echo 'Upload effectué avec success ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];

                }
            }

        }
        /*print_r($out_path_img);
                            die();*/

    }else{echo "no defined";}

    App::getDB()->update('UPDATE body SET annee=:annee, activite=:activite, ville=:ville, type_app=:type_app, architecture=:architecture,
                ide=:ide, sgbd=:sgbd, framework=:framework, entite=:entite, nom_entite=:nom_entite, app_dev=:app_dev, methode_analyse=:analyse,
                travaux_effectue=:travaux, langage=:langage, outils=:outils, fonctionnalites=:fonctionnalites, url=:url, screenshot_App=:capture, deploiement=:deploiement, taille=:taille WHERE id_body=:id',
        array('annee'=>$_POST['annee'], 'activite'=>$_POST['activite'], 'ville'=>$_POST['ville'], 'type_app'=>$_POST['type_app'], 'architecture'=>$_POST['architecture'],
            'ide'=>$_POST['ide'],'sgbd'=>$_POST['sgbd'], 'framework'=>$_POST['framework'], 'entite'=>$_POST['entite'],'nom_entite'=>$_POST['nom_entite'], 'app_dev'=>$_POST['app_dev'],'analyse'=>$_POST['analyse'],
            'travaux'=>$_POST['travaux'], 'langage'=>$_POST['langage'], 'outils'=>$_POST['outils'], 'fonctionnalites'=>$_POST['fonctionnalites'],'url'=>$_POST['url'],'capture'=>$out_path_img, 'deploiement' => $_POST['deploiement'], 'taille' => $_POST['taille'], 'id' => $_POST['id_bodyFreelance']));
    header('Location: tableau_freelance.php');
}



//GESTION DES MODIFICATIONS APPORTEES AUX PROJETS ENTREPRISES
if(isset($_POST['id_bodyEntreprise'])){


    $phpFileUploadErrors = array(
        0=>'Il y a aucune erreur fichier upload avec success',
        1=>'taille du fichier supérieur à la taille minimale requise',
        2=>'fichier trop grand par rapport au format specifié',
        3=>'les fichiers ont partiellement été uploadé',
        4=>'aucun fichier n\'a été uploadé',
        5=>'dossier de destination n\existe pas',
        6=>'impossible d\écrire les fichiers dans le serveur',
        7=>'une extension php a stoppé le chargement des fichiers'
    );


    function reArrayFiles( $file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0;$i<$file_count;$i++){
            foreach ($file_keys as $key){
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    //on verifi si l'adresse de l'image a ete bien definit
    $out_path_img = '';
    if(isset($_FILES['capture']['name']) AND !empty($_FILES['capture']['name']))
    {
        $file_array = reArrayFiles($_FILES['capture']);
        for($i=0;$i<count($file_array);$i++)
        {
            if($file_array[$i]['error'])
            {
                echo 'Erreur: ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];
            }
            else{
                if($file_array[$i]['size']<1000){
                    echo 'Taille de l\'image inférieur à 1ko';
                }
                else{
                    $extension = array('jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'GIF', 'JPEG');
                    //renvoi l extension
                    //$extension_upload=strtolower(substr(strrchr($file_array[$i]['name'],'.'),1));
                    //renvoi aussi l extension
                    //$file_ext[1]

                    $file_ext = explode('.', $file_array[$i]['name']);
                    $name = $file_ext[0];
                    $file_ext = end($file_ext); ////renvoi dernier élement du tableau c-a-d l extension


                    if(!in_array($file_ext, $extension))
                    {
                        echo 'Erreur: ' .$file_array[$i]['name']. ' - Extension Invalid';
                    }
                    else
                    {
                        // $img_dir = 'files/'.$file_array[$i]['name'];
                        $id=md5(uniqid(rand(),true));
                        $chemin="../Public/img/portfolio/{$id}.{$file_ext}";
                        //on deplace du serveur au disque dur
                        if(!move_uploaded_file($file_array[$i]['tmp_name'], $chemin)){
                            echo 'impossible d\'upload les fichiers';
                        }
                        else{

                            // La photo est la source
                            if($file_ext=='jpg' OR $file_ext=='jpeg' OR $file_ext=='JPG' OR $file_ext=='JPEG')
                            {$source = imagecreatefromjpeg($chemin);}
                            else if($file_ext=='gif' OR $file_ext=='GIF'){$source = imagecreatefromgif($chemin);}
                            else{$source = imagecreatefrompng($chemin);}
                            $destination = imagecreatetruecolor(460, 380); // On crée la miniature vide

                            // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                            $largeur_source = imagesx($source);
                            $hauteur_source = imagesy($source);
                            $largeur_destination = imagesx($destination);
                            $hauteur_destination = imagesy($destination);
                            $chemin0="../Public/img/portfolio/miniature/{$id}.{$file_ext}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            // On enregistre la miniature sous le nom

                            imagejpeg($destination,$chemin0);
                            //$chemin1= str_replace('../Public/', '', $chemin0);
                            $out_path_img .= $chemin0.'-';
                        }

                    }
                    // echo 'Upload effectué avec success ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];

                }
            }

        }
        /*print_r($out_path_img);
                            die();*/

    }else{echo "no defined";}

    App::getDB()->update('UPDATE body SET annee=:annee, entreprise=:entreprise, activite=:activite, ville=:ville, matricule=:matricule, section=:section, poste_occupe=:poste_occupe, type_app=:type_app, architecture=:architecture,
                ide=:ide, sgbd=:sgbd, framework=:framework, app_dev=:app_dev, methode_analyse=:analyse,
                travaux_effectue=:travaux, langage=:langage, outils=:outils, fonctionnalites=:fonctionnalites, url=:url, screenshot_App=:capture, deploiement=:deploiement, taille=:taille WHERE id_body=:id',
        array('annee'=>$_POST['annee'], 'entreprise'=>$_POST['entreprise'], 'activite'=>$_POST['activite'], 'ville'=>$_POST['ville'], 'matricule'=>$_POST['matricule'], 'section'=>$_POST['section'], 'poste_occupe'=>$_POST['poste_occupe'], 'type_app'=>$_POST['type_app'], 'architecture'=>$_POST['architecture'],
            'ide'=>$_POST['ide'],'sgbd'=>$_POST['sgbd'], 'framework'=>$_POST['framework'], 'app_dev'=>$_POST['app_dev'],'analyse'=>$_POST['analyse'],
            'travaux'=>$_POST['travaux'], 'langage'=>$_POST['langage'], 'outils'=>$_POST['outils'], 'fonctionnalites'=>$_POST['fonctionnalites'],'url'=>$_POST['url'],'capture'=>$out_path_img, 'deploiement' => $_POST['deploiement'], 'taille' => $_POST['taille'], 'id' => $_POST['id_bodyEntreprise']));
    header('Location: tableau_entreprise.php');
}






/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES CATEGORIES DE SOLUTIONS DANS LE BD
========================================================================== */

if(isset($_GET['cat_solution']))
{
    $_POST['addCat_solution'] = htmlentities(stripslashes($_POST['addCat_solution']), ENT_QUOTES);
    $_POST['addDescriptionCat_solution'] = htmlentities(stripslashes($_POST['addDescriptionCat_solution']), ENT_QUOTES);

    nettoieProtect();
    extract($_POST);

    $connexion = App::getDB();
    $result = $connexion->rowCount('SELECT id_cat_solution FROM categorie_solution WHERE intitule="'.$addCat_solution.'"');

    // Si une erreur survient
    if($result > 0 )
    {
        $i++;
        $message .= "Cette Catégorie de Solutions Existe déjà<br/>";
    }
    else
    {
        $connexion->insert('INSERT INTO categorie_solution(intitule, description, date_enreg) 
                                               VALUES(?, ?, ?)', array($addCat_solution, $addDescriptionCat_solution, time()));
        $message .= 'success';
    }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}


/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES SOLUTION DANS LE BD
========================================================================== */

if(isset($_GET['solution']))
{
    $_POST['addTitreSolution'] = htmlentities(stripslashes($_POST['addTitreSolution']), ENT_QUOTES);
    $_POST['addDescriptionSolution'] = htmlentities(stripslashes($_POST['addDescriptionSolution']), ENT_QUOTES);

    nettoieProtect();
    extract($_POST);

    $connexion = App::getDB();
    $result = $connexion->rowCount('SELECT id_solutions FROM solutions WHERE intitule="'.$addTitreSolution.'"');

    // Si une erreur survient
    if($result > 0 )
    {
        $i++;
        $message .= "Cette Solution Existe déjà<br/>";
    }
    else
    {
        $connexion->insert('INSERT INTO solutions(ref_id_admin, ref_cat_solution, intitule, description, date_enreg) 
                                               VALUES(?, ?, ?, ?, ?)', array(1, $list_catSolution, $addTitreSolution, $addDescriptionSolution, time()));
        $message .= 'success';
    }


    if(isset($message)&& $message!='')
    {

        if($i==1)
        {
            echo 'il y a '. $i .' erreur<br/>';
            echo $message;
        }
        else if($i>1)
        {
            echo 'il y a '. $i .' erreurs<br/>';
            echo $message;
        }
        else echo $message;
    }
}



