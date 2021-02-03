function showCamLink(objId)
	{
	toggleElementSimple(objId);
	var container = document.getElementById (objId);
	container.select();
	}
function startFlash(contaner, flashvars)
	{	
	var so = new SWFObject('/includes/jwplayer/player.swf','mpl','480','270','8');
	so.addParam('allowfullscreen','true');
	so.addParam('flashvars', flashvars);
	so.write(contaner);
	}
/*function showCamBox(id, name, action) 
	{
	var info = name;
	var url = action+id;
	return GB_showFullScreen(info, url, function(){});		
	}
	*/
function updateCam(objId) 
	{
	var curTime = new Date();
	if((document.getElementById('camWait_' + objId)!='undefined')&&(document.getElementById('camWait_' + objId)))
		{
		var camWait = document.getElementById('camWait_' + objId);
		camWait.src = emptyImg.src;
//		camWait.src = loadImg.src;
		}
	if((document.getElementById('camImg_' + objId)!='undefined')&&(document.getElementById('camImg_' + objId)))
		{
		var img = document.getElementById('camImg_' + objId);
		if(curCamSrc == '')
			curCamSrc = img.src;
		var camImgPreload = new Image(); 
		camImgPreload.src = curCamSrc + '&sec=' + curTime.getTime();
		camImgPreload.onload = function() 
			{
			if (img)
				{
				img.src = camImgPreload.src;
				}
			else
				{
				curCamSrc = '';
				}
			}; 
		}
	else
		{
		curCamSrc = '';
		}
	}
function clickSObj(obj) 
	{
//	var divCol = document.getElementsByTagName('div'); 
	var res = (obj.id) ? obj.id.split('_') : 0;
	var objPoint  = gCollection.filter(function (obj) 
		{
		return obj.obj_id == res[1];
		});
	if(objPoint[0])
		{
		map.panTo(objPoint[0].getCoordPoint(), {flying: 1, 
			callback: function () 
				{
				objPoint[0].openBalloon();
				}});
		}
	else
		{
		bounds 		= new YMaps.GeoCollectionBounds();			
		gCollection.removeAll();						
		showMarkers('obj_id', res[1]);						
		objPoint  = gCollection.filter(function (obj) 
			{
			return obj.obj_id == res[1]; 
			});
		objPoint[0].openBalloon();					
		}
	markSelections('obj', res[1]);
	}
function clickSLayer(obj, autoObj)
	{
	document.getElementById('selectedLayer').value = obj.id;
	var contaner = document.getElementById('objContaner');
	var imgWait = document.getElementById('resultImgLoad');	
	var title;
	title = obj.title;
	var layer_id = GetStrPrt(obj.id, '_', 1);
	if(layer_id==camLayerId)
		{
		curCamLayer = true;
//		traffic.hide();
		}
	else
		{
//		traffic.show();
		curCamLayer = false;		
		}
	document.getElementById('resultTitle').innerHTML = title;
	var spdlType = 'specLayerObjectsYMaps';
	var spdlLayer = layer_id;
//	var isMng = ((document.getElementById('layerAdd') != 'undefined')&&(document.getElementById('layerAdd') != 'null')) ? true : false;
	var isMng = (document.getElementById('layerAdd')) ? 1 : 0;
//	alert(document.getElementById('layerAdd'));
	gCollection.removeAll();						
	bounds 		= new YMaps.GeoCollectionBounds();			
	imgWait.src = loadImg.src;
	contaner.innerHTML = '';	
	point = new Array();	
	if(getActivePad()!= 'objList')
		togglePad();
	$.post("/spddl/", {type:spdlType, layer:spdlLayer, isMng:isMng}, function(str) 
		{
//		alert(str);
		var strTmp = GetStrPrt(GetStrPrt(str, '#getmeStart#', 1), '#getmeEnd#', 0);
		var strTmp0 = strTmp.split('%%');
		var strArr = strTmp0[1].split('~~');
		var valArr;		
		valArr = strTmp0[0].split('##');				
		var layerId = valArr[0];
		var layerAbout = valArr[1];
		var layerIcon = valArr[2];
		var curIcon;
		for(var i=0; i<strArr.length;  i++ )
			{
			if(strArr[i]!='')
				{				
				valArr = strArr[i].split('##');				
				curIcon = valArr[5];
				point[i] = new setSpecialPoint(valArr[0], valArr[2], valArr[3], 
																	valArr[4], 
																	curIcon, 
																	valArr[6], 
																	valArr[7], 
																	valArr[8], valArr[9], valArr[10], 
																	valArr[11], valArr[12], valArr[13], valArr[14], valArr[15]);																			
				}
			}
		showMarkers(0, 0);
		contaner.innerHTML = str;				
		document.getElementById('resultNum').innerHTML = 'Найдено объектов: ' + (strArr.length-1);
		$(contaner).slideDown(600, function(str) 
				{
				
				imgWait.src = emptyImg.src;
				});
		if(autoObj!='')
			{
			clickSObj(document.getElementById('obj_'+autoObj));
			}
		});	
//	curLayer = layer_id;	
	}
