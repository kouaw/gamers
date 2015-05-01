<?php
header("Content-type: application/javascript; charset: utf-8");
include('./functions.php');//function
$stream = htmlentities($_GET['stream']);
$db = db_connect();//ouverture connexion sql
?>
$(document).ready(function(){
	if(document.getElementById('chat<?php echo $stream;?>')) {
		window.setInterval(info<?php echo $stream;?>, reloadTime);
		info<?php echo $stream;?>();
	}
<?php
if($stream != ''){
									$query = $db->prepare("SELECT * FROM streamer where streamer=:streamer");
									$query->execute(
									array(
										'streamer' => $stream
									));
									while($data = $query->fetch()){
										if($data[twitch] != ''){
									?>
										$("#video1").click(function(){
											$('#video').html('<iframe src="http://www.twitch.tv/<?php echo $data[twitch];?>/embed" id="player_1" frameborder="0" scrolling="no" height="394" width="700"></iframe>');
										});
									<?php
										}
										if($data[hitbox] != ''){
									?>
										$("#video2").click(function(){
											$('#video').html('<iframe id="player_1" height="394" width="700" src="http://hitbox.tv/#!/embed/<?php echo $data[hitbox];?>" frameborder="0" allowfullscreen></iframe>');
											});
									<?php
										}
										if($data[daily] != ''){
									?>
										$("#video3").click(function(){
										$('#video').html('<iframe frameborder="0" height="394" width="700" id="player_1" src="http://www.dailymotion.com/embed/video/<?php echo $data[daily_video];?>?autoPlay=1&logo=on"></iframe>');
										});
									<?php
										}
										if($data[gamelife] != ''){
									?>
										$("#video4").click(function(){
										$('#video').html('<iframe src="http://www.gaminglive.tv/embed-player/<?php echo $data[gamelife];?>" width="700" height="394" class="gaminglive-player" frameborder="0"></iframe>');
										});
									<?php
										}
										if($data[link_dedie] != ''){
									?>
										$("#video5").click(function(){
											$('#video').html('<div id="player_1" style="width=700px;height=394px;"></div>');
												jwplayer('player_1').setup({stretching: "exactfit",primary: "html5",autostart: "true",controls: "true",aspectratio: '16:9',width: '100%',height: '100%' ,rtmp: {bufferlength: 0.9},sources: [ {file: "rtmp://62.210.182.114/live_<?php echo $data[link_dedie];?>/flv:<?php echo $stream;?>.flv"}		 ]	  });
										});
									<?php
										}
										if($data[link_dedie2] != ''){
									?>
										$("#video6").click(function(){
											$('#video').html('<div id="player_1" style="width=700px;height=394px;"></div>');
												jwplayer('player_1').setup({stretching: "exactfit",primary: "html5",autostart: "true",controls: "true",aspectratio: '16:9',width: '100%',height: '100%' ,rtmp: {bufferlength: 0.9},sources: [ {file: "rtmp://62.210.182.114/live_<?php echo $data[link_dedie2];?>/flv:<?php echo $stream;?>.flv"}		 ]	  });
										});
									<?php
										}
									}
									?>
});
									<?php
									echo "function info".$stream."(){";
									?>
										var view;
										$.get("./include/get-view.php?login=<?php echo $stream;?>", function(data) {
											 var dedie = parseFloat(data,10);
											 if(isNaN(dedie) !== 'true'){
												$('#listm').html('<span class="octicon octicon-person"></span> <a id="lmembres"><span id="numco" class="odometer">' + dedie + '</span></a>');
											 }
											});
								  }
								  	function getlive(){
								  <?php
									}
									$query = $db->prepare("SELECT * FROM streamer ");
									$query->execute();
									while($data = $query->fetch()){	
									?>
										$.get('./include/get-live.php?id=<?php echo $data[id];?>', function(data) {
											if(data == '1'){
												$('#live-<?php echo $data[streamer];?>').attr({src: './assets/images/icons/1.png', alt: 'On air', width: '12px', height: '12px'});
											}else{
												$('#live-<?php echo $data[streamer];?>').attr({src: './assets/images/icons/' + data + '.png', alt: 'Off air', width: '12px', height: '12px'});
											}
										});
									<?php
									}
									?>
									}
