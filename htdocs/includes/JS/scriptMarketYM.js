
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}



function autoClick(value)
	{
	var str = value.toString();
	if(str.indexOf('cat_')<0)
		polyClickAuto(autoload);
//		objClick(value);
	else
		{
//		alert(value);
		var id = GetStrPrt(str, '_', 1);
		document.getElementById('CATEGORY').value = id;
		layerSelect(document.getElementById('CATEGORY'));
		}
	}
/**********************************Глобальные переменные****************************************************/	
var currentPlacemark;
/**********************************Стили и шаблоны****************************************************/	
/**********************************шаблоны***********************************************************/	
//"<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div> <div><u></u> <strong><a href=\"$[link]\">$[name]</a></strong><br /><u>Рейтинг:</u> <span>$[rank|пока нет оценок]</span></div><div><u>Деятельность:</u> <br />$[description]</div><div><u>Телефон:</u> $[phone|-]</div><div><a href=\"$[link]/comments\">оставить отзыв</a></div>"
// <small>Рейтинг: <span>$[rank|нет оценок]</span></small>

var template = new YMaps.Template(
"<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><div><strong><a href=\"$[link]\" title=\"перейти на страницу фирмы\">$[name]</a></strong></div><div>Телефон: <strong>$[phone|-]</strong></div><div><br />$[description]</div><div><br /><a href=\"$[link]/comments\">оставить отзыв</a></div>"
);

var templateNoLink = new YMaps.Template(
"<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><div><strong>$[name]</strong></div><div>Телефон: <strong>$[phone|-]</strong></div><div><br />$[description]</div><div><br /><a href=\"/feedback\">Уточнить информацию</a></div>"
);
var templateAtt = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><div style=\"text-align: center;\"><br /><h3><font color=red>Записей не найдено</font></h3></div><div style=\"text-align: center;\"><br /><a href=\"/company/add\">Добавить сюда фирму!</a></div>'
);

var templateAttAdm = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><div style=\"text-align: center;\"><br /><h3><font color=red>Записей не найдено</font></h3></div><div style=\"text-align: center;\"><br /><span  <span style="cursor:pointer; cursor:hand; color: #006DD4; border-bottom: 1px dashed;" onClick=\"addInfoOnPav($[pavName]);\">Добавить сюда фирму!</span></div>'
);
var templateHintError = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><div style=\"text-align: center;\"><br /><h3><font color=red>Записей не найдено</font></h3></div><div style=\"text-align: center;\"><br /><a href=\"/company/add\">Добавить сюда фирму</a></div>'
);
var templateHint = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>Павильон $[pavName]</strong></div><strong>$[name]</strong><br />'
);

/**********************************шаблон рекламы**************************************/	
/************ БАЛУН  *************/
var templateAdvert = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>Павильон $[objName]</strong></div><strong>$[text]</strong><br />$[textExt]'
);
/************ БАЛУН  *************/

/************ МЕТКА  пока не используется!!!!!  *************/
var templateAdvertIcon = new YMaps.Template(
'<div style=\"text-align: center;\"><img src=\"$[imgSrc]\" border=1></div>'
);
/************ МЕТКА  *************/

/************ ПОДСКАЗКА  *************/
var templateAdvertHint = new YMaps.Template(
'<div style=\"text-align: center;\"><span>$[text]</span></div>'
);
/************ ПОДСКАЗКА  *************/
/**********************************END шаблон рекламы**************************************/	

/**********************************Стиль метки рекламы**************************************/	
var styleAdvert = new YMaps.Style();
styleAdvert.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateAdvert
	);
//styleAdvert.iconStyle = new YMaps.IconStyle(templateAdvertIcon);
styleAdvert.hasHint = true;
styleAdvert.hintContentStyle = new YMaps.HintContentStyle(templateAdvertHint);	


/**********************************END Стиль метки рекламы**************************************/	
/**********************************Стиль метки корректного объекта**************************************/	
var styleLayer = new YMaps.Style();
styleLayer.iconStyle = new YMaps.IconStyle();
styleLayer.iconStyle.href = "http://api-maps.yandex.ru/i/0.4/icons/car.png";
styleLayer.iconStyle.size = new YMaps.Point(27, 26);
styleLayer.iconStyle.offset = new YMaps.Point(-7, -26);
styleLayer.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	template
	);
styleLayer.hasHint = true;
styleLayer.hintContentStyle = new YMaps.HintContentStyle(templateHint);	
/**********************************без ссылки*****************************************/
var styleLayerNoLink = new YMaps.Style();
styleLayerNoLink = styleLayer;
styleLayerNoLink.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateNoLink
	);
