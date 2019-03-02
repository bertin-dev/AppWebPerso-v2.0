
/* ==========================================================================
SYSTEME DE GESTION DES INSCRIPTIONS STEP BY STEP AVEC CHARGEMENT AUTOMATIQUE ET SCROLL INDICATOR
========================================================================== */
/*inscription step by step*/

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


/*-----------------------Barre de chargement automatique----*/

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





//Gestion du scrolling indicator
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
GESTION DE L AJOUT DES CATEGORIE DANS LA ZONE ADMINISTRATION
========================================================================== */
$(function() {

    $('#categorie').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.categorieUploads').show();
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
                var cat = $('#categorieRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.categorieUploads').hide();
                }
                else
                {
                 $('.categorieUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté une Catégorie').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Catégorie').slideDown().hide();
                 }, 5000);

                }

            }

        });
    });
});






/* ==========================================================================
GESTION DE L'AJOUT DES SUJETS DANS LA ZONE ADMINISTRATION
========================================================================== */
$(function() {

    $('#blog').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.blogUploads').show();
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
                var cat = $('#blogRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.blogUploads').hide();
                }
                else
                {
                    $('.blogUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté un Sujet').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté un Sujet').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});







/* ==========================================================================
BLOC SERVICES
========================================================================== */

/* ==========================================================================
GESTION DE L AJOUT DES MODELS DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#models').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.modelsUploads').show();
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
                var cat = $('#ModelsRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.modelsUploads').hide();
                }
                else
                {
                    $('.modelsUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté un Modèle').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté un Modèle').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIE SERVICES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#cat_services').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.cat_servicesUploads').show();
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
                var cat = $('#cat_servicesRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.cat_servicesUploads').hide();
                }
                else
                {
                    $('.cat_servicesUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté une Catégorie de Services').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Catégorie de Services').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DES SUJETS DANS LA ZONE ADMINISTRATION
========================================================================== */
$(function() {

    $('#services').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.servicesUploads').show();
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
                var cat = $('#servicesRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.servicesUploads').hide();
                }
                else
                {
                    $('.servicesUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté un Service').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté un Service').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});





/* ==========================================================================
GESTION DE L AJOUT DU TYPE FONCTIONNALITES DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#typeFonctionnalites').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.typeFUploads').show();
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
                var cat = $('#typeFRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.typeFUploads').hide();
                }
                else
                {
                    $('.typeFUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté Type de Fonctionnalité').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté Type de Fonctionnalité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DES FONCTIONNALITES DANS LA ZONE ADMINISTRATION
========================================================================== */
/*$(function() {

    $('#fonctionnalites').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.fonctionnalitesUploads').show();
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
                var cat = $('#fonctionnaliteRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.fonctionnalitesUploads').hide();
                }
                else
                {
                    $('.fonctionnalitesUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Fonctionnalité').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté une Fonctionnalité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});
*/

