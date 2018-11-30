<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 03/02/2018
 * Time: 10h04
 */
require 'middleware/Traitement.php';
use middleware\Traitement;
// Active tous les warning. Utile en phase de développement. En phase de production, remplacer E_ALL par 0
error_reporting(E_ALL);

// Définit l'Id de la page d'accueil (1 dans cet exemple)
$id_page_accueil = 1;
// Récupère l'id de la page courante passée par l'URL. Si non défini, on considère que la page est la page d'accueil
isset($_GET['id_page'])? $_ENV['id_page'] = intval($_GET['id_page']) : $_ENV['id_page'] = $id_page_accueil;

$info_DB = new Traitement(); $info_DB->extract_DB();
?>

<section id="" class="">
    <div class="container">
        <div class="row">



            <!-- GESTION DE L'ARTICLE DES ENTREPRISES-->
            <div class="col-lg-12">

                <div class="page-404">
                    <p class="text-404">404</p>

                    <h2>Aww Snap!</h2>
                    <p>Something went wrong or that page doesn’t exist yet. <br><a href="index.html">Returner A l'accueil</a></p>
                </div>

            </div>

        </div>
    </div>
</section>