function goToFirmProfile(obj)
	{
	var firm_nameTranslit = GetStrPrt(obj.id, '^', 1);
	var newURL = '/company/' + firm_nameTranslit;
	if(self.parent.length == 0) //showLogo
		{
		document.location = newURL;
		}
	else
		{
		var par = parent.parent;			
		par.location = newURL;
		}
	
	}
function setSearchedStringInDocumentTitle(str, type) 
	{	
	var postfiks = 'Карта автофирм Иркутска | Автоинформационный портал ГОРОД-АВТО.РФ';
	if(type == 1) //firm
		document.title = str + ' - схема проезда | ' + postfiks;
	else if(type == 2) //layers
		document.title = str + ' | ' + postfiks;
	}
function searchFieldSubmit() 
	{
//	alert('ddd');
	var layer = document.getElementById('layer').value;
	var name = 	document.getElementById('ac_name').value;
	var activeField = document.getElementById('searchActive').value;
	var activeValue, searchType;
	if ((activeField=='searchLayers')&&(layer!=''))
		{
		activeValue = document.getElementById('searchLayersSelected').value;
		searchType = 'layer';
		}
	else if((activeField=='searchName')&&(name!=''))
		{
		activeValue = name;
		if(document.getElementById('searchNameSelected').value)
			{
//			activeValue = document.getElementById('searchNameSelected').value;
			searchType = 'showFirm';
			}
		else
			{
			searchType = 'searchFirm';
			}
		}
	if(!activeValue)
		{		
		alert('Ошибка! Необходимо исправить запрос.');
		}
	else
		{
		switch (searchType)
			{
			case 'searchFirm' :
				{
//				alert('searchFirm');
				clickLayer(activeValue, 2);
				} break			
			case 'showFirm' :
				{
				showFirmObjects(activeValue, 1);
				} break			
			case 'layer' :
				{
				clickLayer(activeValue, 1);
				} break			
			}
//		alert(searchType + ': ' + activeField + ' = ' + activeValue);		
		
		}
	}
function setSpecialPoint(obj_id, name, about, isHidden, icon, foto,   date, geo_x, geo_y, fotoSmall, iconWidth, iconHeight, isFlash, number, type) 
	{
	this.obj_id = obj_id;
	this.geo_x = geo_x;
	this.geo_y = geo_y;
	this.point_YM =  new YMaps.GeoPoint(geo_x, geo_y);	
	this.name = name;	
	this.about = about;
	this.isHidden = isHidden;
	this.date = date;
	this.icon = icon;
	this.iconWidth = iconWidth;
	this.iconHeight = iconHeight;
	this.foto = foto;
	this.fotoSmall = fotoSmall;
	this.isSpecial = 1;	
	this.isFlash = isFlash;	
	this.number = number;	
	this.type = type;
	}
