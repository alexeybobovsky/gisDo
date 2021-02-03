function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function showProperties1(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  var cnt = num = 0;
  for (var i in obj) { if (cnt >= 134 )result += i + " = " + obj[i] + "\n"; if (i == 'tagUrn') num = cnt; cnt ++;}
  
  return num + ': ' +result;
}
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function userInterface() //поля метки для объекта
	{	
	this.windowWidth; 
	this.windowHeight;
	this.documentWidth;
	this.documentHeight;
	
	this.waitShow = false;
	this.waitBox = 					'waitBox';	

//	this.mapMiniShow = false;
	this.mapPageTitle = 			'pageTitle';
	this.mapPageTitleMore = 		'pageTitleMore';
	
	this.mesContaner = 				'messageBox';
	this.mesHeader = 				'messageBoxHeader';
	this.mesBody = 					'mBody';
	this.mesConfirm = 				'mConfirm';
	this.mesAuthTextComment = 		'mBodyAuthComment';
	this.mesStr = '';
	this.mesType = '';
	
	this.lockingPadName = 'lockingPad';

	this.panelActiveButtonName;
//	this.panelActiveButtonClassName = '';
	this.panelName = '';
	this.panelVisible = false;
	this.modal = false;

	this.displayedPanel;

	this.menuPanelVisible = false;
	this.layerPadVisible = false;
	this.layerPadButton;
	
	this.keep = false;
	
	this.GetStrPrt = function(str, del, indx) 
		{
		strArr1 = str.split(del);
		var ret = strArr1[indx];
		return ret;		
		}		
	this.rand = function( min, max ) 
		{	
		if( max ) 
			{
			return Math.floor(Math.random() * (max - min + 1)) + min;
			} else {
			return Math.floor(Math.random() * (min + 1));
			}
		}
	
	this.getCorrectDeclensionRu = function(num, word_0, word_1, word_2)
		{
		if(num>1000)
			num -= 1000;
		else if (num>100)
			num -= 100;		
		if(num>10)
			{
			var tenSec, ret;
			tenSec = (Math.round(num/10 + 0.5) == Math.round(num/10)) ? Math.round(num/10)-1 : Math.round(num/10);
			if(((num>=10)&&(num<20))||(((num - (tenSec*10)) >=5 )||(num - (tenSec*10) ==0 )))
				ret = word_2;
			else if((num - (tenSec*10))>1)
				ret = word_1;
			else
				ret = word_0;
			}
		else
			{
			if((num >=5 )||(num ==0 ))
				ret = word_2;
			else if(num>1)
				ret = word_1;
			else
				ret = word_0;
			}
		return ret;
		}	
	this.map_changeTitle = function(type, title, num) 
		{
		var addCity = ' в Иркутске';
		var about =  (type == 'layer') ? 'Рубрика каталога' : 'Название организации';
		$("#" + this.mapPageTitle).html(title + ' ' + addCity);
		$("#" + this.mapPageTitle).attr('title',  about);
		if (num)
			$("#" + this.mapPageTitleMore).html('( ' + num  + ' ' + this.getCorrectDeclensionRu( num, 'объект', 'объекта', 'объектов') + ' )');
		else
			$("#" + this.mapPageTitleMore).html('');
		}
	this.pleaseWait = function() 
		{
		if (this.waitShow == false)
			{
			this.waitShow = true;
			$("#" + this.waitBox).css({'display' : 'block'});
			this.toCenter(this.waitBox);
			}
		else
			{
			this.waitShow = false;
			$("#" + this.waitBox).css({'display' : 'none'});
			}
		}
	this.showAuthMessage = function () 
		{
		$("#messageBox_title_text").html('Требуется авторизация');		
		$("h3.messageBox_title").addClass('typeError');		
		$("#" + this.mesAuthTextComment).css({'display' : 'block'});
		$("#" + this.mesBody).css({'display' : 'none'});
		this.togglePanel('', this.mesContaner, 1);
		$("#" + this.mesConfirm).focus();
		}
	this.showMessage = function (type, str) 
		{
		this.mesStr = 	str;
		this.mesType = 	type;
		var className;
		if (type == 'error') 	
			{
			className = 'typeError';
			$("#messageBox_title_text").html('Ошибка');
			}
		if (type == 'info') 	
			{
			className = 'typeInfo';			
			$("#messageBox_title_text").html('Информация');
			}
		$("#" + this.mesAuthTextComment).css({'display' : 'none'});
		$("#" + this.mesBody).css({'display' : 'block'});
		$("h3.messageBox_title").addClass(className);		
		$("#" + this.mesBody).html(this.mesStr);
		this.togglePanel('', this.mesContaner, 1);
		$("#" + this.mesConfirm).focus();
		}	
	this.closeMessage = function () 
		{
		$("h3.messageBox_title").removeClass('typeError');		
		$("h3.messageBox_title").removeClass('typeInfo');		
		this.togglePanel('', this.mesContaner, 0);		
		}
	this.setSize = function () 
		{
		this.windowWidth = $(window).width();
		this.windowHeight = $(window).height();				
		this.documentWidth = $(document).width();
		this.documentHeight = $(document).height();	
		}
	this.togglePanel = function (obj, contanerName, showModal, activatedClassName) 
		{
		if(this.panelVisible == false)
			{
			var left, top, width, height, lockingPadCSS;
			if(!showModal)
				{
				this.panelActiveButton = obj.id;
				var position = this.getOffset(obj);			
				}
			this.panelName = contanerName;
			this.keep = true;			

			width = 	$("#" + this.panelName).width()
			height = 	$("#" + this.panelName).height()
			if(!showModal)
				{
				left = ( (position.left + width) > this.windowWidth ) ? this.windowWidth/2 - width/2 :  position.left;
				top = position.top + $(obj).height();
				}
			else
				{
				var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;				
				left = this.windowWidth/2 - width/2  + document.body.scrollLeft;
				top = document.documentElement.scrollTop + innerHeight_ / 2 - width/2 + document.body.scrollTop;	
//				top = this.windowHeight/2 - height;	
				
				lockingPadCSS =  {'display':'block', 'width':  this.windowWidth,  'height':  this.documentHeight};
				$("#" + this.lockingPadName).css(lockingPadCSS);
				this.modal = true;
				$("#" + this.lockingPadName).click(this.Keep);	
				}
			var cssPanel = {'top' : top, 'left' : left, 'display':'block'};
			this.panelVisible = true;
			$("#" + this.panelName).show(100);
			$("#" + this.panelName).css(cssPanel);
			if(activatedClassName != '')
				$(obj).toggleClass(activatedClassName);
			document.onclick = 		this.ClosePanel;
			document.onkeydown = 	this.EscapePanel;
			$("#" + this.panelName).click(this.Keep);	
			}
		else
			{
/*			if(this.mapMiniShow == true)
				{
				miniMapDestroy();
				this.mapMiniShow == false;
				}*/
			var obj = $('#'+ this.panelActiveButton);
			$("#" + this.panelName).hide(100);
			this.panelVisible = false;
			if(activatedClassName != '')
				$(obj).toggleClass(activatedClassName);
			document.onclick = null;
			document.onkeydown = null;
			this.panelName = '';
			this.keep = false;	
			if (this.modal == true)
				{
				lockingPadCSS =  {'display':'none'};
				$("#" + this.lockingPadName).css(lockingPadCSS);
				this.modal = false;				
				}
			$("h3.messageBox_title").removeClass('typeError');
			$("h3.messageBox_title").removeClass('typeInfo');
			}
		}
		
	this.toCenter = function (objId) 
		{
		var container = document.getElementById(objId);
		var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;
		container.style.left = 	( document.body.clientWidth / 2 - container.clientWidth / 2  + document.body.scrollLeft) + 'px';
		container.style.top = 	( document.documentElement.scrollTop + innerHeight_ / 2 - container.clientHeight / 2 + document.body.scrollTop) + 'px';
		}
		
	this.toggleLockingPad = function () 
		{
		if(this.modal == false)
			{
			var lockingPadCSS =  {'display':'block', 'width':  this.windowWidth,  'height':  this.documentHeight};
			$("#" + this.lockingPadName).css(lockingPadCSS);
			this.modal = true;
			$("#" + this.lockingPadName).click(this.Keep);	
			}
		else
			{
			var lockingPadCSS =  {'display':'none'};
			$("#" + this.lockingPadName).css(lockingPadCSS);
			this.modal = false;				
			}
		}				
	this.toggleLayerPad = function (obj) 
		{
		if(this.layerPadVisible == false)
			{
			this.layerPadButton = obj.id;
			this.displayedPanel = 'catList';
			this.keep = true;			
			var position = this.getOffset(obj);
//			var top = position.top + $(obj).height();
			var left = 10;
			var cssLayerPad = {'top' : position.top + $(obj).height(), 'left' : position.left, 'display':''};
			this.layerPadVisible = true;
			$("#catList").show(100);
			$("#catList").css(cssLayerPad);
			$(obj).toggleClass('catScriptLinkActive');
			document.onclick = 		this.CloseDiv;
			document.onkeydown = 	this.EscapeDiv;
			$("#catList").click(this.Keep);			
			}
		else
			{
			var obj = $('#'+ this.layerPadButton);
			$("#catList").hide(100);
			this.layerPadVisible = false;
			$(obj).toggleClass('catScriptLinkActive');
			document.onclick = null;
			document.onkeydown = null;
			this.displayedPanel = '';
			this.keep = false;			
			}
//		$("#layerPad").css(cssLayerPad);	
		}
	this.getOffset = function (obj) 
		{
		if(document.getElementById(obj.id))
			{
			var elem = obj;
			}
		else
			{
			var elem = document.getElementById(obj);		
			}
		if (elem.getBoundingClientRect) 
			{
			// "правильный" вариант
			return getOffsetRect(elem);
			} 
		else 
			{
			// пусть работает хоть как-то
			return getOffsetSum(elem);
			}		
		}
		
/*******************************Manipulations****************************************/
	this.Keep = function (obj) 
		{
		UI.keep = true;
		}

	this.ClosePanel  = function (event)
		{
		if (UI.keep == true)
			{
			UI.keep = false;
			return;
			}
		if(UI.panelVisible == true)
			{
			UI.togglePanel(null);
			}
		else
			{
			var container = document.getElementById (UI.panelName);
			if (!container) return;
			container.style.display = 'none';
			document.onclick = null;
			document.onkeydown = null;
			}
		}

	this.EscapePanel = function(event)
		{
		if (window.event) event = window.event;
		var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
		if (code == 27)
			{
			if(UI.panelVisible == true)
				{
				UI.togglePanel(null);
				}
			else
				{			
				var container = document.getElementById (UI.panelName);
				if (!container) return;
				container.style.display = 'none';
				document.onclick = null;
				document.onkeydown = null;
				}
			}
		}	
	this.CloseDiv  = function (event)
		{
		if (UI.keep == true)
			{
			UI.keep = false;
			return;
			}
		if(UI.layerPadVisible == true)
			{
			UI.toggleLayerPad(null);
			}
		else
			{
			var container = document.getElementById (UI.displayedPanel);
			if (!container) return;
			container.style.display = 'none';
			document.onclick = null;
			document.onkeydown = null;
			}
		}

	this.EscapeDiv = function(event)
		{
		if (window.event) event = window.event;
		var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
		if (code == 27)
			{
			if(UI.layerPadVisible == true)
				{
				UI.toggleLayerPad(null);
				}
			else
				{			
				var container = document.getElementById (UI.displayedPanel);
				if (!container) return;
				container.style.display = 'none';
				document.onclick = null;
				document.onkeydown = null;
				}
			}
		}	
		
	}
function getOffsetSum(elem) 
	{
    var top=0, left=0
    while(elem) 
		{
        top = top + parseInt(elem.offsetTop)
        left = left + parseInt(elem.offsetLeft)
        elem = elem.offsetParent
		}
    return {top: top, left: left}
	}

function getOffsetRect(elem) 
	{
    var box = elem.getBoundingClientRect()
    var body = document.body
    var docElem = document.documentElement
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft
    var clientTop = docElem.clientTop || body.clientTop || 0
    var clientLeft = docElem.clientLeft || body.clientLeft || 0
    var top  = box.top +  scrollTop - clientTop
    var left = box.left + scrollLeft - clientLeft
    return { top: Math.round(top), left: Math.round(left) }
	}	