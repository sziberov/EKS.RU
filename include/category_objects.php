<?php
$o = 0;

if (isset($current)) { 
	$phpfiles_onpage = array_slice($cat_objects, $per_page * intval($current) - $per_page, $per_page, true);
} else {
	$phpfiles_onpage = array_slice($cat_objects, $per_page * 1 - $per_page, $per_page, true);
}
echo '<tr>';

foreach($phpfiles_onpage as $key => $val) {
	$path = $directory . basename($val);

	$paddedI = str_pad($key + 1, 8, "0", STR_PAD_LEFT);
	if (get_category($path) == $category) {
		echo '<td align="center" valign="center"><a href="/show/' . $paddedI . '"><img src="' . get_icon($path) . '" style="max-height: 200px; max-width: 200px" border="0"></a><p><a href="/show/' . $paddedI . '"><b>' . get_title($path) . '</b></a><br><small>' . get_date($path) . '</small></td>' . PHP_EOL;
		$o++;
	}

	if ($o >= 4) { 
		echo '</tr>';
		$o = 0;
	}
}
?>