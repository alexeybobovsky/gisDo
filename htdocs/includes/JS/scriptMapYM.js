function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
/**********************************�������***********************************************************/	
/************************************** styleAdr *******************************************************/
var templateAdr = new YMaps.Template(
"<div>�����: <font color='green'>$[adr]</font></div><div id='adrActions'>" + 
"<div id='adrCorrectAll'> ����� � ������� �����?  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>" + 
"<div id='adrCorrectPosition'> ������� ������� �����, � ����� ���? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; autocompleteStrUpdate();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>������ ����� �������</span></div>" + 
"<div id='adrInCorrectPosition'> ������� ������� �������? <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>����������� �����</span></div>" + 
"</div>" + 
"<div style='display:none;' id='adrHandle'><b>������� ���������� �����:</b><br /> �����&nbsp; <input type='text' id='streetHand' name='streetHand' class='streetHand' style='width:150px;' value='$[street]' /> �������� �&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[bld]' />  &nbsp;<span onClick='saveAll();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>"
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
styleAdrMove.hintContentStyle = new YMaps.HintContentStyle( new YMaps.Template('����������� ����� � ������ ����� �� �����'));
/**************************************END of styleAdrMove *******************************************************/
/************************************** styleUpd *******************************************************/
var templateUpd = new YMaps.Template(
	"<div>�����: <font color='green'>$[adr|�� ���������]</font></div><div id='adrActions'>" + 
	"<div id='adrCorrectAll'> ����� � ������� �����?  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>" + 
	"<div id='adrCorrectPosition'> ������� ������� �����, � ����� ���? - <span onClick='document.getElementById(\"adrHandle\").style.display = \"\"; document.getElementById(\"adrActions\").style.display = \"none\"; autocompleteStrUpdate();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>������ ����� �������</span></div>" + 
	"<div id='adrInCorrectPosition'> ������� ������� �������? <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>����������� �����</span></div>" + 
	"</div>" + 
	"<div style='display:none;' id='adrHandle'><b>������� ���������� �����:</b><br /> �����&nbsp; <input type='text' id='streetHand' name='streetHand'  class='streetHand'  style='width:150px;' value='$[street]' /> �������� �&nbsp;<input type='text' id='bldHand' name='bldHand' style='width:50px;' value='$[bld]' />  &nbsp;<span onClick='saveAll();'  style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>"
	);	
var styleUpd = new YMaps.Style();
styleUpd.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateUpd
	);
styleUpd.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template('<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>'));
styleUpd.hasHint = true;
styleUpd.hasCloseBalloon = false;
styleUpd.hintContentStyle = new YMaps.HintContentStyle( new YMaps.Template('����������� ����� � ������ ����� �� �����'));
/**************************************END of styleUpd *******************************************************/
/**********************************END OF  �������***********************************************************/	

function getResult(geocoder) 
	{
	// ��������: �����, ������
	function isOther (result) 
		{
		return result.precision == "other";
		}
	// ��������: �����
	function isStreet (result) 
		{
		return result.precision == "street";
		}
	// ��������: ���
	function isHouse (result) 
		{
		return !isOther(result) && !isStreet(result);
		};
	// �������� �������� ������
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
		alert('������� �� �������');		
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
			alertPad = new YMAlert('�� �������� ������� ������ �� �������, �� �� ������ ��������� ������� ������� � ������� ������ �����');
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
// ���������� ���������� ��������������
	YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, err) 
		{
		alertPad = new YMAlert("��������� ������ ��� ��������������: " + err + '. �� ������ ��������� ������� ������� � ������� ������ �����');
		map.addControl(alertPad);	
//		alert("��������� ������ ��� ��������������: " + err + '. �� ������ ��������� ������� ������� � ������� ������ �����');
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
				alertPad = new YMAlert("����� ������� � ����� ������� ���������. ��� ����������� ������ �������� ���� �������������� ������");
				pointAdr.adr = street + ' ' + bld;				
				pointAdr.street = street;
				pointAdr.bld = bld;
				pointAdr.setOptions({style:styleAdr, draggable: false});
				pointAdr.closeBalloon();
				}
			else
				alertPad = new YMAlert("��������� ������ ��� ���������� �������. ��������� ��������");
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
				alertPad = new YMAlert("��������� ������ ��� ���������� �������. ��������� ��������");
				map.addControl(alertPad);	
				}
//			alert('��������� ������ ��� ���������� �������. ��������� ��������.')
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
// ���������� ���������� �������� �� �����
	this.onAddToMap = function (map, position) 
		{
		this.container = YMaps.jQuery("<div style='text-align: center;'><div id='message'>" +  str  + "</div>" + 
				"<div id='close'> <input type='button' style='width:100px; margin-top:5px'  onClick='map.removeControl(alertPad);' value=' �� '></div>" + 
				"</div>");
		this.map = map;
		var size = this.map.getContainerSize();
//		alert(size.x  + ' * ' + size.y);
		this.position = position || new
		YMaps.ControlPosition(YMaps.ControlPosition.TOP_RIGHT, new YMaps.Size(size.x/2 - 125,
		size.y/2 - 35));
		// CSS-��������, ������������ ������� ��� ��������
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
		// ����������� ������� ���������� � ������� ������ ���� �����
		this.position.apply(this.container);
		// ��������� ������� ���������� �� �����
		this.container.appendTo(this.map.getContainer());		
	}
// ���������� �������� �������� � �����
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
	