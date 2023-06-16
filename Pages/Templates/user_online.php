<?php


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


      //ECRITURE DANS LE FICHIER JOURNAL
     $visiteur = fopen('../../Administrator/journal/visiteur.txt', 'a+');
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
        [time(), $data1['ip_visitor']]);

    /* \App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
         [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);*/
}

//$data->closeCursor();
// On modifie les membres qui ne sont pas sur le chat,
// donc qui n'ont pas actualisé automatiquement ce fichier récemment
$time_out = time()-5;
\App::getDB()->update('UPDATE all_visitor SET heure_depart = ? WHERE heure_arrive_visitor < ?',
    [time(), $time_out]);

?>