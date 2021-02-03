var myMap;
var pCount = 1;	
var searchCntrl;
var newObjectVar;
var newObjectPlacemark, movedObjectPlacemark;
var point  = new Array();
var placemark = new Array();
var objCollection;
var imgSizePrew = 90;
var imgSizeView = 600;
var imgSizeFull = 1024;
var imgGallery = new Array();
function pleaseWait(start)
	{
/*	if( start )
		alert('wait!!!');*/
	}
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
/*
function setimgGallery(title, href)
	{
	this.title = title;
	this.href = href;
	}*/
function moveObj(objId)
	{	
	var object, objProp;
	newObjectVar = new newObject();
	var iterator = objCollection.getIterator();	
	while (object = iterator.getNext()) 
		{
		objProp = object.properties.getAll();
		if(objProp.objId == objId)
			{
			movedObjectPlacemark = object;
			movedObjectPlacemark.balloon.close();
			changePlacemarkStyle(movedObjectPlacemark, 3);
			break;
			}
		}
	}
function setpointImg(path, fileName, imgAbout)
	{
	this.fileName = fileName;
	this.path = path;
	this.imgAbout = imgAbout;
	}
function setpointLayers(title, id)
	{
	this.title = title;
	this.id = id;
	}
function setPoint(number, objId, firmId, firmName, x, y, adr, phone, layers, img) //поля метки для объекта
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
	this.layers = new Array();	
	this.img = new Array();	
	var tmpArr;		
	var cnt = 0;
	var tmpStr = '';
	for(var i=0; i<layers.length; i++)	
	if (layers[i] !='')
		{
		if(i==0)
			tmpStr += '<div id="layerStr">'
		tmpArr = layers[i].split('$$');
		this.layers[cnt] = new setpointLayers(tmpArr[0], tmpArr[1]);
		tmpStr += '<span class="layer" id="layerBaloon_' + tmpArr[1] + '"  onClick="clickLayer(this, 0);" >' + tmpArr[0] + '</span>';
		cnt ++;
		}
	if(tmpStr!='')
		tmpStr += '</div>';		
	this.layerSting = tmpStr;		
	cnt = 0;
	var tmpStr = '';
	for(var i=0; i<img.length; i++)
	if (img[i] !='')
		{
		if(i==0)
			tmpStr += '<div id="imgStr">'		
		if(i<30)
			{
			tmpArr = img[i].split('^^');
			this.img[cnt] = new setpointImg(tmpArr[0], tmpArr[1], tmpArr[2]);
	//		tmpStr += '<span class="imgBaloon" id="imgBaloonSpan_' + tmpArr[0] + imgSizeFull + '/' + tmpArr[1] + '_' + tmpArr[2] + '"><a  class="imgBaloonLink" href = "'
			tmpStr += '<a  class="imgBaloonLink" rel="gallery" href = "'
												+ tmpArr[0] + imgSizeView + '/' + tmpArr[1] + '" title = "' +  tmpArr[2] + '" target="_blank"><img id = "imgBaloonPrew_' + tmpArr[1] + '" src="' 
												+ tmpArr[0] + imgSizePrew + '/' + tmpArr[1] + '" ></a>';
			}			
/*		if(i==3)
			{
			tmpStr += '</br><a  class="galleryOpen" href="javascript:;">Смотреть все (' + img.length + ')</a>'
			}
		imgGallery[i] = setimgGallery(tmpArr[2], tmpArr[0] + imgSizePrew + '/' + tmpArr[1]);*/
		cnt ++;
		}
	if(tmpStr!='')
		tmpStr += '</div>';		
	this.imgSting = tmpStr;	
	tmpStr = '';
	if(mngActions)
		{
//		alert(showProperties(mngActions, 'mng'));
		tmpStr += '<div id = "mngStr">';
		tmpStr += '<span class="mngAct" id="oe"  onClick="showEdtBox(\'' + mngActions.oe + objId + '\', 0)"><nobr>редактировать объект</nobr></span>';
		tmpStr += '<span class="mngAct" id="od"  onClick="showEdtBox(\'' + mngActions.od + objId + '\', 0)"><nobr>удалить объект</nobr></span></br>';
		tmpStr += '<span class="mngAct" id="fe"  onClick="moveObj(\'' + objId + '\')"><nobr>Изменить позицию</nobr></span>';
//		tmpStr += '<span class="mngAct" id="fd"  onClick="showEdtBox(\'' + mngActions.fd + firmId + '\', 0)"><nobr>удалить организацию</nobr></span>';
		tmpStr += '</div>';
		}
	this.mngSting = tmpStr;
	}
