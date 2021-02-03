var searchCntrl;
var newObjectVar;
var newObjectPlacemark, movedObjectPlacemark;
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function delObj(url)
	{	
	var curObjId = document.getElementById('objId').value;	
	if(confirm('Точно удалить объект?'))
		{
		UI.pleaseWait();
		$.post(url, {objId:$('#objId').val()}, function(str)
			{
			UI.pleaseWait();
//			alert(str);	
			if(str == 1) //всё отлично - удалено
				{
				UI.showMessage('info', 'Объект успешно удален. Обновите страницу');				
				}
			else if(str == 2) //ошибка
				{
				UI.showMessage('info', 'Какая-то ошибка.');				
				}
			else 			//последний объект
				{
				if(confirm('Внимание! Это последний объект в организации и его удаление удалит всю организацию. Вы уверенны?'))
					{
					UI.pleaseWait();
					$.post(url, {objId:$('#objId').val(), addParam:str}, function(str)
						{
						UI.pleaseWait();
						if(str == 1) //всё отлично - удалено
							{
							UI.showMessage('info', 'Организация успешно удалена ПОЛНОСТЬЮ. Обновите страницу');				
							}
						else if(str == 2) //ошибка
							{
							UI.showMessage('info', 'Какая-то ошибка с организвцией.');
							}
						});
					}
				}
			});
		}
	}
function moveObj(objType, objId)
	{	
	var object, objProp;
	newObjectVar = new newObject();
	var iterator = objCollection.getIterator();	
	while (object = iterator.getNext()) 
		{
		objProp = object.properties.getAll();
		if((objProp.objType == objType)&&(objProp.objId == objId))
			{
			movedObjectPlacemark = object;
			movedObjectPlacemark.balloon.close();
			changePlacemarkStyle(movedObjectPlacemark, 3);
			break;
			}
		}
	}
function newObject() 
	{
    this.text = '';
    this.coordinates = '';
	this.adr = '';
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
	UI.pleaseWait();
	var objProp = movedObjectPlacemark.properties.getAll();
	$.post("/map/set/movObj", {objId:objProp.objId, objType:objProp.objType, obj:newObjectVar}, function(str) 
		{
		UI.pleaseWait();
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
	
	
function showEditedObject()
	{
	var curObjId = document.getElementById('objId').value;
	var curObjType = document.getElementById('objType').value;
	if(curObjId == '')
		{
		$.post("/spddl/", {type:'getNewObj'}, function(str) 
			{
			var resArr = str.split('_');
			curObjId = resArr[1];
			curObjType = resArr[0];
			document.getElementById('objId').value = curObjId;
			document.getElementById('objType').value = curObjType;
			});	
		}
	showObject(curObjId, curObjType,  1); 
	}
function showList_Service(type)
	{
//	var curObjId = 1;
//	var curObjType = 'firm';
//	showObject(curObjId, curObjType,  1); 
	
	$.post("/spddl/", {type:'list_SRVC', objType:type}, function(str) 
		{
		var contaner = document.getElementById('objListContaner');
		var objId, objName, oDiv;
		contaner.innerHTML = '';						
		var strArr = str.split('~~');
		if(strArr.length > 0)
			{
			for(var i=0; i<strArr.length;  i++ )
				{										
				valArr = strArr[i].split('##');
				if(valArr.length>1)
					{
					objId = valArr[0];
					objName = valArr[1];
					oDiv = document.createElement("DIV");				
					oDiv.id = 'objSrvc_' + objId;
					oDiv.innerHTML = objId + '. '+ objName;
					oDiv.onclick = function(){	
							var id = GetStrPrt(this.id, '_', 1)
							showObject(id, type,  1); 
							
							};
					contaner.appendChild(oDiv);	
					}
				}
			}

		$('#ObjListSrvc').css({'display' : 'block'});
//		$('#objListContaner').html(str);
		});	
	}
function testSpddl()
	{
	$.post("/spddl/", {type:'jsonTest'}, function(str) 
		{
		/*
		var resArr = str.split('_');
		curObjId = resArr[1];
		curObjType = resArr[0];
		*/
//			curPar = GetStrPrt(str, '_', indx)		
//		alert(str);
		var obj = jQuery.parseJSON(str);
		alert(showProperties(obj, 'json'));
		/*
		alert('from testSpddl - curObjId = ' + curObjId + ';curObjType = ' + curObjType);
		showObject(curObjId, curObjType,  1); */
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
			UI.pleaseWait();
			newObjectVar.coordinates = obj.geometry.getCoordinates();
			var myGeocoder = ymaps.geocode(obj.geometry.getCoordinates(), 'coord');
			myGeocoder.then(
            function (res) {
				UI.pleaseWait();
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
//	Россия, Иркутск, микрорайон Университетский, улица Юрия Тена
//	Россия, Иркутск, микрорайон Университетский, улица Юрия Тена, 15
//	Россия, Иркутская область, Иркутск, Первомайский микрорайон, 45
//	Россия, Иркутская область, Иркутск, Университетский микрорайон, 60
//	Россия, Иркутск, микрорайон Радужный, Индустриальная улица
//	Россия, Иркутск, микрорайон Радужный, улица Левитана 
	var ext = new Array();	
	ext[0] = 'Юрия Тена';
	ext[1] = 'Индустриальная улица';
	ext[2] = 'улица Вампилова';
	ext[3] = 'улица Мамина-Сибиряка';
	ext[4] = 'улица Левитана';
	ext[5] = 'Алмазная улица';
	ext[6] = 'улица Калинина';
	ext[7] = 'улица Афанасьева';
	var retStr = new function ret() 
		{
		this.city = '';
		this.street = '';
		this.bld = '';
		}
//	var ext = 'Юрия Тена';
	var extType = 0;
	var textArr = txt.split(', ');
	var length = textArr.length;
	var cityIndx = streetIndx = bldIndx = 0;
	if(length>=3)
		{
		for(var i = 1; i< ext.length; i++)
			if(txt.indexOf(ext[i]) > 0)
				{
				extType = 1;
				}
		if(textArr[length-1].indexOf(' ') > 0)
			{
			retStr.bld = '';
			retStr.street = textArr[length-1];
			retStr.city = (extType == 1) ?  textArr[length-3] : textArr[length-2];		
			}
		else
			{
			retStr.bld = textArr[length-1];
			retStr.street = textArr[length-2];
			retStr.city = (extType == 1) ? textArr[length-4] : textArr[length-3];		
			}
		}
	return retStr;		
	}
function showEdtBox(url, type)
	{
//	alert(url);
//	 alert(showProperties(objCollection, 'objCollection'));
	var info = 'Редактор объекта';
//	var iterator, object;
	return GB_showFullScreen(info, url, function()
		{ 
		showEditedObject(); 
		});	
	}	
/*
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
*/	
function initAdm()
	{
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
	myMap.controls.add(myButton, {
                    right: '5',
                    top: '50'});
/*	ymaps.behavior.storage.add('mybehavior', MyBehavior);
	myMap.behaviors.enable('mybehavior');	
*/	
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

	ymaps.layout.storage.add('my#simplestBCLayout', myBalloonContentLayoutClass);	
	ymaps.layout.storage.add('my#tplNewObj1', tplNewObj1);	
	ymaps.layout.storage.add('my#tplStandardObjMove', tplStandardObjMove);	
		
	
	}