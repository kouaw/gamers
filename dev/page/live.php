<?php
		$db = db_connect();
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=:stream");
	$query->execute(
	array(
	'stream' => $stream
	));
	$stream_info = $query->fetch();
	if($stream_info['titre_source'] == 'sql'){
		$query = $db->prepare("SELECT * FROM streamer_etat WHERE streamer=':stream'");
		$query->execute(
		array(
			'stream' => $stream
		));
		$data = $query->fetch();
		$titre = $data['title']; 
	}elseif($stream_info['titre_source'] == 'twitch'){	
		$twitcht = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/".$stream_info[twitch].""));
		$titre = $twitcht->{'stream'}->{'channel'}->{'status'};
	}
?>
			<div id="content" class="site-content single">

				<div class="page-inner">
					<div class="container">
                    
						<div id="primary" class="content-area">
							
                            <header class="page-header">
                                <h1 class="page-title">Live ( <span class="titlelive"><?php echo $titre; ?></span> )</h1>
                            </header>

                            <div class="recent_news bigthumb">

                                <article class="post clearfix">
																	<script type="text/javascript" src="jwplayer.js"></script>
									<script type="text/javascript">jwplayer.key = "J0+IRhB3+LyO0fw2I+2qT2Df8HVdPabwmJVeDWFFoplmVxFF5uw6ZlnPNXo=";</script>
								<div id="video">
									<?php
									if($stream_info['video_default'] == 'dedie'){
									?>
									<div id="player_1" style="width=700px;height=394px;"></div>
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
									 {file: "rtmp://www.gamers-city.eu/live_<?php echo $stream_info['link_dedie'];?>/flv:<?php echo $stream;?>.flv"}
									 ]
									  });
									</script>	
								<?php
									}elseif($stream_info['video_default'] == 'twitch'){
								?>
									<iframe src="http://www.twitch.tv/<?php echo $stream_info['twitch'];?>/embed" id="player_1"  frameborder="0" scrolling="no" width="700" height="394"></iframe>
								<?php
									}elseif($stream_info['video_default'] == 'hitbox'){
								?>
									<iframe id="player_1" height="394" width="700" src="http://hitbox.tv/#!/embed/<?php echo $stream_info['hitbox'];?>" frameborder="0" allowfullscreen></iframe>
								<?php
									}elseif($stream_info['video_default'] == 'daily'){
								?>
									<iframe frameborder="0" height="394" width="700" id="player_1" src="http://www.dailymotion.com/embed/video/<?php echo $stream_info['daily_video'];?>?autoPlay=1&logo=on"></iframe>
								<?php
									}elseif($stream_info['video_default'] == 'game'){
								?>			
									<iframe src="http://www.gaminglive.tv/embed-player/<?php echo $stream_info['gamelife'];?>" width="700" height="394" class="gaminglive-player" frameborder="0"></iframe>
								<?php } ?>
								</div>
<div id="listm" style="text-align:right"><?php if($_SESSION['level'] >= '3'){ ?><a  id="lmembres" ><?php } ?> <span id="numco" class="odometer"></span><?php if($_SESSION['level'] >= '3'){ ?></a><?php }?></div>
<div id="presentation">
	<?php
	
	if($stream_info[twitch] != ''){ ?>
	<span class='subscribe'><a href='http://twitch.tv/<?php echo $stream_info[twitch]; ?>/' target='_blank'><img src="./assets/images/followtwi.jpg" alt="Subscribe" /></a></span>
	<?php
	}
	if($stream_info[hitbox] != ''){ ?>
	<span class='subscribe'><a href='http://www.hitbox.tv/<?php echo $stream_info[hitbox]; ?>/' target='_blank'><img src="./assets/images/followhitb.jpg" alt="Subscribe" /></a></span>	
	<?php
	}
	echo "<br />".$stream_info['pres'];	
	?>
</div>
                                    <div class="entry-detail">
                                    </div>
                                </article>
                            </div>

						</div> <!-- END #primary -->

<?php 
include('./include/tchat.php');
?>