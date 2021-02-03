	function getStreetList(startStr)
		{
		var cityLayer = getLayer('CITY');
		$.post("/spddl/", {str:startStr, type:'streets', city:cityLayer.value}, function(str) 
			{		
			if(str!='')
				{
				var layer = getLayer(Com_Set.name);
				var strArr = str.split('TABINDEX');
				strListMaxIndex = strArr.length-2;
				layer.innerHTML = str;
				showLayer(Com_Set.name);
				strListShowed =1;
				}
			else
				{
				clearStreetList();				
				}
			}
			);		
		}
	function streetListNav(obj)
		{
		if((window.event.keyCode)&&((window.event.keyCode==38)||(window.event.keyCode==40)||(window.event.keyCode==32)||(window.event.keyCode==13)||(window.event.keyCode==27)))
			{
			var keyCode = window.event.keyCode;
			var delim = '_'
			var curIndx = GetStrPrt(strListCurrent, delim, 1);
			var curPref = GetStrPrt(strListCurrent, delim, 0);
			var nextObjIndex = -1;
			if(keyCode == 38)
				{			
				nextObjIndex  = (curIndx>0 ? eval(curIndx)-1 : strListMaxIndex);
				}
			else if(keyCode == 40)
				{				
				nextObjIndex  = (curIndx == strListMaxIndex ? 0 : eval(curIndx)+1 );
				}
			else if((keyCode == 32)||(keyCode == 13))
				{
				selectStr(obj)				
				}
			else if(keyCode == 27)
				{
				cancelStr();
				}
			if(nextObjIndex>=0)
				{
				var newObj = getLayer(curPref + delim + nextObjIndex);
				highlightStreet(newObj);
				}
			}
		else if(obj.id != strListCurrent)
			{
			highlightStreet(obj);
			}
		}
	function cancelStr()
		{
		var editStreet = getLayer('street');
		editStreet.focus();
		window.event.cancelBubble = true;
		moveCaretToEnd(editStreet);
		clearStreetList();
		}
	function selectStr(obj)
		{
		var editStreet = getLayer('street');
		editStreet.value = obj.innerHTML;
		editStreet.focus();
		event.cancelBubble = true;
		moveCaretToEnd(editStreet);
		strListCurValue = editStreet.value;
		clearStreetList();
		}
	function highlightStreet(obj)
		{
		highlightObject(obj.id, 1);
		if(strListCurrent!='')
			highlightObject(strListCurrent, 0);
		strListCurrent = obj.id;
		obj.focus();
		}
	function clearStreetList()
		{
		hideLayer(Com_Set.name);
		highlightObject(strListCurrent, 0);
		strListShowed =0;
		strListCurrent = 0;
		}

	function showStreetList(cursel)
		{
		if(strListShowed ==1)
			{
			if((window.event.keyCode)&&((window.event.keyCode==38)||(window.event.keyCode==40)))
				{
				var keyCode = window.event.keyCode;
				var nextObjIndex = -1;
				if(keyCode == 38)
					{			
					nextObjIndex  = strListMaxIndex;
					}
				else if(keyCode == 40)
					{				
					nextObjIndex  = 0;
					}		
				if(nextObjIndex>=0)
					{
					var newObj = getLayer('str_' + nextObjIndex);
					highlightStreet(newObj);
					}		
				}
			else 
				{				
				getStreetList(cursel.value);
				}
			}
		else if((strListShowed ==0))
			{
			if(strListCurrent != '')
				{
				highlightObject(strListCurrent, 0);
				strListCurrent = '';
				}
			var layerWidth = cursel.offsetWidth;
			var layerHeight = 110;			
			var obj = cursel;
			for(i=obj, x=0, y=0; i; i = i.offsetParent) 
				{
				x += i.offsetLeft;
				y += i.offsetTop;
				}
			var posX = x + 4;
			var posY = y +cursel.offsetHeight;
			SetLayerRect(Com_Set.name, posX, posY, layerWidth, layerHeight);
			getStreetList(cursel.value);
			}
		}

	function moveCaretToStart(inputObject)
		{
		if (inputObject.createTextRange)
			{
			   var r = inputObject.createTextRange();
			   r.collapse(true);
			   r.select();
			 }
		}
	function moveCaretToEnd(inputObject)
		{
		if	(inputObject.createTextRange)
			{
		   var r = inputObject.createTextRange();
		   r.collapse(false);
		   r.select();
			}
		}