function newObject() 
	{
    this.text = '';
    this.coordinates = '';
	this.adr = '';
	}
	
	
//"<div style=\"\"><strong>$[name]</strong></div><div style=\"margin:10px\">$[layers]</div><div>Адрес: $[adr|-]</div><div>Телефон: $[phone|-]</div>"
function createObjectPlacemark(obj) //создает метку объекта
	{
//	alert(obj.coordinates);
	var objectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		hintContent: obj.firmName,
//		iconContent: '<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>',
		firmName: obj.firmName,
		firmId: obj.firmId,
		objId: obj.objId,
		adress: obj.adr,
		phone: obj.phone,
		layerSting: obj.layerSting,
		imgSting: obj.imgSting,
		mngSting: obj.mngSting,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		balloonContentLayout:  'my#tplStandardObj',
//		preset: 'twirl#redIcon'
		preset: 'twirl#nightStretchyIcon'
		}
		);
	objectPlacemark.events
		.add('balloonopen', function () 
			{
			$('.imgBaloonLink').fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,
				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					},
//					buttons	: {},
					thumbs : {
						width: 50,
						height: 50
					} 					
				}
			});
			document.getElementById('objId').value = obj.objId;
//			$('objId').value = obj.objId;
			});
//	myMap.geoObjects.add(newObjectPlacemark);				
//	pCount ++;
	return objectPlacemark;
	}
function getObjects(spdlType, paramId, city, show) //получение объектов с сервера и добавление их в геоколлекцию
	{
	var city = document.getElementById('cityId').value;
	$.post("/spddl/", {type:spdlType, object:paramId, city:city}, function(str) 
		{
		var strArr = str.split('~~');
		var valArr, layerArr, imgArr;	
		var pointCnt = 0;
		for(var i=0; i<strArr.length;  i++ )
			{
			if(strArr[i]!='')
				{
				valArr = strArr[i].split('##');
				if(valArr.length>1)
					{
					layerArr = valArr[8].split('%%');
					imgArr = valArr[9].split('@@');
					point[pointCnt] =  new setPoint(valArr[1], valArr[0], valArr[5], valArr[4], valArr[2], valArr[3], valArr[6], valArr[7], layerArr, imgArr);
					objCollection.add(createObjectPlacemark(point[pointCnt]));
					pointCnt ++;
					}				
				}
			}
		if(show)
			{
			myMap.geoObjects.add(objCollection);	
			if(objCollection.getLength() > 1)
				myMap.setBounds(objCollection.getBounds());
			else
				myMap.setCenter(point[0].coordinates);	
			}
		});	
	}
