<?php
session_start();
include('functions.php');
$db = db_connect();
if($_SESSION['login'] != '' and $_SESSION['id'] != '') {

if(verifmute() ){
	if(isset($_POST['message']) AND !empty($_POST['message']) and isset($_POST['id_tchat'])) {	
		/* On teste si le message ne contient qu'un ou plusieurs points et
		qu'un ou plusieurs espaces, ou s'il est vide. 
			^ -> début de la chaine - $ -> fin de la chaine
			[-. ] -> espace, rien ou point 
			+ -> une ou plusieurs fois
		Si c'est le cas, alors on envoie pas le message */
		if(!preg_match("#^[-. ]+$#", $_POST['message'])) {			
		$content = json_decode(@file_get_contents('chat'.$_POST[id_tchat].'.json'),true);
		$message = htmlspecialchars($_POST['message']);
				preg_match('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $message, $url);
// EDIT THIS: your auth parameters
$username = 'livesin';
$password = '8gotrunks8';

// EDIT THIS: the query parameters
$url     = $url[0]; // URL to shrink
//$keyword = 'ozh';                        // optional keyword
//$title   = 'Super blog!';                // optional, if omitted YOURLS will lookup title with an HTTP request
$format  = 'json';                       // output format: 'json', 'xml' or 'simple'

// EDIT THIS: the URL of the API file
$api_url = 'http://www.gamers-city.eu/YOURLS/yourls-api.php';

// Init the CURL session
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $api_url );
curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
		'url'      => $url,
		'format'   => $format,
		'action'   => 'shorturl',
		'username' => $username,
		'password' => $password
	) );

// Fetch and return content
$data = json_decode(curl_exec($ch));
curl_close($ch);

// Do something with the result. Here, we just echo it.
$message = preg_replace('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="http://www.gamers-city.eu/YOURLS/'.$data->{url}->{keyword}.'" target="_blank">http://www.gamers-city.eu/YOURLS/'.$data->{url}->{keyword}.'</a>', $message);		

			//$message = $_SESSION['login']." : ".$_POST['message']."\r\n";
			/*$query = $db->prepare("SELECT * FROM chat_messages WHERE message_user = :user and message_tchat = :id_tchat ORDER BY message_time DESC LIMIT 0,1");
			$query->execute(array(
				'id_tchat' => $_POST['id_tchat'],
				'user' => $_SESSION['id']
			));
			$count = $query->rowCount();
			$data = $query->fetch();
			// Vérification de la similitude*/
			if($_POST['login'] == 'bot'){
						$nejson = array(array("/!\ Bot /!", $message, time(),$_SESSION[level],$_SESSION[colorp]));
						if(file_exists("chat".$_POST[id_tchat].".json")){
						$message = json_encode(array_merge($nejson,$content));
						}else{
						$message = json_encode($nejson);
						}
						$monfichier = @fopen('chat'.$_POST[id_tchat].'.json', 'w+');
						fputs($monfichier, $message); // On écrit le nouveau nombre de pages vues
						fclose($monfichier);
						echo true;
						$_SESSION['mute'] = '0';	
			}
			$key = @recursive_array_search($_SESSION['login'],$content);			
			if($key !=='FALSE')
				@similar_text($content[$key][1], $message, $percent);

			if($percent < 80) {
			if($key === 'false'){
			
			}else{
			$nb_min = preg_match_all('/[a-z]/', $message, $res);
			$nb_maj = preg_match_all('/[A-Z]/', $message, $res);
			if(($nb_maj / strlen( $message ) * 100 ) < 50){
				// Vérification de la date du dernier message.
				//if(time()-5 >= $content[$key][2]) {
				

		if($mute != 'ok'){
						/*$insert = $db->prepare('
							INSERT INTO chat_messages (message_id, message_user, message_time, message_text, message_tchat) 
							VALUES(:id, :user, :time, :text, :id_tchat)
						');
						$insert->execute(array(
							'id_tchat' => $_POST['id_tchat'],
							'id' => '',
							'user' => $_SESSION['id'],
							'time' => time(),
							'text' => $message
						));*/
						$nejson = array(array($_SESSION[login], $message, time(),$_SESSION[level],$_SESSION[colorp]));
						if(file_exists("chat".$_POST[id_tchat].".json")){
						$message = json_encode(array_merge($nejson,$content));
						}else{
						$message = json_encode($nejson);
						}
						$monfichier = @fopen('chat'.$_POST[id_tchat].'.json', 'w+');
						fputs($monfichier, $message); // On écrit le nouveau nombre de pages vues
						fclose($monfichier);
						echo true;
						$_SESSION['mute'] = '0';
					}else{
					echo true;
					}
				/*} else{
					echo 'Votre dernier message est trop récent. Baissez le rythme :D';	}*/
				}else{
				echo 'Votre dernier message compte beaucoup trop de majuscule.';	}
				}
			} else{
				echo 'Votre dernier message est très similaire.';	}
	} else{
		echo 'Votre message est vide.';	}
			} else{
		echo 'Votre message est vide.';	}
}else{
	$_SESSION['mute'] = '1';
	echo 'Vous etes muter.'; }
		} else {
	echo 'Vous devez être connecté.';
	}
?>