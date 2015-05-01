function insertLogin(login) {
	var $message = $("#message");
	var loginok = login[0].toUpperCase() + login.substring(1);
	$message.val($message.val() + loginok + '> ').focus();
}

function insertLogin2(login) {
	var $message = $("#message");
	var loginok = login[0].toUpperCase() + login.substring(1);
	$message.val($message.val() + loginok + '> ').focus();
	hideModal();
}

function passCode(login) {
	var $message = $("#message");
	$message.val($message.val() + login + '').focus();
}

function nompropre(mot) {
      var m=mot.charAt(0).toUpperCase() +
       mot.substring(1).toLowerCase();
      return m;
   }

/*function mute() {
	$.('Pseudo a mute').prompt(function(e){ var login = e.response;})
	$.get('./include/get-modo.php?login=' + login + '&func=mute');
}

function unmute() {
	$.('Pseudo a unmute').prompt(function(e){ var login = e.response;})
	$.get('./include/get-modo.php?login=' + login + '&func=unmute');
}

function ban() {
	$.('Pseudo a mute').prompt(function(e){ var login = e.response;})
	$.get('./include/get-modo.php?login=' + login + '&func=ban');
}

function deban() {
	$.('Pseudo a mute').prompt(function(e){ var login = e.response;})
	$.get('./include/get-modo.php?login=' + login + '&func=deban');
}*/

function clean(){
	$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&func=clean');
}

function regle(){
	$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&func=regle');
}
	function color (couleur){
		$.get('./include/get-modo.php?func=pseudo&color='+couleur);
	}
	function fullscreen(){
		$('#live-cadre').toggleClass('grid_16').toggleClass('grid_24');
		$('#sidebar').toggleClass('hide');
		$('#video').toggleClass('full').toggleClass('nofull');
	}
/*function titre(){
	$.('Titre du live').prompt(function(e){ var titre = e.response;})
	$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&action=titre&titre='+ titre);
}*/
var reloadTime = 1500;
var reloadTime2 = 10800;
var scrollBar = false;

function annonce(){
	//on recup l'annonce
	var id_tchat = encodeURIComponent($("#id_tchat").val());
	$.getJSON('./include/get-annonce.php?idtchat='+id_tchat, function(data) {
		if(data['messages'] != 'null'){
			$.ajax({
				type: "POST",
				url: "./include/post-message.php",
				data: "message="+encodeURIComponent(data['messages'])+"&id_tchat="+id_tchat+"pseudo=bot"
			});	
		}
	});
}
	function getlive(){
		$.get('./include/get-live.php?id=1', function(data) {
			if(data == '1'){
				$('#live-snipy').attr({src: './assets/images/icons/1.png', alt: 'On air', width: '12px', height: '12px'});
				$('#video2').removeClass('hidem');
				$('#video3').removeClass('hidem');
				$('#video4').removeClass('hidem');
				$('#video5').removeClass('hidem');
				$('#video6').removeClass('hidem');
				$('#livei2').html('');
			}else if (data == '2'){
				$('#live-snipy').attr({src: './assets/images/icons/1.png', alt: 'On air', width: '12px', height: '12px'});
				$('#video2').addClass('hidem');
				$('#video3').addClass('hidem');
				$('#video4').addClass('hidem');
				$('#video5').addClass('hidem');
				$('#video6').addClass('hidem');	
				$('#livei2').html('<a id="video7">Flux indepent</a>');
			}else{
				$('#live-snipy').attr({src: './assets/images/icons/' + data + '.png', alt: 'Off air', width: '12px', height: '12px'});
				$('#video2').addClass('hidem');
				$('#video3').addClass('hidem');
				$('#video4').addClass('hidem');
				$('#video5').addClass('hidem');
				$('#video6').addClass('hidem');	
				$('#livei2').html('');
			}
		});
		$.get('./include/get-live.php?id=2', function(data) {
			if(data == '1'){
				$('#live-ben').attr({src: './assets/images/icons/1.png', alt: 'On air', width: '12px', height: '12px'});
			}else{
				$('#live-ben').attr({src: './assets/images/icons/' + data + '.png', alt: 'Off air', width: '12px', height: '12px'});
			}
		});
	}
	function infosnip(){
		var hitbox;
		var twitch;
		var daily;
		var dedie;
		var view;
		$.get("./include/get-view.php?login=snipy", function(data) {
			 var dedie = parseFloat(data,10);
			 if(isNaN(dedie) !== 'true'){
				$('#listm').html('<span class="octicon octicon-person"></span> <a id="lmembres"><span id="numco" class="odometer">' + dedie + '</span></a>');
			 }
			});
  }
	function infoben(){
		var hitbox;
		var twitch;
		var daily;
		var dedie;
		var view;
		$.get("./include/get-view.php?login=ben", function(data) {
			 var dedie = parseFloat(data,10);
			 if(isNaN(dedie) !== 'true'){
				$('#listm').html('<span class="octicon octicon-person"></span> <a id="lmembres"><span id="numco" class="odometer">' + dedie + '</span></a>');
			 }
			});
  }
