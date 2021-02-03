
function pointObj(name, x, y, clickPoint, id, geoX, geoY, constrId)
	{
	this.pointName = name;
	this.pointX = 	x;
	this.pointY = 	y;		
	this.clickPoint = 	clickPoint;		
	this.pointStyle = 	'';
	this.pointId = id;
	this.geoX = geoX;
	this.geoY = geoY;
	this.constrId = constrId;
	this.drawPoint = function()
		{
//		alert( this.pointName );
		changeStyle(curZoom);
		var curStyle = (this.constrId>0) ? stylePoints : stylePointsSimple;
		var placemark = new YMaps.Placemark(this.clickPoint, {style: curStyle, draggable: false});
		placemark.pointName = 	this.pointName;
		placemark.pointX = 		this.pointX;
		placemark.pointY = 		this.pointY;
		placemark.geoX = 		this.geoX;
		placemark.geoY = 		this.geoY;
		placemark.pointId = 	this.pointId;
		placemark.constrId = 	this.constrId;
		YMaps.Events.observe(placemark,  placemark.Events.BalloonClose, function (obj) 
			{
			$('#list_' + this.pointId).removeClass('panSelected');
			});	
		YMaps.Events.observe(placemark,  placemark.Events.BalloonOpen, function (obj) 
			{
//			$('.YMaps-b-balloon-content').css({'height' : '65'});
			if(placemark.constrId =='')
				$('#showConstr').css({'display' : 'none'});
			else
				$('#showConstr a').attr({'href' : '/list/construction/' + placemark.constrId});
				
			$('#showInMap').bind('click', function() {showMiniMapPan(placemark, options)});
			var distance = parseInt(ymaps.coordSystem.geo.getDistance([placemark.geoX, placemark.geoY], [options.panGeoX, options.panGeoY]));
			$('#distanceLabel').text(number_format(distance, 0, ',', ' ') + ' ' + UI.getCorrectDeclensionRu(distance, 'метр', 'метра', 'метров'));
			});	
			
		gCollectionPoints.add(placemark);
		}	
	}

/**********************************Стили****************************************************/	
var templateHint = new YMaps.Template(
'<div style=\"text-align: center;\"><strong>$[pointName]</strong></div>'
);


var templateReadyPointBaloon = new YMaps.Template(
"<div id='adrActions'>" + 
"<div id='contName'>$[pointName]</div>" + 
"<div id='distance'>Расстояние до объекта <span id='distanceLabel'>$[distance]</span></div>" + 
"<div id='controlLinks'><span id='showInMap' class='activeLink'>смотреть на карте</span><span id='showConstr' class=''><a href='' target='_blank' title='подробно о стройке в новом окне'>информация о стройке</a></span></div>" + 
"</div>" );
var templateNewPointBaloon = new YMaps.Template(
"<div id='adrActions' style='width:400px; height:150px'>" + 
"<div id='contName'> Название объекта <input class='' type='text' id='pointNameNew' name='pointNameNew'  style='width:300px;' value=''>	</div>" + 
"<div id='contPos' onClick = 'showMiniMapAdm();  return false;'>Указать местоположение</div>" + 
"<div id='contSave'  onClick = 'panAddPoint();' style='text-align:center;'>Cохранить</div>" + 
"</div>" );

var stylePoints = new YMaps.Style();
stylePoints.balloonContentStyle = new YMaps.BalloonContentStyle(templateReadyPointBaloon);
stylePoints.hasHint = true;
stylePoints.hintContentStyle = new YMaps.HintContentStyle(templateHint);

var stylePointsSimple = new YMaps.Style();
stylePointsSimple.balloonContentStyle = new YMaps.BalloonContentStyle(templateReadyPointBaloon);
stylePointsSimple.hasHint = true;
stylePointsSimple.hintContentStyle = new YMaps.HintContentStyle(templateHint);
	


