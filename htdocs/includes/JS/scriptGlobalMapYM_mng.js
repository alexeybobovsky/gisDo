/**********************************�������***********************************************************/	
/************************************** styleAdr *******************************************************/
var templateAdr = new YMaps.Template(
"<div id='adrActions'>" + 
"<div id='adrCorrectAll'> ������� �����  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>" + 
"<div id='adrInCorrectPosition'> ������� ������� - <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>����������� �����</span></div>" + 
"</div>" );
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
/************************************** styleFinal *******************************************************/
var templateFinal = new YMaps.Template(
"<div id='adrActions'> ������� ������� $[position]"+
"<div id='adrInCorrectPosition'> ���������� ������������ - <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>����������� �����</span></div>" + 
"</div>" );
var styleFinal = new YMaps.Style();
styleFinal.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template('<div>������� ������� <strong>$[position]</strong></div>'));
styleFinal.balloonContentStyle = new YMaps.BalloonContentStyle
	(
	templateFinal
	);
styleFinal.hasHint = false;
/**************************************END of styleFinal *******************************************************/

/************************************** styleAdrMove *******************************************************/
var styleAdrMove = new YMaps.Style();
styleAdrMove.iconContentStyle = new YMaps.IconContentStyle(new YMaps.Template('<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>'));
styleAdrMove.hasHint = true;
styleAdrMove.hasBalloon = false;
styleAdrMove.hintContentStyle = new YMaps.HintContentStyle( new YMaps.Template('����������� ����� � ������ ����� �� �����'));
/**************************************END of styleAdrMove *******************************************************/
/************************************** styleUpd *******************************************************/
var templateUpd = new YMaps.Template(
	"<div id='adrActions'>" + 
	"<div id='adrCorrectAll'> ������� �����  - <span onClick='saveAll();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>���������</span></div>" + 
	"<div id='adrInCorrectPosition'> ������� ������� - <span onClick='pointAdr.closeBalloon(); pointAdr.setOptions({style:styleAdrMove, draggable: true});; ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>����������� �����</span></div>" + 
	"</div>");	
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
var pointAdr;
var btnAddPoint = new YMaps.ToolBarButton({ 
    caption: "�������� �����", 
    hint: "��������� ����� � ����� �����"
});
var toolbar = new YMaps.ToolBar();		
var searchControl = new YMaps.SearchControl
	({
	resultsPerPage: 2, // ���������� �������� �� ��������
	useMapBounds: 1, // �������, ��������� � ������� ������� �����
	noCentering: false,
	noPlacemark: true
	});
function delObj(object)
	{
	if (confirm('������� ������?'))
		{
		var action = '/map/set/delSObj/';		
		var selectedLayer = document.getElementById(document.getElementById('selectedLayer').value);
		if (object.id)
			{
			$.post(action, 
				{
				node: GetStrPrt(object.id, '_', 1),
				}, function(str) 
				{
//			alert(str);
				if(str == 0) 
					{
					alert('������ ������� ������!');
					clickSLayer(selectedLayer);					
					}
				else  
					{
					alert('�������� �������������� ������! �� ������� ������� ������. [' + str + ']. ���������� ��������� �������� �����');
					}
				});			

			}
		}
	else
		return 0;	
	}
function showEdtBox(object, action, type)
	{
	var selectedLayer = document.getElementById(document.getElementById('selectedLayer').value);
//	clickSLayer(obj)
	if (object.id)
		{
		var node = GetStrPrt(object.id, '_', 1);
		var info = '�������� �������';
		var url = action+node;
		if (type)
			url += '/' + type;
//		var type = type;
//		alert(url + ' '+ object.id);
		}
	else
		{		
		var info = '�������� �������';
		}
	return GB_showFullScreen(info, url, function(){clickSLayer(selectedLayer);/* clickSObj(object);*/});	
	}
function saveAll() 
	{
	map.removeControl(toolbar);
//	var toolbar = new YMaps.ToolBar();
	toolbar.remove(btnAddPoint);
	map.addControl(toolbar);
	
	map.removeControl(searchControl);
	pointAdr.setOptions({style:styleFinal, draggable: false});	
	pointAdr.position = pointAdr.getGeoPoint().copy();
	pointAdr.closeBalloon();
	}
function pickYMPoint() /*������ ��� �������� �����*/
	{
/*	alertPad = new YMAlert('��� ������ ������, ������� ����� ����� � ������ ������');
	map.addControl(alertPad);		*/
	map.addControl(searchControl);
	map.removeControl(toolbar);
//			map.addControl(btnAddPoint);
	toolbar.add(btnAddPoint);
//			alert(toolbar);
	map.addControl(toolbar);

	}
YMaps.Events.observe(btnAddPoint, btnAddPoint.Events.Click, function () 
		{		
		if(pointAdr)
			map.removeOverlay(pointAdr);
		pointAdr = new YMaps.Placemark(map.getCenter(), {draggable: false});
		YMaps.Events.observe(pointAdr, pointAdr.Events.DragEnd, function (obj) 
			{
			pointAdr.setIconContent("�������� &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
			var clickPoint = obj.getGeoPoint();
			$('#coord').val(clickPoint.copy());
			pointAdr.setStyle(styleUpd);
			pointAdr.openBalloon();
			pointAdr.setIconContent(null);
			obj.update();
			});					
		pointAdr.setOptions({style:styleAdr, draggable: false});
		map.addOverlay(pointAdr);		
		pointAdr.openBalloon();
		$('#coord').val(pointAdr.getGeoPoint().copy());
		}, map);
YMaps.Events.observe(searchControl, searchControl.Events.Select, function (searchControl, obj) 
	{
	if(pointAdr)
		map.removeOverlay(pointAdr);
	pointAdr = obj;
	YMaps.Events.observe(pointAdr, pointAdr.Events.DragEnd, function (obj) 
		{
		pointAdr.setIconContent("�������� &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
		var clickPoint = obj.getGeoPoint();
		$('#coord').val(clickPoint.copy());
		pointAdr.setStyle(styleUpd);
		pointAdr.openBalloon();
		pointAdr.setIconContent(null);
		obj.update();
		map.addOverlay(obj);		
		map.addOverlay(pointAdr);		
		});					
	pointAdr.setOptions({style:styleAdr, draggable: false});
	map.addOverlay(pointAdr);		
	pointAdr.openBalloon();
	$('#coord').val(pointAdr.getGeoPoint().copy());
	});
	
function submitCreateForm() /*������ �������� �������*/
	{
	var action = '/map/set/newMO';		
	$.post(action, 
		{
		parent: $('#layerSelEl').val(),
		name: $('#layerTitleEl').val(),
		position: $('#coord').val(),
		about: $('#layerAboutEl').val()
/*		name: document.getElementById('layerTitleEl').value,
		about: document.getElementById('layerAboutEl').value*/
		}, function(str) 
		{
//			alert(str);
		if(str == 0) 
			{
			alert('������ <' +$('#layerTitleEl').val() + '> ������� ��������');
			name.value = '';
			submitBtn.disabled=true;
			}
		else  
			{
			alert('�������� �������������� ������! �� ������� �������� ��������� <' + $('#layerTitleEl').val() + '>. ���������� ��������� �������� �����');
			}
		});			
	}
function selectOMType(obj) /*����� ���� ������������ �������*/
	{
	var visibility = obj.value == 'new' ? 'none' : '' ;
	$('.elObj').css('display', visibility);
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
			container.style.display = '';     // ��� jquery
			}
		else
			{
			container.style.display = 'none';     // ��� jquery
			}
		return false;
		}
	else return true;			
	}
