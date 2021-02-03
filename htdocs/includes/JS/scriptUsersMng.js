/************************************************************COMPANY_CATALOGUE**************************************************************************/	
function check4NewPrice(form)
	{
	var cnt = 0;
	var code;
	var elCount = document.forms[form.name].elements.length;
	var actionBtn = document.getElementById('confirm');
	for (var i = 0; i < elCount; i++)
		{		
		if((document.forms[form.name].elements[i].type == 'text')&&(document.forms[form.name].elements[i].id.indexOf('priceNew_') >= 0))
			{
			code = GetStrPrt(document.forms[form.name].elements[i].id, '_', 1);			
			if((document.getElementById('priceOld_'+code))&&(document.getElementById('priceOld_'+code).value!=document.forms[form.name].elements[i].value))
				cnt ++;
			}
		}
	actionBtn.style.display = (cnt>0) ? '' :'none';	
	}
function modifyPriceContaner(object) //2010_02_03 подставление поля ввода вместо строки
	{
	var code = GetStrPrt(object.id, '_', 1);
	if(!document.getElementById('priceNew_'+code))
		{
		var oldValue = document.getElementById('priceOld_'+code);
		var oValue = document.createElement("INPUT");
		oValue.name = 'priceNew_'+code;
		oValue.type = 'text';
		oValue.id = 'priceNew_'+code;;
		oValue.value = oldValue.value;	
		oValue.onchange = function() {check4NewPrice(this.form)};
		oValue.onkeyup = function() {check4NewPrice(this.form)};
//	alert(oValue.id);
		object.innerHTML = '';
		object.appendChild(oValue);		
		}
//	alert(oldValue.value);	
	}
/************************************************************COMPANY_INFO**************************************************************************/	
/************************************************************COMPANY_INFO NEW 2010**************************************************************************/	
function showOfficeAdrYMEditBox(object)
	{
//	alert(history);
/*	var action =  document.getElementById('actionOfficeAdrYMEditBox').value;
	return GB_showFullScreen('Редактирование офиса ', action, function(){history.go(0);});	
	
*/	var node = GetStrPrt(object.id, '_', 1);
	var contaner = document.getElementById('contaner_' + node);
	var action =  document.getElementById('actionOfficeAdrYMEditBox').value +  node;
	return GB_showFullScreen('Изменение адреса', action, function(){ renewParBoxRenew(node, contaner); });	
	}

function showNewOfficeYMBox()
	{
//	alert(history);
	var action =  document.getElementById('actionOfficeNewYMBox').value;
	return GB_showFullScreen('Создание офиса ', action, function(){history.go(0);});	
	}

function showNewOfficeMarketBox()
	{
//	alert(history);
	var action =  document.getElementById('actionOfficeNewMarketBox').value;
	return GB_showFullScreen('Создание офиса ', action, function(){history.go(0);});	
	}



/************************************************************END COMPANY_INFO NEW 2010**************************************************************************/	
function setFuncStart(object)
	{
//	object.disabled = true;
	object.style.border = '0px';
	object.value = '...загрузка....';
	}	
function setFuncEnd(contaner, str)
	{
//	alert(str);
	$(contaner).fadeOut("fast", function(){
		contaner.innerHTML = str;
		} );
	$(contaner).fadeIn("fast", function(){});
	}
function renewInfoBox(contaner)
	{
//	alert(str);
	var node = document.getElementById('curNode').value;
	var action =  document.getElementById('actionInfoBoxRenew').value;
	setFuncStart(contaner)
	$.post(action, {node:node}, function(str) 
		{
		setFuncEnd(contaner, str)
		});			
	}
function renewParBoxRenew(node, contaner)
	{
//	var node = document.getElementById('curNode').value;
	var action =  document.getElementById('actionParBoxRenew').value;
//	alert(node + ' ' + action);
	setFuncStart(contaner)
	$.post(action, {node:node}, function(str) 
		{
		setFuncEnd(contaner, str)
		});			
	}
function renewManagersBox(node, contaner)
	{
//	var node = document.getElementById('curNode').value;
	var action =  document.getElementById('actionManagersBoxRenew').value;
//	alert(node + ' ' + action);
	setFuncStart(contaner)
	$.post(action, {node:node}, function(str) 
		{
		setFuncEnd(contaner, str)
		});			
	}
function renewLayerBox(node, contaner)
	{
//	var node = document.getElementById('curNode').value;
	var action =  document.getElementById('actionLayerBoxRenew').value;
//	alert(node + ' ' + action);
	setFuncStart(contaner)
	$.post(action, {node:node}, function(str) 
		{
		setFuncEnd(contaner, str)
		});			
	}
function showInfoBox(object)
	{
	var node = document.getElementById('curNode').value;
	var contaner = document.getElementById('DIV' + object.id);
	var action =  document.getElementById('actionInfoBox').value +  node;
	return GB_showFullScreen('Изменение информации', action, function(){ renewInfoBox(contaner); });	

	}
function showNewOfficeBox()
	{
//	alert(history);
	var action =  document.getElementById('actionOfficeNewBox').value;
	return GB_showFullScreen('Создание офиса ', action, function(){history.go(0);});	
	}
function showOfficeParamEditBox(object)
	{
	var node = GetStrPrt(object.id, '_', 1);
	var contaner = document.getElementById('contaner_' + node);
	var action =  document.getElementById('actionOfficeParBox').value +  node;
	return GB_showFullScreen('Изменение информации', action, function(){ renewParBoxRenew(node, contaner); });	
	}
