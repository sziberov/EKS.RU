<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<title>Программы</title>
<link href="/css/index.css" type="text/css" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<meta name="robots" content="nofollow">

<meta http-equiv="content-language" content="ru">
<script src="/js/domain_title.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/main.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/request.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
<script type="text/javascript">
if (window.top != window.self) window.top.location = window.self.location;
</script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">
<meta property="og:image" content="/i/eks-3.png"/>
<link rel="image_src" href="/i/eks-3.png">
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<!--<a href="/software"><h2>Программы</h2></a>-->
<h1>Программы</h1><br>
<p></p>
	<!--
	<table border="0" cellpadding="5" cellspacing="0">
		<tbody>
			<tr>
			<td>
				<img src="/i/arr_sg.gif" width="20" height="20" title="вы находитесь на первой странице">
			</td>
			<td>
				<img src="/i/arr_lg.gif" width="20" height="20" title="вы находитесь на первой странице">
			</td>
			<td>
				<font color="#808080"><b>1..8</b></font>
			</td>
			<td>
				<a href="/software.html&p=1">
					<img src="/i/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">
				</a>
			</td>
			<td>
				<a href="/software.html&amp;p=1">9..16</a>
			<td>
				<a href="/software.html&amp;p=2">
					<img src="/i/arr_e.gif" border="0" width="20" height="20" title="перейти на последнюю страницу, всего позиций - 16">
				</a>
			</td>
		</tbody>
	</table>
	-->
<p></p>

<table width="100%" border="0" cellpadding="0" cellspacing="8" class="include_0"><tbody>

<?php
$directory = $_SERVER['DOCUMENT_ROOT'] . "/show/";
$phpfiles = glob($directory . "*.php");

$i = 1;
$o = 0;

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
	echo '<td align="center" valign="center"><a href="/show/' . $paddedI . '"><img src="' . get_icon($path) . '" style="max-height: 200px; max-width: 200px" border="0"></a><p><a href="/show/' . $paddedI . '"><b>' . get_title($path) . '</b></a><br><small>' . get_date($path) . '</small></td>' . PHP_EOL;
	$i++;
	$o++;
	if ($o >= 4) { 
		echo '</tr>';
		$o = 0;
	}
}
?>

</tbody></table>

<!--
<script>
$(document).ready(function () {
    var files = ['000001.html', '000002.html', '000003.html'];

        for (i = 0; i <= files.length; i++) {
            jQuery.get(files[i], function (data) {

                var htmlstr = $.parseHTML(data);
                //alert($(htmlstr).filter('title')[0].text);
			    $('#test').append($(htmlstr).filter('title')[0].text);
            });
        }
});
</script>
<div id="test"></div>
-->

<p></p>
<!--Arrows post-->

<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>