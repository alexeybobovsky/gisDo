//var calDate = new Date(opener.initialBOTYear, opener.initialBOTMonth , opener.initialBOTDay);
var elementName;
var calDate; 
var selectedDate;
var currentDate;
var minShowDate;
var maxShowDate;
function dateLimitInit(name)
	{
	elementName = name;
	var selectDay = opener.document.getElementById(elementName + '_date').value;
	var selectMonth = opener.document.getElementById(elementName + '_month').value-1;
	var selectYear = opener.document.getElementById(elementName + '_year').value;

	calDate = new Date(selectYear, selectMonth , selectDay);
	selectedDate = new Date(selectYear , selectMonth , selectDay);
	
	var currentDateOpener = opener.document.getElementById('curDate_' + elementName).value;
	currentDate = new Date(eval(currentDateOpener));
	
	var maxShowOpener = opener.document.getElementById('maxShow_' + elementName).value;
	maxShowDate = new Date(eval(maxShowOpener));
	
	var minShowDateOpener = opener.document.getElementById('minShow_' + elementName).value;
	minShowDate = new Date(eval(minShowDateOpener)/*-172800000*/);
	
//	alert(currentDate +' - ' +  minShowDate  + ' - ' + maxShowDate );
	}
function drawCalendar() 
	{
	document.body.innerHTML = createCalendar();
	}