function showOfficeLayersEditBox(object)
	{
	var node = GetStrPrt(object.id, '_', 1);
	var contaner = document.getElementById('layers_' + node);
	var action =  document.getElementById('actionOfficeLayerBox').value +  node;
	return GB_showFullScreen('Изменение видов деятельности', action, function(){ renewLayerBox(node, contaner); });	
	}
function showManagersEditBox()
	{
	var node = document.getElementById('curNode').value;
	var contaner = document.getElementById('managers');
	var action =  document.getElementById('actionManagersBox').value +  node;
	return GB_showFullScreen('Изменение списка менеджеров', action, function(){ renewManagersBox(node, contaner); });	
	}

function moveLayer(btn)
	{
	var srcLayers = document.getElementById("layerCur");
	var empty = true;
	for(i=0; i<srcLayers.options.length; i++)
		{
		if (srcLayers.options[i].selected== true)
			{
			layerNew.splice(layerNew.length , 0, srcLayers.options[i].value);//[layerCur.length] = srcLayers.options[i].value;
			for(k=0; k<layerCur.length; k++)
				{
				if(layerCur[k] == srcLayers.options[i].value)
					layerCur.splice(k ,1);
				}	
			empty = false;
			}
		}
	if(!empty)
		{
		createLayerBox();
		}
	else
		alert('Ничего не выбрано!')
/*	if (layerCur.length == 0)
		btn.disabled = true;*/
	}
function addLayer(btn)
	{
	var srcLayers = document.getElementById("layerAll");
	var empty = true;
	for(i=0; i<srcLayers.options.length; i++)
		{
		if (srcLayers.options[i].selected== true)
			{
			layerCur.splice(layerCur.length , 0, srcLayers.options[i].value);//[layerCur.length] = srcLayers.options[i].value;
			for(k=0; k<layerNew.length; k++)
				{
				if(layerNew[k] == srcLayers.options[i].value)
					layerNew.splice(k ,1);
				}			
			empty = false;
			}
		}
	if(!empty)
		{
		createLayerBox();
		}
	else
		alert('Ничего не выбрано!')
	}
function selectCurLayers()
	{
	var oName = document.getElementById("layerCur");
	var i;
	for(i=0; i<oName.options.length; i++)
		{
		oName.options[i].selected = true;
		}
	}
function createLayerBox()
	{
	var oName = document.getElementById("layerCur");
	if(layerCur)
		{
		while (oName.firstChild) {
		  oName.removeChild(oName.firstChild);
		}		
		for(i=0; i<layerCur.length; i++)
			{					
			if(layerCur[i]>0)
				{
				oOption = document.createElement("OPTION");
				oOption.value = layerCur[i];
				oOption.appendChild(document.createTextNode(layerAll[layerCur[i]]));
//				oOption.appendChild(document.createTextNode(layerCur[i]));
				oName.appendChild(oOption);
				}
			}
		}
	oName = document.getElementById("layerAll");
	if(layerNew)
		{
		while (oName.firstChild) {
		  oName.removeChild(oName.firstChild);
		}		
		for(i=0; i<layerNew.length; i++)
			{
			if(layerNew[i]>0)
				{
				oOption = document.createElement("OPTION");
				oOption.value = layerNew[i];
				oOption.appendChild(document.createTextNode(layerAll[layerNew[i]]));
//				oOption.appendChild(document.createTextNode(layerNew[i]));
				oName.appendChild(oOption);
				}
			}
		}
	}

	
function createMngBox()
	{
	var oName = document.getElementById("managers");
	if(mngId)
		{
		while (oName.firstChild) {
		  oName.removeChild(oName.firstChild);
		}		
		for(i=0; i<mngId.length; i++)
			{					
			if(mngId[i]>0)
				{
				oOption = document.createElement("OPTION");
				oOption.value = mngId[i];
				oOption.appendChild(document.createTextNode(mngValue[i]));
//				oOption.appendChild(document.createTextNode(layerCur[i]));
				oName.appendChild(oOption);
				}
			}
		}
	}
function addMng(btn)
	{
	var srcLayers = document.getElementById("users");
	var empty = true;
	var skip = false;
	for(i=0; i<srcLayers.options.length; i++)
		{
		if ((srcLayers.options[i].selected== true)&&(srcLayers.options[i].value))
			{
			for(k=0; k<mngId.length; k++)
				{
				if(mngId[k] == srcLayers.options[i].value)
					skip = true;
				}
			if(!skip)
				{
				mngId.splice(mngId.length , 0, srcLayers.options[i].value);
				mngValue.splice(mngValue.length , 0, srcLayers.options[i].text);
				}
			empty = false;
			}
		}
	if((!empty)&&(!skip))
		{
		createMngBox();
		}
	else if(empty)
		alert('Ничего не выбрано!')
	else if(skip)
		alert('Этот пользователь уже есть!')
	}
function moveMng(btn)
	{
	var srcLayers = document.getElementById("managers");
	var empty = true;
	for(i=0; i<srcLayers.options.length; i++)
		{
		if (srcLayers.options[i].selected== true)
			{
//			layerNew.splice(layerNew.length , 0, srcLayers.options[i].value);//[layerCur.length] = srcLayers.options[i].value;
			for(k=0; k<mngId.length; k++)
				{
				if(mngId[k] == srcLayers.options[i].value)
					{
					mngId.splice(k ,1);
					mngValue.splice(k ,1);
					}
				}	
			empty = false;
			}
		}
	if(!empty)
		{
		createMngBox();
		}
	else
		alert('Ничего не выбрано!')

	}
function selectCurManagers()
	{
	var oName = document.getElementById("managers");
	var i;
	for(i=0; i<oName.options.length; i++)
		{
		oName.options[i].selected = true;
		}	
	}