<?php
$filename = end(explode('/', $filepath));

echo '<tr>';
	echo '<td width="17"><img src="/i/i_disk.svg" border="0" height="17" width="17"></td>'; 
	echo '<td>'; 
		echo '<span class="small">' . $i . '.</span>';
		echo '<br>';
		echo '<a id="file_name"'; if (file_exists($filepath)) { echo 'href="' . $filepath_relative . '"'; } echo 'title="' . $filename . '"></a>';
		$mime = mime_content_type($filepath);
		if (!strstr($mime, "/octet-stream")) {
			echo '<br>';
			echo '<span class="small">';
			if (strstr($mime, "video/")) {
				echo 'видео';
				$vid_i++;
			} else if (strstr($mime, "audio/")) {
				echo 'аудио';
			} else if (strstr($mime, "image/")) {
				echo 'изображение';
			} else if (strstr($mime, "/zip") || strstr($mime, "/x-rar-compressed") || strstr($mime, "/vnd.ms-cab-compressed") || strstr($mime, "/x-tar") || strstr($mime, "/java-archive") || strstr($mime, "/x-7z-compressed")) {
				echo 'архив';
//			} else if (strstr($mime, "/x-msdownload") || strstr($mime, "/exe") || strstr($mime, "/x-exe") || strstr($mime, "/dos-exe") || strstr($mime, "vms/exe") || strstr($mime, "/x-winexe")  || strstr($mime, "/msdos-windows")  || strstr($mime, "/x-msdos-program")) {
//				echo 'приложение';
//			} else {
//				echo $mime;
			}
		}
	echo '</span>';
	echo '</td>';
		include($root . "/include/file_info_php.php");
		echo '<script>';
			echo 'var url = new URL(window.location.origin + "/' . $key . "/" . $filename . '");';
			include($root . "/include/file_info_js.html");
		echo '</script>';
	echo '</td>';
echo '</tr>';
$i++;
?>