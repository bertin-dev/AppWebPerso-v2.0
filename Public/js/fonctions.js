/**
 * Created by Supers-Pipo on 04/02/2018.
 */

/* ==========================================================================
système d'animation wow.min.js et animate.min.css
   ========================================================================== */
new WOW().init();


/* ==========================================================================
GESTION DU SYSTEME D'INFOBULLE
   ========================================================================== */
$(function (){

   $('span, a:not(#more_load_project), button, input, textarea, img, ul li, abbr, small').tooltip();
});

/* ==========================================================================
GESTION DU SYSTEME DE NOTIFICATION EN LECTURE
   ========================================================================== */

$(function () {

    function load_unseen_notification(view = '') {
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'post',
            data: {view: view},
            dataType: 'json',
            success: function (data) {
                $('.menu').html(data.notification);

                if (data.unseen_notification > 0) {
                    $('.count').html(data.unseen_notification);
                }


            },
            error: function(data){
                console.log('Erreur de chargement des Notifications');
            }
        });
    }

    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle', function () {
       $('.current').css('display') == 'none'? $('.current').css('display', 'block'):$('.current').css('display', 'none');
        $('.count').html('');
        load_unseen_notification('yes');
    });

    setInterval(function () {
        load_unseen_notification();
    }, 60000);

//------------------------------FIN----------------------------

});



/* ==========================================================================
SYSTEME DE GESTION DES INSCRIPTION DANS LA FENETRE MODALE STEP BY STEP
   ========================================================================== */

var current_fs, next_fs, previous_fs;
var left, opacity, scale;// fieldset properties which we will animate

$(".next").click(function(){
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $('#progressBarByStep li').eq($('fieldset').index(next_fs)).addClass('active');

    //show the next fieldset
    next_fs.show();
    //hide the current fiedset with style
    current_fs.animate({opacity: 0}, {

        step:function(now, mx){

            scale = 1- (1-now) * 0.2;
            left = (now * 50) + "%";
            opacity = 1-now;
            current_fs.css({'transform':'scale('+scale+')'});
            next_fs.css({'left':left, 'opacity':opacity});
        },
        duration: 800,
        complete:function(){
            current_fs.hide();
        },
        easing:'easeInOutBack'
    });
});


/* previous */
$('.previous').click(function(){

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    //activate next step on progressbar using the index of next_fs
    $('#progressBarByStep li').eq($('fieldset').index(current_fs)).removeClass('active');

    //show the next fieldset
    previous_fs.show();
    //hide the current fiedset with style
    current_fs.animate({opacity: 0}, {

        step:function(now, mx){

            scale = 0.8 + (1-now) * 0.2;
            left = ((1-now) * 50) + "%";
            opacity = 1-now;
            current_fs.css({'left': left});
            previous_fs.css({'transform':'scale('+scale+')', 'opacity': opacity});

        },
        duration: 800,
        complete:function(){
            current_fs.hide();
        },
        easing:'easeInOutBack'
    });

});

/* ==========================================================================
SYSTEME DE CACHE DES ELEMENTS DE LA MODAL EN FONCTION DU CLICK SUR L INSCRIPTION, LA CONNEXION OU LA RECUPERATION DU PASSWORD
   ========================================================================== */
jQuery(function(){

    $('#inscription').on('click', function(){

        $('#singIn').addClass('collapse');
        $('#singUp').removeClass('collapse');
        $('#inscription').remove();
    });

    $('#forget').on('click', function(e){
        e.preventDefault();
        $('#SingInForm').addClass('collapse');
        $('#SingInForget').removeClass('collapse');
    });
});


