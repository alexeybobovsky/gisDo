var myMap = null;
/*var clickApSimple = function() {showApInfo('', UI.GetStrPrt(this.parentNode.id, '_', 1))};
var clickApSelected = function() {apToggleSelectList(this, 'ApSelectAp')};*/
//var point  = new Array();
var point;
var placemark = new Array();
var objCollection;
var apKeepSelect = false;

function resize() 
	{
//	alert( 'page :' + $('#page').height() + ';  windowHeight: ' +  UI.windowHeight + ';  documentHeight: ' +  UI.documentHeight);
	UI.setSize();   
		if($('body').height() < UI.windowHeight)
			{
			$('#pageRight').css({'height' : UI.windowHeight-($('#footerContaner').height()+ $('#topToolBar').height()+ $('#topContaner').height())});				
			$('#pageLeft').css({'height' : ($('#pageRight').height())});				
			}
		else
			{
			var newHeight = $('body').height() - ($('#topToolBar').height()+ $('#topContaner').height());
			$('#pageRight').css({'height' : newHeight});				
			$('#pageLeft').css({'height' : newHeight});				
			}
	}
function toggleFulText() 
	{
	if($("#other").css('display') == 'none')
		{
		$("#other").slideDown("slow", function() {
			$('#pageContent #infoTextHolder #more').text('<< свернуть');
/*			$("#indicator_" + year).attr('src', '/src/design/tree/treeMinus.gif');
			$("#indicator_" + year).attr('title', 'скрыть');
			$("#show_" + year).attr('title', 'скрыть');*/
			resize();
		});
		}
	else
		{
		$("#other").slideUp("slow", function() {
			$('#pageContent #infoTextHolder #more').text('читать полностью >>');
/*			$("#indicator_" + year).attr('src', '/src/design/tree/treePlus.gif');
			$("#indicator_" + year).attr('title', 'показать');
			$("#show_" + year).attr('title', 'показать');*/
			resize();			
		});
		}
		

	}
function previewRenderAp(obj, type) 
	{
	
	var iconSize = (type === undefined) ? '45' : '60';
	var newSrc = str_replace('/1024', '/640', obj.href);
	var iconSrc = str_replace( '/1024', '/60', obj.href);
	$("#renderFull").attr('src', newSrc);
	$(".renderFull").attr('title', obj.title);
	$("#renderFull").attr('title', obj.title);
	$("#fotoBig .icon").each(function (i) {
	
//	alert(this.src + ' != ' + iconSrc);
		if(this.src != iconSrc)
			{
			this.className='icon';
			}
		else
			this.className='icon iconSelected';			
		});
//	alert($("#fotoBig .icon").length);
/*	var titleImg = $(".renderFull").attr('title');
	alert($(".renderFull").attr('title'));
*/
	}
function previewRender(obj, type) 
	{
	
	var srcPref = (type === undefined) ? 'render' : type;
	var iconSize = (type === undefined) ? '45' : '60';
	var newSrc = str_replace( srcPref + '/1024', srcPref + '/640', obj.href);
	var iconSrc = str_replace( srcPref + '/1024', srcPref + '/' + iconSize, obj.href);
//	alert(newSrc + ' - ' + type);
/*	$(obj).addClass('iconSelected');*/
	$("#renderFull").attr('src', newSrc);
	$(".renderFull").attr('title', obj.title);
	$("#renderFull").attr('title', obj.title);
	$("#fotoBig .icon").each(function (i) {
//		alert(this.src + ' != ' + iconSrc);
		if(this.src != iconSrc)
			{
			this.className='icon';
			}
		else
			this.className='icon iconSelected';			
		});
//	alert($("#fotoBig .icon").length);
/*	var titleImg = $(".renderFull").attr('title');
	alert($(".renderFull").attr('title'));
*/
	}
function showRender(type) 
	{
	var srcPref; // = (type === undefined) ? 'render' : type;
	var srcPrewOriginal = $("#renderFull").attr('src');
	if(type === undefined)
		srcPref = 'render';
	else if(type == 'apartment')
		{
		if(srcPrewOriginal.indexOf('plan') > 0)
			srcPref = 'plan';
		else if(srcPrewOriginal.indexOf('foto') > 0)
			srcPref = 'foto';		
		}
	var srcImg = $(".renderFull").attr('href');
	var titleImg = $(".renderFull").attr('title');
//	alert(titleImg);
	if($(".renderIco").length>0)
		{
		var srcPrew = str_replace(srcPref + '/640', srcPref + '/1024', srcPrewOriginal);
		var srcImgCut = hrefImgCut = '';
		srcImgCut = UI.GetStrPrt(srcPrew, '/src/', 1);
		var str = '[';
		str += '{href : \'' + srcPrew + '\', title : \'' + titleImg + '\'}'; 
		$(".renderIco").each(function (i) {
			if(this.href != '')
				{
				hrefImgCut = UI.GetStrPrt(this.href, '/src/', 1);
				str += (hrefImgCut == srcImgCut) ? '' : ', {href : \'' + this.href + '\', title : \'' + this.title + '\'}'; 
				}
			});
		str += ']';
//		alert(str);
		$.fancybox.defaults.openEffect  = 'none' ;
		$.fancybox.defaults.closeEffect  = 'none' ;
		$.fancybox.defaults.wrapCSS  = 'fancybox-custom';
		$.fancybox.defaults.closeClick  = true;
		$.fancybox.defaults.helpers  = { title : {type : 'inside'}, overlay : {css : {'background' : 'rgba(238,238,238,0.85)'}}, thumbs : { width: 50, height: 50}};
		$.fancybox.open(eval(str)); 
/*		$.fancybox.open(eval(str), {afterLoad: function(current, previous) 
					{
//					alert(curIndex);
//					$.fancybox.jumpto( curIndex );
					}});
*/
		}
	else if($(".renderFull").length>0)
		{
		/*var src, title;*/
		$.fancybox.defaults.openEffect  = 'none' ;
		$.fancybox.defaults.closeEffect  = 'none' ;
		$.fancybox.defaults.wrapCSS  = 'fancybox-custom';
		$.fancybox.defaults.closeClick  = true;
		$.fancybox.defaults.helpers  = { title : {type : 'inside'}, overlay : {css : {'background' : 'rgba(238,238,238,0.85)'}}};
		$.fancybox.open([{href : srcImg, title : titleImg}]);		
		}
	return false;
	}
