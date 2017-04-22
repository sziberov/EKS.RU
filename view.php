<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php"); 
$object_file = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$current_object = $_SERVER['DOCUMENT_ROOT'] . "/object/" . $object_file . '.php';

if (isset($_SERVER['QUERY_STRING'])) {
	if(!empty($_SERVER['QUERY_STRING'])) {
		if (strpos($_SERVER['REQUEST_URI'], '?') == false) {
			$current_url_object = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		} else { header('Location: /'); }
		if (!file_exists($current_object)) { header('Location: /'); }
	} else { header('Location: /'); }
} else { header('Location: /'); }

$paddedI = $current_url_object;
$title = get_title($current_object);
$poster = get_icon($current_object);
$date = get_date($current_object);
$post = get_post($current_object);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html id="<?php echo get_category($current_object) ?>"><head>

<?php
echo '<title>' . $title . '</title>';

$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="title" content="<?php echo $title; ?>">
<meta name="description" content="...">

<script src="/js/swfobject.js"></script>
<script src="/js/jquery-3.1.1.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/jquery-ui.js" charset="utf-8" type="text/javascript"></script>
<link href="/css/jquery-ui.css" type="text/css" rel="stylesheet">
<script src="/js/jquery-ui.min.js" charset="utf-8" type="text/javascript"></script>
<link href="/css/jquery-ui.min.css" type="text/css" rel="stylesheet">
<link href="/css/jquery-ui.structure.css" type="text/css" rel="stylesheet">
<link href="/css/jquery-ui.structure.min.css" type="text/css" rel="stylesheet">
<link href="/css/concat.css" type="text/css" rel="stylesheet">
<script src="/js/VPAIDFLASHClient.js"></script>
<script src="/js/VPAIDHTML5mixer.js"></script>
<script src="/js/VastToJson.js"></script>
<script src="/js/concat.js"></script>
<script src="/js/clipboard.min.js"></script>
<link href="/css/express_send.css" type="text/css" rel="stylesheet">
<link href="/css/mail.css" type="text/css" rel="stylesheet">
<link href="/css/fox-copy.css" type="text/css" rel="stylesheet">
<script src="/js/arr_btns.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
<script type="text/javascript">
if (window.devicePixelRatio) document.cookie = 'udpr=' + window.devicePixelRatio + ';path=/';
// if (window.top != window.self) window.top.location = window.self.location;
</script>
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php 
	$root = $_SERVER['DOCUMENT_ROOT']; 
	$key = "load/" . $current_url_object;
?>
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div class="note_wr" id="fox_note"><div class="notify_bl">Ссылка скопирована в буфер обмена!</div></div>	

<?php
echo get_h2($current_object);
?>

<p id="arr_btns">
	&nbsp;
	<span class="small">←&nbsp;Ctrl&nbsp;→</span>
	&nbsp;
</p>	

<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td valign="top">
<?php
//if(file_exists($root . get_icon($current_object))) {
	echo '<img id="poster" alt="'.$title.'" src="'.$poster.'" style="margin: 0 16px 8px 0; max-height: 800px; max-width: 800px;" title="'.$title.'" align="left" border="0">';
//};
?>
<h1 id="page_h1"><?php echo $title; ?></h1><br>
<small id="upload_time"><?php echo $date; ?><!--<script src="/js/lastmodified.js">--></small>
<p>
</p>
<div id="post">
	<?php echo $post; ?>
</div>

</td></tr></tbody></table>
<p>
<script src="/js/drag.js" type="text/javascript"></script>
<script src="/js/viewer.js" type="text/javascript"></script>
</p>

<div id="viewer" style="visibility: hidden; position: fixed; width: 320px; height: 260px; right: 16px; top: 32px; border: 1px solid rgb(68, 68, 68); background-color: rgb(221, 221, 221); z-index: 7;" onmousedown='dragStart(event, "viewer");' onclick="if (!drag_count) view_next();">
<button style="position: absolute; width: 16px; height: 16px; right: 2px; top: 2px; margin-top: 2px; margin-right: 4px;" title="Закрыть окно" onclick="view_close(event);"></button>
<center><img id="viewer_img"></center>
</div>

<!--<span class="r_button"><a data-index="0" class="fox-play-btn" href="http://www.ex.ua/load/260648464" rel="nofollow" onclick="return false;">играть</a></span>-->

<table id="file_list" class="list" style="padding-top: 8px" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>
<tr>
<?php 
$dir = $root . "/" . $key;

function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}

if (file_exists($dir)) {
	if (is_dir($dir)) {
		if (!is_dir_empty($dir)) {
			include($root . "/include/files_count.php");

			echo '<td colspan="3" valign="bottom"><b>Файлы:</b><br><small>Кол-во: '.$file_count.'</span>, суммарный размер: '.number_format(getDirectorySize($dir)).'</small></td>';
		}
	}
}
?>
<td align="right" nowrap="nowrap" valign="bottom">&nbsp;
<!--		Player	1		-->

<!--<span class=r_button><a id='player_toggle' href='/' onclick='return toggle();'>показать проигрыватель</a></span>-->

<div class="vpaidContainer"></div>

<div class="fox_collapse_bl" style="display: none;">
	<span></span>
	<div>
		<i class="fox_expand_player"></i>
		<i class="fox_close_player"></i>
	</div>
</div>

<script src="/js/player.js" type="text/javascript"></script>
<script src="/js/player-ad.js" type="text/javascript"></script>

<!--		Player 1 End		-->
</td>
</tr>

<?php include($root . "/include/flist_gnrt.php"); ?>

<!--		Player	2		-->
<?php
if (!empty($vid_arr)) {
	echo '
	<script>
		var vjsCover = {"cover": "'.$poster.'", };

		var kids_vast_url = "";

		var player_conf = {
			cover: {url: vjsCover.cover},
			playlist: [
			';
				$vid_i = 1;
				foreach($vid_arr as $vid_file) {
					$filename = basename($vid_file);
					$filepath = $dir . "/" . $filename;
					$filepath_relative = "/" . $key . "/" . $filename;
					echo '{ "title": "'.$filename.'", "type": "video", "src": "'.$filepath_relative.'", "pos": "'.$vid_i.'"}, ';
					$vid_i++;
				}
	echo '
			],
			techOrder: ["html5", "flash"],
			adsOptions: {
				isMinuteBlock: true,

				pre: [],

				post: [
					{url: ""}
				],
				
				afterpaus: [
					{url: ""}
				],

				overlay: [
					{url: ""}
				],

				debug: false,
				timeout: 2000,
				prerollTimeout: 2000
			}
		};

		if ($poster.length && !p) {
			var hd_ratio = 1080 / 1920;
			var first_video_ratio = 0.5;
			player_conf.width = $poster.width();
			player_conf.height = $poster.width() * (first_video_ratio >= hd_ratio && first_video_ratio <= 1 ? first_video_ratio : hd_ratio);
			no_cats = true;
			/*clickPlayer(0, true);*/
		}
	</script>
	';
}
?>
<!--		Player 2 End		-->
</tbody></table>
<?php include($root . "/include/flist_wrn.html"); ?>

<?php
if (file_exists($dir)) {
	if (is_dir($dir)) {
		if (is_dir_empty($dir)) { echo '<script id="remove_fl">$("#file_list").remove(); $("#remove_fl").remove();</script>'; }
	} else { echo '<script id="remove_fl">$("#file_list").remove(); $("#remove_fl").remove();</script>'; }
} else { echo '<script id="remove_fl">$("#file_list").remove(); $("#remove_fl").remove();</script>'; }
?>

<?php include($root . "/include/user_btns.php"); ?>
<?php include($root . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>