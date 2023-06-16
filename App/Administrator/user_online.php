<?php
session_start();
require '../App/Config/Config_Server.php';
require '../vendor/autoload.php';
use \GeoIp2\Database\Reader;


//recuperation de la veritable adresse ip du visiteur
function get_ip(){

    //IP si internet partagé
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }


    //IP derriere un proxy
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    //IP normal
    else{
        return isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
    }
}

//https://packagist.org/packages/geoip2/geoip2; https://dev.maxmind.com/geoip/;
function geoIpCity(){
    try {
        $reader = new Reader('../App/DataBaseIP/GeoLite2-City.mmdb');
    } catch (\MaxMind\Db\Reader\InvalidDatabaseException $e) {
    }
// Replace "city" with the appropriate method for your database, e.g.,
// "country".
    try {
        $record = $reader->city(get_ip());
    } catch (\GeoIp2\Exception\AddressNotFoundException $e) {
    } catch (\MaxMind\Db\Reader\InvalidDatabaseException $e) {
    }

    print($record->country->isoCode . "\n"); // 'US'
    print($record->country->name . "\n"); // 'United States'
    print($record->country->names['zh-CN'] . "\n"); // '美国'

    print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
    print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

    print($record->city->name . "\n"); // 'Minneapolis'

    print($record->postal->code . "\n"); // '55455'

    print($record->location->latitude . "\n"); // 44.9733
    print($record->location->longitude . "\n"); // -93.2323
}


//detection du pays de provenance de  l'IP   http://www.geoplugin.net/json.gp?ip=128.101.101.101
$geoplugin = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip='. get_ip()));


// On vérifie que l'utilisateur est inscrit dans la base de données
$data = \App::getDB()->query('SELECT * FROM online_user WHERE ip_visiteur="'.get_ip().'" ',__CLASS__, true);



/* On compte le nombre d'entrées*/
$count = \App::getDB()->rowCount('SELECT ip_visiteur FROM online_user WHERE ip_visiteur ="'.get_ip().'" ');

	/* si l'utilisateur n'est pas inscrit dans la BDD, on l'ajoute, sinon
	on modifie la date de ça derniere actualisation */
	if($count == 0) {

		 \App::getDB()->insert('INSERT INTO online_user (ip_visiteur, continent, pays, ville, region, region_name, time_zone, symbole, statut_visiteur, heure_arrive_visiteur, latitude, longitude) 
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [get_ip(), $geoplugin->geoplugin_continentName, $geoplugin->geoplugin_countryName, $geoplugin->geoplugin_city, $geoplugin->geoplugin_region, $geoplugin->geoplugin_regionName,
             $geoplugin->geoplugin_timezone, $geoplugin->geoplugin_currencySymbol, 2, time(), $geoplugin->geoplugin_latitude, $geoplugin->geoplugin_longitude]);

           $visiteur = fopen('journal/visiteur.txt', 'a+');
           fputs($visiteur, get_ip(). ' - '.$geoplugin->geoplugin_countryName.' - '.$geoplugin->geoplugin_city.' - ' .date('d/m/Y H:i:s')."\n");
          // fseek($visiteur, 5);
           fclose($visiteur);

       /* $ip = \App::getDB()->query('SELECT ip_visiteur FROM visiteur ORDER BY id_visiteur DESC
                           ',__CLASS__, true);*/


        /*\App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
            [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);*/


	} else {
	    \App::getDB()->update('UPDATE online_user SET heure_arrive_visiteur = ? WHERE ip_visiteur = ?',
        [time(), $data['ip_visiteur']]);

       /* \App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
            [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);*/
	}

//$data->closeCursor();
// On supprime les membres qui ne sont pas sur le chat,
// donc qui n'ont pas actualisé automatiquement ce fichier récemment
$time_out = time()-5;
$delete = \App::getDB()->delete('DELETE FROM online_user WHERE heure_arrive_visiteur < :time', ['time' => $time_out]);

