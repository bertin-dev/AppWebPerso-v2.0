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
                 <div class="row">

                     <div class="col-lg-12" style="margin-bottom: 25px;">
                         <div class="col-lg-4 decallage-bas">
                             <div class="alert_notification web1 animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CREATION DE SITES WEB CODE A LA MAIN</u></h2>
                                     <p class="alert_p"><u>Technologies utilisés</u>: HTML/CSS, JS, Bootstrapp ou Laravel</p>
                                     <p class="alert_p"><u>Déploiement</u>: Navigateur Web et Mobile</p>
                                 </div>
                             </div>
                         </div>

                         <div class="col-lg-4 decallage-bas">
                             <div class="alert_notification web2 animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CREATION DE SITES WEB AVEC DES CMS </u></h2>
                                     <p class="alert_p"><u>Technologies utilisés</u>: Wordpress ou Magento</p>
                                     <p class="alert_p"><u>Déploiement</u>: Navigateur Web et Mobile</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-4 decallage-bas">
                             <div class="alert_notification web3 animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CONCEPTION D'APPLICATIONS WEB</u></h2>
                                     <p class="alert_p"><u>Technologies utilisés</u>: HTML/CSS, JS, Bootstrapp, PHP, MySQL, AJAX, JQuery ou AngularJS</p>
                                     <p class="alert_p"><u>Déploiement</u>: Navigateur Web et Mobile</p>
                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="col-lg-12" style="margin-bottom: 25px;">
                         <div class="col-lg-4 decallage-bas">

                             <div class="alert_notification windows1  animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CONCEPTION D'APPLICATIONS WINDOWS</u></h2>
                                     <p class="alert_p"><u>Technologies Utilisés</u>: C#, SQL SERVER, WPF, Windforms, UWP, DevExpress, Telerik reporting</p>
                                     <p class="alert_p"><u>Déploiement</u>: Minimum Windows 7</p>
                                 </div>
                             </div>

                         </div>

                         <div class="col-lg-4 decallage-bas">
                             <div class="alert_notification mobile1 animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CONCEPTION D'APPLICATIONS MOBILE</u></h2>
                                     <p class="alert_p"><u>Technologies Utilisés</u>: C#, XAMARIN, SYNCFUSION</p>
                                     <p class="alert_p"><u>Déploiement</u>: Android, Iphone, Windows Phone et Windows 10</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-4 decallage-bas">
                             <div class="alert_notification webservice1 animated fadeInLeft success1">
                                 <div class="left1" style="width:100px;">
                                     <div class="img1" style="background-image: url('img/bertin-mounok.png');"></div>
                                 </div>
                                 <div class="right1" style="margin-left: 110px;">
                                     <h2 class="alert_title"><u>CREATION DES WEB SERVICES</u></h2>
                                     <p class="alert_p"><u>Technologies Utilisés</u>: API REST </p><br>
                                     <p class="alert_p"><u>Déploiement</u>: Navigateur Web et Mobile</p>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </section>
     <?php
     }else{
         header('Location: index.php');
     }
?>

