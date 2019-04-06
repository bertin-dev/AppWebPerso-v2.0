<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 24/03/2019
 * Time: 10h22
 */
?>
<aside id="sidebar" class="col-xs-12 col-sm-12 col-lg-2">
    <span id="vertical-bar-border"></span>
    <div id="search" class="sidebar-bloc">
        <span class="title">Rechercher</span>
        <form id="search_sujet" action="#" method="get" class="" role="search" onsubmit="return false;">
            <input id="search_contenu" type="text" name="search_contenu" class="neutral_input" value="<?php if(isset($_GET['search_contenu'])) echo $_GET['search_contenu'];?>">
            <input id="enreg_search" type="submit" value=">" class="neutral_input">
        </form>
        <span id="output_search"></span>
    </div>

    <div id="categories" class="sidebar-bloc not-search">
        <span class="title">Catégories</span>
        <ul>
            <?php
            foreach (App::getDB()->query('SELECT id_categorie, libelle FROM categorie ORDER BY id_categorie DESC') AS $cat):
                echo '<li>
                    <a class="categorie" data="cat='. $cat->id_categorie. '" href="#">'.
                    $cat->libelle
                    .'<span class="counter">'. App::getDB()->rowCount('SELECT id_categorie, ref_id_categorie FROM sujets 
                                                              INNER JOIN categorie
                                                              ON categorie.id_categorie=sujets.ref_id_categorie
                                                              WHERE id_categorie="'.$cat->id_categorie.'"')
                    .'</span>
                    </a>
                </li>';
            endforeach;
            ?>
        </ul>
    </div>

    <div id="tags" class="sidebar-bloc not-search">
        <span class="title">Archives</span>
        <ul>
            <?php

            foreach (App::getDB()->query('SELECT DATE_FORMAT(date_enreg, "%M %Y") AS date_pub_article, 
                                                                 DATE_FORMAT(date_enreg, "%m") AS m, 
                                                                 DATE_FORMAT(date_enreg, "%Y") AS y, 
                                                                 COUNT(id_sujet) AS nbrID, date_enreg 
                                                          FROM sujets 
                                                          GROUP BY DATE_FORMAT(date_enreg, "%Y%M")') AS $total):


                echo '<li> 
                    <a data="mois='.$total->m.'&annee='.$total->y.'" href="#" class="archive">' . $total->date_pub_article . '<span class="counter">' . $total->nbrID . '</span>
                    </a>
                         </li>';
            endforeach;
            ?>

        </ul>
    </div>
                <span class="visible-sm visible-lg" style="font-variant: small-caps; position: absolute;bottom: 9%; left: 15%; -moz-box-sizing: border-box; box-sizing: border-box;" title="Consultant Développeur"><small><em>  &copy; <?php  echo date("Y", time()); ?>, bertin.dev, Inc.</em></small></span>

</aside>
