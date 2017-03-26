<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
$query = trim(htmlspecialchars($_GET["s"]), " ");

if(strlen($query)>0){
	echo '<title>Поиск "' . $query . '"</title>';
} else {
	echo '<title>Поиск</title>';
}
?>
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

<!--<p>Извините, поиск невозможен.</p>-->

<script src='/js/search_hint-0.03.js' type='text/javascript'></script>

<style type="text/css">
	#body_element {padding: 0 !important;}
	#search_box, #search_link {width: 100%; height: 240px;}
	#search_box {background-position: top center;}
	#search_help {position: static;}
	#search_line, #search_text {width: 400px;}
	#search_text {box-sizing: border-box; height: 31px; border-radius: 3px; border: 1px solid #a9a9a9; padding-left: 5px;}
	#search_line {margin-bottom: 10px; position: absolute; left: 0; top: 0;}
	#search_button {position: absolute; left: 410px; top: 0; height: 31px;}
	#search_help {text-align: left; width: auto;}
</style>

<script>	
	function check_length(name) {
		var query = document.getElementById(name).value;

		if (query.length < 4) {
			alert('Поисковой запрос должен содержать минимум 4 символа!');
		}
	}
</script>

<form name="search" action="/search" id="search_form">
	<div style="padding:16px">
		<div style="position: relative; height: 40px;">
			<div id="search_line">
				<input type="text" name="s" value="<?php echo trim(htmlspecialchars($_GET["s"]), " "); ?>" autocomplete="off" id="search_text">
				<div id="search_hint" style="display: none;"></div>
			</div>
			<input type="submit" value="поиск" class="button ex" id="search_button" min="3">
		</div>

		
		<div id="search_help">
			Не можете найти что-то - напишите в
			<a href="https://vk.com/eks_my1_ru"><b>нашу группу ВК</b></a>.
		</div>
	</div>
</form>

<div style="padding:16px">
	<?php
	if(strlen($query)>0){
		echo '<p>Поиск "<b>' . $query . '</b>":</p>';
	}
	?>
	<p>
	</p>
	<table width="100%" border="0" cellpadding="0" cellspacing="8" class="panel"><tbody>

	<?php
	if(strlen($query)>0){
		include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
		
		foreach($phpfiles as $phpfile) {
			$path = $root . "/show/" . basename($phpfile);

			$paddedI = str_pad($i, 6, "0", STR_PAD_LEFT);
			
			if (stripos(check_query($path), $query) !== false || stripos(get_title($path), $query) !== false){
				echo '<tr><td>';
				echo '<p>';
					echo '<a href="/show/' . $paddedI . '">';
						if (stripos(get_title($path), $query) !== false) {
							echo '<img src="' . get_icon($path) . '" border="0" align="left" style="max-width: 200px; max-height: 200px; margin: 0 16px 8px 0;" alt="' . get_title($path) . '" title="' . get_title($path) . '">';
						} else {
							echo '<img src="' . get_icon($path) . '" border="0" align="left" style="max-width: 100px; max-height: 100px; margin: 0 16px 8px 0;" alt="' . get_title($path) . '" title="' . get_title($path) . '">';
						}
					echo '</a>';
					echo '<a href="/show/' . $paddedI . '">';
						echo '<b>' . get_title($path) . '</b>';
					echo '</a>';
					echo '<br>';
					echo '<small>' . get_date($path) . '</small>';
				echo '</p>';
				echo '<p>';
					echo get_main_info($path). '<br>';
					echo '...';
				echo '</p>';
				echo '<p>';
					$dir = $root . "/load/" . $paddedI;
					include($root . "/include/files_count.php");
					echo '<small>Файлов: ' . $file_count . ', суммарный размер: ' . number_format(getDirectorySize($dir)) . '</small>';
				echo '</p>';
				echo '</td></tr>';
			}
			$i++;
		}
	}
	?>

	</tbody></table>
</div>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>