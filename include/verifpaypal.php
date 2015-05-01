<?php
session_start();
include("paypalapi.php");
include('functions.php');
$requete = construit_url_paypal();
$requete = $requete."&METHOD=GetExpressCheckoutDetails".
			"&TOKEN=".htmlentities($_GET['TOKEN'], ENT_QUOTES); // Ajoute le jeton

$ch = curl_init($requete);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resultat_paypal = curl_exec($ch);

if (!$resultat_paypal) // S'il y a une erreur
	{echo "<p>Erreur</p><p>".curl_error($ch)."</p>";}
// S'il s'est exécuté correctement
else
{
	$liste_param_paypal = recup_param_paypal($resultat_paypal);
if( $_GET['TOKEN'] == $_SESSION[TOKENPAYPAL] and $_SESSION[AMTPAYPAL] == $liste_param_paypal['AMT'] and $liste_param_paypal['PAYMENTREQUESTINFO_0_TRANSACTIONID'] == $liste_param_paypal['PAYMENTREQUEST_0_TRANSACTIONID'] and $_GET['TOKEN'] == $liste_param_paypal['TOKEN'] and $liste_param_paypal['AMT'] == $liste_param_paypal['PAYMENTREQUEST_0_AMT']){
	// Si la requête a été traitée avec succès
$db = db_connect();			
	// Mise à jour de la base de données & traitements divers... Exemple :
$query = $db->prepare("INSERT INTO `gamercity`.`log_achat` (`id`, `token`, `email`, `account`, `CORRELATIONID`, `time`, `transactionid`) VALUES ('', :token, :email, :account, :correl, :time, :transac)");
$query->execute(array(
	'token' => $liste_param_paypal['TOKEN'],
	'email' => $liste_param_paypal['EMAIL'],
	'account' => $liste_param_paypal['CUSTOM'],
	'correl' => $liste_param_paypal['CORRELATIONID'],
	'time' => $liste_param_paypal['TIMESTAMP'],
	'transac' => $liste_param_paypal['PAYMENTREQUESTINFO_0_TRANSACTIONID']
));	
$query = $db->prepare("UPDATE chat_accounts set account_level = :level, account_vip = :vip WHERE account_id = :account ");
$query->execute(array(
	'level' => '2',
	'vip' => '1',
	'account' => $liste_param_paypal['CUSTOM']
));	
		header("Location: ?p=index");
		exit();	
}
}
curl_close($ch);
?>