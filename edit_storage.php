<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/get_functions.php");

$original_id = $_SERVER['QUERY_STRING'];
if(!in_array($original_id, $possible_cats)) {
	 header('Location: /edit_storage/files');
}

if(!isset($_COOKIE['u_log']) && !isset($_COOKIE['u_pass'])){
   header('Location: /login?d=1');
}

if(isset($_COOKIE['saveStatus']) && $_COOKIE['saveStatus'] == 'upload_success') {
	$saveStatus = 'upload_success';
} else 
if(isset($_COOKIE['saveStatus']) && $_COOKIE['saveStatus'] == 'upload_error') {
	$saveStatus = 'upload_error';
} 

$submit = 0;

if(isset($_COOKIE['saveStatus'])) {
	unset($_COOKIE['saveStatus']);
	setcookie('saveStatus', null, -1, '/');

	$submit = 1;
} 

function create_id() {
	for ($i = 0; $i<8; $i++) {
		global $thisObjectID;
		$thisObjectID .= mt_rand(0,9);
	}
}

create_id();

while (file_exists($root.'/load/'.$thisObjectID)):
	create_id();
endwhile;

if ($submit != 1) {
	mkdir($root.'/load/'.$thisObjectID, 0777, true);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<title>Редактирование</title>

<?php
$head = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/include/head.html");
print $head;
?>

<meta name="description" content="Сервис хранения бесплатного ПО. EKS-программы. Скачать бесплатно.">
<meta name="keywords" content="сервис, хранение бесплатного по, программы, онлайн, скачать">

<script src="/js/jquery-3.1.1.min.js" charset="utf-8" type="text/javascript"></script>
</head>


<body onload="initBody()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"><tbody>
<tr><td valign="top" style="height: 28px;">
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/include/header.php"); 
?>
</td></tr>
<tr><td valign="top" style="padding: 16px;" id="body_element">

<div class="drag_area"><span>Перетащите файлы сюда</span></div>

<p>
<script>
function viewObject()
{
	window.location = '<?php echo '/view/'.$original_id ?>';
	return true;
}

function viewBack()
{

	var f = document.forms['edit'];
	if (f)
	{
		var back = f.elements['back'].value;
		if (back)
		{
			window.location = back;
			return true;
		}
	}

	history.back();
	return false;
}
</script>
</p>
<?php /*error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 1); ini_set('html_errors', 1);*/ ?>
<form name="edit" method="post" action="add_object">
<table width="100%" border="0" cellpadding="4" cellspacing="8" id="editor_table"><tbody>
	<?php
	echo '<input type="hidden" name="upload_id" value="'.$thisObjectID.'">';

	//echo sys_get_temp_dir();
	?>
	<input type="hidden" name="back" value="<?php echo '/'.$original_id ?>">
	<input type="hidden" name="date_1" value="<?php
	date_default_timezone_set('UTC');
	function date_offset($format, $offset) {
	  $time = time() + $offset; # $offset should be in milliseconds
	  return date($format, $time); # with your require display format $format
	}

	$monthes = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');
	echo date_offset('G:i, j ', 10800) . $monthes[(date_offset('n', 10800))] . date_offset(' Y', 10800);
	?>">
	
	<tr>
		<td colspan="3" align="center"><h1>Редактирование</h1></td>
	</tr>
	<tr>
		<td width="120" align="right">заголовок:</td>
		<td><input type="text" name="title" value="<?php echo $_REQUEST["title"] ?>" style="width: 100%" maxlength="255"></td>
		<td rowspan="2" width="120" valign="top" align="right"></td>
	</tr>
	<!--
	<tr>
		<td width="120" align="right">имя:</td>
		<td><input id="latin" type="text" name="username" value="" style="width: 100%" maxlength="15" pattern="[a-zA-Z0-9 ]+"></td>
		<td rowspan="2" width="120" valign="top" align="right"></td>
		<script>
			$("#latin").on("keypress", function (event) {
				var englishAlphabetDigitsAndWhiteSpace = /[A-Za-z0-9 ]/g;
				var key = String.fromCharCode(event.which);

				if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetDigitsAndWhiteSpace.test(key)) {
					return true;
				}
				return false;
			});

			$('#latin').on("paste", function (e) {
				e.preventDefault();
			});
		</script>
	</tr>
	-->
	<tr>
		<td align="right">текст:</td>
		<td><textarea name="post" value="<?php echo $_REQUEST["post"] ?>" rows="16" style="width: 100%" maxlength="65535"></textarea></td>
	</tr>

	<tr><td></td><td>
		<input type="submit" value="сохранить" class="button">&nbsp;
		<input type="button" value="вернуться" class="button" onclick="viewBack();">&nbsp;
		<input type="button" value="смотреть" class="button" onclick="viewObject();">&nbsp;

		<?php 
		echo '<span id="saveStatus"';
		if(isset($saveStatus) && $saveStatus == 'upload_success') {
			echo ' class="upload_success">сохранен';
		} else 
		if(isset($saveStatus) && $saveStatus == 'upload_error') {
			echo ' class="upload_error">ошибка при сохранении';
		} 
		echo '</span>';
		?>
		<script>
			setTimeout(function(){
				var item = document.getElementById('saveStatus');
				item.innerHTML = "";
				$("#saveStatus").removeClass()
				/*item.parentNode.removeChild(item);*/
			}, 2000);
		</script>
	</td><td></td></tr>

