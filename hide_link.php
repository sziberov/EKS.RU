<?php
$type = $_GET['link_type'];
$original_id = $_GET['original_id'];
$id = (string)$_GET['id'];
$u_access = $_COOKIE['u_access'];

if($u_access >= '2') {
	if($type == '2') {
		$file_path = $_SERVER['DOCUMENT_ROOT']."/comments/".$original_id.".php";
		if (file_exists($file_path)) {
			$file_path_cnt = file_get_contents($file_path);
		}

		if(strlen($file_path_cnt)>0){
			$replace = preg_replace_callback(
				'/\{[^}]+/ixsm', 
				function($match) use ($id) {
					if(strpos($match[0], 'id = "'.$id.'"') !== FALSE ) {
						return str_replace('type = "view"', 'type = "hide"', $match[0]);
					} else {
					   return $match[0];
					}
				},
				$file_path_cnt);
			
			file_put_contents($file_path, $replace);
		}
	}
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>