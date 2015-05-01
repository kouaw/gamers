<?php
include('functions.php');
$id_tchat = $_GET[idtchat];
if($id_tchat != ''){
	$data = file_json('annonce'.$id_tchat.'.json');
	if($data != 'false'){
		$json['messages'] = $data[0];
	}
	echo json_encode($json);
}
?>