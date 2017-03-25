<?php
	function getDirectorySize($path) {
		$bytestotal = 0;
		$path = realpath($path);
		if($path!==false){
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
				$bytestotal += $object->getSize();
			}
		}
		return $bytestotal;
	}	
?>