<?php
if(strlen($_POST['title']) == 0){
	$title = 'без заголовка';
} else {
	$title = $_POST['title'];
}
//$username = str_replace(' ', '_', trim($_POST['username'], " "));
$username = $_COOKIE['u_log'];
$date_1 = $_POST['date_1'];

date_default_timezone_set('UTC');
function date_offset($format, $offset) {
  $time = time() + $offset; # $offset should be in milliseconds
  return date($format, $time); # with your require display format $format
}

$monthes = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');
$date_2 = date_offset('G:i, j ', 10800) . $monthes[(date_offset('n', 10800))] . date_offset(' Y', 10800);

$content_raw = $_POST['post'];
$content_semiraw = preg_replace("/\r\n|\r|\n/",'<br>'.PHP_EOL,$content_raw);
$remove_script = '/\<script.*\<\/script\>/iU';
$content = preg_replace('#^(( ){0,}<br( {0,})(/{0,1})>){1,}#i', '', preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', trim(strip_tags(preg_replace($remove_script, '', $content_semiraw), '<br><b><i><em><strong><small><ins><del><sub><sup>'))));
$content = str_replace('{', '&#x7B;', $content);
$content = str_replace('}', '&#x7D;', $content);
$content = str_replace('"', '&#x22;', $content);

$root = $_SERVER['DOCUMENT_ROOT'];
$category = basename($_POST['back']);

$upload_id = $_POST['upload_id'];

$file_path = $_SERVER['DOCUMENT_ROOT']."/object/".$upload_id.".php";

if ($username != null) {
file_put_contents($file_path,

'<html id="category_' . $category . '">

<title>' . $title . '</title>

<img id="poster" src="icon.png">

<h1 id="page_h1">' . $title . '</h1><br>

<small id="upload_time">' . $date_1 . '<span class="modify_time">, ' . $date_2 . '</span></small>

<div id="post">
' . $content . '
</div>'

);
	
	setcookie('saveStatus', 'upload_success', 2147483647);
	$_COOKIE['saveStatus'] = 'upload_success';
} else 
if ($username == null) {
	setcookie('saveStatus', 'upload_error', 2147483647);
	$_COOKIE['saveStatus'] = 'upload_error';
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>

