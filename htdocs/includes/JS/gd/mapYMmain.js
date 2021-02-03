var myMap;
var zoomRange;
var defaultZoom = 	11;
var photoZoom = 	14;
var pCount = 1;	
var point  = new Array();
var placemark = new Array();
var objCollection;
var myCluster;
var imgSizePrew = 90;
//var imgSizeView = 600;
var imgSizeView;
var imgSizeFull = 1024;
var imgGallery = new Array();
var loadImg = new Image(); 
	loadImg.src = '/src/design/tmp/main/blueBars.gif';
var emptyImg = new Image(); 
	emptyImg.src = '/src/design/tmp/main/_.gif';
var parentObj;
var selectedLayer;
var iconOptions = new getIconsOfZoom();	
	iconOptions.update(defaultZoom);
var showType;
var bounds;
var startCluster = 8;
//var startCluster = 35;
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}

/*******************************autocomplete functions****************************************/
function searchLoadStart()
	{
//	document.getElementById('searchIndicatorImg').src = loadImg.src;
	document.getElementById('resMessage').innerHTML = '';	
	}
function searchLoadEnd()
	{
//	document.getElementById('searchIndicatorImg').src = emptyImg.src;	
	}
function clearSearchbar()
	{
	document.getElementById('resMessage').innerHTML = '';
	document.getElementById('searchStr').value = 'Поиск по карте...';
	}
function noMatches()
	{
	document.getElementById('resMessage').innerHTML = 'Не найдено';
	}
function formatStreet(row, i, num) 
	{	
	document.getElementById('resMessage').innerHTML = '';
	var result;
	var type = row[0];
	var string = row[1].toLowerCase();
	var searched = row[2].toLowerCase();	
	var start = string.indexOf(searched);
	var end = start + searched.length;
	if (row[0] == 'layer')
		type = 'категории';
	if (row[0] == 'org')
		type = 'название организации';
	if (row[0] == 'street')
		type = 'адрес организации';
	if (row[0] == 'phone')
		type = 'телефон организации';
	type += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	result = '<div class= "multitypeContaner"><div class="findResult">' + 
				string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end) + 
				'</div><div  class="findType">' + type + '</div></div>';				
	return result;
	}
function selectName(str) 
	{	
	if(str.selectValue == 'layer')
		clickLayer(str.extra[2]);
	if(str.selectValue == 'org')
		showOrgObjects(str.extra[2]);
	if(str.selectValue == 'phone')
		showObject(str.extra[3], 1);
	if(str.selectValue == 'street')
		showObject(str.extra[3], 1);
	document.getElementById('searchStr').value = 'Поиск по карте...';
	document.getElementById('searchStr').blur();
	}	
/*******************************autocomplete functions****************************************/
				
function getIconsOfZoom()
	{
	this.currentZoom = 	'';
	this.imageHref = 	'';
	this.imageSize = 	'';
	this.imageOffset =  '';	
	this.update = function (zoom)
		{
		this.currentZoom = zoom;
		if(zoom > 15)
			{
//			this.imageHref = 	'/src/design/tmp/main/blue_bar_big.png';
			this.imageHref = 	'/src/design/main/img/png/map_marker_big.png';
			this.imageSize = 	[20,23];
			this.imageOffset = [-10, -23];
			}
		else if(zoom > 13)
			{
			this.imageHref = 	'/src/design/main/img/png/map_marker_medium.png';
			this.imageSize = 	[14,15];
			this.imageOffset = [-7,-7];
			}
		else/* if(zoom > 10)*/
			{
			this.imageHref = 	'/src/design/main/img/png/map_marker_small.png';
			this.imageSize = 	[10,11];
			this.imageOffset = [-5,-5];
			}
/*		else if(zoom > 10)
			{
			this.imageHref = 	'/src/design/tmp/main/red_dot.png';
			this.imageSize = 	[12,12];
			this.imageOffset = [-6,-6];
			}*/
			
		}
	}
