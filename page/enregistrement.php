<?php
/* On crée la variable login qui prend la valeur POST envoyée
car on va l'utiliser plusieurs fois */
$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$ip = $_SERVER['REMOTE_ADDR'];
$key = sha1(genererMDP('40').'-'.uniqid());
if($login != '' and $email != '' and $pass != ''){
$db = db_connect();
// On crée une requête pour rechercher un compte ayant pour nom $login
$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login or account_ip = :ip or account_email = :email ");
$query->execute(array(
	'login' => htmlspecialchars(strtoupper($login)),
	'ip' => $ip,
	'email' => $email
));
// On compte le nombre d'entrées
$count=$query->rowCount();		
// Si ce nombre est nul, alors on crée le compte, sinon on le connecte simplement
if($count == '0' ) {	
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	// Création du compte
	$insert = $db->prepare('
		INSERT INTO chat_accounts (account_id, account_login, account_pass, account_email, account_ip, account_etat, account_key) 
		VALUES(:id, :login, :pass, :email, :ip, :level, :key)
	');
	$insert->execute(array(
		'id' => '',
		'login' => htmlspecialchars(strtoupper($login)),
		'pass' => sha1(strtoupper(htmlspecialchars($login)).':'.strtoupper(htmlspecialchars($pass))),
		'ip' => $ip,
		'key' => $key,
		'level' => 2,
		'email' => $email
	));
				
	/* Création d'une session id ayant pour valeur le dernier ID créé
	par la dernière requête SQL effectuée */
	$_SESSION['id'] = $db->lastInsertId();
	// On crée une session time qui prend la valeur de la date de connexion
	$_SESSION['time'] = time();
	$_SESSION['login'] = $login;
	$_SESSION['avatar'] = $data['account_avatar'];
	$_SESSION['level'] = $data['account_level'];
	$_SESSION['etat'] = 2;
	//$message_txt = "Bonjour, votre compte a etait crée sur le site Gamers-city mais reclame une dernière etape vous devez l'active via le lien suivant : http://www.gamers-city.eu/?p=activation&key=".$key.",Merci de votre inscription ";
	//$message_html = "<html><head></head><body><b>Bonjour".$login."</b>,<br /> votre compte a était crée sur le site Gamers-city mais réclame une dernière étape vous devez l'active via le lien suivant : <a href='http://www.gamers-city.eu/?p=activation&key=".$key."'>http://www.gamers-city.eu/?p=activation&key=".$key."</a>.<br />Merci de votre inscription.<br /> Gamers City </body></html>";
	//sendmail($email,'Activation Compte site Gamers-city',$message_txt,$message_html);
		redirect('?p=index');
	}else{
		$var = 'Email non valide';
	}
}
}else{
	$var = 'Un champs n\'est pas remplie';
} 
if($var != ''){			
// On termine la requête
?>
			<div id="content" class="site-content single">

				<div class="page-inner">
					<div class="container">
                    
						<div id="primary" class="content-area">
							
                            <header class="page-header">
                                <h1 class="nomargin" style="text-align:center;">Erreur d'enregistrement</h1>
                            </header>

                            <div class="recent_news bigthumb">

                                <article class="post clearfix">
                                    <!--<div class="entry-thumb">-->
	  <p><?php echo $var; ?></p>
        <a class="btn-s2" onClick="history.go(-1);return true;">Retour a la page precedente.</a>
        <a class="btn-s2" href="?p=index">Retour a la page d'accueil</a>
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
  <?php } ?>