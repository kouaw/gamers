						<div id="secondary" class="widget-area" role="complementary">
							<!--<aside class="widget event_widget">
                                <h4 class="widget-title">Tour Date Events</h4>
                                <div class="widget-content">

                                    <article class="post">
                                        <div class="event_left">
                                            <div class="event_date">18</div>
                                            <div class="event_month">Feb</div>
                                        </div>
                                        <div class="event_detail">
                                            <h2 class="event_title"><a href="#">Jazz Festival Live Music</a></h2>
                                            <div class="event_time"><i class="time icon"></i> February 18, 2014 at 9:00 AM</div>
                                            <div class="event_location"><i class="map marker icon"></i> Mountain View, CA 94043</div>
                                            <a href="#" class="event_button ui button colored">Buy Tickets</a>
                                        </div>
                                    </article>
                                    <article class="post">
                                        <div class="event_left">
                                            <div class="event_date">23</div>
                                            <div class="event_month">Mar</div>
                                        </div>
                                        <div class="event_detail">
                                            <h2 class="event_title"><a href="#">Are you Experienced Show</a></h2>
                                            <div class="event_time"><i class="time icon"></i> March 26, 2014 at 8:00 AM</div>
                                            <div class="event_location"><i class="map marker icon"></i> Mountain View, CA 94043</div>
                                            <a href="#" class="event_button ui button">Canceled</a>
                                        </div>
                                    </article>

                                    <article class="post">
                                        <div class="event_left">
                                            <div class="event_date">29</div>
                                            <div class="event_month">Mar</div>
                                        </div>
                                        <div class="event_detail">
                                            <h2 class="event_title"><a href="#">The New Fathers and Sons</a></h2>
                                            <div class="event_time"><i class="time icon"></i> March 26, 2014 at 8:00 AM</div>
                                            <div class="event_location"><i class="map marker icon"></i> Mountain View, CA 94043</div>
                                            <a href="#" class="event_button ui button">Sold Out</a>
                                        </div>
                                    </article>

                                </div>
                            </aside>

                            <aside class="widget">
                                <h4 class="widget-title">Highlight Videos</h4>
                                <div class="widget-content dark_shadow">
                                    <div class="video_lightbox">
                                        <a class="popup-vimeo" href="https://vimeo.com/41132461">
                                            <img src="http://placehold.it/640x360/17ad49/FFFFFF" alt="">
                                            <span class="video_button"></span>
                                        </a>
                                    </div>
                                </div>
                            </aside>-->

                            <aside class="widget widget_twitter">
                                <h4 class="widget_heading">Tchat</h4>
                                <div class="widget_content">
<?php if(user_verified()) { 
/*
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=':stream'");
	$query->execute(
	array(
	'stream' => $stream
	));
	$data = $query->fetch();
	if($data[tchat_default] == 'json'){
		//script tchat
	}elseif($data[tchat_default] == 'twitch'){
		//<iframe id="chat$stream" src="http://www.twitch.tv/$stream/chat?popout=" frameborder="0" scrolling="yes" height="500" width="350"></iframe>
	}
*/
?>
	<?php if($stream == 'ben'){ ?>
	<iframe id="chatben" src="http://www.twitch.tv/benzaie/chat?popout=" frameborder="0" scrolling="yes" height="500" width="350"></iframe>
	<?php }else{?>
	<table id="chatsnip" class="chat" style="height=200px;"><tr style="height=200px;">		
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
			
	<!-- colonne avec les membres connectés au chat -->	
</tr></table>
		<input type="hidden" id="dateConnexion" value="<?php echo $_SESSION['time']; ?>" />
		<?php
		if($_GET['flux'] <= '5'){ ?>
		<input type="hidden" id="id_tchat" value="1" />
		<?php }elseif($_GET['flux'] >= '6' and $_GET['flux'] <= '8'){ ?>
		<input type="hidden" id="id_tchat" value="3" />		
		<?php }elseif($_GET['flux'] >= '9'){ ?>
		<input type="hidden" id="id_tchat" value="3" />		
		<?php }
		?>
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
	<?php } ?>
<?php }else{ ?>
	<h3 style="text-align:center">Vous devez être connecté.</h3>
<?php } ?>                               </div>
                            </aside>

						</div> <!-- END secondary -->
