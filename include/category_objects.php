<?php
$o = 0;

if(isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'new_start') {
	krsort($cat_objects);
} else 
if(isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'new_end') {

}

if (isset($current)) { 
	$phpfiles_onpage = array_slice($cat_objects, $per_page * intval($current) - $per_page, $per_page, true);
} else {
	$phpfiles_onpage = array_slice($cat_objects, $per_page * 1 - $per_page, $per_page, true);
}

echo '<tr>';
foreach($phpfiles_onpage as $key => $val) {
	$path = $directory . basename($val);
	$object_file = pathinfo(basename($val), PATHINFO_FILENAME);

	$paddedI = str_pad($key + 1, 8, "0", STR_PAD_LEFT);
	if (get_category($path) == 'category_'.$category) {
			echo '<td align="center" valign="center">';
				//if (file_exists($_SERVER['DOCUMENT_ROOT'].get_icon($path))) {
					echo '<a href="/' . $object_file . '">';
						echo '<img src="' . get_icon($path) . '" style="max-height: 200px; max-width: 200px" border="0">';
					echo '</a>';
				//}
				echo '<p>';
					echo '<a href="/' . $object_file . '">';
						echo '<b>' . get_title($path) . '</b>';
					echo '</a>';
					echo '<br>';
					echo '<small>' . get_date_without_mod($path) . '</small>';
				echo '</p>';

			$comments = $_SERVER['DOCUMENT_ROOT'].'/comments/'.$object_file.'.php';
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
						echo '<p><a href="/view_comments/'.$object_file.'" class="info">Отзывов: '.$comments_amount.'</a>&nbsp;</p>';
					}
				}
			}
			
		echo '</td>';
		echo PHP_EOL;
		$o++;
	}

	if ($o >= 4) { 
		echo '</tr>';
		$o = 0;
	}
}
?>