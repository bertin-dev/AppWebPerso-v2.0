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