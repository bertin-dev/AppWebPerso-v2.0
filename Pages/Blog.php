<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 20/12/2018
 * Time: 22h40
 */
?>
<?php
require_once('page_number.php'); ?>

<section id="blog" class="blog-section">
    <div id="blog-list">

        <div id="articles">

                <div id="loader_blog" style="display: none; position: relative; top: 300px; text-align: center">
                    <span class="loader loader-circle"></span>
                    Chargement......
                </div>

            <?php
            $nombreDeMessagesParPage = 5; // Essayez de changer ce nombre pour voir :o)
            // Maintenant, on va afficher les messages
            if (isset($_GET['blog1']))
            {
                $blog1 = $_GET['blog1']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
            }
            else // La variable n'existe pas, c'est la première fois qu'on charge la page
            {
                $blog1 = 1; // On se met sur la page 1 (par défaut)
            }

            // On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
            $premierMessageAafficher = ($blog1 - 1) * $nombreDeMessagesParPage;

            $blog = App::getDB()->compteur_start_end('SELECT id_sujet, titre, paragraphe, image, sujets.date_enreg, libelle FROM sujets 
                                                            INNER JOIN categorie
                                                            ON categorie.id_categorie=sujets.ref_id_categorie
                                                            ORDER BY id_sujet DESC LIMIT :offset , :limit');
            $blog->bindParam(':offset', $premierMessageAafficher , PDO::PARAM_INT);
            $blog->bindParam(':limit', $nombreDeMessagesParPage, PDO::PARAM_INT);
            $blog->execute();
            while ($blog_item = $blog->fetch()) {
                echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                         <!--BLOC 1-->
          <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a href="index.php?id_page=' . intval($_GET['id_page']) . '&amp;comments=' . intval($blog_item['id_sujet']) . '" class="" title="' . $blog_item['titre'] . '">' .
                    $blog_item['titre']
                    . '</a>
        </h1>
            <p class="blog-article-1-p-1">'.substr($blog_item['paragraphe'], 0, 50).'</p>
         <p class="blog-article-1-p-2">
            <a href="index.php?id_page=' . intval($_GET['id_page']) . '&amp;comments=' . intval($blog_item['id_sujet']) . '" tabindex="-1" title="' . $blog_item['titre'] . '">Lire la suite</a>
        </p>
        </div>
                         <!--BLOC 2-->
          <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">' . date('d', strtotime($blog_item['date_enreg'])) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', strtotime($blog_item['date_enreg'])) . '</span><br>
                                <span class="year">' . date('Y', strtotime($blog_item['date_enreg'])) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', strtotime($blog_item['date_enreg'])) . ':' . date('i', strtotime($blog_item['date_enreg'])) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">'.$blog_item['libelle'].'</a>
        <a href="index.php?id_page=' . intval($_GET['id_page']) . '&amp;comments=' . intval($blog_item['id_sujet']) . '" class="comments">';
                $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
                if($totalComments==1)
                    echo ' Un Commentaire';
                else if($totalComments==0)
                    echo $totalComments.' Commentaire';
                else
                    echo $totalComments.' Commentaires';
                echo '</a>

        <div class="tags-container">
            <p class="tags">
                <span class="tags-label">Mots-clés : </span><br>
                <a href="#" class="nav-js" data-destination="blog" data-title="Articles ayant le tag histoire d\'un site">histoire d\'un site</a>
                <br>
            </p>
        </div>
      <!---------------------------------->
       </div>
    </div>
                         <!--BLOC 3-->
          <div class="col-xs-12 col-sm-3 col-lg-4 illu-article">
            <a href="index.php?id_page=' . intval($_GET['id_page']) . '&amp;comments=' . intval($blog_item['id_sujet']) . '" tabindex="-1">
                <img class="img-responsive" src="' . $blog_item['image'] . '" alt="' . $blog_item['titre'] . '" title="' . $blog_item['titre'] . '">
            </a>
    </div>
</article>
        ';
            }//fin de while
            ?>

        </div>
       <!--BLOC DE ASIDE LATERALE -->
    <?php require 'Blog_Aside.php'; ?>


        <?php
        if(!isset($_GET['comments'])){
            // On met dans une variable le nombre de messages qu'on veut par page
            // On récupère le nombre total de messages
            if(isset($_GET['cat']) && !empty($_GET['cat']))
                $totalDesMessages = App::getDB()->rowCount('SELECT id_sujet FROM sujets INNER JOIN categorie ON sujets.ref_id_categorie=categorie.id_categorie WHERE id_categorie="'.intval($_GET['cat']).'" ORDER BY id_sujet DESC');
            else
                $totalDesMessages = App::getDB()->rowCount('SELECT id_sujet FROM sujets ORDER BY id_sujet DESC');
            // On calcule le nombre de pages à créer
            $nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
            /*var_dump($nombreDePages);
    var_dump($totalDesMessages);
    var_dump($nombreDeMessagesParPage);
            die();*/

            //  $publication = App::getDB()->prepare_request('SELECT * FROM sujets', null);
            // Puis on fait une boucle pour écrire les liens vers chacune des pages
            echo '<div class="col-xs-12 col-sm-10 col-lg-12">
                    <div class="pagination1">';
            /* Boucle sur les pages */
            for ($i = 1 ; $i <= $nombreDePages ; $i++) {
                if ($i < ($blog1-3) )
                    $i = $blog1 - 3;
                if ($i >= $blog1 + 3 AND $i <= $nombreDePages - 3)
                    echo "...";
                if ($i > ($blog1+2) )
                    $i = $nombreDePages ;
                if ($i == $blog1 )
                    echo "<span id='current'>$i</span>";
                else
                    echo '<span class="page"><a href="index.php?id_page='.$_GET['id_page'].'&blog1='.$i.'" class="nav-js">'.$i.'</a></span>
                     ';
            }
            echo '<!--<span class="next"><a href="index.php?id_page=7&blog1=1" class="nav-js">&gt;</a></span>
              <span class="last"><a href="blog/page/2.html" class="nav-js">&gt;&gt;</a></span>-->
              </div>
              </div>';
        }


        ?>


    </div>
</section>