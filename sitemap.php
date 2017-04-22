<?php

class sitemap_generator
{
	private $sitemap_urls = array();
	private $base;
	private $protocol;
	private $domain;
	private $check = array();
	private $proxy = "";
	 
	public function set_ignore($ignore_list)
	{
		$this->check = $ignore_list;
	}

	public function set_proxy($host_port)
	{
		$this->proxy = $host_port;
	}

	private function validate($url)
	{
		$valid = true;
		
		foreach($this->check as $val)
		{
			if(stripos($url, $val) !== false)
			{
				$valid = false;
				break;
			}
		}
		return $valid;
	}
	 
	private function multi_curl($urls)
	{
		$curl_handlers = array();
		
		foreach ($urls as $url)
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			if (isset($this->proxy) && !$this->proxy == '')
			{
				curl_setopt($curl, CURLOPT_PROXY, $this->proxy);
			}
			$curl_handlers[] = $curl;
		}

		$multi_curl_handler = curl_multi_init();
		foreach($curl_handlers as $key => $curl)
		{
			curl_multi_add_handle($multi_curl_handler,$curl);
		}
		
		do
		{
			$multi_curl = curl_multi_exec($multi_curl_handler, $active);
		}
		while ($multi_curl == CURLM_CALL_MULTI_PERFORM  || $active);
		 
		foreach($curl_handlers as $curl)
		{
			if(curl_errno($curl) == CURLE_OK)
			{
				$content = curl_multi_getcontent($curl);
				$this->parse_content($content);
			}
		}
		curl_multi_close($multi_curl_handler);
		return true;
	}
	 
	public function get_links($domain)
	{
		$this->base = str_replace("http://", "", $domain);
		$this->base = str_replace("https://", "", $this->base);
		$host = explode("/", $this->base);
		$this->base = $host[0];
		$this->domain = trim($domain);
		if(strpos($this->domain, "http") !== 0)
		{
			$this->protocol = "http://";
			$this->domain = $this->protocol.$this->domain;
		}
		else
		{
			$protocol = explode("//", $domain);
			$this->protocol = $protocol[0]."//";
		}
		 
		if(!in_array($this->domain, $this->sitemap_urls))
		{
			$this->sitemap_urls[] = $this->domain;
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->domain);
		if (isset($this->proxy) && !$this->proxy == '')
		{
			curl_setopt($curl, CURLOPT_PROXY, $this->proxy);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($curl);
		curl_close($curl);
		$this->parse_content($page);
	}
	 
	private function parse_content($page)
	{
		preg_match_all("/<a[^>]*href\s*=\s*'([^']*)'|".'<a[^>]*href\s*=\s*"([^"]*)"'."/is", $page, $match);
		$new_links = array();
		for($i = 1; $i < sizeof($match); $i++)
		{
			foreach($match[$i] as $url)
			{
				if(strpos($url, "http") === false  && trim($url) != "" && trim($url)!= "/")
				{
					if($url[0] == "/") $url = substr($url, 1);
					else if($url[0] == ".")
					{
						while($url[0] != "/")
						{
							$url = substr($url, 1);
						}
						$url = substr($url, 1);
					}
					while($url[strlen($url) - 1] == "/")
					{
						$url = substr($url, 0, -2);
					}
					$url = $this->protocol.$this->base."/".$url;
				}
				if(!in_array($url, $this->sitemap_urls) && trim($url) !== "")
				{
					if($this->validate($url))
					{
						if(strpos($url, "http://".$this->base) === 0 || strpos($url, "https://".$this->base) === 0)
						{
							$this->sitemap_urls[] = $url;
							$new_links[] = $url;
						}
					}
				}
			}
		}
		$this->multi_curl($new_links);
		return true;
	}
	 
	public function generate_sitemap()
	{
		$sitemap = new SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
		foreach($this->sitemap_urls as $url)
		{
			$url_tag = $sitemap->addChild("url");
			$url_tag->addChild("loc", htmlspecialchars($url));
		}
		return $sitemap->asXML();
	}
}

$host=$_SERVER['SERVER_NAME'];
$url=$_SERVER['REQUEST_URI'];
$filename=$_GET['filename'];
if(isset($_GET['url']))
{
	$sitemap = new sitemap_generator();
	$sitemap->set_ignore(array("javascript:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif", ".zip", ".rar", ".svg", ".exe", ".mp4", ".mkv", "mailto:", "/edit", "/login", "/register", "/audio", "/images", "texts", "games", "/about", "/search", "/contact", "/copyright", "/password", "?", "+"));
	$sitemap->get_links($_GET['url']);
	$map = $sitemap->generate_sitemap();

	if(file_put_contents($filename,$map))
	{
		$content='<h1>ФАЙЛ SITEMAP УСПЕШНО СОЗДАН!</h1><a href="http://'.$host.'/'.$filename.'">ссылка на файл</a>';
	}
	else
    {
		$content='<h1>НЕ УДАЛОСЬ СОЗДАТЬ SITEMAP!</h1>';
    }
}
else
{
	$content='
				<table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
					<td>
						<form>
							<table width="380" border="0" cellpadding="4" cellspacing="8"><tbody>
								<tr>
									<td colspan="2" align="center">
										<h1>Генератор карты сайта</h1>
									</td>
								</tr>

								<tr>
									<td align="right">URL сайта:</td>
									<td><input id="url" name="url" type="text" value="http://'.$host.'" style="width: 120px"></td>
								</tr>
								<tr>
									<td align="right">имя файла карты:</td>
									<td><input id="filename" name="filename" type="text" value="sitemap.xml" style="width: 120px"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="сгенерировать" class="button"></td>
								</tr>
							</tbody></table>
						</form>
				</tr></tbody></table>
	';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Генератор карты сайта</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 28px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div id="content"><?php echo $content; ?></div>

</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>