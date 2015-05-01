<?php
function db_connect() {
	// définition des variables de connexion à la base de données	
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		// INFORMATIONS DE CONNEXION
		$host = 	'localhost';
		$dbname = 	'gamercity';
		$user = 	'gamercity';
		$password = 	'xxxxx';
		$pdo_options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
		// FIN DES DONNEES
		
		$db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);
		return $db;
	} catch (Exception $e) {
		die('Erreur de connexion : ' . $e->getMessage());
	}
}

function xmlToArray($xml, $options = array()) {
    $defaults = array(
        'namespaceSeparator' => ':',//you may want this to be something other than a colon
        'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
        'alwaysArray' => array(),   //array of xml tag names which should always become arrays
        'autoArray' => true,        //only create arrays for tags which appear more than once
        'textContent' => '$',       //key used for the text content of elements
        'autoText' => true,         //skip textContent key if node has no attributes or child nodes
        'keySearch' => false,       //optional search and replace on tag and attribute names
        'keyReplace' => false       //replace values for above search values (as passed to str_replace())
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; //add base (empty) namespace
 
    //get attributes from all namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            //replace characters in attribute name
            if ($options['keySearch']) $attributeName =
                    str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix']
                    . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                    . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }
 
    //get child nodes from all namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            //recurse into child nodes
            $childArray = xmlToArray($childXml, $options);
            list($childTagName, $childProperties) = each($childArray);
 
            //replace characters in tag name
            if ($options['keySearch']) $childTagName =
                    str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            //add namespace prefix, if any
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
 
            if (!isset($tagsArray[$childTagName])) {
                //only entry with this key
                //test if tags of this type should always be arrays, no matter the element count
                $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                        ? array($childProperties) : $childProperties;
            } elseif (
                is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                === range(0, count($tagsArray[$childTagName]) - 1)
            ) {
                //key already exists and is integer indexed array
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                //key exists so convert to integer indexed array with previous value in position 0
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }
 
    //get text content of node
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
 
    //stick it all together
    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
 
    //return node as array
    return array(
        $xml->getName() => $propertiesArray
    );
}


function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

function usertoid($login){
$db = db_connect();
	$query = $db->prepare("SELECT account_id FROM chat_accounts WHERE account_login = :login");
$query->execute(array(
	'login' => $login
));
$data = $query->fetch();
return $data['account_id'];
}

function numvip(){
$db = db_connect();
	$query = $db->prepare("SELECT account_id FROM chat_accounts WHERE account_level = '2'");
$query->execute();
$data = $query->rowCount();
return $data;
}


function user_verified() {
$db = db_connect();
	$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login and account_level != '0' and account_etat >='2'");
$query->execute(array(
	'login' => $_SESSION['login']
));
// On compte le nombre d'entrées
$count=$query->rowCount();
if($count == '1'){	
	return isset($_SESSION['id']);
}else{
	return false;
	}
}

function file_json($file){
if(file_exists($file)){
$info  =  json_decode(@file_get_contents($file),true);
return $info;
}else{
return 'false';
}
}

function veriflive($id){
$content  = file_json('../live'.$id.'.json');
if($content != 'false') {
$etat = $content[0][etat];
}else{
$etat = 0;
}
return $etat;
}

function logintoetat($login){
$db = db_connect();
	$query = $db->prepare("SELECT account_level,account_mute,account_etat,account_vip,account_mute_duree FROM chat_accounts WHERE account_login = :login");
$query->execute(array(
	'login' => $login
));
$data = $query->fetch();
return $data;
}

function json_account($login){
$data  = logintoetat($login);
$ip  = $_SERVER["REMOTE_ADDR"];
$account_donne  =  array(array('login'  => $login,'level'=>$data[account_level],'etat'=>$data[account_etat],'vip'=>$data[account_vip],'mute'=>$data[account_mute],'duree_mute'=>$data[account_mute_duree],'ip'=>$ip,'time'=>time()));
return $account_donne;
}

