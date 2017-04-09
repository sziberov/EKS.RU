<?php
	$value = $_POST['sort'];
	
	setcookie('sort', $value, 2147483647);
	$_COOKIE['sort'] = $value;
	
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
?>