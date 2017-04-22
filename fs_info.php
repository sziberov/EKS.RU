<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Информация о файл-сервере</title>

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
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<td valign="top" style="padding: 16px;">

<?php
$df = disk_free_space("/");
$dt = disk_total_space("/");
$du = $dt - $df;

$dup = round(sprintf('%.2f',($du / $dt) * 100), 0, PHP_ROUND_HALF_EVEN);
$dfp = round(sprintf('%.2f',($df / $dt) * 100), 0, PHP_ROUND_HALF_EVEN);

$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);

function formatSize( $bytes )
{
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
                return( round( $bytes, 2 ) /*. " " . $types[$i]*/ );
}

if ($dup >= '95') {
        $dfc = '#f00';
} else
if ($dup > '85' && $dfp < '95') {
        $dfc = '#fa0';
} else
if ($dup > '75' && $dfp < '85') {
        $dfc = '#0c0';
} else
if ($dup <= '75') {
        $dfc = '#ccc';
} 
?>

<h1>Информация о файл-сервере</h1>
<p>
</p>
<table width="100%" class="list" border="0" cellpadding="0" cellspacing="0"><tbody>
        <tr>
                <th align="right">занят</th>
                <th align="right" width="820">&nbsp;</th>
                <th align="right">свободно</th>
                <th align="right">всего</th>
        </tr>
        <tr style="background-color: #f0f0f0;">
                <?php
                echo '<td align="right" style="color: '.($dup <= '94' ? '#000' : '#f00').';">%'.$dup.'</td>';
                ?>
                <td align="right"><div style="width: 800px; height: 8px; background-color: #00c;"><div style="width: <?php echo "$dfp"?>%; height: 8px; background-color: <?php echo "$dfc"?>;"></div></div></td>
                <td align="right"><?php echo "$df" ?></td>
                <td align="right"><?php echo "$dt" ?></td>
        </tr>
</tbody></table>

</td>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>