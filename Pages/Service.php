<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 02/02/2019
 * Time: 15h08
 */

 require_once('page_number.php'); ?>

<?php
     if(isset($_SESSION['ID_USER']) || isset($_COOKIE['ID_USER'])){
         ?>
         <section id="" class="">
             <div class="container">
                 <div class="row" style="margin-bottom: 100px; margin-top: 50px;">

                     <?php
                     $connexion = App::getDB();
                     $i = 1;
                     foreach($connexion->query('SELECT id_services, libelle, description FROM services ORDER BY id_services ') as $con):
                         echo '<div class="col-lg-4 decallage-bas">
                             <div class="text-center">
                                 <a id="projet'.$i.'" data="'.$con->id_services.'" role="button" href="#" class="btn btn-primary WOW bounceInDown animated" title="'.utf8_decode($con->description).'"><i class="fa fa-5x ';
                     if(strchr($con->libelle, 'web')) echo 'fa-globe';
                      else if(strchr($con->libelle, 'mobile')) echo 'fa-mobile';
                      else echo 'fa-laptop';
                             echo '"></i><br>'.strtoupper($con->libelle).'</a>
                             </div>
                         </div>        
                       ';
                             $i++;
                     endforeach;
                     ?>
                 </div>
             </div>
         </section>
     <?php
     }else{
         header('Location: index.php');
     }
?>

