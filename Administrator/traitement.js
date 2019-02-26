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

