function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
/**********************************шаблоны***********************************************************/	
/************************************** styleAdr *******************************************************/
var templateAdr = new YMaps.Template(
"<div>Адрес: <font color='green'>$[adr]</font></div><div id='adrActions'>" + 
"<div id='adrCorrectAll'> Адрес и позиция верны?  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>" + 
"<div id='adrCorrectPosition'> Позиция указана верно, а адрес нет? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; autocompleteStrUpdate();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Ввести адрес вручную</span></div>" + 
"<div id='adrInCorrectPosition'> Позиция указана неверно? <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Переместить метку</span></div>" + 
"</div>" + 
"<div style='display:none;' id='adrHandle'><b>Укажите правильный адрес:</b><br /> Улица&nbsp; <input type='text' id='streetHand' name='streetHand' class='streetHand' style='width:150px;' value='$[street]' /> Строение №&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[bld]' />  &nbsp;<span onClick='saveAll();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>"
);
var styleAdr = new YMaps.Style();
styleAdr.iconStyle = new YMaps.IconStyle();
styleAdr.iconStyle.href = "/src/design/main/marker_1.png";
styleAdr.iconStyle.size = new YMaps.Point(29, 45);
styleAdr.iconStyle.offset = new YMaps.Point(-12, -44);
styleAdr.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateAdr
	);
styleAdr.hasHint = false;
/**************************************END of styleAdr *******************************************************/
/************************************** styleAdrMove *******************************************************/
var styleAdrMove = new YMaps.Style();
styleAdrMove.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template('<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>'));
styleAdrMove.hasHint = true;
styleAdrMove.hasBalloon = false;
styleAdrMove.hintContentStyle = new YMaps.HintContentStyle( new YMaps.Template('Переместите метку в нужное место на карте'));
/**************************************END of styleAdrMove *******************************************************/
/************************************** styleUpd *******************************************************/
var templateUpd = new YMaps.Template(
	"<div>Адрес: <font color='green'>$[adr|не определен]</font></div><div id='adrActions'>" + 
	"<div id='adrCorrectAll'> Адрес и позиция верны?  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>" + 
	"<div id='adrCorrectPosition'> Позиция указана верно, а адрес нет? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; autocompleteStrUpdate();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Ввести адрес вручную</span></div>" + 
	"<div id='adrInCorrectPosition'> Позиция указана неверно? <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Переместить метку</span></div>" + 
	"</div>" + 
	"<div style='display:none;' id='adrHandle'><b>Укажите правильный адрес:</b><br /> Улица&nbsp; <input type='text' id='streetHand' name='streetHand'  class='streetHand'  style='width:150px;' value='$[street]' /> Строение №&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[bld]' />  &nbsp;<span onClick='saveAll();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>"
	);	
var styleUpd = new YMaps.Style();
styleUpd.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateUpd
	);
styleUpd.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template('<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>'));
styleUpd.hasHint = true;
styleUpd.hasCloseBalloon = false;
styleUpd.hintContentStyle = new YMaps.HintContentStyle( new YMaps.Template('Переместите метку в нужное место на карте'));
/**************************************END of styleUpd *******************************************************/
/**********************************END OF  шаблоны***********************************************************/	

function getResult(geocoder) 
	{
	// Точность: город, страна
	function isOther (result) 
		{
		return result.precision == "other";
		}
	// Точность: улица
	function isStreet (result) 
		{
		return result.precision == "street";
		}
	// Точность: дом
	function isHouse (result) 
		{
		return !isOther(result) && !isStreet(result);
		};
	// Выбирает точность поиска
	var filter = isHouse;
	if (map.getZoom() < 10) 
		{
		filter = isOther;			
		}
	else if (map.getZoom() < 15) 
		{
		filter = isStreet;		
		}
	return geocoder.filter(filter)[0];
	}

function getResultString(obj)
	{
	var textArr = obj.text.split(', ');
	var length = textArr.length;
	var adr = '';
//	alert (obj.kind + ' - ' + obj.text);
	if((textArr[2] == city)&&((obj.kind == 'house')||(obj.kind == 'street')||(obj.kind == 'district')))
		{
		var difStr = ((obj.kind == 'district')||(obj.kind == 'street')) ? 1 : 2;
		adr = textArr[length - difStr];
		street = textArr[length - difStr];
		if(obj.kind == 'house')
			{
			adr += ', ' + textArr[length - 1];
			bld = textArr[length - 1];
			}
		else
			bld = '';
		return adr;
		}
	else
		{
		bld = '';
		street = '';
		return '';
		}
	
	}
function showPointAdr(obj)
	{
	var res = getResultString(obj);
	if (res !='')
		{
		obj.adr = res;
		obj.street = street;
		obj.bld = bld;
		obj.setOptions({style:styleAdr, draggable: false});
		map.addOverlay(obj);		
		}
	else
		{
		map.removeOverlay(obj);
		alert('Записей не найдено');		
		}
	}

