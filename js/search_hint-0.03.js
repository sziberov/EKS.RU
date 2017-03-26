/*
** search_hint-0.03.js
**
** (c) bymer
*/

var hint_tag = 'search';
var hint_focus = 1;
var hint_value = '';
var hint_none = '';
var hint_pos = 0;
var hint_max = 0;
var hint_mouse = 0;

function hintSetTag(tag, focus)
{
	hint_tag = tag;
	hint_focus = focus;
}

function hintClose()
{
	hint_pos = 0;
	hint_value = '';
	hint_mouse = 0;

	hintHide();
}

function hintGetElement(tag)
{
	return document.getElementById(hint_tag + '_' + tag);
}

function hintClick(title)
{
	var e = hintGetElement('text');
	if (e)
	{
		e.value = title;
		var f = hintGetElement('form');
		if (f) f.submit();
	}
}

function hintDivClass(id, name)
{
	var e = hintGetElement('hint_div_' + id);
	if (e) e.className = name;
}

function hintSelect(pos)
{
	if (pos != hint_pos)
	{
		if (hint_pos) hintDivClass(hint_pos, 'search_hint_div');
		if (pos) hintDivClass(pos, 'search_hint_div_active');

		var e = hintGetElement('text');
		if (e)
		{
			if (pos)
			{
				var d = hintGetElement('hint_div_' + pos);
				if (d) e.value = d.title;
			}
			else
			{
				e.value = hint_value;
			}
		}

		hint_pos = pos;
	}
}

function hintMouseSelect(pos)
{
	if (hint_mouse) hintSelect(pos);
	else hint_mouse = 1;
}

function hintResponse(code, data, used_value)
{
	var e = hintGetElement('hint');
	if (e)
	{
		if (code == "200" && data != "")
		{
			var a = data.split('\n');
			var body = '';
			for (var i in a)
			{
				var id = parseInt(i) + 1;
				body += '<div id="search_hint_div_' + id + '" class="search_hint_div" onmousedown="hintClick(this.title);" onmouseover="hintMouseSelect(' + id + ');" title="' + a[i] + '">' + a[i] + '</div>';
			}

			e.innerHTML = body;
			hint_max = a.length;
			hintShow();
		}
		else
		{
			e.innerHTML = '';
			hintHide();

			if (code == "200") hint_none = used_value;
		}
	}
}

function hintChange()
{
	var e = hintGetElement('text');
	if (e)
	{
		if (e.value != hint_value)
		{
			hint_value = e.value;
			hint_pos = 0;
			hint_mouse = 0;

			if (!hint_value.match(/^\s*$/) && (!hint_none || hint_value.indexOf(hint_none) != 0))
				request('/r_search_hint?s=' + encodeURIComponent(hint_value), hintResponse, hint_value);
			else
				hintHide();
		}
	}
}

function hintShow()
{
	var e = hintGetElement('hint');
	if (e) e.style.display = 'block';
}

function hintHide()
{
	var e = hintGetElement('hint');
	if (e) e.style.display = 'none';
}

function hintReset()
{
	hintSelect(0);
}

function hintCloseTimeout()
{
	setTimeout(hintClose, 100);
}

function hintChangeTimeout()
{
	setTimeout(hintChange, 50);
}

function hintListen()
{
	var e = hintGetElement('text');
	if (e)
	{
		e.onkeyup = hintKey;
		e.onfocus = hintChange;
		e.onpaste = hintChangeTimeout;
		e.onblur = hintCloseTimeout;

		if (hint_focus && !e.value) e.focus();
	}

	var e = hintGetElement('hint');
	if (e)
	{
		e.onmouseout = hintReset;
	}
}

function hintKey(event)
{
	if (window.event) event = window.event;

	var cancel = false;
	var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
	switch (code)
	{
		case 38:
			if (hint_value)
			{
				hintSelect(hint_pos ? hint_pos - 1 : hint_max);
				cancel = true;
			}
			break;
		case 40:
			if (hint_value)
			{
				hintSelect(hint_pos == hint_max ? 0 : hint_pos + 1);
				cancel = true;
			}
			break;
	}
	if (!cancel) hintChange();
}

onLoadAction.push(hintListen);