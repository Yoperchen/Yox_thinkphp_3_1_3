

var N = new Date();
Form = document.checkdate;

function initCalendar()
{
	Form = document.checkdate;
	Form.averagecyc.value = 28;
	Form.averagemenses.value = 5;
	Form.Year.value = N.getFullYear();
	Form.Month.value = N.getMonth() + 1;
	Form.Day.value = N.getDate();
	getCalendar(1,0);
	document.all.Calendar1.outerHTML = calendarStr;
	getCalendar(2,0);
	document.all.Calendar2.outerHTML = calendarStr;
	
}

function resetInput()
{
	Form.reset();
}

function getMonthDate(year,month)
{
	var monthDays = new Array(12);
	monthDays[0] = 31;
	monthDays[1] = 28;
	monthDays[2] = 31;
	monthDays[3] = 30;
	monthDays[4] = 31;
	monthDays[5] = 30;
	monthDays[6] = 31;
	monthDays[7] = 31;
	monthDays[8] = 30;
	monthDays[9] = 31;
	monthDays[10] = 30;
	monthDays[11] = 31;

	if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0))
	{
		monthDays[1] = 29;
	}
	
	return monthDays[month];
}

function showMsg(event,msg)
{
	if (document.getElementById("msgBox"))
	{
		msgBox = document.getElementById("msgBox");
		msgBox.innerHTML = msg;
		msgBox.style.display = "block";
		msgBox.style.left=event.clientX;
		msgBox.style.top=event.clientY  + 20;
	}
	else
	{
		var msgBox = document.createElement("div");
		msgBox.setAttribute("id", "msgBox");
		msgBox.style.display = "block";
		msgBox.innerHTML = msg;
		document.body.appendChild(msgBox);
		msgBox.style.left=event.clientX + document.body.scrollLeft - 20;
		msgBox.style.top=event.clientY + document.body.scrollTop + 20;
	}
}

function hideMsg()
{
	document.getElementById("msgBox").style.display = "none";
}

function getCalendar(calendarID,flag)
{
	calendarStr = "";		
	var currYear = Form.Year.value;
	var currMonth = parseInt(Form.Month.value) + calendarID - 1;
	if(currMonth > 12)
	{
		currYear = parseInt(Form.Year.value) + 1;
		currMonth = currMonth % 12;
	}
	
	calendarStr = calendarStr + "<table width='100%' border='0' cellspacing='0' cellpadding='2' class='box3' id='Calendar" + calendarID + "'>";
	calendarStr = calendarStr + "<tr bgcolor='#9FEF3F' align='center'><td colspan='7' class='bt'>" + currYear+' 年 ' + currMonth +' 月</td></tr>';
	calendarStr = calendarStr + "<tr><td align='center' bgcolor='#CCCCCC' class='bt'>日</td><td align='center' bgcolor='#CCCCCC' class='bt'>一</td><td align='center' bgcolor='#CCCCCC' class='bt'>二</td><td align='center' bgcolor='#CCCCCC' class='bt'>三</td><td align='center' bgcolor='#CCCCCC' class='bt'>四</td><td align='center' bgcolor='#CCCCCC' class='bt'>五</td><td align='center' bgcolor='#CCCCCC' class='bt'>六</td></tr>";
	calendarStr = calendarStr + "<tr>";

	var startDate = new Date(Date.UTC(Form.Year.value,parseInt(Form.Month.value)-2+calendarID,1));
	startDay = startDate.getDay();
	
	var Ln = 1;
  var Col = 0;
	for (i=0;i<startDay;i++)
	{
		calendarStr = calendarStr + "<td></td>";
		Col++;
	}

	var mensesDate = new Date(Date.UTC(Form.Year.value,parseInt(Form.Month.value)-1,Form.Day.value))	
	myMonthDate = getMonthDate(currYear,currMonth-1);
	
	for (i=1;i<=myMonthDate;i++)
	{
		var trBgcolor = "";
		if(Ln % 2 == 0)
		{
			trBgcolor = "#F7F7E6";
		}
		calendarStr = calendarStr + "<td align='center' class='bt' bgcolor=" + trBgcolor + ">";
		var color = "#019934";
		
		if(flag)
		{	
			var msgStr ="";
			var myDate = new Date(Date.UTC(currYear,currMonth-1,i));
			var myavgCyc = parseInt(Form.averagecyc.value);
			var myavgMenses = parseInt(Form.averagemenses.value);
			var myTime = Math.floor((myDate.getTime() - mensesDate.getTime()) / (24 * 60 * 60 * 1000));
			var someDate = (myTime % myavgCyc + myavgCyc) % myavgCyc;

			if (someDate>=0 && someDate<=(myavgMenses-1))
			{	color = "black";
				msgStr = "这是月经期，要注意经期卫生，避免性事！"
			}
			if (someDate>=myavgMenses && someDate<=(myavgCyc-20))
			{	color = "green";
				msgStr = "这是安全期，性事一般不会受孕，您放心吧！";	
			}
			if (someDate>=(myavgCyc-19) && someDate<=(myavgCyc-10))
			{	color = "red";
				msgStr = "这是危险期，亦称排卵期，性事受孕可能性大，千万要注意！";
			}
			if (someDate>=(myavgCyc-9) && someDate<=(myavgCyc-1))	
			{	color = "green";
				msgStr = "这是安全期，性事一般不会受孕，您放心吧！";	
			}
		
			msgID = 100 * calendarID + i;

			msgStr = "<font style=color:" + color + ";>" + msgStr + "</font>";
									
			calendarStr = calendarStr + "<a class=\"" + color + "\" href='#' onMouseOver=\"showMsg(event,'" + msgStr + "');\" onMouseOut=\"hideMsg()\">" + i + "</a></td>";
		}
		else
		{
			calendarStr = calendarStr + "<span class=\"" + color + "\">" + i + "</span></td>";
		}
		Col++;
		
		if (Col == 7)
		{
			calendarStr = calendarStr + "</tr><tr>"; 
			Col = 0;
			Ln++;
		}
	}
  
	var endDate = new Date(Date.UTC(Form.Year.value,(parseInt(Form.Month.value)-2+calendarID),myMonthDate));
	endDay = endDate.getDay();
	for (i=endDay;i<6;i++)
	{
		calendarStr = calendarStr + "<td></td>";
	}
	
	calendarStr = calendarStr + "</tr></table>";
}

