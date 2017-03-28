<?php
	$monthes = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');

	if (file_exists($filepath)) {
		$mime = mime_content_type($filepath);
		if (strstr($mime, "video/")) {
			echo '<td align="center" width="110">&nbsp;';
			echo '<span class="r_button"><a data-index="0" class="fox-play-btn" href="' . $filepath_relative . '" rel="nofollow" onclick="return false;">играть</a></span></td>';
		} else if (strstr($mime, "image/")) {
			echo '<td align="center" width="110">&nbsp;<a href="' . $filepath_relative . '" id="picture_' . $i . '" onclick="return view(this, ' . $i . ');"><img src="' . $filepath_relative . '" border="0" style="max-height: 100px; max-width: 100px"></a><p><a src="' . $filepath_relative . '" id="picture_' . $i . '" onclick="return view(this, ' . $i . ');"></a></p></td>';
		} else {
			echo '<td align="center" width="110">&nbsp;</td>';
		};
		
		echo '<td class="small" align="right" width="230">';
		echo '<b>' . number_format(filesize($filepath)) . '</b>';
		echo '<p>';
			echo date('H:i, d ', filemtime($filepath)) . $monthes[(date('n', filemtime($filepath)))] . date(' Y', filemtime($filepath));
			echo '<br>';
			echo md5_file($filepath);
			if (strstr($mime, "video/")) {
				require_once('../plugin/getid3/getid3.php');
				$getID3 = new getID3;
				$file = $getID3->analyze($filepath);
				echo '<br>';
				echo $file['playtime_string'] . ", " . $file['fileformat'] . ": " . $file['video']['resolution_x'] . "x" . $file['video']['resolution_y'];
				
			} else if (strstr($mime, "image/")) {
				echo '<br>';
				list($width, $height) = getimagesize($filepath);
				echo pathinfo($filepath, PATHINFO_EXTENSION) . ": " . $width . "x" .  $height;
			};
		echo '</p>';
		echo '<p>';
			echo '<span class="r_button">';
				echo '<a href="' . $filepath_relative . '" rel="nofollow" download>загрузить</a>';
			echo '</span>';
			echo '<span class="r_button">';
				echo '<script>';
					echo 'document.write(\'<a class="copy_link\' + ($(\'#file_list tbody tr\').length - 1) + \'" data-clipboard-action="copy" data-clipboard-target="#link\' + ($(\'#file_list tbody tr\').length - 1) + \'" rel="nofollow">поделиться</a>\');';
				echo '</script>';
			echo '</span>';
		echo '</p>';
	} else {
		echo '<td align="center" width="110">&nbsp;</td>';
		echo '<td class="small" align="right" width="230">';
		echo '<p>';
			echo '<span style="color: #c00;">файл недоступен</span>';
		echo '</p>';
	}
?>