<?php
$totalpage = count($phpfiles);
$per_page = 12;

$max_pages = ceil($totalpage / $per_page);

if (!isset($_GET['p'])) {
	$current = 1;
} else {
	$current = $_GET['p'];
}

$prev3 = $current-3;
$prev2 = $current-2;
$prev = $current-1;
$next = $current+1;
$next2 = $current+2;
$next3 = $current+3;

if ($current == 1 && $max_pages > 1 && $current < $max_pages) {
	echo '<td><img src="/t3/arr_sg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	echo '<td><img src="/t3/arr_lg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	//-----
	echo '<td><font color="#808080"><b>1</b></font></td>';
	//-----
	echo '<td><a id="browse_next" href="?p='.($next).'">';
		echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
	echo '</a></td>';
	echo '<td class="small">Ctrl →</td>';
	//-----
		if ($next <= $max_pages) { echo '<td><a href="?p='.($next).'">'.($next).'</a></td>'; }
		if ($next2 <= $max_pages) { echo '<td><a href="?p='.($next2).'">'.($next2).'</a></td>'; }
		if ($next3 <= $max_pages) { echo '<td><a href="?p='.($next3).'">'.($next3).'</a></td>'; }
	//-----
	echo '<td><a href="?p='.$max_pages.'">';
		echo '<img src="/t3/arr_e.gif" border="0" width="20" height="20" title="перейти на последнюю страницу, всего позиций - '.$max_pages.'">';
	echo '</a></td>';
} else
//-----
if ($current > 1 && $current < $max_pages) {
	echo '<td><a href="?p=1">';
		echo '<img src="/t3/arr_s.gif" border="0" width="20" height="20" title="перейти на первую страницу">';
	echo '</a></td>';
	//-----
	if ($prev3 >= 1) { echo '<td><a href="?p='.($prev3).'">'.($prev3).'</a></td>'; }
	if ($prev2 >= 1) { echo '<td><a href="?p='.($prev2).'">'.($prev2).'</a></td>'; }
	if ($prev >= 1) { echo '<td><a href="?p='.($prev).'">'.($prev).'</a></td>'; }
	//-----
	echo '<td class="small">← Ctrl</td>';
	echo '<td><a id="browse_prev" href="?p='.($prev).'">';
		echo '<img src="/t3/arr_l.gif" border="0" width="20" height="20" title="перейти на предыдущую страницу">';
	echo '</a></td>';
	//-----
	echo '<td><font color="#808080"><b>'.$current.'</b></font></td>';
	//-----
	echo '<td><a id="browse_next" href="?p='.($next).'">';
		echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
	echo '</a></td>';
	echo '<td class="small">Ctrl →</td>';
	//-----
	if ($next <= $max_pages) { echo '<td><a href="?p='.($next).'">'.($next).'</a></td>'; }
	if ($next2 <= $max_pages) { echo '<td><a href="?p='.($next2).'">'.($next2).'</a></td>'; }
	if ($next3 <= $max_pages) { echo '<td><a href="?p='.($next3).'">'.($next3).'</a></td>'; }
	//-----
	echo '<td><a href="?p='.$max_pages.'">';
		echo '<img src="/t3/arr_e.gif" border="0" width="20" height="20" title="перейти на последнюю страницу, всего позиций - '.$max_pages.'">';
	echo '</a></td>';
} else
//-----
if ($current == $max_pages && $max_pages != 1) {
	echo '<td><a href="?p=1">';
		echo '<img src="/t3/arr_s.gif" border="0" width="20" height="20" title="перейти на первую страницу">';
	echo '</a></td>';
	//-----
	if ($prev3 >= 1) { echo '<td><a href="?p='.($prev3).'">'.($prev3).'</a></td>'; }
	if ($prev2 >= 1) { echo '<td><a href="?p='.($prev2).'">'.($prev2).'</a></td>'; }
	if ($prev >= 1) { echo '<td><a href="?p='.($prev).'">'.($prev).'</a></td>'; }
	//-----
	echo '<td class="small">← Ctrl</td>';
	echo '<td><a id="browse_prev" href="?p='.($prev).'">';
		echo '<img src="/t3/arr_l.gif" border="0" width="20" height="20" title="перейти на предыдущую страницу">';
	echo '</a></td>';
	//-----
	echo '<td><font color="#808080"><b>'.$current.'</b></font></td>';
	//-----
	echo '<td><img src="/t3/arr_rg.gif" border="0" width="20" height="20" title="вы находитесь на последней странице"></td>';
	echo '<td><img src="/t3/arr_eg.gif" border="0" width="20" height="20" title="вы находитесь на последней странице"></td>';
} else
//-----
if ($max_pages == 1) {
	echo '<td><img src="/t3/arr_sg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	echo '<td><img src="/t3/arr_lg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	//-----
	echo '<td><font color="#808080"><b>1</b></font></td>';
	//-----
	echo '<td><img src="/t3/arr_rg.gif" border="0" width="20" height="20" title="вы находитесь на последней странице"></td>';
	echo '<td><img src="/t3/arr_eg.gif" border="0" width="20" height="20" title="вы находитесь на последней странице"></td>';
} else
//-----
if ($current > $max_pages) {
	echo '<script>';
		echo 'window.location.replace("?p='.$max_pages.'")';
	echo '</script>';
} else
//-----
if ($current < 1) {
	echo '<script>';
		echo 'window.location.replace("software")';
	echo '</script>';
}			
?>