<?php
$opendir = opendir($dir);
$file_count = 0;
while($file = readdir($opendir)){
	if($file == '.' || $file == '..' || is_dir($dir . $file)){
		continue;
	}
	$file_count++;
}
?>