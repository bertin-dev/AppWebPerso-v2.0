<?php
session_start();
require '../App/Config/Config_Server.php';



// On vérifie que l'utilisateur est inscrit dans la base de données
$data = \App::getDB()->query('SELECT * FROM online_user WHERE ip_visiteur="'.$_SERVER["REMOTE_ADDR"].'" ',__CLASS__, true);



/* On compte le nombre d'entrées*/
$count = \App::getDB()->rowCount('SELECT ip_visiteur FROM online_user WHERE ip_visiteur ="'.$_SERVER["REMOTE_ADDR"].'" ');


	/* si l'utilisateur n'est pas inscrit dans la BDD, on l'ajoute, sinon
	on modifie la date de ça derniere actualisation */
	if($count == 0) {

		 \App::getDB()->insert('INSERT INTO online_user (ip_visiteur, statut_visiteur, heure_arrive_visiteur) 
			VALUES(?, ?, ?)', [$_SERVER["REMOTE_ADDR"], 2, time()]);

       /* $ip = \App::getDB()->query('SELECT ip_visiteur FROM visiteur ORDER BY id_visiteur DESC
                           ',__CLASS__, true);*/


        \App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
            [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);


	} else {
	    \App::getDB()->update('UPDATE online_user SET heure_arrive_visiteur = ? WHERE ip_visiteur = ?',
        [time(), $data['ip_visiteur']]);

        \App::getDB()->update('UPDATE page SET ref_ip_visiteur = ? WHERE id_page = ?',
            [$_SERVER["REMOTE_ADDR"], $_SESSION['id_page']]);
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
                <a href="#" title="En ligne" style="color:red;text-decoration:none;font-weight:bold;" onclick="javascript:test('[g][color=green]<?= $retour->ip_visiteur;?> => [/color][/g]');return(false)">
                    <img src="../Public/img/homme.png" height="50px" width="50px" class="img-rounded"> IP: <?= $retour->ip_visiteur;?>
                </a>
            </div>
            <?php
        endforeach;

} else {
	// Il y a une erreur, aucun membre dans la liste
	echo "Il y actuellement aucun connecté";
}



?>