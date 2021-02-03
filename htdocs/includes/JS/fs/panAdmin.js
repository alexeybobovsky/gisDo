var newPanObjectVar;
function panAddPoint()
	{
//	newPanObjectVar.coordinatesPan =  $('#coord').val();
	newPanObjectVar.name =  $('#pointNameNew').val();
	alert(showProperties(newPanObjectVar));

	UI.pleaseWait();
/*	$.post($('#actionAddPoint').val(), {coord: $('#coord').val(), name:$('#pointName').val()}, function(str)
		{
		alert('');
		UI.pleaseWait();
		addPlacemark.closeBalloon();
		});	*/
	
	$.post($('#actionAddPoint').val(), {id:newPanObjectVar.id, 
										constrId:newPanObjectVar.constrId, 
										name:newPanObjectVar.name, 
										geoCoord:newPanObjectVar.coordinates,
										panCoord:$('#coord').val(),
										panId:$('#panId').val()
										}, function(str)
		{
		alert(str);
		UI.pleaseWait();
//		addPlacemark.closeBalloon();
		});	
		
	}
function newPanObject() 
	{
    this.id = '';
    this.constrId = '';
    this.coordinates = '';
    this.coordinatesPan = '';
	this.name = '';
	}

function savePosition()
	{
	newPanObjectVar.coordinates = newObjectVar.coordinates;
	$("#contPos").text('расположен по адресу: ' + newPanObjectVar.coordinates);
	newObjectPlacemark.balloon.close();
	miniMapDestroy();
	UI.togglePanel('', 'miniMap', 1, '')
	}
function changePlacemarkStylePan(obj)
	{
	obj.options.set('draggable', 'true');
	obj.properties.set('iconContent', '<div>&nbsp;<strong>&larr;&rarr;</strong>&nbsp;</div>');
	obj.properties.set('hintContent', 'Переместите метку в нужное место');
	obj.options.set('preset', 'twirl#nightStretchyIcon');
	obj.events
	.add('dragend', function () 
		{
//		alert(showProperties(obj.geometry.getCoordinates()));
		newObjectVar.coordinates = obj.geometry.getCoordinates();
//		obj.properties.set('adrCity', obj.coordinates[0] + ' : ' + obj.coordinates[1]);
		obj.properties.set('coordStr',  newObjectVar.coordinates[0] + ' : ' + newObjectVar.coordinates[1]);
		obj.balloon.open();
		});		
	
	}
function showMiniMapAdm()
	{
	if(newPanObjectVar.constrId != '')
		{
		alert('Действие запрещено! В качестве объекта выбрана стройка. Менять геопозицию стройки можно только в её профиле');
		}
	else
		{
		$("h3.miniMap_title").addClass('typeInfo');		
		UI.togglePanel('', 'miniMap', 1);
		init();
		initAdm();
		var tplNewObj1 = ymaps.templateLayoutFactory.createClass(
			"<div>Координаты объекта: <font color='green'>$[properties.coordStr]</font></div>" + 
			"<div id='adrInCorrectPosition'> Позиция указана неверно? <span onClick='newObjectPlacemark.balloon.close(); changePlacemarkStylePan(newObjectPlacemark); ' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Переместить метку</span></div>" + 
			"<div id='adrCorrectAll'> <span onClick='savePosition();' style='Color: #aaa; Cursor: pointer; border-bottom: dashed 1px;'>Сохранить</span></div>"
			);	
		ymaps.layout.storage.add('my#tplNewObj1', tplNewObj1);	
		}
	}	
function noMatches()
	{
	$("#contPos").text('Указать местоположение');	
	newPanObjectVar.coordinates = '';
	newPanObjectVar.id = '';
	newPanObjectVar.constrId = '';	
	}
