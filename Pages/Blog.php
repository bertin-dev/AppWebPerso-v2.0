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
    <?php
    if(isset($_GET['comments']))
    {
        $_SESSION['id_sujet'] = intval($_GET['comments']);

            if( (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) || (isset($_COOKIE['ID']) && !empty($_COOKIE['ID'])) )
            {
                if(isset($_SESSION['ID'])) $compte = intval($_SESSION['ID']);
                else if(isset($_COOKIE['ID'])) $compte = intval($_COOKIE['ID']);
                else $compte = 0;
                $connexion = App::getDB();
                $connexion->update('UPDATE sujets SET ref_id_compte_visiteur = ?, date_consult_visiteur = ? WHERE id_sujet = ? ',
                    [$compte, time(), intval($_GET['comments'])]);
            }


    foreach (App::getDB()->query('SELECT id_sujet, titre, paragraphe, image, sujets.date_enreg, libelle FROM sujets
                                            INNER JOIN categorie
                                            ON categorie.id_categorie=sujets.ref_id_categorie
                                            WHERE id_sujet="'.intval($_GET['comments']).'" ORDER BY id_sujet DESC') AS $blog_item):

    echo '
<article class="col-xs-12 col-sm-10 col-lg-10">
                       <!--BLOC 1-->
            <div class="col-xs-12 col-sm-7 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;comments='.intval($blog_item->id_sujet).'" class="" title="'.$blog_item->titre.'">'.
        $blog_item->titre
            .'</a>
        </h1>
            <p class="blog-article-1-p-1">'.$blog_item->paragraphe.'</p>
         <p class="blog-article-1-p-2">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;comments='.intval($blog_item->id_sujet).'" tabindex="-1" title="'.$blog_item->titre.'">Lire la suite</a>
        </p>
        </div>
                       <!--BLOC 2-->
            <div class="col-xs-12 col-sm-2 col-lg-2 papou">
        <div class="col-lg-12">
        <time>
                        <span class="date">
                            <span class="day">'.date('d', $blog_item->date_enreg).'</span>
                            <span class="month-year">
                                <span class="month">'.date('M', $blog_item->date_enreg).'</span><br>
                                <span class="year">'.date('Y', $blog_item->date_enreg).'</span>
                            </span>
                        </span>
            <span class="time">'.date('H', $blog_item->date_enreg).':'.date('i', $blog_item->date_enreg).'</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">'.$blog_item->libelle.'</a>
   

        <a href="#" class="comments">';
         $resultComment =  App::getDB()->rowCount('SELECT commentaires, data_ajout_commentaires, prenom FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$_SESSION['id_sujet'].'"');
        if($resultComment==1)
            echo ' Un Commentaire';
        else
            echo $resultComment .' Commentaires';
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
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;comments='.intval($blog_item->id_sujet).'" tabindex="-1">
                <img class="img-responsive" src="'.$blog_item->image.'" alt="'.$blog_item->titre.'" title="'.$blog_item->titre.'">
            </a>
            <!----------------->
         
            <div id="commentaires" class="commentaires">';
        if(isset($_SESSION['ID'])) $compte = intval($_SESSION['ID']);
        else if(isset($_COOKIE['ID'])) $compte = intval($_COOKIE['ID']);
        else $compte = 0;
        $connexion = App::getDB();
        $info = $connexion->prepare_request('SELECT prenom, email FROM compte WHERE id_compte=:id', ['id'=>$compte]);

    echo '<form id="commentaire_user" action="" method="post" class="ajouter-commentaire" onsubmit="return false;">
        <img class="commentaire-avatar" src="../Public/img/blog_img/avatar.png" alt="Votre gravatar" width="25">
        <input type="text" id="username" name="username" required="required" placeholder="'.$info['prenom'].'" class="commentaire-input commentaire-pseudo neutral_input" disabled>
        <input type="email" id="emailuser" name="emailuser" required="required" placeholder="'.$info['email'].'" class="commentaire-input commentaire-email neutral_input" value="" disabled>

        <textarea id="contenuCommentaireUser" name="contenuCommentaireUser" required="required" placeholder="Commentaire" rows="3" class="neutral_input" style="overflow: hidden; min-height: 3em; height: 32px;"></textarea>
        <div class="autogrow-textarea-mirror" style="display: none; overflow-wrap: break-word; padding: 10px 3.39063px; width: 333.219px; font-family: Sansation, &quot;Trebuchet MS&quot;, Helvetica, Verdana, sans-serif, serif; font-size: 16px; line-height: normal;">.<br>.</div>
        <input type="hidden" id="tokenuser" name="tokenuser" value="$tokenuser" class="neutral_input">

        <span class="commentaire-error-msg"></span>
        <input id="enreg_commentaires" type="submit" value="Envoyer" class="neutral_input" style="margin: 10px 30px 10px 5px;"> 
        
    </form>
    <div class="commentaires-liste"></div>
    
          </div>
</article>
        ';
    endforeach;
    }

    else if(isset($_GET['cat']) && intval($_GET['cat']) > 0)
    {
        $nombreDeMessagesParPage = 2; // Essayez de changer ce nombre pour voir :o)
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



        $blog = App::getDB()->compteur_start_end('SELECT id_sujet, titre, paragraphe, image, sujets.date_enreg, id_categorie, libelle FROM sujets
                                                  INNER JOIN categorie 
                                                  ON categorie.id_categorie=sujets.ref_id_categorie
                                                  WHERE id_categorie=:id_cat
                                                  ORDER BY id_sujet DESC LIMIT :offset , :limit');
        $blog->bindParam(':id_cat', intval($_GET['cat']) , PDO::PARAM_INT);
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
                            <span class="day">' . date('d', $blog_item['date_enreg']) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', $blog_item['date_enreg']) . '</span><br>
                                <span class="year">' . date('Y', $blog_item['date_enreg']) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', $blog_item['date_enreg']) . ':' . date('i', $blog_item['date_enreg']) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">'.$blog_item['libelle'] .'</a>
        <a href="#" class="comments">';
                $resultat = App::getDB()->rowCount('SELECT * FROM comments 
                                                         INNER JOIN sujets
                                                         ON comments.ref_id_sujet=sujets.id_sujet
                                                         INNER JOIN categorie
                                                         ON categorie.id_categorie=sujets.ref_id_categorie
                                                        WHERE sujets.id_sujet = "'.$blog_item['id_sujet'].'" AND categorie.id_categorie="'.$_GET['cat'].'"');
                if($resultat==1)
                    echo ' Un Commentaire';
                else
            echo $resultat .' Commentaires';
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
    }

    else
    {
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
                            <span class="day">' . date('d', $blog_item['date_enreg']) . '</span>
                            <span class="month-year">
                                <span class="month">' . date('M', $blog_item['date_enreg']) . '</span><br>
                                <span class="year">' . date('Y', $blog_item['date_enreg']) . '</span>
                            </span>
                        </span>
            <span class="time">' . date('H', $blog_item['date_enreg']) . ':' . date('i', $blog_item['date_enreg']) . '</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">'.$blog_item['libelle'].'</a>
        <a href="#" class="comments">';
               $totalComments = App::getDB()->rowCount('SELECT * FROM comments
                                                     INNER JOIN compte
                                                     ON comments.ref_id_compte=compte.id_compte
                                                     INNER JOIN sujets
                                                     ON comments.ref_id_sujet=sujets.id_sujet
                                                     WHERE sujets.id_sujet="'.$blog_item['id_sujet'].'"');
            if($totalComments==1)
                    echo ' Un Commentaire';
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
    }
    ?>
        <!--BLOC DE ASIDE LATERALE -->
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
                    <a href="index.php?id_page='.$_GET['id_page'].'&amp;cat='. $cat->id_categorie. '">'.
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
                /*var_dump(date("d/m/Y", mktime(0,0, 0, $mois, 1, $annee)));
                var_dump(date("d/m/Y", mktime(0,0, 0, $mois+1, 0, $annee)));
                $dates = new DateTime();
                $debut = $dates->format("01/m/Y");
                $fin = $dates->format("t/m/Y");
                var_dump($debut);
                var_dump($fin);
                $dates1 = DateTime::createFromFormat('d/m/Y', $debut);
                $dates2 = DateTime::createFromFormat('d/m/Y', $fin);
                var_dump($dates1->format('U'));
                var_dump($dates2->format('U'));
                A% JOUR EN LETTRE
                d% JOUR EN CHIFFRE
                */
                $dates = new DateTime();
                $debut = $dates->format("01/m/Y");
                $fin = $dates->format("t/m/Y");
                $datesD = DateTime::createFromFormat('d/m/Y', $debut);
                $datesF = DateTime::createFromFormat('d/m/Y', $fin);
                setlocale(LC_TIME, "fr_FR", "French");
               /* foreach(App::getDB()->query('SELECT id_sujet, date_enreg FROM sujets WHERE date_enreg BETWEEN "'.$datesD->format('U').'" AND "'.$datesF->format('U').'" ') AS $archive):
                endforeach;*/

               $archives = App::getDB()->rowCount('SELECT date_enreg FROM sujets WHERE date_enreg 
                                                                                    BETWEEN "'.$datesD->format('U').'" AND "'.$datesF->format('U').'"');
               if($archives > 0)
               {
                  $archiv = App::getDB()->prepare_request('SELECT  date_enreg FROM sujets WHERE date_enreg 
                                                                                    BETWEEN "'.$datesD->format('U').'" AND "'.$datesF->format('U').'"', array());
                  $temps = utf8_encode(ucfirst(strftime("%B %G", strtotime(date("Y-m",$archiv['date_enreg'])))));
                  // App::getDB()->insert('INSERT INTO archive(libelle_archive, date_enreg_archive) VALUES (?,?)', [$temps, time()]);
               }

               // $archivTotal = App::getDB()->prepare_request('SELECT DISTINCT libelle_archive FROM archive', array());

                    echo '<li> 
                    <a href="#" class="nav-js category">' . $temps . '<span class="counter">' . $archives . '</span>
                    </a>
                </li>';

                ?>

                </li>
            </ul>
        </div>

    </aside>

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