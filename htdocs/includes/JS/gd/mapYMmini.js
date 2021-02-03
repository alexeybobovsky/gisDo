var myMap = null;
var point  = new Array();
var placemark = new Array();
var objCollection;
function miniMapDestroy() 
	{
	 myMap.destroy();
	 myMap = null;
	}
function showMiniMap(obj) 
	{
//	alert(obj);
	$("h3.miniMap_title").addClass('typeInfo');		

	UI.togglePanel('', 'miniMap', 1);
//	UI.mapMiniShow = true;
	init();
	getObjects('mapSingleObj', obj); 
/*	$("#miniMap").css({'display' : 'block', 'left' : '0px' });*/

	}
function init() 
	{
	if(myMap == null)
		{
		myMap = new ymaps.Map("YMapsID", 
			{				
			center: [52.289422, 104.280633],
			zoom: 16
			});
		myMap.behaviors.enable('scrollZoom');		
		myMap.copyrights.add('&copy; Город-детям.рф');
		var tplMarkerBaloonStr = "<div id='baloonPad'><div id='MiniFirmName'>" + 
			"$[properties.firmName]" + 
	//		"<span class='orgAct' id='showAllOrgObjLink'  onClick='showOrgObjects(\"$[properties.firmId]\", 0)'><nobr>Все объекты</nobr></span>" +
			"</div>" + 
			"$[properties.orgSting]" + 
			"<div id='adrActions'>" + 
			"<div id='adr'><strong>Адрес: </strong>$[properties.adress]</div>" + 
			"<div id='phone'><strong>Телефон: </strong>$[properties.phone]</div></div>" + 
			"<div id='miniMore'>" + 
			"<a href='/map/$[properties.firmName]/$[properties.objId]/'>Смотреть на подробной карте</a>" + 
			"</div>" + 			"";			
		var tplStandardObj = ymaps.templateLayoutFactory.createClass(tplMarkerBaloonStr);	
		ymaps.layout.storage.add('my#tplStandardObj', tplStandardObj);	
		objCollection = new ymaps.GeoObjectCollection();
		}
	else
		{
		objCollection.removeAll();
		}
//	alert(fbMapCurObject + '- eeee');
	}
function getObjects(spdlType, paramId) //получение объектов с сервера и добавление их в геоколлекцию
	{
	var city = document.getElementById('cityId').value;
	UI.pleaseWait();
	$.post("/spddl/", {type:spdlType, object:paramId, city:city}, function(str) 
		{
		UI.pleaseWait();
		var strArr = str.split('~~');
		var valArr, layerArr, imgArr; //, showType;	
		var pointCnt = objCnt = 0;
		objCnt = strArr.length - 1;
		for(var i=0; i<strArr.length;  i++ )
			{
			if(strArr[i]!='')
				{
				valArr = strArr[i].split('##');
				if(valArr.length>1)
					{
					point[pointCnt] =  new setPoint(valArr[1], valArr[0], valArr[5], valArr[4], valArr[2], valArr[3], valArr[6], valArr[7], layerArr, imgArr);
					objCollection.add(createObjectPlacemark(point[pointCnt]));
					pointCnt ++;
					}
				}
			}
		$("#miniMap_title_text").html(point[0].firmName + ' - схема проезда');		
		myMap.geoObjects.add(objCollection);
		myMap.setCenter(point[0].coordinates);	
		myMap.setZoom(16);
		var iterator = objCollection.getIterator(),
			object;
		while (object = iterator.getNext()) 
			{
			object.balloon.open();
			break;
			}
		});	
	}
function setPoint(number, objId, firmId, firmName, x, y, adr, phone) //поля метки для объекта
	{
    this.number = number;
    this.objId = objId;
    this.firmId = firmId;
    this.firmName = firmName;
    this.x = x;
    this.y = y;
    this.coordinates = [x, y];
    this.adr = adr;
	this.phone = phone;	
	}	
function createObjectPlacemark(obj) //создает метку объекта
	{
	var objectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		hintContent: obj.firmName,
		firmName: obj.firmName,
		firmId: obj.firmId,
		objId: obj.objId,
		adress: obj.adr,
		phone: obj.phone,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		iconImageHref: '/src/design/main/img/png/map_marker_big.png',
		iconImageSize: [20,23],
		iconImageOffset: [-10, -23],
		iconShadow: true,
		balloonContentLayout:  'my#tplStandardObj',
		}
		);
	objectPlacemark.events
		.add('balloonopen', function () 
			{			});
	return objectPlacemark;
	}
	