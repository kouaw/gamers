<?php
include('include/functions.php');
$streamer = $_GET['stream'];
$etat = $_GET['etat'];
$fichier = $_GET['fichier'];
						//$content = json_decode(@file_get_contents('live'.$streamer.'.json'),true);
						$nejson = array(array('etat' => $etat,'titre' => '', 'date' => time(), 'fichier' => $fichier));
					/*	if(file_exists("live".$streamer.".json")){
						$message = json_encode(array_merge($nejson,$content));
						}else{*/
						$message = json_encode($nejson);
						//}
						$monfichier = fopen('live'.$streamer.'.json', 'w+');
						fputs($monfichier, $message); // On �crit le nouveau nombre de pages vues
						fclose($monfichier);
?>