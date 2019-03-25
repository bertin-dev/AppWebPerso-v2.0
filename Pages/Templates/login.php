<style>

    .login-img3-body{
        background:  no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .centre
    {
        text-align: center;
    }

    .check_field
    {
        color: red;
        z-index: 999999;
        font-weight: bold;
        background: white;
    }
</style>

    <div class="modal fade" id="login_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="login-img3-body modal-content">
                <div class="col-lg-3"></div>
                <!----------------------------------------------------------ESPACE AUTHENTIFICATION------------------------------------------------------------->
                <div class="modal-body col-lg-6">


                    <div class="ombrage" style="background: #0f6296; border-radius: 20%; margin: 15px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <center><strong style="font-size:1.2em;">GENEREZ VOTRE DEVIS</strong><br></center>
                    </div>

                    <form id="singIn" class="" method="post" onsubmit="return false;" accept-charset="UTF-8">

                        <fieldset id="SingInForm">
                            <div class="inputBox">
                                <input type="email" name="emailSingIn" required="" id="emailSingIn"><small id="output_emailSingIn"></small>
                                <label for="">Email*</label>
                            </div>
                            <div class="inputBox">
                                <input type="password" name="passwordSingIn" required="" id="passwordSingIn"><small id="output_passwordSingIn"></small>
                                <label for="">Password*</label>
                            </div>

                            <label class="col-lg-12">
                                <span class="col-lg-6"><input type="checkbox" name="t_and_c" id="t_and_c" value="1"> Restez-Connecté ! </span>&nbsp &nbsp &nbsp &nbsp
                                <span class="col-lg-5"> <a id="forget" style="color: #fff;font-weight: bold" href="#" title="Cliquez ici si vous avez oublié votre password">   Password Oublié ? </a></span>
                            </label>

                            <input id="enreg_connexion" type="submit" class="submit action-button" value="CONNEXION" title="CONNECTEZ-VOUS">
                            <input style="font-size: 12px" id="inscription" type="button" class="action-button" value="INSCRIPTION" title="INSCRIVEZ-VOUS ICI !">
                            <center><div id="load_data_SingIn"></div></center>
                        </fieldset>
						 <?php
						 use \App\Facebook\FacebookConnect;
                         if(!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){
                             echo 'VOUS ÊTES HORS LIGNE !';
                         }else{
                             $appId = '361124424614569';
                             $appSecret = '04a4d5b4a49881e45df0bd215ae30d24';
                             $connect = new FacebookConnect($appId, $appSecret);
                             $user = $connect->connect('https://www.bertin-mounok.com/Public/');
                             if (is_string($user)) {
                                 echo '<a href="' . $user . '" class="waves-effect waves-light btn-customizable white-text" style="background-color: #3b5998; font-weight: bold;">
                                  <i class="fa fa-2x fa-facebook right" title="Connectez-vous"></i> Se Connecter Via Facebook</a>';
                             } else {
                                 //REQUETE SELECT
                                 //$facebook_id = $user->getId();
                                 //SELECT * FROM users WHERE facebook_id = $facebook_id;
                                 //INSERT INTO users SET facebook_id = $facebook_id, firstname=$profil->getFirstName();
                                 echo 'BONJOUR';
                             }


                             //SE CONNECTER VIA LINKEDIN

                             define('CLIENT_ID', '860uswnwa074d6');
                             define('CLIENT_SECRET', 'kDxYk5iCBtnc9UYK');
                             define('REDIRECTION_URI', 'https://www.bertin-mounok.com/Public/');
                             try {
                                 define('CSRF_TOKEN', random_int(1111111, 9999999));
                             } catch (Exception $e) {
                                 echo $e->getMessage();
                             }
                             define('SCOPES', 'r_basicprofile%20r_emailaddress');
                             $linkedin = new \App\LinkedIn\LinkedInConnect(CLIENT_ID, CLIENT_SECRET, REDIRECTION_URI, CSRF_TOKEN, SCOPES);
                             $user = $linkedin->getCallBack();
                             // $_SESSION['user'] = $user;
                             //header('location: index.php?id=page=11');
                             ?>
                             <a class="waves-effect waves-light btn-customizable white-text"
                                style="background-color: #007bb6; font-weight: bold"
                                href="<?= 'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=' . CLIENT_ID . '&redirect_uri=' . REDIRECTION_URI . '&state=' . CSRF_TOKEN . '&scope=' . SCOPES . '' ?>">
                                 <i class="fa fa-2x fa-linkedin right" title="Connectez-vous"></i> Se Connecter Via
                                 LinkedIn</a>


                             <!--------SE CONNECTER AVEC TWITTER----->
                             <!--AJOUT D UN TWEET-->
                             <?php
                             define('CONSUMER_KEY', 'AxSTgl8sck76P9HFW2ncgT1jF');
                             define('CONSUMER_SECRET', '9xRqAG3EZQLbfbIgQdbbOgykGBw026YQuFOj2GnQ87L4yLPSOX');
                             // ACCESS_TOKEN et  ACCESS_SECRET me permet d'interagir avec celui qui crée le compte
                             //define('ACCESS_TOKEN', '816079663856517120-0SOQ2Z6dRSwRPT5APuQS0fx0q1Yakbk');
                             // define('ACCESS_SECRET', 'yti17JqsXOndZtfPppTzL8sIQFw4yu31sactVnn8cHmM9');
                             //require '../vendor/autoload.php';

                             $twitter = new \App\Twitter\Twitter_Connect_Post(CONSUMER_KEY, CONSUMER_SECRET);

                             if (isset($_SESSION['authentified'])) {
                                 $oauth = new \Abraham\TwitterOAuth\TwitterOAuth(
                                     CONSUMER_KEY,
                                     CONSUMER_SECRET,
                                     $_SESSION['oauth_token'],
                                     $_SESSION['oauth_token_secret']
                                 );
                                 $account = $oauth->get('account/verify_credentials', ['include_email' => true]);

                             } else if (isset($_GET['oauth_token'])) {
                                 $token = $twitter->getAccessToken($_GET['oauth_token'], $_GET['oauth_verifier']);
                                 // var_dump($twitter->verifyCredentials($token['oauth_token'], $token['oauth_token_secret']));

                             } else {
                                 ?>
                                 <a class="waves-effect waves-light btn-customizable white-text"
                                    style="background-color: #00aced; font-weight: bold"
                                    href="<?= $twitter->getAuthentification('https://www.bertin-mounok.com/Public/') ?>">
                                     <i class="fa fa-2x fa-twitter right" title="Connectez-vous"></i> Se Connectez via
                                     Twitter</a>
                                 <?php
                             }
                         }
                        ?>


                    </form>


                    <form id="getPassword" class="" method="post" onsubmit="return false;" accept-charset="UTF-8">
                        <fieldset id="SingInForget" class="collapse">
                            <h2 class="fs-title centre" style="margin-bottom: 50px;">RECUPERATION DU MOT DE PASSE</h2>
                            <div class="inputBox">
                                <input type="email" name="getEmail" required="" id="getEmail"><em><small id="output_getEmail"></small></em>
                                <label for="">Entrez Votre Email*</label>
                            </div>
                            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
                            <input id="sendEmailForget" type="submit" class="next action-button" title="Cliquez Suivant" value="ENVOYER">
                            <center><div id="load_data_getEmail"></div></center>
                        </fieldset>
                    </form>




                    <form id="singUp" class="collapse" method="post" onsubmit="return false;" accept-charset="UTF-8">
                        <ul id="progressbar">
                            <li class="active">IDENTIFIANT PERSONNELLE</li>
                            <li>IDENTIFIANT PUBLIC</li>
                            <center><span id="statut" class="check_field"> Veuillez-remplir tous les champs</span></center>
                        </ul>

                        <fieldset>
                            <h2 class="fs-title centre">IDENTIFIANT PERSONNELLE</h2>
                            <h3 class="fs-subtitle centre"><u>Etape 1</u></h3>
                            <div class="inputBox">
                                <input type="text" name="nomSingUp" required="" id="nomSingUp"><em><small id="output_nomSingUp"></small></em>
                                <label for="">Nom*</label>
                            </div>
                            <div class="inputBox">
                                <input type="text" name="prenomSingUp" required="" id="prenomSingUp"><em><small id="output_prenomSingUp"></small></em>
                                <label for="">Prenom*</label>
                            </div>
                            <input type="button" class="next action-button" title="Cliquez Suivant" name="next" value="SUIVANT">
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title centre">IDENTIFIANT PUBLIC</h2>
                            <h3 class="fs-subtitle centre"><u>Etape 2 - Fin</u></h3>
                            <div class="inputBox">
                                <input type="email" name="emailSingUp" required="" id="emailSingUp"><em><small id="output_emailSingUp"></small></em>
                                <label for="">Email*</label>
                            </div>

                            <div class="inputBox">
                                <input type="password" name="passwordSingUp" required="" id="passwordSingUp"><em><small id="output_passwordSingUp"></small></em>
                                <label for="">Password*</label>
                            </div>

                            <div class="inputBox">
                                <input type="password" name="passwordConfirmSingUp" required="" id="passwordConfirmSingUp"><em><small id="output_passwordConfirmSingUp"></small></em>
                                <label for="">Password Confirm*</label>
                            </div>
                            <input type="button" class="previous action-button" value="PRECEDENT" title="precedent" name="previous">
                            <input id="enreg" type="submit" class="submit action-button" value="ENVOYER" title="Enregistrez-vous!">

                            <center><div id="load_data_SingUp"></div></center>
                        </fieldset>

                    </form>

                </div>
                <div class="col-lg-3"></div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

