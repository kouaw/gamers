<?php
header("Content-type: application/javascript; charset: utf-8");
$stream = $_GET['stream'];
?>
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
  	if(document.getElementById('chatsnip')) {
	window.setInterval(infosnip, reloadTime);
	infosnip();
	}