function showCalendar()
{
	if(isNaN(Form.averagecyc.value) || Form.averagecyc.value.length == 0)
	{
		alert("请正确输入平均月经周期！");
		Form.averagecyc.focus();
		return false;
	}
	if(parseInt(Form.averagecyc.value) > 36 || parseInt(Form.averagecyc.value) < 23 )
	{
		alert("月经周期一般为26-35天。您的月经周期不在此范围，请注意调理。")
		Form.averagecyc.focus();
		return false;
	}
	if(isNaN(Form.averagemenses.value) || Form.averagemenses.value.length == 0)
	{
		alert("请正确输入平均行经期！");
		Form.averagemenses.focus();
		return false;
	}
	if(parseInt(Form.averagemenses.value) > 8 || parseInt(Form.averagemenses.value) < 3)
	{
		alert("行经期一般为3-8天。您的行经期不在此范围，请注意调理。")
		Form.averagemenses.focus();
		return false;
	}
	if (isNaN(Form.Year.value) || Form.Year.value < 1970)
	{
		alert("请正确输入年份！");
		Form.Year.focus();
		return false;
	}
	if (isNaN(Form.Month.value) || Form.Month.value < 1 || Form.Month.value > 12)
	{
		alert("请正确输入月份！")
		Form.Month.focus();
		return false;
	}
	if (isNaN(Form.Day.value) || Form.Day.value < 1 || Form.Day.value > myMonthDate)
	{
		alert("请正确输入日子！")
		Form.Day.focus();
		return false;
	}
	var mensesDate = new Date(Date.UTC(Form.Year.value,(parseInt(Form.Month.value)-1),Form.Day.value))	
	if ((N.getTime() - mensesDate.getTime()) < 0)
	{
		alert("请正确输入上次月经时间！")
		Form.Year.focus();
		return false;
	}	

	getCalendar(1,1);
	document.all.Calendar1.outerHTML = calendarStr;
	getCalendar(2,1);
	document.all.Calendar2.outerHTML = calendarStr;	
}
initCalendar();