function changeIconsCluster()
	{	
	var objCoord, img, imgSize, imgSizeOffset;
	var it = myMap.geoObjects.getIterator();
	var geoObj;
	while (geoObj = it.getNext()) 
		{
		if(geoObj.getIterator)
			{
			var it1 = geoObj.getIterator();
			var geoObj1;
			while (geoObj1 = it1.getNext()) 
				{
				if(geoObj1.properties.get('objId'))
					{
					objCoord = geoObj1.geometry.getCoordinates();
					if(	(objCoord[0] >= bounds[0][0]) && 
						(objCoord[0] <= bounds[1][0]) && 
						(objCoord[1] >= bounds[0][1]) && 
						(objCoord[1] <= bounds[1][1]))
						{
						img = geoObj1.properties.get('img');
						if((iconOptions.currentZoom >= photoZoom)&&(img[0]))
							{
							imgSize = 		(iconOptions.currentZoom > 15) ? 45 : 24;	 						
							imgSizeOffset = (iconOptions.currentZoom > 15) ? -22 : -12;
							
							geoObj1.options.set('iconImageHref', 	img[0].path + imgSize + '/' + img[0].fileName);				
							geoObj1.options.set('iconImageSize', 	[imgSize, imgSize]);	
							geoObj1.options.set('iconImageOffset',	[imgSizeOffset, imgSizeOffset]);	
							}
						else
							{						
							geoObj1.options.set('iconImageHref', 	iconOptions.imageHref);				
							geoObj1.options.set('iconImageSize', 	iconOptions.imageSize);	
							geoObj1.options.set('iconImageOffset',	iconOptions.imageOffset);				
							}
						}
					}
				}
			}
		
		}	
	}
function changeIcons()
	{	
	var objCoord, img, imgSize, imgSizeOffset;
	if(showType != 'cluster')
		{
		var iterator = objCollection.getIterator(),
			object;
		while (object = iterator.getNext()) 
			{
			objCoord = object.geometry.getCoordinates();
			if(	(objCoord[0] >= bounds[0][0]) && 
				(objCoord[0] <= bounds[1][0]) && 
				(objCoord[1] >= bounds[0][1]) && 
				(objCoord[1] <= bounds[1][1]))
				{
				img = object.properties.get('img');
				if((iconOptions.currentZoom >= photoZoom)&&(img[0]))
					{
					imgSize = 		(iconOptions.currentZoom > 15) ? 45 : 24;	 						
					imgSizeOffset = (iconOptions.currentZoom > 15) ? -22 : -12;
/*					
					object.options.set('iconImageHref', 	img[0].path + imgSize + '/' + img[0].fileName);				
					object.options.set('iconImageSize', 	[imgSize, imgSize]);	
					object.options.set('iconImageOffset',	[imgSizeOffset, imgSizeOffset]);	*/

					object.options.set('iconImageHref', 	img[0].path + imgSize + '/' + img[0].fileName);				
					object.options.set('iconImageSize', 	[imgSize, imgSize]);	
					object.options.set('iconImageOffset',	[imgSizeOffset, imgSizeOffset]);	
//					object.options.set('iconImageHref', 	iconOptions.imageHref);				
//					object.options.set('iconImageSize', 	iconOptions.imageSize);	
//					object.options.set('iconImageOffset',	iconOptions.imageOffset);				

					}
				else
					{
					object.options.set('iconImageHref', 	iconOptions.imageHref);				
					object.options.set('iconImageSize', 	iconOptions.imageSize);	
					object.options.set('iconImageOffset',	iconOptions.imageOffset);				
					}
				}
			}
		}

	}
	
function autoload()
	{
	var type, value;
	if( (type = document.getElementById('autoLoadType').value) && (value = document.getElementById('autoLoadObj').value))
		{
		if (type == 'layer')
			clickLayer(value);
		else if(type == 'org')
			showOrgObjects(value);
		else if(type == 'obj')
			showObject(value, 1);			
		}
	else
		{
		var animateCss1, animateCss2, animateCss3;
		var pos = $("#mapCatSelect").css('marginLeft');	
//		alert ($("#mapCatSelect").css('marginLeft'));		

		animateCss1 = {'marginLeft' : 100};
		animateCss2 = {'marginLeft': -10 };
		animateCss3 = {'marginLeft': pos};
		
		$("#mapCatSelect").animate(animateCss1, 500  , function()
			{ $("#mapCatSelect").animate(animateCss2, 250, 
				function()
					{ $("#mapCatSelect").animate(animateCss3, 100 )} )} );
		
		}
	}
/*function pleaseWait(start)
	{

	}*/