function setPoint(obj_id, number, geo_x, geo_y, name, firm, adr, phone, mapStatus, layers) 
	{
	this.obj_id = obj_id;
	this.number = number;
	this.geo_x = geo_x;
	this.geo_y = geo_y;
	this.point_YM =  new YMaps.GeoPoint(geo_x, geo_y);	
	this.name = name;	
	this.firm = firm;	
	this.adr = adr;
	this.phone = phone;
	this.mapStatus = mapStatus;
	this.layers = layers;
	this.layersStr = '';
	for(var i=0; i<layers.length; i++)
		if (layers[i] !='')
			this.layersStr += layers[i] + '<br />';
	this.isSpecial = 0;	
	}
function createPlacemark (pointObj) 
	{
	if(pointObj.isSpecial)
		{
//		alert(pointObj.icon);
		var strIcon = '';
		var iconStyle = '';
		switch(pointObj.type)
			{
			case 'cam' :
				{iconStyle = 'plain#darkgreenPoint'} break;
			case 'dealer' :
				{iconStyle = 'plain#darkorangePoint'} break;
			case 'radar' :
				{iconStyle = 'plain#redPoint'} break;
			}
		var curStyle = new YMaps.Style(iconStyle);
		if(!curCamLayer)		
			curStyle.balloonContentStyle = new YMaps.BalloonContentStyle(pointObj.foto!= '' ? tplSpecFoto : tplSpecNoFoto);
		else
			{
			if(pointObj.isFlash == 1)
				{
//				alert(pointObj.name);
				curStyle.balloonContentStyle = new YMaps.BalloonContentStyle(tplCameraFlash);			
				}
			else
				curStyle.balloonContentStyle = new YMaps.BalloonContentStyle(tplCamera);
			}
		if((pointObj.icon !='')&&(pointObj.type !='dealer'))
			{
			curStyle.iconStyle = new YMaps.IconStyle();
			curStyle.iconStyle.href = pointObj.icon;
			curStyle.iconStyle.size = new YMaps.Point(pointObj.iconWidth, pointObj.iconHeight);
			}
		else
			{
//			alert(pointObj.number);
			strIcon = pointObj.number;
			
			}
		curStyle.hasHint = true;
		curStyle.hintContentStyle = new YMaps.HintContentStyle(templateSpecObj);
		var placemark = new YMaps.Placemark(pointObj.point_YM, {style: curStyle});
		if(curCamLayer)
			{
/*			if(pointObj.isFlash)
				{
				placemark.setBalloonContent("<div style=\"\"><strong>Name = " + pointObj.name + "</strong>&nbsp;</div>" + 
											"<img src=\"/src/design/main/_.gif\" border = 0 onLoad=\"startFlash('container')\"  >" +
											"<div id=\"container\">Loading the player ...</div>");
				}*/
			YMaps.Events.observe(placemark,  placemark.Events.BalloonClose, function (obj) 
				{
				curCamSrc = '';
				});						
			}		
		//alert(pointObj.obj_id);
		placemark.obj_id = pointObj.obj_id;
		placemark.name = pointObj.name;
		placemark.about = pointObj.about;
		placemark.isHidden = pointObj.isHidden;
		placemark.icon = pointObj.icon;
		placemark.foto = pointObj.foto;
		placemark.fotoSmall = pointObj.fotoSmall;
		placemark.date = pointObj.date;
		if (strIcon != '')
			{
			placemark.setIconContent(strIcon);
			}
//		alert(showProperties(placemark, 'placemark'));
		return placemark;
		}
	else
		{
		var str;
		if (pointObj.number<10)
			str = /*'&nbsp;' +*/ pointObj.number;
		else 
			str = pointObj.number;
		if	(pointObj.mapStatus!=2)
//		var placemark = new YMaps.Placemark(pointObj.point_YM, {style: styleDef});
			var placemark = new YMaps.Placemark(pointObj.point_YM, {style: styleNum});
		else
			{
			var placemark = new YMaps.Placemark(pointObj.point_YM, {style: styleAtt});
			}
		placemark.name = pointObj.name;
		placemark.firm = pointObj.firm;
		placemark.obj_id = pointObj.obj_id;
		placemark.adr = pointObj.adr;
		placemark.layers = pointObj.layers;
		placemark.mapStatus = pointObj.mapStatus;
		placemark.phone = pointObj.phone;	
		placemark.layersStr = pointObj.layersStr;	
		placemark.setIconContent(str);
		return placemark;
		}
    }
