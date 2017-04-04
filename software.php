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

$directory = $_SERVER['DOCUMENT_ROOT'] . "/show/";
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
?>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<h1>Программы</h1><br>
<!--Nav arrows top-->
<p></p>
	<table border="0" cellpadding="5" cellspacing="0"><tbody><tr>
		<?php include($root . "/include/category_nav.php"); ?>
	</tr></tbody></table>
<p></p>
<!--Nav arrows top-->
	
<table width="100%" border="0" cellpadding="0" cellspacing="8" class="include_0"><tbody>

<?php
include($root . "/include/category_objects.php");
?>

</tbody></table>

<!--Nav arrows bottom-->
<p></p>
	<table border="0" cellpadding="5" cellspacing="0"><tbody><tr>
		<?php include($root . "/include/category_nav.php"); ?>
	</tr></tbody></table>
<p></p>
<!--Nav arrows bottom-->

<?php include($root . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>