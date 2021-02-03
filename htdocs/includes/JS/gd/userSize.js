function sizing() //поля метки для объекта
	{	
	this.windowWidth;
	this.windowHeight;
	this.documentWidth;
	this.documentHeight;
	this.layerPadFullHeight;
	this.layerPadFullTop;
	this.layerPadMinHeight = 45;
	this.layerPadMinTop;
	this.layerPadMinimized;
	this.catLabelWidth = 0;
	this.orgLabelWidth = 0;
	this.catLabelActive = false;
	this.setSize = function () 
		{
		this.windowWidth = $(window).width();
		this.windowHeight = $(window).height();				
		this.documentWidth = $(document).width();
		this.documentHeight = $(document).height();
		this.layerPadMinimized = true;
		if(this.catLabelWidth == 0)
			this.catLabelWidth = $("#catLabel").width();
		this.orgLabelWidth = this.windowWidth - this.catLabelWidth - 25;
		this.layerPadMinTop = this.windowHeight - this.layerPadMinHeight - 30;
		this.layerPadFullHeight = parseInt(this.windowHeight * 0.45);
		this.layerPadFullTop = this.windowHeight - (this.layerPadMinHeight + 30 + this.layerPadFullHeight);
		
		var heightLayerPad = 	this.layerPadMinHeight, 
			heightSearchPad = 	55, 
			heightMapContaner = this.windowHeight - 45 - 60 - 30; 
		var cssSearchPad = 		{'width' : this.windowWidth};
		var cssSearchPadStr = 	{'width' : this.windowWidth-16};
		var cssSearchStrCont = 	{'width' : this.windowWidth-14};
		
		var cssLayerPad = 		{'top' : this.layerPadMinTop, 'height' : heightLayerPad, 'overflow': 'hidden'};

		var cssMapContaner = 	{'top' : heightSearchPad + 1 , /*'bottom' : this.documentHeight - heightLayerPad, */'height' : heightMapContaner};
		
		
		$("#searchPad").css(cssSearchPad);
		$("#searchStrCont").css(cssSearchStrCont);
		$("#searchStr").css(cssSearchPadStr);
		
		$("#layerPad").css(cssLayerPad);
		$("#mapContaner").css(cssMapContaner);
		
		$("#orgLabel").css({'width':this.orgLabelWidth});
//		alert(this.documentWidth-20);
		}
/*******************************Manipulations****************************************/
	this.toggleLayerPad = function(/*obj*/) 
		{
		var H = (this.layerPadMinimized == true) ? this.layerPadFullHeight : this.layerPadMinHeight;
		var T = (this.layerPadMinimized == true) ? this.layerPadFullTop +this.layerPadMinHeight: this.layerPadMinTop;
		var animateCss1, animateCss2, cssLayerPad;
//		alert (H + ' , ' + T);
//		var strObj;
		if(this.layerPadMinimized == true)
			{
			this.layerPadMinimized = false;			
			animateCss1 = {'height':H+30, 'top' :T-30};
			cssLayerPad = {'overflow': 'auto'};
			}
		else
			{
			this.layerPadMinimized = true;			
			animateCss1 = {'height':H-20, 'top' :T+20};
			cssLayerPad = {'overflow': 'hidden'};
			}
		animateCss2 = {'height':H, 'top' :T};
//		obj.innerHTML = strObj;	
//		$("#layerPad").animate(animateCss1, 500  , function(){ $("#layerPad").animate(animateCss2, 200, function(){$("#layerPad").css(cssLayerPad)} )} );
//		$("#layerPad").css(cssLayerPad, function(){ $("#layerPad").animate(animateCss1, 500  , function(){ $("#layerPad").animate(animateCss2, 200 )} )});
		$("#layerPad").css(cssLayerPad);
		$("#layerPad").animate(animateCss1, 500  , function(){ $("#layerPad").animate(animateCss2, 200 )} );
//		$("#layerPad").css(cssLayerPad, function(){ $("#layerPad").animate(animateCss1, 500  , function(){ $("#layerPad").animate(animateCss2, 200 )} )});
		
		}
	this.labelOrgActivate = function(title) 
		{
		if(this.layerPadMinimized == false)
			this.toggleLayerPad();
		var layerPadTopWidth = 	$("#layerTop").width();
				
		$("#orgLabel").text(title);
		$("#orgLabel").css({'width' :'auto'});
		
		var labelOrgWidth = 	$("#orgLabel").width();	

		var animateLayerCss1, animateLayerCss2;
		if(this.catLabelActive == true)
			{
			$("#catLabel").attr('title', 'Выбрать рубрику');
			$("#catLabel").text('');
			$("#catLabel").text('Рубрики каталога');
			$("#catLabel").css({'color' :'#666666'/*, 'width' :'auto'*/});
			$("#catLabel").css({'width' :this.catLabelWidth});
			var labelLayerWidth = 	this.catLabelWidth;
			
			this.catLabelActive = false;	
			animateLayerCss1 = 	{'left': layerPadTopWidth - labelLayerWidth, 'right' :24};
			animateLayerCss2 = 	{'right' :12};
			$("#catLabel").animate(animateLayerCss1, 500  , function(){ $("#catLabel").animate(animateLayerCss2, 600 )} );
			}
		}	
	this.labelCatActivate = function(title, num) 
		{
		if(this.layerPadMinimized == false)
			this.toggleLayerPad();
		var layerPadTopWidth = 	$("#layerTop").width();
		var labelLayerWidth = 	layerPadTopWidth-50;
		$("#catLabel").width(layerPadTopWidth-50);
		$("#catLabel").text(' ' + title + ' (' + num + ')');
		var animateLayerCss1, animateLayerCss2;
		if(this.catLabelActive == false)
			{
			$("#catLabel").attr('title', 'Изменить рубрику');
			this.catLabelActive = true;	
			$("#orgLabel").text('');
			$("#catLabel").css({'color' :'#CC0000'});
			animateLayerCss1 = 	{'right':layerPadTopWidth - labelLayerWidth, 'left' :24};
			animateLayerCss2 = 	{'left' :12, 'width' :labelLayerWidth};
			}
		$("#catLabel").animate(animateLayerCss1, 500  , function(){ $("#catLabel").animate(animateLayerCss2, 600 )} );
		}
	this.toggleLabels = function() 
		{
		var layerPadTopWidth = 	$("#layerTop").width();
		var labelLayerWidth = 	$("#catLabel").width();
		var labelOrgWidth = 	$("#orgLabel").width();
//		alert ('topWidth = ' + layerPadTopWidth + 'px; labelLayerWidth = '+ labelLayerWidth + 'px; labelOrgWidth = '+ labelLayerWidth);
		var animateLayerCss1, animateOrgCss1;
		if(this.catLabelActive == true)
			{
			this.catLabelActive = false;	
			$("#catLabel").text('Категории организаций');
			$("#orgLabel").css({'color' :'#CC0000'});
			$("#catLabel").css({'color' :'#666666'});

			animateLayerCss1 = 	{'left': layerPadTopWidth - labelLayerWidth, 'right' :12};
			animateOrgCss1 = 	{'right':layerPadTopWidth - labelOrgWidth, 'left' :24};

/*			animateLayerCss1 = 	{'left': 'auto', 'right' :12, 'color' :'#666'};
			animateOrgCss1 = 	{'right': 'auto' - labelOrgWidth, 'left' :24, 'color' :'#c00'};*/
			
			animateLayerCss2 = 	{'right' :2, 'width' :labelLayerWidth};
			animateOrgCss2 = 	{'left' :12, 'width' :labelOrgWidth};
			}
		else
			{
			this.catLabelActive = true;	
			$("#orgLabel").text('Название организации');
			$("#orgLabel").css({'color' :'#666666'});
			$("#catLabel").css({'color' :'#CC0000'});

			animateLayerCss1 = 	{'right':layerPadTopWidth - labelLayerWidth, 'left' :24};
			animateOrgCss1 = 	{'left':layerPadTopWidth - labelOrgWidth, 'right' :12};

/*			animateLayerCss1 = 	{'right':'auto', 'left' :24, 'color' :'CC0000'};
			animateOrgCss1 = 	{'left':'auto', 'right' :12, 'color' :'666666'};*/

			animateLayerCss2 = 	{'left' :12, 'width' :labelLayerWidth};
			animateOrgCss2 = 	{'right' :2, 'width' :labelOrgWidth};
			}
		$("#catLabel").animate(animateLayerCss1, 500  , function(){ $("#catLabel").animate(animateLayerCss2, 600 )} );
		$("#orgLabel").animate(animateOrgCss1, 500  , function(){ $("#orgLabel").animate(animateOrgCss2, 600 )} );
//		$("#layerPad").css(cssLayerPad, function(){ $("#layerPad").animate(animateCss1, 500  , function(){ $("#layerPad").animate(animateCss2, 200 )} )});	
		
		}
		
	}