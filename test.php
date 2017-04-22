<?php
$directory = $_SERVER['DOCUMENT_ROOT'] . "/object/";
$category = 'software';

$root = $_SERVER['DOCUMENT_ROOT'];
$phpfiles = glob($directory . "*.php");

function get_category($url) {
	$str = file_get_contents($url);
	if(strlen($str)>0){
		preg_match("/\<html.*id\=\"(.*?)\"\>/i", $str, $domain_category); 
		return $domain_category[1];
	}
}

$cat_objects = array();
$objects_i = array();
$object_i = 1;
foreach($phpfiles as $key => $val) {
	$path = $directory . basename($val);

	if (get_category($path) == 'category_'.$category) {
		$cat_objects[$key] = $val;
		$objects_i[] = $object_i;
		$object_i++;
	}
}

$lastObjectID = pathinfo(basename(array_pop($phpfiles), PATHINFO_FILENAME));

echo '<pre>';
print_r($phpfiles);
echo '<div>------</div>';
print_r($cat_objects);
echo '<div>------</div>';
echo $lastObjectID;
echo '<div>------</div>';
foreach($phpfiles as $key => $val) {
	$path = $directory . basename($val);
	$object_file = pathinfo(basename($val), PATHINFO_FILENAME);

	if (get_category($path) == 'category_'.$category) {
		echo pathinfo(basename($val), PATHINFO_FILENAME);
	}
}
?>