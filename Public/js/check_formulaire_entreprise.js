/**
 * Created by Supers-Pipo on 11/06/2018.
 */


/*-------------------------------(FREELANCE)-GESTION DU FORMULAIRE D'ENREGISTREMENT STEP BY STEP -------*/



$(function () {

    $('#msform input').focus(function () {
        $('#statutE').fadeOut(800);
    });

    //verification si l'entreprise est ok ou a déjà été utilisé
    $('#entreprise1').keyup(function () {
        check_entreprise();
    });

    //verification si l'activite est ok ou a déjà été utilisé
    $('#activite').keyup(function () {
        check_activite();
    });

    //verification si la ville est ok ou a déjà été utilisé
    $('#ville').keyup(function () {
        check_ville();
    });

    //verification si la section est ok ou a déjà été utilisé
    $('#section').keyup(function () {
        check_section();
    });

    //verification si le matricule est ok ou a déjà été utilisé
    $('#matricule').keyup(function () {
        check_matricule();
    });

    //verification si le poste est ok ou a déjà été utilisé
    $('#poste').keyup(function () {
        check_poste();
    });

    //verification si les travaux sont ok ou a déjà été utilisé
    $('#travaux').keyup(function () {
        check_travaux();
    });

    //verification si l'app_dev est ok ou a déjà été utilisé
    $('#app_dev').keyup(function () {
        check_app_dev();
    });

    //verification si le type d'app est ok ou a déjà été utilisé
    $('#type_app').keyup(function () {
        check_type_app();
    });


    //verification si l'architecture est ok ou a déjà été utilisé
    $('#architecture').keyup(function () {
        check_architecture();
    });

    //verification si l'analyse est ok ou a déjà été utilisé
    $('#analyse').keyup(function () {
        check_analyse();
    });

    //verification si l'ide est ok ou a déjà été utilisé
    $('#ide').keyup(function () {
        check_ide();
    });

    //verification si le langage est ok ou a déjà été utilisé
    $('#langage').keyup(function () {
        check_langage();
    });

    //verification si le sgbd est ok ou a déjà été utilisé
    $('#sgbd').keyup(function () {
        check_sgbd();
    });

    //verification si l'outil est ok ou a déjà été utilisé
    $('#outils').keyup(function () {
        check_outils();
    });

    //verification si le framework est ok ou a déjà été utilisé
    $('#framework').keyup(function () {
        check_framework();
    });

    //verification si l' url est ok ou a déjà été utilisé
    $('#url').keyup(function () {
        check_url();
    });


    //verification si deploiement est ok ou a déjà été utilisé
    $('#deploiement').keyup(function () {
        check_deploiement();
    });

    //verification si la taille est ok ou a déjà été utilisé
    $('#taille').keyup(function () {
        check_taille();
    });

    //verification si les fonctionnalites sont ok ou a déjà été utilisé
    $('#detail').keyup(function () {
        check_fonctionnalites();
    });

    //verification si la capture est ok ou a déjà été utilisé
    $('#capture').keyup(function () {
        // check_capture();
    });

    //fonction de verification de l'entite en ajax
    function check_entreprise() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'entreprise': $('#entreprise1').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkEntreprise').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkEntreprise').css('color', 'red').html(data);
                }
            }
        });


    }


    //fonction de verification de l'activite en ajax
    function check_activite() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'activite': $('#activite').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkActivite').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkActivite').css('color', 'red').html(data);
                }
            }
        });
    }


//fonction de verification de la ville en ajax
    function check_ville() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'ville': $('#ville').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkVille').html('<img src="../Public/img//icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkVille').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de la section en ajax
    function check_section() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'section': $('#section').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkSection').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkSection').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de travaux en ajax
    function check_matricule() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'matricule': $('#matricule').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkMatricule').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkMatricule').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de travaux en ajax
    function check_poste() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'poste': $('#poste').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkPost').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkPost').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de travaux en ajax
    function check_travaux() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'travaux': $('#travaux').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkTravaux').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkTravaux').css('color', 'red').html(data);
                }
            }
        });
    }



    //fonction de verification de l'entite en ajax
    function check_app_dev() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'app_dev': $('#app_dev').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkappdev').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkappdev').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_type_app() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'type_app': $('#type_app').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checktype_app').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checktype_app').css('color', 'red').html(data);
                }
            }
        });
    }



    //fonction de verification de l'entite en ajax
    function check_architecture() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'architecture': $('#architecture').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkarchitecture').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkarchitecture').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de l'entite en ajax
    function check_analyse() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'analyse': $('#analyse').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkanalyse').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkanalyse').css('color', 'red').html(data);
                }
            }
        });
    }

