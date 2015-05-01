<?php
/*
	$query = $db->prepare("SELECT * FROM streamer WHERE streamer=':stream'");
	$query->execute(
	array(
	'stream' => $stream
	));
	$data = $query->fetch();
	if($data['titre_source'] == 'sql'){
		$db = db_connect();
		$query = $db->prepare("SELECT * FROM streamer_etat WHERE streamer=':stream'");
		$query->execute(
		array(
			'stream' => $stream
		));
		$data = $query->fetch();
		$titre = $data['title']; 
	}elseif($data['titre_source'] == 'twitch'){	
		$twitcht = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/".$data[twitch]."));
		$titre = $twitcht->{'stream'}->{'channel'}->{'status'};
	}
*/
if($stream == 'snipy'){
$db = db_connect();
	$query = $db->prepare("SELECT * FROM streamer_etat WHERE id='1'");
$query->execute();
$data = $query->fetch();
$titre = $data['title']; 
}elseif($stream == 'ben'){
$twitcht = json_decode(file_get_contents("https://api.twitch.tv/kraken/streams/benzaie"));
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
								<?php
								/*
								echo $data['video_default'];
								//twitch http://www.twitch.tv/$data[twitch]/embed
								//indep rtmp://www.gamers-city.eu/live_$stream/flv:$stream.flv
								*/
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
<div id="presentation">
	<?php
	/*
	if($data[twitch] != ''){
	<span class='subscribe'><a href='http://twitch.tv/$data[twitch]/' target='_blank'><img src="./assets/images/followtwi.jpg" alt="Subscribe" /></a></span>
	}
	if($data[hitbox] != ''){
	<span class='subscribe'><a href='http://www.hitbox.tv/$data[hitbox]/' target='_blank'><img src="./assets/images/followhitb.jpg" alt="Subscribe" /></a></span>	
	}
	echo $data['pres'];	
	*/
	if($stream == 'ben'){ ?>
	<span class='subscribe'><a href='http://twitch.tv/benzaie/' target='_blank'><img src="./assets/images/followtwi.jpg" alt="Subscribe" /></a></span>	
	<span class='subscribe'><a href='https://secure.twitch.tv/products/benzaie/ticket?ref=below_video_subscribe_button' target='_blank'><img src="./assets/images/subscriben.jpg" alt="Subscribe" /></a></span>
	<br /><a href="https://www.twitchalerts.com/donate/benzaie"><img src="./assets/images/ben.jpg" alt="Subscribe" /></a>
	<?php }else{ ?>
	<span class='subscribe'><a href='http://twitch.tv/gamers_city/' target='_blank'><img src="./assets/images/followtwi.jpg" alt="Subscribe" /></a></span>
	<span class='subscribe'><a href='http://www.hitbox.tv/snipy44' target='_blank'><img src="./assets/images/followhitb.jpg" alt="Subscribe" /></a></span><br /><br />
	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MNUF2PVQSM9WC"><img src="http://www.paypal.com/fr_FR/i/btn/x-click-butcc-donate.gif" alt="dons" /></a>
	<?php } ?>
</div>
                                    <!--</div>-->
                                    <div class="entry-detail">
                                       <!-- <div class="entry-header">
                                            <div class="entry-meta">
                                                <span class="posted-on">13/03/2015</span>
                                                <span class="sep">/</span>
                                                <span class="posted-author">Poste par <a href="#">Snipy</a></span>
                                            </div>
                                        </div>
                                        <div class="entry-content">
                                            <p>What happens next seems almost unreal. Thousands of fans respond to her on the net, attracting the attention of professionals, and the interest of Because Music. Quisque a turpis ut dolor porta auctor a sed risus. Quisque turpis arcu, congue in tincidunt quis, feugiat a erat. Vivamus tincidunt semper ultricies. Integer sit amet facilisis quam. Sed vitae nibh odio. Sed nec neque id nunc ornare rhoncus. Donec congue accumsan justo, vitae mollis ipsum pharetra eu.</p>
                                            <p>Ut luctus justo elit, sit amet sodales purus vulputate non. Nullam lorem eros, posuere nec sodales at, aliquet gravida dui. Aenean id tellus in libero porta ultricies. Donec viverra interdum bibendum. Sed varius nunc tortor, tempus accumsan massa aliquam sed. Quisque a turpis ut dolor porta auctor a sed risus. Quisque turpis arcu, congue in tincidunt quis, feugiat a erat. Vivamus tincidunt semper ultricies. Integer sit amet facilisis quam. Sed vitae nibh odio. Sed nec neque id nunc ornare rhoncus. Donec congue accumsan justo, vitae mollis ipsum pharetra eu.</p>
                                            <h4>In hac habitasse platea dictumst</h4>
                                            <p>Vivamus et eleifend massa. Suspendisse nec arcu et ligula posuere aliquam. Integer quis arcu vitae nisi sodales tincidunt. Praesent pretium, massa ut consequat commodo, libero turpis dignissim lacus, facilisis porttitor risus mi vitae purus.</p>
                                            <p>What happens next seems almost unreal. Thousands of fans respond to her on the net, attracting the attention of professionals, and the interest of Because Music. Quisque a turpis ut dolor porta auctor a sed risus. Quisque turpis arcu, congue in tincidunt quis, feugiat a erat. Vivamus tincidunt semper ultricies. Integer sit amet facilisis quam. Sed vitae nibh odio. Sed nec neque id nunc ornare rhoncus. Donec congue accumsan justo, vitae mollis ipsum pharetra eu.</p>
                                            
                                        </div>-->
                                       <!-- <div class="entry-footer">
                                            <i class="file icon"></i>
                                            <ul class="post-categories">
                                                <li><a rel="category tag" title="View all posts in antiquarianism" href="#">Antiquarianism</a></li>
                                                <li><a rel="category tag" title="View all posts in arrangement" href="#">Arrangement</a></li>
                                                <li><a rel="category tag" title="View all posts in asmodeus" href="#">Asmodeus</a></li>
                                            </ul>
                                            <i class="tag icon"></i>
                                            <ul class="post-tags">
                                                <li><a rel="tag" href="#">chat</a></li>
                                                <li><a rel="tag" href="#">comments</a></li>
                                                <li><a rel="tag" href="#">content</a></li>
                                                <li><a rel="tag" href="#">sticky</a></li>
                                                <li><a rel="tag" href="#">template</a></li>
                                            </ul>
                                        </div>-->
                                    </div>
                                </article>

                               <!-- <div class="comments-area" id="comments">
                                    <div class="comment-respond" id="respond">
                                        <h3 class="comment-reply-title" id="reply-title">Leave a Reply <small><a style="display:none;" href="#" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a></small></h3>
                                        <form novalidate="" class="comment-form" id="commentform" method="post" action="#">
                                            <p class="comment-notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>                           
                                            <p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input type="text" aria-required="true" size="30" value="" name="author" id="author"></p>
                                            <p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input type="email" aria-required="true" size="30" value="" name="email" id="email"></p>
                                            <p class="comment-form-url"><label for="url">Website</label> <input type="url" size="30" value="" name="url" id="url"></p>
                                            <p class="comment-form-comment"><label for="comment">Comment</label> <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea></p>                      
                                            <p class="form-submit">
                                            <input type="submit" class="ui button colored" value="Post Comment" id="submit" name="submit">
                                            <input type="hidden" id="comment_post_ID" value="1241" name="comment_post_ID">
                                            <input type="hidden" value="0" id="comment_parent" name="comment_parent">
                                            </p>
                                        </form>
                                    </div>-- #respond ->
                                </div> -->

                            </div>

						</div> <!-- END #primary -->

<?php 
include('./include/tchat.php');
?>