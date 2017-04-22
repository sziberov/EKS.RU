<?php
$users = $_SERVER['DOCUMENT_ROOT'].'/users_db.php';

if (file_exists($users)) {
	$str = file_get_contents($users);
}

if(strlen($str)>0){
	preg_match_all('/^"(?P<login>[^"]*)"/ixsm', $str, $users_arr_raw);
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
	}
}

if ($_GET['login'] != '') {
	if (preg_match('/^[a-z0-9\-\_]+$/i', $_GET['login'])) {
		if(strlen($str)>0){
			if(!in_array($_GET['login'], $logins)) {
				echo '<span class="small">Логин доступен.</span>';
			} else { echo'<span class="warn">Этот логин уже используется.</span>'; }
		} else { echo '<span class="small">Логин доступен.</span>'; }
	} else { echo '<span class="warn">В логине допустимы буквы латинского алфавита, цифры и символы "_-".</span>'; }
} else { echo '<span class="warn">Не указан логин.</span>'; }
?>