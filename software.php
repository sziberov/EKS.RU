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

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

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
$category = 'domain_software';

include($_SERVER['DOCUMENT_ROOT'] . "/include/category_objects.php");
?>

</tbody></table>

<p></p>
<!--Arrows post-->

<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>