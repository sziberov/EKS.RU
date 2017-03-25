<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html id="domain_video"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<title>Test Video</title>
<link href="/css/index.css" type="text/css" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<meta name="robots" content="nofollow">

<meta http-equiv="content-language" content="ru">
<script src="/js/domain_title.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/main.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/request.js" charset="utf-8" type="text/javascript"></script>
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
<script src="/js/arr_btns.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
<script type="text/javascript">
if (window.devicePixelRatio) document.cookie = 'udpr=' + window.devicePixelRatio + ';path=/';
// if (window.top != window.self) window.top.location = window.self.location;
</script>

<meta name="title" content="Test Video">
<meta name="description" content="...">
<meta property="og:image" content="/i/eks-3.png"/>
<link rel="image_src" href="/i/eks-3.png">
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php 
	$root = $_SERVER['DOCUMENT_ROOT']; 
	$key = "load/" . basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div class="note_wr" id="fox_note"><div class="notify_bl">Ссылка скопирована в буфер обмена!</div></div>	

<a href="/video"><h2>Видео</h2></a>

<p id="arr_btns">
	&nbsp;
	<span class="small">←&nbsp;Ctrl&nbsp;→</span>
	&nbsp;
</p>	

<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td valign="top">
<img id="poster" alt="Test Video" src="/<?php echo $key ?>/724px-Big_buck_bunny_poster_big.jpg" style="margin: 0 16px 8px 0; max-height: 512px; max-width: 512px;" title="Test Video" align="left" border="0">
<h1>Test Video</h1><br>
<small id="upload_time">23 марта 2017<span class="modify_time">, не редактировалось <!--<script src="/js/lastmodified.js">--></span></small>
<p>
</p>
<div id="post">
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

<table id="file_list" class="list" style="padding-top: 8px" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>

<?php include($root . "/include/files_info_size.php"); ?>
<td colspan="3" valign="bottom"><b>Файлы:</b><br><small>Кол-во: <span id="file_count"></span>, суммарный размер: <?php echo number_format(getDirectorySize($root . "/" . $key)); ?></small></td>
<td align="right" nowrap="nowrap" valign="bottom">&nbsp;

<!--		Player		-->

<div id="player" style="visibility: hidden; position: fixed; width: 720px; height: 526px; right: 16px; top: 32px; border: 1px solid #444; background-color: #000; z-index: 99999;">
 <div style="width: 720px; height: 20px; background-color: #888" onmousedown='dragStart(event, "player");'><span id="player_title" style="float: left; padding: 2px 4px 0 8px; cursor: default;"></span>
  <button style="float: right; width: 16px; height: 16px; margin-top: 2px; margin-right: 4px;" title="Скрыть проигрыватель" onclick="toggle();"></button>
 </div>
 <div id="player_window" style="width: 720px; height: 506px; text-align: center; background-color: #ccc;"></div>
</div>

<!--<span class=r_button><a id='player_toggle' href='/103004334' onclick='return toggle();'>показать проигрыватель</a></span>-->

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
<script>
	var vjsCover = {"cover": "/load/000011/724px-Big_buck_bunny_poster_big.jpg", };

	var kids_vast_url = '';

	var player_conf = {
		cover: {url: vjsCover.cover},
		playlist: [
		 	{ "title": "VfE_html5.mp4", "type": "video", "src": "/load/000011/VfE_html5.mp4", "pos": "1"},
			{ "title": "test.mkv", "type": "video", "src": "/load/000011/test.mkv", "pos": "2"}
		],
		techOrder: ['html5', 'flash'],
		adsOptions: {
			isMinuteBlock: true,

			pre: [],

			post: [
				{url: ''}
			],
			
			afterpaus: [
				{url: ''}
			],

			overlay: [
				{url: ''}
			],

			debug: false,
			timeout: 2000,
			prerollTimeout: 2000
		}
	};
</script>

<!--		Player End		-->

</td>
</tr>

<tr>
	<?php $filepath = ("../" . $key . "/724px-Big_buck_bunny_poster_big.jpg"); $filename = end(explode('/', $filepath)); ?>
	<td width="17"><img src="/i/i_disk.svg" border="0" height="17" width="17"></td>
	<td><span class="small"><script>document.write($('#file_list tbody tr').length - 1)</script>.</span><br><?php echo '<a id="file_name"'; if (file_exists($filepath)) { echo 'href="' . $filepath . '"'; } echo 'title="' . $filename . '"></a>'; ?></td>
		<?php include($root . "/include/file_info_php.php"); ?>
		<script>
			var url = new URL(window.location.origin + "/<?php echo $key ?>/724px-Big_buck_bunny_poster_big.jpg");
			<?php include($root . "/include/file_info_js.html"); ?>
		</script>
	</td>
</tr>

<tr>
	<?php $filepath = ("../" . $key . "/VfE_html5.mp4"); $filename = end(explode('/', $filepath)); ?>
	<td width="17"><img src="/i/i_disk.svg" border="0" height="17" width="17"></td>
	<td><span class="small"><script>document.write($('#file_list tbody tr').length - 1)</script>.</span><br><?php echo '<a id="file_name"'; if (file_exists($filepath)) { echo 'href="' . $filepath . '"'; } echo 'title="' . $filename . '"></a>'; ?></td>
		<?php include($root . "/include/file_info_php.php"); ?>
		<script>
			var url = new URL(window.location.origin + "/<?php echo $key ?>/VfE_html5.mp4");
			<?php include($root . "/include/file_info_js.html"); ?>
		</script>
	</td>
</tr>

<tr>
	<?php $filepath = ("../" . $key . "/test.mkv"); $filename = end(explode('/', $filepath)); ?>
	<td width="17"><img src="/i/i_disk.svg" border="0" height="17" width="17"></td>
	<td><span class="small"><script>document.write($('#file_list tbody tr').length - 1)</script>.</span><br><?php echo '<a id="file_name"'; if (file_exists($filepath)) { echo 'href="' . $filepath . '"'; } echo 'title="' . $filename . '"></a>'; ?></td>
		<?php include($root . "/include/file_info_php.php"); ?>
		<script>
			var url = new URL(window.location.origin + "/<?php echo $key ?>/test.mkv");
			<?php include($root . "/include/file_info_js.html"); ?>
		</script>
	</td>
</tr>

</tbody></table>
<span class="small">Некоторые из ссылок представленных выше могут вести на сторонний ресурс, это необходимо для экономии места на основном хостинге.</span>

<script src="/js/file_count.js"></script>

<p>
</p>

<?php include($root . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>