var styleNew = new YMaps.Style();
styleNew.iconStyle = new YMaps.IconStyle();
styleNew.iconStyle.href = "/src/design/main/img/png/map_marker_small.png";
styleNew.iconStyle.size = new YMaps.Point(10, 11);
styleNew.iconStyle.offset = new YMaps.Point(-5, -5);
styleNew.balloonContentStyle = new YMaps.BalloonContentStyle(templateNewPointBaloon);
styleNew.hasHint = false;

/**********************************Методы****************************************************/	

function calcPanZoom(maxHeight, curHeight, maxZoom)
	{
	var count = 1;
	var stop = tmpHeight = 0;
	var del;
	while(stop == 0)
		{
//		del = (count>0) ? count : 1;
		if((maxHeight/(2*count)) >= curHeight)
			count ++;
		else
			stop ++;
		}	
//	alert (maxZoom-count-1);
	return maxZoom-count+1;
	}
function showMiniMapPanFull()
	{
	$("h3.miniMap_title").addClass('typeInfo');	
	$("#miniMap_title_text").text('Расположение точки съёмки и объектов на карте');
	UI.togglePanel('', 'miniMap', 1);
	init();	
	var objectPlacemark;
	var tplPanObj = ymaps.templateLayoutFactory.createClass(
"<div id='adrActions'  style='min-width:300px; min-height:70px'>" + 
"<div id='contName'>$[properties.objText]</div>" + 
"<div id='distance'>Расстояние до объекта <span id='distanceLabel'>$[distance]</span></div>" + 
"</div>"
		);	
	var tplPanPoint = ymaps.templateLayoutFactory.createClass(
"<div id='adrActions'  style='min-width:300px; min-height:70px'>" + 
"<div id='contName'>$[properties.objText]</div>" + 
"<div id='distance'><b>точка съёмки</b></div>" + 
"</div>"
		);
	ymaps.layout.storage.add('my#tplPanObj', tplPanObj);	
	ymaps.layout.storage.add('my#tplPanPoint', tplPanPoint);	
	var panPlacemark = new ymaps.Placemark([options.panGeoX, options.panGeoY], 
		{
		objText: options.panName,
		hintContent: options.panName
		},
		{
		preset: 'twirl#photographerIcon',
		balloonContentLayout:  'my#tplPanPoint',
		
		}
		);
	panPlacemark.events
		.add('balloonopen', function (e) 
			{
			var myPolyline;
			for(var k=0; k<pointList.length; k++)
				{
				myPolyline = new ymaps.Polyline(
					[e.get('target').geometry.getCoordinates(),[pointList[k].geoX, pointList[k].geoY]], 
						{
						objId: 'line_' + pointList[k].pointId,
						simpleId: pointList[k].pointId
						},
						{
						strokeWidth: 2,
						strokeColor: '#' + getRandomInt(128, 192).toString(16) + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16)			
						}
					
					);
				myMap.geoObjects.add(myPolyline);
				
				}
			
			}
			);
	panPlacemark.events
		.add('balloonclose', function (e) 
			{
			var strTmp;
			var iterator = myMap.geoObjects.getIterator(),
				object;
			while (object = iterator.getNext()) 
				{
				if(object.properties.get('objId'))
					{
					strTmp = object.properties.get('objId');
					if(strTmp.indexOf('line')>=0)
						{
						myMap.geoObjects.remove(object);
						}
					}
				}
			}
			);		
	for(var k=0; k<pointList.length; k++)
		{
		objectPlacemark = new ymaps.Placemark([pointList[k].geoX, pointList[k].geoY], 
			{
			objId: 'placemark_' + pointList[k].pointId,
			simpleId: pointList[k].pointId,
			objText: pointList[k].pointName,
			hintContent: pointList[k].pointName,	
			coordUsr:[pointList[k].geoX, pointList[k].geoY]
			},
			{
			preset: 'twirl#buildingsIcon',
			balloonContentLayout:  'my#tplPanObj',
			}
			);	
		objectPlacemark.events
			.add('balloonopen', function (e) 
				{
				var distance = parseInt(ymaps.coordSystem.geo.getDistance(e.get('target').geometry.getCoordinates(),[options.panGeoX, options.panGeoY]));
				$('#distanceLabel').text(number_format(distance, 0, ',', ' ') + ' ' + UI.getCorrectDeclensionRu(distance, 'метр', 'метра', 'метров'));
				var myPolyline = new ymaps.Polyline(
					[e.get('target').geometry.getCoordinates(),[options.panGeoX, options.panGeoY]], 
						{
						objId: 'line_' + e.get('target').properties.getAll().simpleId,
						simpleId: e.get('target').properties.getAll().simpleId
						},
						{
						strokeWidth: 2,
						strokeColor: '#' + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16)			
						}
					
					);
				myMap.geoObjects.add(myPolyline);
				
				}
			
				);			
		objectPlacemark.events
			.add('balloonclose', function (e) 
				{
				var iterator = myMap.geoObjects.getIterator(),
					object;
				while (object = iterator.getNext()) 
					{
					if(object.properties.get('objId') == 'line_' + e.get('target').properties.getAll().simpleId)
						{
						myMap.geoObjects.remove(object);
						}
					}
				}
				);
		objCollection.add(objectPlacemark);
		}
