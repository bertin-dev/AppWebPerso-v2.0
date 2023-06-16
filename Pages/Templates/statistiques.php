<?php
/**
 * Created by PhpStorm.
 * User: Supers-Pipo
 * Date: 09/04/2019
 * Time: 21h17
 */
?>
<section class="modal fade" id="infos">
    <div class="container">
        <div class="row">

    <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
        <h3>TABLEAU DE BORD</h3>
    </div>
    <div class="modal-body col-lg-6">

        <h1 style="text-align: center"><u><strong>Statistiques des Langages</strong></u></h1>
        <canvas id="myChart" style="background-color: white;"></canvas>

            <h1 style="text-align: center"><u><strong>Technologies utilisées</strong></u></h1>
            <div class="panel panel-default" style="background-color: initial;">
                <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                    programmation web
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="60%">Langages</th>
                                <th width="40%">Lignes de code</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tbody id="tabdynamique">
                               <tr>
                               <td width="70%" title="Langage Back-end">PHP 7</td>
                               <td width="30%" title="Nombre de lignes de code ecrites">592 750</td>
                              </tr>

                              <tr>
                                  <td width="70%" title="Langage Front-end">JavaScript</td>
                                  <td width="30%" title="Nombre de lignes de code ecrites">4 581</td>
                              </tr>

                              <tr>
                                  <td width="70%" title="Langage Front-end">XML</td>
                                  <td width="30%" title="Nombre de lignes de code ecrites">5 056</td>
                              </tr>
							  
							   <tr>
                                <td width="70%" title="Langage Front-end">JSON</td>
                                <td width="30%" title="Nombre de lignes de code ecrites">2 323</td>
                            </tr>

                            <tr>
                                <td width="70%" title="Langage Front-end">CSS 3</td>
                                <td width="30%" title="Nombre de lignes de code ecrites">15 268</td>
                            </tr>

                            </tbody>
                            <!---------------------------------------------------------------------------------------------------------------------------------->
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>

        <div class="panel panel-default" style="background-color: initial;">
            <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                Outils Open Sources utilisés
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="60%">Intitulé</th>
                            <th width="40%">Langage Associé</th>
                        </tr>
                        </thead>
                        <tbody>


                        <tbody id="tabdynamique">
                        <tr>
                            <td width="70%" title="Library pour la gestion des règles CSS">Bootstap de Twitter</td>
                            <td width="30%" title="Langage Front-end">Js/CSS 3</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion facile du javascript">JQuery</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Concepte de gestion du rafraichissement des pages">AJAX</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion graphique">CANVAS</td>
                            <td width="30%" title="Langage Front-end">HTML5/JS</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion des notifications">Mustache</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion du temps">Timego</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion des animations">WOW</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion de l'encode en bbcode pour la BD">WYSIBB</td>
                            <td width="30%" title="Langage Front-end">JavaScript</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Library pour la gestion des dépendances en PHP">COMPOSER</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion de l'authentification Twitter">API TWITTER</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion de l'authentification Linkedin">API LINKEDIN (OAUTH 2)</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion de l'authentification Facebook">API FACEBOOK (OAUTH 2)</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la geolocalisation">API GEOIP2</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion du bbcode">LIBRARY JBBCODE</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la gestion d'envoi des Email">LIBRARY PHPMAILER</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la génération des Dévis">LIBRARY HTML2PDF</td>
                            <td width="30%" title="Langage Backend-end">HTML/CSS/PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="API pour la localisation des visiteurs">API GOOGLE MAP</td>
                            <td width="30%" title="Langage Backend-end">PHP</td>
                        </tr>

                        <tr>
                            <td width="70%" title="Versioning">GIT</td>
                            <td width="30%" title="Commite">Versioning</td>
                        </tr>

                        <tr>
                            <td width="70%" title="gestion des requêtes distante">POSTMAN</td>
                            <td width="30%" title="">Test d'APIs</td>
                        </tr>
						
						<tr>
                            <td width="70%" title="Système de gestion des bases de données">SGBD</td>
                            <td width="30%" title="requêtes SQL">MySQL</td>
                        </tr>

                        </tbody>
                        <!---------------------------------------------------------------------------------------------------------------------------------->
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>


    </div>


            <div class="modal-body col-lg-6">

                <h1 style="text-align: center"><u><strong>Trajet du Projet</strong></u></h1>
                <canvas id="lineChart" style="background-color: white;"></canvas>


				
				     <h1 style="text-align: center"><u><strong>Modules de l'Application Web</strong></u></h1>
            <div class="panel panel-default" style="background-color: initial;">
                <div class="panel-heading" style="background-color: #337ab7; color: white; font-weight: bold; font-variant: small-caps">
                    Fonctionnalités disponibles
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="60%">Libellé</th>
                                <th width="40%">Outils</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tbody id="tabdynamique">
                               <tr>
                               <td width="70%" title="Liens URL">Système de Liens URL dynamiques</td>
                               <td width="30%" title="PHP / UrlRewriting">PHP / UrlRewriting</td>
                              </tr>

                              <tr>
                                  <td width="70%" title="Animation au passage de la souris">Animation</td>
                                  <td width="30%" title="JQuery">JQuery</td>
                              </tr>

                              <tr>
                                  <td width="70%" title="Notification après certains événements">Système de Notifications</td>
                                  <td width="30%" title="Library Mustache">Library Mustache</td>
                              </tr>

                            <tr>
                                <td width="70%" title="Notification Après ajout d'un Article">Notification Après ajout d'un Article</td>
                                <td width="30%" title="PHP">PHP</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Newsletter dynamique">Newsletter dynamique sans rafraichissement</td>
                                <td width="30%" title="AJAX/PHP/MySQL">AJAX/PHP/MySQL</td>
                            </tr>

							<tr>
                                <td width="70%" title="champs de recherches instantané">Recherches instantané</td>
                                <td width="30%" title="AJAX/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
						    <tr>
                                <td width="70%" title="Formulaire dynamique sans rafraîchissement">Formulaire dynamique sans rafraîchissement</td>
                                <td width="30%" title="AJAX/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
							  <tr>
                                <td width="70%" title="Chargement des réalisations au fur à mesure du scroll">Chargement au fur à mesure du scroll</td>
                                <td width="30%" title="AJAX/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
							 <tr>
                                <td width="70%" title="Google Map">Google Map</td>
                                <td width="30%" title="SDK JavaScript">SDK JavaScript</td>
                            </tr>
							
							 <tr>
                                <td width="70%" title="Single Page Application">Utilisation du SPA Dans le Blog</td>
                                <td width="30%" title="AJAX/PHP/JQUERY/MySQL">AJAX/PHP/JQUERY/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Commentaires et Réactions instantanées">Commentaires et Réactions instantanées</td>
                                <td width="30%" title="AJAX/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Système de Loading">Système de Loading</td>
                                <td width="30%" title="AJAX/JQuery/CSS">AJAX/JQuery/CSS</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Système d'archivage des articles par catégorie">Système d'archivage des articles par catégorie</td>
                                <td width="30%" title="AJAX/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Détection automatique des liens internes">Détection automatique des liens internes</td>
                                <td width="30%" title="JavaScript">JavaScript</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Espace Membre">Espace Membre en fonction du statut</td>
                                <td width="30%" title="HTML/CSS/JS/PHP/MySQL">HTML/CSS/JS/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Tableau Dynamique">Tableau Dynamique</td>
                                <td width="30%" title="Ajax/JQuery/PHP/MySQL">AJAX/JQuery/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Calcul instantané des modules choisis">Calcul instantané des modules choisis</td>
                                <td width="30%" title="Ajax/JQuery/PHP/MySQL">Ajax/JQuery/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Génération des Devis">Génération des Devis</td>
                                <td width="30%" title="HTML2PDF/CSS/PHP">HTML2PDF/CSS/PHP</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Envoi d'emails simple">Envoi d'emails simple</td>
                                <td width="30%" title="PHPMAILER">PHPMAILER</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Envoi d'emails avec PJ(Devis)">Envoi d'emails avec PJ(Devis)</td>
                                <td width="30%" title="HTML2PDF/PHPMAILER">HTML2PDF/PHPMAILER</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Envoi d'emails en Masse">Envoi d'emails en Masse</td>
                                <td width="30%" title="PHPMAILER">PHPMAILER</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Enregistrement avec Authentification par Email">Enregistrement avec Authentification par Email</td>
                                <td width="30%" title="PHPMAILER/PHP">PHPMAILER/PHP</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Couche de Securité .htaccess et .htpasswd">Couche de Securité .htaccess et .htpasswd</td>
                                <td width="30%" title="PHP">PHP</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Compteur de visiteurs Instantané">Compteur de visiteurs Instantané</td>
                                <td width="30%" title="PHP/MySQL">PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Geolocalisation des visiteurs">Geolocalisation des visiteurs</td>
                                <td width="30%" title="GEOLITE2/PHP/MySQL">GEOLITE2/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Geolocalisation sur une carte">Geolocalisation sur une carte</td>
                                <td width="30%" title="GEOLITE2/PHP/MySQL">GEOLITE2/PHP/MySQL</td>
                            </tr>
							
							<tr>
                                <td width="70%" title="Intégration fichier Log">Intégration fichier Log</td>
                                <td width="30%" title="PHP/MySQL">PHP/MySQL</td>
                            </tr>


                            </tbody>
                            <!---------------------------------------------------------------------------------------------------------------------------------->
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>

            </div>

    <div class="modal-footer col-lg-12"> <a class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Fermer</a> </div>

        </div>
    </div>
</section>
