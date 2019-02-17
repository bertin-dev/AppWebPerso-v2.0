/**
 * Created by Supers-Pipo on 04/02/2018.
 */

/* ==========================================================================
système d'animation wow.min.js et animate.min.css
   ========================================================================== */
new WOW().init();


/* ==========================================================================
système de notification en lecture
   ========================================================================== */
$(function (){
   $('span').tooltip();
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


            }/*,
            error: function(data){
                console.log(data.unseen_notification);
            }*/
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
Gestion du scrolling indicator
   ========================================================================== */

$(function() {

    $("body").prognroll();

    $(".content").prognroll({
        custom:true
    });

    $(window).scroll(function() {
        if( $(window).scrollTop() > 250) {
            $(".arrow-down").css("visibility","hidden");
        }else {
            $(".arrow-down").css("visibility","visible");
        }
    });

});


/* ==========================================================================
gestion du survole de curseur sur les images de la rubrique portfolio
   ========================================================================== */

$(function(){
  $('.info_app').css({"height":0});
  $('.info_screenshot').bind("mouseover", function(){
      $(".info_app", this).stop(true).animate({"height" : "140px"}, 300);
  }).bind("mouseout", function(){
      $(".info_app", this).stop(true).animate({"height" : 0}, 300);
  })
});



/*controle du formulaire de news letter
$(function(){
    $("form").on("submit", function(){
        if($("input").val().length < 4){
            $("div.control-group").addClass("error");
            $("div.alert").show("slow").delay(4000).hide("slow");
            return false;
        }
    });
});
*/




/* ==========================================================================
gestion inscription step by step
   ========================================================================== */


var current_fs, next_fs, previous_fs;
var left, opacity, scale;// fieldset properties which we will animate

$(".next").click(function(){
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');

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
    $('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');

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
gestion Barre de chargement automatique avec prise en charge des images pendant le chargement
   ========================================================================== */


progressBar = {
    countElmt : 0,
    loadedElmt : 0,

    init: function () {
        var that = this;
        this.countElmt = $('img').length;

        //constructeur et ajout progress bar
        var $progressBarContainer = $('<div/>').attr('id', 'progress-bar-container');
        $progressBarContainer.append($('<div/>').attr('id', 'progress-bar'));
        $progressBarContainer.appendTo($('body'));

        //Ajout container d'élements
        var $container = $('<div/>').attr('id', 'progress-bar-elements');
        $container.appendTo($('body'));

        //parcours des éléménts à prendre en compte pour le chargement

        $('img').each(function () {
            $('<img/>')
                .attr('src', $(this).attr('src'))
                .on('load error', function () {
                    that.loadedElmt++;
                    that.updateProgressBar();
                })
                .appendTo($container);

        });
    },

    updateProgressBar: function () {
     $('#progress-bar').stop().animate({
        'width' : (progressBar.loadedElmt / progressBar.countElmt)*100 + '%'
     }, 200, 'linear', function () {
         if(progressBar.loadedElmt == progressBar.countElmt){
             setTimeout(function () {
                 $('#progress-bar-container').animate({
                     'top': '-8px'
                 }, function () {
                     $('#progress-bar-container').remove();
                     $('#progress-bar-elements').remove();
                 });
             }, 750)
         }
     });
    }
};

progressBar.init();


/* ---------------------------FIN DE LA GESTION DU CHARGEMENT AUTOMATIQUE -----------------------*/









/* ==========================================================================
Système de Navigation en Ajax c'est changer de page sans refraiche le navigateur malgré que j'ai déjà intégré le système de cache avec PHP
   ========================================================================== */

$(function(){
    $('#menu_head a').click(function(e){
        var link = $(this).attr('href');
       /*Empeche d'éffectuer la navigation ajax pour le menu Blog qui a pour id=index.php?id_page=7*/
        var tab = link.split('=');
        if(tab[1] != 7){
        $.ajax({
           url: link,
        })
            .done(function (html) {
                $('#page-top').empty().append(html);
               /* $('body').load(link, function() {

                });*/
            })
            .fail(function () {
                console.log('error');
            })
            .always(function(){
                console.log('complete');
            });
        e.preventDefault();
    }
    });
});






/* ==========================================================================
SYSTEME DE GESTION DES IMAGES SOUS FORME DE PANORAMA SUR APROPOS ET COMETENCE
   ========================================================================== */

$(window).load(function () {
    $('#wrapper-inner-selection-button').click(function() {
        event.stopPropagation();
        $('#wrapper-inner-selection-button-dropdown').fadeToggle(250);
    });


    $('html').click(function() {
        $('#wrapper-inner-selection-button-dropdown').fadeOut(250);
    });




    $('.wrapper-inner-content-image').each(function() {
        var this_element = $(this);
        this_element.height(this_element.find('img:first-child').height());
        this_element.find('.wrapper-inner-content-image-hover').height(this_element.find('img:first-child').height());
        ;});






    function resize_popup(){

        var window_width = window.innerWidth;
        var window_height = window.innerHeight;
        var max_image_width = window.innerWidth - ((35*2)+(window_width/100*40));
        var max_image_height = window.innerHeight - 200;
        var image_width = $('#fullscreen-image img').width();
        var image_height = $('#fullscreen-image img').height();
        var image_WH_ratio = image_width/image_height;
        var image_HW_ratio = image_height/image_width;
        var image_new_width = max_image_height*image_WH_ratio;
        var image_new_height = max_image_width*image_HW_ratio;



        $('#fullscreen-image').width(max_image_width);
        $('#fullscreen-image').height(max_image_height);

        if(max_image_width > 2 && max_image_height > 2){
            if(image_new_height>max_image_height){


                $('#fullscreen-image img').width(image_new_width);
                $('#fullscreen-image img').height(max_image_height);
                $('#fullscreen-image img').css('margin-top',-max_image_height/2);
                $('#fullscreen-image img').css('margin-left',-image_new_width/2);


            }else{

                $('#fullscreen-image img').width(max_image_width);
                $('#fullscreen-image img').height(image_new_height);
                $('#fullscreen-image img').css('margin-top',-image_new_height/2);
                $('#fullscreen-image img').css('margin-left',-max_image_width/2);
            }



        }



    }








    function open_close_gallery(){

        var this_element = '';

        $('.wrapper-inner-content-image-hover').click(function() {
            $('#fullscreen-image').find('img').remove();
            this_element = $(this);
            this_element.parent().find('img').clone().appendTo('#fullscreen-image');



            $('#fullscreen').show();
            $('#fullscreen').removeClass('fadeOut').addClass('fadeIn');
            $('#fullscreen-image').removeClass('fadeOutDown').addClass('fadeInDown');
            resize_popup();

        });



        $('#fullscreen-inner-close').click(function() {
            $('#fullscreen').removeClass('fadeIn').addClass('fadeOut').delay(500).hide(0);
            $('#fullscreen-image').removeClass('fadeInDown').addClass('fadeOutDown');
        });

    }




    function next_slide(){
        $('#fullscreen-image img:last-child').insertBefore( $('#fullscreen-image img:first-child') );
    }


    function previous_slide(){
        $('#fullscreen-image img:first-child').insertAfter( $('#fullscreen-image img:last-child') );
    }





    $(document).keydown(function(e) {
        switch(e.which) {
            case 37: // left
                previous_slide();
                break;

            case 38: // up
                next_slide();
                break;

            case 39: // right
                next_slide();
                break;

            case 40: // down
                previous_slide();
                break;

            default: return; // exit this handler for other keys
        }
        e.preventDefault(); // prevent the default action (scroll / move caret)
    });




    resize_popup();
    $( window ).resize(function() {
        resize_popup();
    });
    open_close_gallery();

    $('#fullscreen-inner-right').click(function() {
        next_slide();
    });
    $('#fullscreen-inner-left').click(function() {
        previous_slide();
    });





});




/* ==========================================================================
SYSTEME DE GESTION DE LA ZONE DE CITATION
   ========================================================================== */
jQuery(document).ready(function($) {
    $('.testimonialslide').flexslider({
        animation: "slide",
        slideshow: false,
        directionNav:false,
        controlNav: true
    });

    $('.postslider').flexslider({
        // Primary Controls
        controlNav          : true,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav        : true,              //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText: "",           //String: Set the text for the "previous" directionNav item
        nextText: "",               //String: Set the text for the "next" directionNav item
        // Special properties
        controlsContainer   : "",                //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
        manualControls      : "",                //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
        sync                : "",                //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
        asNavFor            : "",                //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
    });

    $('.main-slider').flexslider({
        // Primary Controls
        controlNav          : true,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav        : true,              //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText: "",           //String: Set the text for the "previous" directionNav item
        nextText: "",               //String: Set the text for the "next" directionNav item
        // Special properties
        controlsContainer   : "",                //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
        manualControls      : "",                //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
        sync                : "",                //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
        asNavFor            : "",                //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
    });

});




/* ==========================================================================
SYSTEME DE GESTION DU LOGIN ET L'INSCRIPTION
   ========================================================================== */






/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA PAGE PORFOLIO SECTION FREELANCE
   ========================================================================== */

$(function () {

    var limit = 2;
    var start = 0;
    var action = 'inactive';

    function chargement_data(limit, start){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                limit: limit,
                start: start
            },
            cache: false,
           success:function (data) {
               $('#load_more_data').append(data);
               if(data == ''){
                   $('#load_data_message').html('<div style="display: none;">\n' +
                       '                                    <span class="loader loader-circle"></span>\n' +
                       '                                    Chargement......\n' +
                       '                                </div>');
                   action = 'active';
               }
               else
               {
                   $('#load_data_message').html('<div id="loader_qualification" style="display: block;">\n' +
                       '                                    <span class="loader loader-circle"></span>\n' +
                       '                                    Chargement......\n' +
                       '                                </div>');
                   action = 'inactive';
               }
           }
        });
    }


    if(action === 'inactive')
    {
        action = 'active';
        chargement_data(limit, start);
    }


    $(window).scroll(function () {
       if($(window).scrollTop() + $(window).height() > $('#load_more_data').height() && action==='inactive'){
           action = 'active';
           start = start + limit;
           setTimeout(function () {
               chargement_data(limit, start);
           }, 3000);
       }
    });
});




