<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 25/02/2019
 * Time: 19h49
 */
//en cas d'absence de la BD
//extract(unserialize(file_get_contents('tbleau.txt')));
?>

<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
    <thead>
    <tr role="row">
        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 162px;"></th>
        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 197px;">Intitulé</th>
        <th class="sorting_desc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 180px;" aria-sort="descending">Estimation</th>

    </tr>
    </thead>

    <?php
    if(isset($_GET['AddServ']) && !empty(intval($_GET['AddServ'])))
    {
        $con = App::getDB();

        $result = $con->rowCount('SELECT ref_id_services FROM `_tmp` WHERE ref_id_services="'.intval($_GET['AddServ']).'"');

        // Si une erreur survient
        if($result > 0 )
        {
            echo '<script>alert("Vous avez déjà ajouté cette Fonctionnalité !");</script>';
        }
        else{
            $serv_compteur = $con->prepare_request('SELECT id_services, services.libelle AS libel_Serv, description, estimation, unites, model.libelle AS model_libel FROM services
                                                                                INNER JOIN model
                                                                                ON services.ref_id_model=model.id_model
                                                                                WHERE id_services=:serv ORDER BY id_model DESC', ['serv'=>intval($_GET['AddServ'])]);

            $con->insert('INSERT INTO `_tmp` (ref_id_services, titre_tmp, description_tmp, estimation_tmp, unites_tmp, model_tmp, date_tmp) VALUES (:id_services, :titre_tmp, :description_tmp, :estimation_tmp, :unites_tmp, :model_tmp, :date_tmp)',
                [
                    'id_services'=>$serv_compteur['id_services'],
                    'titre_tmp'=>$serv_compteur['libel_Serv'],
                    'description_tmp'=>$serv_compteur['description'],
                    'estimation_tmp'=>$serv_compteur['estimation'],
                    'unites_tmp'=>$serv_compteur['unites'],
                    'model_tmp'=>$serv_compteur['model_libel'],
                    'date_tmp'=>time()
                ]);
            $_SESSION['model'] = $serv_compteur['model_libel'];
        }
    }

//lorque le bouton supprier a été pressé
    if(isset($_GET['del']) && !empty(intval($_GET['del'])))
    {
        //on verifi s 'il existe uniquement un model dans la BD
        $tmp_compteur = App::getDB()->rowCount('SELECT id_tmp FROM `_tmp` WHERE model_tmp="'.$_GET['ref_model'].'"');
     //si oui alors
        if($tmp_compteur==1){
            //On recupere ce seul model pour l'assigner a une variable de session
            $uniq_model = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp=:tmp ', ['tmp'=>$_GET['ref_model']]);
          $_SESSION['uniq_model'] = $uniq_model['model_tmp'];
        }

        //puis on supprime cet unique ou alors le model concerné
        App::getDB()->delete('DELETE FROM `_tmp` WHERE id_tmp=:id', ['id'=>$_GET['del']]);
        //header('location: index.php?id_page='.$_ENV['id_page']);
    }
    ?>
    <tbody id="tab1"><!--<tr class="gradeA even" role="row">-->
    <?php

    //Bloc 1
    echo '<tr id="blocG1" class="gradeC odd collapse" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Gestion de Projets"')
            .'" class="text-center">';
    $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Gestion de Projets"', []);
    echo strtoupper(utf8_encode($retour['model_tmp']));
    echo '</td>';

    $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
    $retour1->execute(array('abc'=>"Gestion de Projets"));
    while ($retour2 = $retour1->fetch())
    {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
    }


    //Bloc 2
    echo '<tr id="blocD2" class="gradeC odd collapse" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Design et Mise en Page"')
            .'" class="text-center">';
    $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Design et Mise en Page"', []);
    echo strtoupper(utf8_encode($retour['model_tmp']));
    echo '</td>';

    $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
    $retour1->execute(array('abc'=>"Design et Mise en Page"));
    while ($retour2 = $retour1->fetch())
    {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
    }

               //Bloc 3
        echo '<tr id="blocF3" class="gradeC odd" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Fonctionnalite"')
        .'" class="text-center">';
        $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Fonctionnalite"', []);
        echo strtoupper(utf8_encode($retour['model_tmp']));
        echo '</td>';

        $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
        $retour1->execute(array('abc'=>"Fonctionnalite"));
        while ($retour2 = $retour1->fetch())
        {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
        }

    //Bloc 4
    echo '<tr id="blocM4" class="gradeC odd" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Maintenance"')
            .'" class="text-center">';
    $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Maintenance"', []);
    echo strtoupper(utf8_encode($retour['model_tmp']));
    echo '</td>';

    $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
    $retour1->execute(array('abc'=>"Maintenance"));
    while ($retour2 = $retour1->fetch())
    {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
    }


    //Bloc 5
    echo '<tr id="blocW5" class="gradeC odd collapse" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Webmarketing"')
            .'" class="text-center">';
    $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Webmarketing"', []);
    echo strtoupper(utf8_encode($retour['model_tmp']));
    echo '</td>';

    $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
    $retour1->execute(array('abc'=>"Webmarketing"));
    while ($retour2 = $retour1->fetch())
    {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
    }



    //Bloc 6
    echo '<tr id="blocT6" class="gradeC odd collapse" role="row">
        <td rowspan="'.$retour = App::getDB()->rowCount('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Technologies utilisees"')
            .'" class="text-center">';
    $retour = App::getDB()->prepare_request('SELECT model_tmp FROM `_tmp` WHERE model_tmp="Technologies utilisees"', []);
    echo strtoupper(utf8_encode($retour['model_tmp']));
    echo '</td>';

    $retour1 = App::getDB()->compteur_start_end('SELECT id_tmp, titre_tmp, estimation_tmp, unites_tmp, model_tmp FROM `_tmp` WHERE model_tmp=:abc');
    $retour1->execute(array('abc'=>"Technologies utilisees"));
    while ($retour2 = $retour1->fetch())
    {
        echo '<td class="">'.utf8_encode($retour2['titre_tmp']).'</td>
                                            <td class="sorting_1">'.number_format($retour2['estimation_tmp'], 1).' '.strtoupper($retour2['unites_tmp']).'</td>
                                            <td class="center"><a href="index.php?id_page=11&del='.$retour2['id_tmp'].'&ref_model='.$retour2['model_tmp'].'">Supprimer</a></td>
                                            </tr>';
    }
    ?>


    </tbody>

    <tfoot>
    <tr class="gradeA odd" role="row">
        <th colspan="2" class="text-center">ESTIMATION DU BUDGET TOTAL</th>
        <th colspan="2" class="text-center">
            <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp', []);
             echo number_format($nbre['total'], 2).' '.$nbre['unites_tmp'];?>
        </th>

    </tr>
    </tfoot>

</table>
