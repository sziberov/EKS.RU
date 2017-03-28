<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Регистрация</title>

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

<script src="/js/request.js" type="text/javascript"></script>
<script type="text/javascript">
function request_result(status, text)
{
	if (status == 200)
	{
		var e = document.getElementById('check_login_result');
		if (e) e.innerHTML = "<br>" + text;
	}
}
function clear_result()
{
	var e = document.getElementById('check_login_result');
	if (e && e.innerHTML != "") e.innerHTML = "";
}
function check_login()
{
	var f = document.forms['register'];
	if (f)
	{
		request('/r_check_login?login=' + encodeURIComponent(f.elements['login'].value), request_result, 0);
	}
}
</script>
<table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td>

<table border="0" cellpadding="4" cellspacing="8">
<form method="post" name="register" action="https://www.ex.ua/register"></form>
<input type="hidden" name="captcha_id" value="13903859329238739655685512369160">
<tbody><tr><td colspan="2" align="center"><h1>Регистрация</h1></td></tr>
<tr><td align="right">*логин:</td><td><input type="text" name="login" value="" style="width: 120px" maxlength="64" onchange="clear_result();"><input class="small_button" type="button" value="проверить" onclick="check_login();"><span class="small" id="check_login_result"></span></td></tr>
<tr><td align="right">*пароль:</td><td><input type="password" name="password" value="" style="width: 120px" maxlength="64"></td></tr>
<tr><td align="right">*пароль <small>(повтор)</small>:</td><td><input type="password" name="password2" value="" style="width: 120px" maxlength="64"></td></tr>
<tr><td align="right">*email:</td><td><input type="text" name="email" value="" style="width: 180px" maxlength="128"></td></tr>
<tr><td align="right">&nbsp;</td><td><img src="/i/captcha" width="180" height="80" border="0" class="captcha" id="captcha">&nbsp;<a href="javascript: void(0);" onclick="return captchaRefresh(&quot;13903859329238739655685512369160&quot;);" tabindex="-1"><img src="/i/refresh.gif" title="показать другую картинку" width="16" height="16" border="0" alt="показать другую картинку"></a></td></tr>
<tr><td align="right">*проверочное слово:</td><td><input type="text" name="captcha_value" value="" maxlength="16" autocomplete="off" style="width: 180px"></td></tr>
<tr><td></td><td><input type="submit" value="зарегистрироваться" class="button"></td></tr>

</tbody></table>

</td><td align="center" style="padding-left: 40px;">
Уважаемые Посетители!<p>
Сервис обеспечивает быстрый обмен информацией и является коммуникационной площадкой для<br>
всех заинтересованных пользователей.</p><p>
По нашему мнению "товарищ милиционер" звучит свободнее, чем "гражданин начальник", поэтому<br>
напоминаем, что нарушение прав интеллектуальной собственности влечет за собой уголовное<br>
наказание согласно действующему законодательству Украины.</p><p>
Для поддержания теплой и дружественной обстановки, призываем Вас соблюдать законы Украины и<br>
не использовать этот ресурс в противоправных действиях.
</p></td></tr>

</tbody></table>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>