// Récupère les membres en ligne sur le chat
// et retourne une liste
$query = \App::getDB()->query('SELECT * FROM online_user WHERE statut_visiteur ="2" ORDER BY heure_arrive_visiteur
                           ');
// On compte le nombre de membres
//$count = $query->rowCount();
/* Si au moins un membre est connecté, on l'affiche.
Sinon, on affiche un message indiquant que personne n'est connecté */
$counteur = \App::getDB()->rowCount('SELECT * FROM online_user WHERE statut_visiteur ="2" ORDER BY heure_arrive_visiteur');


if($counteur != 0) {
		$i = 0;
    //on compte le nombre de membres en ligne
    $rslt01=\App::getDB()->prepare('SELECT count(*) As nbrs_connecte FROM online_user WHERE statut_visiteur=:online_status', array('online_status' =>2), __CLASS__, true);
    echo '<h4 align="left">En ligne('. $rslt01['nbrs_connecte'] .')</h4>';

		foreach ($query as $retour):

            if($retour->statut_visiteur == '0') {
                $status = 'inactive';
            } elseif($retour->statut_visiteur == '1') {
                $status = 'busy';
            } elseif($retour->statut_visiteur == '2') {
                $status = 'active';
            }

            // On enregistre dans la colonne [status] du tableau
            // le statut du membre : busy, active ou inactive (occupé, en ligne, absent)
            $infos["status"] = $status;

            // Et on enregistre dans la colonne [login] le pseudo
            $infos["ip"] = $retour->ip_visiteur;

            // Enfin on enregistre le tableau des infos de CE MEMBRE
            // dans la [i ème] colonne du tableau des comptes
            $accounts[$i] = $infos;
            $i++;


            ?>
            <script>
                function test(test)
                {
                    window.document.formulaire.message.value += '' + test + ' ';
                    document.getElementById('message').focus();
                }
            </script>

            <div align="left">
                <a href="#" title="En ligne" style="color:white;text-decoration:none;font-weight:bold; font-size: 10px" onclick="test('[g][color=green]<?= $retour->ip_visiteur;?> => [/color][/g]');return(false)">
                    <small><?=$geoplugin->geoplugin_countryName;?><br><q><?=$geoplugin->geoplugin_city;?></q></small>
                    <img src="../Public/img/homme.png" height="40px" width="40px" class="img-rounded"> IP: <?= $retour->ip_visiteur;?></a>
                </a>
            </div>
            <?php
        endforeach;

} else {
	// Il y a une erreur, aucun membre dans la liste
	echo "Aucun connecté";
}


/* -------------------------------------INSERTION OU MODIFICATION DES UTILISATEUR CONNECTES SUR LE SITE -----------*/
// On vérifie que l'utilisateur est inscrit dans la base de données
$data1 = \App::getDB()->query('SELECT * FROM all_visitor WHERE ip_visitor="'.get_ip().'" ',__CLASS__, true);



/* On compte le nombre d'entrées*/
$count1 = \App::getDB()->rowCount('SELECT ip_visitor FROM all_visitor WHERE ip_visitor ="'.get_ip().'" ');

/* si l'utilisateur n'est pas inscrit dans la BDD, on l'ajoute, sinon
on modifie la date de ça derniere actualisation */
if($count1 == 0) {

    \App::getDB()->insert('INSERT INTO all_visitor (ip_visitor, continent, pays, ville, region, region_name, time_zone, symbole, statut_visitor, heure_arrive_visitor, heure_depart, duree, latitude, longitude, convert_money_in_fcfa) 
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [get_ip(), $geoplugin->geoplugin_continentName, $geoplugin->geoplugin_countryName, $geoplugin->geoplugin_city, $geoplugin->geoplugin_region, $geoplugin->geoplugin_regionName,
        $geoplugin->geoplugin_timezone, $geoplugin->geoplugin_currencySymbol, 2, time(), 0, 0, $geoplugin->geoplugin_latitude, $geoplugin->geoplugin_longitude, $geoplugin->geoplugin_currencyConverter]);
} else {
    \App::getDB()->update('UPDATE all_visitor SET heure_arrive_visitor = ? WHERE ip_visitor = ?',
        [time(), $data1['ip_visiteur']]);

    /* \App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
         [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);*/
}

//$data->closeCursor();
// On supprime les membres qui ne sont pas sur le chat,
// donc qui n'ont pas actualisé automatiquement ce fichier récemment
$time_out = time()-5;
\App::getDB()->update('UPDATE all_visitor SET heure_depart = ? WHERE heure_arrive_visitor < ?',
    [time(), $time_out]);

?>