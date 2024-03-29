<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 31/03/2018
 * Time: 22h33
 */
require '../../App/Config/Config_Server.php';
// Load Composer's autoloader
require '../../vendor/autoload.php';

session_start();
use \App\PHPMailer\Send_Email;


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


// Connexion à la base de données
$connexion = App::getDB();
nettoieProtect();
extract($_POST);


// Une fois le formulaire envoyé
if(isset($_GET['singUp'])) {

    if(is_numeric($_POST['nomSingUp'][0])){
        echo 'Le Nom doit commencer par une lettre';
        exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['nomSingUp'])) {
        echo "Le Nom est Invalid";
        exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['prenomSingUp'][0])){
        echo 'Le Prenom doit commencer par une lettre<br>';
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['prenomSingUp'])) {
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

    if (!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['passwordSingUp'])) {
        echo "password Invalid";
        exit();
    }


    if ($_POST['passwordSingUp'] != $_POST['passwordConfirmSingUp']) {
        echo "Les Mots de Passe sont différents";
        exit();
    }

    $_POST['nomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['nomSingUp'])));
    $_POST['prenomSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['prenomSingUp'])));
    $_POST['emailSingUp'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingUp'])));
    $_POST['passwordSingUp'] = stripslashes(htmlspecialchars($_POST['passwordSingUp']));
    $_POST['passwordSingUp'] = sha1($_POST['passwordSingUp']);

    // Connexion à la base de données

    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE nom="'.$_POST['nomSingUp'].'" 
     OR email="'.$_POST['emailSingUp'].'"');

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
            $id_forum = $connexion->prepare_request('SELECT id_blog FROM blog', array());
        $connexion->insert('INSERT INTO compte(ref_id_blog, nom, prenom, email, password, date_enreg, clef_activation, etat_compte, privileges) 
                                      VALUES(?,?,?,?,?,?,?,?,?)', [intval($id_forum['id_blog']), $_POST['nomSingUp'], $_POST['prenomSingUp'],
            $_POST['emailSingUp'], $_POST['passwordSingUp'], time(), $clef_activation, '0', 'utilisateur']);

        $max = $connexion->prepare_request('SELECT id_compte AS max_id FROM compte ORDER BY id_compte DESC LIMIT 1', array());
        /*if(!file_exists("../Projets/$max_id")){
            mkdir("../Projets/$max_id", 0755);
        }*/


            // Envoi du mail d'activation
            $sujet = "Activation de votre compte utilisateur";

            $msg ='
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
       <span style="font-size: 9px; position: relative; top: -8px" title="bertin.dev">Bertin</span>
       </div>
        <div style="width: 75%; float:left; font-variant: small-caps"><h1>Développeur</h1></div>
    </nav>
</header>


<div style="text-align: center!important;">
    <h2>Bonjour '.$_POST['prenomSingUp'].' et Bienvenue.</h2>
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
    <a href="https://'.$_SERVER['HTTP_HOST'].'/Public/index.php?id_page=8&amp;numero_id='.$max['max_id'].'&clef='.$clef_activation.'" role="button" style="color: white">Confirmer l\'adresse e-mail >></a>
    </button>
</div>
<br>
<div style="margin-bottom: 25px; display: block">
    <small>Vous souhaitez réaliser votre projet afin d\'être plus productif dans votre activité, n\'hésiter pas à me contacter. Je reste ouvert à tout heure. </small>
</div>

<footer>
        <nav>
                <span style="font-variant: small-caps;" title="Consultant Développeur"><small><em>  © '.date("Y", time()).', bertin.dev, Inc.</em></small></span>
        <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li style="list-style-type: none;"><em> +237 694 04 89 25</em></li></small></span>
        </nav>
</footer>
</body>
</html>
';

            echo Send_Email::envoi($_POST['emailSingUp'], $_POST['nomSingUp'], $sujet, $msg, '', '');
            $connexion->delete('DELETE FROM compte WHERE date_enreg <:date_expiration AND etat_compte=:etat', ['date_expiration' => (time() - 172800), 'etat' => 0]);
            $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Enregistrement partiel', 'index.php', $statut, get_ip(), time()));

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

	   if(strlen($_POST['passwordSingIn']) < 4 ){
        echo "Trop court (4 caractères Minimum)"; 
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9_-]{4,30}$/', $_POST['passwordSingIn'])) {
        echo "password Invalid";
        exit();
    }

    $_POST['emailSingIn'] = strtolower(stripslashes(htmlspecialchars($_POST['emailSingIn'])));
    $_POST['passwordSingIn'] = stripslashes(htmlspecialchars($_POST['passwordSingIn']));
    $_POST['passwordSingIn'] = sha1($_POST['passwordSingIn']);



    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['emailSingIn'].'" AND password="'.$_POST['passwordSingIn'].'" AND etat_compte="1"');

    if($nbre <= 0){

        $admin = $connexion->rowCount('SELECT id_admin FROM admin WHERE email="'.$_POST['emailSingIn'].'" AND pass="'.$_POST['passwordSingIn'].'"');
        if($admin <= 0){
            echo 'Votre Compte n\'existe pas ou alors n\'est pas activé';
            exit;
        }else{
            $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Connexion Administrateur', 'index.php', $statut, get_ip(), time()));
            echo 'admin';
        }
    }

    else {
        $nbre_con =  $connexion->prepare_request('SELECT id_compte, nom, email, nbre_connexion FROM compte WHERE email=:email AND password=:pwd AND etat_compte=:etat_compte',
            ['email'=>$_POST['emailSingIn'], 'pwd'=>$_POST['passwordSingIn'], 'etat_compte'=>'1']);

        $connexion->update('UPDATE compte SET derniere_consult=:consultation, nbre_connexion=:nbre_connexion 
        WHERE email=:email AND password=:pwd AND etat_compte=:etat_compte', ['consultation'=>time(), 'nbre_connexion'=>intval($nbre_con['nbre_connexion'])+1, 'email'=>$_POST['emailSingIn'], 'pwd'=>$_POST['passwordSingIn'], 'etat_compte'=>'1']);

        //gestion du checkbox qui est sur l'authentification
        if(isset($_POST['t_and_c']) && $_POST['t_and_c']=='1')
        {
            setcookie('ID_USER', $nbre_con['id_compte'], time() + 30*24*3600, null, null, false, true);
            setcookie('NOM_USER', $nbre_con['nom'], time() + 30*24*3600, null, null, false, true);
            setcookie('EMAIL_USER', $nbre_con['email'], time() + 30*24*3600, null, null, false, true);
        }
         else{
             $_SESSION['ID_USER'] = $nbre_con['id_compte'];
             $_SESSION['EMAIL_USER'] = $nbre_con['email'];
         }
        $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Connexion utilisateur', 'index.php', $statut, get_ip(), time()));
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



    $nbre = $connexion->rowCount('SELECT id_newsletter FROM newsletter WHERE email_newsletter="'.$_POST['newsletter'].'"');

    if($nbre > 0){
        echo 'l\'adresse Email est déjà utilisé';
        exit;
    }

    else {
        nettoieProtect();
        extract($_POST);

        $visiteur = $connexion->prepare_request('SELECT id_visiteur FROM visiteur WHERE email_visiteur=:email', array('email'=>$_POST['newsletter']));

        if($visiteur['id_visiteur'] == null)
        {
            $connexion->insert('INSERT INTO newsletter(email_newsletter, ip, date_enreg) 
                                      VALUES(?,?,?)', [$_POST['newsletter'], get_ip(), time()]);
         }
        else{

            $connexion->insert('INSERT INTO newsletter(email_newsletter, ip, date_enreg)
                                      VALUES(?,?,?)', [$_POST['newsletter'], get_ip(), time()]);

            $newsletter = $connexion->prepare_request('SELECT id_newsletter, email_newsletter FROM newsletter WHERE email_newsletter=:email', array('email'=>$_POST['newsletter']));

            $connexion->update('UPDATE visiteur SET ref_id_newsletter = ? WHERE email_visiteur = ? ',
                [$newsletter['id_newsletter'], $_POST["newsletter"]]);
        }
        //ECRITURE DANS LE JOURNAL
        $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Envoi d\'une Newsletter', '', $statut, get_ip(), time()));
         //ENVOI DE L EMAIL A L' ADMINISTRATEUR
         Send_Email::envoi('bertmoun@yahoo.fr', 'Bertin Mounok', 'Newsletter', 'Envoi d\'une Newsletter par cette adresse: '.$_POST["newsletter"], '', '');

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

    /*if (!preg_match('/^[A-Za-z0-9_ ]{3,1000}$/', $_POST['message_visitor'])) {
        echo "Le Message Présente des Erreurs";
        exit();
    }*/


    if(!filter_var(get_ip(), FILTER_VALIDATE_IP)) { //Validation d'une adresse IP.
        echo 'Adresse Ip Invalid';
        exit();
    }
    /*---------------------------------------------------*/

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/

    $_POST['identite_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['identite_visitor']))), ENT_QUOTES);
    $_POST['email_visitor'] = htmlentities(strtolower(stripslashes(htmlspecialchars($_POST['email_visitor']))), ENT_QUOTES);
    $_POST['message_visitor'] = htmlentities(nl2br((stripslashes(htmlspecialchars($_POST['message_visitor'])))), ENT_QUOTES);


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

        $newsletter = $connexion->prepare_request('SELECT id_newsletter FROM newsletter WHERE email_newsletter=:email', array('email'=>$_POST['email_visitor']));
       if($newsletter['id_newsletter'] == null)
       {
           $newsletter['id_newsletter'] = 0;
           /***verification si votre compte existe****/
           if( (isset($_SESSION['ID_USER']) && !empty($_SESSION['ID_USER'])) || (isset($_COOKIE['ID_USER']) && !empty($_COOKIE['ID_USER'])) ){
               if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
               if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
               $connexion->insert('INSERT INTO visiteur(ref_id_compte, ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur) 
                                      VALUES(?,?,?,?,?,?,?)', [$compte, $newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
           }
           else
           {
               $connexion->insert('INSERT INTO visiteur(ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur) 
                                      VALUES(?,?,?,?,?,?)', [$newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
           }

          }
       else{
           /***verification si votre compte existe****/
           if( (isset($_SESSION['ID_USER']) && !empty($_SESSION['ID_USER'])) || (isset($_COOKIE['ID_USER']) && !empty($_COOKIE['ID_USER'])) ){
               if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
               else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
               else $compte = 0;
               $connexion->insert('INSERT INTO visiteur(ref_id_compte, ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur) 
                                      VALUES(?,?,?,?,?,?,?)', [$compte, $newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
           }
           else {
               $connexion->insert('INSERT INTO visiteur(ref_id_newsletter, nom_prenom_visiteur, email_visiteur, message_visiteur, heure_envoi_msg_admin, ip_visiteur) 
                                      VALUES(?,?,?,?,?,?)', [$newsletter['id_newsletter'], $_POST['identite_visitor'], $_POST['email_visitor'], $_POST['message_visitor'], time(), get_ip()]);
           }
       }
        //ECRITURE DANS LE JOURNAL

        $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Envoi du Msg à l\'Adminstrateur', '', $statut, get_ip(), time()));

        //ENVOI DE L EMAIL A L' ADMINISTRATEUR
         Send_Email::envoi('bertmoun@yahoo.fr', $_POST['identite_visitor'], 'Message d\'un visiteur (Contact)', $_POST['message_visitor'], '', '');

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

    $nbre = $connexion->rowCount('SELECT id_compte FROM compte WHERE email="'.$_POST['getEmail'].'"');

    if($nbre <= 0){
        echo 'Votre Adresse Email n\'existe pas dans notre base de données';
        exit;
    }

    else {
    //ENVOI D un EMAIL CONTENANT LE MOT DE PASSE ET L ADRESSE EMAIL DANS LA BOITE DU CORRESPONDANT
        echo 'success';
    }
}




/* ==========================================================================
SYSTEME DE SOUMISSION DES COMMENTAIRES
   ========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['commentaire'])) {

    if(strlen($_POST['contenuCommentaireUser']) < 4 || strlen($_POST['contenuCommentaireUser']) > 5000 ){
        echo 'Le Commentaire est compris entre 3 et 5000 caractères';
        exit;
    }

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/
     $_POST['contenuCommentaireUser'] = htmlentities((stripslashes(htmlspecialchars($_POST['contenuCommentaireUser']))), ENT_QUOTES);

    if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;

    $nbre = $connexion->rowCount('SELECT id_commentaires FROM comments WHERE commentaires="'.$_POST['contenuCommentaireUser'].'" AND ref_id_compte="'.$compte.'"');

    if($nbre > 0){
        echo 'Vous avez déjà un Commentaire identique';
        exit;
    }

    else {
        nettoieProtect();
        extract($_POST);


        $connexion->insert('INSERT INTO comments(ref_id_sujet, ref_id_compte, commentaires, data_ajout_commentaires) VALUES (:ref_sujet, :ref_compte, :comments, :temps)',
            ['ref_sujet'=>$_SESSION['id_sujet'], 'ref_compte'=>$compte, 'comments'=>$_POST['contenuCommentaireUser'], 'temps'=>time()]);

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
        echo 'success';

        $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Commentaire', '', $statut, get_ip(), time()));

    }

}



/* ==========================================================================
SYSTEME DE SOUMISSION DES REACTIONS DES COMMENTAIRES
   ========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['reponse_commentaires'])) {


    if(strlen($_POST['message']) < 4 || strlen($_POST['message']) > 5000 ){
        echo 'Le Commentaire est compris entre 3 et 5000 caractères';
        exit;
    }

    /* htmlentities empêche l'excution du code HTML
     * le ENT_QUOTES pour dire à htmlentities qu'on veut en plus transformer les apostrophes et guillemets*/
    $_POST['message'] = htmlentities((stripslashes(htmlspecialchars($_POST['message']))), ENT_QUOTES);


        if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
        else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
        else $compte = 0;

    $connexion->insert('INSERT INTO feedback_comments(ref_id_compte, ref_id_commentaires, reactions_commentaires, date_ajout_react) VALUES (:ref_compte, :ref_commentaires, :feedback, :temps)',
            ['ref_compte'=>$compte, 'ref_commentaires'=>intval($_SESSION['id_comment']), 'feedback'=>$_POST['message'], 'temps'=>time()]);

        echo 'success';

    $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Réaction', '', $statut, get_ip(), time()));

}


// ENREGISTREMENT DES TRAVAUX FREELANCE
if(isset($_GET['freelance']))
{
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
                                  $chemin="../../Public/img/portfolio/{$id}.{$file_ext}";
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
                                      $chemin0="../../Public/img/portfolio/miniature/{$id}.{$file_ext}";
                                      // On crée la miniature
                                      imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                                      // On enregistre la miniature sous le nom

                                      imagejpeg($destination,$chemin0);
                                      $chemin1= str_replace('../../Public/', '', $chemin);
                                      $out_path_img .= $chemin1.'-';
                                  }

                              }
                              // echo 'Upload effectué avec success ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];

                          }
                        }

                    }
