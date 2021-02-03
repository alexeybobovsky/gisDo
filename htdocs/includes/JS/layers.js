function setLayer(NAME, x, y, w, h, bw, bh)
	{
	this.name = NAME;
	this.left = x;
	this.top = y;
	this.left_start = x;
	this.top_start = y;
	this.border_w = bw;
	this.border_h = bh;
	this.width = w+bw;
	this.height = h+bh;
	}
function getLayer(name)
	{
	  if(eval('document.all.'+name)!=null)
		{
		var layer=eval('document.all.'+name);
		return layer;
		} 
	  else if(document.getElementById(name))
		{
		var layer=document.getElementById(name);
		return layer;		
		}		
	  else return null;
	}
function getLayerStyle(name)
	{
	 /* if(eval('document.all.'+name)!=null)
		{
		var layer=eval('document.all.'+name+'.style');
		return layer;
		} */
	  if(document.getElementsByName(name))
		{
		var layer=document.getElementsByName(name).style;
		return layer;
		} 
	  else if(document.getElementById(name))
		{
		var layer=document.getElementById(name).style;
		return layer;		
		}		
	  else return null;
	}
function createLayerStr(name,left,top,width,height,visible,borderw,style_add,content)
	{
	  return ('<div id="' + name + '" style="position:absolute; overflow:none; left:' 
	   + left + 'px; top:' + top + 'px; width:' + (width+2*borderw) + 'px; height:' 
	   + (height+2*borderw) + 'px;' +  (visible ? '' : ' display:none;') 
	   + style_add+ '">'+content+'</div>');
	}
function createLayer(name,left,top,width,height,visible,borderw,style_add,content)
	{
	  document.writeln(createLayerStr(name,left,top,width,height,visible,borderw,style_add,content));
	  clipLayer(name,0,0,width+2*borderw,height+2*borderw);
//	   alert(content);
	}	
function clipLayer(name,clipleft,cliptop,clipright,clipbottom)
	{
	  var layer=getLayerStyle(name);		
	  if(layer!=null)
		layer.clip='rect('+cliptop+' '+clipright+' '+clipbottom+' '+clipleft+')';
	}		
function moveLayer(id,x,y)
	{
//	alert(id + '-' +x+ '-' +y);
	  var layer=getLayerStyle(id);
	  if(layer!=null)
		{ 
		layer.left=x; layer.top=y; 
		}
	}
function hideLayer(name)
	{
	  var layer=getLayerStyle(name);		
	  if(layer!=null) layer.display="none";
	}
function showLayer(name)
	{
	  var layer=getLayerStyle(name);		
	  if(layer!=null) 
		{
		layer.display="";
		}
	}

/*function resizeLayer(id,w,h)
	{
	  var layer=getLayerStyle(id);
	  if(layer!=null)
		{ 
		layer.width=w; layer.height=h; 
		}
	}*/
function SetLayerRect(name,l,t,w,h)
	{
	  moveLayer(name,l,t);
	  resizeLayer(name,w,h);
	}
function resizeLayer(name,w,h)
	{
	var layer=getLayerStyle(name);		
	if(layer!=null)
		{
		layer.pixelWidth=w; layer.pixelHeight=h;
		clipLayer(name,0,0,w,h);
		}
	}
function MoveElementInCenterOfScreen(objWhat) /*02_06_2008 перемещение одного объекта в центр другого */
	{
	objWhat.style.left = screen.availWidth/2 - objWhat.style.pixelWidth/2;
	objWhat.style.top = screen.availHeight/2 - objWhat.style.pixelHeight/2;
	}
function MoveElementInCenterOfAnother(objWhat, objWhere) /*02_06_2008 перемещение одного объекта в центр другого */
	{
	objWhat.style.left = objWhere.style.pixelWidth/2 - objWhat.style.pixelWidth/2;
	objWhat.style.top = objWhere.style.pixelHeight/2 - objWhat.style.pixelHeight/2;
	}
	
/*	
function clearCoord()
	{
	tmpCoord.x = x;
	tmpCoord.y = y;
	}
function updateCoord(x, y)
	{
	tmpCoord.x = x;
	tmpCoord.y = y;
	}
	
function calculateObjPosition(name)
	{
	var layer=getLayer(name);		
	if(layer!=null)
		{
		for(i=layer, x=0, y=0; i; i = i.offsetParent) 
			{
			x += i.offsetLeft;
			y += i.offsetTop;
			}
		alert(x + ' ' + y);		
		updateCoord(x, y);
		}
	else
		{
		clearCoord();
		}
	return tmpCoord;
	}
*/	