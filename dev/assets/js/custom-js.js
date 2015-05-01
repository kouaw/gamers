$(document).ready(function(){
/*-----------------------------------------------------------------------------------*/
/*  Menu 
/*-----------------------------------------------------------------------------------*/
	$(".jmb-title").msgbox({
		title: 'Choix titre live',
		type: 'prompt',
		content: 'Titre du live: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&func=titre&titre='+ titre);
			$('.titlelive').html(titre);
		}
	});
	$(".jmb-annonce").msgbox({
		title: 'Annonce pendant le live',
		type: 'prompt',
		content: 'Annonce du live: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&func=annonce&titre='+ titre);
			$('.titlelive').html(titre);
		}
	});
	$(".jmb-live").msgbox({
		title: 'Choix titre live',
		type: 'prompt',
		content: 'Titre du live: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?id_tchat=' + $("#id_tchat").val() + '&func=live&titre='+ titre);
			$('.titlelive').html(titre);
		}
	});
	$(".jmb-ban").msgbox({
		title: 'Bannir une personne',
		type: 'prompt',
		content: 'Pseudo a bannir: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=ban&login='+ titre);
		}
	});
	$(".jmb-unban").msgbox({
		title: 'Debannir une personne',
		type: 'prompt',
		content: 'Pseudo a debannir: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=deban&login='+ titre);
		}
	});
	$(".jmb-mute").msgbox({
		title: 'Mute une personne',
		type: 'prompt',
		content: 'Pseudo a mute: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=mute&login='+ titre);
		}
	});
	$(".jmb-unmute").msgbox({
		title: 'Demute une personne',
		type: 'prompt',
		content: 'Pseudo a demute: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=unmute&login='+ titre);
		}
	});
	$(".jmb-modo").msgbox({
		title: 'Donner permission moderateur a une personne',
		type: 'prompt',
		content: 'Pseudo a passe en moderateur : ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=modo&login='+ titre);
		}
	});
	$(".jmb-modo").msgbox({
		title: 'Retire permission moderateur a une personne',
		type: 'prompt',
		content: 'Pseudo a retire du grade moderateur: ',
		onClose: function(){
			var titre = this.val();
			$.get('./include/get-modo.php?func=demodo&login='+ titre);
		}
	});
	$(".jmb-couleur").msgbox({
		title: 'Choix de couleur de votre pseudo',
		type: 'html',
		content: '<span style="background-color:#008000;">[]</span> <span style="background-color:#B22222;">[]</span> <span style="background-color:#FF7F50;">[]</span> 	<span style="background-color:#9ACD32;">[]</span><br />	<span style="background-color:#00FF7F;">[]</span> <span style="background-color:#2E8B57;">[]</span> <span style="background-color:#DAA520;">[]</span> <span style="background-color:#D2691E;">[]</span><br />	<span style="background-color:#5F9EA0;">[]</span> <span style="background-color:#1E90FF;">[]</span> <span style="background-color:#FF69B4;">[]</span> <span style="background-color:#8A2BE2;">[]</span>'
	});
 
//Get all the LI from the #tabMenu UL
  $('#nav li').click(function(){
    
    //perform the actions when it's not selected
    if (!$(this).hasClass('current')) {    
           
	    //remove the selected class from all LI    
	    $('#nav li').removeClass('current');
	    
	    //Reassign the LI
	    $(this).addClass('current');
	 }
  });

		$("#listm").click(function () {
		getOnlineUsers();
			$('#footer').after('<div class="modal" id="membres" title="Liste de membres"> \
				<header> \
				<h3>Liste des membres</h3> \
				</header> \
				<div class="content-container"> \
				<div id="users"></div> \
				</div> \
				</div>');
			$('#listm').html('<a id="lmembres"><span id="numco" class="odometer"></span></a>');
			$("#membres").dialog({
				modal:false,
				close: function() {
				$('#listm').html('<a id="lmembres"><span id="numco" class="odometer"></span></a>');
				$('#membres').remove();
				}
			});
		});

		var flux = 'http://www.gamers-city.eu/tchat2.php?flux='+ $("#id_tchat").val();
		$("#pchat").popupWindow({ 
width: '320',
height: '700',
centerScreen: 1,
//scrollbars: 1,
windowURL: flux, 
windowName:'Tchat' 
});

	if(document.getElementById('message')) {
		// actualisation des messages
		window.setInterval(getMessages, reloadTime);
		// actualisation des membres connectés
		window.setInterval(getOnlineUsers, reloadTime);
			
		// on sélectionne la zone de texte
		getOnlineUsers();
		window.setInterval(annonce(), reloadTime2);
		$("#message").focus();
	}
	getlive();
	window.setInterval(getlive, reloadTime);

		
/*-----------------------------------------------------------------------------------*/
/* --
/*-----------------------------------------------------------------------------------*/	


}); // end document.ready


		

	
	