function showObj () 
	{	
	catLvl = 1;

//	showMarkers(0, 0);	
//	alert('showMarkers');	
	if((document.getElementById('autoLoadType').value!='')&&(document.getElementById('autoLoadValue').value!=''))
		{
		bounds 		= new YMaps.GeoCollectionBounds();			
		var autoLoadType = document.getElementById('autoLoadType').value;
		var autoLoadValue = document.getElementById('autoLoadValue').value;
		var autoLoadObj = document.getElementById('autoLoadObj').value;

		switch (autoLoadType)
			{
			case 'specLayer':
				{
//				alert('nameLayer_'+autoLoadValue);
				clickSLayer(document.getElementById('sLayer_'+autoLoadValue), autoLoadObj);
/*				if(autoLoadObj)
					alert(autoLoadObj);*/
				}
			break;
			case 'category':
				{
//				alert('nameLayer_'+autoLoadValue);
				clickLayer(document.getElementById('nameLayer_'+autoLoadValue), 0);
				}
			break;
			case 'company':
				{
				showFirmObjects(autoLoadValue, 2);
//				clickLayer(document.getElementById('nameLayer_'+autoLoadValue), 0);
				}
			break;
			default :
				{
				}
			}
		
		}
	else
		{
		
		}
//		clickObj(document.getElementById('obj_'+document.getElementById('neededObj').value));
		
/*	var myPlacemark = new YMaps.Placemark(map.getCenter(), {style: myStyle});
	myPlacemark.setIconContent('123');
	map.addOverlay(myPlacemark);*/
	}
function clickObj(obj) 
	{
	var divCol = document.getElementsByTagName('div'); 
	var res = (obj.id) ? obj.id.split('_') : 0;
	var objPoint  = gCollection.filter(function (obj) 
		{
		return obj.obj_id == res[1]; /*needPoint.obj_id*/
		});
	if(objPoint[0])
		{
		map.panTo(objPoint[0].getCoordPoint(), {flying: 1, 
			callback: function () 
				{
				objPoint[0].openBalloon();
				}});
		}
	else
		{
		bounds 		= new YMaps.GeoCollectionBounds();			
		gCollection.removeAll();						
		showMarkers('obj_id', res[1]);						
		objPoint  = gCollection.filter(function (obj) 
			{
			return obj.obj_id == res[1]; /*needPoint.obj_id*/
			});
		objPoint[0].openBalloon();					
		}
	markSelections('obj', res[1]);
//	markSelections(res[0], res[1]);
	}
function clickFirm(firm)
	{
	catLvl = 2;	
	bounds 		= new YMaps.GeoCollectionBounds();			
	gCollection.removeAll();
	var firm_id = firm.id.split('_');
	showMarkers('firm', firm_id[1]);
	markSelectionsOld('firm', firm_id[1])
	curFirm = firm_id[1];
	}