$(function () {
    /* ==========================================================================
           GESTION DU SYSTEME DE CONNEXION
       ========================================================================== */

    $('#emailSingIn').keyup(function () {
        emailSingIn();
    });

    $('#passwordSingIn').keyup(function () {
        passwordSingIn();
    });

    //fonction de verification de l'email en ajax
    function emailSingIn() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singIn=singIn',
            data: {
                'emailSingIn': $('#emailSingIn').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_emailSingIn').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_emailSingIn').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingIn() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singIn=singIn',
            data: {
                'passwordSingIn': $('#passwordSingIn').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingIn').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordSingIn').css('color', 'red').html(data);
                }
            }
        });


    }


    $('#singIn').submit(function () {
        var email = $('#emailSingIn').val(), password = $('#passwordSingIn').val();


        if (email == '' || password == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir Tous les Champs !',
                img: 'img/icons/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?singIn=singIn',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_connexion').attr('value', 'En cours...');
                    $('#load_data_SingIn').html('<div style="display: block;">\n' +
                        '                                    <span class="loader loader-circle"></span>\n' +
                        '                                    Chargement......\n' +
                        '                                </div>');
                },
                success: function (data) {
                    if(data === 'admin'){
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singIn').hide().fadeOut();

                        var myDate = new Date(), etat;
                        (myDate.getHours()>=0 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';
                        //alert(myDate.getHours());
                        $('body').notif({
                            title: etat,
                            content: 'BIENVENUE ADMINISTRATEUR',
                            img: 'img/homme.png',
                            cls: 'alert-info'
                        });

                        setTimeout(function () {
                            $(location).attr('href',"../Administrator/index.php");
                        }, 7000);
                    }else if(data === 'success'){
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singIn').hide().fadeOut();

                        var myDate = new Date(), etat;
                        (myDate.getHours()>=0 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';
                        //alert(myDate.getHours());
                        $('body').notif({
                            title: etat,
                            content: 'Soyez Le Bienvenu',
                            img: 'img/homme.png',
                            cls: 'success1'
                        });

                        setTimeout(function () {
                            $(location).attr('href',"index.php?id_page=9");
                        }, 7000);
                    }
                    else {
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'Erreur',
                            content: data,
                            img: 'img/icons/error-notif.png',
                            cls: 'error1'
                        });
                    }
                }

            });

        }


    });

});




$(function () {
    /* ==========================================================================
GESTION DU SYSTEME D'INSCRIPTION
========================================================================== */

    $('#singUp input').focus(function () {
        $('#statut').fadeOut(800);
    });

    //verification si le Nom est ok ou a déjà été utilisé
    $('#nomSingUp').keyup(function () {
        nomSingUp();
    });

    $('#prenomSingUp').keyup(function () {
        prenomSingUp();
    });

    $('#emailSingUp').keyup(function () {
        emailSingUp();
    });

    $('#passwordSingUp').keyup(function () {
        passwordSingUp();
    });

    $('#passwordConfirmSingUp').keyup(function () {
        passwordConfirmSingUp();
    });

    //fonction de verification du Nom en ajax
    function nomSingUp() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'nomSingUp': $('#nomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_nomSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_nomSingUp').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial'
                    }).html(data);
                }
            }
        });


    }

    //fonction de verification du Prenom en ajax
    function prenomSingUp() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'prenomSingUp': $('#prenomSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_prenomSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_prenomSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification de l'email en ajax
    function emailSingUp() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'emailSingUp': $('#emailSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_emailSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_emailSingUp').css('color', 'red').html(data);
                }
            }
        });


    }

    //fonction de verification du password en ajax
    function passwordSingUp() {
      /*  $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'passwordSingUp': $('#passwordSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordSingUp').css('color', 'red').html(data);
                }
            }
        });*/

        if($('#passwordSingUp').val().length < 5){
            $('#output_passwordSingUp').css('color', 'red').html("<br>Trop court (5 caractères minimum.)");
        }else if($('#passwordConfirmSingUp').val()!='' && $('#passwordConfirmSingUp').val()!= $('#passwordSingUp').val()){
                $('#output_passwordSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
                $('#output_passwordConfirmSingUp').css('color', 'red').html('<br>Les deux mots de passe sont différents');
            }else{
            $('#output_passwordSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
            if($('#passwordConfirmSingUp').val()!=''){
                $('#output_passwordConfirmSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
            }
        }



    }



    //fonction de verification du password confirme en ajax
    function passwordConfirmSingUp() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'passwordSingUp': $('#passwordSingUp').val(),
                'passwordConfirmSingUp': $('#passwordConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_passwordSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    $('#output_passwordConfirmSingUp').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_passwordConfirmSingUp').css('color', 'red').html(data);
                }
            }
        });


    }



    $('#singUp').submit(function () {
        var statut1 = $('#statut');
        var nom = $('#nomSingUp').val(), prenom = $('#prenomSingUp').val(), email1 = $('#emailSingUp').val(), password1 = $('#passwordSingUp').val();


        if (nom == '' || prenom == '' || email1 == '' || password1 == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir Tous les Champs !',
                img: 'img/icons/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?singUp=singUp',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg').attr('value', 'En cours...');
                            $('#load_data_SingUp').html('<div style="display: block;">\n' +
                       '                                    <span class="loader loader-circle"></span>\n' +
                       '                                    Chargement......\n' +
                       '                                </div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        statut1.html(data).fadeIn(400);
                        $('#enreg').attr('value', 'Envoyer');
                              $('#load_data_SingUp').html('<div style="display: none;">\n' +
                       '                                    <span class="loader loader-circle"></span>\n' +
                       '                                    Chargement......\n' +
                       '                                </div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/icons/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg').attr('value', 'Envoyer');
                        $('#load_data_SingUp').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singUp').hide();

                            $('body').notif({
                                title: 'Courrier Electronique',
                                content: 'Votre compte utilisateur a partiellement été créée. Un Email vient d\'être Envoyé à cette Adresse: ' + email1,
                                img: 'img/socials/email.png',
                                cls: 'alert-info'
                            });
                        setTimeout(function () {
                            location.href='index.php';
                        }, 6000);
                       /* $('#nomSingUp').val("");
                        $('#prenomSingUp').val("");
                        $('#emailSingUp').val("");
                        $('#passwordSingUp').val("");*/

                    }
                }

            });

        }


    });

});


