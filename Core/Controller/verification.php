<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 13/03/2018
 * Time: 09h37
 */



//ENREGISTREMENT DES INFORMATIONS DU FREELANCE
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



$message='';
$success='';
$i=0;



//Système de notification
if(isset($_POST['view'])){

    $connexion = App::getDB();

    if($_POST['view'] != ''){
     $connexion->update('UPDATE contenu SET notification_vue= :statut', array('statut'=>1));
    }


    $nbre = $connexion->rowCount('SELECT * FROM contenu');
    $output = '';
    if($nbre > 0){
        foreach($connexion->query('SELECT * FROM contenu ORDER BY id_contenu DESC LIMIT 5') as $con):
            $output .= ' <li>
                         <a href="#">
                         <strong>' .$con->activite. '</strong><br>
                         <small><em>' .$con->travaux_effectue. '</em></small>
                         </a> 
                         </li>          
             ';
        endforeach;

    }
    else{
        $output .= '
                    <li><a href="#" style="font-weight: bold; font-style: italic;"> No Notification Found</a> </li>
                   ';
    }

    $count = $connexion->rowCount('SELECT * FROM contenu WHERE notification_vue=0');
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



// Une fois le formulaire envoyé
if(isset($_GET['freelance']))
{

 if(isset($_POST['entite'])){

     nettoieProtect();
     extract($_POST);
     $entite = preg_replace('#[^a-z0-9]#i', '', $entite); //filter everything
     // Connexion à la base de données
     // Valeurs à modifier selon vos paramètres de configuration
     //require '../../App/Config/Config_Server.php';
     $connexion = App::getDB();
      if(strlen($entite) < 4 || strlen($entite) > 16 ){
         echo '<br>L\' entité est compris entre 3 et 16 caractères';
         exit;
     }
      if(is_numeric($entite[0])){
         echo '<br>L\' Entite doit commencer par une lettre';
         exit;
     }
     $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE entite="'.$entite.'"');
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
        $valeurEntite = preg_replace('#[^a-z0-9]#i', '', $valeurEntite); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($valeurEntite) < 4 || strlen($valeurEntite) > 16 ){
            echo '<br>Valeur de L\'Entité compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($valeurEntite[0])){
            echo '<br>La valeur de L\' Entite doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE nom_entite="'.$valeurEntite.'"');
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
        $activite = preg_replace('#[^a-z0-9]#i', '', $activite); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($activite) < 4 || strlen($activite) > 16 ){
            echo '<br>L\' activité est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($activite[0])){
            echo '<br>L\' activité doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE activite="'.$activite.'"');
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
        $ville = preg_replace('#[^a-z0-9]#i', '', $ville); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($ville) < 4 || strlen($ville) > 16 ){
            echo '<br>La ville est comprise entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($ville[0])){
            echo '<br>La ville doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE ville="'.$ville.'"');
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
        $travaux = preg_replace('#[^a-z0-9]#i', '', $travaux); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($travaux) < 4 || strlen($travaux) > 500 ){
            echo '<br>Les Travaux sont compris entre 3 et 500 caractères';
            exit;
        }
        if(is_numeric($travaux[0])){
            echo '<br>Les Travaux doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE travaux_effectue="'.$travaux.'"');
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
        $app_dev = preg_replace('#[^a-z0-9]#i', '', $app_dev); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($app_dev) < 4 || strlen($app_dev) > 16 ){
            echo '<br>L\' APP Développé est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($app_dev[0])){
            echo '<br>L\' App Developpé doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE app_dev="'.$app_dev.'"');
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
        $type_app = preg_replace('#[^a-z0-9]#i', '', $type_app); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($type_app) < 4 || strlen($type_app) > 16 ){
            echo '<br>Type d\'APP compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($type_app[0])){
            echo '<br>Le Type d\'App doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE type_app="'.$type_app.'"');
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
        $architecture = preg_replace('#[^a-z0-9]#i', '', $architecture); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($architecture) < 4 || strlen($architecture) > 16 ){
            echo '<br>L\' Architecture est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($architecture[0])){
            echo '<br>L\' Achitecture doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE architecture="'.$architecture.'"');
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
        $analyse = preg_replace('#[^a-z0-9]#i', '', $analyse); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($analyse) < 4 || strlen($analyse) > 16 ){
            echo '<br>L\' analyse est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($analyse[0])){
            echo '<br>L\' analyse doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE methode_analyse="'.$analyse.'"');
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
        $ide = preg_replace('#[^a-z0-9]#i', '', $ide); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($ide) < 4 || strlen($ide) > 16 ){
            echo '<br>L\' IDE est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($ide[0])){
            echo '<br>L\' IDE doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE ide="'.$ide.'"');
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
        $langage = preg_replace('#[^a-z0-9]#i', '', $langage); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($langage) < 2 || strlen($langage) > 16 ){
            echo '<br>Langage compris entre 1 et 16 caractères';
            exit;
        }
        if(is_numeric($langage[0])){
            echo '<br>Le langage doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE langage="'.$langage.'"');
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
        $sgbd = preg_replace('#[^a-z0-9]#i', '', $sgbd); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($sgbd) < 4 || strlen($sgbd) > 16 ){
            echo '<br>Le SGBD est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($sgbd[0])){
            echo '<br>LE SGBD doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE sgbd="'.$sgbd.'"');
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
        $outils = preg_replace('#[^a-z0-9]#i', '', $outils); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($outils) < 4 || strlen($outils) > 16 ){
            echo '<br>L\' outils est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($outils[0])){
            echo '<br>L\' outil doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE outils="'.$outils.'"');
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
        $framework = preg_replace('#[^a-z0-9]#i', '', $framework); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($framework) < 4 || strlen($framework) > 16 ){
            echo '<br>Le Framework est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($framework[0])){
            echo '<br>Le Framework doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE entite="'.$framework.'"');
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
        $url = preg_replace('#[^a-z0-9]#i', '', $url); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($url) < 4 || strlen($url) > 16 ){
            echo '<br>L\' URL est compris entre 3 et 16 caractères';
            exit;
        }
        if(is_numeric($url[0])){
            echo '<br>L\' URL doit commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE url="'.$url.'"');
        if($nbre > 0){
            echo '<br> URL déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }


    if(isset($_POST['fonctionnalites'])){

        nettoieProtect();
        extract($_POST);
        $fonctionnalites = preg_replace('#[^a-z0-9]#i', '', $fonctionnalites); //filter everything
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres de configuration
        //require '../configuration/Config_Server.php';
        $connexion = App::getDB();
        if(strlen($fonctionnalites) < 4 || strlen($fonctionnalites) > 500 ){
            echo '<br>Les fonctionnalités sont comprises entre 3 et 500 caractères';
            exit;
        }
        if(is_numeric($fonctionnalites[0])){
            echo '<br>Les fonctionnalités doivent commencer par une lettre';
            exit;
        }
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE fonctionnalites="'.$fonctionnalites.'"');
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
        $nbre = $connexion->rowCount('SELECT id_contenu FROM contenu WHERE entite="'.$capture.'"');
        if($nbre > 0){
            echo '<br> capture déjà utilisé';
            exit;
        }
        else{
            echo 'success';
        }
    }*/




}