function showFirmObjects(firm, useSearchForm)
	{

	var contaner = document.getElementById('objContaner');
	var imgWait = document.getElementById('resultImgLoad');	
	var title;
	if(!useSearchForm)
		{
//		title = firmName.innerHTML + ' на карте города';
		var firm_nameTranslit = GetStrPrt(firm.id, '^', 1);
		var obj_id = GetStrPrt(firm.id, '^', 2);
		var firmName = document.getElementById('frmName_'+firm_nameTranslit + '_' + obj_id);
		document.getElementById('resultTitle').innerHTML = firmName.innerHTML + ' на карте города';
		title = firmName.innerHTML;
		}
	else 
		{		
		if (useSearchForm>1)		
			{
			var firm_nameTranslit = firm;
			document.getElementById('resultTitle').innerHTML = 'поиск компании...';
			title = '';
			}
		else
			{
			var firm_nameTranslit = document.getElementById('searchNameTranslit').value;
			document.getElementById('resultTitle').innerHTML = /*firmName.innerHTML + */firm.toUpperCase() + ' на карте города';
			title = firm.toUpperCase();
			}
		}
	if(title)
		setSearchedStringInDocumentTitle(title, 1); 
	gCollection.removeAll();						
	bounds 		= new YMaps.GeoCollectionBounds();			
	imgWait.src = loadImg.src;
	contaner.innerHTML = '';	
	point = new Array();	
	if(getActivePad()!= 'objList')
		togglePad();
	$.post("/spddl/", {type:'firmObjectsYMaps', frmName:firm_nameTranslit}, function(str) 
		{
		var strTmp = GetStrPrt(GetStrPrt(str, '#getmeStart#', 1), '#getmeEnd#', 0);
		var strArr = strTmp.split('~~');
		var valArr, layerArr;		
		for(var i=0; i<strArr.length;  i++ )
			{
			if(strArr[i]!='')
				{
				valArr = strArr[i].split('##');
				layerArr = valArr[9].split('%%');
//				alert(layerArr.length);
				point[i] = new setPoint(valArr[0], valArr[1], valArr[2], 
																	valArr[3], 
																	valArr[4], 
																	valArr[5], 
																	valArr[6], 
																	valArr[7], valArr[8], layerArr);
				if(!title)
					{
					title = valArr[4];
					document.getElementById('resultTitle').innerHTML = title + ' на карте города';
					setSearchedStringInDocumentTitle(title, 1); 
					}
				}
			}
		showMarkers(0, 0);
		contaner.innerHTML = str;				
		document.getElementById('resultNum').innerHTML = 'Найдено объектов: ' + (strArr.length-1);
		$(contaner).slideDown(600, function(str) 
				{
				
				imgWait.src = emptyImg.src;
				});
		});	

	}
function showMarkers(param, value) // отрисовка маркеров по условию
	{
	var len = point.length;
	var needPoint;
	for(var i=0; i<len; i++)
		{
		if((point[i][param]==value)||(!param))
			{
			gCollection.add(createPlacemark(point[i]));
			bounds.add(point[i].point_YM);
			needPoint = point[i];
			}
		}		
	map.setBounds(bounds);	
//	alert(showProperties(gCollection._objects[2], 'gCollection'));
	map.addOverlay(gCollection);	
	}	
function resetSelections() // отмена подсветки выделенного пункта в списке объектов
	{
	var divCol = document.getElementsByTagName('div'); 
	for(k=0; k<divCol.length; k++)
		{
		if(divCol[k].id.indexOf('objPad_') >= 0)
				divCol[k].className = 'layer';				
		if(divCol[k].id.indexOf('obj_') >= 0)
				divCol[k].className = 'title';		
		}
	}
function markSelections(param, value) // подсветка выделенного пункта в списке объектов
	{
	var divCol = document.getElementsByTagName('div'); 
	for(k=0; k<divCol.length; k++)
		{
		if(param=='obj')
			{
			if(divCol[k].id.indexOf('objPad_' + value) >= 0)
				divCol[k].className = 'layerSelected';
			else if(divCol[k].id.indexOf('objPad_') >= 0)
				divCol[k].className = 'layer';				
			if(divCol[k].id.indexOf('obj_' + value) >= 0)
				divCol[k].className = 'titleSelected';
			else if(divCol[k].id.indexOf('obj_') >= 0)
				divCol[k].className = 'title';
			}
		}
	}