/**********************************Стиль метки корректного объекта**************************************/	
var styleDef = new YMaps.Style();
styleDef.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	template
	);
styleDef.hasHint = true;
styleDef.hintContentStyle = new YMaps.HintContentStyle(templateHint);	
/**********************************Стиль метки объекта без ссылки**************************************/	
var styleNoLink = new YMaps.Style();
styleNoLink.balloonContentStyle = new YMaps.BalloonContentStyle(templateNoLink);
styleNoLink.hasHint = true;
styleNoLink.hintContentStyle = new YMaps.HintContentStyle(templateHint);
/**********************************Стиль метки неточного объекта**************************************/	
var styleAtt = new YMaps.Style();
styleAtt.balloonContentStyle = new YMaps.BalloonContentStyle(templateAtt);
styleAtt.hasHint = true;
styleAtt.hintContentStyle = new YMaps.HintContentStyle(templateHintError);
/**********************************Стиль метки неточного объекта адм**************************************/	
var styleAttAdm = new YMaps.Style();
styleAttAdm.balloonContentStyle = new YMaps.BalloonContentStyle(templateAttAdm);
styleAttAdm.hasHint = true;
styleAttAdm.hintContentStyle = new YMaps.HintContentStyle(templateHintError);
/**********************************Стиль метки неточного объекта**************************************/	

function calcPolyCenter(polyArr)
	{
	var arLen =  polyArr.length;
	var sum_x = sum_y = 0;
	for(var i=0; i<arLen; i++)
		{
		sum_x += polyArr[i].x;
		sum_y += polyArr[i].y;
		}
	return {x:Math.round(sum_x/arLen), y:Math.round(sum_y/arLen)};
	}
function getPolyCenter(polyIndx)
	{
	var arLen =  pavPoly.length;
	var find = 0;
	var ret;
	for(var i=0; i<arLen; i++)
		{
		if(pavPoly[i].name == 'polygon' + polyIndx)
			{
			var pointArr =  pavPoly[i].getPoints();
			var ret = calcPolyCenter(pointArr);
			i = arLen;
			find ++;
			}
		}
	return (find>0) ? ret : find;
	}
function layerSelect(select)
	{
/*	var pointArr =  pavPoly[0].getPoints();
	alert (pointArr[2]);*/
	var mapType = (newVersion) ? 'mrktLayerYMaps' : 'marketLayerYMaps';
	if(currentPlacemark)
		currentPlacemark.closeBalloon();
	gCollection.removeAll();
	map.removeOverlay(gCollectionAdvert);
	var resultImg = document.getElementById('resultImg');
	if(select.value>0)
		{
		resultImg.src = loadImg.src;		
		$.post("/spddl/", {type:mapType, market:market, layer:select.value}, function(str) 
			{	
			bounds = new YMaps.GeoCollectionBounds();		
			var valArr, layerArr, layerArrMore;
			var strArr = str.split('~~');
			if(strArr.length>1)
				{
				for(var i=0; i<strArr.length;  i++ )
					{
					if(strArr[i]!='')
						{
						valArr = strArr[i].split('##');
						var centerPoint = getPolyCenter(valArr[0]);
						if(centerPoint != 0 )
							{
							var optionsPlacemark = 
									{
									pavName : valArr[0],
									firmName : valArr[2],
									firmLink : valArr[3],
									firmRank : (valArr[4] != 0) ? valArr[4] : '',
									firmPhone : valArr[5],
									layers : '',
									centerPoint: centerPoint
//								clickPoint: map.converter.localPixelsToCoordinates(new YMaps.Point(centerPoint.x, centerPoint.y))
									};
							var layerArr = 	valArr[6].split('$$');
							for(var k=0; k<layerArr.length;  k++ )
								{
								if(layerArr[k] !='')
									{
									layerArrMore = layerArr[k].split('^^');
									optionsPlacemark.layers += ' <div> <span style="cursor:pointer; cursor:hand; color: #006DD4; border-bottom: 1px dotted;" onclick="autoClick(\'cat_' +layerArrMore[1]+ '\')">' + layerArrMore[0] + '</span></div>';
//						optionsPlacemark.layers += ' &mdash; ' + layerArr[k] + '<br />';
									}
								}
							gCollection.add(createPlacemark(optionsPlacemark));
							}
						}
					}
				map.addOverlay(gCollection);
				map.setZoom(options.mapZoom);
				map.panTo(options.mapCenter, {flying: 1});
				}
			else
				{
				alert ('Записей не найдено');
				}
			resultImg.src = emptyImg.src;
			select.blur();
/*			select.value = 0;*/
			});
		}	
	}
