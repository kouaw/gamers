<?php
session_start();
require('./PHPMailer-master/PHPMailerAutoload.php');
include('functions.php');
$db = db_connect();
$func = $_GET['func'];
$login = $_GET['login'];
$id_tchat = $_GET['id_tchat'];
$titre = $_GET['titre'];
$color = '#'.$_GET['color'];
if($color != '' and $func == 'pseudo'){
		$update = $db->prepare('UPDATE chat_accounts SET account_color = :color WHERE account_login = :user');
		$update->execute(array(
			'color' => $color,
			'user' => $_SESSION['login']
		));	
		$_SESSION['colorp'] = $color;
}
if($login != ''){
if($func == 'mute'){
		$update = $db->prepare('UPDATE chat_accounts SET account_mute = :etat , account_mute_duree = :time WHERE account_login = :user');
		$update->execute(array(
			'etat' => '0',
			'time' => '240',
			'user' => $login
		));
}elseif($func == 'unmute'){
		$update = $db->prepare('UPDATE chat_accounts SET account_mute = :etat , account_mute_duree = :time  WHERE account_login = :user');
		$update->execute(array(
			'etat' => '1',
			'time' => '',
			'user' => $login
		));
}elseif($func == 'ban'){
		$update = $db->prepare('UPDATE chat_accounts SET account_etat = :etat , account_level = :etat , account_mute = :etat WHERE account_login = :user');
		$update->execute(array(
			'etat' => '0',
			'user' => $login
		));
}elseif($func == 'deban'){
		$update = $db->prepare('UPDATE chat_accounts SET account_etat = :etat , account_level = :level , account_mute = :etat WHERE account_login = :user');
		$update->execute(array(
			'etat' => '2',
			'level' => '1',
			'user' => $login
		));
}elseif($func == 'modo'){
		$update = $db->prepare('UPDATE chat_accounts SET account_level = :etat ,account_mute = :etat WHERE account_login = :user');
		$update->execute(array(
			'etat' => '3',
			'user' => $login
		));
}elseif($func == 'demodo'){
		$update = $db->prepare('UPDATE chat_accounts SET account_level = :etat ,account_mute = :etat WHERE account_login = :user');
		$update->execute(array(
			'etat' => '1',
			'user' => $login
		));
		}
}elseif($id_tchat != ''){
	if($func == 'clean'){
		unlink('chat'.$id_tchat.'.json');
		unlink('online'.$id_tchat.'.json');
	}elseif($func == 'titre'){
		$db = db_connect();
		$query = $db->prepare("UPDATE streamer_etat set title = :titre where id = :streamer");
		$query->execute(array(
			'titre' => $titre,
			'streamer' => $id_tchat));
		$pushbullet->device("#gamercity")->pushNote("Live ".$titre."", "Nouveaux live sur".$titre."");
	}elseif($func == 'live'){
		$db = db_connect();
		$query = $db->prepare("UPDATE streamer_etat set title = :titre where id = :streamer");
		$query->execute(array(
			'titre' => $titre,
			'streamer' => $id_tchat
		));
		$pushbullet->device("#gamercity")->pushNote("Live ".$titre."", "Nouveaux live sur".$titre."");
		live($id_tchat);
	}elseif($func == 'annonce'){
						$message = json_encode(array($titre));
						$monfichier = @fopen('annonce'.$id_tchat.'.json', 'w+');
						fputs($monfichier, $message); // On écrit le nouveau nombre de pages vues
						fclose($monfichier);
	}
}
?>