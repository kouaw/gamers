		<header id="masthead" class="ui page site-header" role="banner">

         <!--   <div class="header">
                <div class="container">
                    <!--<div class="header_right fright">
                        <a href="#" class="event_count_wrapper clearfix">
                            <div class="event_countdown">
                                
                            </div>
                            <span class="next_event_text">Next Event In:</span>
                        </a>
                    </div>
                </div>
            </div> <!-- END .header -->

		</header><!-- END #masthead -->
        <div id="boxed_content" class="boxed_content">
            <div class="inner">
            
            <nav id="primary-navigation" class="site-navigation primary-navigation clearfix" role="navigation">
                <button class="menu-toggle">Navigation</button>
                <a href="#content" class="screen-reader-text skip-link">Retour au contenue</a>
                <div class="menu-all-pages-container">
                    <ul class="nav-menu">
						<li class="menu-logo"><a href="http://www.gamers-city.eu/?p=index" rel="Home"><img src="assets/images/logo.png" alt="Gamers City" height="50px"></a></li>
                        <li class="menu-item"><a href="http://www.gamers-city.eu/?p=index">Accueil</a></li>
                        <li class="menu-item-has-children"><a>Live</a>
                            <ul class="sub-menu">
								<?php
									$query = $db->prepare("SELECT * FROM streamer");
									$query->execute();
									while($data = $query->fetch()){
								?>
										<li><a href="http://www.gamers-city.eu/live-<?php echo $data[streamer]; ?>"><?php echo $data[streamer]; ?> <img id="live-<?php echo $data[streamer]; ?>" src="assets/images/icons/0.png" title="off" style="width: 12px; height: 12px;" /></a></li>	
								<?php
									}
								?>
                            </ul>
                        </li>
						<?php
						if($p == 'live'){
									$query = $db->prepare("SELECT * FROM streamer where streamer=:streamer");
									$query->execute(
									array(
										'streamer' => $stream
									));
									while($data = $query->fetch()){
									?>
										<li class="menu-item-has-children"><a href="">Flux video</a>
											<ul class="sub-menu">	
									<?php
										if($data[twitch] != ''){
											if($data[twitch_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video1'><a >Twitch</a></li>
									<?php
											}elseif($data[twitch_vip] == '0') {
									?>
										<li id='video1'><a >Twitch</a></li>
									<?php
											}
										}
										if($data[hitbox] != ''){
											if($data[hitbox_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video2'><a >Hitbox</a></li>
									<?php
										}elseif($data[hitbox_vip] == '0') {
									?>
											<li id='video2'><a >Hitbox</a></li>
									<?php
											}
										}
										if($data[daily] != ''){
											if($data[daily_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video3'><a >Dailymotion</a></li>
									<?php
										}elseif($data[daily_vip] == '0') {
									?>
											<li id='video3'><a >Dailymotion</a></li>
									<?php
											}
										}
										if($data[gamelife] != ''){
											if($data[gamelife_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video4'><a >Gaming Live</a></li>
									<?php
										}elseif($data[gamelife_vip] == '0') {
									?>
											<li id='video4'><a >Gaming Live</a></li>
									<?php
											}
										}
										if($data[link_dedie] != ''){
											if($data[link_dedie_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video5'><a >Independant</a></li>
									<?php
										}elseif($data[link_dedie_vip] == '0') {
									?>
											<li id='video5'><a >Independant</a></li>
									<?php
											}
										}
										if($data[link_dedie2] != ''){
											if($data[link_dedie2_vip] == '1' and $_SESSION['level'] >= '2'){
									?>
										<li id='video6'><a >Independant</a></li>	
									<?php
										}elseif($data[link_dedie2_vip] == '0') {
									?>
											<li id='video6'><a >Independant</a></li>
									<?php
											}
										}
									}
									?>
										</ul>
									</li>
									<?php
						}
						?>
                        <li class="menu-item-has-children"><a href="?p=contact">Contact</a>
							<ul class="sub-menu">
								<li><a href="?p=recrut">Recrutement</a></li>
							</ul>
						</li>
                        <?php if(!$_SESSION){ ?>
							<li class="menu"><a href="http://www.gamers-city.eu/?p=identification">Identification</a></li>
						<?php }else{ ?>
							<li class="menu-item-has-children"><a >Mon compte</a>
								<ul class="sub-menu">
									<li><a href="http://www.gamers-city.eu/?p=vip">VIP</a></li>
									<li><a href="http://www.gamers-city.eu/?p=logout">Déconnexion</a></li>
								</ul>
							</li>
						<?php } ?>
                        <!--<li class="menu-item-has-children"><a href="page_gallery_filterable.html">Galleries</a>
                            <ul class="sub-menu">
                                <li><a href="page_gallery_filterable.html">Gallery Filterable</a></li>
                                <li><a href="page_gallery_slideshow.html">Gallery Slideshow</a></li>
                                <li><a href="page_gallery_grid.html">Gallery Grid</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#">More</a>
                            <ul class="sub-menu">
                                <li><a href="page_shortcodes.html">Shortcodes</a></li>
                                <li><a href="page_contact.html">Contact</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
				<?php
				
				if($p == 'live'){
					?>
					<ul class="header_social">
					<?php
					$query = $db->prepare("SELECT * FROM streamer WHERE streamer=:stream");
					$query->execute(
					array(
					'stream' => $stream
					));
					$data = $query->fetch();
					if($data[twitter] != ''){ ?>
						<li><a href="https://twitter.com/<?php echo $data[twitter]; ?>" title="Twitter"><i class="large twitter icon popup" data-content="Twitter" data-variation="inverted"></i></a></li>
					<?php }
					if($data[facebook] != ''){ ?>
						<li><a href="https://www.facebook.com/<?php echo $data[facebook]; ?>" title="Facebook"><i class="large facebook icon popup" data-content="Facebook" data-variation="inverted"></i></a></li>	
					<?php }
					if($data[youtube] != ''){ ?>
						<li><a href="https://www.youtube.com/user/<?php echo $data[youtube]; ?>" title="Youtube"><i class="large youtube play icon popup" data-content="Youtube" data-variation="inverted"></i></a></li>						
				<?php	}
					if($data[google] != ''){ ?>
						<li><a href="https://plus.google.com/u/0/<?php echo $data[google]; ?>" title="Google Plus"><i class="large google plus icon popup" data-content="Google Plus" data-variation="inverted"></i></a></li>						
				<?php	} ?>
				</ul>
				<?php
				}
			?>
            </nav>