function showObject(objId, openBaloon) //показать единичный объект
	{
	if(objCollection.getLength())
		{
		point = new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	getObjects('mapSingleObj', objId, document.getElementById('cityId').value, 1); 
/*	if(openBaloon > 0)
		{
		var object;
		var iterator = objCollection.getIterator();
		while (object = iterator.getNext()) {
		object.balloon.open();
		break;
		}
		}*/
//	.balloon.open();
	}
function clickLayer(layer)
	{
	if(objCollection.getLength())
		{
		point = new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	var layer_id = GetStrPrt(layer.id, '_', 1);
	getObjects('mapLayerObjects', layer_id, document.getElementById('cityId').value, 1); 
	}
function createSearchControl(map) 
	{
	var searchCntrl = new map.control.SearchControl({useMapBounds: 'true', noPlacemark: 'true' });
//	var state = new ymaps.data.Manager();
	searchCntrl.events
		.add('resultselect', function () 
			{
			searchCntrl.getResult(searchCntrl.getSelectedIndex()).then(function (result) {
			newObjectVar.text = result.properties.get('text');
			newObjectVar.adr = 	getResultAdrFromString(result.properties.get('text'));			
			newObjectVar.coordinates = result.geometry.getCoordinates();
			createNewObjectPlacemark(newObjectVar);
			});
			});
	return searchCntrl;
	}
function createNewObjectPlacemark(obj) 
	{
	newObjectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		hintContent: 'Новый объект',
//		iconContent: '<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>',
		adrStreet: obj.adr.street,
		adrCity: obj.adr.city,
		adrBld: obj.adr.bld,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		balloonContentLayout:  'my#tplNewObj1',
		preset: 'twirl#nightIcon'
//		preset: 'twirl#nightStretchyIcon'
		}
		);
	newObjectPlacemark.events
		.add('balloonopen', function () 
			{
			searchCntrl.collapse();
			});
	myMap.geoObjects.add(newObjectPlacemark);				
//	pCount ++;
	}
function MyBehavior()
	{
    // Определим свойства класса
    this.options = new ymaps.option.Manager(); // Менеджер опций
    this.events = new ymaps.event.Manager(); // Менеджер событий
	}

// Определим методы
MyBehavior.prototype = 
	{
    constructor: MyBehavior,
    // Когда поведение будет включено, добавится событие щелчка на карту
    enable: function () 
		{
		this._parent.getMap().events.add('click', this._onClick, this);
		},
    disable: function () 
		{
        this._parent.getMap().events.remove('click', this._onClick, this);
		},
    setParent: function (parent) { this._parent = parent; },
    getParent: function () { return this._parent; },
    _onClick: function (e) 
		{
        var coords = e.get('coordPosition');
        this._parent.getMap().setCenter(coords);
		}
	};

