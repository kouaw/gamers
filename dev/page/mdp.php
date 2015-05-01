<?php
if(!empty($_POST)){
	$query = $db->prepare("
	SELECT * FROM chat_accounts	WHERE account_email = :email and account_login = :login
");
$query->execute(array(
	'email' => $_POST['email'],
	'login' => strtoupper($_POST['login'])
));
// On compte le nombre de membres
$count = $query->rowCount();
if($count == '1'){
    $pass = genererMDP();
    	$query = $db->prepare("
	UPDATE chat_accounts set account_pass = :pass	WHERE account_email = :email and account_login = :login
");
$query->execute(
array(
	'email' => $_POST['email'],
	'login' => strtoupper($_POST['login']),
    'pass' => sha1(strtoupper($_POST["login"]).':'.strtoupper($pass))
));
$text = "Votre nouveaux mot de passe est".$pass.".";
$text_h = "Votre nouveaux mot de passe est<b>".$pass."</b>.";
$email = $_POST['email'];
sendmail($email,'Nouveaux mot de passe',$text,$text_h);
?>
			<div id="content" class="site-content single">

				<div class="page-inner">
					<div class="container">
                    
						<div id="primary" class="content-area">
							
                            <header class="page-header">
                               <h1 class="nomargin" style="text-align:center;">Mot de passe oublié</h1>
                            </header>

                            <div class="recent_news bigthumb">

                                <article class="post clearfix">
                                    <!--<div class="entry-thumb">-->
<div class="message success">Votre nouveaux mot de passe vous a était envoyer!</div>
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
}else{
	?>
			<div id="content" class="site-content single">

				<div class="page-inner">
					<div class="container">
                    
						<div id="primary" class="content-area">
							
                            <header class="page-header">
                               <h1 class="nomargin" style="text-align:center;">Mot de passe oublié</h1>
                            </header>

                            <div class="recent_news bigthumb">

                                <article class="post clearfix">
                                    <!--<div class="entry-thumb">-->
<div class="message error">Mauvais email ou login!.</div>
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
}
}
?>
			<div id="content" class="site-content single">

				<div class="page-inner">
					<div class="container">
                    
						<div id="primary" class="content-area">
							
                            <header class="page-header">
                               <h1 class="nomargin" style="text-align:center;">Mot de passe oublié</h1>
                            </header>

                            <div class="recent_news bigthumb">

                                <article class="post clearfix">
                                    <!--<div class="entry-thumb">-->

					<form action="?p=mdp" method="post" name="mdp" >
					<p>
					Login:<br />
                    <input name="login" class="text-box" type="text" size="100" placeholder="Pseudo" required />
					</p>
					<p>
					Email:<br />
                    <input name="email" class="text-box" type="email" size="100" placeholder="Email" required />
					</p>
                    <button type="submit" class="button orange">Mot de pass oublié</button>

</form>
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