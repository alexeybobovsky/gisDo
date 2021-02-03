function autoClick(value)
	{
	if(value.indexOf('cat_')<0)
		objClick(value);
	else
		{
		var id = GetStrPrt(value, '_', 1);
		document.getElementById('CATEGORY').value = id;
		showLayerObjects(document.getElementById('CATEGORY'));
		}
	}
function showLayerObjects(select)
	{
	var result = document.getElementById('result');
	var resultImg = document.getElementById('resultImg');
//	alert(select.value);
	if(select.value>0)
		{
		var placeholder = document.getElementById('placeholder');
//		alert(placeholder);
		$(placeholder).animate( { opacity: 0.2 }, 10 , function() { } );
		resultImg.src = loadImg.src;		
		result.innerHTML = '';
		deselectAll();
		$.post("/spddl/", {type:'marketLayer', market:market, layer:select.value}, function(str) 
			{	
			var strTmp = GetStrPrt(GetStrPrt(str, '#getmeStart#', 1), '#getmeEnd#', 0);
			var strArr = strTmp.split('__');
//			alert(strArr);
			for(var i=0; i<strArr.length;  i++ )
				{
				selectOne(strArr[i]);
				}			
			$(placeholder).animate( { opacity: 1.0 }, 500 );
			result.innerHTML = str;
			resultImg.src = emptyImg.src;
			select.blur();
			select.value = 0;
			});
		}
	}
function objClick(obj)
	{
	if((obj)&&(document.getElementById(obj.id)))
		var id = GetStrPrt(obj.id, '_', 1);
	else if ((obj)&&(!document.getElementById(obj.id)))
		var id = obj;		
	else
		var id=false;
//	alert(obj.id);
	if(id)
		{
//		alert(id);
//		var id = GetStrPrt(obj.id, '_', 1);
		var result = document.getElementById('result');
		var resultImg = document.getElementById('resultImg');
		resultImg.src = loadImg.src;
		result.innerHTML = '';
		$.post("/spddl/", {type:'marketPav', market:market, obj:id}, function(str) 
			{	
//			alert(str);
			result.innerHTML = str;
			resultImg.src = emptyImg.src;
			});
		deselectAll();
		selectOne(id);
		}
	}
function selectOne(id)
	{
	if (scriptType == 'fast')
		{
		var img = document.getElementById('img_'+id);
		if(img)
			{
			img.src = srcToImg + id + '.gif';
			}
		}
	else if(scriptType == 'pre')
		{
		if(typeof(pic[id])!='undefined')
				{
				var img = document.getElementById('img_'+id);
				if(img)
					img.src = pic[id].src;	
				}
		}
	else if(scriptType == 'clever')
		{
		var obj = document.getElementById('id_'+id);		
		if(obj)
			{
			if(typeof(pic[id])!='undefined')
				{
				var img = document.getElementById('img_'+id);
				if(img)
					img.src = pic[id].src;	
				}
			else
				{
//			obj.className = 'id' + id;
				obj.className = 'id' + id + ' id' + id + 'hl';
//			alert(obj.className);	
				}
			}
		}
	}
function deselectAll()
	{
	var divCol = document.getElementsByTagName('div');	
//	alert(divCol.length);
	for(var i=0; i<divCol.length;  i++ )
		{
		if(divCol[i].id.indexOf('id_') >= 0)
			{
			var id = GetStrPrt(divCol[i].id, '_', 1);
//			document.images[i].src = emptyImg.src; //srcToImg + '_.gif';
			if(typeof(pic[id])!='undefined')
				{
				var img = document.getElementById('img_'+id);
				if(img)
					img.src = emptyImg.src;	
				}
			else
				{
				divCol[i].className = 'id' + id;			
				}
			}		
		}
//	alert(document.childNodes);
	}
