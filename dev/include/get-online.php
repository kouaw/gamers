<?php
session_start();
include('functions.php');
$id_tchat = $_GET['id_tchat'];
$data = file_json('online'.$id_tchat.'.json');
if($data != 'false'){
	$i = '0';
	$json['error'] = '0';
	while($i <= count($data)){
		if($_SESSION['level'] >= '3'){
			$infos["etat"] = $data[$i][2];
			$infos["mute"] = $data[$i][4];
		}else{
			$infos["etat"] = '';
			$infos["mute"] = '';	
		}
		if($data[$i][0] != ''){
		$infos["login"] = $data[$i][0];
		
		// Enfin on enregistre le tableau des infos de CE MEMBRE
		// dans la [i �me] colonne du tableau des comptes 
		$accounts[$i] = $infos;
		}
		$i++;
	}
	$json['list'] = $accounts;
}else{
	$json['error'] = '1';
}
echo json_encode($json);
?>