/* ==========================================================================
SYSTEME DE GESTION DE L'ALERT DE NOTIFICATION APRES UN EVENEMENT
   ========================================================================== */

$(function () {

    //creation de mon plugin JQuery avec le template de ma notification
    $.fn.notif = function(options){
        var options = $.extend({
            html: '    <div class="alert_notification add animated fadeInLeft {{cls}}">\n' +
            '        <div class="left1">\n' +
            '            <div class="img1" style="background-image: url({{img}});">  \n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="right1">\n' +
            '            <h2 class="alert_title">{{title}}</h2>\n' +
            '            <p class="alert_p">{{content}}</p>\n' +
            '        </div>\n' +
            '    </div>'
        }, options);

        //permet de garder l'objet JQuery en mémoire et permet aussi d'enchainner les arguments juste apres
        return this.each(function () {
            var $this = $(this);
            var $notifs = $('> #alert_notifications', this);
            var $notif = $(Mustache.render(options.html,
                options));

            if($notifs.length == 0){
                $notifs = $('<div id="alert_notifications"/>'
                );
                $this.append($notifs);
            }
            $notifs.append($notif);
            setTimeout(function () {
                $notif.addClass('.fadeOutLeft').delay(500).slideUp(300, function () {
                    $notif.remove();
                });
            }, 6000);
        });
    };

    //apres le click
    $('.add').click(function(e){
        e.preventDefault();
        $('body').notif({
            title: 'Mon titre',
            content: 'Mon contenu',
            img: 'img/icons/success-notif.jpg',
            cls: 'success1'
        });
    });

});



/* ==========================================================================
GESTION DU SYSTEME DE NEWSLETTERS
========================================================================== */
$(function () {

    $('#newsletter').keyup(function () {
        newsletter();
    });

    //fonction de verification du Nom en ajax
    function newsletter() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?newsletter=newsletter',
            data: {
                'newsletter': $('#newsletter').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_newsletter').show();
                    $('#output_newsletter').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_newsletter').show();
                    $('#output_newsletter').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial',
                        'font-size': '65%'
                    }).html(data);

                    setTimeout(function () {
                        $('#output_newsletter').hide();

                    }, 7000);
                }
            }
        });


    }



    $('#newsletters').submit(function () {
        var email_newsletter = $('#newsletter').val();


        if (email_newsletter == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs !',
                img: 'img/icons/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?newsletter=newsletter',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_newsletter').attr('value', 'En cours...');
                    $('#load_data_newsletter').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#enreg_newsletter').attr('value', 'Envoyer');
                        $('#load_data_newsletter').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/icons/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg_newsletter').attr('value', 'Envoyer');
                        $('#load_data_newsletter').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/icons/success-notif.jpg',
                            cls: 'success1'
                        });
                        setTimeout(function () {
                            $('#output_newsletter').fadeOut().hide();

                        }, 7000);
                    }
                }

            });

        }


    });



});




/* ==========================================================================
GESTION DU SYSTEME DE RECUPERATION DU MOT DE PASSE
========================================================================== */

