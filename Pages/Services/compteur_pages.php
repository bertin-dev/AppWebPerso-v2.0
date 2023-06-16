<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 28/11/2018
 * Time: 18h29
 */

require '../Core/Controller/Controller.php';
use Core\Controller\Controller;

// Active tous les warning. Utile en phase de développement. En phase de production, remplacer E_ALL par 0
error_reporting(0);

// Définit l'Id de la page d'accueil (1 dans cet exemple)
$id_page_accueil = 1;
// Récupère l'id de la page courante passée par l'URL. Si non défini, on considère que la page est la page d'accueil
isset($_GET['id_page'])? $_ENV['id_page'] = intval($_GET['id_page']) : $_ENV['id_page'] = $id_page_accueil;
$info_DB = new Controller(); $info_DB->extract_DB();

