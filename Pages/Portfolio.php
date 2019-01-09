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
                <div class="title-big" align="center"><h1>ENTREPRISE</h1></div>
                <?php
                foreach (\App::getDB()->query('
         SELECT * FROM contenu
         INNER JOIN page
         ON contenu.code_page = page.id_page
         WHERE statut="0" AND id_page=' . $_ENV['id_page']) as $portfolio):
                    ?>

                    <div class="col-lg-12 well" style="background: url('img/pattern15.png');">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#<?= 'entreprise' . $portfolio->id_contenu; ?>"
                                                  title="<?= $portfolio->entreprise; ?>" data-toggle="tab"><i
                                            class="icon-briefcase"></i><?= $portfolio->entreprise; ?></a></li>
                            <li><a href="#<?= 'travaux' . $portfolio->id_contenu; ?>" title="Travaux" data-toggle="tab">TRAVAUX</a>
                            </li>
                            <li><a href="#<?= 'captures' . $portfolio->id_contenu; ?>" title="Captures"
                                   data-toggle="tab">CAPTURES</a></li>
                            <li><a href="#<?= 'fonctionalites' . $portfolio->id_contenu; ?>" title="Fonctionalités"
                                   data-toggle="tab">FONCTIONALITES</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="<?= 'entreprise' . $portfolio->id_contenu; ?>">
                                <div class="col-lg-6">
                                    <strong>Année :</strong> <em>
                                        <small><?= $portfolio->annee; ?></small>
                                    </em><br>
                                    <strong>Entreprise:</strong> <em>
                                        <small><?= $portfolio->entreprise; ?></small>
                                    </em><br>
                                    <strong>Activité:</strong> <em>
                                        <small><?= $portfolio->activite; ?></small>
                                    </em><br>
                                    <strong>Ville:</strong> <em>
                                        <small><?= $portfolio->ville; ?></small>
                                    </em>
                                </div>
                                <div class="col-lg-6">
                                    <strong>Section:</strong> <em>
                                        <small><?= $portfolio->section; ?></small>
                                    </em><br>
                                    <strong>Matricule:</strong> <em>
                                        <small><?= $portfolio->matricule; ?></small>
                                    </em><br>
                                    <strong>Poste:</strong> <em>
                                        <small><?= $portfolio->poste_occupe; ?></small>
                                    </em>
                                </div>

                            </div>

                            <div class="tab-pane" id="<?= 'travaux' . $portfolio->id_contenu; ?>">
                                <p><em><?= $portfolio->travaux_effectue; ?></em></p>
                            </div>


                            <div class="tab-pane" id="<?= 'captures' . $portfolio->id_contenu; ?>">
                                <img src="<?= $portfolio->screenshot_App; ?>" class="img-responsive"
                                     title="<?= $portfolio->entreprise; ?>"
                                     alt="<?= $portfolio->entreprise; ?>"/>

                            </div>


                            <div class="tab-pane" id="<?= 'fonctionalites' . $portfolio->id_contenu; ?>">

                                <div class=" col-lg-6">
                                    <h4 align="center"><u>Fonctionalités</u>:</h4>
                                    <em><?= $portfolio->fonctionnalites; ?></em>
                                </div>

                                <div class="right-sidebar col-lg-6">
                                    <h4 align="center"><u>Caractéristiques</u>:</h4>
                                    <strong>Technologie :</strong> <em>
                                        <small><?= $portfolio->app_dev; ?></small>
                                    </em><br>
                                    <strong>Type:</strong> <em>
                                        <small><?= $portfolio->type_app; ?></small>
                                    </em><br>
                                    <strong>Architecture:</strong> <em>
                                        <small><?= $portfolio->architecture; ?></small>
                                    </em><br>
                                    <strong> Méthode d'Analyse:</strong> <em>
                                        <small><?= $portfolio->methode_analyse; ?></small>
                                    </em><br>
                                    <strong>IDE:</strong> <em>
                                        <small><?= $portfolio->ide; ?></small>
                                    </em><br>
                                    <strong>Langage:</strong> <em>
                                        <small><?= $portfolio->langage; ?></small>
                                    </em><br>
                                    <strong>SGBD:</strong> <em>
                                        <small><?= $portfolio->sgbd; ?></small>
                                    </em><br>
                                    <strong>Outils:</strong> <em>
                                        <small><?= $portfolio->outils; ?></small>
                                    </em><br>
                                    <strong>Framework/CMS:</strong> <em>
                                        <small><?= $portfolio->framework; ?></small>
                                    </em><br>
                                    <strong>URL:</strong> <em>
                                        <small><a href="<?= $portfolio->url; ?>" alt="<?= $portfolio->url; ?>"
                                                  title="<?= $portfolio->url; ?>"><?= $portfolio->url; ?></a></small>
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
                <div class="title-big" align="center"><h1>FREELANCE</h1></div>
                <div id="load_more_data"></div>
                <div id="load_data_message"></div>

            </article>

        </div>
    </div>

</section>