function markSelectionsOld(param, value) // подсветка выделенного пункта в списке объектов
	{
	var selectedStyle = (param == 'firm') ? 'titleSelected' : 'objSelected';
	var firstSimpleStyle = (param == 'firm') ? 'objSimple' : 'title';
	var secondSimpleStyle = (param == 'firm') ? 'title' : 'objSimple';
	var firstSearch = (param == 'firm') ? 'obj_' : 'firm_';
	var secondSearch = (param == 'firm') ? 'firm_' : 'obj_';
	var divCol = document.getElementsByTagName('div'); 
	for(k=0; k<divCol.length; k++)
		{
		if(divCol[k].id.indexOf(firstSearch) >= 0)
			divCol[k].className = firstSimpleStyle;
		else if(divCol[k].id.indexOf(secondSearch) >= 0)
			{
			if(divCol[k].id.indexOf('_' + value) >= 0)
				divCol[k].className = selectedStyle;
			else
				divCol[k].className = secondSimpleStyle;								
			}
		}
	}

function toggleLayer(obj)
	{
	var layer_id = GetStrPrt(obj.id, '_', 1);
	var contaner = document.getElementById('layerContaner_'+layer_id);
	var imgWait = document.getElementById('imgLayer_'+layer_id);
	imgWait.src = layerLoadingImg.src;
	if(contaner.style.display == 'none')
		{
		$(contaner).slideDown(600, function(str) 
				{				
				imgWait.src = layerOpenedImg.src;
				});		
		}
	else
		{
		$(contaner).slideUp(600, function(str) 
				{
				imgWait.src = layerClosedImg.src;
				});
		}	
	}
function toggleElementSimple(objId) /*hide/show element*/
	{
	var container = document.getElementById (objId);
	if (container)
		{
		var display = container.style.display;
		if (display == 'none'/* || !display*/)
			{
			displayedPanel = objId;
			container.style.display = '';     // без jquery
			}
		else
			{
			container.style.display = 'none';     // без jquery
			}
		return false;
		}
	else return true;			
	}	
function toggleSearchField(obj) //Переключение параметров поиска
	{
	if ( (obj.id=='searchName') && (document.getElementById('searchActive').value != 'searchName'))
		{
		document.getElementById('searchActive').value = 'searchName';
		document.getElementById('ac_name').style.display = '';
		document.getElementById('layer').style.display = 'none';
		document.getElementById('searchName').className = 'selected';
		document.getElementById('searchLayers').className = 'link';
		}
	else if( (obj.id=='searchLayers') && (document.getElementById('searchActive').value != 'searchLayers'))
		{
		document.getElementById('searchActive').value = 'searchLayers';
		document.getElementById('ac_name').style.display = 'none';
		document.getElementById('layer').style.display = '';
		document.getElementById('searchName').className = 'link';
		document.getElementById('searchLayers').className = 'selected';
		}
	}
function togglePad() //Переключение панелей
	{
	if (document.getElementById('layerTree').style.display == 'none')
		{
		document.getElementById('layerTree').style.display = '';
		document.getElementById('objList').style.display = 'none';
		}
	else
		{
		document.getElementById('layerTree').style.display = 'none';
		document.getElementById('objList').style.display = '';
		}
	}
function getActivePad()
	{
	if (document.getElementById('layerTree').style.display == 'none')
		return document.getElementById('objList').id;
	else
		return document.getElementById('layerTree').id;
	}
