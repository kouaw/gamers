<?php
session_start();
function cree_cookies($hash){
	if(setcookie('Connexion_auto', $hash, time() + 90 * 24 * 60 * 60) == 'true'){
	return true;
	}else{
	return false;
	}
}
function redirect($url){
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=$url\">";
	exit();
}
include('./.config/.config.php');
require('./include/PHPMailer-master/PHPMailerAutoload.php');
include('./include/functions.php');
include('./include/Pushbullet.php');
require_once("./include/paypalapi.php");
$pushbullet = new Pushbullet('RQh8t9y4IMaFrUDkdylgWMzuQcAryBos:');
$db = db_connect();
// Appel de la fonction de connexion à la base de données
$query = $db->prepare("
	SELECT online_id, online_id, online_user, online_status, online_time, account_id, account_login
	FROM chat_online 
	LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_online.online_user 
	ORDER BY account_login
");
$query->execute();
// On compte le nombre de membres
$conline = $query->rowCount();
if($_COOKIE['Connexion_auto'] != ''){
	$query = $db->prepare("
		SELECT *
		FROM chat_accounts
		WHERE account_cookie = :cookie
	");
	$query->execute(
	array(
		'cookie' => $_COOKIE['Connexion_auto']
	));
	if($query->rowCount() == '1'){
		$data = $query->fetch();
		$_SESSION['id'] = $data['account_id'];
		// On crée une session time qui prend la valeur de la date de connexion
		$_SESSION['time'] = time();
		//information de base
		$_SESSION['login'] = $data['account_login'];
		$_SESSION['level'] = $data['account_level'];
		$_SESSION['avatar'] = $data['account_avatar'];
		$_SESSION['credit'] = $data['account_credit'];
		$_SESSION['vip'] = $data['account_vip'];
		$_SESSION['etat'] = $data['account_etat'];
		$_SESSION['key'] = $data['account_key'];
		$_SESSION['mute'] = $data['account_mute'];
		$ip = $_SERVER['REMOTE_ADDR'];	
		$_SESSION['ip'] = $ip;
		//information de customisation
		$_SESSION['disgn'] = $data['account_disgn'];
		$_SESSION['colorp'] = $data['account_color'];
	}
}
echo "<!-- $_SESSION[level] $_SESSION[grade] $_SESSION[login] -->";
$stream = (array_key_exists($_GET['stream'], $array_stream)) ? htmlentities($_GET['stream']) : 'snipy'  ;
$p = (!empty($_GET['p'])) ? htmlentities($_GET['p']) : 'index';
if(!array_key_exists($p, $array_pages)) $page = './page/index.php';
elseif(!is_file($array_pages[$p])) $page = './page/404.php';
else $page = $array_pages[$p];
include('include/header.php');
include('include/menu.php');
/*if($p == 'index'){
	include('include/theme.php');
}*/
include($page); // Insertion de la page requise
include('include/footer.php');
?>