function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function setParentObj(id, name, title)
	{
	this.id = id;
	this.name = name;
	this.title = title;
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
/*			tmpStr += '<div id="layerStr">'*/
			tmpStr += '<ul>'
		tmpArr = layers[i].split('$$');
		this.layers[cnt] = new setpointLayers(tmpArr[0], tmpArr[1]);
		tmpStr += '<li class="layer"   title="показать все объекты рубрики \'' + tmpArr[0] + '\' на карте"  id="layerBaloon_' + tmpArr[1] + '"  onClick="clickLayer(this, 0);" >' + tmpArr[0] + '</li>';
		cnt ++;
		}
	if(tmpStr!='')
		tmpStr += '</ul>';		
	this.layerSting = tmpStr;		
	cnt = 0;
	var tmpStr = styleAdd = imgLink = title = galleryStr = '';
	for(var i=0; i<img.length; i++)
	if (img[i] !='')
		{
		tmpArr = img[i].split('^^');
		imgLink = 	tmpArr[0] + imgSizeView + '/' + tmpArr[1];
		title 	= 	(tmpArr[2]) ? tmpArr[2] : 'Фото ' + firmName + ' ' + $('#cityName').val();
		if(i==0)			
			tmpStr += '<div id="imgStr">';		
		else
			galleryStr += ',';			
		this.img[cnt] = new setpointImg(tmpArr[0], tmpArr[1], tmpArr[2]);
		galleryStr += '{href : \'' + imgLink + '\', title : \'' + title + '\'}';
//		FB.galleryItemsAdd(imgLink, title);
		styleAdd = (i > 3) ? 'style="display:none"' : '';
		tmpStr += '<a  class="imgBaloonLink"'+ styleAdd + '  rel="gallery" href = "' + imgLink + '" title = "' +  title 
											+ '" target="_blank"><img id = "imgBaloonPrew_' + tmpArr[1] + '" height="60" width="60" src="' 
											+ tmpArr[0] + imgSizePrew + '/' + tmpArr[1] + '" ></a>';
		cnt ++;
		}
	if(tmpStr!='')
		{
		tmpStr += (cnt>4) ? '<span class="imgBaloonMore" onClick="$.fancybox.open( [' + galleryStr + '] );"> все фото (' + cnt + ')</span>' : '';		
		tmpStr += '</div>';		
		}
	this.imgSting = tmpStr;	
	tmpStr = '';
	if(mngActions)
		{
		tmpStr += '<div id = "mngStr">';
		tmpStr += '<span class="mngAct" id="oe"  onClick="showEdtBox(\'' + mngActions.oe + objId + '\', 0)"><nobr>изменить</nobr></span>';
		tmpStr += '<span class="mngAct" id="fe"  onClick="moveObj(\'' + objId + '\')"><nobr>переместить</nobr></span>';
		tmpStr += '<span class="mngAct" id="od"  onClick="delObj(\'' + mngActions.od + '\', 0)"><nobr>удалить</nobr></span></br>';
		tmpStr += '</div>';
		}
	this.mngSting = tmpStr;
	tmpStr = '';
	tmpStr += '<div id = "orgStr">';
	tmpStr += '<span class="orgAct" id="showAllOrgObjLink"  title="показать все объекты организации \'' + firmName + '\' на карте" onClick="showOrgObjects(\'' + firmId + '\', 0)"><nobr>все объекты</nobr></span></br>';
	tmpStr += '</div>';		
	this.orgSting = tmpStr;
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
		img: obj.img,
		layerSting: obj.layerSting,
		imgSting: obj.imgSting,
		orgSting: obj.orgSting,
		mngSting: obj.mngSting,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		iconImageHref: '/src/design/tmp/main/red_dot.png',
		iconImageSize: [12,12],
		iconImageOffset: [-6,-6],
		iconShadow: true,
		balloonContentLayout:  'my#tplStandardObj',
		}
		);
	objectPlacemark.events
		.add('balloonopen', function () 
			{
			FB.create('.imgBaloonLink', 'gallery');
//			$(".fancybox").fancybox({'openEffect'	: 'none',		'closeEffect'	: 'none'});
/*			$('.imgBaloonLink').fancybox(fancyBoxStyle);
			$.fancybox.defaults.openEffect  = 'none' ;
			$.fancybox.defaults.closeEffect  = 'none' ;
			$.fancybox.defaults.wrapCSS  = 'fancybox-custom';
			$.fancybox.defaults.closeClick  = true;
			$.fancybox.defaults.helpers  = { title : {type : 'inside'}, overlay : {css : {'background' : 'rgba(238,238,238,0.85)'}}, thumbs : { width: 50, height: 50}};*/
			$('#objId').val(obj.objId);
			});
	return objectPlacemark;
	}
