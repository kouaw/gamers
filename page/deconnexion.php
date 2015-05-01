<?php
	$_SESSION=array(); 
	session_unset(); 
    session_destroy();
    session_write_close();
/*if($_GET['p'] != ''){
redirect($_GET['p']);	
}else{*/
cree_cookies("");
redirect('?p=index');
	die(); 
?>