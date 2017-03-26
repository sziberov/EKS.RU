<?php
$o = 0;

include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");
		
echo '<tr>';
foreach($phpfiles as $phpfile) {
	$path = $root . "/show/" . basename($phpfile);

	$paddedI = str_pad($i, 6, "0", STR_PAD_LEFT);
	
	if (get_category($path) == $category) {
		echo '<td align="center" valign="center"><a href="/show/' . $paddedI . '"><img src="' . get_icon($path) . '" style="max-height: 200px; max-width: 200px" border="0"></a><p><a href="/show/' . $paddedI . '"><b>' . get_title($path) . '</b></a><br><small>' . get_date($path) . '</small></td>' . PHP_EOL;
	}
	$i++;
	$o++;
	if ($o >= 4) { 
		echo '</tr>';
		$o = 0;
	}
}
?>