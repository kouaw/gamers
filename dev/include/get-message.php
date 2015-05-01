<?php
session_start();
include('functions.php');
$db = db_connect();
/* unmute auto */
$unmuteUser = $db->prepare("UPDATE chat_accounts set account_mute='1',account_mute_duree='' WHERE account_mute='1' and account_mute_duree<=:muteduree ");
$unmuteUser->execute(array(
	'muteduree' => time()
));	
// creation et gestion du fichier liste de membres
$id_tchat = $_GET['idtchat'];
$time_out = time()-120;
$infouser = $db->prepare('
			SELECT * FROM chat_accounts WHERE account_login = :login
		');
		$infouser->execute(array(
			'login' => $_SESSION['login']
		));
$infouser = $infouser->fetch();
$data = file_json('online'.$id_tchat.'.json');
/*if(is_array($data) == 'false'){
$data = 'false';
unlink('online'.$id_tchat.'.json');
}*/
if($data != 'false' and is_array($data) == 'true'){
	$i = 0;
	while($i <= count($data)){
		if($data[$i][0] == $_SESSION[login]){
			$data[$i][1] = time();
			$data[$i][2] = $infouser['account_level'];
			$data[$i][3] = $infouser['account_etat'];
			$data[$i][4] = $infouser['account_mute'];
			$log = 'ok';
		}
		if($data[$i][1] < $time_out){
			unset($data[$i]);
		}
		$i++;
	}
	$data = array_values($data);
	if($log != 'ok'){
		$nejson = array(array($_SESSION[login], time(),$_SESSION[level],$_SESSION['etat'],$_SESSION['mute']));
		$data = array_merge($data,$nejson);
	}
	$message = json_encode($data);
}else{
	$nejson = array(array($_SESSION[login], time(),$_SESSION[level],$_SESSION['etat'],$_SESSION['mute']));
	$message = json_encode($nejson);
}
	$monfichier = @fopen('online'.$id_tchat.'.json', 'w+');
	fputs($monfichier, $message); // On écrit le nouveau nombre de pages vues
	fclose($monfichier);
//fin de la creation du fichier liste de membres connecté

if($_SESSION['login'] == '' or $_SESSION['id'] == '' or $infouser['level'] == '0' or $infouser['etat'] == '0' ) {
	// On indique qu'il y a une erreur de type unlog
	// donc que l'utilisateur connecté n'a pas de compte
	$json['error'] = 'unlog';
	// On supprime les sessions
	session_unset();
    session_destroy();
    session_write_close();
} else {
	// On indique qu'il n'y a aucune erreur
	$json['error'] = '0';
	/* On effectue la requête sur la table contenant les messages. On récupère
	les 100 derniers messages. Enfin, on affiche le tout. */

	/* Si vous voulez faire appraître les messages depuis l'actualisation
	de la page, laissez l'AVANT-DERNIERE ligne de la requete, sinon, supprimez-la */
	/*$query = $db->prepare("
		SELECT message_id, message_user, message_time, message_text, account_id, account_login, account_level
		FROM chat_messages
		LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_messages.message_user
		WHERE chat_messages.message_tchat = :id_tchat
		ORDER BY message_time DESC Limit 30
	");
	$query->execute(array(
		'id_tchat' => $_GET['idtchat']
	));
	$count = $query->rowCount();*/

	if(file_exists("chat".$_GET[idtchat].".json")) {
	 	$donne = json_decode(file_get_contents('chat'.$_GET[idtchat].'.json',true));
		$json['messages'] = '<div id="messages_content" style="height=200px;text-align:left;" >';
		// On crée un tableau qui continendra notre...tableau
		// Afin de placer les messages en bas du chat
		// On triche un peu mais c'est plus simple :D
		$json['messages'] .= '<ul class="lines" valign="bottom" style=" line-height: 24px; ">';


			 $i  = "0";
			 $nb = "1";
						while($i <= '40'){
						if($donne[$i][0]  != ""){
			// On supprime les balises HTML
			$message = nl2br($donne[$i][1]); 
			if(stristr($message,$donne[$i][0]) and $donne[$i][0] == $_SESSION['login']){
				$alert = 'ok';
			}
			// On transforme les liens en URLs cliquables
			$message = coupe_mot(urllink($message));
			if($nb == '1'){
				if($alert == 'ok'){
					$text .= '<li class="first tchatli bg-alert" style="	margin-top: 0px;">';
				}else{
					$text .= '<li class="first tchatli " style="	margin-top: 0px;">';
				}
			}elseif($nb == '41'){
				if($alert == 'ok'){
					$text .= '<li class="last tchatli bg-alert" style="	margin-top: 0px;">';
				}else{
					$text .= '<li class="last tchatli bg-clair" style="	margin-top: 0px;">';
				}
			}else{
				if($nb%2 == 1){
					if($alert == 'ok'){
						$text .= '<li class="tchatli bg-alert">';
					}else{
						$text .= '<li class="tchatli ">';
					}
				}else{
					if($alert == 'ok'){
						$text .= '<li class="tchatli bg-alert">';
					}else{
						$text .= '<li class="tchatli bg-clair">';
					}
				}
			}
			// Si le dernier message est du même membre, on écrit pas de nouveau son pseudo
			if($prev != $donne[$i][0] /*or $mute != 'ok'*/) {
				// contenu du message
				if($donne[$i][4] != ''){
					if($donne[$i][4] == '#FF0000'){
						$color = 'red-tchatcolor';
					}elseif($donne[$i][4] == '#008000'){
						$color = 'tchatcolor1';
					}elseif($donne[$i][4] == '#B22222'){
						$color = 'tchatcolor2';
					}elseif($donne[$i][4] == '#FF7F50'){
						$color = 'tchatcolor3';
					}elseif($donne[$i][4] == '#9ACD32'){
						$color = 'tchatcolor4';
					}elseif($donne[$i][4] == '#00FF7F'){
						$color = 'tchatcolor5';
					}elseif($donne[$i][4] == '#2E8B57'){
						$color = 'tchatcolor6';
					}elseif($donne[$i][4] == '#DAA520'){
						$color = 'tchatcolor7';
					}elseif($donne[$i][4] == '#D2691E'){
						$color = 'tchatcolor8';
					}elseif($donne[$i][4] == '#5F9EA0'){
						$color = 'tchatcolor9';
					}elseif($donne[$i][4] == '#1E90FF'){
						$color = 'tchatcolor10';
					}elseif($donne[$i][4] == '#FF69B4'){
						$color = 'tchatcolor11';
					}elseif($donne[$i][4] == '#8A2BE2'){
						$color = 'tchatcolor12';
					}
				}else{
					if($icolor == '1' or $icolor == ''){
						$color = 'default-tchatcolor1';
						$icolor++;
					}elseif($icolor == '2'){
						$color = 'default-tchatcolor2';
						$icolor++;
					}elseif($icolor == '3'){
						$color = 'default-tchatcolor3';
						$icolor = '1';
					}
				}
				if( $donne[$i][3] >= '2' ){
					$text .= '<img src="./assets/images/icons/moderator_icon.png" title="Moderateur" /> ';
				}
				if( $donne[$i][3] == '2' ){
					$text .= '<img src="./assets/images/icons/vip.gif" title="VIP" /> ';
				}
				$text .= '<a href="#post" onclick="insertLogin(\''.addslashes($donne[$i][0]).'\')" class="'.$color.'">';
				$text .= date('[H:i]', $donne[$i][2]);
				$text .= '&nbsp;<span class="'.$color.'">'. ucfirst(strtolower($donne[$i][0])).'</span>  : ';
				$text .= '</a>';	
			}
				

			// On ajoute le message en remplaçant les liens par des URLs cliquables
			$text .= '<p>'.$message.'<br /></p>';
			$text .= '</li>';

			
			$prev = $donne[$i][0];
			$i++;
			}else{
			$i++;
			}
			$nb++;
		}
			
		/* On crée la colonne messages dans le tableau json
		qui contient l'ensemble des messages */
		$json['messages'] .= $text;

		$json['messages'] .= '</ul>';
		$json['messages'] .= '</div>';			
	} else {
		$json['messages'] = 'Aucun message n\'a été envoyé pour le moment.';
	}
}

// Encodage de la variable tableau json et affichage
echo json_encode($json);
?>