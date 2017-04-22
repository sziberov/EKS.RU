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

			var upload_id = parseInt(a[0]);

			if (upload_id)
			{
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
			}
			else
			{
				var e = document.getElementById('uploadStatus' + file.id);
				if (e)
				{
					e.className = 'upload_error';
					e.innerHTML = swfu_msg[316];
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