<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 05/08/2018
 * Time: 08h52
 */


session_start();

//page de demarrage
isset($_GET['id_page']) ? $page = $_GET['id_page'] : $page=1;
  $_SESSION['id_page'] = $page;

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
          require '../Pages/Forum.php';
          break;

      default:
          require '../Pages/404.php';
  }

$contenu = ob_get_clean();
require '../Pages/Templates/default.php';