/*print_r($out_path_img);
                    die();*/

                }else{echo "no defined";}


                $connexion->insert('INSERT INTO body(annee, type_service, entite, activite, nom_entite,
ville, app_dev, type_app, methode_analyse, architecture, travaux_effectue, ide, langage, sgbd, outils, framework,
fonctionnalites, screenshot_App, url, ref_id_page, statut, deploiement, taille, date_create)
 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$_POST['dateF'], $_POST['typeServiceF'],
                    $_POST['entiteF'], $_POST['activiteF'], $_POST['valeurEntite'], $_POST['ville'], $_POST['app_dev'], $_POST['type_app'],
                    $_POST['analyse'], $_POST['architecture'], $_POST['travaux'], $_POST['ide'], $_POST['langage'], $_POST['sgbd'], $_POST['outils'], $_POST['framework'],$_POST['fonctionnalites'], $out_path_img, $_POST['url'], 2, 1, $_POST['deploiement'], $_POST['taille'], time()]);

                    echo 'success';
                    $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Projet Freelance', 'Administrator/freelance.php', $statut, get_ip(), time()));

}



// ENREGISTREMENT DES TRAVAUX D'ENTREPRISE
if(isset($_GET['entreprise']))
{

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
                                $chemin="../../Public/img/portfolio/{$id}.{$file_ext}";
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
                                    $chemin0="../../Public/img/portfolio/miniature/{$id}.{$file_ext}";
                                    // On crée la miniature
                                    imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                                    // On enregistre la miniature sous le nom

                                    imagejpeg($destination,$chemin0);
                                    $chemin1= str_replace('../../Public/', '', $chemin);
                                    $out_path_img .= $chemin1.'-';
                                }

                            }
                            // echo 'Upload effectué avec success ' .$file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']];

                        }
                    }

                }
                /*print_r($out_path_img);
                                    die();*/

            }else{echo "no defined";}


            $connexion->insert('INSERT INTO body(annee, entreprise, type_service, activite, ville, 
                 matricule, section, poste_occupe, app_dev, type_app, methode_analyse, architecture, travaux_effectue, 
                 ide, langage, sgbd, outils, framework, fonctionnalites, screenshot_App, url, ref_id_page, statut, deploiement, taille, date_create) 
                 VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$_POST['dateE'],$_POST['entreprise'], $_POST['typeService'], $_POST['activite'], $_POST['ville'],
                $_POST['matricule'], $_POST['section'], $_POST['poste'], $_POST['app_dev'], $_POST['type_app'],
                $_POST['analyse'], $_POST['architecture'], $_POST['travaux'], $_POST['ide'], $_POST['langage'], $_POST['sgbd'], $_POST['outils'], $_POST['framework'], $_POST['detail'], $out_path_img, $_POST['url'], 2, 0, $_POST['deploiement'], $_POST['taille'], time()]);

            //$max_id = $connexion->query('SELECT MAX(id_body) AS max_id FROM body');
            /*if(!file_exists("../Projets/$max_id")){
                mkdir("../Projets/$max_id", 0755);
            }*/

    $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation) 
                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Projet d\'entreprise', 'Administrator/entreprise.php', $statut, get_ip(), time()));
    echo 'success';
}