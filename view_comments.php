<?php
if (isset($_SERVER['QUERY_STRING'])) {
	if(!empty($_SERVER['QUERY_STRING'])) {
		if (strpos($_SERVER['REQUEST_URI'], '?') !== false) { header('Location: /'); }
	} else { header('Location: /'); }
} else { header('Location: /'); }

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/comments/' . basename($_SERVER['QUERY_STRING']) . '.php')) { 
	header('Location: /');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html id="category_comments"><head>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
$file = $_SERVER['DOCUMENT_ROOT'].'/object/'. str_replace('view/', '', $_SERVER['QUERY_STRING']) .'.php';
$page_title = get_title($file);
?>
<title><?php echo $page_title ?></title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
</head>


<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td valign="top">

<?php
echo '<a href="/'.$_SERVER['QUERY_STRING'].'"><h1 id="page_h1">'.get_h1($file).'</h1></a><br>';
?>

</td><td width="120" valign="top" align="right"></td></tr></tbody></table>
<p>
</p>

<p>
<b>Отзывы:</b>
</p>
<p>
</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="comment"><tbody>
<tr><td></td></tr>

<?php
$comments = $_SERVER['DOCUMENT_ROOT'].'/comments/'.basename($_SERVER['QUERY_STRING']).'.php';

if (file_exists($comments)) {
	$str = file_get_contents($comments);
}

if(strlen($str)>0){
	preg_match_all('/^"(?P<title>[^"]*)"[^{]*{
					(?:(?=[^}]*\susername\s*=\s+"(?P<username>[^"]*)"))?
					(?:(?=[^}]*\scontent\s*=\s+"(?P<content>[^"]*)"))?
					(?:(?=[^}]*\sdate_2\s*=\s+"(?P<date_2>[^"]*)"))?
					(?=[^}]*\sdate_1\s*=\s+"(?P<date_1>[^"]*)")
					(?=[^}]*\id\s*=\s+"(?P<id>[^"]*)")
					(?:(?=[^}]*\stype\s*=\s+"(?P<type>[^"]*)"))?/ixsm', $str, $comments_arr_raw);
	foreach ($comments_arr_raw as $key => $value) {
		if (is_int($key)) {
			unset($comments_arr_raw[$key]);
		}
	}
	foreach($comments_arr_raw as $key => $a){
		foreach($a as $k => $v){
			$comments_arr[$k][$key] = $v;
		}
	}
	
	$current_url_file = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	
	foreach($comments_arr as $comment) {
		$comment_id = $comment['id'];
		
		if($comment['type'] != 'hide') {
			echo '<tr id="comment_' . $comment_id . '"><td style="padding-left: 0px;">';
				echo '<img src="/i/comment.gif" width="11" height="13" border="0" align="left" style="margin-right: 8px;">';
				echo '<a href="' . $_SERVER['REQUEST_URI'] . '#' . $comment_id . '"><b>' . $comment['title'] . '</b></a>';
				echo '<br>';
				echo '<a href="/user/'.$comment['username'].'">' . $comment['username'] . '</a>, <small>' . $comment['date_1'] . '<span class="modify_time">, ' . $comment['date_2'] . '</span></small>';
				echo '<p>' . $comment['content'] . '</p>';
				
				echo '<p>';
				if ($_COOKIE['u_log'] == $comment['username'] || $_COOKIE['u_access'] >= '2') {
					echo '<span class="r_button_small"><a href="/delete_link?original_id='.$current_url_file.'&id='.$comment_id.'&link_type=2">удалить</a></span>';
				}
				if ($_COOKIE['u_access'] >= '2') {
					echo '<span class="r_button_small"><a href="/hide_link?original_id='.$current_url_file.'&id='.$comment_id.'&link_type=2">скрыть</a></span>';
				}
				echo '</p>';
			echo '</td></tr>';
		} else 
		if($comment['type'] == 'hide') {
			echo '<tr><td style="padding-left: 0px;">';
				echo '<img src="/i/comment.gif" width="11" height="13" border="0" align="left" style="margin-right: 8px;">';
				echo 'Нет доступа к объекту '.$comment_id.'.';
				echo '<p>';
				if ($_COOKIE['u_access'] >= '2') {
					echo '<span class="r_button_small"><a href="/unhide_link?original_id='.$current_url_file.'&id='.$comment_id.'&link_type=2">показать</a></span>';
				}
				echo '</p>';
			echo '</td></tr>';
		}
	}	
}
?>

<script>
<?php

echo 'var element_to_scroll_to = document.getElementById("comment_' . $_SERVER["REQUEST_URI"]["fragment"] . '");';
?>
	
	element_to_scroll_to.scrollIntoView();
</script>
</tbody></table>

<p>
<?php include($root . "/include/user_btns.php"); ?>
</p>

<?php include($root . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>