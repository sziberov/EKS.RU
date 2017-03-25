/*
** domain_title.js
**
** (c) kayover
*/

var at = " @ "
var domain = "EKS.RU"
var dash = " - "
var software = "Программы"
var video = "Видео"

if (document.title == '') {
	document.title += domain;
}
else {
	if (document.getElementById("domain_software")) {
		document.title += dash + software + at + domain;
		document.getElementById("domain_software").removeAttribute("id"); 
	} else
	if (document.getElementById("domain_video")) {
		document.title += dash + video + at + domain;
		document.getElementById("domain_video").removeAttribute("id"); 
	}
	else {
		document.title += at + domain;
	}
}