function polyClickAuto(value)
	{
	var mapType = (newVersion) ? 'mrktPavYMaps' : 'marketPavYMaps';
	var centerPoint = getPolyCenter(value);
	var loadPlacemark = new YMaps.Placemark(new YMaps.Point(centerPoint.x, centerPoint.y));
	loadPlacemark.setIconContent("Загрузка &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
	map.addOverlay(loadPlacemark);
			
	$.post("/spddl/", {type:mapType, market:market, obj:value}, function(str) 
		{	
//			alert(str);
		var valArr, layerArr, layerArrMore;
		var strArr = str.split('~~');
		if(strArr.length>1)
			{
			for(var i=0; i<1;  i++ )
				{
				valArr = strArr[i].split('##');
				var optionsPlacemark = 
						{
						pavName : value,
						firmName : valArr[1],
						firmLink : valArr[2],
						firmRank : valArr[3],
						firmPhone : valArr[4],
						layers : '',
						centerPoint: centerPoint
						};
				var layerArr = 	valArr[5].split('$$');
				for(var k=0; k<layerArr.length;  k++ )
					{
					if(layerArr[k] !='')
						{
						layerArrMore = layerArr[k].split('^^');
						optionsPlacemark.layers += ' <div> <span style="cursor:pointer; cursor:hand; color: #006DD4; border-bottom: 1px dotted;" onclick="autoClick(\'cat_' +layerArrMore[1]+ '\')">' + layerArrMore[0] + '</span></div>';
//						optionsPlacemark.layers += ' &mdash; ' + layerArr[k] + '<br />';
						}
					}
				}
			}
		else
			{
			var optionsPlacemark = 
				{
				pavName : value,
				firmName : '',
				firmLink : '',
				firmRank : '',
				firmPhone : '',
				layers : '',
				centerPoint: centerPoint
				};
			}
//		alert(optionsPlacemark.layers);
		currentPlacemark = createPlacemark(optionsPlacemark);
		YMaps.Events.observe(currentPlacemark,  currentPlacemark.Events.BalloonClose, function (obj) 
			{
			map.removeOverlay(currentPlacemark);
			if((map.getZoom() < 2)||(options.mapType.name=='avtograd'))
				{
//				alert(map.getZoom());
				map.panTo(options.mapCenter, {flying: 1});
				}
			map.addOverlay(gCollectionAdvert);
//			alert(obj);
			});			
		map.removeOverlay(loadPlacemark);
		map.addOverlay(currentPlacemark);
		currentPlacemark.openBalloon();
//		resultImg.src = emptyImg.src;
		});
	}
function polyClick(obj, e)
	{
	if(document.getElementById('CATEGORY'))
		document.getElementById('CATEGORY').value = 0;
	if(currentPlacemark)
		currentPlacemark.closeBalloon();
//		map.removeOverlay(currentPlacemark);
//	alert(newVersion);
	var mapType = (newVersion) ? 'mrktPavYMaps' : 'marketPavYMaps';
	gCollection.removeAll();		
	map.removeOverlay(gCollectionAdvert);
	var clickPoint = e.getCoordPoint();
	var loadPlacemark = new YMaps.Placemark(clickPoint);
	loadPlacemark.setIconContent("Загрузка &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
	map.addOverlay(loadPlacemark);
			
	var value = GetStrPrt(obj.name, 'polygon', 1); 
	var resultImg = document.getElementById('resultImg');
//	resultImg.src = loadImg.src;	
	$.post("/spddl/", {type:mapType, market:market, obj:value}, function(str) 
		{	
//		alert(str);
		var valArr, layerArr, layerArrMore;
		var strArr = str.split('~~');
		if(strArr.length>1)
			{
			for(var i=0; i<1;  i++ )
				{
				valArr = strArr[i].split('##');
				var optionsPlacemark = 
						{
						pavName : value,
						firmName : valArr[1],
						firmLink : valArr[2],
						firmRank : valArr[3],
						firmPhone : valArr[4],
						layers : '',
						clickPoint: clickPoint
						};
				var layerArr = 	valArr[5].split('$$');
				for(var k=0; k<layerArr.length;  k++ )
					{
					if(layerArr[k] !='')
						{
						layerArrMore = layerArr[k].split('^^');
						optionsPlacemark.layers += ' <div> <span style="cursor:pointer; cursor:hand; color: #006DD4; border-bottom: 1px dotted;" onclick="autoClick(\'cat_' +layerArrMore[1]+ '\')">' + layerArrMore[0] + '</span></div>';
//						optionsPlacemark.layers += ' &mdash; ' + layerArr[k] + '<br />';
						}
					}
				}
			}
		else
			{
			var optionsPlacemark = 
				{
				pavName : value,
				firmName : '',
				firmLink : '',
				firmRank : '',
				firmPhone : '',
				layers : '',
				clickPoint: clickPoint
				};
			}
		currentPlacemark = createPlacemark(optionsPlacemark);
		YMaps.Events.observe(currentPlacemark,  currentPlacemark.Events.BalloonClose, function (obj) 
			{
			var curZoom = map.getZoom();
			map.removeOverlay(currentPlacemark);
//			alert(options.mapType.name);
			if((map.getZoom() < 2)||(options.mapType.name=='avtograd'))
				{
				map.panTo(options.mapCenter, {flying: 1});
				}
//			alert(obj);
			map.addOverlay(gCollectionAdvert);
//			showAdvert();
			});			
		map.removeOverlay(loadPlacemark);
		map.addOverlay(currentPlacemark);
		currentPlacemark.openBalloon();
//		resultImg.src = emptyImg.src;
		});
	}
function createPlacemark (pointOptions) 
	{
//	alert(showProperties(pointOptions, 'pointOptions') );
	if(pointOptions.firmName)
		{
		if(!pointOptions.centerPoint)
			{
			var currentStyle = new YMaps.Style();
			currentStyle = (pointOptions.firmLink) ? styleDef : styleNoLink;
			var placemark = new YMaps.Placemark(pointOptions.clickPoint, {style: currentStyle, 
					balloonpointOptions: 
						{
						mapAutoPan: 1
						}
					}
				);
			}
		else
			{
			var currentStyle = new YMaps.Style();
			currentStyle = (pointOptions.firmLink) ? styleLayer : styleLayerNoLink;
			var placemark = new YMaps.Placemark(new YMaps.Point(pointOptions.centerPoint.x, pointOptions.centerPoint.y), {style: currentStyle, 
					balloonpointOptions: 
						{
						mapAutoPan: 1
						}
					}
				);			
			}
		placemark.name = pointOptions.firmName;
		placemark.link = pointOptions.firmLink;
		placemark.description = pointOptions.layers;
		if (pointOptions.firmRank)
			placemark.rank = pointOptions.firmRank;
		placemark.pavName = pointOptions.pavName;
		placemark.phone = pointOptions.firmPhone;	
		}
	else
		{
//		var placemark = new YMaps.Placemark(geoPoint, {style: styleAtt, hasHint:true});
		if(!isAdmin)
			var placemark = new YMaps.Placemark(pointOptions.clickPoint, {style: styleAtt});
		else
			var placemark = new YMaps.Placemark(pointOptions.clickPoint, {style: styleAttAdm});			
		placemark.pavName = pointOptions.pavName;
		}
	YMaps.Events.observe(placemark,  placemark.Events.BalloonClose, function (obj) 
		{
		if((map.getZoom() < 2)||(options.mapType.name=='avtograd'))
			{
			map.panTo(options.mapCenter, {flying: 1});
			}
		
		});			
	
	return placemark;
    }
function setPointAdvert(objName, text, textExt, imgSrc) 
	{
	this.objName = objName;
	this.text = text;
	this.textExt = textExt;
	this.imgSrc = imgSrc;
	}
function createPlacemarkAdv(pointOptions, num) 
	{
//	alert(pointOptions.objName);
	var centerPoint = getPolyCenter(pointOptions.objName);
	var advPlacemark = new YMaps.Placemark(new YMaps.Point(centerPoint.x, centerPoint.y), {style: styleAdvert});
	advPlacemark.objName = pointOptions.objName;
	advPlacemark.textExt = pointOptions.textExt;
	advPlacemark.text = pointOptions.text;
	advPlacemark.imgSrc = pointOptions.imgSrc;
	advPlacemark.setIconContent("<img src='" + pointOptions.imgSrc + "' border=0>");
	YMaps.Events.observe(advPlacemark,  advPlacemark.Events.BalloonClose, function (obj) 
		{
		map.panTo(options.mapCenter, {flying: 1});
		});	
	return advPlacemark;
//	map.addOverlay(advPlacemark);
    }
function generateAdvert()
	{
	if(window.pointAdv !== undefined)
		{
		for(var i=0; i<pointAdv.length;  i++ )
			{
//		alert(i);
			gCollectionAdvert.add(createPlacemarkAdv(pointAdv[i]));
			}
		}	
	}
	