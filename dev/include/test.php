<?php
include('functions.php');
$login = $_GET['login'];
$xmlNode = simplexml_load_file('http://www2.gamers-city.eu:8080/stats');
$arrayData = xmlToArray($xmlNode);
$date = json_encode($arrayData);
$json = json_decode($date);
$db = db_connect();//ouverture connexion sql
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=:stream");
	$query->execute(
	array(
	'stream' => $login
	));
	$stream_info = $query->fetch();
$id_stream = "live_".$stream_info[link_dedie];
$i = '0';
while($i <= count($json->{'rtmp'}->{'server'}->{'application'})){
	/*if($json->{'rtmp'}->{'server'}->{'application'}[$i]->{'name'} == $id_stream){
		$dedie = $json->{'rtmp'}->{'server'}->{'application'}[$i]->{'live'}->{'nclients'};
		$i = '10';
	}else{
		$i++;
	}*/
	if($json->{'rtmp'}->{'server'}->{'application'}[$i]->{'name'} == $id_stream){
	echo $json->{'rtmp'}->{'server'}->{'application'}[$i]->{'name'};
	$i = count($json->{'rtmp'}->{'server'}->{'application'});
	}else{
		$i++;
	}
	
}
?>