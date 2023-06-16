/**
 * Created by Supers-Pipo on 22/03/2018.
 */


/*-------------------------------(FREELANCE)-GESTION DU FORMULAIRE D'ENREGISTREMENT STEP BY STEP -------*/



$(function () {





    $('#msform input').focus(function () {
        $('#statut').fadeOut(800);
    });

    //verification si l'entite est ok ou a déjà été utilisé
    $('#entite').keyup(function () {
        check_entite();
    });


    /*$('#next0').on('click', function () {
     if()


    });*/

    //verification si la valeur de l'entite est ok ou a déjà été utilisé
    $('#valeurEntite').keyup(function () {
        check_valeurEntite();
    });





    //verification si l'activite est ok ou a déjà été utilisé
    $('#activite').keyup(function () {
        check_activite();
    });

    //verification si la ville est ok ou a déjà été utilisé
    $('#ville').keyup(function () {
        check_ville();
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
    $('#fonctionnalites').keyup(function () {
        check_fonctionnalites();
    });

    //verification si la capture est ok ou a déjà été utilisé
    $('#capture').keyup(function () {
       // check_capture();
    });

    //fonction de verification de l'entite en ajax
    function check_entite() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'entite': $('#entite').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkentite').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkentite').css('color', 'red').html(data);
                }
            }
        });


    }


    //fonction de verification de la valeur de l'entite en ajax
    function check_valeurEntite() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'valeurEntite': $('#valeurEntite').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkvaleur').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkvaleur').css('color', 'red').html(data);
                }
            }
        });
    }



    //fonction de verification de l'activite en ajax
    function check_activite() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'activite': $('#activite').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkactivite').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkactivite').css('color', 'red').html(data);
                }
            }
        });
    }


//fonction de verification de la ville en ajax
    function check_ville() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'ville': $('#ville').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checkville').html('<img src="../Public/img//icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checkville').css('color', 'red').html(data);
                }
            }
        });
    }


    //fonction de verification de travaux en ajax
    function check_travaux() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'travaux': $('#travaux').val()
            },
            success: function (data) {
                if(data=='success'){
                    $('#output_checktravaux').html('<img src="../Public/img/icons/check.png" title="validé" width="15" class="small_image" alt=""> ');
                    return true;
                }
                else{
                    $('#output_checktravaux').css('color', 'red').html(data);
                }
            }
        });
    }



    //fonction de verification de l'entite en ajax
    function check_app_dev() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
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
                url: '../Core/Controller/verification.php?freelance=freelance',
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
            url: '../Core/Controller/verification.php?freelance=freelance',
            data: {
                'fonctionnalites': $('#fonctionnalites').val()
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
    function check_capture() {
        $.ajax({
            type: 'post',
            url: '../Core/Controller/verification.php?freelance=freelance',
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
    }

});



/*-------------------------------------FIN--------------------------------------------------------*/


$(document).ready(function () {


    $('#msform').submit(function () {
        var statut1 = $('#statut');
        var dateF1 = $('#dateF').val(), typeService1 = $('#typeService').val(), entite1 = $('#entite').val();
        var valeur1 = $('#valeurEntite').val(), activite1 = $('#activite').val(), ville1 = $('#ville').val(),
            travaux1 = $('#travaux').val();
        var app_dev1 = $('#app_dev').val(), type_app1 = $('#type_app').val(), architecture1 = $('#architecture').val(),
            analyse1 = $('#analyse').val(), ide1 = $('#ide').val();
        var langage1 = $('#langage').val(), sgbd1 = $('#sgbd').val(), outils1 = $('#outils').val(),
            framework1 = $('#framework').val(), url1 = $('#url').val(), fonctionnalites1 = $('#fonctionnalites').val(),
            capture1 = $('input[type=file]')[0].files[0];
        var send = $('#enreg').val();


        if (dateF1 == '' || typeService1 == '' || entite1 == '' || valeur1 == '' || activite1 == '' || ville1 == '' || travaux1 == ''
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
                url: '../Core/Controller/submit.php?freelance=freelance',
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
                    $('#enreg').attr('value', 'Traitement en cours...');
                },
                success: function (data) {
                    if(data != 'success'){
                        statut1.html(data).fadeIn(400);
                        $('#enreg').attr('value', 'Envoyer');
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
                            $(location).attr('href',"freelance.php");
                        }, 10000);
                    }
                }

            });

        }


    });

    /*----------------------------------FIN DE SUBMIT-----------------------------------*/


});