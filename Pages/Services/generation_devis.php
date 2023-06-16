<?php

/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 26/02/2019
 * Time: 06h15
 */


session_start();

define('MAINTENANCE', 1);

define('FONCTIONNALITES', 2);

define('WEBMARKETING', 3);

define('GESTION_DES_PROJETS', 4);

define('DESIGN_ET_MISE_EN_PAGE', 5);

define('TECHNOLOGIES_UTILISEES', 6);

//documentation html2pdf    http://wiki.spipu.net/doku.php


$totalMaintenance = 0;

$totalFonctionnalites = 0;

$totalWebMarketing = 0;

$totalGestionProjets = 0;

$totalDesign = 0;

$totalTechnologies = 0;

$total = 0;


//recuperation de la veritable adresse ip du visiteur

function get_ip()
{


    //IP si internet partagé

    if (isset($_SERVER['HTTP_CLIENT_IP'])) {

        return $_SERVER['HTTP_CLIENT_IP'];

    } //IP derriere un proxy

    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    } //IP normal

    else {

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

    }

}


ob_start();

?>

<style type="text/css">

    * {

        color: #717375;

    }

    hr {

        background: #717375;

        height: 1px;

        border: none;

    }

    p {

        margin: 0;

        padding: 4mm 0 0 0;

    }

    table {

        width: 100%;

        font-size: 12pt;

        font-family: Helvetica;

        line-height: 6mm;

        letter-spacing: 1px;

        border-collapse: collapse;

    }

    strong {

        color: #000;

    }

    em {

        font-size: 9pt;

        color: #FF0000;

    }

    td.right {

        text-align: right;

    }

    h1 {

        color: #000;

        padding: 0;

        margin: 0;

    }

    table.border td {

        border: 1px solid #CFD1D2;

        padding: 3mm 1mm;

    }

    table.border th, td.black {

        background: #337ab7;

        color: #FFF;

        font-weight: normal;

        font-variant: small-caps;

        border: solid 1px #FFF;

        padding: 1mm 1mm;

        text-align: left;

    }

    td.noborder {

        border: none;

    }

</style>

