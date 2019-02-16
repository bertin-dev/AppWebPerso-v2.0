<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 05/08/2018
 * Time: 08h52
 */

session_start();

/*<?php setcookie('pseudo', 'M@teo21', time() + 365*24*3600, null, null, false, true); ?>*/
//page de demarrage
isset($_GET['id_page']) ? $page = $_GET['id_page'] : $page=1;
  $_ENV['id_page'] = $page;

 // uniqid(TRUE); permet de générer un clé aléatoire en fonction du temps et la probabilté que cela soit sécurisé est avec le paramètre TRUE
//random_bytes(20); permet de générer un code de 20 caractères
//random_int(1, 100); permet de générer un nombre aléatoire compris entre 0 et 100



//mise en cache du oorps de toutes les pages du site
  ob_start();

  switch($page){
      case 1:
          require '../Pages/Home.php';
          break;

      case 2:
          require '../pages/Portfolio.php';
          break;

      case 3:
          require '../Pages/Competences.php';
          break;

      case 4:
          require '../Pages/Culture.php';
          break;

      case 5:
          require '../Pages/Contact.php';
          break;

      case 6:
          require '../Pages/Apropos.php';
          break;

      case 7:
          require '../Pages/Blog.php';
          break;

      case 8:
          require '../Pages/activer-compte-utilisateur.php';
          break;

      case 9:
          require '../Pages/Services.php';
          break;

      default:
          require '../Pages/404.php';
  }

$contenu = ob_get_clean();
require '../Pages/Templates/default.php';



