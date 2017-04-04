<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Программы</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<h1>Программы</h1><br>
<!--Nav arrows top-->
<p></p>
	<table border="0" cellpadding="5" cellspacing="0">
		<tbody>
			<tr>
				<?php
				$objects = glob('show/*');

				$totalpage = count($objects);
				$per_page = 1;

				$max_pages = ceil($totalpage / $per_page);
				
				$prev3 = $_GET['p']-3;
				$prev2 = $_GET['p']-2;
				$prev = $_GET['p']-1;
				$current = $_GET['p'];
				$next = $_GET['p']+1;
				$next2 = $_GET['p']+2;
				$next3 = $_GET['p']+3;

				$show = array_slice($objects, $per_page * intval($current) - $per_page, $per_page);
				
				if (!isset($current) && $max_pages > 1 || $current == 1 && $max_pages > 1 && $current < $max_pages) {
					echo '<td><img src="/t3/arr_sg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
					echo '<td><img src="/t3/arr_lg.gif" border="0" width="20" height="20" title="вы находитесь на первой странице"></td>';
					//-----
					echo '<td><font color="#808080"><b>1</b></font></td>';
					//-----
					echo '<td>'; if (!isset($current)) { echo '<a id="browse_next" href="software?p='.($next2).'">'; } else { echo '<a id="browse_next" href="software?p='.($next).'">'; }
						echo '<img src="/t3/arr_r.gif" border="0" width="20" height="20" title="перейти на следующую страницу">';
					echo '</a></td>';
					echo '<td class="small">Ctrl&nbsp;→</td>';
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
					echo '<td class="small">Ctrl&nbsp;→</td>';
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
			</tr>
		</tbody>
	</table>
<p></p>
<!--Nav arrows top-->
	
<table width="100%" border="0" cellpadding="0" cellspacing="8" class="include_0"><tbody>

<?php
$category = 'domain_software';

include($_SERVER['DOCUMENT_ROOT'] . "/include/category_objects.php");
?>

</tbody></table>

<p></p>
<!--Nav arrows bottom-->

<!--Nav arrows bottom-->

<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/share.html"); ?>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>