<?php
	$value = $_POST['time_region'];
	
	setcookie('time_region', $value, 2147483647);
	$_COOKIE['time_region'] = $value;
	
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
?>