function verifmute(){
$db = db_connect();
	$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login and account_mute != '0'");
$query->execute(array(
	'login' => $_SESSION['login']
));
// On compte le nombre d'entrées
$count=$query->rowCount();
if($count == '1'){	
	return isset($_SESSION['id']);
}else{
	$_SESSION['id'] = '';
	$_SESSION['login'] = '';
	return false;
	}
}

function urllink($content='') {
		$message = $content;
		$message = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $message);
		$message = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $message);
		$message = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $message);
		$message = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $message);
		/*if($_POST['nom'] == 'Snipy' or $_POST['nom'] == 'Matalia' or $_POST['nom'] == 'Orion'){
			if(preg_match('#\[mute=(.+)\](.+)\[/mute\]#isU', $message, $matches)){
				$dureemute = time() + ( $matches[1] * 60 );
				mysql_query("UPDATE User set mute='$mute',cookie_id='',mute_duree='$dureemute' WHERE Name='$matches[2]'");
				$mute = 'ok';
			}
			if(preg_match('#\[ban\](.+)\[/ban\]#isU', $message, $matches)){
				mysql_query("UPDATE User set Etats='0',cookie_id='' WHERE Name='$matches[1]'");
				$mute = 'ok';
			}
			$message = str_replace(':reglement:', '<a href="http://gamers-city.eu/Reglement.jpg"><span style="color:red;"><strong> Merci de lire le reglement </strong></span></a>', $message);		
		}*/
		$message = str_replace(':)', '<img src="./assets/images/smiley/1.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':snif:', '<img src="./assets/images/smiley/20.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':gba:', '<img src="./assets/images/smiley/17.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':g)', '<img src="./assets/images/smiley/3.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':-)', '<img src="./assets/images/smiley/46.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':snif2:', '<img src="./assets/images/smiley/13.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':bravo:', '<img src="./assets/images/smiley/69.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':d)', '<img src="./assets/images/smiley/4.gif" title="?" alt="?" />', $message);
		$message = str_replace(':hap:', '<img src="./assets/images/smiley/18.gif" title="!" alt="!" />', $message);
		$message = str_replace(':ouch:', '<img src="./assets/images/smiley/22.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':pacg:', '<img src="./assets/images/smiley/9.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':cd:', '<img src="./assets/images/smiley/5.gif" title="triste" alt="triste" />', $message);
		$message = str_replace('::-)))', '<img src="./assets/images/smiley/23.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':ouch2:', '<img src="./assets/images/smiley/57.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':pacd:', '<img src="./assets/images/smiley/10.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':cute:', '<img src="./assets/images/smiley/nyu.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':content:', '<img src="./assets/images/smiley/24.gif" title="?" alt="?" />', $message);
		$message = str_replace(':p)', '<img src="./assets/images/smiley/7.gif" title="!" alt="!" />', $message);
		$message = str_replace(':-p', '<img src="./assets/images/smiley/31.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':noel:', '<img src="./assets/images/smiley/11.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':oui:', '<img src="./assets/images/smiley/37.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':(', '<img src="./assets/images/smiley/45.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':peur:', '<img src="./assets/images/smiley/47.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':question:', '<img src="./assets/images/smiley/2.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':cool:', '<img src="./assets/images/smiley/26.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':-(', '<img src="./assets/images/smiley/14.gif" title="?" alt="?" />', $message);
		$message = str_replace(':coeur:', '<img src="./assets/images/smiley/54.gif" title="!" alt="!" />', $message);
		$message = str_replace(':mort:', '<img src="./assets/images/smiley/21.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':rire:', '<img src="./assets/images/smiley/39.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':-((', '<img src="./assets/images/smiley/15.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':fou:', '<img src="./assets/images/smiley/50.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':sleep:', '<img src="./assets/images/smiley/27.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':-D', '<img src="./assets/images/smiley/40.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':nonnon:', '<img src="./assets/images/smiley/25.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':fier:', '<img src="./assets/images/smiley/53.gif" title="?" alt="?" />', $message);
		$message = str_replace(':honte:', '<img src="./assets/images/smiley/30.gif" title="!" alt="!" />', $message);
		$message = str_replace(':rire2:', '<img src="./assets/images/smiley/41.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':non2:', '<img src="./assets/images/smiley/33.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':sarcastic:', '<img src="./assets/images/smiley/43.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':monoeil:', '<img src="./assets/images/smiley/34.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':o))', '<img src="./assets/images/smiley/12.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':nah:', '<img src="./assets/images/smiley/19.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':doute:', '<img src="./assets/images/smiley/28.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':rouge:', '<img src="./assets/images/smiley/55.gif" title="?" alt="?" />', $message);
		$message = str_replace(':ok:', '<img src="./assets/images/smiley/36.gif" title="!" alt="!" />', $message);
		$message = str_replace(':non:', '<img src="./assets/images/smiley/35.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':malade:', '<img src="./assets/images/smiley/8.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':fete:', '<img src="./assets/images/smiley/66.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':sournois:', '<img src="./assets/images/smiley/67.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':hum:', '<img src="./assets/images/smiley/68.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':ange:', '<img src="./assets/images/smiley/60.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':diable:', '<img src="./assets/images/smiley/61.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':gni:', '<img src="./assets/images/smiley/62.gif" title="?" alt="?" />', $message);
		$message = str_replace(':play:', '<img src="./assets/images/smiley/play.gif" title="!" alt="!" />', $message);
		$message = str_replace(':desole:', '<img src="./assets/images/smiley/65.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':spoiler:', '<img src="./assets/images/smiley/63.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':merci:', '<img src="./assets/images/smiley/58.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':svp:', '<img src="./assets/images/smiley/59.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':sors:', '<img src="./assets/images/smiley/56.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':salut:', '<img src="./assets/images/smiley/42.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':rechercher:', '<img src="./assets/images/smiley/38.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':hello:', '<img src="./assets/images/smiley/29.gif" title="?" alt="?" />', $message);
		$message = str_replace(':up:', '<img src="./assets/images/smiley/44.gif" title="!" alt="!" />', $message);
		$message = str_replace(':bye:', '<img src="./assets/images/smiley/48.gif" title="heureux" alt="heureux" />', $message);
		$message = str_replace(':gne:', '<img src="./assets/images/smiley/51.gif" title="lol" alt="lol" />', $message);
		$message = str_replace(':lol:', '<img src="./assets/images/smiley/32.gif" title="triste" alt="triste" />', $message);
		$message = str_replace(':dpdr:', '<img src="./assets/images/smiley/49.gif" title="cool" alt="cool" />', $message);
		$message = str_replace(':dehors:', '<img src="./assets/images/smiley/52.gif" title="rire" alt="rire" />', $message);
		$message = str_replace(':hs:', '<img src="./assets/images/smiley/64.gif" title="confus" alt="confus" />', $message);
		$message = str_replace(':banzai:', '<img src="./assets/images/smiley/70.gif" title="choc" alt="choc" />', $message);
		$message = str_replace(':bave:', '<img src="./assets/images/smiley/71.gif" title="?" alt="?" />', $message);
		$message = str_replace(':pf:', '<img src="./assets/images/smiley/pf.gif" title="!" alt="!" />', $message);


	$content = stripslashes($message);
	return $content;
}

function genererMDP ($longueur = 10){
    // initialiser la variable $mdp
    $mdp = "";
 
    // Définir tout les caractères possibles dans le mot de passe, 
    // Il est possible de rajouter des voyelles ou bien des caractères spéciaux
    $possible = "012346789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
 
    // obtenir le nombre de caractères dans la chaîne précédente
    // cette valeur sera utilisé plus tard
    $longueurMax = strlen($possible);
 
    if ($longueur > $longueurMax) {
        $longueur = $longueurMax;
    }
 
    // initialiser le compteur
    $i = 0;
 
    // ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
    while ($i < $longueur) {
        // prendre un caractère aléatoire
        $caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
 
        // vérifier si le caractère est déjà utilisé dans $mdp
        if (!strstr($mdp, $caractere)) {
            // Si non, ajouter le caractère à $mdp et augmenter le compteur
            $mdp .= $caractere;
            $i++;
        }
    }
 
    // retourner le résultat final
    return $mdp;
}

function coupe_mot($string, $length = 30, $wrapString = "\n") 
   { 
     $wrapped = ''; 
     $word = ''; 
     $html = false; 
     $string = (string) $string; 
     for($i=0;$i<strlen($string);$i+=1) 
     { 
       $char = $string[$i]; 
       
       /** HTML Begins */ 
       if($char === '<') 
       { 
         if(!empty($word)) 
         { 
           $wrapped .= $word; 
           $word = ''; 
         } 
         
         $html = true; 
         $wrapped .= $char; 
       } 
       
       /** HTML ends */ 
       elseif($char === '>') 
       { 
         $html = false; 
         $wrapped .= $char; 
       } 
       
       /** If this is inside HTML -> append to the wrapped string */ 
       elseif($html) 
       { 
         $wrapped .= $char; 
       } 
       
       /** Whitespace characted / new line */ 
       elseif($char === ' ' || $char === "\t" || $char === "\n") 
       { 
         $wrapped .= $word.$char; 
         $word = ''; 
       } 
       
       /** Check chars */ 
       else 
       { 
         $word .= $char; 
         
         if(strlen($word) > $length) 
         { 
           $wrapped .= $word.$wrapString; 
           $word = ''; 
         } 
       } 
     } 

    if($word !== ''){ 
        $wrapped .= $word; 
    } 
     
     return $wrapped; 
   }
   
function sendmail($desti,$sujet,$texte,$texte_html){

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';

$mail->isSMTP();
$mail->SMTPDebug  = 0;
$mail->Host       = "smtp.gmail.com";
$mail->Port       = "587";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;
$mail->Username   = "snipyromane@gmail.com";
$mail->Password   = "htconemaxdu.4.4";
$mail->addReplyTo("NO-REPLY@Gamers-City.eu", "Gamers-City");
$mail->From       = "NO-REPLY@Gamers-City.eu";
$mail->FromName   = "Gamers-City";
$mail->ConfirmReadingTo=('snipyromane@gmail.com');
$mail->addAddress($desti);
$mail->Subject  = $sujet;
$body = $texte_html;
$mail->WordWrap = 80;
$mail->msgHTML($body, true); //Create message bodies and embed images
$mail->AltBody = $texte;
if ($mail->send()) {
$mail->clearAddresses();
$mail->clearAttachments();
return true;
}else{
return False;
}
}
function sendmaillive($desti,$sujet,$texte,$texte_html){

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';

$mail->isSMTP();
$mail->SMTPDebug  = 0;
$mail->Host       = "smtp.gmail.com";
$mail->Port       = "587";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;
$mail->Username   = "snipyromane@gmail.com";
$mail->Password   = "htconemaxdu.4.4";
$mail->addReplyTo("NO-REPLY@Gamers-City.eu", "Gamers-City");
$mail->From       = "NO-REPLY@Gamers-City.eu";
$mail->FromName   = "Gamers-City";
$mail->addAddress("snipyromane@gmail.com");
foreach($desti as $bccer){
   $mail->AddBCC($bccer);
}
$mail->Subject  = $sujet;
$body = $texte_html;
$mail->WordWrap = 80;
$mail->msgHTML($body, true); //Create message bodies and embed images
$mail->AltBody = $texte;
if ($mail->send()) {
$mail->clearAddresses();
$mail->ClearBCCs();
$mail->clearAttachments();
return true;
}else{
return False;
}
}
//$mail->AddBCC($bcc, "Recepient 1"); // Copie cachée BCC
function live($data){
$db = db_connect();
$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_etat = '2' ");
$query->execute();
$i = '0';
while($data = $query->fetch()){
if(filter_var($data[account_email], FILTER_VALIDATE_EMAIL)){
$mail[$i] = $data[account_email];
$i++;
}
}
$sujet = "Nouveau live en cours !";
$message_txt = "Bonjour , un nouveaux live viens de demarrer. sur http://www.gamers-city.eu/?p=live".$data."";
$message_html = "<html><head></head><body><b>Bonjour </b>, un nouveaux live viens de demarrer, <a href='http://www.gamers-city.eu/?p=live".$data."'>acceder au live</a>.</body></html>";

sendmaillive($mail,$sujet,$message_txt,$message_html);
}
?>