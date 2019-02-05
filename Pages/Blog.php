<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 20/12/2018
 * Time: 22h40
 */
?>
<?php require_once('page_number.php'); ?>



<section id="blog" class="blog-section">
    <div id="blog-list">
    <?php
    if(isset($_GET['contenu']))
    {
    foreach (App::getDB()->query('SELECT id_sujet, titre, paragraphe, image, date_enreg FROM sujets WHERE id_sujet="'.intval($_GET['contenu']).'" ORDER BY id_sujet DESC') AS $blog_item):
    echo '
<article class="col-xs-12 col-md-10 col-lg-10">
                       <!--BLOC 1-->
            <div class="col-md-10 col-lg-5 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" class="" title="'.$blog_item->titre.'">'.
             $blog_item->titre
            .'</a>
        </h1>
            <p class="blog-article-1-p-1">'.$blog_item->paragraphe.'</p>
         <p class="blog-article-1-p-2">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" tabindex="-1" title="'.$blog_item->titre.'">Lire la suite</a>
        </p>
        </div>
                       <!--BLOC 2-->
            <div class="col-md-2 col-lg-2 papou">
        <div class="col-lg-12" style="margin-top: 35px;">
        <time>
                        <span class="date">
                            <span class="day">'.date('d', $blog_item->date_enreg).'</span>
                            <span class="month-year">
                                <span class="month">'.date('M', $blog_item->date_enreg).'</span><br>
                                <span class="year">'.date('Y', $blog_item->date_enreg).'</span>
                            </span>
                        </span>
            <span class="time1">'.date('H', $blog_item->date_enreg).':'.date('i', $blog_item->date_enreg).'</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a class="apropos" href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">À Propos</a>
        <a href="#" class="comments">Un Commentaire</a>

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
            <div class="col-lg-5 illu-article">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" tabindex="-1">
                <img class="img-responsive" src="'.$blog_item->image.'" alt="'.$blog_item->titre.'" title="'.$blog_item->titre.'">
            </a>
            <!----------------->
            
            <div id="commentaires" class="commentaires">

    <form action="" method="post" class="ajouter-commentaire">
        <img class="commentaire-avatar" src="http://www.gravatar.com/avatar/none?s=70" alt="Votre gravatar">
        <input type="text" id="trumbony_commentaire_commentaire_username" name="trumbony_commentaire_commentaire[username]" required="required" placeholder="Pseudo" class="commentaire-input commentaire-pseudo neutral_input">
        <input type="email" id="trumbony_commentaire_commentaire_email" name="trumbony_commentaire_commentaire[email]" required="required" placeholder="Courriel" class="commentaire-input commentaire-email neutral_input" value="">

        <textarea id="trumbony_commentaire_commentaire_contenu" name="trumbony_commentaire_commentaire[contenu]" required="required" placeholder="Commentaire" rows="3" class="neutral_input" style="overflow: hidden; min-height: 3em; height: 32px;"></textarea>
        <div class="autogrow-textarea-mirror" style="display: none; overflow-wrap: break-word; padding: 10px 3.39063px; width: 333.219px; font-family: Sansation, &quot;Trebuchet MS&quot;, Helvetica, Verdana, sans-serif, serif; font-size: 16px; line-height: normal;">.<br>.</div>
        <input type="hidden" id="trumbony_commentaire_commentaire__token" name="trumbony_commentaire_commentaire[_token]" value="1XvRtXijjtdJ4EuOg6r9XClhEB8X-a57I-uUCFJCzRU" class="neutral_input">

        <span class="commentaire-error-msg"></span>

        <input type="submit" value="Envoyer" class="neutral_input">
    </form>

    <div class="commentaires-liste">
        <article class="commentaire">
            <div class="commentaire-wrapper ">
                <header>
                    <img class="commentaire-avatar" src="http://www.gravatar.com/avatar/8359043bee5818d614f867c9fa042511?s=70" alt="Gravatar de Malnux Starck">
                    <span class="commentaire-auteur">Malnux Starck</span>
                    <time datetime="2016-07-10CEST04:09:09"> 10/07/2016 à 04h09</time>

                </header>

                <div class="commentaire-contenu">
                    Vous etes trop fort Mr Alex. je vous apprecie. j\'aimerai etre comme vous en tant que developpeur. :)
                </div>
                <a data-repondre="/commentaires/zeste-de-savoir-apres-une-annee-de-developpement/repondre/8207" href="JavaScript:void(null)" class="commentaire-repondre">
                    Répondre
                </a>
            </div>

            <div class="commentaire-reponses">
            </div>
        </article>


    </div>
</div>
            
            
            <!----------->
    </div>
</article>
        ';
    endforeach;
    }


    else
    {
        foreach (App::getDB()->query('SELECT id_sujet, titre, paragraphe, image, date_enreg FROM sujets  ORDER BY id_sujet DESC') AS $blog_item):
            echo '<article class="col-xs-12 col-md-10 col-lg-10">
          <div class="col-md-10 col-lg-6 blog-article-1"> 
        <h1 class="blog-article-1-h1">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" class="" title="'.$blog_item->titre.'">'.
                $blog_item->titre
                .'</a>
        </h1>
            <p class="blog-article-1-p-1">'.$blog_item->paragraphe.'</p>
         <p class="blog-article-1-p-2">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" tabindex="-1" title="'.$blog_item->titre.'">Lire la suite</a>
        </p>
        </div>
            <div class="col-md-2 col-lg-2 papou">
        <div class="col-lg-12" style="margin-top: 35px;">
        <time>
                        <span class="date">
                            <span class="day">'.date('d', $blog_item->date_enreg).'</span>
                            <span class="month-year">
                                <span class="month">'.date('M', $blog_item->date_enreg).'</span><br>
                                <span class="year">'.date('Y', $blog_item->date_enreg).'</span>
                            </span>
                        </span>
            <span class="time1">'.date('H', $blog_item->date_enreg).':'.date('i', $blog_item->date_enreg).'</span>
        </time>
        </div>
        <div class="col-lg-12">
<!--cette partie est a gerer-->
        <a class="apropos" href="#" class="nav-js category" data-destination="blog" data-title="Aller à la catégorie À Propos">À Propos</a>
        <a href="#" class="comments">Un Commentaire</a>

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
        <div class="col-lg-4 illu-article">
            <a href="index.php?id_page='.intval($_GET['id_page']).'&amp;contenu='.intval($blog_item->id_sujet).'" tabindex="-1">
                <img class="img-responsive" src="'.$blog_item->image.'" alt="'.$blog_item->titre.'" title="'.$blog_item->titre.'">
            </a>
    </div>
</article>
        ';
        endforeach;
    }


    ?>


    <aside id="sidebar" class="col-xs-12 col-md-2 col-lg-2">
        <span id="vertical-bar-border"></span>
        <div id="search" class="sidebar-bloc">
            <span class="title">Rechercher</span>
            <form action="#" method="get" class="" data-destination="recherche" role="search">
                <input type="text" name="q" class="neutral_input">
                <input type="submit" value=">" class="neutral_input">
            </form>
        </div>

        <div id="categories" class="sidebar-bloc not-search">
            <span class="title">Catégories</span>
            <ul>
                <?php
                foreach (App::getDB()->query('SELECT id_categorie, libelle FROM categorie ORDER BY id_categorie DESC') AS $cat):
                echo '<li>
                    <a href="../categorie/a-propos.html">'.
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
                <li>
                    <a href="../date/2014/11.html" class="nav-js category" data-destination="blog">
                        Novembre 2014
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2014/08.html" class="nav-js category" data-destination="blog">
                        Août 2014
                        <span class="counter">2</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2014/05.html" class="nav-js category" data-destination="blog">
                        Mai 2014
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2014/04.html" class="nav-js category" data-destination="blog">
                        Avril 2014
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2014/03.html" class="nav-js category" data-destination="blog">
                        Mars 2014
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2013/12.html" class="nav-js category" data-destination="blog">
                        Décembre 2013
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2013/11.html" class="nav-js category" data-destination="blog">
                        Novembre 2013
                        <span class="counter">1</span>
                    </a>
                </li>
                <li>
                    <a href="../date/2013/09.html" class="nav-js category" data-destination="blog">
                        Septembre 2013
                        <span class="counter">9</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    </div>
</section>