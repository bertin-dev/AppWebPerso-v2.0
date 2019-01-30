<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 31/03/2018
 * Time: 22h33
 */
require '../../App/Config/Config_Server.php';

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



// Une fois le formulaire envoyé
if(isset($_GET['singUp'])) {

    if(is_numeric($_POST['nomSingUp'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['nomSingUp'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['prenomSingUp'][0])){
        echo 'Le Prenom doit commencer par une lettre<br>';
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['prenomSingUp'])) {
        echo "Le Prenom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['emailSingUp'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailSingUp'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{4,16}$/', $_POST['passwordSingUp'])) {
        echo $message = "password Invalid";
        exit();
    }


    if ($_POST['passwordSingUp'] != $_POST['passwordConfirmSingUp']) {
        echo $message = "Les Mots de Passe sont différents";
        exit();
    }

    $_POST['nomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['nomSingUp'])));
    $_POST['prenomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['prenomSingUp'])));
    $_POST['emailSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingUp'])));
    $_POST['passwordSingUp'] = stripslashes(htmlspecialchars($_POST['passwordSingUp']));
    $_POST['passwordSingUp'] = sha1($_POST['passwordSingUp']);

    // Connexion à la base de données
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE nom="'.$_POST['nomSingUp'].'"
     OR prenom="'.$_POST['prenomSingUp'].'"  
     OR email="'.$_POST['emailSingUp'].'" 
     OR password="'.$_POST['passwordSingUp'].'"');

    if($nbre > 0){
        echo 'Un des champs est déjà utilisé';
        exit;
    }

    else {

        // Génération de la clef d'activation
        $caracteres = array("a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $caracteres_aleatoires = array_rand($caracteres, 8);
        $clef_activation = "";

        foreach ($caracteres_aleatoires as $i) {
            $clef_activation .= $caracteres[$i];
        }


        nettoieProtect();
        extract($_POST);

        $nbreEmail = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['emailSingUp'].'"');

        // Si une erreur survient
        if($nbreEmail > 0)
        {
            echo "Votre Adresse Email Existe déjà<br/>";
        }
        else
        {

        $connexion->insert('INSERT INTO compte(nom, prenom, email, password, date_enreg, clef_activation, etat_compte) 
                                      VALUES(?,?,?,?,?,?,?)', [$_POST['nomSingUp'], $_POST['prenomSingUp'],
            $_POST['emailSingUp'], $_POST['passwordSingUp'], time(), $clef_activation, '0']);

        $max_id = $connexion->query('SELECT MAX(id_compte) AS max_id FROM compte');
        /*if(!file_exists("../Projets/$max_id")){
            mkdir("../Projets/$max_id", 0755);
        }*/

        echo 'success';
    }
}

}






if(isset($_GET['singIn'])) {

    /*-------------------------------*/
    if(is_numeric($_POST['emailSingIn'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['emailSingIn'])) {
        echo "Email Invalid";
        exit();
    }

    /*---------------------------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{4,16}$/', $_POST['passwordSingIn'])) {
        echo $message = "password Invalid";
        exit();
    }

    $_POST['emailSingIn'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingIn'])));
    $_POST['passwordSingIn'] = stripslashes(htmlspecialchars($_POST['passwordSingIn']));
    $_POST['passwordSingIn'] = sha1($_POST['passwordSingIn']);

    // Connexion à la base de données
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['emailSingIn'].'" AND password="'.$_POST['passwordSingIn'].'"');

    if($nbre <= 0){
        echo 'Votre Compte n\'a pas encore été créee';
        exit;
    }

    else {
/*
        nettoieProtect();
        extract($_POST);

            $connexion->insert('INSERT INTO compte(nom, prenom, email, password, date_enreg, clef_activation, etat_compte) 
                                      VALUES(?,?,?,?,?,?,?)', [$_POST['nomSingUp'], $_POST['prenomSingUp'],
                $_POST['emailSingUp'], $_POST['passwordSingUp'], time(), $clef_activation, '0']);

            $max_id = $connexion->query('SELECT MAX(id_compte) AS max_id FROM compte');*/
            /*if(!file_exists("../Projets/$max_id")){
                mkdir("../Projets/$max_id", 0755);
            }*/

            echo 'success';

    }

}




