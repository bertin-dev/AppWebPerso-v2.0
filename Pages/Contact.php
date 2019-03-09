<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 03/02/2018
 * Time: 10h05
 */
require '../Core/Controller/Contact.class.php';
require '../Core/Controller/Controller.php';

use Core\Controller\Controller;
use Core\Controller\Contact;

// Active tous les warning. Utile en phase de développement. En phase de production, remplacer E_ALL par 0
error_reporting(E_ALL);

// Définit l'Id de la page d'accueil (1 dans cet exemple)
$id_page_accueil = 1;
// Récupère l'id de la page courante passée par l'URL. Si non défini, on considère que la page est la page d'accueil
if (isset($_GET['id_page'])) {
    $_ENV['id_page'] = intval($_GET['id_page']);
} else {
    $_ENV['id_page'] = $id_page_accueil;
}
$info_DB = new Controller();
$info_DB->extract_DB();

?>


<section id="" class="">
    <div class="container">
        <div class="row">
            <!--FORMULAIRE D'ENVOI DE SUGGESTIONS-->
            <article class="col-lg-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                <p style="font-size: 13px; color: #c9c9c9">Afin d'obtenir un devis précis merci de détailler au maximum
                    le fonctionnement de votre projet.</p>

                <form id="contact_visitor" method="post"  accept-charset="UTF-8" onsubmit="return false;">
                    <div class="form-group">
                        <!--<input name="_csrf_token" value="HkglWjsyRSUpMkorVjcSLHwBCCR2JgAApxToYquCzh0N1vZaKwdwDQ==" type="hidden">-->
                        <?php
                        $enregistrement = new Contact($_POST);
                        echo '<div class="col-lg-6">' . $enregistrement->input('text', 'identite_visitor', 'Nom&Prenom', '', 'identite_visitor') . '<small id="output_identite_visitor"></small></div>';
                        echo '<div class="col-lg-6">' . $enregistrement->input('email', 'email_visitor', 'Email@domaine.com', '', 'email_visitor') . '<small id="output_email_visitor"></small></div>';
                        echo '<div class="col-lg-12">' . $enregistrement->textarea('message_visitor', 'Entrez votre message', 'message_visitor', '', 'form-control') .'<small id="output_message_visitor"></small></div>';
                        echo'<div class="col-lg-8"></div>';
                        echo '<div class="col-lg-1"><div id="load_data_visitor"></div></div>';
                        echo '<div class="col-lg-3">'.$enregistrement->submit('Envoyer', '', 'enreg_visitor') . '</div>';
                        ?>
                    </div>
                </form>
            </article>
            <!--CONTACT-->
            <article class="col-lg-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">

                <div class="col-xs-12 col-lg-12" style="color: #c9c9c9">
                    <h4 style="font-variant: small-caps;">Réseaux sociaux</h4>
                    <a href="https://github.com/bertin-dev/AppWebPerso-v2.0">
                        <img src="../Public/img/socials/Github_Bertin-Mounok.svg" alt="Github Bertin-Mounok"
                             title="Github bertin.dev" class="img-responsive"
                             style="float: left;" width="32"/>
                    </a>
                    <a href="https://www.linkedin.com/in/bertin-mounok-415754120/">
                        <img src="../Public/img/socials/LinkedIn-Bertin-Mounok.svg" alt="LinkedIn Bertin-Mounok"
                             title="LinkedIn bertin.dev" class="img-responsive"
                             style="float: left; margin: 0 0 0 5px;" width="32"/>
                    </a>
                    <a href="https://www.facebook.com/Ndembapipo">
                        <img src="../Public/img/socials/Facebook-Bertin-Mounok.svg" alt="Facebook Bertin-Mounok"
                             title="Facebook bertin.dev" class="img-responsive"
                             style="float: left; margin: 0 0 0 5px;" width="32"/>
                    </a>
                    <a href="https://plus.google.com/u/0/?tab=wX">
                        <img src="../Public/img/socials/Google+-Bertin-Mounok.svg" alt="Google+ Bertin-Mounok"
                             title="Google+ bertin.dev" class="img-responsive"
                             width="32" style="float: left; margin: 0 0 0 5px;"/>
                    </a>
                    <a href="http://www.viadeo.com/p/0021658i7bpwsd5p">
                        <img src="../Public/img/socials/Viadeo-Bertin-Mounok.svg" alt="Viadeo Bertin-Mounok"
                             title="Viadeo bertin.dev" class="img-responsive"
                             style="float: left; margin: 0 0 0 5px;" width="32"/>
                    </a>
                </div>

                <div class="col-xs-12 col-lg-12">


                    <address style="color: #c9c9c9">
                        <h4>CAMEROUN</h4>
                        <span title="lieu de localisation"><img style="margin: 0 8px 0 0;" class="img-responsive"
                                                                width="20" align="left" title="Lieu de Localisation"
                                                                src="../Public/img/socials/home.png"> Essos, Yaoundé</span><br>
                        <span title="Adresse Email"><img style="margin: 0 8px 0 0;" class="img-responsive" width="20"
                                                         align="left" title="Adresse Email"
                                                         src="../Public/img/socials/email.png"> bertin.dev@outlook.fr / bertmoun@yahoo.fr</span><br>
                        <span title="Numéro Téléphone"><img style="margin: 0 8px 0 0;" class="img-responsive" width="20"
                                                            align="left" title="Numéro de Téléphone"
                                                            src="../Public/img/socials/mobile.png"> (+237) 694 048 925 / 656 619 147</span><br>
                        <span title="Code Postal"><img style="margin: 0 8px 0 0;" class="img-responsive" width="20"
                                                       align="left" title="Code Postal"
                                                       src="../Public/img/socials/Sticky_1-128.png">BP: 1492</span><br>
                    </address>


                </div>


            </article>
            <!--PLAN DE LOCALISATION-->
            <article class="col-lg-12 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                <h4 align="center" style="font-variant: small-caps;">Plan de Localisation</h4>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.6440133674932!2d11.557070014759473!3d3.8862519971732494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x108bc5cc60617969%3A0x36698089de830e9f!2sNkolmesseng+-safari!5e0!3m2!1sfr!2scm!4v1551903683175"
                        width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </article>
        </div>
    </div>
</section>
