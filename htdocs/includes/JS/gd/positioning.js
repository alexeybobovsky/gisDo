/*************************всплывающие панели*********************/
var keep = false;
var displayedPanel;
function toggleAllSelects(show) 
	{
	if(window.navigator.userAgent.indexOf('MSIE')>0)
		{
		var divCol = document.getElementsByTagName('select');	
//	alert(divCol.length);
		for(var i=0; i<divCol.length;  i++ )
			{
			divCol[i].style.display = (show) ?  '' :  'none';
//		divCol[i].disabled = (show) ?  '' :  'true';
//			divCol[i].style.zIndex = (show) ?  '0' :  '-10';
			}
		}
	}
function offsetPosition(element) 
	{
    var offsetLeft = 0, offsetTop = 0;
    do {
        offsetLeft += element.offsetLeft;
        offsetTop  += element.offsetTop;
    } while (element = element.offsetParent);
    return [offsetLeft, offsetTop];
	}
function toggleElementSimple(objId) /*hide/show element*/
	{
	var container = document.getElementById (objId);
	if (container)
		{
		var display = container.style.display;
		if (display == 'none'/* || !display*/)
			{
			displayedPanel = objId;
			container.style.display = '';     // без jquery
			}
		else
			{
			container.style.display = 'none';     // без jquery
			}
		return false;
		}
	else return true;			
	}	
function toElementManual(obj, element, offsetX, offsetY)
	{
	var container = document.getElementById(element);	
//	var W = document.body.offsetWidth;
//	var H = document.body.offsetHeight;
	var L = offsetPosition(obj)[0];
	var T = offsetPosition(obj)[1];
	container.style.left = L + eval(offsetX) + 'px';
	container.style.top = T + eval(offsetY) + 'px';
	}
function toElement(obj, element)
	{
	var container = document.getElementById(element);	
//	var W = document.body.offsetWidth;
//	var H = document.body.offsetHeight;
	var L = offsetPosition(obj)[0];
	var T = offsetPosition(obj)[1];
	container.style.left = L + eval(10) + 'px';
	container.style.top = T + eval(0) + 'px';
	}
function toCenter(objId)
	{
	var container = document.getElementById(objId);
	var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;
	container.style.left = 	( document.body.clientWidth / 2 - container.clientWidth / 2  + document.body.scrollLeft) + 'px';
	container.style.top = 	( document.documentElement.scrollTop + innerHeight_ / 2 - container.clientHeight / 2 + document.body.scrollTop) + 'px';
/*	var W = document.body.offsetWidth;
	var H = document.body.offsetHeight;
	var L = W/2 - container.offsetWidth/2;
	var T = H/2 - container.offsetHeight/2;
	container.style.left = L +'px';
	container.style.top = T + 'px';*/
	}
function toggleDiv(objId) /*hide*/
	{
	var container = document.getElementById (objId);
	if (container)
	{
		var display = container.style.display;
		if (display == 'none' || !display)
			{
			toggleAllSelects(0);
			displayedPanel = objId;
			container.style.display = 'block';     // без jquery
//			$(container).fadeIn("fast");			

			keep = true;
			document.onclick = CloseDiv;
			document.onkeydown = EscapeDiv;
			container.onclick = Keep;

			}
		else
			{			
			toggleAllSelects(1);
			container.style.display = 'none';     // без jquery
//			$(container).fadeOut("fast");			
			}
		return false;
	}
	else return true;	
	}
function Keep()
{
	keep = true;
}

function CloseDiv (event)
{
	if (keep)
	{
		keep = false;
		return;
	}
	var container = document.getElementById (displayedPanel);
	if (!container) return;
//	toggleDiv(displayedPanel);
	toggleAllSelects(1);
	container.style.display = 'none';

	document.onclick = null;
	document.onkeydown = null;
}

function EscapeDiv (event)
{
	if (window.event) event = window.event;
	var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
	if (code == 27)
	{
		var container = document.getElementById (displayedPanel);
		if (!container) return;
		toggleAllSelects(1);
		container.style.display = 'none';
//		toggleDiv(displayedPanel);

		document.onclick = null;
		document.onkeydown = null;
	}
}