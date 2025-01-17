<?php
$current_url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
$current_url_file = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$current_url_query = $_SERVER['QUERY_STRING'];

if (strpos($current_url, 'view') === false && !preg_match('/[0-9]+$/', $current_url)) {
	echo '<p>';
	echo '<span class="r_button"><a href="/edit_storage/'.$current_url_file.'">добавить статью в раздел</a></span>';
	echo '</p>';
}

if (strpos($current_url, 'view_comments') !== false) {
	echo '<p>';
	echo '<span class="r_button"><a href="/edit/'.$current_url_query.'">написать отзыв</a></span>';
	echo '</p>';
} else {
	$comments = $_SERVER['DOCUMENT_ROOT'].'/comments/'.$current_url_file.'.php';

	if (file_exists($comments)) {
		$str = file_get_contents($comments);
		
		if(strlen($str)>0){
			preg_match_all('/^"(?P<title>[^"]*)"[^{]*{
							(?:(?=[^}]*\susername\s*=\s+"(?P<username>[^"]*)"))?
							(?:(?=[^}]*\scontent\s*=\s+"(?P<content>[^"]*)"))?
							(?:(?=[^}]*\sdate_2\s*=\s+"(?P<date_2>[^"]*)"))?
							(?=[^}]*\sdate_1\s*=\s+"(?P<date_1>[^"]*)")/ixsm', $str, $comments_arr_raw);
			foreach ($comments_arr_raw as $key => $value) {
				if (is_int($key)) {
					unset($comments_arr_raw[$key]);
				}
			}
			foreach($comments_arr_raw as $key => $a){
				foreach($a as $k => $v){
					$comments_arr[$k][$key] = $v;
				}
			}
			
			$comments_amount = 0;
			foreach($comments_arr as $comment) {
				$comments_amount++;
			}	
			
			if ($comments_amount != 0) {
				echo '<p>';
				echo '<span class="r_button"><a href="/view_comments/'.$current_url_file.'">отзывов: '.$comments_amount.'</a></span>';
				echo '</p>';
			}
		}
	} else {
		echo '<p>';
		echo '<span class="r_button"><a href="/edit/'.$current_url_file.'">написать отзыв</a></span>';
		echo '</p>';
	}
}
?>