function formatStreet(row, i, num) 
	{	
//	alert(showProperties(row, 'ac'));
	var result;
	var string = row[0].toLowerCase();
	var searched = row[1].toLowerCase();	
	var start = string.indexOf(searched);
	var end = start + searched.length;
	var typeClass = (row[3]=='constr')?'constrName':'catDocs';
	var typeLabel = (row[3]=='constr')?'стройка':'объект';
	result = '<div class= "multitypeContaner"><div class="findResult">';
	result += string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end);					
	result += '</div><div  class="findType typeName_' + typeClass + '">' + typeLabel + '</div></div>';				
	$("#contPos").text('Указать местоположение');	
	newPanObjectVar.coordinates = '';
	newPanObjectVar.id = '';
	newPanObjectVar.constrId = '';	
	return result;
	}
function selectName(str) 
	{	
//	alert(showProperties(str.extra, 'ac'));
//	newPanObjectVar.id = (str.extra[2]=='panPoint')?str.extra[1]:''
	if(str.extra[2]=='panPoint')
		{
		newPanObjectVar.id = str.extra[1];
		newPanObjectVar.constrId = '';	
		}
	else if(str.extra[2]=='constr')
		{
		newPanObjectVar.id = '';
		newPanObjectVar.constrId = str.extra[1];				
		}
	newPanObjectVar.coordinates = str.extra[3] + ',' + str.extra[4];
	$("#contPos").text('расположен по адресу: ' + str.extra[3] + ':' + str.extra[4]);
	}
function panAddPointInit() 
	{
	$("#pointNameNew").autocomplete('/spddl/',
		{
		minChars:1,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		formatItem:formatStreet,
		noMatchesFound:noMatches,
		onItemSelect:selectName,
		extraParams:{type:"panPointName"}
	//	cacheLength:0,
	//    autoFill:false
		}
		);	
	newPanObjectVar = new newPanObject();		
	}
function panEditInit() 
	{	
	$('.datepicker').pickadate({
			  monthsFull: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
			  monthsShort: [ 'Янв', 'Февр', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек' ],
			  weekdaysFull: [ 'Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота' ],
			  weekdaysShort: [ 'Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб' ],
				formatSubmit: 'yyyy-mm-dd',
				format: 'd mmmm, yyyy',
				today: 'Сегодня',
				clear: 'Очистить',
			  firstDay: 1,
			onOpen: function(event) {
				},
			onSet: function(event) {
		//		$('#VAL_fotoDateEdit').val(0);
				}
			}
		);
	$("#pointName").autocomplete('/spddl/',
		{
		minChars:1,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		formatItem:formatStreet,
		noMatchesFound:noMatches,
		onItemSelect:selectName,
		extraParams:{type:"panPointName"}
	//	cacheLength:0,
	//    autoFill:false
		}
		);	
   
		$('.p_value').css({'cursor':'pointer'/*, 		'border-bottom': '1px dashed inherit'*/});
		$('.p_valueTextArea').css({'cursor':'pointer'/*, 		'border-bottom': '1px dashed inherit'*/});
		$('.p_valueSelect').css({'cursor':'pointer'/*, 		'border-bottom': '1px dashed inherit'*/});
		$('.p_value').editable('/apartment/set/editFast', { 
			 data		:	function(value, settings) {return  (isNumeric(value)) ?  value : '';},
			 submitdata :  	function(value, settings) {return  {apId: $('#apId').val()}},
			 type      : 'text',
			 cancel    : 'отмена',
			 submit    : 'OK',
			 indicator : '<img src="/src/design/main/img/blueBars.gif">',
			 tooltip   : 'изменить...'
		 });
		$('.p_valueSelect').editable('/apartment/set/editFast', { 
			 submitdata :  function(value, settings) {return  {apId: $('#apId').val()}},
			 data 		:   {'1':'черновая','2':'получистовая','3':'чистовая', '0':'не задано'/*, 'selected':''*/},
			 type      : 'select',
			 cancel    : 'отмена',
			 submit    : 'OK',
			 indicator : '<img src="/src/design/main/img/blueBars.gif">',
			 tooltip   : 'изменить...'
		 });
		$('.p_valueTextArea').editable('/apartment/set/editFast', { 
			 submitdata :  function(value, settings) {return  {apId: $('#apId').val()}},
			 type      : 'textarea',
			 cancel    : 'отмена',
			 submit    : 'OK',
			 indicator : '<img src="/src/design/main/img/blueBars.gif">',
			 tooltip   : 'изменить...'
		 });	
	}
	