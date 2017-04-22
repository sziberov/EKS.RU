<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>О сервисе</title>

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
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<h1 id="page_h1">О сервисе</h1>
<p>
Данный сайт является мини-клоном EX.ua, как память о лучшем файлообменнике, торрент-трекере и онлайн-кинотеатре на территории СНГ.
</p>
<p>
Его цель - раздача небольшого бесплатного или пиратского ПО. В дальнейшем возможно также фильмов, т. к. видео-плеер полностью портирован и функционалом от оригинала не отличается. Проблема лишь в отсутствии нормального хостинга с большим объемом места и прямыми ссылками на файлы.
</p>
<!--
<p>
Также здесь все сделано на статике, поэтому большого функционала не ожидайте. PHP на ucoz'е платный, да и не разбераюсь я в нем. Остается пользоватся только HTML+CSS+JS.
</p>
-->

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>