<?php
$filename = end(explode('/', $filepath));

echo '<tr>';
	echo '<td width="17"><img src="/i/i_disk.svg" border="0" height="17" width="17"></td>';
	echo '<td><span class="small">' . $i . '.</span><br><a id="file_name"'; if (file_exists($filepath)) { echo 'href="' . $filepath_relative . '"'; } echo 'title="' . $filename . '"></a></td>';
		include($root . "/include/file_info_php.php");
		echo '<script>';
			echo 'var url = new URL(window.location.origin + "/' . $key . "/" . $filename . '");';
			include($root . "/include/file_info_js.html");
		echo '</script>';
	echo '</td>';
echo '</tr>';
$i++;
?>