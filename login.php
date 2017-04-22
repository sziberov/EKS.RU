<?php
if(isset($_GET['d'])) {
	$incorrect = '<p><img src="/i/i_error.png" width="32" height="32" vspace="1" align="absmiddle">&nbsp;<big id="message">Вы должны войти в систему для выполнения операции.</big></p>';
}

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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if(isset($_GET['back'])) {
		if(!empty($_GET['back'])) {
			$back = $_GET['back'];
		}
		$back = '';
	} else {
		$back = '';
	}

	$login = $_GET['login'];
	$password = $_GET['password'];
	
	if(strlen($str)>0){
		foreach($users_arr as $user) {
			if (isset($login) && isset($password)) {
				if($login == $user['login'] && password_verify($password, $user['password'])) {
					if (isset($_GET['flag_permanent'])) {
						setcookie('u_log', $login, 2147483647);
						$_COOKIE['u_log'] = $login;
						setcookie('u_pass', $user['password'], 2147483647);
						$_COOKIE['u_pass'] = $user['password'];
						setcookie('u_access', $user['access_level'], 2147483647);
						$_COOKIE['u_access'] = $user['access_level'];
					} else {
						setcookie('u_log', $login);
						$_COOKIE['u_log'] = $login;
						setcookie('u_pass', $user['password']);
						$_COOKIE['u_pass'] = $user['password'];
						setcookie('u_access', $user['access_level']);
						$_COOKIE['u_access'] = $user['access_level'];
					}

					header("Location: /$back");
				} else {
					$incorrect = '<p><img src="/i/i_error.png" width="32" height="32" vspace="1" align="absmiddle">&nbsp;<big id="message">Неверный логин или пароль.</big></p>';
				}
			}
		}
	} else {
		$incorrect = '<p><img src="/i/i_error.png" width="32" height="32" vspace="1" align="absmiddle">&nbsp;<big id="message">Неверный логин или пароль.</big></p>';
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Вход</title>

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
		<form name="login" method="get" action="/login">
			<input type="hidden" name="back" value="<?php echo $back; ?>">
		
			<table width="380" border="0" cellpadding="4" cellspacing="8"><tbody>
				<tr>
					<td colspan="2" align="center">
						<h1>Вход</h1>
						<?php
							echo $incorrect;
						?>
					</td>
				</tr>

				<tr>
					<td align="right">логин:</td>
					<td><input type="text" name="login" value="" style="width: 120px" maxlength="64"></td>
				</tr>
				<tr>
					<td align="right">пароль:</td>
					<td><input type="password" name="password" value="" style="width: 120px" maxlength="64"></td>
				</tr>
				<tr>
					<td align="right">тип:</td>
					<td>
						<input type="checkbox" name="flag_permanent" value="1">запомнить меня<br>
						<!--<input type="checkbox" name="flag_not_ip_assign" value="1">без привязки по IP-->
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="войти" class="button"></td>
				</tr>
			</tbody></table>
		</form>
	</td>

	<td width="250">
		<br>
			<span class="r_button"><a href="/register">регистрация нового пользователя</a></span>
		<p><!--&nbsp;</p>
		<p>
			<span class="r_button"><a href="/password">напомнить забытый пароль</a></span>
		</p>
		-->
	</td>
</tr></tbody></table>



</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>