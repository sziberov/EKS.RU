<?php
$totalpage = count($phpfiles);
$per_page = 6;

$max_pages = ceil($totalpage / $per_page);

$prev3 = $_GET['p']-3;
$prev2 = $_GET['p']-2;
$prev = $_GET['p']-1;
$current = $_GET['p'];
$next = $_GET['p']+1;
$next2 = $_GET['p']+2;
$next3 = $_GET['p']+3;

if (!isset($current) && $max_pages > 1 || $current == 1 && $max_pages > 1 && $current < $max_pages) {
	echo '<td><img src="/t3/arr_sg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	echo '<td><img src="/t3/arr_lg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
	//-----
	echo '<td><font color="#808080"><b>1</b></font></td>';
	//-----
	echo '<td>'; if (!isset($current)) { echo '<a id="browse_next" href="software?p='.($next2).'">'; } else { echo '<a id="browse_next" href="software?p='.($next).'">'; }
		echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
	echo '</a></td>';
	echo '<td class="small">Ctrl →</td>';
	//-----
	if (!isset($current)) { 
		if ($next <= $max_pages) { echo '<td><a href="software?p='.($next+1).'">'.($next+1).'</a></td>'; }
		if ($next2 <= $max_pages) { echo '<td><a href="software?p='.($next2+1).'">'.($next2+1).'</a></td>'; }
		if ($next3 <= $max_pages) { echo '<td><a href="software?p='.($next3+1).'">'.($next3+1).'</a></td>'; }
	} else {
		if ($next <= $max_pages) { echo '<td><a href="software?p='.($next).'">'.($next).'</a></td>'; }
		if ($next2 <= $max_pages) { echo '<td><a href="software?p='.($next2).'">'.($next2).'</a></td>'; }
		if ($next3 <= $max_pages) { echo '<td><a href="software?p='.($next3).'">'.($next3).'</a></td>'; }
	}
	//-----
	echo '<td><a href="software?p='.$max_pages.'">';
		echo '<img src="/t3/arr_e.gif" border="0" width="20" height="20" title="перейти на последнюю страницу, всего позиций - '.$max_pages.'">';
	echo '</a></td>';
} else
//-----
if ($current > 1 && $current < $max_pages) {
	echo '<td><a href="software?p=1">';
		echo '<img src="/t3/arr_s.gif" border="0" width="20" height="20" title="перейти на первую страницу">';
	echo '</a></td>';
	//-----
	if ($prev3 >= 1) { echo '<td><a href="software?p='.($prev3).'">'.($prev3).'</a></td>'; }
	if ($prev2 >= 1) { echo '<td><a href="software?p='.($prev2).'">'.($prev2).'</a></td>'; }
	if ($prev >= 1) { echo '<td><a href="software?p='.($prev).'">'.($prev).'</a></td>'; }
	//-----
	echo '<td class="small">← Ctrl</td>';
	echo '<td><a id="browse_prev" href="software?p='.($prev).'">';
		echo '<img src="/t3/arr_l.gif" border="0" width="20" height="20" title="перейти на предыдущую страницу">';
	echo '</a></td>';
	//-----
	echo '<td><font color="#808080"><b>'.$current.'</b></font></td>';
	//-----
	echo '<td><a id="browse_next" href="software?p='.($next).'">';
		echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
	echo '</a></td>';
	echo '<td class="small">Ctrl →</td>';
	//-----
	if ($next <= $max_pages) { echo '<td><a href="software?p='.($next).'">'.($next).'</a></td>'; }
	if ($next2 <= $max_pages) { echo '<td><a href="software?p='.($next2).'">'.($next2).'</a></td>'; }
	if ($next3 <= $max_pages) { echo '<td><a href="software?p='.($next3).'">'.($next3).'</a></td>'; }
	//-----
	echo '<td><a href="software?p='.$max_pages.'">';
		echo '<img src="/t3/arr_e.gif" border="0" width="20" height="20" title="перейти на последнюю страницу, всего позиций - '.$max_pages.'">';
	echo '</a></td>';
} else
//-----
if ($current == $max_pages && $max_pages != 1) {
	echo '<td><a href="software?p=1">';
		echo '<img src="/t3/arr_s.gif" border="0" width="20" height="20" title="перейти на первую страницу">';
	echo '</a></td>';
	//-----
	if ($prev3 >= 1) { echo '<td><a href="software?p='.($prev3).'">'.($prev3).'</a></td>'; }
	if ($prev2 >= 1) { echo '<td><a href="software?p='.($prev2).'">'.($prev2).'</a></td>'; }
	if ($prev >= 1) { echo '<td><a href="software?p='.($prev).'">'.($prev).'</a></td>'; }
	//-----
	echo '<td class="small">← Ctrl</td>';
	echo '<td><a id="browse_prev" href="software?p='.($prev).'">';
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
		echo 'window.location.replace("software?p='.$max_pages.'")';
	echo '</script>';
} else
//-----
if ($current < 1) {
	echo '<script>';
		echo 'window.location.replace("software")';
	echo '</script>';
}			
?>