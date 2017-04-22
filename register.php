<?php /*if ($_SERVER['REQUEST_METHOD'] == 'POST') { header('Location: /'); } */?>
<?php
header('Content-type: text/html; charset=utf-8');

$users = $_SERVER['DOCUMENT_ROOT'].'/users_db.php';

if (file_exists($users)) {
	$str = file_get_contents($users);
}

if(strlen($str)>0){
	preg_match_all('/^"(?P<login>[^"]*)"[^{]*{
					(?:(?=[^}]*\spassword\s*=\s+"(?P<password>[^"]*)"))?
					(?:(?=[^}]*\semail\s*=\s+"(?P<email>[^"]*)"))?
					(?:(?=[^}]*\ssecret_word\s*=\s+"(?P<secret_word>[^"]*)"))?
					(?:(?=[^}]*\saccess_level\s*=\s+"(?P<access_level>[^"]*)"))?
					(?=[^}]*\sdate_reg\s*=\s+"(?P<date_reg>[^"]*)")/ixsm', $str, $users_arr_raw);
	foreach ($users_arr_raw as $key => $value) {
		if (is_int($key)) {
			unset($users_arr_raw[$key]);
		}
	}
	foreach($users_arr_raw as $key => $a){
		foreach($a as $k => $v){
			$users_arr[$k][$key] = $v;
		}
	}
	foreach ($users_arr as $user) {
		$logins[] = $user['login'];
		$emails[] = $user['email'];
	}
} else {
	$logins = [];
	$emails = [];
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$login = $_POST['login'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$secret_word = $_POST['secret_word'];
//$secret_word = iconv("UTF-8", "cp1251", $secret_word);

date_default_timezone_set('UTC');
function date_offset($format, $offset) {
  $time = time() + $offset; # $offset should be in milliseconds
  return date($format, $time); # with your require display format $format
}

$monthes = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');
$date_reg = date_offset('G:i, j ', 10800) . $monthes[(date_offset('n', 10800))] . date_offset(' Y', 10800);
//$date_reg = iconv("UTF-8", "cp1251", $date_reg);

if ($login != '') {
	if ($password != '') {
		if ($password == $password2) {
			if (strlen($password) >= 6) {
				if (!in_array($login, $logins)) {
					if (preg_match('/^[a-z0-9\-\_]+$/i', $login)) {
						if ($email != '') {
							if (isValidEmail($email)) {
								if ($secret_word != '') {
									if (!in_array($email, $emails)) {
										file_put_contents($users,

'"' . $login . '" { 
	password = "' . password_hash($password, PASSWORD_BCRYPT) . '"
	email = "' . $email . '"
	secret_word = "' . password_hash($secret_word, PASSWORD_BCRYPT) . '"
	access_level = "1"
	date_reg = "' . $date_reg . '"
}' . PHP_EOL

										, FILE_APPEND);
										
										header("Location: /login");
									} else { $error = 1; $err_message = 'Аккаунт с указанным email уже существует.'; }
								} else { $error = 1; $err_message = 'Не указано секретное слово.'; }
							} else { $error = 1; $err_message = 'Email адрес указан не верно.'; }
						} else { $error = 1; $err_message = 'Не указан email адрес.'; }
					} else { $error = 1; $err_message = 'В логине допустимы буквы латинского алфавита, цифры и символы "_-".'; }
				} else { $error = 1; $err_message = 'Этот логин уже используется.'; }
			} else { $error = 1; $err_message = 'Минимальная длина пароля 6 символов.'; }
		} else { $error = 1; $err_message = 'Пароли не идентичны.'; }
	} else { $error = 1; $err_message = 'Не указан пароль.'; }
} else { $error = 1; $err_message = 'Не указан логин.'; }

}
?>

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
</head>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
?>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php include($root . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

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
 
<table border="0" cellpadding="0" cellspacing="0"><tbody><tr>

<td>
	<table border="0" cellpadding="4" cellspacing="8">
		<form method="post" name="register" action="/register">
			<input type="hidden" name="captcha_id" value="14829858581527176544127597377175">

			<tbody>
				<tr>
					<td colspan="2" align="center">
						<h1>Регистрация</h1>
						<?php
							if ($error == '1') {
								echo '<p><img src="/i/i_error.png" width="32" height="32" vspace="1" align="absmiddle">&nbsp;<big id="message">' . $err_message . '</big></p>';
							}
						?>
					</td>
				</tr>

				<tr>
					<td align="right">*логин:</td>
					<td>
						<input type="text" name="login" value="<?php echo $login; ?>" style="width: 120px" maxlength="16" onchange="clear_result();">
						<input class="small_button" type="button" value="проверить" onclick="check_login();">
						<span class="small" id="check_login_result"></span>
					</td>
				</tr>
				<tr>
					<td align="right">*пароль:</td>
					<td><input type="password" name="password" value="" style="width: 120px" maxlength="64"></td>
				</tr>
				<tr>
					<td align="right">*пароль <small>(повтор)</small>:</td>
					<td><input type="password" name="password2" value="" style="width: 120px" maxlength="64"></td>
				</tr>
				<tr>
					<td align="right">*email:</td>
					<td><input type="text" name="email" value="<?php echo $email; ?>" style="width: 180px" maxlength="128"></td>
				</tr>
				<!--
				<tr>
					<td align="right">&nbsp;</td>
					<td><img src="/captcha" width="180" height="80" border="0" class="captcha" id="captcha">&nbsp;<a href="javascript: void(0);" onclick="return captchaRefresh(&quot;14829858581527176544127597377175&quot;);" tabindex="-1"><img src="/i/refresh.gif" title="показать другую картинку" width="16" height="16" border="0" alt="показать другую картинку"></a></td>
				</tr>
				<tr>
					<td align="right">*проверочное слово:</td>
					<td><input type="text" name="captcha_value" value="" maxlength="16" autocomplete="off" style="width: 180px"></td>
				</tr>
				-->
				<tr>
					<td align="right">*секретное слово:</td>
					<td><input type="text" name="secret_word" value="<?php echo $secret_word; ?>" maxlength="32" autocomplete="off" style="width: 180px"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="зарегистрироваться" class="button"></td>
				</tr>
			</tbody>
		</form>
	</table>
</td>

<!--
<td align="center" style="padding-left: 40px;">
	Уважаемые Посетители!
	<p>
	Сервис обеспечивает быстрый обмен информацией и является коммуникационной площадкой для<br>
	всех заинтересованных пользователей.
	</p>
	<p>
	Напоминаем, что нарушения  прав интеллектуальной собственности влечет за собой уголовную
	ответственность согласно действующему законодательству Украины.<br>
	Для поддержания теплой и дружественной обстановки, призываем Вас соблюдать законы Украины и<br>
	не использовать этот ресурс в противоправных действиях.
	</p>
</td>
-->

</tr></tbody></table>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($root . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>