</tbody></table>
</form>

<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0" id="uploadTable"><tbody>
<tr><td><b>Файлы в объекте:</b></td><td width="120">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td>
		<div class="holder" style="position: relative;">
			<span id="uploadButton" style="position: relative; z-index: 1;">приложить файлы</span>
			<div id="filelist">Ваш браузер не поддерживает Flash, Silverlight или HTML5.</div>
		</div>
	</td>
	<!--
	<td class="small" style="color: #eee;">fs0</td>
	-->
	<td align="right" class="small">При каждом обновлении страницы создается новый объект (отправка формы не учитывается). Будьте бдительны!</td>
</tr></tbody></table>

<script type="text/javascript" src="/js/plupload.min.js"></script>

<pre id="console"></pre>
<script type="text/javascript">
var swfu_msg = {
	300:	"Ошибка при удалении файла.",
	301:	"приложить файлы",
	302:	"в очереди",
	303:	"отменить",
	304:	"слишком большое кол-во файлов для загрузки.",
	305:	"слишком большой размер файла для загрузки.",
	306:	"нет доступа к файлу или файл пустой.",
	307:	"файлы данного типа запрещены для загрузки.",
	308:	"загружается",
	309:	"загружено",
	310:	"загружен, сохраняется на диске...",
	311:	"ошибка",
	312:	"загружен",
	313:	"копировать",
	314:	"Удалить файл?",
	315:	"удалить",
	316:	"ошибка при сохранении файла",
	317:	"Загрузка будет прекращена, если Вы покините данную страницу."
};

var swfu_index = new Array();
swfu_index[0] = 'header';

