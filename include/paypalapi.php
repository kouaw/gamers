<?php
$paypal_conf='1';
if($paypal_conf == '0'){
	/******   SERVEUR DE TESTS  ******/
	$serveur_paypal = "https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";
}else{
	/******   SERVEUR DE PRODUCTION ******/
	$serveur_paypal = "https://www.paypal.com/webscr&cmd=_express-checkout&token=";
}

function construit_url_paypal()
  {
	$paypal_conf='1';  
	if($paypal_conf == '0'){
		/******   DONNEES DE TESTS  ******/
		$api_paypal = 'https://api-3t.sandbox.paypal.com/nvp?';
		$user = 'pierreyvespary-facilitator_api1.gmail.com';
		$pass = 'SMH7SCZYWQRCSNGJ';
		$signature = 'AUGXYZRjWKfuRXTMoSDhAReKA-6sA0k0TEhTO1p6TDOB9QJzZUHevG7e';
	}else{
		/******   DONNEES DE PRODUCTION ******/
		$api_paypal = 'https://api-3t.paypal.com/nvp?';
		$user = 'snipyromane_api1.hotmail.com';
		$pass = 'LML725CS7PTWTKZQ';
		$signature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31A8SXcKypIC2wPRlVHc6ACHml5gDz';
	}
	$version = 121.0; // Version de l'API

	$api_paypal = $api_paypal.'VERSION='.$version.'&USER='.$user.'&PWD='.$pass.'&SIGNATURE='.$signature; // Ajoute tous les paramètres

	return 	$api_paypal; // Renvoie la chaîne contenant tous nos paramètres.
  }
function recup_param_paypal($resultat_paypal)
  {
	$liste_parametres = explode("&",$resultat_paypal); // Crée un tableau de paramètres
	foreach($liste_parametres as $param_paypal) // Pour chaque paramètre
	{
		list($nom, $valeur) = explode("=", $param_paypal); // Sépare le nom et la valeur
		$liste_param_paypal[$nom]=urldecode($valeur); // Crée l'array final
	}
	return $liste_param_paypal; // Retourne l'array
  }
?>