$(function () {

    $('#getEmail').keyup(function () {
        getEmail();
    });


    //fonction de verification de l'email en ajax
    function getEmail() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?getEmail=getEmail',
            data: {
                'getEmail': $('#getEmail').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_getEmail').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_getEmail').css({
                        'color': 'red',
                        'font-weight': 'bold'
                    }).html(data);

                    /* setTimeout(function () {
                         $('#output_email_visitor').hide();

                     }, 7000);*/
                }
            }
        });


    }




    $('#getPassword').submit(function () {
        var email = $('#getEmail').val();


        if (email == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs !',
                img: 'img/icons/error-notif.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?getEmail=getEmail',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#sendEmailForget').attr('value', 'En cours...');
                    $('#load_data_getEmail').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#sendEmailForget').attr('value', 'Envoyer');
                        $('#load_data_getEmail').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/icons/error-notif.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#sendEmailForget').attr('value', 'Envoyer');
                        $('#load_data_getEmail').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/icons/success-notif.jpg',
                            cls: 'success1'
                        });
                        /* setTimeout(function () {
                             $('#output_visitor').fadeOut().hide();

                         }, 7000);*/
                    }
                }

            });

        }


    });

});


/* ==========================================================================
GESTION DES SERVICES
========================================================================== */

$(function(){

    //mobile
    var projet3 = $('#projet3');
    var I3 = projet3.attr('data');
    projet3.click(function(even){
        even.preventDefault();
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                projet_conception: projet3.text()
            },
            dataType: 'text',
            error: function(){
                console.log('Une erreur est survenue Lors du click sur le bouton Conception Mobile dans les services');
            }
        });
        $('body').load('index.php?id_page=10&service=' + I3, function() {
        });
    });

    //web
    var projet1 = $('#projet1');
    var I1 = projet1.attr('data');
    projet1.click(function(even){
        even.preventDefault();
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                projet_conception: projet1.text()
            },
            dataType: 'text',
            error: function(){
                console.log('Une erreur est survenue Lors du click sur le bouton Conception web dans les services');
            }
        });
        $('body').load('index.php?id_page=11&service=' + I1, function() {

        });
    });

    //windows
    var projet2 = $('#projet2');
    var I2 = projet2.attr('data');
    projet2.click(function(even){
        even.preventDefault();
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                projet_conception: projet2.text()
            },
            dataType: 'text',
            error: function(){
                console.log('Une erreur est survenue Lors du click sur le bouton Conception Windows dans les services');
            }
        });
        $('body').load('index.php?id_page=12&service=' + I2, function() {

        });
    });




});





/* ==========================================================================
SYSTEME DE GESTION DES RESEAUX SOCIAUX (PARTAGER)
========================================================================== */
(function(){

    var popupCenter = function(url, title, width, height){
        var popupWidth = width || 640;
        var popupHeight = height || 320;
        var windowLeft = window.screenLeft || window.screenX;
        var windowTop = window.screenTop || window.screenY;
        var windowWidth = window.innerWidth || document.documentElement.clientWidth;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2 ;
        var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
        var popup = window.open(url, title, 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft);
        popup.focus();
        return true;
    };

    document.querySelector('.share_twitter').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
            "&via=bertin_dev" +
            "&url=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur Twitter");
    });

    document.querySelector('.share_facebook').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur facebook");
    });

    /*document.querySelector('.share_gplus').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://plus.google.com/share?url=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur Google+");
    });*/

    document.querySelector('.share_linkedin').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur Linkedin");
    });

})();


/* ==========================================================================
SYSTEME DE GESTION DES RESEAUX SOCIAUX (PARTAGER) DANS LE BLOG AVEC LES DELEGUATE
========================================================================== */
$(function(){

    var popupCenter = function(url, title, width, height){
        var popupWidth = width || 640;
        var popupHeight = height || 320;
        var windowLeft = window.screenLeft || window.screenX;
        var windowTop = window.screenTop || window.screenY;
        var windowWidth = window.innerWidth || document.documentElement.clientWidth;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2 ;
        var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
        var popup = window.open(url, title, 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft);
        //popup.focus();
        return true;
    };

    var content_blog = $('#articles');

    content_blog.on('click', '.share_twitter' , function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
            "&via=bertin_dev" +
            "&url=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur Twitter");
    });

    content_blog.on('click', '.share_facebook', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur facebook");
    });

    content_blog.on('click', '.share_linkedin', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl = "https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(url);
        popupCenter(shareUrl, "Partager sur Linkedin");
    });

});



