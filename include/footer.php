					</div>
				</div> <!-- END .page-inner -->

			</div><!-- END #content -->

            </div>
		</div> <!-- END #boxed-wrapper -->
        <footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
                <div class="inner">
                    <div class="three column stackable doubling ui grid">
                       <div class="column">
                            <aside class="widget">
                                <h4 class="widget_heading">Donation!</h4>
                                <div class="widget_content">Progression VIP ( <?php echo numvip(); ?> ) :<br />
									<progress max="85" value="<?php
										$nombrevip = numvip();
										$nombrevip = $nombrevip * 5;
										echo $nombrevip;
									?>">
									</progress>
									
                                </div>
                            </aside>
                        </div>
                        <div class="column">
                            <aside class="widget widget_nav_menu">
                                <h4 class="widget_heading">Dernier live</h4>
                                <div class="widget_content">
									<?php
									$pushisto = $pushbullet->getPushHistory('0','','10');
									$i = 0;
									while($i <= '10'){
										$tablelast = $pushisto->{'pushes'}[$i]->{'channel_iden'};
										if($tablelast == 'ujD20yDlSuasjAcyrQ9Cmq'){
											$lastt = $pushisto->{'pushes'}[$i]->{'title'};
											$lastb = $pushisto->{'pushes'}[$i]->{'body'};
											echo $lastt .' - '. $lastb .'<br />';
										}
										$i++;
									}
									?>
									<a class="pushbullet-subscribe-widget" data-channel="gamerscity" data-widget="button" data-size="small"></a>
<script type="text/javascript">(function(){var a=document.createElement('script');a.type='text/javascript';a.async=true;a.src='https://widget.pushbullet.com/embed.js';var b=document.getElementsByTagName('script')[0];b.parentNode.insertBefore(a,b);})();</script>
                                </div>
                            </aside>
                        </div>
                        <div class="column">
                            <aside class="widget widget_nav_menu">
                                <h4 class="widget_heading">Pub</h4>
                                <div class="widget_content">
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<!-- gamers city2 -->
									<ins class="adsbygoogle"
										 style="display:inline-block;width:300px;height:250px"
										 data-ad-client="ca-pub-6022765452122758"
										 data-ad-slot="3459098722"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
                                </div>
                            </aside>
                        </div>
                       <!-- <div class="column">
                            <aside class="widget widget_twitter">
                                <h4 class="widget_heading">Twitter Feed</h4>
                                <div class="widget_content">
                                    <ul>
                                        <li>
                                        Ut enim ad minim veniam <a href="http://t.co/LRyHvAcxeF">http://t.co/LRyHvAcxeF</a><br>
                                        <small>July 17, 2014 09:07 pm</small>
                                        </li>

                                        <li>
                                        Quis nostrud exercitation <a href="http://t.co/LRyHvAcxeF">http://t.co/LRyHvAcxeF</a><br>
                                        <small>July 17, 2014 09:07 pm</small>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>-->
                    </div>
                </div>
                
                <!--<div class="footer_copy">
                    <div class="two column stackable ui grid">
                        <div class="column copy_left">
                            <p><a href="#">Music & Band Template</a> Copyright © 2014. All Rights Reserved</p>
                        </div>
                        <div class="column copy_right">
                            <p>SoundPro Music Template by <a href="http://www.wpcharming.com">WPCharming</a>.</p>
                        </div>
                    </div>
                </div> -->
            </div>
		</footer><!-- END #colophon-->
		<div id="footer"></div>
	</div><!-- END #page -->

    <!-- Footer JS -->
    <script src="assets/js/libs/semantic.min.js"></script>
    <script src="assets/js/libs/fitVids.min.js"></script>
    <script src="assets/js/libs/retina.min.js"></script>
    <script src="assets/js/libs/jquery.plugin.min.js"></script>
    <script src="assets/js/libs/jquery.countdown.min.js"></script>
    <script src="assets/js/libs/jquery.royalslider.min.js"></script>
    <script src="assets/js/libs/jquery.easing-1.3.js"></script>
    <script src="assets/js/libs/jquery.jplayer.js"></script>
    <script src="assets/js/libs/ttw-music-player.js"></script>
    <script src="assets/js/libs/owl.carousel.min.js"></script>
    <script src="assets/js/libs/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/libs/jquery.imagesloaded.min.js"></script>
    <script src="assets/js/libs/isotope.pkgd.min.js"></script>

	    <script src="assets/js/global.js"></script>
</body>
</html>