function getMessages() {
	// On lance la requête ajax
	$.getJSON('./include/get-message.php?idtchat='+$("#id_tchat").val(), function(data) {
			/* On vérifie que error vaut 0, ce
			qui signifie qu'il n'y aucune erreur */
			if(data['error'] == '0') {
				// On intialise les variables pour le scroll jusqu'en bas
				// Pour voir les derniers messages
				var container = $('#text');
  				var content = $('#messages_content');
				var height = content.height()-200;
				var toBottom;

				// Si avant l'affichage des messages, on se trouve en bas, 
				// alors on met toBottom a true afin de rester en bas				
				// Il faut tester avant affichage car après, le message a déjà été
				// affiché et c'est aps facile de se remettre en bas :D
				if(container[0].scrollTop == height)
					toBottom = true;
				else
					toBottom = false;

				//$("#annonce").html('<span class="info"><b>'+data['annonce']+'</b></span><br /><br />');
				$("#text").html(data['messages']);
				console.log(data['messages']);

				// On met à jour les variables de scroll
				// Après avoir affiché les messages
  				content = $('#messages_content');
				height = content.height()-200;
				
				// Si toBottom vaut true, alors on reste en bas
				if(toBottom == true)
					container[0].scrollTop = content.height();	
  
  				// Lors de la première actualisation, on descend
   				if(scrollBar != true) {
					container[0].scrollTop = content.height();
					scrollBar = true;
				}	
			} else if(data['error'] == 'unlog') {
				/* Si error vaut unlog, alors l'utilisateur connecté n'a pas
				de compte. Il faut le rediriger vers la page de connexion */
				$("#text").html('Vous n\'etes pas connecté');
				$(location).attr('href',"?p=index");
			}
	});
}

function postMessage() {
	// On lance la requête ajax
	// type: POST > nous envoyons le message

	// On encode le message pour faire passer les caractères spéciaux comme +
	var message = encodeURIComponent($("#message").val());
	var id_tchat = encodeURIComponent($("#id_tchat").val());
	$.ajax({
		type: "POST",
		url: "./include/post-message.php",
		data: "message="+message+"&id_tchat="+id_tchat,
		success: function(msg){
			// Si la réponse est true, tout s'est bien passé,
			// Si non, on a une erreur et on l'affiche
			if(msg == true) {
				// On vide la zone de texte
				$("#message").val('');
				$("#responsePost").slideUp("slow").html('');
			} else
				$("#responsePost").html(msg).slideDown("slow");
			// on resélectionne la zone de texte, en cas d'utilisation du bouton "Envoyer"
			$("#message").focus();
		},
		error: function(msg){
			// On alerte d'une erreur
			alert('Erreur');
		}
	});
}

function getOnlineUsers() {
	// On lance la requête ajax
	var id_tchat = encodeURIComponent($("#id_tchat").val());
	$.getJSON('./include/get-online.php?id_tchat='+id_tchat, function(data) {
		// Si data['error'] renvoi 0, alors ça veut dire que personne n'est en ligne
		// ce qui n'est pas normal d'ailleurs
		if(data['error'] == '0') {		
			var online = '', i = 1, image, text, count = 0;
			// On parcours le tableau inscrit dans
			// la colonne [list] du tableau JSON
			for (var id in data['list']) {
				
				// On met dans la variable text le statut en toute lettre
				// Et dans la variable image le lien de l'image
				//if(data["list"][id]["status"] == 'busy') {
				//	text = 'Occup&eacute;';
				//	image = 'busy';
				//} else if(data["list"][id]["status"] == 'inactive') {
				//	text = 'Absent';
				//	image = 'inactive';
				//} else {
				//	text = 'En ligne';
				//	image = 'active';
				//}
				// On affiche d'abord le lien pour insérer le pseudo dans la zone de texte
				if(data['list'][id]["etat"] != '' && data['list'][id]["mute"] != ''){
				if(data['list'][id]["etat"] == '0'){
					online += '<a onclick="unban(\''+data['list'][id]["login"]+'\')"> bannie </a>';
				}else if (data['list'][id]["etat"] >= '2'){
					online += ' <img src="assets/images/icons/moderator_icon.jpg" width="18px" height="18px"  title="moderateur" /> ';
				}else{
					online += '<a onclick="ban(\''+data['list'][id]["login"]+'\')"> <img src="assets/images/icons/ban.png" width="18px" height="18px" title="bannir" /> </a>';
				}
				if(data['list'][id]["mute"] != '0'){
					online += '<a href = "#post" onclick="mute(\''+data['list'][id]["login"]+'\')"> <img src="assets/images/icons/Media-Controls-Mute-icon.png" width="18px" height="18px" title="muter pendant 3min" /> </a>';
				}
				
				}
				online += '<a href="#post" onclick="insertLogin(\''+data['list'][id]["login"]+'\')" title="'+data['list'][id]["login"]+'">';
				// Ensuite on affiche l'image
				//online += '<img src="status-'+image+'.png" /> ';
				// Enfin on affiche le pseudo
				online += nompropre(data['list'][id]["login"]);
				
				// Si i vaut 1, ça veut dire qu'on a affiché un membre
				// et qu'on doit aller à la ligne			
				if(i == 1) {
					i = 0;	
					//count = 0;
					online += '</a><br>';
				}
				count++;
				i++;		
			}
			$("#users").html(online);
			//$("#numco").text(count);
			
		} else if(data['error'] == '1')
			$("#users").html('<span style="color:gray;">Aucun utilisateur connect&eacute;.</span>');
			//$("#numco").text(' '+count+' ');
	});
}


function rmResponse() {
	$("#statusResponse").html('');
}