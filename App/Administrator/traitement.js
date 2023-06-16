


/*COMPTEUR DE VISITEUR*/
$(function(){
    function getonline(){
        $('#users').load('user_online.php', function() {

        });
    }
    setInterval(getonline, 3000);

});

<!-- Menu Toggle Script -->
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

/* ==========================================================================
SYSTEME DE GESTION DES INSCRIPTIONS STEP BY STEP AVEC CHARGEMENT AUTOMATIQUE ET SCROLL INDICATOR
========================================================================== */
/*inscription step by step*/

var current_fs, next_fs, previous_fs;
var left, opacity, scale;/* fieldset properties which we will animate*/

$(".next").click(function(){
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    /*activate next step on progressbar using the index of next_fs*/
    $('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');

    /*show the next fieldset*/
    next_fs.show();
    /*hide the current fiedset with style*/
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
    /*activate next step on progressbar using the index of next_fs*/
    $('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');

    /*show the next fieldset*/
    previous_fs.show();
    /*hide the current fiedset with style*/
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

        /*constructeur et ajout progress bar*/
        var $progressBarContainer = $('<div/>').attr('id', 'progress-bar-container');
        $progressBarContainer.append($('<div/>').attr('id', 'progress-bar'));
        $progressBarContainer.appendTo($('body'));

        /*Ajout container d'élements*/
        var $container = $('<div/>').attr('id', 'progress-bar-elements');
        $container.appendTo($('body'));

        /*parcours des éléménts à prendre en compte pour le chargement*/

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





/*Gestion du scrolling indicator*/
/*$(function() {

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

});*/




/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIE DANS LA ZONE ADMINISTRATION
========================================================================== */
$(function() {

    $('#categorie').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.categorieUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
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
GESTION DE L'AJOUT DES SUJETS(ARTICLES) DANS LA ZONE ADMINISTRATION
========================================================================== */
$(function() {

    $('#blog').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.blogUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
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
GESTION DE L AJOUT DES SERVICES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#servicesDispo').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.servicesDispoUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#servicesDispoRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.servicesDispoUploads').hide();
                }
                else
                {
                    $('.servicesDispoUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Service').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Service').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIES SERVICES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#cat_outils_Tech').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.cat_outils_TechUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#cat_outils_TechRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.cat_outils_TechUploads').hide();
                }
                else
                {
                    $('.cat_outils_TechUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez AJouté une Catégorie d\'outils Techniques').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Catégorie d\'outils Techniques').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DES OUTILS TECHNIQUES DANS LA ZONE SERVICES
========================================================================== */
$(function() {

    $('#outils_Technique').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.outils_TechUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#outils_TechRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.outils_TechUploads').hide();
                }
                else
                {
                    $('.outils_TechUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Outils Technique').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Outils Technique').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});

/* ==========================================================================
GESTION DE L AJOUT DES MODULES-OUTILS COMMUN DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#moduleTechCommun').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.moduleTechCommunUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#moduleTechCommunRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.moduleTechCommunUploads').hide();
                }
                else
                {
                    $('.moduleTechCommunUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Module').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Module').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L AJOUT DES MODULES ADMIN DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#moduleAdmin').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.moduleAdminUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#moduleAdminRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.moduleAdminUploads').hide();
                }
                else
                {
                    $('.moduleAdminUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Module').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Module').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L AJOUT DES CATEGORIES MODULE CLIENT DANS LA ZONE SERVICES
========================================================================== */
$(function() {
    $('#catModuleClient').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.catModuleClientUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#catModuleClientRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.catModuleClientUploads').hide();
                }
                else
                {
                    $('.catModuleClientUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Categorie Module Client').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté une Categorie Module Client').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});

/* ==========================================================================
GESTION DE L'AJOUT DE L'AGENDA DANS LA ZONE CONFIG PAGE
========================================================================== */
$(function() {

    $('#program_annuel').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.agendaUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#agendaRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.agendaUploads').hide();
                }
                else
                {
                    $('.agendaUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté un Nouveau Programme').show();
                    setTimeout(function () {
                        cat.html('Vous avez Ajouté un Nouveau Programme').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L'AJOUT DE L'IMAGE DANS LA ZONE CONFIG PAGE
========================================================================== */
$(function() {

    $('#img').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.imgUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#imgRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.imgUploads').hide();
                }
                else
                {
                    $('.imgUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Image').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Image').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DE L'IMAGE DANS LA ZONE CONFIG PAGE
========================================================================== */
/*$(function() {

    $('#specialite').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
        $('.specialiteUploads').show();
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
                var cat = $('#specialiteRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.imgUploads').hide();
                }
                else
                {
                    $('.specialiteUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Spécialité').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Spécialité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});*/




/* ==========================================================================
GESTION DE L'AJOUT DE L'ACTIVITE ENCOURS
========================================================================== */
$(function() {

    $('#activite').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.activiteUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#activiteRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.activiteUploads').hide();
                }
                else
                {
                    $('.activiteUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Activité').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Activité').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});



/* ==========================================================================
GESTION DE L'AJOUT DE LA CATEGORIE DE SOLUTIONS
========================================================================== */
$(function() {

    $('#cat_solution').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.cat_solutionUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#cat_solutionRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.cat_solutionUploads').hide();
                }
                else
                {
                    $('.cat_solutionUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Categorie').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Categorie').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});


/* ==========================================================================
GESTION DE L'AJOUT DE LA SOLUTION
========================================================================== */
$(function() {

    $('#solution').on('submit', function (e) {
        /*On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.solutionUploads').show();
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /*obligatoire pour de l'upload*/
            processData: false, /*obligatoire pour de l'upload*/
            dataType: 'html', /*selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#solutionRapport');
                if(data != 'success'){
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.solutionUploads').hide();
                }
                else
                {
                    $('.solutionUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    cat.html('Vous avez Ajouté une Nouvelle Solution').show();
                    setTimeout(function () {
                        cat.html('Vous avez AJouté une Nouvelle Solution').slideDown().hide();
                    }, 5000);

                }

            }

        });
    });
});