/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION REALISATION
   ========================================================================== */

$(function(){
    var realisation = '1';
    $('#loader_realisation').show();
    function chargement_realisation(){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                realisation: realisation
            },
            cache: false,
            success:function (data) {
                $('#last_realisation').append(data);
                $('#loader_realisation').hide();
            }
        });
    }
        chargement_realisation();
});



/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION FONCTIONALITES
   ========================================================================== */

$(function(){
    var fonctionnality = '1';
    $('#loader_fonctionnality').show();
    function chargement_fonctionnality(){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                fonctionnality: fonctionnality
            },
            cache: false,
            success:function (data) {
                $('#last_fonctionnality').append(data);
                $('#loader_fonctionnality').hide();
            }
        });
    }
    chargement_fonctionnality();
});




/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION QUALIFICATION
   ========================================================================== */

$(function(){
    var qualification = '1';
    $('#loader_qualification').show();
    function chargement_qualification(){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                qualification: qualification
            },
            cache: false,
            success:function (data) {
                $('#last_qualification').append(data);
                $('#loader_qualification').hide();
            }
        });
    }
    chargement_qualification();
});



/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION FONCTIONALITES
   ========================================================================== */

$(function(){
    var load_commentaire = '1';
    $('#loader_last_comments').show();
    function chargement_commentaire(){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'POST',
            data: {
                load_commentaire: load_commentaire
            },
            cache: false,
            success:function (data) {
                $('#last_comments').append(data);
                $('#loader_last_comments').hide();
            }
        });
    }
    chargement_commentaire();
});
/* ==========================================================================
SYSTEME DE CHARGEMENT AUTOMATIQUE DES DONNEES DE LA BD DANS LA HOMEPAGE SECTION CITATIONS
   ========================================================================== */










