<?php if(!isset($_COOKIE['time_region'])) { setcookie('time_region', 'moscow', 2147483647); $_COOKIE['time_region'] = 'moscow'; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Сервис хранения бесплатного ПО</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<link rel="stylesheet" type="text/css" href="/css/express_send.css">
<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
<script src="/js/getNumber.js" charset="utf-8" type="text/javascript"></script>
<script src="http://vk.com/js/api/share.js?90" charset="windows-1251" type="text/javascript"></script>
</head>

<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="height: 27px;">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); ?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div class="note_wr" id="fox_note"><div class="note_bl"></div></div>				

<center style="margin: -16px -16px;">

<div style="background-color:#f8f8f8;">
	<div style="width:960px; margin:0 auto; overflow:auto;">
	<img src="/i/eks-2-ru.svg" width="444" height="74" border="0" style="padding: 25px 0 35px; /*filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.15));*/">
	

	<!--<div style="width:540px; float:left; padding:25px 0; text-align:left;">
			<h1>Экспресс-файлы — сервис обмена информацией</h1>
			<p>
			Вы можете анонимно воспользоваться сервисом хранения, пересылки и обмена файлов, в этом случае доступ к объекту будет возможен только с помощью ключа, который Вы получите при создании объекта.
			</p>
		</div>
		<div style="overflow: visible; float: right;">
			<form action="http://fex.net/">
				<input type="submit" value="создать" class="button ex" style="float: left;">
			</form>
			<div style="overflow: visible;float: right;">
				<form method="post" action="http://www.ex.ua/storage">
					<input type="text" name="key" value="" class="ex" autocomplete="off" maxlength="12">
					<input type="submit" value="получить" class="button ex" style="border-radius:0 3px 3px 0; float: left;">
				</form>
			</div>-->
		</div>
	</div>
</div>


<div class="fox_wrap_top">
    <div class="fox_wrap clearfix">
        <div class="fox_col1">
        	<div class="fox_h">Экспресс-начальная настройка ОС</div>
        	<div class="fox_desc">
        		Чтобы скачать самое необходимое ПО, после переустановки операционной системы,<br> больше не нужно искать его по разным ресурсам. Достаточно зайти на EKS.RU и перейти в<br> раздел <q>Программы</q>, где Вы найдете почти - если не все, что Вам нужно.<p></p><p></p>
			</div>
        </div>

        <!-- / -->

        <div class="fox_col2">
        	<div class="fox_h">Экспресс-переход к объекту<i class="mail-howto"><div>Альтернатива поиску</div></i></div>
        	<div class="fox_desc">Если вам известен номер объекта, вы можете перейти к нему заполнив поле ниже.</div>
			
			<div style="overflow: visible; float: right;">
				<input id="key" type="text" value="" class="ex" autocomplete="off" placeholder="12345678" maxlength="8" style="text-align:left">
				<button id="getButton" onclick="getNumber()" class="button ex" style="border-radius:0 3px 3px 0; float: left; width: 97px;">получить</button>
			</div>
			<span id="fox_err_1">Не введен номер объекта</span>
			<span id="fox_err_2">Такого объекта не существует</span>
        </div>
    </div>
</div>

