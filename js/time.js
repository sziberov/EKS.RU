/*
** time.js
**
** (c) kayover
*/

//(function () {
//    function checkTime(i) {
//        return (i < 10) ? "0" + i : i;
//    }
//
//    function startTime() {
//        var today = new Date(),
//            h = checkTime(today.getHours()),
//            m = checkTime(today.getMinutes()),
//            s = checkTime(today.getSeconds());
//        document.getElementById('time').innerHTML = h + ":" + m /*+ ":" + s*/;
//        t = setTimeout(function () {
//            startTime()
//        }, 500);
//    }
//    startTime();
//})();


function checkTime(i) {
	return (i < 10) ? "0" + i : i;
};

function calcTime(city, offset) {
	d = new Date();
	utc = d.getTime() + (d.getTimezoneOffset() * 60000);
	nd = new Date(utc + (3600000*offset)),
		h = checkTime(nd.getHours()),
		m = checkTime(nd.getMinutes()),
		s = checkTime(nd.getSeconds());
	return nd.toLocaleString();
};

function updateTime() {
	if (document.getElementById('timeMoscow')) {
		calcTime('Moscow', '+3');
		document.getElementById('timeMoscow').innerHTML = h + ":" + m /*+ ":" + s*/;
	}
	if (document.getElementById('timeKiev')) {
		calcTime('Kiev', '+3');
		document.getElementById('timeKiev').innerHTML = h + ":" + m /*+ ":" + s*/;
	} else 
	if (document.getElementById('timeAstana')) {
		calcTime('Astana', '+6');
		document.getElementById('timeAstana').innerHTML = h + ":" + m /*+ ":" + s*/;
	}
	if (document.getElementById('timeNewYork')) {
		calcTime('NewYork', '-4');
		document.getElementById('timeNewYork').innerHTML = h + ":" + m /*+ ":" + s*/;
	}
}

setInterval(updateTime, 500);