/* ==========================================================================
Système de Navigation en Ajax de la page Apropos
   ========================================================================== */
/*
$(function(){
    $('#tags a').click(function(e){
        var link = $(this).attr('href');

        var tab = link.split('=');
        if(tab[1] != 6){
            $.ajax({
                url: link,
            })
                .done(function (html) {
                    $('#Apropos_content').empty().append(html);
                })
                .fail(function () {
                    console.log('error');
                })
                .always(function(){
                    console.log('complete');
                });
            e.preventDefault();
        }
    });
});*/



/* ==========================================================================
Système de connexion et inscription
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
                img: 'img/bertin-mounok.png',
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
                    if(data != 'success'){
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');

                        $('body').notif({
                            title: 'Message d\'Erreur',
                            content: data,
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg_connexion').attr('value', 'Envoyer');
                        $('#load_data_SingIn').html('<div style="display: none;">\n' +
                            '                                    <span class="loader loader-circle"></span>\n' +
                            '                                    Chargement......\n' +
                            '                                </div>');
                        $('#singIn').hide().fadeOut();

                        var myDate = new Date(), etat;
                        (myDate.getHours()>=6 && myDate.getHours() <= 12)? etat = 'BONJOUR': etat = 'BONSOIR';
                        //alert(myDate.getHours());
                        $('body').notif({
                            title: etat,
                            content: 'Soyez La Bienvenue',
                            img: 'img/bertin-mounok.png',
                            cls: 'success1'
                        });

                        setTimeout(function () {
                            $(location).attr('href',"index.php?id_page=9");
                        }, 7000);

                        /* $('body').load('mise_a_jour_actualite.php?page='+data, function() {
				         }); */

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
        $.ajax({
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
        });


    }



    //fonction de verification du password confirme en ajax
    function passwordConfirmSingUp() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?singUp=singUp',
            data: {
                'passwordConfirmSingUp': $('#passwordConfirmSingUp').val()
            },
            success: function (data) {
                if(data=='success'){
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
                img: 'img/bertin-mounok.png',
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
                            img: 'img/bertin-mounok.png',
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
                                content: 'Votre compte utilisateur a partiellement été créée <br> Un Email vient d\'être Envoyé à cette Adresse: ' + email1,
                                img: 'img/bertin-mounok.png',
                                cls: 'success1'
                            });
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
            img: 'img/bertin-mounok.png',
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
                img: 'img/bertin-mounok.png',
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
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg_newsletter').attr('value', 'Envoyer');
                        $('#load_data_newsletter').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/bertin-mounok.png',
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
GESTION DU SYSTEME D'ENVOI DE DONNEES DANS LA MENU CONTACT
========================================================================== */
$(function () {

    $('#identite_visitor').keyup(function () {
        identite_visitor();
    });

    $('#email_visitor').keyup(function () {
        email_visitor();
    });

    $('#message_visitor').keyup(function () {
        message_visitor();
    });
    //fonction de verification du Nom en ajax
    function identite_visitor() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?visitor=visitor',
            data: {
                'identite_visitor': $('#identite_visitor').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_identite_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_identite_visitor').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial',
                        'font-size': '65%'
                    }).html(data);

                   /* setTimeout(function () {
                        $('#output_visitor').hide();

                    }, 7000);*/
                }
            }
        });


    }


    //fonction de verification du Nom en ajax
    function email_visitor() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?visitor=visitor',
            data: {
                'email_visitor': $('#email_visitor').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_email_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_email_visitor').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial',
                        'font-size': '65%'
                    }).html(data);

                   /* setTimeout(function () {
                        $('#output_email_visitor').hide();

                    }, 7000);*/
                }
            }
        });


    }

    //fonction de verification du MESSAGE en ajax
    function message_visitor() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?visitor=visitor',
            data: {
                'message_visitor': $('#message_visitor').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_message_visitor').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_message_visitor').css({
                        'color': 'red',
                        'font-weight': 'bold',
                        'margin': 'initial',
                        'padding': 'initial',
                        'font-size': '65%'
                    }).html(data);

                   /* setTimeout(function () {
                        $('#output_message_visitor').hide();

                    }, 7000);*/
                }
            }
        });


    }



    $('#contact_visitor').submit(function () {
        var identite_visitor = $('#identite_visitor').val(), email_visitor = $('#email_visitor').val(), message_visitor = $('#message_visitor').val();


        if (identite_visitor == '' || email_visitor == '' || message_visitor == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs !',
                img: 'img/bertin-mounok.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?visitor=visitor',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_visitor').attr('value', 'En cours...');
                    $('#load_data_visitor').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#enreg_visitor').attr('value', 'Envoyer');
                        $('#load_data_visitor').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#enreg_visitor').attr('value', 'Envoyer');
                        $('#load_data_visitor').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/bertin-mounok.png',
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
                img: 'img/bertin-mounok.png',
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
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        $('#sendEmailForget').attr('value', 'Envoyer');
                        $('#load_data_getEmail').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/bertin-mounok.png',
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
GESTION DU SYSTEME DE CONNEXION
========================================================================== */
$(function(){
/*
    $('#devis').click(function () {
        alert('bonjour');
    });
   $('#devis').on('click', function(){
       alert('bfgfdsgdfg');
       $(location).attr('href',"index.php?id_page=9");
   });*/
});





/* ==========================================================================
SYSTEME DE GESTION DES COMMENTAIRES UTILISATEURS DU BLOG
========================================================================== */
$(function(){

    /*var $timer = setInterval(function () {
        load_comments();
    }, 3000);*/

    $('#contenuCommentaireUser').keyup(function () {
        commentaire();
    });

    //fonction de verification du Commentaire en ajax
    function commentaire() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?commentaire=commentaire',
            data: {
                'contenuCommentaireUser': $('#contenuCommentaireUser').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('.commentaire-error-msg').html('');
                  //  $('.commentaire-error-msg').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('.commentaire-error-msg').css({
                        'font-size': '8px',
                            'margin-top': '-5px',
                    'margin-bottom': '-20px'
                    }).html(data);

                    /* setTimeout(function () {
                         $('#output_message_visitor').hide();

                     }, 7000);*/
                }
            }
        });


    }



    $('#commentaire_user').submit(function () {
        var contentComments = $('#contenuCommentaireUser').val();


        if (contentComments == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs Commentaire !',
                img: 'img/bertin-mounok.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?commentaire=commentaire',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_commentaires').attr('value', 'En cours...');
                    $('.commentaire-error-msg').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#enreg_commentaires').attr('value', 'Envoyer');
                        $('.commentaire-error-msg').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        clearInterval($timer);
                        $('#enreg_commentaires').attr('value', 'Envoyer');
                        $('.commentaire-error-msg').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/bertin-mounok.png',
                            cls: 'success1'
                        });
                       // $('#contenuCommentaireUser').val("");
                        /* setTimeout(function () {
                             $('#output_visitor').fadeOut().hide();

                         }, 7000);*/
                       // load_comments();

                        // load_comments();
                    }

                    /*$timer = setInterval(function () {
                        load_comments();
                    }, 3000);*/
                }

            });

        }


    });




    //SYSTEME D AFFICHAGE DES MESSAGES INSTANTANEES
    function load_comments(vue_commentaires = ''){
        $.ajax({
            url: '../Core/Controller/verification.php',
            method: 'post',
            data: {vue_commentaires: vue_commentaires},
            dataType: 'json',
            success: function (data) {
                $('.commentaires-liste').html(data.notifOnComments);

                /* if (data.unseen_notification > 0) {
                     $('.count').html(data.unseen_notification);
                 }*/


            }/*,
            error: function(data){
                console.log(data.unseen_notification);
            }*/
        });
    }


