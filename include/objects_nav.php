<?php
$current_url_object = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$current_url_object_prev = $current_url_object++;
$current_url_object_next = $current_url_object--;
$current_object_prev = $_SERVER['DOCUMENT_ROOT'] . "/object/" . $current_url_object_prev . '.php';
$current_object_next = $_SERVER['DOCUMENT_ROOT'] . "/object/" . $current_url_object_next . '.php';
$current_object_num = ltrim($current_url_object, "0");

if (!file_exists($current_object_prev) && file_exists($current_object_next)) {
	echo '<td><img src="/t3/arr_lg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	//-----
	echo '<td class="small">Ctrl →</td>';
	//-----
	echo '<td><a id="browse_next" href="?p='.($current_object_next).'">';
		echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
	echo '</a></td>';
}

if (file_exists($current_object_prev) && file_exists($current_object_next)) {
	
}

if (file_exists($current_object_prev) && !file_exists($current_object_next)) {
	
}
?>
<script>
$(document).keydown(function(e){
	if (e.ctrlKey) {
		if (e.keyCode == 37) {
			$('#arr_l')[0].click();
		}
		else if (e.keyCode == 39) {
			$('#arr_r')[0].click();
		}
	}
});
</script>