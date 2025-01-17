/*
** arr_btns.js
**
** (c) kayover
*/

var numberFormat = function(number, width) { // useful for padding numbers with 0's
	return new Array(width + 1 - (number + '').length).join('0') + number;
}

var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
var name = filename.split('.php')[0];

var left = parseInt(name) + parseInt(1);
var leftPage = numberFormat(left, 8);

var right = parseInt(name) - parseInt(1);
var rightPage = numberFormat(right, 8);
	
$.ajax({
	url:'./' + leftPage + '.php',
	type:'HEAD',
	error: function()
	{
		document.getElementById('arr_btns').insertAdjacentHTML('afterbegin', '<a id="arr_l"><img src="../t3/arr_lg.gif" width="20" height="20" border="0" alt="вы находитесь на первой странице" title="вы находитесь на первой странице"></a>');
	},
	success: function()
	{
		document.getElementById('arr_btns').insertAdjacentHTML('afterbegin', '<a id="arr_l" href="./' + leftPage + '.php"><img src="../t3/arr_l.gif" width="20" height="20" border="0" alt="перейти на предыдущую страницу, Ctrl ←" title="перейти на предыдущую страницу, Ctrl ←"></a>');
	}
});

$.ajax({
	url:'./' + rightPage + '.php',
	type:'HEAD',
	error: function()
	{
		document.getElementById('arr_btns').insertAdjacentHTML('beforeend', '<a id="arr_l"><img src="../t3/arr_rg.gif" width="20" height="20" border="0" alt="вы находитесь на последней странице" title="вы находитесь на последней странице"></a>');
	},
	success: function()
	{
		document.getElementById('arr_btns').insertAdjacentHTML('beforeend', '<a id="arr_r" href="./' + rightPage + '.php"><img src="../t3/arr_r.gif" width="20" height="20" border="0" alt="перейти на следующую страницу, Ctrl →" title="перейти на следующую страницу, Ctrl →"></a>');
	}
});

$(document).keydown(function(e){
	if (e.ctrlKey) {
		if (e.keyCode == 37) {
			$('#arr_l')[0].click();
		}
		else if (e.keyCode == 39) {
			$('#arr_r')[0].click();
		}
	}
});