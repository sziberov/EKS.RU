<?php
	$limit=0;
	foreach ($rss->channel->item as $item) {
		if($limit == 31) {
			break;
		}
		echo '<li>';
			echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->link.'">';
				echo '<div class="im" style="background:#cccccc url('.$item->enclosure['url'].') center center /cover no-repeat"></div>';
			echo '</a>';
			echo '<div class="of">';
				echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->link.'">'.$item->title.'</a>';
				
				$desc = $item->description;
				$desc = preg_replace("/<img.*>/","",$desc);
				echo '<p>'.$desc.'</p>';
			
				$monthes = array(1 => '01', 2 => '02', 3 => '03', 4 => '04', 5 => '05', 6 => '06', 7 => '07', 8 => '08', 9 => '09', 10 => '10', 11 => '11', 12 => '12');
				$parsed = parse_url($rss->channel->link);
				echo '<span class="tm">'.date('H:i, d.', strtotime($item->pubDate)).$monthes[(date('n', strtotime($item->pubDate)))].date('.Y',strtotime($item->pubDate)).' - '.$parsed['host'].'</span>';
			echo '</div>';
		echo '</li>';
		$limit++;
	}
?>