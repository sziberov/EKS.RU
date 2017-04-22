<?php
$type = $_GET['link_type'];
$original_id = $_GET['original_id'];
$id = $_GET['id'];
$u_login = $_COOKIE['u_log'];
$u_access = $_COOKIE['u_access'];

if($type == '2') {
	$file_path = $_SERVER['DOCUMENT_ROOT']."/comments/".$original_id.".php";
	if (file_exists($file_path)) {
		$file_path_cnt = file_get_contents($file_path);
	}

	if(strlen($file_path_cnt)>0){
		$user = '/^"[^"]*"[^{]*{(?:(?=[^}]*\susername\s*=\s+"(?P<username>[^"]*)"))?[^}]*\sid\s*=\s+"'.$id.'"[^}] .*?}/ixsm';
		
		preg_match_all($user, $file_path_cnt, $user_arr_raw);
		foreach ($user_arr_raw as $key => $value) {
			if (is_int($key)) {
				unset($user_arr_raw[$key]);
			}
		}
		foreach($user_arr_raw as $key => $a){
			foreach($a as $k => $v){
				$user_arr[$k][$key] = $v;
			}
		}

		foreach($user_arr as $user) {
			if($u_login == $user['username'] || $u_access >= '2') {
				file_put_contents($file_path, preg_replace('/^"[^"]*"[^{]*{[^}]*\sid\s*=\s+"'.$id.'"[^}] .*?}/sixm', '', $file_path_cnt));
			}
		}
	}
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>