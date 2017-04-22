<?php
$feed->init();

$limit=0;
foreach ($feed->get_items() as $item) {
	if($limit == 31) {
		break;
	}
	$feed=$item->get_feed();
	$enclosure = $item->get_enclosure();
	
//	if ($enclosure->get_link()) { 
//		$ch = curl_init ($enclosure->get_link());
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//		curl_exec ($ch);

//		$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
//	}

	$enclosure_exists = $enclosure->get_link();
//	$enclosure_img = $enclosure->get_link() && strstr($content_type, "image/");
	
	echo '<li>';
		echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->get_permalink().'">';
			if ($enclosure_exists) { 
				echo '<div class="im" style="background:#cccccc url('.$enclosure->get_link().') center center /cover no-repeat"></div>'; 
			}
		echo '</a>';
		echo '<div class="of"'; if ($enclosure_exists) { echo 'style="margin-left: 162px; height: 85px;"'; } echo '>';
			$title = $item->get_title();
			$title = str_replace('&laquo;','&#8220;',$title);
			$title = str_replace('&raquo;','&#8221;',$title);
			$title = str_replace('«','“',$title);
			$title = str_replace('»','”',$title);
			echo '<a target="_blank" rel="noopener noreferrer" href="'.$item->get_permalink().'">'.html_entity_decode($title).'</a>';
			
			$desc = $item->get_content();
			$desc = preg_replace('/<img.*>/','',$desc);
			$desc = preg_replace('/<a.*>/','',$desc);
			$desc = str_replace('&laquo;','&#8220;',$desc);
			$desc = str_replace('&raquo;','&#8221;',$desc);
			$desc = str_replace('«','“',$desc);
			$desc = str_replace('»','”',$desc);
			echo '<p>'.html_entity_decode($desc).'</p>';
		
			$monthes = array(1 => '01', 2 => '02', 3 => '03', 4 => '04', 5 => '05', 6 => '06', 7 => '07', 8 => '08', 9 => '09', 10 => '10', 11 => '11', 12 => '12');
			$parsed = parse_url($feed->get_link());
			echo '<span class="tm">'.date('H:i, d.', strtotime($item->get_date())).$monthes[(date('n', strtotime($item->get_date())))].date('.Y',strtotime($item->get_date())).' - '.$parsed['host'].'</span>';
		echo '</div>';
	echo '</li>';
	$limit++;
}
?>