<?php if(!isset($_COOKIE['sort'])) { setcookie('sort', 'new_start', 2147483647); $_COOKIE['sort'] = 'new_start'; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Программы</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
</head>

<?php
$category = 'domain_software';

$directory = $_SERVER['DOCUMENT_ROOT'] . "/object/";
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
?>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<h1 id="page_h1">Программы</h1><br>
<p></p>
<!--Nav sort start-->
<table border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td>
		<form method="post" action="/sort" name="select_view">
			<!--
			<select class="small" name="view_id" onchange="selectView();"><option>картинками</option><option>списком</option></select>
			-->
			<select class="small" name="sort" onchange="if (this.form) this.form.submit();">
				<option <?php if(isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'new_start') echo 'selected'; ?> value="new_start">новое в начале</option>
				<option <?php if(isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'new_end') echo 'selected'; ?> value="new_end">новое в конце</option>
			</select>
		</form>
	</td>

	<!--
	<td width="20">&nbsp;</td><td>
		<form name="search" action="http://www.ex.ua/search">
			<input type="hidden" name="original_id" value="50911">
			<input type="text" name="s" value="" style="width: 180px;">
			<input type="submit" value="поиск в разделе" class="small_button"><br>
		</form>
	</td>
	-->
</tr></tbody></table>
<!--Nav sort end-->
<p></p>
<!--Nav arrows top start-->
<table border="0" cellpadding="5" cellspacing="0"><tbody><tr>
	<?php include($root . "/include/category_nav.php"); ?>
</tr></tbody></table>
<!--Nav arrows top end-->
<p></p>
<!--Category objects start-->
<table width="100%" border="0" cellpadding="0" cellspacing="8" class="include_0"><tbody>
	<?php include($root . "/include/category_objects.php"); ?>
</tbody></table>
<!--Category objects end-->
<p></p>
<!--Nav arrows bottom start-->
<table border="0" cellpadding="5" cellspacing="0"><tbody><tr>
	<?php include($root . "/include/category_nav.php"); ?>
</tr></tbody></table>
<!--Nav arrows bottom end-->
<p>
<?php include($root . "/include/comment_btn.php"); ?>
</p>

<?php include($root . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>