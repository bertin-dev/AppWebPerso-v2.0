/**
 * Created by Supers-Pipo on 04/02/2018.
 */


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