function clickLayer(obj, useSearchForm)
	{
//	alert(obj.id);
	var contaner = document.getElementById('objContaner');
	var imgWait = document.getElementById('resultImgLoad');	
	var title;
	if(!useSearchForm)
		{		
		title = (ie) ? obj.innerText : obj.textContent;
//		alert(obj.textContent) ;
//		alert(showProperties(obj, 'obj')) ;
//		alert(showProperties(obj, 'obj')) ;
		var layer_id = GetStrPrt(obj.id, '_', 1);
		var curLayer = document.getElementById('nameLayer_'+layer_id);
		document.getElementById('resultTitle').innerHTML = title;
		var spdlType = 'layerObjectsYMaps';
		var spdlLayer = layer_id;
		}
	else if (useSearchForm == 1)
		{
		title = document.getElementById('layer').value;
		var layer_id = obj;
		document.getElementById('resultTitle').innerHTML = title;
		var spdlType = 'layerObjectsYMaps';
		var spdlLayer = layer_id;
		}
	else if (useSearchForm == 2)
		{
		title = 'Фирмы с названием на "' + obj + '"';
		var layer_id = obj;
		document.getElementById('resultTitle').innerHTML = title;
		var spdlType = 'FirmObjectsSearchedYMaps';
		var spdlLayer = layer_id;
		}
	setSearchedStringInDocumentTitle(title, 2); 
	gCollection.removeAll();						
	bounds 		= new YMaps.GeoCollectionBounds();			
	imgWait.src = loadImg.src;
	contaner.innerHTML = '';	
	point = new Array();	
	if(getActivePad()!= 'objList')
		togglePad();
	$.post("/spddl/", {type:spdlType, layer:spdlLayer}, function(str) 
		{
		var strTmp = GetStrPrt(GetStrPrt(str, '#getmeStart#', 1), '#getmeEnd#', 0);
		var strArr = strTmp.split('~~');
		var valArr, layerArr;		
		for(var i=0; i<strArr.length;  i++ )
			{
			if(strArr[i]!='')
				{
				valArr = strArr[i].split('##');
				layerArr = valArr[9].split('%%');
//				alert(layerArr.length);
				point[i] = new setPoint(valArr[0], valArr[1], valArr[2], 
																	valArr[3], 
																	valArr[4], 
																	valArr[5], 
																	valArr[6], 
																	valArr[7], valArr[8], layerArr);
				
				}
			}
		showMarkers(0, 0);
		contaner.innerHTML = str;				
		document.getElementById('resultNum').innerHTML = 'Найдено объектов: ' + (strArr.length-1);
		$(contaner).slideDown(600, function(str) 
				{
				
				imgWait.src = emptyImg.src;
				});
		});	
	curLayer = layer_id;	
	}
function renewLayer()
	{
	bounds 		= new YMaps.GeoCollectionBounds();			
	gCollection.removeAll();
	showMarkers(0, 0);
	resetSelections();
	}
/**compactIcon**/
(function (YMaps, jQuery) {

var CompactIconLayout = function (context) {
    this._context = context;
    this._element = jQuery('<div><div class="YMaps-compact-icon"></div></div>');
    this.update();
};

jQuery.extend(CompactIconLayout.prototype, {

    onAddToParent: function (parentNode) {
        this._element.appendTo(parentNode);
    },

    onRemoveFromParent: function () {
        this._element.remove();
    },

    setContent: function (content) {
        if (this._content) {
            this._content.onRemoveFromParent();
        }
        if (content) {
            content.onAddToParent(this._element.children()[0]);
        }
        this._content = content;
    },

    update: function () {
        var css, iconContentStyle, iconStyle, style;

        style = this._context.getComputedStyle();
        iconContentStyle = style.iconContentStyle;
        iconStyle = style.iconStyle;

        css = jQuery.browser.msie && jQuery.browser.version < 7 ? {
            filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +
                iconStyle.href + '",sizingMethod="scale")'
        } : {
            backgroundImage: 'url(' + iconStyle.href + ')'
        };
        css.width = iconStyle.size.x + 'px';
        css.height = iconStyle.size.y + 'px';

        this._element.css(css).children().css({
            color: iconContentStyle.color,
            width: iconContentStyle.width + 'px'
        });
    }

});

YMaps.Templates.add('compact#icon', new YMaps.LayoutTemplate(CompactIconLayout));

'blue,darkblue,darkorange,green,night,red,violet,' // белый текст
.concat('grey,lightblue,orange,pink,white,yellow') // чёрный текст
.split(',').forEach(function (color, i) {
    var style = YMaps.Styles.get('default#' + color + 'Point');
    style = YMaps.Style.copy(style);
    style.iconStyle.template = 'compact#icon';
    style.iconContentStyle = {
        color: i < 7 ? 'white' : 'black',
        width: 22
    };
    YMaps.Styles.add('compact#' + color + 'Point', style);
});

})(YMaps, YMaps.jQuery);
/**compactIcon**/