function getObjects(spdlType, paramId, city, show) //получение объектов с сервера и добавление их в геоколлекцию
	{
	var city = document.getElementById('cityId').value;
	UI.pleaseWait();
	$.post("/spddl/", {type:spdlType, object:paramId, city:city}, function(str) 
		{
		UI.pleaseWait();
		var strArr = str.split('~~');
		var valArr, layerArr, imgArr; //, showType;	
		var pointCnt = objCnt = 0;
		if(strArr.length <= 1)
			showType = 'empty';		
		else if(strArr.length == 2)
			showType = 'single';
		else if(strArr.length <= startCluster)
			showType = 'marker';
		else if(strArr.length > startCluster)
			showType = 'cluster';
//		alert(showType);
		if(showType == 'empty')
			{
			if(selectedLayer)
				{
				$('#' + selectedLayer).removeClass("selected");		
				selectedLayer = '';		
				}				
			UI.showMessage('error', 'Объектов не найдено');			
			}		
		else
			{
			objCnt = strArr.length - 1;
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
						if(showType == 'cluster')
							myCluster.add(createObjectPlacemark(point[pointCnt]));
						pointCnt ++;
						}	
					else
						{
						valArr = strArr[i].split('``');
						if(valArr.length>1)
							parentObj = new setParentObj(valArr[0], valArr[1], valArr[2]);
						else
							parentObj = new setParentObj(0, 0, '');
						}
					}
				}
			}
		if(show)
			{
			myMap.geoObjects.add(objCollection);
			if((showType == 'cluster')||(showType == 'marker'))
				{			
				myMap.setBounds(objCollection.getBounds(), { checkZoomRange: true,
				callback: function(err) {
					if (err) {alert('Ошибка масштаба - '+ myMap.getZoom());}}});
				}
			else if (showType == 'single') //(objCnt == 1)
				{
				myMap.setCenter(point[0].coordinates);	
				myMap.setZoom(16);
				var iterator = objCollection.getIterator(),
					object;
				while (object = iterator.getNext()) 
					{
					object.balloon.open();
					break;
					}
				}
			if(showType == 'cluster')
				{
				objCollection.removeAll(); 
				myMap.geoObjects.add(myCluster);
				}

			
			}
		if(parentObj.id >0)
			{
			NAV.setSelectedObjProperties(parentObj.id, parentObj.name, parentObj.title, objCnt);
			NAV.saveNavPosition();
			}
		});	
	}
