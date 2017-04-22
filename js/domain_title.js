/*
** domain_title.js
**
** (c) kayover
*/

var at = " @ "
var domain = "EKS.RU"
var dash = " - "
var files = "Файлы"
var software = "Программы"
var video = "Видео"
var comments = "Отзывы"

if (document.title == '') {
	document.title += domain;
}
else {
	if (document.getElementById("category_files")) {
		document.title += dash + software + at + domain;
		document.getElementById("category_files").removeAttribute("id"); 
	} else
	if (document.getElementById("category_software")) {
		document.title += dash + software + at + domain;
		document.getElementById("category_software").removeAttribute("id"); 
	} else
	if (document.getElementById("category_video")) {
		document.title += dash + video + at + domain;
		document.getElementById("category_video").removeAttribute("id"); 
	} else
	if (document.getElementById("category_comments")) {
		document.title += dash + comments + at + domain;
		document.getElementById("category_comments").removeAttribute("id"); 
	}
	else {
		document.title += at + domain;
	}
}