// Une fois le formulaire envoyé
if(isset($_GET['newsletter'])) {

    if(is_numeric($_POST['newsletter'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['newsletter'])) {
        echo "Email Invalid";
        exit();
    }
    $_POST['newsletter'] = strtolower(stripslashes(htmlspecialchars($_POST['newsletter'])));


    // Connexion à la base de données
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_newsletter FROM newsletter WHERE email_newsletter="'.$_POST['newsletter'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {
        nettoieProtect();
        extract($_POST);

            $connexion->insert('INSERT INTO newsletter(email_newsletter, date_enreg) 
                                      VALUES(?,?)', [$_POST['newsletter'], time()]);
            echo 'success';
    }

}




// Une fois le formulaire envoyé
if(isset($_GET['visitor'])) {

    if(is_numeric($_POST['identite_visitor'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9_ ]{3,16}$/', $_POST['identite_visitor'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['email_visitor'][0])){
        echo 'L\'email doit commencer par une lettre<br>';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email_visitor'])) {
        echo "Email Invalid";
        exit();
    }

    /*-------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{3,1000}$/', $_POST['message_visitor'])) {
        echo "Le Message Présente des Erreurs";
        exit();
    }

    /*---------------------------------------------------*/

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/

    $_POST['identite_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['identite_visitor']))), ENT_QUOTES);
    $_POST['email_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['email_visitor']))), ENT_QUOTES);
    $_POST['message_visitor'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['message_visitor'])))), ENT_QUOTES);


    // Connexion à la base de données
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_visiteur FROM visiteur WHERE email_visiteur="'.$_POST['email_visitor'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {
        nettoieProtect();
        extract($_POST);
       /* $connexion->query('
                            SELECT id_compte FROM compte
                            ');*/

        $connexion->insert('INSERT INTO visiteur(nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin) 
                                      VALUES(?,?,?,?)', [$_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time()]);


        echo 'success';
    }

}


/* ==========================================================================
SYSTEME DE RECUPERATION DU MOT DE PASSE
   ========================================================================== */
if(isset($_GET['getEmail'])){

    if(is_numeric($_POST['getEmail'][0])){
        echo 'L\'email doit commencer par une lettre';
        exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['getEmail'])) {
        echo "Email Invalid";
        exit();
    }
    $_POST['getEmail'] = strtolower(stripslashes(htmlspecialchars($_POST['getEmail'])));


    // Connexion à la base de données
    $connexion = App::getDB();
    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['getEmail'].'"');

    if($nbre <= 0){
        echo 'Votre Adresse Email n\'existe pas dans données';
        exit;
    }

    else {
    //ENVOI D un EMAIL CONTENAN LE MODE DE PASSE ET L ADRESSE EMAIL DANS LA BOITE DU CORRESPONDANT
        echo 'success';
    }
}