function showOrgObjects(orgId) //показать все объекты организации
	{
	if(objCollection.getLength())
		{
		point = new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	myCluster.removeAll();
	if(selectedLayer)
		{
		$('#' + selectedLayer).removeClass("selected");		
		selectedLayer = '';		
		}
	NAV.setSelectedType('org');
	getObjects('mapOrgObjects', orgId, document.getElementById('cityId').value, 1); 
	}
function showObject(objId, openBaloon) //показать единичный объект
	{
	if(objCollection.getLength())
		{
		point = new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	myCluster.removeAll();
	if(selectedLayer)
		{
		$('#' + selectedLayer).removeClass("selected");		
		selectedLayer = '';		
		}
	NAV.setSelectedType('singleObj');
	getObjects('mapSingleObj', objId, document.getElementById('cityId').value, 1); 
	}
function clickLayer(layer)
	{
	if(document.getElementById(layer.id)/* != 'undefined'*/)
		{
		var layer_id = GetStrPrt(layer.id, '_', 1);
		}
	else
		{
		var layer_id = layer;		
		}
	myCluster.removeAll();
	if(objCollection.getLength())
		{
		point = new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	if(selectedLayer)
		{
		$('#' + selectedLayer).removeClass("selected");		
		selectedLayer = '';		
		}
	NAV.setSelectedType('layer');
	getObjects('mapLayerObjects', layer_id, document.getElementById('cityId').value, 1); 
	$('#nameLayer_' + layer_id).addClass("selected");
	selectedLayer = 'nameLayer_' + layer_id;
	}
function init() 
	{
	myMap = new ymaps.Map("YMapsID", 
		{				
		center: [52.289422, 104.280633],
		zoom: defaultZoom//,
		});
		
	ymaps.getZoomRange('yandex#map', [52.289422, 104.280633]).then(function (result) 
		{		
		zoomRange = result;
		});		
//	alert(showProperties(ymaps.getZoomRange('yandex#map', [52.289422, 104.280633]), 'zoom'));	
	myMap.controls.add('mapTools');
	myMap.controls.add('typeSelector');
	myMap.controls.add('zoomControl');	
	myMap.copyrights.add('&copy; Город-детям.рф');
	myMap.behaviors.enable('scrollZoom');
//	var tplMarkerBaloonStr = "<div id='baloonPad'><div id='firmName'><a title = 'Профиль организации в каталоге' href='/catalog/$[properties.firmName]'>$[properties.firmName]</a></div>" + 
	var tplMarkerBaloonStr = "<div id='baloonPad'><div id='firmName'>" + 
		"<a title = 'Профиль организации в каталоге' href='/catalog/$[properties.firmName]'>$[properties.firmName]</a>" + 
//		"<span class='orgAct' id='showAllOrgObjLink'  onClick='showOrgObjects(\"$[properties.firmId]\", 0)'><nobr>Все объекты</nobr></span>" +
		"</div>" + 
		"$[properties.orgSting]" + 
		"<div id='adrActions'>" + 
		"<div id='adr'><strong>Адрес: </strong>$[properties.adress]</div>" + 
		"<div id='phone'><strong>Телефон: </strong>$[properties.phone]</div></div>" + 
		"$[properties.imgSting]" + 
		"$[properties.layerSting]" + 
		"$[properties.mngSting]"+
		"";		
	var tplMarkerBaloonStrMain = "<div id='baloonPad'><div id='firmName'>$[properties.firmName]</div>" + 
		"$[properties.orgSting]" + 
		"<div id='adrActions'>" + 
		"<div id='adr'>$[properties.adress]</div>" + 
		"<div id='phone'>$[properties.phone]</div></div>" + 
		"$[properties.layerSting]" + 
		"$[properties.imgSting]" + 
		"$[properties.mngSting]"+
		"";		
	var tplStandardObj = ymaps.templateLayoutFactory.createClass(tplMarkerBaloonStr);	
/***********************start cluster baloon*****************************************************/		
    var  MainContentLayout = ymaps.templateLayoutFactory.createClass('', {
            build: function () {
                MainContentLayout.superclass.build.call(this);
                this.stateListener = this.getData().state.events.group()
                    .add('change', this.onStateChange, this);
                this.activeObject = this.getData().state.get('activeObject');
                this.applyContent();
            },
            
            clear: function () {
                if (this.activeObjectLayout) {
                    this.activeObjectLayout.setParentElement(null);
                    this.activeObjectLayout = null;
                }
                this.stateListener.removeAll();
                MainContentLayout.superclass.clear.call(this);
            },            
            onStateChange: function () {
                var newActiveObject = this.getData().state.get('activeObject');
                if (newActiveObject != this.activeObject) {
                    this.activeObject = newActiveObject;
                    this.applyContent();
                }
            },            
            applyContent: function () {
				var curPlacemark = this.getData().state.get('activeObject');
                if (this.activeObjectLayout) {
                    this.activeObjectLayout.setParentElement(null);
                }                
                this.activeObjectLayout = new MainContentSubLayout({
                        options: this.options,
                        properties: this.activeObject.properties
                    });
                
                this.activeObjectLayout.setParentElement(this.getParentElement());
				
			
			$('#objId').val(curPlacemark.properties.get('objId'));
//			$('.imgBaloonLink').fancybox(fancyBoxStyle);			
			FB.create('.imgBaloonLink', 'gallery');
			
            }
        });
        MainContentSubLayout = ymaps.templateLayoutFactory.createClass(tplMarkerBaloonStr);
        
        ItemLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="cluster-balloon-item" [if data.isSelected]style="font-weight: bold;"[endif]>$[properties.firmName]</div>'
			);	
 /***********************end cluster baloon*****************************************************/		       
	myMap.events.add('boundschange', function (e) 
		{
		var zoom = e.get('newZoom');
		if (e.get('oldZoom') != zoom)
			{
			iconOptions.update(zoom);
			}
		bounds = e.get('newBounds');	
		if(showType != 'cluster')
			changeIcons();
		else
			changeIconsCluster();

//		alert('zoom = ' + zoom + '; ' + showProperties(bounds));
		
		});		
	ymaps.layout.storage.add('my#tplStandardObj', tplStandardObj);	
	objCollection = new ymaps.GeoObjectCollection();
	myCluster = new ymaps.Clusterer(
		{
		clusterDisableClickZoom: false,
//		clusterDisableClickZoom: true,
		clusterBalloonMainContentLayout: MainContentLayout,
		clusterBalloonSidebarItemLayout: ItemLayout,
		clusterBalloonSidebarWidth: 130,
		clusterBalloonWidth: 500,		
		clusterBalloonHeight: 400		
		});
	myCluster.events.add('objectsaddtomap', function (e) 
		{
		changeIconsCluster();
		});		


		
		
	
	$("#searchStr").autocomplete('/spddl/',
		{
		minChars:3,
		lineSeparator:"##",
		cellSeparator:"**",
		maxItemsToShow:20,
		selectOnly:true, 
		formatItem:formatStreet,
		noMatchesFound:noMatches,
		loadingStart:searchLoadStart,
		loadingEnd:searchLoadEnd,
		onItemSelect:selectName,
		extraParams:{type:"mapGlobalSearch"}
		}
		);		
/*	$(document).keypress(function (e) 
		{		
		DLG.keypressed(e);
            }
        );*/	
	autoload();
	}	