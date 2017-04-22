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
<script type="text/javascript">
var app = {}, uploader;
var swfu_host = "eks.ru";
var swfu_fs_id = 0;
var swfu_uid = <?php echo $thisObjectID ?>;
var swfu_show_delete = 1;
var statusTimeoutId = 0;
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

function updatePostParams()
{
}

var swfu_post_params = {
	key		: "14863381600021723382506469750432",
	object_id	: <?php echo $thisObjectID ?>,
	dpr		: (window.devicePixelRatio || 1)
};

function viewObject()
{
	window.location = '/view/<?php echo $thisObjectID ?>';
	return true;
}

function gpObject()
{
	window.location = '/object_gp/<?php echo $thisObjectID ?>';
	return true;
}

function flagObject()
{
	window.location = '/edit_flags/<?php echo $thisObjectID ?>?back=http://rover.info/13378275%3Fr=1';
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

function saveObject()
{
	var f = document.forms['edit'];
	if (f)
	{
		var a = f.elements['avatar_id'];
		request_post('/r_edit/<?php echo $thisObjectID ?>', {
				title		: f.elements['title'].value,
				post		: f.elements['post'].value,
				public		: f.elements['public'].value,
				avatar_id	: a ? a.options[a.selectedIndex].value : 0
			}, saveObjectResponse, <?php echo $thisObjectID ?>);

		return false;
	}
	else
	{
		return true;
	}
}

function updateStatus(msg, className)
{
	statusTimeoutId = 0;

	var e = document.getElementById('saveStatus');
	if (e)
	{
		e.className = className;
		e.innerHTML = msg;
	}
}

function saveObjectResponse(code, data, object_id)
{
	if (code != 200 || data != '1') updateStatus("ошибка при сохранении", 'upload_error');
	else updateStatus("сохранен", 'upload_success');

	if (statusTimeoutId) clearTimeout(statusTimeoutId);
	statusTimeoutId = setTimeout("updateStatus('', '')", 2000);
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
		</div>
	</td>
	<!--
	<td class="small" style="color: #eee;">fs0</td>
	-->
	<td align="right" class="small">При каждом обновлении страницы создается новый объект (отправка формы не учитывается). Будьте бдительны!</td>
</tr></tbody></table>

<script type="text/javascript" src="/js/plupload.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<!--<script type="text/javascript" src="/js/up2.js"></script>-->
<script>
/*
** http://ex.ua/js/swfu.js
**
** (c) bymer
*/

var swfu;
var swfu_index = new Array();
var swfu_timer = 0;

swfu_index[0] = 'header';

function deleteUploadResponse(code, data, upload_id)
{
	if (code != 200 || data != '1') alert(swfu_msg[300]);
}

function rotateUploadResponse(code, data, upload_id)
{
	if (code == 200 && data != '' && upload_id)
	{
		var a = data.split(',');
		var got_upload_id = parseInt(a[0]);

		if (upload_id == got_upload_id)
		{
			var img = document.getElementById('img_' + upload_id);
			if (img)
			{
				img.src = "http://fs" + a[1] + "." + swfu_host + "/show/" + (typeof(swfu_storage_key) == 'undefined' ? "" : swfu_storage_key + "/") + upload_id + "/" + upload_id + "." + a[2] + "?" + a[6] + (a[5] != "0" ? "," + a[5] : "");
				img.width = a[3];
				img.height = a[4];
			}
		}
	}
}

function pictureUploadResponse(code, data, upload_id)
{
}

function deleteUpload(upload_id)
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

	request((typeof(swfu_storage_key) == 'undefined' ? '/r_delete_upload/' : '/r_delete_storage_upload/' + swfu_storage_key + '/') + upload_id, deleteUploadResponse, upload_id);
}

function rotateUpload(upload_id, rotate)
{
	request((typeof(swfu_storage_key) == 'undefined' ? '/r_rotate_upload/' : '/r_rotate_storage_upload/' + swfu_storage_key + '/') + upload_id + '?r=' + rotate, rotateUploadResponse, upload_id);
}

function pictureUpload(upload_id)
{
	request((typeof(swfu_storage_key) == 'undefined' ? '/r_picture_upload/' : '/r_picture_storage_upload/' + swfu_storage_key + '/') + upload_id, pictureUploadResponse, upload_id);
}

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

function getUploadSpeed(bytes, ms)
{
	var s = Math.round(bytes * 1000 / ms);
	if (s < 10000) return s + ' b/s';
	if (s < 1000000) return (s >> 10) + ' kb/s';
	return (s >> 20) + ' mb/s';
}

function initSwfu() {

	uploader = app.upload({
		upload_url: "/upload?original_id=<?php echo $thisObjectID ?>",

    	browse_button: $('#uploadButton').get(0),
    	container: $('.holder').get(0),

    	drop_element: document.body,

		file_data_name: 'Filedata',

		cb_start: function(up, file) {

			// console.log('start', file);
			
			var e = document.getElementById('uploadStatus' + file.id);
			
			if(e) {
				e.innerHTML = swfu_msg[308];
			}

			swfu_timer = (new Date()).getTime();
		},

		cb_ready: function(file, data) {

			var a = data.split(',');
			var is_picture = (a.length >= 6);


				var e = document.getElementById('uploadStatus' + file.id);
				if (e)
				{
					e.className = 'upload_success';

					if (is_picture)
					{
						var img = document.createElement('img');
						img.src = "http://fs" + a[1] + "." + swfu_host + "/show/" + (typeof(swfu_storage_key) == 'undefined' ? "" : swfu_storage_key + "/") + upload_id + "/" + upload_id + "." + a[2] + "?" + a[6] + (a[5] != "0" ? "," + a[5] : "");
						img.width = a[3];
						img.height = a[4];
						img.title = file.name;
						img.id = 'img_' + upload_id;

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
					e.innerHTML = swfu_show_delete ?
						(is_picture ?
							'<span class=r_button_small><a href=\'javascript: pictureUpload(' + upload_id + ');\'>&#10003;</a></span>&nbsp;' +
							'<span class=r_button_small><a href=\'javascript: rotateUpload(' + upload_id + ', 270);\'>&olarr;</a></span>' +
							'<span class=r_button_small><a href=\'javascript: rotateUpload(' + upload_id + ', 90);\'>&orarr;</a></span>&nbsp;' :
							'') +
						'<span class=mail-add-edit data-uid="' + (typeof(swfu_storage_key) == 'undefined' ? '' : swfu_storage_key + '/') + upload_id + '"></span>'+
						'<span class=r_button_small><a href=\'/move_file/' + (typeof(swfu_storage_key) == 'undefined' ? '' : swfu_storage_key + '/') + upload_id + '\'>' + swfu_msg[313] + '</a></span>' + 
						'<span class=r_button_small><a href=\'javascript: deleteUpload(' + upload_id + ');\' onclick=\'return confirm("' + swfu_msg[314] + '");\'>' + swfu_msg[315] + '</a></span>' :
						'&nbsp;';

					e.id = 'uploadAction' + upload_id;

					for (var i in swfu_index)
					{
						if (swfu_index[i] == file.id)
						{
							swfu_index[i] = upload_id;
							break;
						}
					}
				}


		},

    	cb_progress: function(file) {

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

    	cb_added: function(files) {

    		var table = document.getElementById('uploadTable');
			
			if(table) {   		

    			$.each(files, function(n,file){			

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
						c.innerHTML = '<span class=r_button_small><a href=\'javascript: cancelUpload("' + file.id+ '");\'>' + swfu_msg[303] + '</a></span>';
					}

				});
			}
    	}, 

    	multipart_params: swfu_post_params
	});

	window.onbeforeunload = function () {
		if(uploader.state != 1) return swfu_msg[317];
	}
}

onLoadAction.push(initSwfu);


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
</script>
</td></tr>
<tr><td valign="bottom" height="32">
<?php include($_SERVER['DOCUMENT_ROOT'] . "/include/footer.html"); ?>
</td></tr>
</tbody></table>
</body></html>