/*	
	var myPolyline = new ymaps.Polyline(
		[[this.geoX, this.geoY],[options.panGeoX, options.panGeoY]]);
	myMap.geoObjects.add(myPolyline);
*/
			
	objCollection.add(panPlacemark);
	myMap.geoObjects.add(objCollection);
	myMap.setBounds(objCollection.getBounds(), { checkZoomRange: true,
		callback: function(err) {
		if (err) {alert('Ошибка масштаба - '+ myMap.getZoom());}}});		
	}
function showMiniMapPan(obj, pan)
	{
	
		$("h3.miniMap_title").addClass('typeInfo');	
		$("#miniMap_title_text").text('Расположение объекта');
		UI.togglePanel('', 'miniMap', 1);
		init();
	var tplPanObj = ymaps.templateLayoutFactory.createClass(
"<div id='adrActions'  style='min-width:300px; min-height:70px'>" + 
"<div id='contName'>$[properties.objText]</div>" + 
"<div id='distance'>Расстояние до объекта <span id='distanceLabel1'>sss</span></div>" + 
"</div>"
		);	
	var tplPanPoint = ymaps.templateLayoutFactory.createClass(
"<div id='adrActions'  style='min-width:300px; min-height:70px'>" + 
"<div id='contName'>$[properties.objText]</div>" + 
"<div id='distance'><b>точка съёмки</b></div>" + 
"</div>");
		ymaps.layout.storage.add('my#tplPanPoint', tplPanPoint);	
		ymaps.layout.storage.add('my#tplPanObj', tplPanObj);	
		
		var objectPlacemark = new ymaps.Placemark([obj.geoX, obj.geoY], 
			{
			objText: obj.pointName
			},
			{
			preset: 'twirl#buildingsIcon',
			balloonContentLayout:  'my#tplPanObj',
			}
			);	
		objectPlacemark.events
			.add('balloonopen', function (e) 
				{
				var distance = parseInt(ymaps.coordSystem.geo.getDistance(e.get('target').geometry.getCoordinates(),[options.panGeoX, options.panGeoY]));
				$('#distanceLabel1').text(number_format(distance, 0, ',', ' ') + ' ' + UI.getCorrectDeclensionRu(distance, 'метр', 'метра', 'метров'));
				var myPolyline = new ymaps.Polyline(
					[e.get('target').geometry.getCoordinates(),[options.panGeoX, options.panGeoY]], 
						{
						objId: 'line_' + e.get('target').properties.getAll().simpleId,
						simpleId: e.get('target').properties.getAll().simpleId
						},
						{
						strokeWidth: 2,
						strokeColor: '#' + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16)			
						}
					);
				myMap.geoObjects.add(myPolyline);				
				}			
				);			
		objectPlacemark.events
			.add('balloonclose', function (e) 
				{
				var iterator = myMap.geoObjects.getIterator(),
					object;
				while (object = iterator.getNext()) 
					{
					if(object.properties.get('objId') == 'line_' + e.get('target').properties.getAll().simpleId)
						{
						myMap.geoObjects.remove(object);
						}
					}
				}
				);			
		var panPlacemark = new ymaps.Placemark([pan.panGeoX, pan.panGeoY], 
			{
			objText: pan.panName,
			objGeoX: obj.geoX,
			objGeoY: obj.geoY
			},
			{
			preset: 'twirl#photographerIcon',
			balloonContentLayout:  'my#tplPanPoint',
			}
			);	
	panPlacemark.events
		.add('balloonopen', function (e) 
			{
			var objGeoX = objGeoY = '';
			var myPolyline;
			var iterator = objCollection.getIterator(),
				object;
			while (object = iterator.getNext()) 
				{
				if(object.properties.get('objGeoX'))
					{
					var objGeoX = object.properties.get('objGeoX');
					var objGeoY = object.properties.get('objGeoY');
					}
				}
			if(objGeoX!='')
				{
				myPolyline = new ymaps.Polyline(
					[e.get('target').geometry.getCoordinates(),[objGeoX, objGeoY]], 
						{
						objId: 'line_'
						},
						{
						strokeWidth: 2,
						strokeColor: '#' + getRandomInt(128, 192).toString(16) + getRandomInt(64, 128).toString(16) + getRandomInt(64, 128).toString(16)			
						}
					
					);
				myMap.geoObjects.add(myPolyline);				
				}			
			}
			);
	panPlacemark.events
		.add('balloonclose', function (e) 
			{
			var strTmp;
			var iterator = myMap.geoObjects.getIterator(),
				object;
			while (object = iterator.getNext()) 
				{
				if(object.properties.get('objId'))
					{
					strTmp = object.properties.get('objId');
					if(strTmp.indexOf('line')>=0)
						{
						myMap.geoObjects.remove(object);
						}
					}
				}
			}
			);					
		objCollection.add(panPlacemark);
		objCollection.add(objectPlacemark);
		myMap.geoObjects.add(objCollection);
		myMap.setBounds(objCollection.getBounds(), { checkZoomRange: true,
			callback: function(err) {
			if (err) {alert('Ошибка масштаба - '+ myMap.getZoom());}}});		
	}
