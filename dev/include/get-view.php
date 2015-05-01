<?php
if($_GET['debug'] == '1'){
	
}else{
error_reporting(0);
}
include('functions.php');
$login = $_GET['login'];
$xmlNode = simplexml_load_file('http://www2.gamers-city.eu:8080/stats');
$arrayData = xmlToArray($xmlNode);
$date = json_encode($arrayData);
$json = json_decode($date);
if($_GET[debug] == '1'){
	print_r($json);
}
$db = db_connect();//ouverture connexion sql
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=:stream");
	$query->execute(
	array(
	'stream' => $login
	));
	$stream_info = $query->fetch();
if($stream_info[hitbox] != ''){
	$hitbox = json_decode(file_get_contents("http://api.hitbox.tv/media/list/".$login."?embed=true"));
	$hitboxn = $hitbox->{'livestream'}[0]->{'media_is_live'};
}
if($stream_info[twitch] != ''){
	$twitch = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/".$login.""));
	$twitchn = $twitch->{'stream'}->{'viewers'};
}
if($stream_info[gamelife] != ''){
	$gaming = json_decode(file_get_contents("https://api.gaminglive.tv/channels/".$login.""));
	$gamingn = $gaming->{"state"}->{'viewers'};
}
if($stream_info[daily_video] != ''){
	$daily = json_decode(file_get_contents("https://api.dailymotion.com/video/".$stream_info['daily_video']."?fields=audience?"));
	$dailyn = $daily->{'audience'};
}
if($stream_info[link_dedie] != ''){
$id_stream = "live_".$stream_info[link_dedie];
$i = '0';
while($i <= count($json->{'rtmp'}->{'server'}->{'application'})){
	if($json->{'rtmp'}->{'server'}->{'application'}[$i]->{'name'} == $id_stream){
	$dedie = $json->{'rtmp'}->{'server'}->{'application'}[$i]->{'live'}->{'nclients'};
	$i = count($json->{'rtmp'}->{'server'}->{'application'});
	}else{
		$i++;
	}
	
}
if($_GET[debug] == '1'){
	echo $dedie;
}
}
$view = '0';
if($dailyn != '0'){
	$view = $view + $dailyn; 
}
if($dedie != '0'){
	$view = $view + $dedie; 
}
if($hitbox != '0'){
	$view = $view + $hitbox; 
}
if($twitchn != '0'){
	$view = $view + $twitchn; 
}
if($gamingn != '0'){
	$view = $view + $gamingn; 
}
$view = intval($view);
if(is_numeric($view) == 'true'){
echo $view;
}else{
echo '0';
}
?>