function createCalendar() {
	var currentYear = calDate.getFullYear();
	var monthNum = calDate.getMonth();

	var calendar = '';
	calendar += '<table border="0" cellpadding="0" cellspacing="0" width="209">';
	calendar += '<tr bgcolor="#7DBB12">';
	if (monthNum == minShowDate.getMonth() && currentYear == minShowDate.getFullYear()) {
		calendar += '<td align="right" class="textHidden">&laquo;</td>';
	} else 
	{
		calendar += '<td align="right"><span onMouseMove = "this.style.cursor=\'hand\'; return false;" onClick="reDrawCalendar(-1);" class="linkYear">&laquo;</span></td>';
	}
	calendar += '<td align="center" class="headYear">';
	calendar += currentYear;
	calendar += '</td>';
	if (!(monthNum == maxShowDate.getMonth() && currentYear == maxShowDate.getFullYear())) 
	{
		calendar += '<td><span onMouseMove = "this.style.cursor=\'hand\'; return false;" onClick="reDrawCalendar(1);" class="linkYear">&raquo;</span></td>';
	} else {
		calendar += '<td class="textHidden">&raquo;</td>';
	}
	calendar += '</tr>';
	calendar += '<tr><td colspan="3" align="center" class="headMonth">';
	calendar += monthNames[monthNum];
	calendar += '</td></tr>';
	calendar += '</table>';
	calendar += '<table border="0" cellpadding="1" cellspacing="1" width="209">';
	calendar += '<tr align="center" bgcolor="#7DBB12">';
	for (var i = 0; i < daysInWeeks.length; i++) {
		calendar += '<td class="headDay">';
		calendar += daysInWeeks[i];
		calendar += '</td>';
	}
	calendar += '</tr>';
	var startDay = (new Date(currentYear, monthNum, 1 - daysShift)).getDay();
	var dayOfMonth = 0;
	var layerNum = 0;
	var daysCount = getDaysInMonth(monthNum, currentYear);
	for (var j = 0; j < 6; j++) {
		if (j == 0 || j == 2 || j == 4) {
			calendar += '<tr align="center" bgcolor="#EBF3DE">';
		} else {
			calendar += '<tr align="center" bgcolor="#CAE4A1">';
		}
		for (var k = 0; k < 7; k++) {
			if ((j == 0 && k < startDay) || (dayOfMonth == daysCount)) 
				{
				calendar += '<td class="textDay">&nbsp;';
				} 
			else 
				{
//				alert(currentDate + ' ' + selectedDate);
				if( ((dayOfMonth == selectedDate.getDate() - 1 )||(dayOfMonth == currentDate.getDate() - 1)) &&(selectedDate.getDate() == currentDate.getDate()  && selectedDate.getMonth() == currentDate.getMonth() && currentDate.getFullYear() == currentDate.getFullYear())) 
					{
					calendar += '<td class="textDayOn">';
					}
				else
					{
					if (dayOfMonth == currentDate.getDate() - 1 && monthNum == currentDate.getMonth() && currentYear == currentDate.getFullYear()) 
						{
						calendar += '<td class="textDaySel">';
						} 
					else 
						{
						if (dayOfMonth == selectedDate.getDate() - 1 && monthNum == selectedDate.getMonth() && currentYear == selectedDate.getFullYear()) 
							{
//						alert('!!');
							calendar += '<td class="textDayOn">';
							}
						else
							{
							calendar += '<td class="textDay">';
							}
						}
					}
				if (dayOfMonth < (minShowDate.getDate() - 1) && monthNum == minShowDate.getMonth() && currentYear == minShowDate.getFullYear()) 
					{
					calendar += (++dayOfMonth);
					} 
				else if (dayOfMonth > (maxShowDate.getDate() - 1) && monthNum == maxShowDate.getMonth() && currentYear == maxShowDate.getFullYear()) 
					{
					calendar += (++dayOfMonth);
					}
				else 
					{
					if (dayOfMonth == (currentDate.getDate() - 1) && monthNum == currentDate.getMonth() && currentYear == currentDate.getFullYear()) 
						{
						calendar += '<a class="linkDayOn"';
						} 
					else 
						{
						calendar += '<a class="linkDay"';
						}
					var thisDate = new Date(currentYear, monthNum, dayOfMonth + 1);
//					if (thisDate.getTime() >= currentDate.getTime()) 
//					if ((thisDate.getTime() >= minShowDate.getTime()) && (thisDate.getTime() <= maxShowDate.getTime()) ) 
//					if ((dayOfMonth >= (minShowDate.getDate() - 1) && dayOfMonth <= (maxShowDate.getDate() - 1))/* && monthNum == maxShowDate.getMonth() && currentYear == maxShowDate.getFullYear()*/) 
//						{
//						alert (minShowDate + ' - ' + maxShowDate + ' - ' + currentYear + ' - ' +  monthNum + ' - ' +  dayOfMonth);
//						alert(dayOfMonth  + ' ' +  monthNum + ' ' +  currentYear + ' ' +  thisDate.getTime() + ' ' + currentDate.getTime());
						calendar += ' href="javascript:dateClick(\'' + currentYear + '\',\'' + eval(monthNum+1) + '\',\'' + (dayOfMonth + 1) + '\')"';
//						}
					calendar += '>';
					calendar += (++dayOfMonth);
					calendar += '</a>';
					}
				layerNum++;
				}
			calendar += '</td>';
		}
		calendar += '</tr>';
	}
	calendar += '</table>';
	/*if (is_ie) */calendar += '<br /></body></html>';
//	alert (calendar);
	return calendar;
}
function reDrawCalendar(direction) 
	{
	if (calDate.getMonth() == 0 && direction == -1) 
		{
			calDate.setFullYear(calDate.getFullYear() - 1);
			calDate.setMonth(11);
		} 
	else if (calDate.getMonth() == 11 && direction == 1) 
		{		
		calDate.setFullYear(calDate.getFullYear() + 1);
		calDate.setMonth(0);
		} 
	else 
		{
		calDate.setDate(28);
		// added to prevent transfer to next month
		calDate.setMonth(calDate.getMonth() + direction);
		}
	if (currentDate.getFullYear() == calDate.getFullYear() || (currentDate.getFullYear() - 1) == calDate.getFullYear()) 
		{
		drawCalendar();
		} 
	else 
		{
		if (direction == -1) reDrawCalendar(1);
		if (direction == 1) reDrawCalendar(-1);
		}
}
function dateClick(year, month, day) 
	{

	opener.document.getElementById(elementName + '_date').value = day;
	opener.document.getElementById(elementName + '_month').value = month;
	opener.document.getElementById(elementName + '_year').value = year;
	window.close();
	}
var daysInMonthes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
function getDaysInMonth(month, year) {
	if (month == 1) {
		return year % 4 ? 28 : 29;
	}
	return daysInMonthes [month];
}