function changeStyle(size) 
	{
	var iconStyle =  new YMaps.IconStyle();
	var iconStyleSimple =  new YMaps.IconStyle();
	var iconShadowStyle = new YMaps.IconStyle();
	var iconPref = "/src/design/main/pan/marker/pan_marker_";
	var iconSize = '';
	var iconX = iconY = iconOX = iconOY = 0;
	if(size < 2)
		{
		iconSize = "4x4.png";
		iconX = 4;		iconY = 4;
		iconOX = -2;		iconOY = -2;
		}
	if(size < 3)
		{		
		iconSize = "5x5.png";
		iconX = 5;		iconY = 5;
		iconOX = -2;		iconOY = -2;
		}
	else if(size < 4)
		{		
		iconSize = "7x8.png";
		iconX = 7;		iconY = 8;
		iconOX = -3;		iconOY = -4;
		}
	else if(size < 5)
		{		
		iconSize = "10x11.png";
		iconX = 10;		iconY = 11;
		iconOX = -5;		iconOY = -5;
		}
	else if(size < 6)
		{
		iconSize = "14x19.png";
		iconX = 14;		iconY = 19;
		iconOX = -7;		iconOY = -10;
		}
	else
		{
		iconSize = "17x23.png";
		iconX = 17;		iconY = 23;
		iconOX = -8;		iconOY = -12;
		}
		iconStyle.href = iconPref  + "constr_" + iconSize;
		iconStyle.size = new YMaps.Point(iconX, iconY);
		iconStyle.offset = new YMaps.Point(iconOX, iconOY);	
		stylePoints.iconStyle = iconStyle;
/*		
		iconShadowStyle.href = "/src/design/main/img/png/map_markerShadow_15.png";
		iconShadowStyle.size = new YMaps.Point(15, 15);
		iconShadowStyle.offset = new YMaps.Point(-7, 7);	
		
		stylePoints.iconStyle.shadow = iconShadowStyle;*/
		
		iconStyleSimple.href = iconPref  + "simple_" + iconSize;
		iconStyleSimple.size = new YMaps.Point(iconX, iconY);
		iconStyleSimple.offset = new YMaps.Point(iconOX, iconOY);	
		stylePointsSimple.iconStyle = iconStyleSimple;
	}