<div id="fox_body" style="width:964px; margin:0 auto; overflow:auto;">

	<!--
	<div id="fox_announcement" style="width:575px; float: left; font-size: 18px; text-align: justify; padding-top: 32px;">
		<b>Уважаемые посетители EKS.RU,</b>
		<p>
			По всей видимости решение использовать <a href="http://www.ucoz.ru/">uCoz</a> или <a href="https://mega.nz/">mega.nz</a> для хостинга файлов было в корне ошибочным. В итоге на их место встал <a href="https://github.com/">GitHub</a>.
		</p>
		<p>
			Он предоставляет:
		</p>
		<ul>
			<li style="list-style-type: circle;">100mb для каждого отдельного файла;</li>
			<li style="list-style-type: circle;">Неограниченное простанство в общем;</li>
			<li style="list-style-type: circle;">Прямые ссылки на файлы;</li>
		</ul>
		<p>
			А uCoz:
		</p>
		<ul>
			<li style="list-style-type: circle;">Только 15mb для каждого отдельного файла;</li>
			<li style="list-style-type: circle;">Постоянно, но очень медленно, растущие 400mb;</li>
			<li style="list-style-type: circle;">Прямые ссылки на файлы;</li>
		</ul>
		<p>
			И Mega:
		</p>
		<ul>
			<li style="list-style-type: circle;">Ограниченный только свободным местом размер одного файла;</li>
			<li style="list-style-type: circle;">50gb, расширяемые платно;</li>
			<li style="list-style-type: circle;">НЕ прямые ссылки на файлы;</li>
		</ul>
		<p>
			<b>Source-код всего сайта.</b><br>
			Так как мы теперь используем GitHub, вы можете при желании посмотреть его перейдя по <a href="https://github.com/sziberov/eks.ru">ссылке</a>. И там же вы можете предлагать свои доработки кода, или идеи.
		</p>
	</div>
	-->

	<div style="width: 335px; float: right; margin: 32px 0 0">
		<!-- Gismeteo informer 1 START -->
		<link rel="stylesheet" type="text/css" href="https://s1.gismeteo.ua/static/css/informer2/gs_informerClient.min.css">
		<div id="gsInformerID-d521spr2OQJ8m2" class="gsInformer" style="width:302px;height:225px">
		  <div class="gsIContent">
		   <div id="cityLink">
			 <a href="https://www.gismeteo.ua/weather-moscow-4368/" target="_blank">Погода в Москве</a>
		   </div>
		   <div class="gsLinks">
			</div>
		  </div>
		</div>
		<script src="https://www.gismeteo.ua/ajax/getInformer/?hash=d521spr2OQJ8m2" type="text/javascript"></script>
		<!-- Gismeteo informer 1 END -->

		<!-- Gismeteo informer 2 START -->
		<link rel="stylesheet" type="text/css" href="https://s1.gismeteo.ua/static/css/informer2/gs_informerClient.min.css">
		<div id="gsInformerID-3cmVE751oBJg44" class="gsInformer" style="width:302px;height:173px">
		  <div class="gsIContent">
		   <div id="cityLink">
			 <a href="https://www.gismeteo.ua/weather-astana-5164/" target="_blank">Погода в Астане</a>
		   <br />
		<a href="https://www.gismeteo.ua/weather-minsk-4248/" target="_blank">Погода в Минске</a>
		   <br />
		<a href="https://www.gismeteo.ua/weather-kyiv-4944/" target="_blank">Погода в Киеве</a>
		   <br />
		<a href="https://www.gismeteo.ua/weather-warsaw-3196/" target="_blank">Погода в Варшаве</a>
		   <br />
		<a href="https://www.gismeteo.ua/weather-berlin-2391/" target="_blank">Погода в Берлине</a>
		   </div>
		   <div class="gsLinks">
			 <table>
			   <tr>
				 <td>
				   <div class="leftCol">
					 <a href="https://www.gismeteo.ua" target="_blank">
					   <img alt="Gismeteo" title="Gismeteo" src="https://s1.gismeteo.ua/static/images/informer2/logo-mini2.png" align="absmiddle" border="0" />
					   <span>Gismeteo</span>
					 </a>
				   </div>
				   <div class="rightCol">
					 <a href="https://www.gismeteo.ua" target="_blank">Погода на 2 недели</a>
				   </div>
				   </td>
				</tr>
			  </table>
			</div>
		  </div>
		</div>
		<script src="https://www.gismeteo.ua/ajax/getInformer/?hash=3cmVE751oBJg44" type="text/javascript"></script>
		<!-- Gismeteo informer 2 END -->
	</div>
	
	<div class="news" style="width:575px; float: left;">
		<b>Новости</b>
		<div id="news">
			<ul class="top">
				<li id="data-tab_0" class="active"><span>Россия</span></li>
				<li id="data-tab_1"><span>Казахстан</span></li>
				<li id="data-tab_2"><span>Беларусь</span></li>
				<li id="data-tab_3"><span>Украина</span></li>
				<li id="data-tab_4"><span>Польша</span></li>
				<li id="data-tab_5"><span>Германия</span></li>
				<!--
				<li data-tab="2"><span>Экономика</span></li>
				<li data-tab="3"><span>Политика</span></li>
				<li data-tab="4"><span>Спорт</span></li>
				<li data-tab="5"><span>Авто</span></li>
				<li data-tab="6"><span>Общество</span></li>
				-->
			</ul>

			<!--
			<div class="more"><span>Еще</span><i></i></div>
			<div class="mlist">
				<li data-tab="7"><span>Технологии</span></li>
				<li data-tab="8"><span>Происшествия</span></li>
				<li data-tab="9"><span>Культура</span></li>
				<li data-tab="10"><span>Здоровье</span></li>
				<li data-tab="11"><span>Развлечения</span></li>
			</div>
			-->

			<div class="watch">
				<ul id="ti">
					<?php 
					require($_SERVER['DOCUMENT_ROOT'] . '/plugin/simplepie/autoloader.php'); 
					?>
					<div id="data-rss_0" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'http://k.img.com.ua/rss/ru/russia.xml',
							'http://www.vesti.ru/vesti.rss',
							'https://lenta.ru/rss', 
							'https://russian.rt.com/rss'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>
					<div id="data-rss_1" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'https://ru.sputniknews.kz/export/rss2/archive/index.xml', 
							'https://forbes.kz/rss/news'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>
					<div id="data-rss_2" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'http://naviny.by/rss/all.xml', 
							'https://news.tut.by/rss/all.rss'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>
					<div id="data-rss_3" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'http://k.img.com.ua/rss/ru/ukraine.xml', 
							'http://tsn.ua/rss/ukraine'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>
					<div id="data-rss_4" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'https://news.yandex.ru/Poland/index.rss', 
							'http://www.radiopolsha.pl/Rss/60fc19c2-8b53-4e3b-9e5a-083b1a1117b0', 
							'http://www.radiopolsha.pl/Rss/27b49742-467e-4969-a21a-b4d06e9b45e0',
							'http://www.radiopolsha.pl/Rss/7f484e70-46a9-455e-a959-ebaa4e45284f',
							'http://www.radiopolsha.pl/Rss/6a7ea344-0641-47a2-9dab-fdd73f51d4c7',
							'http://www.radiopolsha.pl/Rss/32d5353a-4284-4e42-b0ee-9ce2288aa2c4'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>
					<div id="data-rss_5" style="display: none;">
						<?php 
						$feed = new SimplePie();
						$feed->set_feed_url(array(
							'http://gordonua.com/xml/rss_tags/germanija.html',
							'https://news.yandex.ru/Germany/index.rss'
						));
						include($_SERVER['DOCUMENT_ROOT'] . "/include/parse.php");
						?>
					</div>

					<script>
						function updateNews() {
							if ($("#data-tab_0").hasClass("active")) { $('#data-rss_0').show().siblings().hide() };
							if ($("#data-tab_1").hasClass("active")) { $('#data-rss_1').show().siblings().hide() };
							if ($("#data-tab_2").hasClass("active")) { $('#data-rss_2').show().siblings().hide() };
							if ($("#data-tab_3").hasClass("active")) { $('#data-rss_3').show().siblings().hide() };
							if ($("#data-tab_4").hasClass("active")) { $('#data-rss_4').show().siblings().hide() };
							if ($("#data-tab_5").hasClass("active")) { $('#data-rss_5').show().siblings().hide() };
						};
						updateNews();
						
						$("ul.top").on('click', 'li', function() {
							$(this).siblings().removeAttr("class");
							$(this).addClass('active');
							updateNews();
						});
					</script>
				</ul>
				<div class="news-bottom-note">Новостной блок на ресурсе EKS.RU является перечнем названий статей и новостных материалов, ссылки на которые автоматически генерируются RSS-агрегатором. Администрация ресурса EKS.RU не выбирает статьи из источников для новостей и не размещает ссылки на них вручную. Наличие на ресурсе ссылок на посторонние веб-сайты не означает, что администрация ресурса EKS.RU разделяет мнения, опубликованные на таких посторонних веб-сайтах.</div>
			</div>
		</div>
	</div>

	<div class="google-services">
		<b>Сервисы Google</b>
		<div id="google-services">
			<div class="watch" data-category="0">
				<ul id="ti">
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://google.com">
							<div class="im" style="background: url(./i/google_apps/search.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://google.com">Поиск</a>
							<p>Крупнейшая поисковая система интернета. Основной продукт Google.</p>
							<span class="tm">google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://images.google.com">
							<div class="im" style="background: url(./i/google_apps/images.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://images.google.com">Картинки</a>
							<p>Картинки Google. Все картинки Интернета.</p>
							<span class="tm">images.google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://maps.google.com">
							<div class="im" style="background: url(./i/google_apps/maps.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://google.com">Карты</a>
							<p>Найти информацию о местных компаниях, посмотреть карты и получить указания о маршруте в Картах Google.</p>
							<span class="tm">maps.google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://youtube.com">
							<div class="im" style="background: url(./i/google_apps/youtube.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://youtube.com">YouTube</a>
							<p>Видеохостинг, предоставляющий пользователям услуги хранения, доставки, показа и монетизации видео.</p>
							<span class="tm">youtube.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://play.google.com">
							<div class="im" style="background: url(./i/google_apps/play.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://play.google.com">Play</a>
							<p>Миллионы приложений, игр, музыкальных треков, фильмов, книг и журналов, а также другие интересные материалы ждут вас.</p>
							<span class="tm">play.google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://news.google.com">
							<div class="im" style="background: url(./i/google_apps/news.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://news.google.com">Новости</a>
							<p>Исчерпывающая и актуальная информация, собранная службой "Новости Google" со всего света.</p>
							<span class="tm">news.google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://gmail.com">
							<div class="im" style="background: url(./i/google_apps/mail.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://gmail.com">Почта</a>
							<p>Почта Gmail – это удобный интерфейс, меньше спама и 15 ГБ пространства для писем и файлов.</p>
							<span class="tm">gmail.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://drive.google.com">
							<div class="im" style="background: url(./i/google_apps/drive.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://drive.google.com">Диск</a>
							<p>Храните фотографии, видеоролики, документы и другие файлы на Google Диске – они будут доступны вам в любой точке мира.</p>
							<span class="tm">drive.google.com</span>
						</div>
					</li>
					<li>
						<a target="_blank" rel="noopener noreferrer" href="http://translate.google.com">
							<div class="im" style="background: url(./i/google_apps/translate.png) center center /cover no-repeat"></div>
						</a>
						<div class="of">
							<a target="_blank" rel="noopener noreferrer" href="http://translate.google.com">Переводчик</a>
							<p>Бесплатный сервис Google позволяет мгновенно переводить слова, фразы и веб-страницы с английского на более чем 100 языков и обратно.</p>
							<span class="tm">translate.google.com</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>


