<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 03/02/2018
 * Time: 10h02
 */

require_once('page_number.php');
?>


<!-- A Propos de Moi -->

<section id="" class="">
    <div class="container">
        <div class="row">

            <!-- GESTION DE L'ARTICLE DES ENTREPRISES-->
            <article class="col-lg-6">
                <div class="title-big wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="600ms" align="center"><h1>ENTREPRISE</h1></div>
                <?php
                foreach (\App::getDB()->query('
                SELECT * FROM body
                INNER JOIN page
                ON body.ref_id_page = page.id_page
                WHERE statut="0" AND id_page=' . $_ENV['id_page']. ' ORDER BY id_body DESC') as $portfolio):
                    ?>

                    <div class="col-lg-12 well wow fadeInDown" style="background: url('img/pattern15.png');">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#<?= 'entreprise' . $portfolio->id_body; ?>"
                                                  title="<?= $portfolio->entreprise; ?>" data-toggle="tab"><i
                                            class="icon-briefcase"></i><?= $portfolio->entreprise; ?></a></li>
                            <li><a href="#<?= 'travaux' . $portfolio->id_body; ?>" class="description" title="Description" data-toggle="tab">DESCRIPTION</a>
                            </li>
                            <li><a href="#<?= 'captures' . $portfolio->id_body; ?>" title="Captures"
                                   data-toggle="tab">CAPTURES</a></li>
                            <li><a href="#<?= 'fonctionalites' . $portfolio->id_body; ?>" title="Fonctionalités"
                                   data-toggle="tab">FONCTIONALITES</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="<?= 'entreprise' . $portfolio->id_body; ?>">
                                <div class="col-lg-6">
                                    <strong><u>Date de sortie</u>: </strong> <em>
                                        <small><?= date('d/m/Y', strtotime($portfolio->annee)); ?></small>
                                    </em><br>
                                    <strong><u>Entreprise</u>: </strong> <em>
                                        <small><?= $portfolio->entreprise; ?></small>
                                    </em><br>
                                    <strong><u>Activité</u>: </strong> <em>
                                        <small><?= $portfolio->activite; ?></small>
                                    </em><br>
                                    <strong><u>Ville</u>: </strong> <em>
                                        <small><?= $portfolio->ville; ?></small>
                                    </em>
                                </div>
                                <div class="col-lg-6">
                                    <strong><u>Section</u>: </strong> <em>
                                        <small><?= $portfolio->section; ?></small>
                                    </em><br>
                                    <strong><u>Matricule</u>: </strong> <em>
                                        <small><?= $portfolio->matricule; ?></small>
                                    </em><br>
                                    <strong><u>Poste</u>: </strong> <em>
                                        <small><?= $portfolio->poste_occupe; ?></small>
                                    </em>
                                </div>

                            </div>

                            <div class="tab-pane" id="<?= 'travaux' . $portfolio->id_body; ?>">
                                <p><em>
                                        <?php
                                        $travaux = explode('-', $portfolio->travaux_effectue);
                                        for($i=0;$i<count($travaux);$i++)
                                            echo '<br>'.$travaux[$i];
                                        ?>
                                       </em></p>
                            </div>


                            <div class="tab-pane" id="<?= 'captures' . $portfolio->id_body; ?>">

                                <?php
                                $img = explode('-', $portfolio->screenshot_App);
                                for($i=0;$i<count($img)-1;$i++)
                                    echo '<br><img src="'.$img[$i].'" class="img-responsive" title="'.$portfolio->entreprise.'"alt="'.$portfolio->entreprise.'"/>';
                                ?>
                            </div>


                            <div class="tab-pane" id="<?= 'fonctionalites' . $portfolio->id_body; ?>">

                                <div class=" col-lg-6">
                                    <h4 align="center"><u>Fonctionalités</u>:</h4>
                                    <em><?php
                                        $tab = explode('-', $portfolio->fonctionnalites);
                                        for($j=1; $j<count($tab); $j++){
                                            echo '#'.$j.'-'.$tab[$j].'<br>';
                                        } ?></em>
                                </div>

                                <div class="right-sidebar col-lg-6" style="margin-top: initial;">
                                    <h4 align="center"><u>Caractéristiques</u>:</h4>
                                    <strong><u>Technologie</u>: </strong> <em>
                                        <small><?= $portfolio->app_dev; ?></small>
                                    </em><br>
                                    <strong><u>Type</u>: </strong> <em>
                                        <small><?= $portfolio->type_app; ?></small>
                                    </em><br>
                                    <strong><u>Architecture</u>: </strong> <em>
                                        <small><?= $portfolio->architecture; ?></small>
                                    </em><br>
                                    <strong> <u>Méthode d'Analyse</u>: </strong> <em>
                                        <small><?= $portfolio->methode_analyse; ?></small>
                                    </em><br>
                                    <strong><u>IDE</u>:</strong> <em>
                                        <small><?= $portfolio->ide; ?></small>
                                    </em><br>
                                    <strong><u>Langage</u>: </strong> <em>
                                        <small><?= $portfolio->langage; ?></small>
                                    </em><br>
                                    <strong><u>SGBD</u>: </strong> <em>
                                        <small><?= $portfolio->sgbd; ?></small>
                                    </em><br>
                                    <strong><u>Outils</u>: </strong> <em>
                                        <small><?= $portfolio->outils; ?></small>
                                    </em><br>
                                    <strong><u>Framework/CMS</u>: </strong> <em>
                                        <small><?= $portfolio->framework; ?></small>
                                    </em><br>
                                    <strong><u>Déploiement</u>: </strong> <em>
                                        <small><?= $portfolio->deploiement; ?></small>
                                    </em><br>
                                    <strong><u>Taille</u>: </strong> <em>
                                        <small><?= $portfolio->taille; ?> Mo</small>
                                    </em><br>
                                    <strong><u>URL</u>:</strong> <em>
                                        <small><a href="<?= $portfolio->url; ?>" alt="<?= $portfolio->url; ?>"
                                                  title="<?= $portfolio->url; ?>"><?= $portfolio->url; ?></a></small>
                                    </em><br>
                                    <strong><u>Code source</u>:</strong> <em>
                                        <small><a href="<?= $portfolio->code_source; ?>" alt="<?= $portfolio->code_source; ?>"
                                                  title="<?= $portfolio->code_source; ?>"><?= $portfolio->code_source; ?></a></small>
                                    </em>
                                </div>

                            </div>


                        </div>

                    </div>
                <?php
                endforeach;
                ?>
            </article>

            <!-- GESTION DE L'ARTICLE DES FREELANCES   well   style="background: url('img/pattern15.png')"-->
            <article class="col-lg-6">
                <div class="title-big wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="600ms" align="center"><h1>FREELANCE</h1></div>
                <div id="load_more_data" class="wow fadeInDown"></div>
                <div id="load_data_message"></div>

            </article>

        </div>
    </div>

</section>






