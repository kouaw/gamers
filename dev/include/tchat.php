<?php
		$db = db_connect();
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=:stream");
	$query->execute(
	array(
	'stream' => $stream
	));
	$stream_info = $query->fetch();
?>
						<div id="secondary" class="widget-area" role="complementary">
								<blockquote id="adblocker">
									Vous devez desactivé adblock pour voir le tchat.
								</blockquote>
                            <aside class="widget widget_twitter">
                                <h4 class="widget_heading">Tchat</h4>
                                <div class="widget_content">
<?php
if(user_verified()) { 
if($stream_info[tchat_default] == 'twitch'){
?>
	<iframe id="<?php echo "chat".$stream; ?>" src="http://www.twitch.tv/<?php echo $stream_info['twitch'];?>/chat?popout=" frameborder="0" scrolling="yes" height="500" width="350"></iframe>
<?php
}elseif($stream_info[tchat_default] == 'hitbox'){
?>
	<iframe id="<?php echo "chat".$stream; ?>" width="350" height="500" src="http://www.hitbox.tv/embedchat/<?php echo $stream_info['hitbox'];?>" frameborder="0" allowfullscreen></iframe>
<?php
}elseif($stream_info[tchat_default] == 'dedie'){
?>
	<table id="<?php echo "chat".$stream; ?>" class="chat" style="height=200px;"><tr style="height=200px;">		
	<!-- zone des messages -->
	<td valign="top" style="height=200px;" id="text-td">
	<div style="height=200px;display:block;overflow:hidden;overflow-y: scroll;">
            	<div id="annonce"></div>
		<div id="text" style="height=200px;" class="size-text-1">
			<div id="loading">
				<center>
				<span class="info" id="info">Chargement du chat en cours...</span><br />
				<img src="ajax-loader.gif" alt="patientez...">
				</center>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	</td>
	</tr></table>
		<input type="hidden" id="dateConnexion" value="<?php echo $_SESSION['time']; ?>" />
		<input type="hidden" id="id_tchat" value="<?php echo $stream_info['id'];?>" />

<form action="" method="" onsubmit="postMessage(); return false;">
<input type="text" id="message" name="message" class="text-box" maxlength="255" /><br /><br /><a class="popup-smileys fleft" href="http://www.gamers-city.eu/include/smileys.php" ><img src="http://image.jeuxvideo.com/smileys_img/1.gif" alt="" height="16" width="16"></a><div id="menu_admin" style="margin-left:10px;" class="fleft"><span class="octicon octicon-gear" ></span></div><!--<div id="full"><a class="popup-smileys" href="http://www.gamers-city.eu/include/full.php">Full</a></div>--><a onclick="postMessage()" id="post" class="ui inverted button fright" href="#">Envoyer</a>
</form>
			<script>
					$(function(){
						$.contextMenu({
							selector: '#menu_admin', 
							trigger: 'left',
							items: $.contextMenu.fromMenu($('#html5menu'))
						});
					});
			</script>
			 
			<menu id="html5menu" type="context" class="showcase hide">
			<?php if($_SESSION['level'] >= '3'){ 
				 if($_SESSION['level'] >= '4'){ ?>
				<menu label="gestion">
					<command label="clean" onclick="clean()"></command>
					<command label="titre" class="jmb jmb-title"></command>
					<command label="annonce" class="jmb jmb-annonce"></command>
					<command label="live" class="jmb jmb-live"></command>
				<?php } ?>
					<!--<command label="regle" onclick="regle()"></command>-->
				</menu>
				  <menu label="user">
					<command label="ban" class="jmb jmb-ban"></command>
					
					<command label="unban" class="jmb jmb-unban"></command>
					
					<command label="mute" class="jmb jmb-mute"></command>
					
					<command label="unmute" class="jmb jmb-unmute"></command>
					<?php if($_SESSION['level'] >= '4'){?>
					
					<command label="moderateur" class="jmb jmb-modo"></command>
					
					<command label="demoderateur" class="jmb jmb-unmodo"></command>
					<?php } ?>
				  </menu>
			<?php } ?>
				<menu label="couleur pseudo">
					<?php if($_SESSION['level'] >= '2'){ ?>
						<command label="<span class='box-color' style='background-color:#008000;color:#008000;'>|||</span>" onclick="color('008000')" ></command>
						<command label="<span class='box-color' style='background-color:#D2691E;color:#D2691E;'>|||</span>"  onclick="color('D2691E')" ></command>
						<command label="<span class='box-color' style='background-color:#8A2BE2;color:#8A2BE2;'>|||</span>"  onclick="color('8A2BE2')" ></command>
					<?php } ?>
					<command label="<span class='box-color' style='background-color:#B22222;color:#B22222;'>|||</span>" onclick="color('B22222')" ></command>
					<command label="<span class='box-color' style='background-color:#FF7F50;color:#FF7F50;'>|||</span>" onclick="color('FF7F50')" ></command>
					<command label="<span class='box-color' style='background-color:#9ACD32;color:#9ACD32;'>|||</span>"  onclick="color('9ACD32')" ></command>
					<command label="<span class='box-color' style='background-color:#00FF7F;color:#00FF7F;'>|||</span>"  onclick="color('00FF7F')" ></command>
					<command label="<span class='box-color' style='background-color:#2E8B57;color:#2E8B57;'>|||</span>"  onclick="color('2E8B57')" ></command>
					<command label="<span class='box-color' style='background-color:#DAA520;color:#DAA520;'>|||</span>"  onclick="color('DAA520')" ></command>
					<command label="<span class='box-color' style='background-color:#5F9EA0;color:#5F9EA0;'>|||</span>"  onclick="color('5F9EA0')" ></command>
					<command label="<span class='box-color' style='background-color:#1E90FF;color:#1E90FF;'>|||</span>"  onclick="color('1E90FF')" ></command>
					<command label="<span class='box-color' style='background-color:#FF69B4;color:#FF69B4;'>|||</span>"  onclick="color('FF69B4')" ></command>					
				</menu>	
			</menu>
			<div id="responsePost" style="display:none"></div>
<?php
}
}else{ ?>
	<h3 style="text-align:center">Vous devez être connecté.</h3>
<?php } ?>                               </div>
                            </aside>

						</div> <!-- END secondary -->
