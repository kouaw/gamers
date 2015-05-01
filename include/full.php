<?php
session_start();
function cree_cookies($hash){
	if(setcookie('Connexion_auto', $hash, time() + 90 * 24 * 60 * 60) == 'true'){
	return true;
	}else{
	return false;
	}
}
function redirect($url){
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=$url\">";
	exit();
}
include('../.config/.config.php');
require('./PHPMailer-master/PHPMailerAutoload.php');
include('./functions.php');

?>
    <style>
	#custom-content {max-width:95%; margin: 10px auto; }
	#col1 { float:left; max-width:70%; }
	#col2 { float:right; max-width:20% }
    </style>
<div id="custom-content">
    <h1>Fullscreen</h1>
	<div id="col1">
								<?php
								if($stream == 'ben'){
								?>
								<div id="video">
									<iframe src="http://www.twitch.tv/benzaie/embed" id="player_1"  frameborder="0" scrolling="no" width="700" height="394"></iframe>
								</div>
								<?php }else{ ?>
									<script type="text/javascript" src="jwplayer.js"></script>
									<script type="text/javascript">jwplayer.key = "J0+IRhB3+LyO0fw2I+2qT2Df8HVdPabwmJVeDWFFoplmVxFF5uw6ZlnPNXo=";</script>
                                    <!--<div class="entry-thumb">-->
<!-- Live video -->
		<div id="video">
			 <div id="player_1" ></div>
			 <script type='text/javascript'>
		  jwplayer('player_1').setup({
			stretching: "exactfit",
			primary: "html5",
			autostart: "true",
			controls: "true",
			//image: 'www.gamers-city.eu/Image.png',58
			title: '<?php echo  htmlspecialchars(str_replace(chr(58), ':', $titre)); ?>',
			width: '100%',
			height: '100%',
			aspectratio: '16:9',
			rtmp: {
				bufferlength: 0.9
			},
			sources:
		 [
		 {file: "rtmp://www.gamers-city.eu/live_all/flv:snipy.flv"}
		 ]
		  });
			
		</script>	
								</div><?php } ?>
<div id="listm" style="text-align:right"><?php if($_SESSION['level'] >= '3'){ ?><a  id="lmembres" ><?php } ?> <span id="numco" class="odometer"></span><?php if($_SESSION['level'] >= '3'){ ?></a><?php }?></div>
</div>
<div id="col2">
	<?php include('tchat.php'); ?>
</div>