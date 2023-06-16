<?php
require '../../App/Config/Config_Server.php';
session_start();

// Extrait les informations correspondantes à la page en cours de la DB
foreach(\App::getDB()->query('
         SELECT * FROM headers 
         INNER JOIN page
         ON headers.id_headers=page.ref_id_headers
         WHERE id_page=1') as $con):
    $_ENV['logo'] = $con->logo;
    $_ENV['titre'] = $con->titre;

endforeach;
?>



<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<html lang="fr">
<body>
<div id="map"></div>

<script>
    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        }
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(3.8667, 11.5167),
            zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('https://bertin.dev/AppWebPerso@Project-v2.0/Administrator/map/user-map-traitement.php', function(data) {
            var xml = data.responseXML;

            var markers = xml.documentElement.getElementsByTagName('marker');

            Array.prototype.forEach.call(markers, function(markerElem) {
                var id_visitor = markerElem.getAttribute('id_visitor');
                var ip_visitor = markerElem.getAttribute('ip_visitor');
                var continent = markerElem.getAttribute('continent');
                var pays = markerElem.getAttribute('pays');
                //var ville = markerElem.getAttribute('ville');
                var region = markerElem.getAttribute('region');
                var region_name = markerElem.getAttribute('region_name');
                var time_zone = markerElem.getAttribute('time_zone');
                var symbole = markerElem.getAttribute('symbole');
                var statut_visitor = markerElem.getAttribute('statut_visitor');
                var heure_arrive_visitor = markerElem.getAttribute('heure_arrive_visitor');
                var heure_depart = markerElem.getAttribute('heure_depart');
                var duree = markerElem.getAttribute('duree');
                var convert_money_in_fcfa = markerElem.getAttribute('convert_money_in_fcfa');

                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('latitude')),
                    parseFloat(markerElem.getAttribute('longitude')));

                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = region

                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = pays

                infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    //label: icon.label
					icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
                });

                marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });
        });
    }



    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHJoJ4lJ-tcIDUZ2Qbi6EYKnlXvK8wx2I&callback=initMap">
</script>
</body>
</html>
	
	