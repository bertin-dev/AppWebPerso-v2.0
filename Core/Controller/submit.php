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