<!--
<div style="width:960px; margin:0 auto; overflow:auto; font-size: 18px; text-align: justify; padding-top: 32px;" id="fox_google_apps">
	<div class="fox_h">Сервисы Google</div><br>
	<table width="100%" border="0" cellpadding="0" cellspacing="8" class="include_1"><tbody>
		<td align="center" valign="center"><a href="http://google.com"><img src="/i/google_apps/search.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://google.com"><b>Поиск</b></a></td>
		<td align="center" valign="center"><a href="http://maps.google.com"><img src="/i/google_apps/maps.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://maps.google.com"><b>Карты</b></a></td>
		<td align="center" valign="center"><a href="http://youtube.com"><img src="/i/google_apps/youtube.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://youtube.com"><b>YouTube</b></a></td>
		<td align="center" valign="center"><a href="http://play.google.com"><img src="/i/google_apps/play.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://play.google.com"><b>Play</b></a></td>
		<td align="center" valign="center"><a href="http://news.google.com"><img src="/i/google_apps/news.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://google-services.google.com"><b>Новости</b></a></td>
		<td align="center" valign="center"><a href="http://gmail.com"><img src="/i/google_apps/mail.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://gmail.com"><b>Почта</b></a></td>
		<td align="center" valign="center"><a href="http://drive.google.com"><img src="/i/google_apps/drive.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://drive.google.com"><b>Drive</b></a></td>
		<td align="center" valign="center"><a href="http://translate.google.com"><img src="/i/google_apps/translate.png" style="max-height: 64px; max-width: 64px;" border="0"></a><p><a href="http://translate.google.com"><b>Переводчик</b></a></td>
	</tbody></table>
</div>
-->
</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>