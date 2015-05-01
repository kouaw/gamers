<?php
session_start();
include("paypalapi.php");
$requete = construit_url_paypal();
$requete = $requete."&METHOD=SetExpressCheckout".
			"&CANCELURL=".urlencode("http://www.gamers-city.eu/").
			"&RETURNURL=".urlencode("http://www.gamers-city.eu/newsd/include/paypalretour.php").
			"&AMT=5.0".
			"&CURRENCYCODE=EUR".
			"&DESC=".urlencode("Achat compte VIP 1 mois.").
			"&CUSTOM=".$_SESSION['id'].
			"&LOCALECODE=FR";

// Initialise notre session cURL. On lui donne la requête à exécuter
$ch = curl_init($requete);

// Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné. 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// On lance l'exécution de la requête URL et on récupère le résultat dans une variable
$resultat_paypal = curl_exec($ch);

// S'il y a une erreur, on affiche "Erreur", suivi du détail de l'erreur.
if (!$resultat_paypal)
	{echo "<p>Erreur</p><p>".curl_error($ch)."</p>";}

else // S'il s'est exécuté correctement, on effectue les traitements...
{
    $liste_param_paypal = recup_param_paypal($resultat_paypal); // Lance notre fonction qui dispatche le résultat obtenu en un array

		// On affiche le tout pour voir que tout est OK.
		echo "<pre>";
		print_r($liste_param_paypal);
		echo "</pre>";
			// Si la requête a été traitée avec succès
		if ($liste_param_paypal['ACK'] == 'Success')
		{
			// Redirige le visiteur sur le site de PayPal
			header("Location: ".$serveur_paypal.$liste_param_paypal['TOKEN']);
					exit();
		}
		else // En cas d'échec, affiche la première erreur trouvée.
		{echo "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";}		
	}


// On ferme notre session cURL.
curl_close($ch);
?>