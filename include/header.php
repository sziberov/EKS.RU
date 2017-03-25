<!--
<div width="100%" style="background-color: transparent; height: 30px;" class="menu" id="announce">
	<iframe width="100%" style="height: 30px;" frameborder="0" height="30" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="http://www.fex.net/"></iframe>
</div>
-->
<table width="100%" height="27px" border="0" class="menu" id="menu"><tbody>
<tr>
	<td class="menu_text">
		&nbsp;
		<a href="/"><img src="/i/eks-small.svg" height="12" border="0" alt="EKS" title="EKS">-Главная</a>&nbsp;|
		<!--
		<a href="/video">Видео</a>&nbsp;|
		<a href="/audio">Аудио</a>&nbsp;|
		<a href="/images">Изображения</a>&nbsp;|
		<a href="/texts">Тексты</a>&nbsp;|
		<a href="/games">Игры</a>&nbsp;|
		-->
		<a href="/software">Программы</a>&nbsp;|
		<a href="/about">О сервисе</a>&nbsp;|
		<a href="/search">Поиск</a>
		&nbsp;
	</td>
	
	<!-- / -->
	
	<td align="right" valign="center" class="menu_text">
		&nbsp;
		<!--
		<span class="menu_login"><span id="timeKiev"></span> | <span id="timeMoscow"></span><script src="/js/time.js"></script></span>&nbsp;|
		<form style="display: inline;" action="EKS.my1.ru/language">
			<select name="lang" onchange="if (this.form) this.form.submit();">
				<option value="ru" selected="">русский</option>
				<option value="uk">українська</option>
				<option value="en">english</option>
				<option value="es">espanol</option>
				<option value="de">deutsch</option>
				<option value="fr">francais</option>
				<option value="pl">polski</option>
				<option value="ja">???</option>
				<option value="kk">?аза?</option>
			</select>
		</form>&nbsp;|
		<a href="EKS.my1.ru/login">Вход</a>
		-->
		<?php
			if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'moscow') {
				echo '<span class="menu_login"><span id="timeMoscow"></span></span><script src="/js/time.js"></script></span>&nbsp;|';
			} else if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'kiev') {
				echo '<span class="menu_login"><span id="timeKiev"></span></span><script src="/js/time.js"></script></span>&nbsp;|';
			} else if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'astana') {
				echo '<span class="menu_login"><span id="timeAstana"></span></span><script src="/js/time.js"></script></span>&nbsp;|';
			} else if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'new-york') {
				echo '<span class="menu_login"><span id="timeNewYork"></span></span><script src="/js/time.js"></script></span>&nbsp;|';
			}
		?>
		<form style="display: inline;" method="post" action="/time">
			<select name="time_region" onchange="if (this.form) this.form.submit();">
				<option <?php if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'moscow') echo 'selected'; ?> value="moscow">Москва</option>
				<option <?php if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'kiev') echo 'selected'; ?> value="kiev">Киев</option>
				<option <?php if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'astana') echo 'selected'; ?> value="astana">Астана</option>
				<option <?php if(isset($_COOKIE['time_region']) && $_COOKIE['time_region'] == 'new-york') echo 'selected'; ?> value="new-york">Нью-Йорк</option>
			</select>		
		</form>
		&nbsp;
	</td>
</tr>
</tbody></table>