function getNewAdr(obj, placemark)
	{
	var clickPoint = obj.getGeoPoint();
	coord = clickPoint.copy();
	var geocoder = new YMaps.Geocoder(clickPoint);			
	YMaps.Events.observe(geocoder, geocoder.Events.Load, function (geocoder)
		{
		var geoResult = getResult(geocoder);
		if (geoResult) 
			{
			var adrStr = getResultString(geoResult);
			if(adrStr !='')
				{
				placemark.adr = adrStr;				
				placemark.street = street;
				placemark.bld = bld;
				placemark.setStyle(styleUpd);
				placemark.openBalloon();
				obj.update();
				}
			} 
		else 
			{
			alertPad = new YMAlert('По заданной позиции ничего не найдено, но вы можете сохранить позицию объекта и вручную задать адрес');
			map.addControl(alertPad);	
//			alert("");
			placemark.street = street;
			placemark.bld = bld;
			placemark.setStyle(styleUpd);
			placemark.openBalloon();
			obj.update();
			}
		placemark.setIconContent(null);
		});
// Обработчик неудачного геокодирования
	YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, err) 
		{
		alertPad = new YMAlert("Произошла ошибка при геокодировании: " + err + '. Вы можете сохранить позицию объекта и вручную задать адрес');
		map.addControl(alertPad);	
//		alert("Произошла ошибка при геокодировании: " + err + '. Вы можете сохранить позицию объекта и вручную задать адрес');
		bld = '';
		street = '';		
		placemark.setIconContent(null);
		});			
	}
function saveAll()
	{
//	alert(coord + ' - ' + street + ' - ' + bld );
	if(document.getElementById('streetHand'))
		{
		var street = document.getElementById('streetHand').value;
		var bld = document.getElementById('bldHand').value;		
		}	
	if(document.getElementById('object'))
		{
		$.post("/company/set/YMOfficeEdit", {pos:coord, str:street, bld:bld, curNode:object}, function(str) 
			{
//			alert(str);
			if(str!=0)
				{
				alertPad = new YMAlert("Новая позиция и адрес успешно сохранены. Для продолжения работы закройте окно редактирования адреса");
				pointAdr.adr = street + ' ' + bld;				
				pointAdr.street = street;
				pointAdr.bld = bld;
				pointAdr.setOptions({style:styleAdr, draggable: false});
				pointAdr.closeBalloon();
				}
			else
				alertPad = new YMAlert("Произошла ошибка при сохранении позиции. Повторите операцию");
			map.addControl(alertPad);	
			});	
		}
	else
		{
		$.post("/company/set/YMOfficeAdd", {pos:coord, str:street, bld:bld, curNode:firm}, function(str) 
			{
//		alert(str);
			if(str!=0)
				location.href=str;
			else
				{
				alertPad = new YMAlert("Произошла ошибка при сохранении позиции. Повторите операцию");
				map.addControl(alertPad);	
				}
//			alert('Произошла ошибка при сохранении позиции. Повторите операцию.')
//			alert(str);
			});	
		}
	}
function  autocompleteStrUpdate()
	{
	  $("#streetHand").autocomplete('/spddl/',
	    {
	    minChars:3,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:30,
		formatItem:formatStreet,
		extraParams:{type:"streets"}
//	cacheLength:0,
//    autoFill:false
	    }
	  );	
	}
function YMAlert (str) 
	{
// Обработчик добавления элемента на карту
	this.onAddToMap = function (map, position) 
		{
		this.container = YMaps.jQuery("<div style='text-align: center;'><div id='message'>" +  str  + "</div>" + 
				"<div id='close'> <input type='button' style='width:100px; margin-top:5px'  onClick='map.removeControl(alertPad);' value=' ОК '></div>" + 
				"</div>");
		this.map = map;
		var size = this.map.getContainerSize();
//		alert(size.x  + ' * ' + size.y);
		this.position = position || new
		YMaps.ControlPosition(YMaps.ControlPosition.TOP_RIGHT, new YMaps.Size(size.x/2 - 125,
		size.y/2 - 35));
		// CSS-свойства, определяющие внешний вид элемента
		this.container.css({
		position: "absolute",
		zIndex: YMaps.ZIndex.POPUP,
		background: '#D3D3D3',
		listStyle: 'none',
		padding: '10px',
		width: '250px',
		height: '70px',
		border: 'solid 1px #ccc',
		borderStyle: 'outset',
		margin: 0,
		cursor: 'default'
		});
		// Располагает элемент управления в верхнем правом углу карты
		this.position.apply(this.container);
		// Добавляет элемент управления на карту
		this.container.appendTo(this.map.getContainer());		
	}
// Обработчик удаления элемента с карты
	this.onRemoveFromMap = function () 
		{
		if (this.container.parent()) 
			{
			this.container.remove();
			this.container = null;
			}
		this.map = null;		
		}
	}
	