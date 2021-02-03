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
	
	this.lockingPadName = 			'lockingPad';

	this.panelActiveButtonName;
//	this.panelActiveButtonClassName = '';
	this.panelName = '';
	this.panelVisible = false;
	this.modal = false;
	this.fancyboxActive = false;
	this.displayedPanel;

	this.menuPanelVisible = false;
	this.layerPadVisible = false;
	this.layerPadButton;
	
	this.keep = false;
	this.resetDetailSearch =  function()
		{
		$('#detailAdrContaner').hide();
		$('#detailAdrSearchLabel').hide();
		$('#detailAdrSearchContaner').hide();
		$('#detailAdrSearchRenew').hide();
		$('#detailAdrSearchToggle').show();		
		}
	this.readyToDetailSearch =  function()
		{
		$('#detailAdrContaner').show();
		$('#detailAdrSearchLabel').hide();
		$('#detailAdrSearchContaner').hide();
		$('#detailAdrSearchRenew').hide();
		$('#detailAdrSearchToggle').show();		
		}
		
	this.setPanel = function()
		{
		$('#accList').css('height',  $('#mapid').height()-50);
		$('.accContent').css('height',  $('#accList').innerHeight() - (39 * $('.accHeader').length));
		$('.accHeader').addClass('hDsbl');
		$('.accHIcon').addClass('accHIconDsbl');
		$('.accContent').hide();
		
		$('.accHeader:first').addClass('hEnbl');
		$('.accHeader:first').removeClass('hDsbl');
		$('.accHIcon:first').addClass('accHIconEnbl');
		$('.accHIcon:first').removeClass('accHIconDsbl');
		$('.accContent:first').show();
		
		$('.accHeader').bind("click", 	function (event) {
			if(event.currentTarget.id.indexOf('Header')>=0)
				{
				if($('#' + event.currentTarget.id).hasClass('hDsbl'))
					{
					$('.accHeader').removeClass('hEnbl');
					$('.accHeader').addClass('hDsbl');
					$('.accHIcon').removeClass('accHIconEnbl');
					$('.accHIcon').addClass('accHIconDsbl');
					$('.accContent').slideUp("fast");;
					
					$('#' + event.currentTarget.id).addClass('hEnbl');
					$('#' + event.currentTarget.id).removeClass('hDsbl');
					$('#' + event.currentTarget.id + ' .accHIcon').addClass('accHIconEnbl');
					$('#' + event.currentTarget.id + ' .accHIcon').removeClass('accHIconDsbl');
					$('#' + ROUT.GetStrPrt(event.currentTarget.id, 'Header', 0) + 'Contaner').slideToggle("fast");
		
					}
				}
				
			});
		this.resetDetailSearch();
		$('#detailAdrSearchToggle').bind("click", 	function (event) {
			$('#detailAdrSearchContaner').show();
			$('#detailAdrSearchToggle').hide();			
			$('#detailAdrSearchLabel').html('');
			$('#detailAdrSearchLabel').hide();
			});
		$('#detailAdrSearchSubmit').bind("click", 	function (event) {
			UI.pleaseWait();
			GIS.geoKoderOSM($('#detailAdrSearchInput').val());
			});
		$('#detailAdrSearchRenew').bind("click", 	function (event) {
			$('#detailAdrSearchContaner').show();
			$('#detailAdrSearchToggle').hide();			
			$('#detailAdrSearchRenew').hide();			
			$('#detailAdrSearchLabel').html('');
			$('#detailAdrSearchLabel').hide();
			});
		}

	this.toggleSearchBar = function(id)
		{
/*		$('#searchCity').toggleClass('pushed');
		$('#menuListContaner').css({'top' : '32px'});*/
		$('#' + id).slideToggle("fast");
		}

	this.menuToggle = function(index)
		{
		$('#show_accList').toggleClass('pushed');
		$('#menuListContaner').css({'top' : '32px'});
		$('#menuListContaner').slideToggle("fast");
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
	this.apTogglePanel = function (obj, contanerName, liPos)  
		{
		if((this.panelVisible == false)&&(contanerName != ''))
			{
			var left, top, width, height, lockingPadCSS;
			this.panelActiveButton = obj.id;
			var position = this.getOffset(obj);			
			this.panelName = contanerName;
			this.keep = true;			

			width = 	$("#" + contanerName).width()
			height = 	$("#" + contanerName).height()
			left = 	position.left-13;
			top = 	position.top  - (6 + 23*liPos);
			var cssPanel = {'top' : top, 'left' : left, 'display':'block'};
			this.panelVisible = true;
			$("#" + this.panelName).show(100);
			$("#" + this.panelName).css(cssPanel);
			$(document).bind("click", this.apClosePanel);
			$(document).bind("keydown", this.apEscapePanel);

			$("#" + this.panelName).bind("click", this.apKeep);	
			$("#" + this.panelName).bind("click", this.Keep);	
			
			}
		else
			{
			var obj = $('#'+ this.panelActiveButton);
			$("#" + this.panelName).hide(100);
			this.panelVisible = false;
			$(document).unbind("click", this.apClosePanel);
			$(document).unbind("keydown", this.apEscapePanel);
			$("#" + this.panelName).unbind("click", this.apKeep);
			this.panelName = '';
			this.keep = false;	
			}
		}
	this.togglePanel = function (obj, contanerName, showModal, /*activatedClassName*/ userFunction)  
		{
		if(this.panelVisible == false)
			{
			var left, top, width, height, lockingPadCSS;
			if((!showModal)&&(obj != ''))
				{
				this.panelActiveButton = obj.id;
				var position = this.getOffset(obj);			
				}
			else
				{
				}
			this.panelName = contanerName;
			this.keep = true;			

			width = 	$("#" + this.panelName).width()
			height = 	$("#" + this.panelName).height()
			if((!showModal) && (window.position))
				{
				left = ( (position.left + width) > this.windowWidth ) ? this.windowWidth/2 - width/2 :  position.left;
				top = position.top + $(obj).height();
				}
			else if((!showModal) && (!window.position))
				{
				var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;				
				left = this.windowWidth/2 - width/2  + document.body.scrollLeft;
				top = document.documentElement.scrollTop + innerHeight_ / 2 - width/2 + document.body.scrollTop;					
				}
			else
				{
				var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;				
				left = this.windowWidth/2 - width/2  + document.body.scrollLeft;
				top = document.documentElement.scrollTop + innerHeight_ / 2 - height/2 + document.body.scrollTop;	
				lockingPadCSS =  {'display':'block', 'width':  this.windowWidth,  'height':  $(document).height()};
				$("#" + this.lockingPadName).css(lockingPadCSS);
				this.modal = true;
				$("#" + this.lockingPadName).click(this.Keep);	
				}
			var cssPanel = {'top' : top, 'left' : left, 'display':'block'};
			this.panelVisible = true;
			$("#" + this.panelName).show(100);
			$("#" + this.panelName).css(cssPanel);			
			$(document).bind("click", this.ClosePanel);
			$(document).bind("keydown", this.EscapePanel);
			$("#" + this.panelName).bind("click", this.Keep);	
			if(window.userFunction)
				userFunction();
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
/*			if(activatedClassName != '')
				$(obj).toggleClass(activatedClassName);*/
/*			document.onclick = null;
			document.onkeydown = null;*/
			$(document).unbind("click", this.ClosePanel);
			$(document).unbind("keydown", this.EscapePanel);
			$("#" + this.panelName).unbind("click", this.Keep);
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
//		var container = document.getElementById(objId);
//		console.log($('#'+ objId));
//		console.log(container);
//		var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;
/*		var left = 	( document.body.clientWidth / 2 - $('#'+ objId).outerWidth() / 2  + document.body.scrollLeft);
		var top = 	( document.documentElement.scrollTop + innerHeight_ / 2 - $('#'+ objId).$('#'+ objId).outerHeight() / 2 + document.body.scrollTop) ;*/
		
		var left = 	( this.documentWidth / 2 - $('#'+ objId).outerWidth() / 2  + $(document).scrollLeft());
		var top = 	( $(document).scrollTop() +  this.documentHeight / 2 - $('#'+ objId).outerHeight() / 2) ;
		$('#'+ objId).offset({top:top, left:left});
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
/*		alert('Keep');*/
		UI.keep = true;
		}
	this.apKeep = function (obj) 
		{
/*		alert('apKeep');*/
		UIap.keep = true;
		}
	this.apClosePanelTest  = function (event)
		{
		alert(event.data.msg);
		}
	this.apClosePanel  = function (event)
		{
		if (UIap.keep == true)
			{
			UIap.keep = false;
			return;
			}
		if(UIap.panelVisible == true)
			{
			if(!UIap.fancyboxActive)
				UIap.apTogglePanel(null);
			}
		else
			{
			var container = document.getElementById (UIap.panelName);
			if (!container) return;
			container.style.display = 'none';
			$(document).unbind("click", this.apClosePanel);
			$(document).unbind("keydown", this.apEscapePanel);

			}
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
//											dont remove - for library of good solutions!!!!			
/* 

			var keepVisible = 0;
			for(var k=0; k< event.target.classList.length; k++)   //Проверка на события с галереи
				{
				if(event.target.classList[k].indexOf('fancy')>=0)
					{
					keepVisible ++;
					}
				}
			if(!keepVisible)*/
//			alert(UI.fancyboxActive);
			if(!UI.fancyboxActive)
				UI.togglePanel(null);
			}
		else
			{
			var container = document.getElementById (UI.panelName);
			if (!container) return;
			container.style.display = 'none';
/*			document.onclick = null;
			document.onkeydown = null;*/
			$(document).unbind("click", this.ClosePanel);
			$(document).unbind("keydown", this.EscapePanel);
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
				if(!UI.fancyboxActive)
					UI.togglePanel(null);
				}
			else
				{			
				var container = document.getElementById (UI.panelName);
				if (!container) return;
				container.style.display = 'none';
/*				document.onclick = null;
				document.onkeydown = null;*/
				$(document).unbind("click", this.ClosePanel);
				$(document).unbind("keydown", this.EscapePanel);
				}
			}
		}	
	this.apEscapePanel = function(event)
		{
		if (window.event) event = window.event;
		var code = event.keyCode ? event.keyCode : event.which ? event.which : null;
		if (code == 27)
			{
			if(UIap.panelVisible == true)
				{
				if(!UIap.fancyboxActive)
					UIap.apTogglePanel(null);
				}
			else
				{			
				var container = document.getElementById (UIap.panelName);
				if (!container) return;
				container.style.display = 'none';
/*				document.onclick = null;
				document.onkeydown = null;*/
				$(document).unbind("click", this.apClosePanel);
				$(document).unbind("keydown", this.apEscapePanel);
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