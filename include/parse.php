<?php
$feed->init();

$limit=0;
foreach ($feed->get_items() as $item) {
	if($limit == 31) {
		break;
	}
	$feed=$item->get_feed();
	
	echo '<li>';
		echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->get_permalink().'">';
			echo '<div class="im" style="background:#cccccc url('; if ($enclosure = $item->get_enclosure()) { echo $enclosure->get_link(); } echo ') center center /cover no-repeat"></div>';
		echo '</a>';
		echo '<div class="of">';
			echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->get_permalink().'">'.$item->get_title().'</a>';
			
			$desc = $item->get_content();
			$desc = preg_replace("/<img.*>/","",$desc);
			echo '<p>'.$desc.'</p>';
		
			$monthes = array(1 => '01', 2 => '02', 3 => '03', 4 => '04', 5 => '05', 6 => '06', 7 => '07', 8 => '08', 9 => '09', 10 => '10', 11 => '11', 12 => '12');
			$parsed = parse_url($feed->get_link());
			echo '<span class="tm">'.date('H:i, d.', strtotime($item->get_date())).$monthes[(date('n', strtotime($item->get_date())))].date('.Y',strtotime($item->get_date())).' - '.$parsed['host'].'</span>';
		echo '</div>';
	echo '</li>';
	$limit++;
}
?>