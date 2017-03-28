<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$phpfiles = glob($directory . "*.php");

function get_category($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/\<html.*id\=\"(.*?)\"\>/i", $str, $domain_category); 
		return $domain_category[1];
	}
}

function check_query($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/<div.id=.post.>(.*?)<\/div>/is", $str, $check_query); 
		return $check_query[1];
	}
}

function get_main_info($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/<p.id=.main_info.>(.*?)<\/p>/is", $str, $main_info); 
		return $main_info[1];
	}
}

function get_title($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
		preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
		return $title[1];
	}
}

function get_date($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/\<small.*id\=.upload_time.\>(.*)\<\/small\>/i", $str, $small);
		return $small[1];
	}
}

function get_icon($url) {
	global $i;
	global $paddedI;
	
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match('/id=\"poster\".*src=\"([^"]+)\"/i', $str, $icon_src);
	}
	$string = $icon_src[1];
	$pattern = '/\<([^"]+)\>/i';
	$replacement = "load/" . $paddedI;
	$count = null;
	return preg_replace($pattern, $replacement, $string, -1, $count); 
}

include($root . "/include/files_info_size.php");
?>