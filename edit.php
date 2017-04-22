<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");

$original_id = $_SERVER['QUERY_STRING'];

if(!isset($_COOKIE['u_log']) && !isset($_COOKIE['u_pass'])){
   header('Location: /login?d=1');
}

if(isset($_COOKIE['saveStatus']) && $_COOKIE['saveStatus'] == 'upload_success') {
	$saveStatus = 'upload_success';
} else 
if(isset($_COOKIE['saveStatus']) && $_COOKIE['saveStatus'] == 'upload_error') {
	$saveStatus = 'upload_error';
} 

$submit = 0;

if(isset($_COOKIE['saveStatus'])) {
	unset($_COOKIE['saveStatus']);
	setcookie('saveStatus', null, -1, '/');

	$submit = 1;
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Редактирование</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
</head>


<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); 
?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div class="drag_area"><span>Перетащите файлы сюда</span></div>

<p>
<script>
function viewObject()
{
	window.location = '<?php echo '/view_comments/'.$original_id ?>';
	return true;
}

function viewBack()
{

	var f = document.forms['edit'];
	if (f)
	{
		var back = f.elements['back'].value;
		if (back)
		{
			window.location = back;
			return true;
		}
	}

	history.back();
	return false;
}
</script>
</p>
<?php /*error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 1); ini_set('html_errors', 1);*/ ?>
<form name="edit" method="post" action="/add_comment">
<table width="100%" border="0" cellpadding="4" cellspacing="8" id="editor_table"><tbody>
	<input type="hidden" name="back" value="<?php echo '/'.$original_id ?>">
	<input type="hidden" name="date_1" value="<?php
	date_default_timezone_set('UTC');
	function date_offset($format, $offset) {
	  $time = time() + $offset; # $offset should be in milliseconds
	  return date($format, $time); # with your require display format $format
	}

	$monthes = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');
	echo date_offset('G:i, j ', 10800) . $monthes[(date_offset('n', 10800))] . date_offset(' Y', 10800);
	?>">
	
	<tr>
		<td colspan="3" align="center"><h1>Редактирование</h1></td>
	</tr>
	<tr>
		<td width="120" align="right">заголовок:</td>
		<td><input type="text" name="title" value="<?php echo $_REQUEST["title"] ?>" style="width: 100%" maxlength="255"></td>
		<td rowspan="2" width="120" valign="top" align="right"></td>
	</tr>
	<!--
	<tr>
		<td width="120" align="right">имя:</td>
		<td><input id="latin" type="text" name="username" value="" style="width: 100%" maxlength="15" pattern="[a-zA-Z0-9 ]+"></td>
		<td rowspan="2" width="120" valign="top" align="right"></td>
		<script>
			$("#latin").on("keypress", function (event) {
				var englishAlphabetDigitsAndWhiteSpace = /[A-Za-z0-9 ]/g;
				var key = String.fromCharCode(event.which);

				if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetDigitsAndWhiteSpace.test(key)) {
					return true;
				}
				return false;
			});

			$('#latin').on("paste", function (e) {
				e.preventDefault();
			});
		</script>
	</tr>
	-->
	<tr>
		<td align="right">текст:</td>
		<td><textarea name="post" value="<?php echo $_REQUEST["post"] ?>" rows="16" style="width: 100%" maxlength="65535"></textarea></td>
	</tr>

	<tr><td></td><td>
		<input type="submit" value="сохранить" class="button">&nbsp;
		<input type="button" value="вернуться" class="button" onclick="viewBack();">&nbsp;
		<input type="button" value="смотреть" class="button" onclick="viewObject();">&nbsp;

		<?php 
		echo '<span id="saveStatus"';
		if(isset($saveStatus) && $saveStatus == 'upload_success') {
			echo ' class="upload_success">сохранен';
		} else 
		if(isset($saveStatus) && $saveStatus == 'upload_error') {
			echo ' class="upload_error">ошибка при сохранении';
		} 
		echo '</span>';
		?>
		<script>
			setTimeout(function(){
				var item = document.getElementById('saveStatus');
				item.innerHTML = "";
				$("#saveStatus").removeClass()
				/*item.parentNode.removeChild(item);*/
			}, 2000);
		</script>
	</td><td></td></tr>

</tbody></table>
</form>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>