//fonction de verification de l'entite en ajax
    function check_ide() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'ide': $('#ide').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkide').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkide').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de l'entite en ajax
    function check_langage() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'langage': $('#langage').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checklangage').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checklangage').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_sgbd() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'sgbd': $('#sgbd').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checksgbd').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checksgbd').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_outils() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'outils': $('#outils').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkoutils').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkoutils').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_framework() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'framework': $('#framework').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkframework').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkframework').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_url() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'url': $('#url').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkurl').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkurl').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification du Deploiement en ajax
    function check_deploiement() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'deploiement': $('#deploiement').val()
            },
            success: function (data) {
                if (data == 'success') {
                    $('#output_checkDeploiement').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                } else {
                    $('#output_checkDeploiement').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de la taille en ajax
    function check_taille() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'taille': $('#taille').val()
            },
            success: function (data) {
                if (data == 'success') {
                    $('#output_checkTaille').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                } else {
                    $('#output_checkTaille').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de l'entite en ajax
    function check_fonctionnalites() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'detail': $('#detail').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkfonctionnalites').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkfonctionnalites').css('color', 'red').html(data);
                }
            }
        });
    }

    //fonction de verification de l'entite en ajax
    /*function check_capture() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?entreprise=entreprise',
            data: {
                'capture': $('#capture').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkcapture').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkcapture').css('color', 'red').html(data);
                }
            }
        });
    }*/

});



/*-------------------------------------FIN--------------------------------------------------------*/


$(document).ready(function () {


    $('.msformE').submit(function () {
        var statut1 = $('#statutE');
        var dateF1 = $('#dateE').val(), typeService1 = $('#typeService').val(), entreprise = $('#entreprise1').val();
        var activite1 = $('#activite').val(), ville1 = $('#ville').val();

        var section = $('#section').val(), matricule = $('#matricule').val(), poste = $('#poste').val(), travaux1 = $('#travaux').val();

        var app_dev1 = $('#app_dev').val(), type_app1 = $('#type_app').val(), architecture1 = $('#architecture').val(),
            analyse1 = $('#analyse').val(), ide1 = $('#ide').val();

        var langage1 = $('#langage').val(), sgbd1 = $('#sgbd').val(), outils1 = $('#outils').val(),
            framework1 = $('#framework').val(), url1 = $('#url').val(), fonctionnalites1 = $('#detail').val(),
            capture1 = $('input[type=file]')[0].files[0];

        var send = $('#enregE').val();


        if (dateF1 == '' || typeService1 == '' || entreprise == '' ||  activite1 == '' || ville1 == '' || travaux1 == '' ||
            section == '' || matricule == '' || poste == ''
            || app_dev1 == '' || type_app1 == '' || architecture1 == '' || analyse1 == ''
            || ide1 == '' || langage1 == '' || sgbd1 == '' || outils1 == '' || framework1 == '' ||
            url1 == '' || fonctionnalites1 == '' || capture1 == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
        }
        else {
            var $form = $(this);
            var formdata = (window.FormData) ? new FormData($form[0]) : null;
            var donnee = (formdata !== null) ? formdata : $form.serialize();
            //var form = $('form').get(0);

            /*formData.append('dateF', dateF1);
            formData.append('typeServiceF', typeService1);
            formData.append('entiteF', entite1);
            formData.append('valeurEntite', valeur1);
            formData.append('activiteF', activite1);
            formData.append('ville', ville1);
            formData.append('travaux', travaux1);
            formData.append('app_dev', app_dev1);
            formData.append('type_app', type_app1);
            formData.append('architecture', architecture1);
            formData.append('analyse', analyse1);
            formData.append('ide', ide1);
            formData.append('langage', langage1);
            formData.append('sgbd', sgbd1);
            formData.append('outils', outils1);
            formData.append('framework', framework1);
            formData.append('url', url1);
            formData.append('fonctionnalites', fonctionnalites1);
            formData.append('capture', capture1);*/
            //formData.append('send', send);

            $.ajax({
                type: 'post',
                url: '../Core/Controller/submit.php?entreprise=entreprise',
                contentType: false, // obligatoire pour de l'upload
                processData: false, // obligatoire pour de l'upload
                data: donnee,
                /*data: {
                    'dateF1' : dateF1, 'typeService1' : typeService1, 'entite1' : entite1, 'valeur1' : valeur1,
                    'activite1' : activite1, 'ville1' : ville1, 'travaux1' : travaux1, 'app_dev1' : app_dev1,
                    'type_app1' : type_app1, 'architecture1' : architecture1, 'analyse1' : analyse1,
                    'ide1' : ide1, 'langage1' : langage1, 'sgbd1' : sgbd1, 'outils1' : outils1,
                    'framework1' : framework1, 'url1' : url1, 'fonctionnalites1' : fonctionnalites1, 'capture1' : capture1,
                    'send': send
                },*/
                beforeSend: function () {
                    $('#enregE').attr('value', 'Traitement en cours...');
                },
                success: function (data) {
                    if(data != 'success'){
                        statut1.html(data).fadeIn(400);
                        $('#enregE').attr('value', 'Envoyer');
                    }
                    else {
                        $('#msform').hide();
                        var element = document.createElement('div'),
                            affText = document.createTextNode('Votre Enregistrement a été Effectué avec succès !');
                        element.id = 'msform';
                        element.setAttribute('title', 'Enregistrement Terminé');
                        element.appendChild(affText);
                        document.body.appendChild(element);
                        $('#msform').html('<p>Un Email a été envoyé à toutes les personnes ayant une adresse dans notre base de données </p>').css('width', 'inherit').fadeIn(400);
                        setTimeout(function () {
                            $(location).attr('href',"entreprise.php");
                        }, 10000);
                    }
                }

            });

        }


    });

    /*----------------------------------FIN DE SUBMIT-----------------------------------*/


});