function init() 
	{
	myMap = new ymaps.Map("YMapsID", 
		{				
		center: [52.289422, 104.280633],
		zoom: 11//,
	//				, type: "yandex#satellite"
		});
	var myButton = new ymaps.control.Button({
		data: {
			content: 'Новый объект',
			title: ''
		}
	}, {
//		selectOnClick: false
	   }
	);
	myButton.events
/*		.add('click', function () 
			{
			////
			})*/
		.add('select', function () 
			{
//			alert(myButton.state.get('selected'));
			newObjectVar = new newObject();
			searchCntrl = createSearchControl(ymaps);
			myMap.controls.add(searchCntrl, {
							right: '5',
							top: '100'});

			})
		.add('deselect', function () 
			{
			myMap.controls.remove(searchCntrl);
			myMap.geoObjects.remove(newObjectPlacemark);
			});

	myMap.controls.add('mapTools');
	myMap.controls.add('typeSelector');
	myMap.controls.add('zoomControl');	
	myMap.copyrights.add('&copy; Город-детям.рф');
//	myMap.geoObjects.add(myPlacemark);			
	myMap.controls.add(myButton, {
                    right: '5',
                    top: '50'});
	ymaps.behavior.storage.add('mybehavior', MyBehavior);
	myMap.behaviors.enable('mybehavior');	
	
	var myBalloonContentLayoutClass = ymaps.templateLayoutFactory.createClass(
		'<h3>$[properties.balloonContentHeader]</h3>' +
		'<p>Адрес: $[properties.adrCity], $[properties.adrStreet]  $[properties.adrBld]</p>' +
		'<p>Координаты: <strong>$[properties.coordStr]</strong></p>' 
		);

	var tplNewObj1 = ymaps.templateLayoutFactory.createClass(
		"<div>Адрес: <font color='green'>$[properties.adrCity], $[properties.adrStreet]  $[properties.adrBld]</font></div><div id='adrActions'>" + 
		"<div id='adrCorrectAll'> Адрес и позиция верны?  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>" + 
		"<div id='adrCorrectPosition'> Позиция указана верно, а адрес нет? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; /*autocompleteStrUpdate();*/'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Ввести адрес вручную</span></div>" + 
		"<div id='adrInCorrectPosition'> Позиция указана неверно? <span onClick='newObjectPlacemark.balloon.close(); changePlacemarkStyle(newObjectPlacemark, \"2\"); ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Переместить метку</span></div>" + 
		"</div>" + 
		"<div style='display:none;' id='adrHandle'><b>Укажите правильный адрес:</b><br /> Улица&nbsp; <input type='text' id='streetHand' name='streetHand' class='streetHand' style='width:150px;' value='$[properties.adrStreet]' /> Строение №&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[properties.adrBld]' />  &nbsp;<span onClick='saveAll();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>"
		);	
	var tplStandardObjMove = ymaps.templateLayoutFactory.createClass(
		"<div>Адрес: <font color='green'>$[properties.adrCity], $[properties.adrStreet]  $[properties.adrBld]</font></div><div id='adrActions'>" + 
		"<div id='adrCorrectAll'> Адрес и позиция верны?  - <span onClick='saveMove();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>" + 
		"<div id='adrCorrectPosition'> Позиция указана верно, а адрес нет? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; /*autocompleteStrUpdate();*/'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Ввести адрес вручную</span></div>" + 
		"<div id='adrInCorrectPosition'> Позиция указана неверно? <span onClick='movedObjectPlacemark.balloon.close(); changePlacemarkStyle(movedObjectPlacemark, \"3\"); ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Переместить метку</span></div>" + 
		"</div>" + 
		"<div style='display:none;' id='adrHandle'><b>Укажите правильный адрес:</b><br /> Улица&nbsp; <input type='text' id='streetHand' name='streetHand' class='streetHand' style='width:150px;' value='$[properties.adrStreet]' /> Строение №&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[properties.adrBld]' />  &nbsp;<span onClick='saveMove();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>"
		);
	var tplStandardObj = ymaps.templateLayoutFactory.createClass(
		"<div id='baloonPad'><div id='firmName'>$[properties.firmName]</div><div id='adrActions'>" + 
		"<div id='adr'>$[properties.adress]</div>" + 
		"<div id='phone'>$[properties.phone]</div></div>" + 
		"$[properties.layerSting]" + 
		"$[properties.imgSting]" + 
		"$[properties.mngSting]"+
		""		
		);
		

//style:styleAdrMove, 
	ymaps.layout.storage.add('my#simplestBCLayout', myBalloonContentLayoutClass);	
	ymaps.layout.storage.add('my#tplNewObj1', tplNewObj1);	
	ymaps.layout.storage.add('my#tplStandardObj', tplStandardObj);	
	ymaps.layout.storage.add('my#tplStandardObjMove', tplStandardObjMove);	
	
	objCollection = new ymaps.GeoObjectCollection();
	
//	$(".imgBaloonLink").colorbox({rel:'imgBaloonLink'});

	}

function saveMove()
	{
	
	if((document.getElementById('adrHandle').style.display!='none')&&(document.getElementById('streetHand')!='undefined'))
		{
		newObjectVar.adr.street = 	document.getElementById('streetHand').value;
		newObjectVar.adr.bld = 		document.getElementById('bldHand').value;
//		alert(document.getElementById('streetHand').value);
//		alert(showProperties(newObjectVar, 'ww'));
		}
//	movedObjectPlacemark.options.set('balloonContentLayout', 	'my#tplStandardObjMove');
	movedObjectPlacemark.properties.set('adress', 	newObjectVar.adr.street + ', ' + newObjectVar.adr.bld);
	pleaseWait(1);
	var objProp = movedObjectPlacemark.properties.getAll();
	$.post("/map/set/movObj", {objId:objProp.objId, obj:newObjectVar}, function(str) 
		{
		pleaseWait(0);
		movedObjectPlacemark.options.set('balloonContentLayout', 	'my#tplStandardObj');
		movedObjectPlacemark.balloon.open();
		});	
	}