<page backtop="20mm" backleft="5mm" backright="30mm" backbottom="30mm" footer="page; date;">

    <!--<page_header>



    </page_header>-->


    <page_footer>

        <?php

        require '../../App/Config/Config_Server.php';

        // require ('../../Core/Controller/Controller.php');

        $connexion = App::getDB();

        ?>


        <p><u>Informations Complémentaires</u>:</p>

        <ol style="margin: initial;padding: initial; font-size: 10px;">

            <li>Tous les contenus nous seront fournis par le client et sur support numérique</li>

            <li>Délai de Livraison: 30 jours Variable suivant la complexité du Projet et à dater de la réception des
                contenus.
            </li>

            <li>Modalité de Règlement: 50% à la commande et 50% à la livraison.</li>

            <li>Mode de Paiement:

                <ul>

                    <?php

                    $result = $connexion->prepare_request('SELECT * FROM admin', []);

                    ?>

                    <li>Via Compte Bancaire UBA: N° <?= $result['num_Compte_UBA']; ?></li>

                    <li>Via Orange Money: N° <?= $result['tel']; ?></li>

                </ul>

            </li>

            <li><u>Validité du présent devis</u>: 6 mois</li>

            <li>A titre informatif, les autres travaux non compris dans ce devis seront facturés.</li>

        </ol>

        <p style="text-align: right;">Date...................................................</p>


        <table>

            <tr>

                <td style="width: 50%;"><?= ucfirst(strtolower($result['prenom'])) . ' ' . ucfirst(strtolower($result['nom'])); ?>
                    <br><small><?= $result['poste_occupe']; ?></small></td>

                <td style="width: 50%;" class="right">Signature du Client <br> <small>(Faire précéder de la mention:
                        <small>"bon pour accord"</small>)</small></td>

            </tr>

        </table>


        <p>&nbsp;</p>

        <p>&nbsp;</p>

    </page_footer>

    <table style="vertical-align: top;">

        <tr>

            <td style="width: 67%; font-size: 12px">

                <strong>NOM: <?= $result['nom']; ?></strong><br>

                PRENOM: <?= $result['prenom']; ?> <br>

                Tel: <?= $result['tel']; ?> <br>

                BP: <?= $result['boite_postale']; ?> <br>

                Email: <?= $result['email']; ?> <br>

                Site Web: <?= $result['site_web']; ?>

            </td>


            <td style="width: 33%; font-size: 12px">

                <?php

                if (isset($_SESSION['ID_USER'])) {

                    $compte = intval($_SESSION['ID_USER']);

                    $statut = 'utilisateur';

                } else if (isset($_COOKIE['ID_USER'])) {

                    $compte = intval($_COOKIE['ID_USER']);

                    $statut = 'utilisateur';

                } else {

                    $compte = 0;

                    $statut = 'visiteur';

                }


                $client_info = $connexion->prepare_request('SELECT * FROM compte WHERE id_compte=:id_compte', ['id_compte' => $compte]);

                if (strtolower($client_info['statut_social']) == 'particulier') {

                    ?>

                    <strong>NOM: <?= strtoupper($client_info['nom']); ?></strong><br>

                    PRENOM: <?= strtoupper($client_info['prenom']); ?> <br>

                    Activité: <?= strtoupper($client_info['domaine_activite']); ?> <br>

                    Ville: <?= strtoupper($client_info['ville']); ?> <br>

                    Tel: <?= $client_info['telephone']; ?> <br>

                    Email: <?= $client_info['email']; ?> <br>

                    <?php

                } else {

                    ?>

                    <strong>ENTREPRISE: <?= strtoupper($client_info['nom_entreprise']); ?></strong><br>

                    BP: <?= strtoupper($client_info['bp']); ?> <br>

                    Ville: <?= strtoupper($client_info['ville']); ?> <br>

                    Tel: <?= $client_info['telephone']; ?> <br>

                    Email: <?= $client_info['email_entreprise']; ?> <br>

                    Site: <?= $client_info['site_web']; ?>

                    <?php

                }

                ?>

            </td>

        </tr>

    </table>


    <table style="text-align: center; margin-top: 10mm;">

        <tr>

            <td style="width: 100%; text-align: center;">

                <u>

                    <h1>

                        <?php

                        $serv = $connexion->prepare_request('SELECT libelle FROM services WHERE libelle=:titre', ['titre' => $_SESSION['nom_service']]);

                        echo strtoupper($serv['libelle']);

                        ?>

                    </h1>

                </u>

            </td>

        </tr>

    </table>


    <table style="vertical-align: bottom;margin-top: 5mm">

        <?php

        $nbreDevis = $connexion->prepare_request('SELECT id_compte, nbre_devis_genere FROM compte WHERE id_compte=:id_compte', ['id_compte' => $compte]);

        ?>

        <tr><!--FORMAT DU NUMERO DE DEVIS (nbre de devis généré, id du compte générateur, date de génération )-->

            <td style="width: 50%;"><h1>Devis
                    N°<?= $nbreDevis['nbre_devis_genere'] . $nbreDevis['id_compte'] . date('dmY'); ?></h1></td>

            <td style="width: 50%;" class="right">Emis le <?= date('d/m/Y'); ?></td>

        </tr>

    </table>


    <table class="border">

        <?php

        $maintenance = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . MAINTENANCE;


        $fonctionnalites = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . FONCTIONNALITES;


        $webmarketing = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . WEBMARKETING;


        $gestion_des_projets = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . GESTION_DES_PROJETS;


        $design_et_mise_en_page = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . DESIGN_ET_MISE_EN_PAGE;


        $technologies_utilisees = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte="' . $compte . '" AND module_client.ref_id_cat_module_client=' . TECHNOLOGIES_UTILISEES;

        ?>

        <thead>

        <tr>

            <th style="width: 12%;"></th>

            <th style="width: 65%;font-weight: bold;">DESIGNATION</th>

            <th style="width: 23%;font-weight: bold;">ESTIMATION <br><small
                        style="color: white;"><?php $unit = $connexion->prepare_request($fonctionnalites, []);
                    echo 'EN ' . $unit['unites']; ?> </small></th>

        </tr>

        </thead>


        <tbody style="font-size: 12px">

        <?php

        //BLOC 1 MAINTENANCE

        if (isset($maintenance) && $connexion->rowCount($maintenance) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($maintenance) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request('

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => MAINTENANCE));

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end(' 

SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => MAINTENANCE));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalMaintenance = $totalMaintenance + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        //BLOC 2 FONCTIONNALITES

        if (isset($fonctionnalites) && $connexion->rowCount($fonctionnalites) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($fonctionnalites) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request('

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => FONCTIONNALITES));

                    echo strtoupper($resultats['model']);

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end(' 

SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => FONCTIONNALITES));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalFonctionnalites = $totalFonctionnalites + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        //BLOC 3 WEBMARKETING

        if (isset($webmarketing) && $connexion->rowCount($webmarketing) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($webmarketing) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request('

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => WEBMARKETING));

                    echo strtoupper($resultats['model']);

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end('

SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => WEBMARKETING));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalWebMarketing = $totalWebMarketing + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        //BLOC 4 GESTION DES PROJETS

        if (isset($gestion_des_projets) && $connexion->rowCount($gestion_des_projets) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($gestion_des_projets) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request('

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => GESTION_DES_PROJETS));

                    echo strtoupper($resultats['model']);

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end('

SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => GESTION_DES_PROJETS));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalGestionProjets = $totalGestionProjets + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        //BLOC 5 DESIGN ET MISE EN PAGE

        if (isset($design_et_mise_en_page) && $connexion->rowCount($design_et_mise_en_page) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($design_et_mise_en_page) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request('

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => DESIGN_ET_MISE_EN_PAGE));

                    echo strtoupper($resultats['model']);

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end(' 

SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => DESIGN_ET_MISE_EN_PAGE));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalDesign = $totalDesign + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        //BLOC 6 TECHNOLOGIES UTILISEES

        if (isset($technologies_utilisees) && $connexion->rowCount($technologies_utilisees) != 0) {

            ?>

            <tr>

                <td rowspan="<?= $connexion->rowCount($technologies_utilisees) + 1; ?>">

                    <?php

                    $resultats = $connexion->prepare_request(' 

SELECT DISTINCT id_services, cat_module_client.libelle AS model 

FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte' => $compte, 'id_cat_mod' => TECHNOLOGIES_UTILISEES));

                    echo strtoupper($resultats['model']);

                    ?>

                </td>

            </tr>


            <?php

            $retour1 = App::getDB()->compteur_start_end('

SELECT DISTINCT id_services, id_module_client, module_client.libelle AS titre, module_client.description AS descript, module_client.estimation, module_client.unites, cat_module_client.libelle AS model 

FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services

WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  

AND module_client.ref_id_compte=compte.id_compte

AND module_client.ref_id_module_admin=module_admin.id_module_admin

AND module_admin.id_module_admin=module_outils.ref_id_module_admin

AND module_outils.ref_id_outils_tech=outils_technique.id_outils

AND outils_technique.ref_id_services=services.id_services

AND services.id_services="' . intval($_GET['service']) . '"

AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');

            $retour1->execute(array('compte' => $compte, 'id_cat_mod' => TECHNOLOGIES_UTILISEES));

            while ($retour2 = $retour1->fetch()) {

                ?>

                <tr>

                    <td><?= $retour2['titre']; ?></td>

                    <td><?php $totalTechnologies = $totalTechnologies + intval($retour2['estimation']);
                        echo number_format($retour2['estimation'], 1, ',', ' '); ?></td>

                </tr>

                <?php

            }

            //******FIN DE LA CONDITION *****

        }

        ?>

        <tr>

            <td>

                <br>

                <br>

            </td>

            <td></td>

            <td></td>

        </tr>


        <tr>

            <!-- <td colspan="2" class="noborder" style="padding: 1mm;">TVA non Applicable en Freelance</td>-->

            <td colspan="2" class="black" style="padding: 1mm;">ESTIMATION DU BUDGET TOTAL :</td>

            <td style="padding: 1mm;">

                <?php

                $requete = 'SELECT SUM(estimation) AS total, unites FROM module_client

                   INNER JOIN cat_module_client

                   ON module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client

                   INNER JOIN compte

                   ON module_client.ref_id_compte=compte.id_compte

                   WHERE id_compte=:compte';

                $nbre = App::getDB()->prepare_request($requete, ['compte' => $compte]);

                $total = $totalMaintenance + $totalFonctionnalites + $totalWebMarketing + $totalGestionProjets + $totalDesign + $totalTechnologies;

                echo number_format($total, 1, ',', ' ') . ' ' . $nbre['unites'];


                // echo number_format($nbre['total'], 1, ',', ' ') . ' ' . $nbre['unites'];


                /*



                            $requete = '

SELECT SUM(module_client.estimation) AS total, module_client.unites FROM module_client

INNER JOIN cat_module_client

ON module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client

INNER JOIN compte

ON module_client.ref_id_compte=compte.id_compte

INNER JOIN module_admin

ON module_client.ref_id_module_admin=module_admin.id_module_admin

WHERE compte.id_compte=:compte';

         $nbre = App::getDB()->prepare_request($requete, ['compte' => $compte]);

         echo number_format($nbre['total'], 1, ',', ' ') . ' ' . $nbre['unites'];



                */

                ?>

            </td>

        </tr>

        </tbody>

    </table>


</page>

<?php

$contenu_tableau = ob_get_clean();

//require ('html2pdf/html2pdf.class.php');

require '../../vendor/autoload.php';

use \Spipu\Html2Pdf\Html2Pdf;

use \App\PHPMailer\Send_Email;

try {

    $pdf = new HTML2PDF('P', 'A4', 'fr');

    $pdf->pdf->SetDisplayMode('fullpage');

    $pdf->writeHTML($contenu_tableau);

    //permet d'afficher ou telecharger le pdf généré

    //$pdf->Output('devis.pdf', 'D');


    //empêche l'affichage ou le telechargement du devis

    $content_PDF = $pdf->Output('', 'S');


//ECRITURE DANS LE FICHIER JOURNAL

    $connexion->insert('INSERT INTO journal(ref_id_compte,libelle, page, statut, ip, date_creation)

                                               VALUES(?, ?, ?, ?, ?, ?)', array($compte, 'Génération Devis', 'generation_devis.php', $statut, get_ip(), time()));


    $msg = '

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

     <meta name="copyright" content=" © ' . date('Y', time()) . '", bertin.dev, Inc.">

 </head>

 <body style=" font-size: 15px; line-height: 1.42857143; font-family: \'Sansation\',\'Trebuchet MS\',Helvetica,Verdana,sans-serif,serif; color: #DDD;background: #2f2f2f url(\'Public/img/background.png\') repeat;">



 <header>

     <div style="background-color: #0f6296; height: 5px;"></div>

     <nav role="navigation" style="background-color: #192730; min-height: 50px; margin-bottom: 20px; border: 1px solid transparent;">

        <div style="width: 25%; float: left;">

        <img src="https://' . $_SERVER['HTTP_HOST'] . '/Public/img/bertin-mounok.png" alt="Logo" title="Consultant Developpeur" width="50px">

        <span style="font-size: 9px; position: relative; top: -8px" title="bertin.dev">Bertin</span>

        </div>

         <div style="width: 75%; float:left; font-variant: small-caps"><h1>Développeur</h1></div>

     </nav>

 </header>





 <div style="text-align: center!important;">

     <h2>Cher Utilisateur du site web,</h2>

     <p>Merci de vouloir être régulièrement informé des nouvelles annonces publiées sur la plate-forme web

         <mark><strong>dans la categorie Projet Réalisés.</strong></mark>

     </p>

 </div>



 <div style="background-color: #0f6296; color: white; text-align: center!important; padding: 30px;">

     <p>Vous trouverez en pièce jointe votre dévis généré Dynamiquement. <br> Vous pouvez le télécharger!</p>



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

     <a href="https://' . $_SERVER['HTTP_HOST'] . '/Public/index.php" role="button" style="color: white"><< Rerour sur le Site </a>

     </button>

 </div>

 <br>

 <div style="margin-bottom: 25px; display: block">

     <small>Nous vous remercions pour avoir généré votre Dévis et espèrons une collaboration avec vous.</small>

 </div>



 <footer>

         <nav>

                 <span style="font-variant: small-caps;" title="Consultant Développeur"><small><em> © ' . date("Y", time()) . ', bertin.dev, Inc.</em></small></span>

         <span title="Appels Disponible pour tous projets sérieux" style=" float: right; padding: 0; margin: 0;"><small><li style="list-style-type: none;"><em> +237 694 04 89 25</em></li></small></span>

         </nav>

 </footer>

 </body>

 </html>

 ';

    Send_Email::envoi($client_info['email'], $client_info['prenom'] . ' ' . $client_info['nom'], 'Dévis généré avec success.', $msg, $content_PDF, 'Devis.pdf');

    Send_Email::envoi($result['email'], $result['prenom'] . ' ' . $result['nom'], 'Dévis généré par: ' . $client_info['nom'], 'M.' . $client_info['prenom'] . ' ' . $client_info['nom'] . ' vient de générer son devis', $content_PDF, 'Devis.pdf');


    $module = $connexion->prepare_request('SELECT id_module_client FROM module_client WHERE ref_id_compte=:compte',

        ['compte' => $compte]);


    $devis = $connexion->rowCount('SELECT ref_id_compte, nbre_devis_genere FROM devis WHERE ref_id_compte="' . $compte . '"');


    $compteur_devis = $connexion->prepare_request('SELECT nbre_devis_genere FROM devis WHERE ref_id_compte=:compte',

        ['compte' => $compte]);


    if (intval($devis['ref_id_compte']) == 0) {

        $connexion->insert('INSERT INTO devis(ref_id_compte, ref_id_admin, ref_id_module_client, date_generation_devis, nbre_devis_genere) 

                                      VALUES(?,?,?,?,?)', [$compte, 1, $module['id_module_client'], time(), 1]);

    } else {

        $connexion->update('UPDATE devis SET nbre_devis_genere=:nbre_connexion, date_generation_devis=:dateGeneration 

        WHERE ref_id_compte=:compte', ['nbre_connexion' => intval($compteur_devis['nbre_devis_genere']) + 1, 'dateGeneration' => time(), 'compte' => $compte]);

    }


} catch (HTML2PDF_exception $e) {

    die($e);

}

//SUPPRESSION DU COMPTE CLIENT

//$connexion->delete('DELETE FROM module_client WHERE ref_id_compte=:compte', ['compte' =>$compte]); ;?>


<?php header('Location: index.php'); ?>








