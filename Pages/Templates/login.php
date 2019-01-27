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
			<div class="modal-body col-lg-6" id="uploads2">
				
			
	  <div class="ombrage" style="background: #0f6296; border-radius: 20%; margin: 15px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<strong class="centre" style="font-size:1.2em;">GENEREZ VOTRE DEVIS</strong><br>
	 </div>
	 <div id="rapport" class="alert alert-danger centre centre" style="display:none;"></div>

	  
	  <form id="singIn" class="" method="post" onsubmit="return false;" accept-charset="UTF-8">

          <div class="">
            <div class="inputBox">
              <input type="email" name="emailSingIn" required="" id="emailSingIn"><small id="check_emailSingIn"></small>
                <label for="">Email*</label>
            </div>
            <div class="inputBox">
                <input type="password" name="passwordSingIn" required="" id="passwordSingIn"><small id="check_passwordSingIn"></small>
                <label for="">Password</label>
            </div>

            <label class="col-lg-12">
                <span class="col-lg-6"><input type="checkbox" name="t_and_c" id="t_and_c" value="1" data-color="info"> Restez-Connecté ! </span>&nbsp &nbsp &nbsp &nbsp
                <span class="col-lg-5"> <a style="color: #fff;font-weight: bold" href="forget.php" title="Cliquez ici si vous avez oublié votre password">   Password Oublié ? </a></span>
            </label>

              <input type="submit" class="submit action-button" value="CONNEXION" title="CONNECTEZ-VOUS" name="submit">
              <input id="inscription" type="button" class="action-button" value="INSCRIPTION" title="INSCRIVEZ-VOUS ICI !" name="inscriptions">
          </div>

		<div style="display:none;" id="uploads3">
				<center> <img src="ajax-loader28.gif"></center>
        </div>
      </form>




                <form id="singUp" class="collapse" method="post" onsubmit="return false;" accept-charset="UTF-8">

                    <ul id="progressbar">
                        <li class="active">IDENTIFICATION PERSONNELLE</li>
                        <li>IDENTIFICATION PUBLIC</li>
                       <center><span id="statut" class="check_field"> Veuillez-remplir tous les champs</span></center>
                    </ul>

                <fieldset>
                    <h2 class="fs-title centre">IDENTIFICATION PERSONNELLE</h2>
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
                        <h2 class="fs-title centre">IDENTIFICATION PUBLIC</h2>
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

                            <div id="load_data_SingUp" class="center"></div>

                    </fieldset>

                    </form>
                <div style="display:none;" id="uploads3">
                    <center> <img src="ajax-loader28.gif"></center>
                </div>

			</div>

            <div class="col-lg-3"></div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--code JQUERY***********************************-->

    <script>
      $(function() {
          /*
		  $('#go').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
		$('#uploads2').show();
		$('#uploads3').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
 
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            dataType: 'html', // selon le retour attendu
            data:data,
            success:function(data){
				$('#uploads3').hide();
				if(data==1)
				{$('#uploads2').hide();
				$(location).attr('href',"prof.php");	
				}else
				{
					$('#rapport').text(data).show();
				}
				
	}
           
       });
        });*/



      });
      </script>
	  
	  
	  
	  