function showFotoProgress(position) 
	{
	var str = '[';
	$(".position_" + position).each(function (i) {
		if(this.href != '')
			{
			if(i>0)
				str += ',';
			str += '{href : \'' + this.href + '\', title : \'' + this.title + '\'}'; 
			}
		});
	str += ']';
//	alert($(".position_" + position).length + ' - ' + str);
	$.fancybox.defaults.openEffect  = 'none' ;
	$.fancybox.defaults.closeEffect  = 'none' ;
	$.fancybox.defaults.wrapCSS  = 'fancybox-custom';
	$.fancybox.defaults.closeClick  = true;
	$.fancybox.defaults.helpers  = { title : {type : 'inside'}, overlay : {css : {'background' : 'rgba(238,238,238,0.85)'}}, thumbs : { width: 50, height: 50}};
	$.fancybox.open(eval(str));
	}
function showFotoSet(year, capture) 
	{
	$("#indicator_" + year).attr('src', '/src/design/tree/load.gif');
	if($("#fotoSet_" + capture).css('display') == 'none')
		{
		$(".fotoSet_" + year).slideDown("slow", function() {
			$("#indicator_" + year).attr('src', '/src/design/tree/treeMinus.gif');
			$("#indicator_" + year).attr('title', 'скрыть');
			$("#show_" + year).attr('title', 'скрыть');
			resize();
		});
		}
	else
		{
		$(".fotoSet_" + year).slideUp("slow", function() {
			$("#indicator_" + year).attr('src', '/src/design/tree/treePlus.gif');
			$("#indicator_" + year).attr('title', 'показать');
			$("#show_" + year).attr('title', 'показать');
			resize();			
		});
		}
		
	}
function miniMapDestroy() 
	{
	 myMap.destroy();
	 myMap = null;
	}
function showMiniMap(type, obj) 
	{
//	alert(obj);
	$("h3.miniMap_title").addClass('typeInfo');		

	UI.togglePanel('', 'miniMap', 1);
	init();
	getObjects(type, obj); 

	}
function init() 
	{
	if(myMap == null)
		{
		myMap = new ymaps.Map("YMapsMini", 
			{				
			center: [52.289422, 104.280633],
			zoom: 16
			});
		myMap.behaviors.enable('scrollZoom');		
		myMap.copyrights.add('&copy; fotostroek.ru');
		var tplMarkerBaloonStr = "<div id='baloonPad'><div id='MiniFirmName'>" + 
			"$[properties.firmName]" + 
	//		"<span class='orgAct' id='showAllOrgObjLink'  onClick='showOrgObjects(\"$[properties.firmId]\", 0)'><nobr>Все объекты</nobr></span>" +
			"</div>" + 
			"$[properties.orgSting]" + 
			"<div id='adrActions'>" + 
			"<div id='adr'><strong>Адрес: </strong>$[properties.adress]</div>" + 
			"<div id='miniMore'>" + 
			"<a href='/map/$[properties.type]/$[properties.objId]/'>Смотреть на подробной карте</a>" + 
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
function getObjects(objType, paramId) //получение объектов с сервера и добавление их в геоколлекцию
	{
	var city = document.getElementById('cityId').value;
	UI.pleaseWait();
	$.post("/spddl/", {type:'mapSingleObjSimple', objType:objType,  filter:'', object:paramId, city:city}, function(str) 
		{
		UI.pleaseWait();
		var valArr = str.split('##');
		point =  new setPoint(valArr);
		objCollection.add(createObjectPlacemark(point));
		myMap.geoObjects.add(objCollection);
		myMap.setCenter(point.coordinates);	
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
function setPoint(obj) //поля метки для объекта
	{	
    this.type = 	obj[0];
    this.objId = 	obj[1];
    this.objName = 	obj[2];
    this.x = 		obj[3];
    this.y = 		obj[4];
    this.coordinates = [obj[3], obj[4]];
    this.adr = 		obj[5];
	}	
function createObjectPlacemark(obj) //создает метку объекта
	{
	var objectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		type: obj.type,
		hintContent: obj.objName,
		firmName: obj.objName,
		objId: obj.objId,
		adress: obj.adr,
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
	