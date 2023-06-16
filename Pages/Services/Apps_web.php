<?php

/**

 * Created by PhpStorm.

 * User: Supers-Pipo

 * Date: 18/02/2019

 * Time: 18h26

 */



require 'compteur_pages.php'; ?>



<?php

     if(isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER'])){

       ?>

         <section id="" class="">

             <div class="container">

                 <div class="row">

                     <form role="form" class="" method="post" action="traitement.php">



                     <div class="col-xs-12 col-md-5 col-lg-5">

                             <!--Switch-->

                             <fieldset>

                                 <label style="float: left" for="myonoffswitch">êtes-vous une Entreprise ? </label>

                                 <div class="onoffswitch" style="float: right;">

                                     <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox check" id="myonoffswitch" checked tabindex="1">

                                     <label class="onoffswitch-label" for="myonoffswitch">

                                         <span class="onoffswitch-inner"></span>

                                         <span class="onoffswitch-switch"></span>

                                     </label>

                                 </div>

                             </fieldset>



                             <fieldset id="form_entreprise" class="collapse" style="margin-bottom: 50px; border-bottom: 2px dashed white">

                                 <h3>ENTREPRISE</h3>

                                 <div class="form-group">

                                     <input class="form-control" id="nomEntreprise" name="nomEntreprise" type="text" required placeholder="NOM DE L'ENTREPRISE *" tabindex="2"><br>

                                     <input class="form-control" id="activiteEntreprise" name="activiteEntreprise" type="text" required placeholder="DOMAINE D'ACTIVITE *" tabindex="3"><br>

                                     <label for="bpEntreprise"> BP </label>

                                     <input style="background-color: #fff;color: #555;" class="form-control" id="bpEntreprise" type="number" name="telEntreprise" placeholder="Ex: 3540" tabindex="4">

                                     <label for="villeEntreprise"><i class="fa fa-map-marker"></i> VILLE *</label>

                                     <select name="villeEntreprise" id="villeEntreprise" class="form-control" style="background-color: #fff;color: #555;" tabindex="5" required>

                                         <option value="douala">Douala</option>

                                         <option value="yaounde">Yaoundé</option>

                                     </select>

                                     <label for="telEntreprise"><i class="fa fa-phone"></i> TEL* </label>

                                     <input style="background-color: #fff;color: #555;" class="form-control" id="telEntreprise" type="text" name="telEntreprise" required placeholder="Ex: 694048925 *" tabindex="6">

                                     <label for="EmailEntreprise"><i class="fa fa-envelope-o"></i> EMAIL* </label>

                                     <input style="background-color: #fff;color: #555;" class="form-control" id="EmailEntreprise" type="email" name="EmailEntreprise" required placeholder="Ex: bertin.dev@outlook.fr *" tabindex="7">

                                     <label for="sitewebEntreprise"><i class="fa fa-sign-in"></i> SITE WEB </label>

                                     <input style="background-color: #fff;color: #555;" class="form-control" id="sitewebEntreprise" type="url" name="sitewebEntreprise" placeholder="Ex: http://wwww.megasoft.com" tabindex="8">

                                 </div>

                             </fieldset>



                             <fieldset id="form_particulier" style="margin-bottom: 50px; border-bottom: 2px dashed white">

                                 <h3>PARTICULIER</h3>

                                 <div class="form-group">

                                     <input class="form-control" id="activiteParticulier" name="activiteParticulier" type="text" placeholder="VOTRE ACTIVITE *" tabindex="8" required><br>

                                     <label for="villeParticulier"><i class="fa fa-map-marker"></i> VILLE *</label>

                                     <select name="villeParticulier" id="villeParticulier" class="form-control" style="background-color: #fff;color: #555;" tabindex="9">

                                         <option value="douala">Douala</option>

                                         <option value="yaounde">Yaoundé</option>

                                     </select>

                                     <label for="telParticulier"><i class="fa fa-phone"></i> TEL* </label>

                                     <input style="background-color: #fff;color: #555;" class="form-control" id="telParticulier" type="text" name="telParticulier" placeholder="VOTRE CONTACT *" tabindex="10" required>

                                     </div>

                             </fieldset>



                             <div class="panel panel-default tab-min" style="background-color: initial;">

                                 <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">

                                     Liste des Fonctionnalités Disponible

                                 </div>

                                 <!-- /.panel-heading -->

                                 <div class="panel-body">

                                     <div class="table-responsive">

                                         <table class="table">

                                             <thead>

                                             <tr>

                                                 <th width="90%">MODULES</th>

                                                 <th width="10%">AJOUT</th>

                                             </tr>

                                             </thead> 

                                            <tbody id="tabdynamique">

                                             <?php

                                             foreach (App::getDB()->query('SELECT DISTINCT id_module_admin, id_services, module_admin.libelle, module_admin.description, estimation, unites FROM module_outils, module_admin, outils_technique, services

                                                                                WHERE module_outils.ref_id_module_admin=module_admin.id_module_admin AND module_outils.ref_id_outils_tech=outils_technique.id_outils

                                                                                AND outils_technique.ref_id_services=services.id_services AND services.id_services=1

                                                                                ORDER BY id_module_admin DESC') AS $cat):

                                                 echo '<tr>

                                                        <td width="90%" title="'.$cat->description.'">'.$cat->libelle.'</td>

                                                        <td width="10%"><a data="AddServ='.$cat->id_module_admin.'&idServ='.$cat->id_services.'" href="#"  class="addElementTab">Ajouter</a></td>

                                                   </tr>';

                                             endforeach;

                                             ?>

                                             </tbody>

                                  <!---------------------------------------------------------------------------------------------------------------------------------->

                                         </table>

                                     </div>

                                     <!-- /.table-responsive -->

                                 </div>

                                 <!-- /.panel-body -->

                             </div>

                     </div>







                     <div class="col-xs-12 col-md-7 col-lg-7">

                         <div class="panel panel-default" style="background-color: initial;">

                             <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">

                                 <?php

                                 $con = App::getDB();

                                 if(isset($_SESSION['nom_service'])){

                                 $serv = $con->prepare_request('SELECT libelle FROM services

                                                                                     WHERE libelle=:titre

                                                                                     ', ['titre'=>$_SESSION['nom_service']]);

                                 echo $serv['libelle'];

                                 }

                                 ?>

                             </div>

                             <!-- /.panel-heading -->

                             <div class="panel-body">

                                 <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                     <div class="col-xs-12 col-sm-6 col-sm-6">

                                         <div class="dataTables_length" id="dataTables-example_length">

                                             <label for="list_cat_mod_cli">Affichage :

                                                 <select id="list_cat_mod_cli" data="<?=$_GET['service'];?>" name="list_cat_mod_cli" aria-controls="dataTables-example" class="form-control input-sm" style="background-color: #fff;color: #555;">

                                                     <?php

                                                     foreach (App::getDB()->query('SELECT id_cat_module_client, libelle FROM cat_module_client ORDER BY id_cat_module_client DESC') AS $cat):

                                                         echo '<option value="'.$cat->id_cat_module_client.'">'.$cat->libelle.'</option>';

                                                     endforeach;

                                                     ?>

                                                 </select>

                                             </label>

                                         </div>

                                     </div>



                                     <div class="col-xs-12 col-sm-6 col-sm-6">

                                         <div id="dataTables-example_filter" class="dataTables_filter">

                                             <label>Recherche:<input type="search" class="form-control input-sm" placeholder="" aria-controls="dataTables-example">

                                             </label>

                                         </div>

                                     </div>

                                 </div>

                                 <div class="row">

                                     <div class="col-xs-12 col-sm-12 col-lg-12">

                                         <?php include('tableau.php'); ?>



                                     </div>

                                 </div>

                             </div>

                             <!-- /.table-responsive -->

                             <div class="well" style="background-color: initial;">

                                 <h4 class="tab-min">VOTRE FACTURE PROFORMA EN UN CLICK</h4>

                                 <input id="form_devis" data="<?=$_GET['service'];?>" type="submit" class="btn btn-default btn-lg btn-block" value="Générer Votre Dévis"><!--target="_blank" Lien ouvrant un nouvel onglet-->

                             </div>

                         </div>

                         <!-- /.panel-body -->

                     </div>

                     </form>

                 </div>

             </div>

         </section>

     <?php

     }else{

         header('Location: index.php');

     }

     ?>

