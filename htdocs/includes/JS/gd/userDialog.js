function dialog(messageContaner, messageBodyContaner,  messageConfirm, waitContaner) //поля метки для объекта
	{
	this.messageBodyContaner = messageBodyContaner;
	this.massageBox = messageContaner;
	this.messageConfirm = messageConfirm;
	this.waitBox = waitContaner;	
	this.message = '';
	this.type = '';
	this.waitShow = false;
	this.showModal = false;
	this.keypressed = function (e) 
		{
//		alert(e.which);
		}
	this.lockScreen = function () 
		{
		if (this.showModal == false)
			{
			this.showModal = true;
			var cssObj = {
				'display' : '',
				'height' : $(document).height(),
				'opacity' : '0.2'};
			$("#lockingPad").css(cssObj);
			}
		else
			{
			this.showModal = false;
			var cssObj = {
				'display' : 'none'};
			$("#lockingPad").css(cssObj);
			}		
		}
	this.showMessage = function (type, message) 
		{
		this.type = type;
		this.message = message;
		document.getElementById(this.messageBodyContaner).innerHTML = this.message;
		document.getElementById(this.massageBox).style.display = '';
		toCenter(this.massageBox);	
		this.lockScreen();
		$("#" + this.messageConfirm).focus();
		}
	this.closeMessage = function (element) 
		{
		element.parentNode.style.display='none';
		this.lockScreen();		
		}
	this.pleaseWait = function() 
		{
/*		alert(document.getElementById(this.waitBox).style.display);
//			document.getElementById(this.waitBox).style.display = '';*/
		if (this.waitShow == false)
			{
			this.waitShow = true;
//			toCenter(this.waitBox);
			document.getElementById(this.waitBox).style.display = '';
			}
		else
			{
			this.waitShow = false;
			document.getElementById(this.waitBox).style.display = 'none';
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
	}
function toCenterElement(objId, element)
	{
	var container = document.getElementById(objId);	
	var innerHeight_ = element.offsetHeight;
	container.style.left = 	( document.body.clientWidth / 2 - container.clientWidth / 2  + document.body.scrollLeft) + 'px';
	container.style.top = 	( document.documentElement.scrollTop + innerHeight_ / 2 - container.clientHeight / 2 + document.body.scrollTop) + 'px';
	}
