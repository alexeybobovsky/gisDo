function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function sizing() //поля метки для объекта
	{	
	this.windowWidth; 
	this.windowHeight;
	this.documentWidth;
	this.documentHeight;
	this.layerPadVisible = false;
	
	this.setSize = function () 
		{
		this.windowWidth = $(window).width();
		this.windowHeight = $(window).height();				
		this.documentWidth = $(document).width();
		this.documentHeight = $(document).height();	
		}
	this.toggleLayerPad = function (obj) 
		{
		if(this.layerPadVisible == false)
			{			
			var position = this.getOffset(obj);
//			var top = position.top + $(obj).height();
			var left = 10;
			var cssLayerPad = {'top' : position.top + $(obj).height(), 'left' : position.left, 'display':''};
			this.layerPadVisible = true;
			$("#catList").show(100);
			$("#catList").css(cssLayerPad);
			$(obj).toggleClass('catScriptLinkActive');
			}
		else
			{
			$("#catList").hide(100);
			this.layerPadVisible = false;
			$(obj).toggleClass('catScriptLinkActive');
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