/* ==========================================================================
SYSTEME DE GESTION DES LANGUES DU SITE WEB
========================================================================== */

$(function(){
    $('#langue').change(function () {
        $('body').notif({
            title: 'Notification d\'Information',
            content: 'Anglais est Indisponible pour le moment !',
            img: 'img/icons/information.png',
            cls: 'alert-info'
        });
        //('#langue').append(new Option('Foo', 'foo', true, true));
    });

    //ORGANIGRAMME
    $('.tree1 a').click(function(e){
        e.preventDefault();
    });
});


//RECUPERATION DES EVENEMENTS CLICK
$('a, button, input').on({
    click:function(e){
        //e.preventDefault();
        var titre = $(this).text();
        var link = $(this).attr('href');
        var buttonUrl = $(this).attr('data-url');
        var type = $(this).attr('type');
        $.ajax({
            url: '../Core/Controller/verification.php?log=log',
            method: 'POST',
            data: {
                title:titre,
                lien:link,
                buttonUrl:buttonUrl,
                type:type
            },
            dataType: 'text',
            success:function (data) {
                console.log(data);
                //$('body').load(link, function() {});
            },
            error: function(data){
                console.log(data);
                //console.log('Une erreur est survenue');
            }
        });

    }/*,
    mouseenter: function () {
        var content = $(this).attr('data'),
            load_project = $('a[id=more_load_project]');
        eval(content);
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                plus_realisations_title: project_real
            },
            dataType: 'text',
            beforeSend: function () {
            },
            success:function (data) {
                load_project.tooltip({
                    title: data,
                    html: true
                });
            },
            error: function(data){
                console.log('Erreur de Chargement de Plus de Réalisations dans title');
            },
            complete: function (data) {
                //console.log('Chargement de Plus de Réalisations dans title Terminé');
            }
        });
    }*/
});


//GESTION DU GRAPHIQUE DANS LE FICHIER STATISTIQUE.PHP

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["PHP7", "JavaScript", "JQuery1.11", "MySQL", "HTML5", "CSS3", "Bootstrap 3"],
        color: '#fff',
        fontWeight: 'bold',
        datasets: [{
            label: 'Pourcentage d\'utilisation des possibilités offertes par la Technologie',
            data: [65, 30, 88, 55, 70, 45, 80],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctxL = document.getElementById("lineChart").getContext('2d');

var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);

gradientFill.addColorStop(0, "rgba(54, 162, 235, 0.2)");

gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");

var myLineChart = new Chart(ctxL, {

    type: 'line',

    data: {

        labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin"],

        datasets: [

            {

                label: "Vitesse d'exécution",

                data: [0, 35, 40, 0, 20, 0],

                backgroundColor: gradientFill,

                borderColor: [

                    'rgba(54, 162, 235, 1)',

                ],

                borderWidth: 2,

                pointBorderColor: "#fff",

                pointBackgroundColor: "rgba(54, 162, 235, 0.2)",

            }

        ]

    },

    options: {

        responsive: true

    }

});




let items = document.querySelectorAll('.sliderCertification .itemCertification');
let next = document.getElementById('nextCertification');
let prev = document.getElementById('prevCertification');

let active = 3;
function loadShow(){
    let stt = 0;
    items[active].style.transform = `none`;
    items[active].style.zIndex = 1;
    items[active].style.filter = 'none';
    items[active].style.opacity = 1;
    for(var i = active + 1; i < items.length; i++){
        stt++;
        items[i].style.transform = `translateX(${120*stt}px) scale(${1 - 0.2*stt}) perspective(16px) rotateY(-1deg)`;
        items[i].style.zIndex = -stt;
        items[i].style.filter = 'blur(5px)';
        items[i].style.opacity = stt > 2 ? 0 : 0.6;
    }
    stt = 0;
    for(var i = active - 1; i >= 0; i--){
        stt++;
        items[i].style.transform = `translateX(${-120*stt}px) scale(${1 - 0.2*stt}) perspective(16px) rotateY(1deg)`;
        items[i].style.zIndex = -stt;
        items[i].style.filter = 'blur(5px)';
        items[i].style.opacity = stt > 2 ? 0 : 0.6;
    }
}
loadShow();
next.onclick = function(){
    active = active + 1 < items.length ? active + 1 : active;
    loadShow();
}
prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : active;
    loadShow();
}