// Une fois le formulaire envoyé
if(isset($_GET['freelance']))
{


        // Vérification de la validité des champs
        if(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['entiteF']))
        {
            echo "Entite Invalide<br />\n";
            exit();
        }
        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['valeurEntite']))
        {
            echo "Valeur de L'entite Invalide<br />\n";
            exit();
        }


        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['activiteF']))
        {
            echo "Activité Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['ville']))
        {
            echo $message = "ville Invalide<br />\n";
            exit();
        }


        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,100}$/', $_POST['travaux']))
        {
            echo "travaux Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['app_dev']))
        {
            echo "Application Developpe Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['type_app']))
        {
            echo "Type Apps Invalide<br />\n";
            exit();
        }


        elseif(!preg_match('/^[A-Za-z0-9_ ]{3,20}$/', $_POST['architecture']))
        {
            echo "architecture Invalide<br />\n";
            exit();
        }


        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['analyse']))
        {
            echo "analyse Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['ide']))
        {
            echo "IDE Invalide<br />\n";
            exit();
        }


        elseif(!preg_match('/^[A-Za-z0-9_ ]{1,100}$/', $_POST['langage']))
        {
            echo "langage Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['sgbd']))
        {
            echo "sgbd Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['outils']))
        {
            echo "outils Invalide<br />\n";
            exit();
        }

        elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['framework']))
        {
            echo "framework Invalide<br />\n";
            exit();
        }

        /*elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['url']))
        {
            $i++;
            $message .= "URL Invalide<br />\n";
        }*/

        else
        {

            // Connexion à la base de données
            // Valeurs à modifier selon vos paramètres configuration
            //require '../configuration/Config_Server.php';
            $connexion = App::getDB();

            nettoieProtect();
            extract($_POST);

            $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE outils="'.$_POST['outils'].'"');

            // Si une erreur survient
            if($nbre > 0)
            {
                echo "Erreur d'accès à la base de données lors de la vérification d'unicité<br/>";
            }
            else
            {
                //on verifi si l'adresse de l'image a ete bien definit

                if(isset($_FILES['capture']['name']) AND !empty($_FILES['capture']['name']))
                {

                    //on verifi la taille de l'image
                    if($_FILES['capture']['size']>=1000)
                    {
                        $extensions_valides=Array('jpg','jpeg','png');
                        //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                        //la fonction substtr($chaine,1) ignore la premiere caractere de la chaine
                        //la fonction strtolower($chaine) renvoit la chaine en minuscule
                        $extension_upload=strtolower(substr(strrchr($_FILES['capture']['name'],'.'),1));
                        //on verifi si l'extension_upload est valide

                        if(in_array($extension_upload,$extensions_valides))
                        {
                            $id=md5(uniqid(rand(),true));
                            $chemin="../../Public/img/portfolio/{$id}.{$extension_upload}";
                            //on deplace du serveur au disque dur

                            if(move_uploaded_file($_FILES['capture']['tmp_name'],$chemin))
                            {
                                // La photo est la source
                                if($extension_upload=='jpg' OR $extension_upload=='jpeg'){$source = imagecreatefromjpeg($chemin);}
                                else{$source = imagecreatefrompng($chemin);}
                                $destination = imagecreatetruecolor(460, 380); // On crée la miniature vide

                                // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                                $largeur_source = imagesx($source);
                                $hauteur_source = imagesy($source);
                                $largeur_destination = imagesx($destination);
                                $hauteur_destination = imagesy($destination);
                                $chemin0="../../Public/img/portfolio/miniature/{$id}.{$extension_upload}";
                                // On crée la miniature
                                imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                                // On enregistre la miniature sous le nom

                                imagejpeg($destination,$chemin0);
                                $chemin1= str_replace('../../Public/', '', $chemin0);
                            }else{echo "no deplace";}
                        }else{echo "no extensions";}
                    }else{echo "no size";}
                }else{echo "no defined";}






                $connexion->insert('INSERT INTO contenu(annee, type_service, entite, activite, nom_entite,
ville, app_dev, type_app, methode_analyse, architecture, travaux_effectue, ide, langage, sgbd, outils, framework,
fonctionnalites, screenshot_App, url, code_page, statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$_POST['dateF'], $_POST['typeServiceF'],
                    $_POST['entiteF'], $_POST['activiteF'], $_POST['valeurEntite'], $_POST['ville'], $_POST['app_dev'], $_POST['type_app'],
                    $_POST['analyse'], $_POST['architecture'], $_POST['travaux'], $_POST['ide'], $_POST['langage'], $_POST['sgbd'], $_POST['outils'], $_POST['framework'],'', $chemin1, '', 2, 1]);

                $max_id = $connexion->query('SELECT MAX(id_contenu) AS max_id FROM contenu');
                 /*if(!file_exists("../Projets/$max_id")){
                     mkdir("../Projets/$max_id", 0755);
                 }*/


                // Envoi du mail d'activation
                $subject = "Projet Achevé par bertin.dev Analyste Programmeur";

                $msg = "<!DOCTYPE html>
                              <html>
                              <header><meta charset=\"UTF-8\"/>
                                      <title>Nouveau Projet Réalisé</title>
                              </header>
                         <body>
                         <p>
                         salut je suis Bertin Mounok Analyste Programmeur Freelance<br>
                          </p>
                          <p>
                          Ce mail vous a été envoyé afin vous puissiez voir ma dernière réalisation et me contactez evnetuellement en cas de besoin relatif 
                          à mon domaine d'activité.
                          </p>
                          <p>
                          Pour voir ma dernière réalisation, S'il vous plait veuillez cliquer sur ce lien: ";
                $msg .= 'http://'.$_SERVER['HTTP_HOST']; //http://bertin.dev:8081
                $end=current(array_reverse(explode('/', $_SERVER['PHP_SELF'])));
                $rep=str_replace($end,'',$_SERVER['PHP_SELF']);
                $msg .= $msg.$rep.'../../Public/index.php?id_page=2&amp;id_contenu='.$max_id; //"mysql_insert_id();
//echo $msg;
                $msg .= "<br> il redirigera directement sur mon site web porfolio et là vous pourrez avoir accès à l'ensemble
                      de mes prochaines éffectifs et ceux en cours de réalisation.</p>
                      
                      <p>Veuillez agréer Monsieur, l'expression de mon profond respect.
                      Cordialement.</p><br><br><br>
                      <p><strong>Berin Mounok</strong><br>
                      <<strong><em>Analyste Programmeur<em></strong><br>
                      <strong><u>Email</u>:</strong> Bertmoun@yahoo.fr<br>
                      <strong><u>BP:</u><strong> 1492<br>
                      <strong><u>Site Web:</u><strong> http://www.bertin-mounok.fr
                      </p>
                  </body>
                  </html>";

                /* Pour envoyer le courrier HTML, vous pouvez mettre l'en-tête du Contenu-type */
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                /* additional headers */
                $headers .= "bertin.dev \r\n";
                $headers .= "From: Site <http://www.bertin-mounok.fr>\r\n";

                // Si une erreur survient
                if(@mail('bertmoun@yahoo.fr', $subject, $msg, $headers))
                {
                    echo "Une erreur est survenue lors de l'envoi du mail d'activation<br /> Veuillez contacter l'administrateur\n";
                }
                else
                {
                    echo 'success';
                }




            }

        }








}