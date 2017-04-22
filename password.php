<?php
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
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$email = $_GET['email'];
	$secret_word = $_GET['secret_word'];
	
	if (isset($email)) {
		if (isValidEmail($email)) {
			if(strlen($str)>0){
				foreach($users_arr as $user) {
					if($email == $user['email']) {
						if(password_verify($secret_word, $user['secret_word'])) {
							$password = $user['password'];
							
							echo 'ваш пароль: ' . $password;
						} else { $error = 1; $err_message = 'Секретное слово указано не верно.'; }
					} else { $error = 1; $err_message = 'Аккаунтов с указанным email не найдено.'; }
				}
			}
		} else { $error = 1; $err_message = 'Email адрес указан не верно.'; }
	} else { $error = 1; $err_message = 'Не указан email адрес.'; }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Напоминание забытого пароля</title>

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

<table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
	<td>
		<form name="password" method="get" action="/password">
			<input type="hidden" name="back" value="<?php echo $back; ?>">
		
			<table width="380" border="0" cellpadding="4" cellspacing="8"><tbody>
				<tr>
					<td colspan="2" align="center">
						<h1>Напоминание забытого пароля</h1>
						<?php
							if ($error == '1') {
								echo '<p><img src="/i/i_error.png" width="32" height="32" vspace="1" align="absmiddle">&nbsp;<big id="message">' . $err_message . '</big></p>';
							}
						?>
					</td>
				</tr>

				<tr>
					<td align="right">*email:</td>
					<td><input type="text" name="email" value="" style="width: 180px" maxlength="64"></td>
				</tr>
				<tr>
					<td align="right">*секретное слово:</td>
					<td><input type="text" name="secret_word" value="" maxlength="32" autocomplete="off" style="width: 180px"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="показать" class="button"></td>
				</tr>
			</tbody></table>
		</form>
	</td>
</tr></tbody></table>



</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>