/*
** file_count.js
**
** (c) kayover
*/

$("#file_count").html($('#file_list tbody tr').length - 1);
$('#file_count').removeAttr("id");
