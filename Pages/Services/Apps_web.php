<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 18/02/2019
 * Time: 18h26
 */

require 'compteur_pages.php'; ?>


<section id="" class="">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-md-5 col-lg-5">
                <form role="form" class="">
                       <!--Switch-->
                    <fieldset>
                        <label style="float: left" for="myonoffswitch">êtes-vous une Entreprise ? </label>
                        <div class="onoffswitch" style="float: right;">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked tabindex="1">
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset id="form_entreprise" class="collapse">
                        <div class="form-group">
                                <label for="">Nom de l'Entreprise</label>
                                <input class="form-control" id="" type="text" placeholder="Disabled input" tabindex="2">
                                <input class="form-control" id="" type="number" placeholder="Numéro" tabindex="3">
                                <input class="form-control" id="" type="number" placeholder="Numéro" tabindex="4">
                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-group">
                            <label for="typeService">Type de Services: <b>*</b> </label>
                                <select style="background-color: white;" id="" name="" class="form-control" tabindex="5">
                                    <?php
                                    foreach (App::getDB()->query('SELECT id_cat_serv, libelle FROM categorie_services ORDER BY id_cat_serv DESC') AS $cat):
                                        echo '<option value="'.$cat->id_cat_serv.'">'.$cat->libelle.'</option>';
                                    endforeach;
                                    ?>
                                </select>

                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-group">
                            <label for="typeTechnologie">Technologie: </label>
                            <select id="typeTechnologie" name="" class="form-control" tabindex="6">
                                <option value="codage">Codage à la main</option>
                                <option value="Framework">Framework</option>
                                <option value="cms">Content Management Système (CMS)</option>
                            </select>
                        </div>
                    </fieldset>


                    <fieldset id="framework_web" class="collapse">
                            <div class="form-group">
                                <input type="radio" required name="framework" value="Laravel" tabindex="7"><label>Laravel</label>
                                <input type="radio" required name="framework" value="AngularJS" tabindex="8"><label>AngularJs</label>
                            </div>
                    </fieldset>




                    <div class="panel panel-default" style="background-color: initial;">
                        <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                            Liste de Fonctionnalités
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
                                    <tbody>


                                    <tbody>
                                        <?php
                                        foreach (App::getDB()->query('SELECT id_services, libelle FROM services ORDER BY id_services DESC') AS $cat):
                                            echo '<tr>
                                                        <td width="90%">'.$cat->libelle.'</td>
                                                        <td width="10%"><a href="index.php?id_page='.$_ENV['id_page'].'&AddServ='.$cat->id_services.'" onclick="callfunction(); return false; ">Ajouter</a></td>
                                                   </tr>';
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <script>
                                        function callfunction()
                                        {
                                            $(location).attr('href','index.php?id_page=11&AddServ='.<?=$_GET['AddServ'];?>);
                                           // window.location.replace('index.php?id_page=11&AddServ='.<?=$_GET['AddServ'];?>);
                                           // $('body').load('index.php?id_page=11&AddServ='.<?=$_GET['AddServ'];?>);
                                        }
                                    </script>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>


                </form>
            </div>



            <div class="col-xs-12 col-md-7 col-lg-7">
                <div class="panel panel-default" style="background-color: initial;">
                    <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                        Création de sites internet
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                <div class="col-xs-12 col-sm-6 col-sm-6">
                                    <div class="dataTables_length" id="dataTables-example_length">
                                        <label>Affichage Par:
                                            <select id="list" name="model_tmp1" aria-controls="dataTables-example" class="form-control input-sm" onchange="getSelectedValue();" >
                                                <?php
                                                foreach (App::getDB()->query('SELECT id_model, libelle FROM model ORDER BY id_model DESC') AS $cat):
                                                    echo '<option value="'.$cat->id_model.'">'.$cat->libelle.'</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </label>
                                        <script>
                                            function getSelectedValue() {
                                                var selectedValue = document.getElementById("list").value;
                                                $(location).attr('href','index.php?id_page=11&mod=' + $(this).val());

                                            }

                                        </script>
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
                            <div class="col-xs-12 col-sm-12 col-sm-12">
                               <?php include('tableau.php');
                               if(isset($_GET['devis']) AND intval($_GET['devis'])==1){
                                 header('location: ../Pages/Services/generation_devis.php');
                               }
                               ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">GESTION DU PROJET: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Gestion de Projets"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">DESIGN: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Design et Mise en Page"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">FONCTIONNALITES: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Fonctionnalite"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">MAINTENANCE: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Maintenance"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">WEBMARKETING: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Webmarketing"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">TECHNO: <strong><u>
                                    <?php $nbre = App::getDB()->prepare_request('SELECT SUM(_tmp.estimation_tmp) AS total, unites_tmp FROM _tmp WHERE model_tmp=:model', ['model'=>"Technologies utilisees"]);
                                    echo number_format($nbre['total'], 2).'</u></strong> '.$nbre['unites_tmp'];?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">
                                            <a href="#">Précédent</a>
                                        </li>
                                        <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0">
                                            <a href="#">1</a>
                                        </li>
                                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                            <a href="#">2</a>
                                        </li>
                                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                            <a href="#">3</a>
                                        </li>
                                        <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                            <a href="#">4</a>
                                        </li>
                                        <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">
                                            <a href="#">Suivant</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- /.table-responsive -->
                        <div class="well" style="background-color: initial;">
                            <h4>FACTURE</h4>
                            <a class="btn btn-default btn-lg btn-block" href="index.php?id_page=11&devis=1">Générer Votre Dévis</a><!--target="_blank" Lien ouvrant un nouvel onglet-->
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>



    </div>
</section>