function getUploadSpeed(bytes, ms)
{
	var s = Math.round(bytes * 1000 / ms);
	if (s < 10000) return s + ' b/s';
	if (s < 1000000) return (s >> 10) + ' kb/s';
	return (s >> 20) + ' mb/s';
}

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
    browse_button: $('#uploadButton').get(0),
    container: $('.holder').get(0),
	drop_element: document.body,
	url : '/upload?original_id=<?php echo $thisObjectID ?>',
	flash_swf_url : '/js/Moxie.swf',
	silverlight_xap_url : '/js/Moxie.xap',
	
	filters : {
		max_file_size : '1000gb',
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				// console.log('start', file);
				
				var e = document.getElementById('uploadStatus' + file.id);
				
				if(e) {
					e.innerHTML = swfu_msg[308];
				}

				swfu_timer = (new Date()).getTime();

	    		var table = document.getElementById('uploadTable');
				
				if(table) {   		
					var r = table.insertRow(table.rows.length);
					
					if(r) {
						swfu_index.push(file.id);

						var c = r.insertCell(0);
						c.innerHTML = toHtml(file.name.length > 93 ? file.name.substr(0, 90) + '...' : file.name);
						c.title = file.name;
	
						c = r.insertCell(1);
						c.align = 'right';
						c.id = 'uploadStatus' + file.id;
						c.className = 'upload_progress';
						c.innerHTML = swfu_msg[302];
	
						c = r.insertCell(2);
						c.align = 'right';
						c.innerHTML = fn(file.size);
	
						c = r.insertCell(3);
						c.align = 'right';
						c.id = 'uploadAction' + file.id;
						c.innerHTML = '<span class=r_button_small><a href=\'javascript: cancelUpload("' + file.id+ '");\'>отменить</a></span>';
					}
				}
			});

			up.start();
		},

		UploadProgress: function(up, file) {
	    		var e = document.getElementById('uploadStatus' + file.id);
	    		var b_complete = file.loaded;
	    		var b_total = file.size;

				if(e) {
					// e.innerHTML = (file.percent < 100) ? file.percent + '%' : swfu_msg[310];
					if (b_complete < b_total)
					{
						var t = (new Date()).getTime() - swfu_timer;
						e.innerHTML = ((t > 2000 && b_complete > 0) ? getUploadSpeed(b_complete, t) + ', ' : '') + swfu_msg[309] + ' ' + (file.percent) + '%';
					}
					else
					{
						e.innerHTML = swfu_msg[310];
					}
				}
		},

		FileUploaded: function(up, file) {
			var is_picture = file.name.match(/.(jpg|jpeg|png|gif)$/i);

			var e = document.getElementById('uploadStatus' + file.id);
			if (e)
			{
				e.className = 'upload_success';

				if (is_picture)
				{
					var img = document.createElement('img');
					img.src = "/load/<?php echo $thisObjectID ?>/" + file.name;
					img.style = "max-width: 64px; max-height: 64px;";
					img.title = file.name;

					e.innerHTML = '';
					e.appendChild(img);
				}
				else
				{
					e.innerHTML = swfu_msg[312];
				}
			}

			e = document.getElementById('uploadAction' + file.id);
			if (e)
			{
				e.innerHTML = '<span class=r_button_small><a href=\'javascript: deleteUpload(' + file.id + ', ' + file.name + ');\' onclick=\'return confirm("' + swfu_msg[314] + '");\'>' + swfu_msg[315] + '</a></span>&nbsp;';

				e.id = 'uploadAction' + file.id;

				for (var i in swfu_index)
				{
					if (swfu_index[i] == file.id)
					{
						swfu_index[i] = file.id;
						break;
					}
				}
			}

		    if (up.files.length > 0 && (up.state == undefined || up.state != plupload.STARTED)) {
		        up.start();
		    }
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

function cancelUpload(file_id)
{
	for (var i in swfu_index)
	{
		if (swfu_index[i] == file_id)
		{
			var table = document.getElementById('uploadTable');
			if (table) table.deleteRow(i);

			swfu_index.splice(i, 1);
			break;
		}
	}

	uploader.removeQueuedFile(file_id);
}

function deleteUpload(upload_id, file_name)
{
	for (var i in swfu_index)
	{
		if (swfu_index[i] == upload_id)
		{
			var table = document.getElementById('uploadTable');
			if (table) table.deleteRow(i);

			swfu_index.splice(i, 1);
			break;
		}
	}

	$.ajax({
		url: '/r_delete_upload',
		type: "get",
		data: { 
			original_id: <?php echo $thisObjectID ?>, 
			file: file_name, 
		},
		success: function (response) {
		 // do something
		},
		error: function () {
		 // do something
		}
	});
}

function deleteUploadResponse(code, data, upload_id)
{
	if (code != 200 || data != '1') alert(swfu_msg[300]);
}

$(function() {
	document.addEventListener("dragover", function( event ) {
      // prevent default to allow drop
      event.preventDefault();
  	}, false);


	var dragging = 0;

	$(document).on('dragenter', function(event) {
		dragging++;
		if(containsFiles(event.originalEvent)) $('.drag_area').fadeIn(255);
	});

	$(document).on('dragleave', function() {
		dragging--;
    	if (dragging === 0) {
    	    $('.drag_area').fadeOut(255);
    	}

	});

	$(document).on('drop', function(event) {
		dragging = 0;
		$('.drag_area').fadeOut(255);
		event.preventDefault();
	});

	function containsFiles(event) {
	    if (event.dataTransfer.types) {
	        for (var i = 0; i < event.dataTransfer.types.length; i++) {
	            if (event.dataTransfer.types[i] == "Files") {
	                return true;
	            }
	        }
	    }
	    
	    return false;	
	}
});

uploader.init();
</script>
</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>