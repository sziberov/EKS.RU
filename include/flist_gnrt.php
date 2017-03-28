<?php
$files = glob($dir . "/*");

$i = 1;

$img_arr = array();
$vid_arr = array();
$els_arr = array();

foreach($files as $file) {
	$mime = mime_content_type($file);
	if (strstr($mime, "image/")){
		$img_arr[] = $file;
	} else
	if(strstr($mime, "video/")){
		$vid_arr[] = $file;
	} else {
		$els_arr[] = $file;
	}
}

foreach($img_arr as $img_file) {
	$filepath = $dir . "/" . basename($img_file);
	$filepath_relative = "/" . $key . "/" . basename($img_file);
	include($root . "/include/flist_gnrt_feach.php");
}
foreach($vid_arr as $vid_file) {
	$filepath = $dir . "/" . basename($vid_file);
	$filepath_relative = "/" . $key . "/" . basename($vid_file);
	include($root . "/include/flist_gnrt_feach.php");
}
foreach($els_arr as $els_file) {
	$filepath = $dir . "/" . basename($els_file);
	$filepath_relative = "/" . $key . "/" . basename($els_file);
	include($root . "/include/flist_gnrt_feach.php");
}
?>