<?php
$directory = $_SERVER['DOCUMENT_ROOT'] . "/show/";
$phpfiles = glob($directory . "*.php");

$i = 1;
$o = 0;

function get_category($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/\<html.*id\=\"(.*?)\"\>/i", $str, $domain_category); 
		return $domain_category[1];
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
			
echo '<tr>';
foreach($phpfiles as $phpfile) {
	$path = $_SERVER['DOCUMENT_ROOT'] . "/show/" . basename($phpfile);

	$paddedI = str_pad($i, 6, "0", STR_PAD_LEFT);
	
	if (get_category($path) == $category) {
		echo '<td align="center" valign="center"><a href="/show/' . $paddedI . '"><img src="' . get_icon($path) . '" style="max-height: 200px; max-width: 200px" border="0"></a><p><a href="/show/' . $paddedI . '"><b>' . get_title($path) . '</b></a><br><small>' . get_date($path) . '</small></td>' . PHP_EOL;
	}
	$i++;
	$o++;
	if ($o >= 4) { 
		echo '</tr>';
		$o = 0;
	}
}
?>