function panShowPoint (obj) 
	{	
	$('#panObjList	ul li').removeClass('panSelected');	
	$('#' + obj.id).addClass('panSelected');
	var pId = UI.GetStrPrt(obj.id, '_', 1);
	var objPoint  = gCollectionPoints.filter(function (point) 
		{
		return point.pointId == pId;
		});
	if(objPoint[0])
		{
		var curZoom = map.getZoom();
		if(curZoom >= (options.maxZoom/2) )
			{
			map.panTo(objPoint[0].getCoordPoint(), {flying: 0, 
				callback: function () 
					{
					objPoint[0].openBalloon(); ;				
					}});
			}
		else
			{
			map.setZoom(parseInt(options.maxZoom/2, 10)+1, {position: objPoint[0].getCoordPoint(), centering: 1, smooth: 1,
				callback: function (state)
					{ 
					if (state == 'Success') 
						{
						panDrawPoints();
						var tmpPoint  = gCollectionPoints.filter(function (point) 
							{
							return point.pointId == pId;
							});
						if(tmpPoint[0])
							tmpPoint[0].openBalloon(); 
						}
					}
					});
			}
		
		}	
	}
function panDrawPoints () 
	{
	map.removeOverlay(gCollectionPoints);			
	gCollectionPoints = new YMaps.GeoObjectCollection();	
	for(var i=0; i<pointList.length;  i++ )
		{
		pointList[i].drawPoint();					
		}
	map.addOverlay(gCollectionPoints);	
	}
function createPlacemark (pointOptions) 
	{
	var currentStyle = new YMaps.Style();
	currentStyle = styleReadyMedium;
	var placemark = new YMaps.Placemark(pointOptions.clickPoint, {style: currentStyle, draggable: false});
	placemark.pointName = pointOptions.pointName;
	placemark.pointX = pointOptions.pointX;
	placemark.pointY = pointOptions.pointY;
	return placemark;	
	}
function panGetPoints()
	{
	UI.pleaseWait();
	$.post("/spddl/", {type:'panDemoPoints'}, function(str)
		{		
//		alert(str);
		var valArr, optionsPlacemark;
		var strArr = str.split('~~');
		var pointCnt = 0;
		if(strArr.length>1)
			{
			for(var i=0; i<strArr.length;  i++ )
				{
				if((strArr[i]!='')&&(strArr[i].length>10))
					{
					valArr = strArr[i].split('##');
					optionsPlacemark = 
							{
							pointName : valArr[0],
							pointX: valArr[1],
							pointY: valArr[2],
							clickPoint: new YMaps.Point(valArr[1], valArr[2])
							};	
//					pointList[pointCnt] = createPlacemark (optionsPlacemark);
					pointList[pointCnt] = new pointObj(valArr[0], valArr[1], valArr[2], new YMaps.Point(valArr[1], valArr[2]));
					pointCnt ++;
					}
				}
			}
		panDrawPoints();
		UI.pleaseWait();
//		addPlacemark.closeBalloon();
		});	
	}
