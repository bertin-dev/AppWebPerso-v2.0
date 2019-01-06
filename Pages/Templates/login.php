<style>
    .login-wrap {
        padding: 20px;
    }

    .login-img3-body{
        background:  no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .login-form .login-img{
        font-size: 50px;
        font-weight: 300;
    }

    .login-form{
        max-width: 350px;
        margin: 0 auto 0;
        background: rgba(213,215,222,0.4);
        border: 1px solid #B0B6BE;
    }

    .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
    }
    .input-group.col {
        float: none;
        padding-left: 0;
        padding-right: 0;
    }

    .input-group .form-control {
        width: 100%;
        margin-bottom: 0;
    }

    .input-group-lg > .form-control,
    .input-group-lg > .input-group-addon,
    .input-group-lg > .input-group-btn > .btn {
        height: 45px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 6px;
    }

    .input-group-addon,
    .input-group-btn,
    .input-group .form-control {
        display: table-cell;
    }
    .input-group-addon:not(:first-child):not(:last-child),
    .input-group-btn:not(:first-child):not(:last-child),
    .input-group .form-control:not(:first-child):not(:last-child) {
        border-radius: 0;
    }


    .input-group-addon,
    .input-group-btn {
        width: 1%;
        white-space: nowrap;
        vertical-align: middle;
    }
    .input-group-addon {
        padding: 6px 12px;
        font-size: 14px;
        font-weight: normal;
        line-height: 1;
        text-align: center;
        background-color: #f7f7f7;
        border: 1px solid #c7c7cc;
        border-radius: 4px;
    }
    .input-group-addon.input-sm {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 3px;
    }

    .input-group-addon input[type="radio"],
    .input-group-addon input[type="checkbox"] {
        margin-top: 0;
    }

    .input-group .form-control:last-child,
    .input-group-addon:last-child,
    .input-group-btn:last-child > .btn,
    .input-group-btn:last-child > .dropdown-toggle,
    .input-group-btn:first-child > .btn:not(:first-child) {
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
    .input-group-addon:last-child {
        border-left: 0;
    }
    .input-group-btn {
        position: relative;
        white-space: nowrap;
    }
    .input-group-btn > .btn {
        position: relative;
    }
    .input-group-btn > .btn + .btn {
        margin-left: -4px;
    }

    .input-group-btn > .btn:hover,
    .input-group-btn > .btn:active {
        z-index: 2;
    }
    .login-form .input-group{
        padding-bottom: 15px;
    }

    .login-form .input-group-addon{
        padding: 6px 12px;
        font-size: 16px;
        color: #8b9199;
        font-weight: normal;
        line-height: 1;
        text-align: center;
        background-color: #ffffff;
        border: none;
        border-radius: 0;
    }



    .form-control-static {
        margin-bottom: 0;
        padding-top: 7px;
    }

    .form-inline .form-control {
        display: inline-block;
    }

    .input-group .form-control {
        width: 100%;
        margin-bottom: 0;
    }

    .input-group .form-control:first-child,
    .input-group-addon:first-child,
    .input-group-btn:first-child > .btn,
    .input-group-btn:first-child > .dropdown-toggle,
    .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle) {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }

    .input-group .form-control:last-child,
    .input-group-addon:last-child,
    .input-group-btn:last-child > .btn,
    .input-group-btn:last-child > .dropdown-toggle,
    .input-group-btn:first-child > .btn:not(:first-child) {
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
    }
    .navbar-form .form-control {
        display: inline-block;
    }

    .form-control:-moz-placeholder {
        color: #d7d7d7;
    }
    .form-control::-moz-placeholder {
        color: #d7d7d7;
    }
    .form-control:-ms-input-placeholder {
        color: #d7d7d7;
    }
    .form-control::-webkit-input-placeholder {
        color: #d7d7d7;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #8e8e93;
        vertical-align: middle;
        background-color: #ffffff;
        border: 1px solid #c7c7cc;
        border-radius: 4px;
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }
    .form-control:focus {
        border-color: #007AFF;
        outline: 0;
    }
    .form-control[disabled],
    .form-control[readonly],
    fieldset[disabled] .form-control {
        cursor: not-allowed;
        background-color: #f7f7f7;
    }
    textarea.form-control {
        height: auto;
    }

    .login-form .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }


    .login-form .form-control:focus {
        z-index: 2;
    }

    .navbar-form .form-control{
        width: 200px;
        height: 30px;
        background: white  no-repeat 3px;
        padding-left: 24px;
        margin-top: 1px;
    }

    .radio input[type="radio"],
    .radio-inline input[type="radio"],
    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
        float: left;
        margin-left: -20px;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin: 4px 0 0;
        margin-top: 1px \9;
    }

    input[type="checkbox"],
    input[type="radio"] {
        box-sizing: border-box;
        padding: 0;
    }

    .has-switch input[type=checkbox] {
        display: none;
    }

    .checkbox, .checkbox:hover, .checkbox:focus  {
        border:none;
    }

    .mail-option .chk-all input[type=checkbox] {
        margin-top: 0;
    }

    .login-form .checkbox {
        margin-bottom: 14px;
    }
    .login-form .checkbox {
        font-weight: normal;
        font-weight: 300;
        font-family: 'Lato', sans-serif;
    }

    .pull-right {
        float: right !important;
    }






    .btn-info {
        color: #ffffff;
        background-color: #34aadc;
        border-color: #34aadc;
    }
    .btn-info:hover,
    .btn-info:focus,
    .btn-info:active
    {
        color: #34aadc;
        background: transparent;
        border-color: #34aadc;
    }

    .btn-lg {
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 6px;
    }

    .btn-block {
        display: block;
        width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
    .btn-block + .btn-block {
        margin-top: 5px;
    }
    input[type="submit"].btn-block,
    input[type="reset"].btn-block,
    input[type="button"].btn-block {
        width: 100%;
    }




</style>












<div class="modal fade" id="login_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="login-img3-body modal-content">
			<div class="col-lg-3"></div>

				
        <!----------------------------------------------------------ESPACE FORMATEURS------------------------------------------------------------->
			<div class="modal-body col-lg-6" id="uploads2">
				
			
	  <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center><strong style="font-size:1.2em;">ESPACE FORUM</strong><br></center>
	 </div>
	 <center><div id="rapport" class="alert alert-danger" style="display:none;"></div></center>

	  
	  <form id="go" class="" action="traitement.php?go=go" method="post" enctype="multipart/form-data">
        <div class="">
          
            <div class="inputBox">

              <input type="email" name="email" required="">
                <label for="">Email</label>
            </div>
            <div class="inputBox">

                <input type="password" name="password" required="">
                <label for="">Password</label>
            </div>

            <label class="col-lg-12">
                <span class="col-lg-6"><input type="checkbox" name="t_and_c" id="t_and_c" value="1" data-color="info"> Restez-Connecté ! </span>&nbsp &nbsp &nbsp &nbsp
                <span class="col-lg-5"> <a style="color: #fff;font-weight: bold" href="forget.php" title="Cliquez ici si vous avez oublié votre password">   Password Oublié ? </a></span>
            </label>
			
		
					
            <button class="btn btn-info btn-lg btn-block" type="submit" title="CONNECTEZ-VOUS">CONNEXION</button>
            <button class="btn btn-info btn-lg btn-block" href="#" title="INSCRIVEZ-VOUS ICI !">INSCRIPTION</button>
        </div>
		<div style="display:none;" id="uploads3">
				<center> <img src="ajax-loader28.gif"></center>
				</div>
      </form>
				 
			</div>

            <div class="col-lg-3"></div>

			
			
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--code JQUERY***********************************-->

    <script>
      $(function() {
			
			
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
        });
      
      });
      </script>
	  
	  
	  
	  
