		<header id="masthead" class="ui page site-header" role="banner">

           <!-- <div id="search-container" class="search-box-wrapper">
                <div class="container">
                    <i class="big search icon"></i>
                    <div class="search-box">
                        <form action="http://example.com/" class="search-form" role="search" >
                            <label>
                                <span class="screen-reader-text">Search for:</span>
                                <input type="search" name="s" value="" title="Press Enter to submit your search" placeholder="Search…" class="search-field">
                            </label>
                            <input type="submit" value="Search" class="search-submit">
                        </form>
                    </div>
                </div>
            </div><!--/ #search-container -->

           <!-- <div class="topbar">
                <div class="container">
                    <div class="topbar_left fleft">
                        <nav class="topbar_menu_left">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="page_band.html">The Band</a></li>
                                <li><a href="page_artists.html">Artists</a></li>
                                <li><a href="page_contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="search-toggle fright">
                        <i class="search icon link icon"></i>
                    </div>
                    <div class="topbar_right fright">
                        <nav class="topbar_menu_left">
                            <ul>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Cart (2)</a></li>
                                <li><a href="#">Checkout</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div> <!-- END .topbar -->

         <!--   <div class="header">
                <div class="container">
                    <div class="logo_area fleft">
                        <a href="?p=index" rel="home">
                            <img src="assets/images/logo.png" alt="Gamers City">
                        </a>
                    </div>
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
								/*
									$query = $db->prepare("SELECT * FROM streamer");
									$query->execute(
									array(
									'stream' => $stream
									));
									while($data = $query->fetch()){
										<li><a href="?p=live&stream=$data[streamer]">$data[streamer] <img id="live-$data[streamer]" src="assets/images/icons/0.png" title="off" style="width: 12px; height: 12px;" /></a></li>	
									}
								*/
								?>
								<li><a href="http://www.gamers-city.eu/live-snipy">Snipy <img id="live-snipy" src="assets/images/icons/0.png" title="off" style="width: 12px; height: 12px;" /></a></li>
								<li><a href="http://www.gamers-city.eu/live-benzaie">BenZaie <img id="live-ben" src="assets/images/icons/0.png" title="off" style="width: 12px; height: 12px;" /></a></li>
                            </ul>
                        </li>
						<?php if($p == 'live' and $stream == 'snipy'){ ?>
							<li class="menu-item-has-children"><a href="">Flux video</a>
								<ul class="sub-menu">
									<li id='video2'><a >Dailymotion</a></li>
									<li id='video4'><a >Twitch</a></li>
									<li id='video5'><a >Hitbox</a></li>
									<li id='video6'><a >Gaming Live</a></li>
									<?php if($_SESSION['level'] >= '2'){ ?>
										<li id='video3'><a >Independant</a></li><!-- si VIP Ou flux no distrib -->
									<?php } ?>
									<li id="livei2" class="hide"></li>
								</ul>
							</li>
						<?php } ?>
						<?php if($p == 'live' and $stream == 'ben'){ ?>
							<li class="menu-item-has-children"><a href="page_albums.html">Flux video</a>
								<ul class="sub-menu">
									<li id='video8'><a >Twitch</a></li>
								</ul>
							</li>
						<?php } ?>
                        <li class="menu"><a href="http://www.gamers-city.eu/?p=contact">Contact</a></li>
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
				/*
				if($p == 'live'){
					$query = $db->prepare("SELECT * FROM streamer WHERE streamer=':stream'");
					$query->execute(
					array(
					'stream' => $stream
					));
					$data = $query->fetch();
					if($data[twitter] != ''){
						<li><a href="https://twitter.com/$data[twitter]" title="Twitter"><i class="large twitter icon popup" data-content="Twitter" data-variation="inverted"></i></a></li>
					}
					if($data[facebook] != ''){
						<li><a href="https://www.facebook.com/$data[facebook]" title="Facebook"><i class="large facebook icon popup" data-content="Facebook" data-variation="inverted"></i></a></li>	
					}
					if($data[youtube] != ''){
						<li><a href="https://www.youtube.com/user/$data[youtube]" title="Youtube"><i class="large youtube play icon popup" data-content="Youtube" data-variation="inverted"></i></a></li>						
					}
					if($data[google] != ''){
						<li><a href="https://plus.google.com/u/0/$data[google]" title="Google Plus"><i class="large google plus icon popup" data-content="Google Plus" data-variation="inverted"></i></a></li>						
					}
				}
				*/
				if($stream == 'snipy' and $p == 'live'){
				?>
					<ul class="header_social">
						<li><a href="https://twitter.com/Gamers_City" title="Twitter"><i class="large twitter icon popup" data-content="Twitter" data-variation="inverted"></i></a></li>
						<li><a href="https://www.facebook.com/pages/Gamers-City/145843122136717?fref=ts" title="Facebook"><i class="large facebook icon popup" data-content="Facebook" data-variation="inverted"></i></a></li>
						<li><a href="https://www.youtube.com/user/snipy44" title="Youtube"><i class="large youtube play icon popup" data-content="Youtube" data-variation="inverted"></i></a></li>
						<li><a href="https://plus.google.com/u/0/105010610290939470471/posts" title="Google Plus"><i class="large google plus icon popup" data-content="Google Plus" data-variation="inverted"></i></a></li>
					</ul>
				<?php
				}elseif($stream == 'ben' and $p == 'live'){
				?>
					<ul class="header_social">
						<li><a href="https://twitter.com/Benzaie_tgwtg" title="Twitter"><i class="large twitter icon popup" data-content="Twitter" data-variation="inverted"></i></a></li>
						<li><a href="https://www.facebook.com/BenzaieTv?fref=ts" title="Facebook"><i class="large facebook icon popup" data-content="Facebook" data-variation="inverted"></i></a></li>
						<li><a href="https://www.youtube.com/user/BenzaieLive" title="Youtube"><i class="large youtube play icon popup" data-content="Youtube" data-variation="inverted"></i></a></li>
					</ul>				
				<?php }
				?>
            </nav>