//REPONSES DES COMMENTAIRES
/*
    $('#reponse_commentaire_contenu').keyup(function () {
        reponse_commentaire();
    });

    function reponse_commentaire() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?reponse_commentaire=reponse_commentaire',
            data: {
                'reponse_commentaire_contenu': $('#reponse_commentaire_contenu').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('.commentaire-error-msg-reponse').html('');
                    return true;
                }
                else{
                    $('.commentaire-error-msg-reponse').css({
                        'font-size': '8px',
                        'margin-top': '-5px',
                        'margin-bottom': '-20px',
                        'color': 'red'
                    }).html(data);
                }
            }
        });


    }



    $('.ajouter-commentaire').submit(function () {
        var reponse_commentaire_contenu = $('#reponse_commentaire_contenu').val();


        if (reponse_commentaire_contenu == '') {
            $('body').notif({
                title: 'Message d\'erreur',
                content: 'Veuillez Remplir le Champs Commentaire !',
                img: 'img/bertin-mounok.png',
                cls: 'error1'
            });
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?reponse_commentaire=reponse_commentaire',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                beforeSend: function () {
                    $('#enreg_reponse_commentaires').attr('value', 'En cours...');
                    $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: block;"><i class="fa fa-spinner fa-spin"></i></div>');
                },
                success: function (data) {
                    if(data != 'success'){
                        $('#enreg_reponse_commentaires').attr('value', 'Envoyer');
                        $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Message d\'erreur',
                            content: data,
                            img: 'img/bertin-mounok.png',
                            cls: 'error1'
                        });
                    }
                    else {
                        clearInterval($timer);
                        $('#enreg_reponse_commentaires').attr('value', 'Envoyer');
                        $('.commentaire-error-msg-reponse').html('<div class="fa-2x" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>');

                        $('body').notif({
                            title: 'Opération Réussie',
                            content: 'Merci de Nous avoir fait Confiance !',
                            img: 'img/bertin-mounok.png',
                            cls: 'success1'
                        });
                        $('#reponse_commentaire_contenu').val("zzrezrzer");
                    }
                }

            });

        }


    });
    */








});



