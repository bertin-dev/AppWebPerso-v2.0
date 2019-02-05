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
GESTION DU SYSTEME DE RECUPERATION DU MOT DE PASSE
========================================================================== */