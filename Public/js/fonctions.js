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
    $('a').click(function(e){
       var link = $(this).attr('href');
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
    });
});
