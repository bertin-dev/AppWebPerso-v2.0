<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 25/02/2019
 * Time: 19h49
 */
//en cas d'absence de la BD
//extract(unserialize(file_get_contents('tbleau.txt')));
define('MAINTENANCE', 1);
define('FONCTIONNALITES', 2);
define('WEBMARKETING', 3);
define('GESTION_DES_PROJETS', 4);
define('DESIGN_ET_MISE_EN_PAGE', 5);
define('TECHNOLOGIES_UTILISEES', 6);

$totalMaintenance = 0;
$totalFonctionnalites = 0;
$totalWebMarketing = 0;
$totalGestionProjets = 0;
$totalDesign = 0;
$totalTechnologies = 0;
$total = 0;
?>

<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline tab1 tab-min" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
    <!--<tr class="gradeA even" role="row">-->
    <?php
    if(isset($_SESSION['ID_USER'])) $compte = intval($_SESSION['ID_USER']);
    else if(isset($_COOKIE['ID_USER'])) $compte = intval($_COOKIE['ID_USER']);
    else $compte = 0;
    $connexion = App::getDB();
           $maintenance = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.MAINTENANCE;



           $fonctionnalites = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.FONCTIONNALITES;


           $webmarketing = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.WEBMARKETING;

           $gestion_des_projets = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.GESTION_DES_PROJETS;

           $design_et_mise_en_page = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.DESIGN_ET_MISE_EN_PAGE;

           $technologies_utilisees = 'SELECT DISTINCT id_services, id_module_client, module_client.unites FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte="'.$compte.'" AND module_client.ref_id_cat_module_client='.TECHNOLOGIES_UTILISEES;
           ?>
    <thead>
    <tr role="row">
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 162px;">PROJET</th>
        <th class="sorting text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 197px;">DESIGNATION</th>
        <th class="sorting_desc text-center" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 180px;" aria-sort="descending">ESTIMATION</th>

    </tr>
    </thead>

    <tbody>
    <?php
    //BLOC 1 MAINTENANCE
    if(isset($maintenance) && $connexion->rowCount($maintenance)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($maintenance)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>MAINTENANCE));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>MAINTENANCE));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalMaintenance = $totalMaintenance + intval($retour2['estimation']);  echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 2 FONCTIONNALITES
    if(isset($fonctionnalites) && $connexion->rowCount($fonctionnalites)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($fonctionnalites)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>FONCTIONNALITES));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>FONCTIONNALITES));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalFonctionnalites = $totalFonctionnalites + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" href="#" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 3 WEBMARKETING
    if(isset($webmarketing) && $connexion->rowCount($webmarketing)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($webmarketing)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>WEBMARKETING));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>WEBMARKETING));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalWebMarketing = $totalWebMarketing + intval($retour2['estimation']);  echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 4 GESTION DES PROJETS
    if(isset($gestion_des_projets) && $connexion->rowCount($gestion_des_projets)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($gestion_des_projets)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>GESTION_DES_PROJETS));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>GESTION_DES_PROJETS));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalGestionProjets = $totalGestionProjets + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 5 DESIGN ET MISE EN PAGE
    if(isset($design_et_mise_en_page) && $connexion->rowCount($design_et_mise_en_page)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($design_et_mise_en_page)+1;?>" class="text-center">
                <?php
                $resultats = $connexion->prepare_request('
SELECT DISTINCT id_services, cat_module_client.libelle AS model FROM module_client, cat_module_client, compte, module_admin, module_outils, outils_technique, services
WHERE module_client.ref_id_cat_module_client=cat_module_client.id_cat_module_client  
AND module_client.ref_id_compte=compte.id_compte
AND module_client.ref_id_module_admin=module_admin.id_module_admin
AND module_admin.id_module_admin=module_outils.ref_id_module_admin
AND module_outils.ref_id_outils_tech=outils_technique.id_outils
AND outils_technique.ref_id_services=services.id_services
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>DESIGN_ET_MISE_EN_PAGE));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>DESIGN_ET_MISE_EN_PAGE));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalDesign = $totalDesign + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    //BLOC 6 TECHNOLOGIES UTILISEES
    if(isset($technologies_utilisees) && $connexion->rowCount($technologies_utilisees)!= 0){
        ?>
        <tr id="blocG1" class="gradeC odd" role="row">
            <td rowspan="<?=$connexion->rowCount($technologies_utilisees)+1;?>" class="text-center">
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ', array('compte'=>$compte, 'id_cat_mod'=>TECHNOLOGIES_UTILISEES));
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
AND services.id_services="'.intval($_GET['service']).'"
AND id_compte=:compte AND module_client.ref_id_cat_module_client=:id_cat_mod ');
        $retour1->execute(array('compte'=>$compte, 'id_cat_mod'=>TECHNOLOGIES_UTILISEES));
        while ($retour2 = $retour1->fetch()) {
            ?>
            <tr>
                <td class="text-center"><?= $retour2['titre'];?></td>
                <td class="text-center"><?php $totalTechnologies = $totalTechnologies + intval($retour2['estimation']); echo number_format($retour2['estimation'], 1, ',',  ' ');?></td>
                <td colspan="2" class="sorting_1"><a href="#" data="del=<?=$retour2['id_module_client'].'&idServ='.$retour2['id_services'];?>" class="delElementTab">Supp</a></td>
            </tr>
            <?php
        }
        //******FIN DE LA CONDITION *****
    }
    ?>
    </tbody>
    <tfoot>
    <tr class="gradeA odd" role="row">
        <th colspan="2" class="text-center">ESTIMATION DU BUDGET TOTAL</th>
        <th colspan="2" class="text-center">
            <?php
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

$total = $totalMaintenance + $totalFonctionnalites + $totalWebMarketing + $totalGestionProjets + $totalDesign + $totalTechnologies;
			echo number_format($total, 1, ',', ' ') . ' ' . $nbre['unites'];
			
           // echo number_format($nbre['total'], 1, ',', ' ') . ' ' . $nbre['unites'];
            ?>
        </th>
    </tr>
    </tfoot>




</table>
