<?php
error_reporting(0);
include('functions.php');
$login = $_GET['login'];
$xmlNode = simplexml_load_file('http://www2.gamers-city.eu:8080/stats');
$arrayData = xmlToArray($xmlNode);
$date = json_encode($arrayData);
$json = json_decode($date);
if($login == 'snipy'){
$daily = json_decode(file_get_contents("https://api.dailymotion.com/video/x153ng0?fields=audience?"));
$dailyn = $daily->{'audience'};
$dedie = $json->{'rtmp'}->{'server'}->{'application'}[2]->{'live'}->{'nclients'};
$hitbox = json_decode(file_get_contents("http://api.hitbox.tv/media/list/snipy44?embed=true"));
$hitboxn = $hitbox->{'livestream'}[0]->{'media_is_live'};
$twitch = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/gamers_city"));
$twitchn = $twitch->{'stream'}->{'viewers'};
$gaming = json_decode(file_get_contents("https://api.gaminglive.tv/channels/snipy44"));
$gamingn = $gaming->{"state"}->{'viewers'};
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
}elseif($login == 'ben'){
$twitch = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/benzaie"));
$twitchn = $twitch->{'stream'}->{'viewers'};
$view = intval($twitchn);
if(is_numeric($view) == 'true'){
echo $view;
}else{
echo '0';
}
}else{
echo '0';
}
?>