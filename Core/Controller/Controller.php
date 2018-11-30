<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 18/08/2018
 * Time: 10h02
 */

namespace Core\Controller;
// Inclus le fichier contenant les fonctions personalisées

use \App;

class Controller
{


    public function extract_DB(){

        //require '../App/Autoloader.php';
        //App\Autoloader::register();
        require '../App/Config/Config_Server.php';



        // Extrait les informations correspondantes à la page en cours de la DB
        foreach(App::getDB()->query('
         SELECT * FROM page
         WHERE id_page='.$_ENV['id_page']) as $con):
            $_ENV['mots_cles'] = $con->mots_cles;
            $_ENV['description'] =$con->description;
            $_ENV['titre'] = $con->titre;
            $_ENV['logo'] = $con->logo;
            $_ENV['id_parent'] = $con->ref_Id_Parent;

        endforeach;
    }



    // Affiche les menus.
    public static function affiche_menu($idpage) {

        $connexion = \App::getDB();
        // Sélectionne toutes les pages filles de la page en cours
        // Si la page n'a pas de page fille, alors on modifie la requète pour obtenir ses pages soeurs.
        $resultat = $connexion->query('SELECT COUNT(*) FROM `page` WHERE ref_Id_Parent='.$idpage, get_called_class());

        if($resultat == 0) {
            $retour = $connexion->query('SELECT id_page, titre FROM `page` WHERE ref_Id_Parent=' . $_ENV['id_parent'], get_called_class());
        }
        else{

            $menu_retour ='<ul id="menu_horizontal" style="float:right;" class="nav navbar-nav">';
            $menu_retour .= '<li class="dropdown"> <a href="index.php">ACCUEIL</a></li> ';

            foreach($connexion->query('SELECT id_page, titre FROM `page` WHERE ref_Id_Parent=' . $idpage, get_called_class()) as $retour):

                $menu_retour .= '<li class="dropdown">';
                if($retour->id_page ==='3')
                    $menu_retour .= '<a class="dropdown-toggle" data-toggle="dropdown" ';
                else
                    $menu_retour .= '<a class="" data-toggle=""';


                $menu_retour .= 'href="index.php?id_page='.$retour->id_page.'" title="'.$retour->titre.'">';
                //$menu_retour .= '<a href="index.php?id_page='.$retour->id_page.'">';
                $menu_retour .= $retour->titre;
                if($retour->id_page ==='3')
                    $menu_retour .= '<b class="caret"></b>';
                $menu_retour .= '</a>';
                if($retour->id_page ==='3')
                {

                    $menu_retour .= '<ul class="dropdown-menu">';
                    $menu_retour .= '<li>';
                    $menu_retour .= '<a class="page-scroll" href="index.php?id_page='.$retour->id_page.'" title="'.$retour->titre.'">';
                    $menu_retour .= $retour->titre;
                    $menu_retour .= '</a>';
                    $menu_retour .= '</li>';
                    $menu_retour .= '</ul>';

                }
                $menu_retour .= '</li>';
            endforeach;
            $menu_retour .= '</ul> ';
        }
        return $menu_retour;
    }

    /*lors de l'execution cette fonction magique est utilisé lorsqu'on a à faire a une variable qui n'existe pas
        public function __get($key)
        {
         $method = 'get'. ucfirst($key);
         $this->$key = $this->$method();
         return $this->$key();
        }

        public function getUrl()
        {
            return 'index.php?page='.$this->titre.'title='.$this->titre;
        }

    */




// Affiche le chemin de fer.
// Paramètres : id de la page en cours -> $idpage
// Renvoie : chemin complet -> $chemin_complet
    /*public static function affiche_chemin_fer($idpage) {
        // on définit la variable pour éviter le warning
        $chemin1 = "";
        $chemin="";
        // Si l'id de la page en cours est différent de 0
        // (0 = page parente de la page racine = inexistante)
        if ($idpage != 0) {
            // on récupère les informations de la page en cours dans la DB

           $chemin = '<section id="inner-headline" class="titre">';
            $chemin .= '<div class="container">';
            $chemin .= '<div class="row">';
            $chemin .= '<div class="col-lg-12">';
            $chemin .= '<ul class="breadcrumb">';
           foreach (\App::getDB()->query('SELECT `titre`, `ref_Id_Parent` FROM `page` WHERE `id_page` ='.$idpage) as $nbre):
               $titrepage = $nbre->titre;
               $idparent = $nbre->ref_Id_Parent;
               $chemin .= '<li class="active">';
            // création du lien vers la page en cours
            $chemin .= ' -> <a href="index.php?id_page='.$idpage.'">'.$titrepage.'</a>';
            // Concaténation du lien de la page N-1 et
            // du lien de la page en cours
               $chemin1 = \middleware\Traitement::affiche_chemin_fer($idparent).$chemin.'</li>';
           endforeach;
            $chemin1 .= '</ul>';
            $chemin1 .= '</div>';
        $chemin1 .= '</div>';
    $chemin1 .='</div>';
$chemin1 .='</section>';
        }
        // renvoie le chemin complet
        return $chemin1;
    }*/




}