/*
function galleryItemsInit(url, title) 
	{
	this.url = url;
	this.title = title;	
	}
*/	
function fancyBox() //поля метки для объекта
	{
	this.elemName;
	this.elemType;
/*	this.galleryItems = new Array(); 
	this.galleryIemsCnt = 0;*/
	
	this.create = function (elemName, elemType) 
		{
//		this.galleryItemsCreate();
		this.elemName = elemName;
		this.elemType = elemType;		
		if(elemType == 'gallery')
			{			
			$.fancybox.defaults.openEffect  = 'none' ;
			$.fancybox.defaults.closeEffect  = 'none' ;
			$.fancybox.defaults.wrapCSS  = 'fancybox-custom';
			$.fancybox.defaults.closeClick  = true;
			$.fancybox.defaults.helpers  = { title : {type : 'inside'}, overlay : {css : {'background' : 'rgba(238,238,238,0.85)'}}, thumbs : { width: 50, height: 50}};
			$.fancybox.defaults.afterLoad  = function()				
					{
					$('.fancybox-skin').bind("mouseover", function() {$('.fancybox-close').css({'top' : '-4px', 'right' : '-4px'})}); 
					};
			}
		$(elemName).fancybox();		
		}
	}
