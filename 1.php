<?php
$images = glob('i/*');

$img_count = count($images);
$per_page = 10;

$max_pages = ceil($img_count / $per_page);

$show = array_slice($images, $per_page * intval($_GET['page']) - 1, $per_page);

if($_GET['page'] > 1)
    $prev_link = '<a href="images.php?page='.($_GET['page']-1).'"> previous </a>';
if($_GET['page'] < $max_pages)
    $next_link = '<a href="images.php?page='.($_GET['page']+1).'"> next </a>';
?>