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

    $message='';
    $success='';
    $i=0;

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
    // Connexion à la base de données
        require '../App/Config/Config_Server.php';

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

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['blogTitre']))
    {
        $i++;
        $message .= "Titre Invalid<br />\n";
    }
    else
    {
        $_POST['blogTitre'] = strtolower(stripslashes(htmlspecialchars($_POST['blogTitre'])));
        $_POST['blogParagraphe'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['blogParagraphe'])))), ENT_QUOTES);

        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

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


            $connexion->insert('INSERT INTO sujets(ref_id_blog, ref_id_categorie, ref_id_archive, titre, paragraphe, image, date_enreg)
                                               VALUES(:blog, :cat, :archive, :titre, :paragraphe, :img, :temps)',
                                               array('blog'=>intval($_POST['id_blog']),
                                                   'cat'=>intval($_POST['blogCategorie']),
                                                   'archive'=>0,
                                                   'titre'=>$_POST['blogTitre'],
                                                   'paragraphe'=>$_POST['blogParagraphe'],
                                                   'img'=>$chemin,
                                                   'temps'=>time()
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
GESTION DU SYSTEME D INSERTION DES MODELS DANS LE BD
========================================================================== */
if(isset($_GET['models']))
{
    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addModels']))
    {
        $i++;
        $message .= "Models Invalid<br />\n";
    }

    else
    {
        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_model FROM model WHERE libelle="'.$addModels.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Model Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO model(libelle, date_creat_model) 
                                               VALUES(?, ?)', array($addModels, time()));
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
GESTION DU SYSTEME D INSERTION DES CATEGORIES DE SERVICES DANS LE BD
========================================================================== */

if(isset($_GET['cat_services']))
{
    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addCat_services']))
    {
        $i++;
        $message .= "Catégorie de Services Invalid<br />\n";
    }

    else
    {
        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_cat_serv FROM categorie_services WHERE libelle="'.$addCat_services.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Cette Catégorie de Services Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO categorie_services(libelle, date_enreg_cat_serv) 
                                               VALUES(?, ?)', array($addCat_services, time()));
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
GESTION DU SYSTEME D INSERTION DES SERVICES DANS LE BD
========================================================================== */

if(isset($_GET['services']))
{

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['titreServices']))
    {
        $i++;
        $message .= "Titre Invalid<br />\n";
    }
    else
    {
        $_POST['titreServices'] = stripslashes(htmlspecialchars($_POST['titreServices']));
        $_POST['descriptionServices'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['descriptionServices'])))), ENT_QUOTES);

        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_services FROM services WHERE libelle="'.$_POST['titreServices'].'" OR description="'.$_POST['descriptionServices'].'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Titre ou alors cette Description Existe déjà<br/>";
        }
        else
        {

            $connexion->insert('INSERT INTO services(ref_id_cat_serv, ref_id_model, ref_id_typeF, ref_id_admin, services.libelle, description, estimation, unites ,date_enreg_services)
                                               VALUES(:cat_serv, :id_model, :id_typeF, :id_admin, :titre, :descript, :estimation, :unites ,:temps)',
                array('cat_serv'=>intval($_POST['bloc_services']),
                    'id_model'=>intval($_POST['cat_services_models']),
                    'id_typeF'=>intval($_POST['fonctionnality']),
                    'id_admin'=>0,
                    'titre'=>$_POST['titreServices'],
                    'descript'=>$_POST['descriptionServices'],
                    'estimation'=>$_POST['prixServices'],
                    'unites'=>$_POST['unites_services'],
                    'temps'=>time()
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
GESTION DU SYSTEME D INSERTION DES TYPES DE FONCTIONNALITES DANS LE BD
========================================================================== */

if(isset($_GET['typeF']))
{
    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addTypeF']))
    {
        $i++;
        $message .= "Type de Fonctionnalité Invalid<br />\n";
    }

    else
    {
        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_typeF FROM type_fonctionnalite WHERE libelle="'.$addTypeF.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Ce Type de Fonctionnalites Existe déjà<br/>";
        }
        else
        {
            $connexion->insert('INSERT INTO type_fonctionnalite(libelle, date_create) 
                                               VALUES(?, ?)', array($addTypeF, time()));
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
        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

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
                                               VALUES(?, ?, ?, ?, ?, ?)', array(0, $addMsgAgenda, $addDAgenda, $addFAgenda, $duree, time()));
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


/* ==========================================================================
GESTION DU SYSTEME D INSERTION DES SERVICES DANS LE BD
========================================================================== */

/*if(isset($_GET['fonctionnalites']))
{

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['addfonctionnalites']))
    {
        $i++;
        $message .= "Fonctionnalité Invalid<br />\n";
    }
    else
    {
        $_POST['addfonctionnalites'] = stripslashes(htmlspecialchars($_POST['addfonctionnalites']));

        // Connexion à la base de données
        require '../App/Config/Config_Server.php';

        nettoieProtect();
        extract($_POST);

        $connexion = App::getDB();
        $result = $connexion->rowCount('SELECT id_fonctionnalite FROM fonctionnalite WHERE libelle="'.$addfonctionnalites.'"');

        // Si une erreur survient
        if($result > 0 )
        {
            $i++;
            $message .= "Cette Fonctionnalité Existe déjà<br/>";
        }
        else
        {

            $connexion->insert('INSERT INTO fonctionnalite(ref_id_admin, ref_id_typeF, fonctionnalite.libelle, date_creation)
                                               VALUES(:id_admin, :id_typeF, :titre, :temps)',
                array(
                    'id_admin'=>0,
                    'id_typeF'=>intval($_POST['fonctionnality']),
                    'titre'=>$addfonctionnalites,
                    'temps'=>time()
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
}*/