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


                    <div class="ombrage" style="background: #0f6296; border-radius: 10%; margin: 15px; text-align: center!important;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <strong style="font-size:1.2em;">GENERER VOTRE DEVIS</strong><br>
                    </div>

                    <!--formulaire de Connexion-->
                    <form id="singIn" class="" method="post" onsubmit="return false;" accept-charset="UTF-8">

                        <div id="SingInForm">
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
                            <div id="load_data_SingIn" style="text-align: center!important;"></div>
                        </div>
                    </form>

                    <!--formulaire d'Inscription-->
                    <form id="singUp" class="collapse" method="post" onsubmit="return false;" accept-charset="UTF-8">
                        <ul id="progressBarByStep" style="text-align: center!important;">
                            <li class="active">IDENTIFIANT PERSONNELLE</li>
                            <li>IDENTIFIANT DE CONNEXION</li>
                           <span id="statut" class="check_field"> Veuillez-remplir tous les champs</span>
                        </ul>

                        <fieldset>
                            <h2 class="fs-title centre">IDENTIFIANT</h2>
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
                            <h2 class="fs-title centre">IDENTIFIANT DE CONNEXION</h2>
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

                            <div id="load_data_SingUp" style="text-align: center!important;"></div>
                        </fieldset>
                    </form>

                    <!--formulaire de recupération du password-->
                    <form id="getPassword" class="" method="post" onsubmit="return false;" accept-charset="UTF-8">
                        <div id="SingInForget" class="collapse">
                            <h2 class="fs-title centre" style="margin-bottom: 50px;">RECUPERATION DU MOT DE PASSE</h2>
                            <div class="inputBox">
                                <input type="email" name="getEmail" required="" id="getEmail"><em><small id="output_getEmail"></small></em>
                                <label for="">Entrez Votre Email*</label>
                            </div>
                            <input id="sendEmailForget" type="submit" title="Cliquez Suivant" value="ENVOYER">
                            <div id="load_data_getEmail" style="text-align: center!important;"></div>
                        </div>
                    </form>"


                </div>
                <div class="col-lg-3"></div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

