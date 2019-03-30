<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 20/12/2018
 * Time: 22h40
 */
?>
<?php
require_once('page_number.php');
require ('../App/jBBCode/Parser.php');
use \JBBCode\Parser;
use \JBBCode\DefaultCodeDefinitionSet;
$parser = new Parser();
$parser->addCodeDefinitionSet(new DefaultCodeDefinitionSet());
?>

<section id="blog" class="blog-section">
    <div id="blog-list">

        <div id="articles">

                <div class="loader_blog" style="display: none; position: relative; top: 300px; text-align: center">
                    <span class="loader loader-circle"></span>
                    Chargement......
                </div>

            <?php
            $nombreDeMessagesParPage = 5; // Essayez de changer ce nombre pour voir :o)
                $pages = 1; // On se met sur la page 1 (par défaut)
            // On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
            $premierMessageAafficher = ($pages - 1) * $nombreDeMessagesParPage;

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
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" title="' . $blog_item['titre'] . '">' .
                    utf8_encode($blog_item['titre'])
                    . '</a>
        </h1>
            <p class="blog-article-1-p-1">';
                $parser->parse(substr(utf8_encode($blog_item['paragraphe']), MIN_CHARACTER, MAX_CHARACTER));
                echo \App\Twitter\Twitter::autolink($parser->getAsHTML());
               echo '</p>';
         echo '<p class="blog-article-1-p-2">
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" class="link_articles" tabindex="-1" title="' . $blog_item['titre'] . '">Lire la suite</a>
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
        <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" data-title="Lire Les commentaires" class="comments link_articles">';
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
            <a data="articles=' . intval($blog_item['id_sujet']) . '" href="#" tabindex="-1" class="link_articles">
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
                $totalDesMessages = App::getDB()->rowCount('SELECT id_sujet FROM sujets ORDER BY id_sujet DESC');
            // On calcule le nombre de pages à créer
            $nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
            // Puis on fait une boucle pour écrire les liens vers chacune des pages
            echo '<div class="col-xs-12 col-sm-10 col-lg-12">
                    <div class="pagination1" id="resultat_pagination">';
            /* Boucle sur les pages */
            for ($i = 1 ; $i <= $nombreDePages ; $i++) {
                if ($i < ($pages-3) )
                    $i = $pages - 3;
                if ($i >= $pages + 3 AND $i <= $nombreDePages - 3)
                    echo "...";
                if ($i > ($pages+2) )
                    $i = $nombreDePages ;
                if ($i == $pages )
                    echo "<span id='current' title='page 1'>$i</span>";
                else
                    echo '<span class="page"><a data="pages='.$i.'&MessagesParPage='.$nombreDeMessagesParPage.'" href="#" class="pagination_link" data-title="page '.$i.'">'.$i.'</a></span>';
            }
            echo '
              <span class="last"><a class="pagination_link" data="pages=';
        if($i==1) echo $i; else echo ($i-1);
            echo '&MessagesParPage='.$nombreDeMessagesParPage.'" href="#" class="pagination_link" title="Suivant">&gt;&gt;</a></span>
              </div>
              </div>';
        //}


        ?>


    </div>
</section>