$(function(){

    /* ==========================================================================
GESTION DU SYSTEME DE RECHERCHE INSTANTANE SUR LE BLOG
========================================================================== */
        $('#search_contenu').keyup(function () {
            search();
        });

        //fonction de verification du Nom en ajax
        function search() {
            $.ajax({
                type: 'GET',
                url: '../Core/Controller/verification.php?search=search',
                data: {
                    'search_contenu': $('#search_contenu').val()
                },
                dataType: 'json',
                success: function (data) {
                    if(data.resultat=='Aucun'){
                        $('#output_search').css({
                            'font-weight': 'bold',
                            'margin': 'initial',
                            'padding': 'initial',
                            'font-size': '65%'
                        }).html('Aucun résultat trouvé');

                        /*setTimeout(function () {
                            $('#output_search').hide();

                        }, 7000);*/
                    }
                    else
                    {
                        //$('#output_search').empty();
                        $('#blog-list').load('../Pages/Blog_resultat.php?id=1', function() {
                            $('#blog-list').html(data.resultat);
                        });
                        $('#output_search').css({
                            'font-weight': 'bold',
                            'margin': 'initial',
                            'padding': 'initial',
                            'font-size': '65%'
                        }).html(data.compteur + ' résultats trouvés');

                    }

                }
            });

        }

});