function saveAll()
	{
//	alert(coord + ' - ' + street + ' - ' + bld );
	if(document.getElementById('streetHand'))
		{
		newObjectVar.adr.street = document.getElementById('streetHand').value;
		newObjectVar.adr.bld = document.getElementById('bldHand').value;
		newObjectPlacemark.properties.set('adrStreet', 	newObjectVar.adr.street);
		newObjectPlacemark.properties.set('adrBld', 	newObjectVar.adr.bld);
		newObjectPlacemark.options.set('balloonContentLayout', 	'my#tplNewObj1');
		}
	$.post("/map/set/addObjStep1", {obj:newObjectVar}, function(str) 
		{
		var resArr = str.split('<cut>');
		if(resArr[0]>0)
			{
//			alert(resArr);
			var url = '/map/objDet/' + resArr[1];
			showEdtBox(url, 0);
			}
		else
			{
			alert(resArr[1]);
			}
//		showEdtBox(0, 0, 0);
/*		alert(str);
		newObjectPlacemark.options.set('balloonContentLayout', 	'my#tplNewObj2');*/
		});	
	}

function changePlacemarkStyle(obj, style)
	{
	if(style == 2) //изменение позиции для нового объекта
		{
		obj.options.set('draggable', 'true');
		obj.properties.set('iconContent', '<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>');
		obj.properties.set('hintContent', 'Переместите метку в нужное место');
		obj.options.set('preset', 'twirl#nightStretchyIcon');
		obj.events
		.add('dragend', function () 
			{
			newObjectVar.coordinates = obj.geometry.getCoordinates();
			obj.balloon.open();
			});		
		}
	if(style == 3) //изменение позиции для готовых
		{
		obj.properties.set('adrStreet', obj.properties.get('adress'));
		obj.options.set('draggable', 'true');
		obj.properties.set('iconContent', '<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>');
		obj.properties.set('hintContent', 'Переместите метку в нужное место');
		obj.options.set('preset', 'twirl#nightStretchyIcon');
		obj.options.set('balloonContentLayout',  'my#tplStandardObjMove');
		obj.events
		.add('dragend', function () 
			{
			pleaseWait(1);
			newObjectVar.coordinates = obj.geometry.getCoordinates();
			var myGeocoder = ymaps.geocode(obj.geometry.getCoordinates(), 'coord');
			myGeocoder.then(
            function (res) {
				pleaseWait(0);
				var findedObj = res.geoObjects.get(0);
				var findedObjProp = findedObj.properties.getAll();
				newObjectVar.adr = getResultAdrFromString(findedObjProp.text);
				obj.properties.set('adrStreet', newObjectVar.adr.street);
				obj.properties.set('adrCity', newObjectVar.adr.city);
				obj.properties.set('adrBld', newObjectVar.adr.bld);
				obj.balloon.open();
				});});		
		}
	}
function getResultAdrFromString(txt)
	{
//	Россия, Иркутская область, Иркутск, улица Гоголя, 15/1
	var retStr = new function ret() 
		{
		this.city = '';
		this.street = '';
		this.bld = '';
		}
	var textArr = txt.split(', ');
	var length = textArr.length;
	if(length>=3)
		{
		if(textArr[length-1].indexOf(' ') > 0)
			{
			retStr.bld = '';
			retStr.street = textArr[length-1];
			retStr.city = textArr[length-2];		
			}
		else
			{
			retStr.bld = textArr[length-1];
			retStr.street = textArr[length-2];
			retStr.city = textArr[length-3];		
			}
		}
	return retStr;		
	}
function showEdtBox(url, type)
	{
//	 alert(showProperties(objCollection, 'objCollection'));
	var curObjId = document.getElementById('objId').value;
	var info = 'Редактор объекта';
//	var iterator, object;
	return GB_showFullScreen(info, url, function(){		showObject(curObjId, 1); });	
	}	