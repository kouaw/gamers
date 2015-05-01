<?php
include('functions.php');
if($_GET['id'] == '1'){
	$live1 = veriflive('1');
	echo "$live1";	
}elseif($_GET['id'] == '2'){
	$live2 = veriflive('2');
	echo "$live2";	
}elseif($_GET['id'] == '3'){
	$live3 = veriflive('3');
	echo "$live3";
}
?>