// Une fois le formulaire envoyé
if(isset($_GET['freelanc']))
{
    //$annee = mktime($_POST['dateF']);

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['entiteF']))
    {
        $i++;
        $message .= "Entite Invalide<br />\n";
    }
    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['valeurEntite']))
    {
        $i++;
        $message .= "Valeur de L'entite Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['activiteF']))
    {
        $i++;
        $message .= "Activité Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['ville']))
    {
        $i++;
        $message .= "ville Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,100}$/', $_POST['travaux']))
    {
        $i++;
        $message .= "travaux Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['app_dev']))
    {
        $i++;
        $message .= "Application Developpe Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['type_app']))
    {
        $i++;
        $message .= "Type Apps Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{3,20}$/', $_POST['architecture']))
    {
        $i++;
        $message .= "architecture Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['analyse']))
    {
        $i++;
        $message .= "analyse Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['ide']))
    {
        $i++;
        $message .= "IDE Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{1,100}$/', $_POST['langage']))
    {
        $i++;
        $message .= "langage Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['sgbd']))
    {
        $i++;
        $message .= "sgbd Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['outils']))
    {
        $i++;
        $message .= "outils Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['framework']))
    {
        $i++;
        $message .= "framework Invalide<br />\n";
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
        require '../configuration/Config_Server.php';
        $connexion = App::getDB();

        nettoieProtect();
        extract($_POST);

      $nbre = $connexion->rowCount('SELECT url FROM contenu WHERE url="'.$_POST['url'].'"');

        // Si une erreur survient
        if($nbre != 0)
        {
            $i++;
            $message .= "Erreur d'accès à la base de données lors de la vérification d'unicité<br/>";
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
                        $chemin="../img/portfolio/{$id}.{$extension_upload}";
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
                            $chemin0="../img/portfolio/miniature/{$id}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            // On enregistre la miniature sous le nom

                            imagejpeg($destination,$chemin0);
                            $chemin1= str_replace('../', '', $chemin0);
                        }else{$message .= "no deplace";}
                    }else{$message .= "no extensions";}
                }else{$message .= "no size";}
            }else{$message .= "no defined";}






            $connexion->insert('INSERT INTO contenu(annee, type_service, entite, activite, nom_entite,
ville, app_dev, type_app, methode_analyse, architecture, travaux_effectue, ide, langage, sgbd, outils, framework,
fonctionnalites, screenshot_App, url, code_page, statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$_POST['dateF'], $_POST['typeServiceF'],
            $_POST['entiteF'], $_POST['activiteF'], $_POST['valeurEntite'], $_POST['ville'], $_POST['app_dev'], $_POST['type_app'],
                $_POST['analyse'], $_POST['architecture'], $_POST['travaux'], $_POST['ide'], $_POST['langage'], $_POST['sgbd'], $_POST['outils'], $_POST['framework'],'', $chemin1, '', 2, 1]);


                    // Envoi du mail d'activation
                    $sujet = "Nouvaux Projet Accompli par bertin.dev";

                    $msg = " Ce mail vous a été envoyé car il a été enregistré lors de l'inscription sur le \n";
                    $msg .= "site web bertin.dev Pour valider votre inscription, merci de cliquer sur le lien suivant :\n";
                   // $message .= "http://" . $_SERVER["SERVER_NAME"];  //http://bertin.dev
                    $msg .= 'http://'.$_SERVER['HTTP_HOST']; //http://bertin.dev:8081

                    //$end=end(explode('/',$_SERVER['PHP_SELF']));

                    /*$a=explode('/',$_SERVER['PHP_SELF']);
                    $end=end($a);*/

                    $end=current(array_reverse(explode('/', $_SERVER['PHP_SELF'])));

                    $rep=str_replace($end,'',$_SERVER['PHP_SELF']);
                    $msg .= $msg.$rep.'index.php?id='.$bdd->lastInsertId(); //"mysql_insert_id();



                    /* Pour envoyer le courrier HTML, vous pouvez mettre l'en-tête du Contenu-type */
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    /* additional headers */
                    $headers .= "To: ".$_POST['prenomE'].' '.$_POST['nomE']." <".$_POST['emailE'].">\r\n";
                    $headers .= "From: Site <www.bertin-mounok.fr>\r\n";



                    // Si une erreur survient
                    if(!@mail($_POST['emailE'], $sujet, $msg, $headers))
                    {
                        $message = "Une erreur est survenue lors de l'envoi du mail d'activation<br />\n";
                        $message .= "Veuillez contacter l'administrateur<br/>";


                    }
                    else
                    {
                        // Message de confirmation
                        $message = "Votre compte utilisateur a partiellement été créée<br />\n";
                        $message .= "Un email vient de vous être envoyé afin de l'activer";
                        // On masque le formulaire
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




/*-----------------------------------------ENTREPRISE-------------------------------*/

if(isset($_GET['entreprise']))
{
    //$annee = mktime($_POST['dateF']);

    // Vérification de la validité des champs
    if(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['entreprise']))
    {
        $i++;
        $message .= "Entreprise Invalide<br />\n";
    }
    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['activite']))
    {
        $i++;
        $message .= "Activité Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['ville']))
    {
        $i++;
        $message .= "Ville Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['section']))
    {
        $i++;
        $message .= "Section Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['matricule']))
    {
        $i++;
        $message .= "Matricule Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['poste']))
    {
        $i++;
        $message .= "Poste Occupé Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,100}$/', $_POST['travaux']))
    {
        $i++;
        $message .= "Travaux Effectués Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['app_dev']))
    {
        $i++;
        $message .= "Application développé Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['type_app']))
    {
        $i++;
        $message .= "Type d'Application Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['architecture']))
    {
        $i++;
        $message .= "Architecture Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['analyse']))
    {
        $i++;
        $message .= "Analyse Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['ide']))
    {
        $i++;
        $message .= "IDE Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{1,20}$/', $_POST['langage']))
    {
        $i++;
        $message .= "Langage Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['sgbd']))
    {
        $i++;
        $message .= "SGBD Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{2,20}$/', $_POST['outils']))
    {
        $i++;
        $message .= "Outils Invalide<br />\n";
    }


    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['framework']))
    {
        $i++;
        $message .= "Framework Invalide<br />\n";
    }

    elseif(!preg_match('/^[A-Za-z0-9_ ]{4,20}$/', $_POST['detail']))
    {
        $i++;
        $message .= "Détails Fonctionnalités Invalide<br />\n";
    }



    else
    {
        // Connexion à la base de données
        // Valeurs à modifier selon vos paramètres configuration
        require '../configuration/Config_Server.php';
        $connexion = App::getDB();

        nettoieProtect();
        extract($_POST);

        $nbre = $connexion->rowCount('SELECT url FROM contenu WHERE url="'.$_POST['url'].'"');

        /*var_dump($nbre);
        die();*/

        // Si une erreur survient
        if($nbre != 0)
        {
            $i++;
            $message .= "Erreur d'accès à la base de données lors de la vérification d'unicité<br/>";
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
                        $chemin="../img/portfolio/{$id}.{$extension_upload}";
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
                            $chemin0="../img/portfolio/miniature/{$id}.{$extension_upload}";
                            // On crée la miniature
                            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);
                            // On enregistre la miniature sous le nom

                            imagejpeg($destination,$chemin0);
                            $chemin1= str_replace('../', '', $chemin0);
                        }else{$message .= "no deplace";}
                    }else{$message .= "no extensions";}
                }else{$message .= "no size";}
            }else{$message .= "no defined";}



            $connexion->insert('INSERT INTO contenu(annee, entreprise, type_service, activite, 
ville, matricule, contenu.section, poste_occupe, app_dev, type_app, methode_analyse, architecture, travaux_effectue, ide, langage, sgbd, outils, framework,
fonctionnalites, screenshot_App, url, code_page, statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$_POST['dateE'], $_POST['entreprise'], $_POST['typeService'],
                $_POST['activite'], $_POST['ville'], $_POST['matricule'], $_POST['section'], $_POST['poste'], $_POST['app_dev'], $_POST['type_app'],
                $_POST['analyse'], $_POST['architecture'], $_POST['travaux'], $_POST['ide'], $_POST['langage'], $_POST['sgbd'], $_POST['outils'], $_POST['framework'],'', $chemin1, '', 2, 0]);


            // Envoi du mail d'activation
            $sujet = "Nouvaux Projet Accompli par bertin.dev";

            $msg = " Ce mail vous a été envoyé car il a été enregistré lors de l'inscription sur le \n";
            $msg .= "site web bertin.dev Pour valider votre inscription, merci de cliquer sur le lien suivant :\n";
            // $message .= "http://" . $_SERVER["SERVER_NAME"];  //http://bertin.dev
            $msg .= 'http://'.$_SERVER['HTTP_HOST']; //http://bertin.dev:8081

            //$end=end(explode('/',$_SERVER['PHP_SELF']));

            /*$a=explode('/',$_SERVER['PHP_SELF']);
            $end=end($a);*/

            $end=current(array_reverse(explode('/', $_SERVER['PHP_SELF'])));

            $rep=str_replace($end,'',$_SERVER['PHP_SELF']);
            $msg .= $msg.$rep.'index.php?id='.$bdd->lastInsertId(); //"mysql_insert_id();



            /* Pour envoyer le courrier HTML, vous pouvez mettre l'en-tête du Contenu-type */
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            /* additional headers */
            $headers .= "To: ".$_POST['prenomE'].' '.$_POST['nomE']." <".$_POST['emailE'].">\r\n";
            $headers .= "From: Site <www.bertin-mounok.fr>\r\n";



            // Si une erreur survient
            if(!@mail($_POST['emailE'], $sujet, $msg, $headers))
            {
                $message = "Une erreur est survenue lors de l'envoi du mail d'activation<br />\n";
                $message .= "Veuillez contacter l'administrateur<br/>";
            }
            else
            {
                // Message de confirmation
                $message = "Votre compte utilisateur a partiellement été créée<br />\n";
                $message .= "Un email vient de vous être envoyé afin de l'activer";
                // On masque le formulaire
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
