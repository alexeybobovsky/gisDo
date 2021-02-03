var myMap;
var zoomRange;
var defaultZoom = 	11;
var photoZoom = 	14;
var pCount = 1;	
//var point  = new Array();
var pointC  = new Array();
var pointF  = new Array();
var placemark = new Array();
var objCollection;
var myCluster;
var imgSizePrew = 60;
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
var startCluster = 1;
/*var filter = new setFilter();*/
//var startCluster = 35;
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}

/*
function setFilter()
	{
	this.type = '';
	this.material = '';
	this.state = '';
	this.dateStart = '';
	this.dateEnd = '';
	this.getAllParam = function()
		{
		
		}
	this.clear = function()
		{
		this.type = '';
		this.material = '';
		this.state = '';
		this.dateStart = '';
		this.dateEnd = '';		
		}
	}*/
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
	var objCoord, img, type, imgSize, imgSizeOffsetX, imgSizeOffsetY, imgShadowSize, imgShadowSizeOffsetX, imgShadowSizeOffsetY, iconShadowImageHref;
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
						if((iconOptions.currentZoom >= photoZoom)&&(img[0].path))
							{
							imgSize = 				(iconOptions.currentZoom > 15) ? 60 : 45;	 						
							imgShadowSize = 		(iconOptions.currentZoom > 15) ? 60 : 45;	 						
							imgSizeOffsetX = 		(iconOptions.currentZoom > 15) ? -30 : -22.5;
							imgSizeOffsetY = 		(iconOptions.currentZoom > 15) ? -30 : -22.5;
							imgShadowSizeOffsetX = 	(iconOptions.currentZoom > 15) ? -40 : -32.5;
							imgShadowSizeOffsetY = 	(iconOptions.currentZoom > 15) ? -30 : -22.5;
							iconShadowImageHref = 	(iconOptions.currentZoom > 15) ? '/src/design/main/shadow60.png' : '/src/design/main/shadow45.png';
							
							geoObj1.options.set('iconImageHref', 	img[0].path + imgSize  + '/' + img[0].fileName + '.' + img[0].fileExt);				
							geoObj1.options.set('iconImageSize', 	[imgSize, imgSize]);	
							geoObj1.options.set('iconImageOffset',	[imgSizeOffsetX, imgSizeOffsetY]);	
							geoObj1.options.set('iconShadow',	'true');	
							geoObj1.options.set('iconShadowImageHref',	iconShadowImageHref);	
							geoObj1.options.set('iconShadowImageSize',	[imgShadowSize +20, imgShadowSize+10]);	
							geoObj1.options.set('iconShadowImageOffset',	[imgShadowSizeOffsetX, imgShadowSizeOffsetY]);	
							}
						else if(iconOptions.currentZoom < photoZoom)
							{
//							if(geoObj1.properties.get('objId') < 10)
//								alert(showProperties(iconOptions, 'iconOptions'));
							geoObj1.options.set('iconImageHref', 	iconOptions.imageHref);				
							geoObj1.options.set('iconImageSize', 	iconOptions.imageSize);	
							geoObj1.options.set('iconImageOffset',	iconOptions.imageOffset);				
//							geoObj1.options.set('iconShadow',	'false');	
							geoObj1.options.set('iconShadowImageHref',	'');	
/*							geoObj1.options.set('iconShadowImageSize',	[0,0]);	
							geoObj1.options.set('iconShadowImageOffset',	[0,0]);	*/
		//					$('.ymaps-image-with-content').css(cssShadowOff);
							}
						}
					}
				}
			}
		
		}	
	}
function changeIcons()
	{	
	var objCoord, img, type, imgSize, imgSizeOffsetX, imgSizeOffsetY, imgShadowSize, imgShadowSizeOffsetX, imgShadowSizeOffsetY, iconShadowImageHref;
	if(showType != 'cluster')
		{
//		var cssShadow = {'-webkit-box-shadow' : '0 5px 5px rgba(0, 0, 0, 0.5)', '-moz-box-shadow' : '0 5px 5px rgba(0, 0, 0, 0.5)', 'box-shadow':'0 5px 5px rgba(0, 0, 0, 0.5)'};
//		var cssShadowOff = {'-webkit-box-shadow' : '', '-moz-box-shadow' : '', 'box-shadow':''};
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
				type = object.properties.get('objType');
				if((iconOptions.currentZoom >= photoZoom)&&(img[0].path))
					{
					if(type == 'construction')
						{
						imgSize = 				(iconOptions.currentZoom > 15) ? 60 : 45;	 						
						imgShadowSize = 		(iconOptions.currentZoom > 15) ? 60 : 45;	 						
						imgSizeOffsetX = 		(iconOptions.currentZoom > 15) ? -30 : -22.5;
						imgSizeOffsetY = 		(iconOptions.currentZoom > 15) ? -30 : -22.5;
						imgShadowSizeOffsetX = 	(iconOptions.currentZoom > 15) ? -40 : -32.5;
						imgShadowSizeOffsetY = 	(iconOptions.currentZoom > 15) ? -30 : -22.5;
						iconShadowImageHref = 	(iconOptions.currentZoom > 15) ? '/src/design/main/shadow60.png' : '/src/design/main/shadow45.png';
						
						object.options.set('iconImageHref', 	img[0].path + imgSize  + '/' + img[0].fileName + '.' + img[0].fileExt);				
//						object.options.set('iconImageHref', 	img[0].path + imgSize   + img[0].fileName + '.' + img[0].fileExt);				
						object.options.set('iconImageSize', 	[imgSize, imgSize]);	
						object.options.set('iconImageOffset',	[imgSizeOffsetX, imgSizeOffsetY]);	
						object.options.set('iconShadow',	'true');	
						object.options.set('iconShadowImageHref',	iconShadowImageHref);	
						object.options.set('iconShadowImageSize',	[imgShadowSize +20, imgShadowSize+10]);	
						object.options.set('iconShadowImageOffset',	[imgShadowSizeOffsetX, imgShadowSizeOffsetY]);	
//						$('.ymaps-image-with-content').css(cssShadow);
						}
					else if (type == 'firm')
						{
						imgSize = 		(iconOptions.currentZoom > 15) ? 60 : 45;	 						
						imgSizeOffsetX = (iconOptions.currentZoom > 15) ? -30 : -22.5;
						imgSizeOffsetY = (iconOptions.currentZoom > 15) ? -60 : -45;

						object.options.set('iconImageHref', 	img[0].path + imgSize + img[0].fileName + '.png');				
						object.options.set('iconImageSize', 	[imgSize, imgSize]);	
						object.options.set('iconImageOffset',	[imgSizeOffsetX, imgSizeOffsetY]);	
						object.options.set('iconShadow',	'false');	
						object.options.set('iconShadowImageHref',	'');	
						object.options.set('iconShadowImageSize',	[0,0]);	
						object.options.set('iconShadowImageOffset',	[0,0]);	
//						$('.ymaps-image-with-content').css(cssShadowOff);
						}
					}
				else
					{
					object.options.set('iconImageHref', 	iconOptions.imageHref);				
					object.options.set('iconImageSize', 	iconOptions.imageSize);	
					object.options.set('iconImageOffset',	iconOptions.imageOffset);				
					object.options.set('iconShadow',	'false');	
					object.options.set('iconShadowImageHref',	'');	
					object.options.set('iconShadowImageSize',	[0,0]);	
					object.options.set('iconShadowImageOffset',	[0,0]);	
//					$('.ymaps-image-with-content').css(cssShadowOff);
					}
				}
			}
		}

	}
	
function autoload()
	{
	var type = 		$('#autoLoadType').val();
	var value = 	$('#autoLoadObj').val();
	var filter = 	$('#autoLoadFilter').val();
	if(type == 		'construction')
		{
		if(value !='')
			showObject(value, type, 1);
		if(filter != '')
			showConstruction(filter);
		}
	else if(type == 'firm')
		{
		if((value != '')&&(value != 0))
			showObject(value, type, 1);
		else
			showFirm('');
		}
	else if(type == 'spec')
		{
		if((value != '')&&(value != 0))
			showObject(value, type, 1);
		else
			showFirm('');
		}

	}

function GetStrPrt(str, del, indx)
	{
	strArr1 = str.split(del);
	var ret = strArr1[indx];
	return ret;
	}
function setParentObj(id, type, name, title)
	{
	this.id = id;
	this.type = type;
	this.name = name;
	this.title = title;
//	alert('setParentObj '+ this.type);
	}
function setpointImg(path, fileName,  fileExt)
	{
	this.path = path;
	this.fileName = fileName;
	this.fileExt = fileExt;
	}
function createPlacemarkConstruction(obj) //создает метку стройки
	{

	var objectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		hintContent: obj.name,
		firmName: obj.name,
		nameTrans: obj.nameTrans,
		number: obj.number,
		rate: obj.rate,
		info: obj.info,
		firmId: obj.objId,
		objType: obj.objType,
		objId: obj.objId,
		adress: obj.adr,
		state: obj.state,
		stateId: obj.stateId,
		material: obj.material,
		materialId: obj.materialId,
		logo: obj.logo,
		orgSting: obj.orgSting,
		fotoInfoSting: obj.fotoInfoSting,
		fotoRenderSting: obj.fotoRenderSting,
		fotoShemeSting: obj.fotoShemeSting,
		fotoSting: obj.fotoSting,
		mngSting: obj.mngSting,
		img: obj.img,
		labelFoto: obj.labelFoto,
		dateLastFoto: obj.dateLastFoto,
		dateStart: 	obj.dateStart,	
		dateEnd: 	obj.dateEnd,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		iconImageHref: '/src/design/main/img/png/map_marker_small.png',
		iconImageSize: [12,12],
		iconImageOffset: [-6,-6],
		iconShadow: false,
		iconShadowImageHref: '',
		iconShadowImageSize: [0,0],
		iconShadowImageOffset: [0,0],
		balloonContentLayout:  'my#tplConstruction',
		baloonMinHeight: 400,
		baloonMinWidth: 400
		}
		);
	objectPlacemark.events
		.add('balloonopen', function () 
			{			
			FB.create('.imgBaloonLink', 'gallery');
/*			var cssShadow = {'-webkit-box-shadow' : '0 5px 5px rgba(0, 0, 0, 0.5)', '-moz-box-shadow' : '0 5px 5px rgba(0, 0, 0, 0.5)', 'box-shadow':'0 5px 5px rgba(0, 0, 0, 0.5)'};
			$('.ymaps-image-with-content').css(cssShadow);*/

//			$('span[id$="state_"]').bind("click", function() {alert(showProperties(this));});
			$('#objId').val(obj.objId);
			$('#objType').val(obj.objType);
			}
			
			);
/*	objectPlacemark.events
		.close('balloonclose', function () 
			{			
			alert(balloonclose);
			}			
			);*/
	return objectPlacemark;
	}
function createPlacemarkFirm(obj) //создает метку фирмы
	{

	var objectPlacemark = new ymaps.Placemark(obj.coordinates, 
		{
		hintContent: obj.name,
		firmName: obj.name,
		nameTrans: obj.nameTrans,
		number: obj.number,
		rate: obj.rate,
		info: obj.info,
		firmId: obj.objId,
		objType: obj.objType,
		objId: obj.objId,
		adress: obj.adr,
		phone: obj.phone,
		logo: obj.logo,
		orgSting: obj.orgSting,
		mngSting: obj.mngSting,
		img: obj.img,
		coordStr: obj.coordinates[0] + ' : ' + obj.coordinates[1]
		},
		{
		iconImageHref: '/src/design/main/img/png/map_marker_small.png',
		iconImageSize: [12,12],
		iconImageOffset: [-6,-6],
		iconShadow: false,
		iconShadowImageHref: '',
		iconShadowImageSize: [0,0],
		iconShadowImageOffset: [0,0],
		balloonContentLayout:  'my#tplFirm',
		baloonMinHeight: 400,
		baloonMinWidth: 400
		}
		);
	objectPlacemark.events
		.add('balloonopen', function () 
			{
			$('#objType').val(obj.objType);
			$('#objId').val(obj.objId);
			});
	return objectPlacemark;
	}
function setPointConstructionStupid(obj) //поля метки для стройки
	{

	var tmpArr,  fileName;
	var tmpStr = '';
    this.number = 	obj[1];
    this.objType = 	obj[0];
    this.objId =	obj[2];
    this.name = obj[6];
    this.x = obj[4];
    this.y = obj[5];
    this.coordinates = [obj[4], obj[5]];
    this.adr = obj[3];
	this.stateId = obj[9];	
	this.rate = obj[8];	
	this.info = str_replace ( '<br />', '\n', obj[14] );
	this.nameTrans = obj[7];	
	this.material = obj[18];	
	this.materialId = obj[17];	
	
	this.labelFoto = (obj[9] == 2) ? 'Последние фотографии стройки' :  'Текущее состояние стройки' ;	
	
	this.state = 	((obj[10] == '')||(obj[10] == 0)) ? '' : "<div id='state'><strong>Статус стройки: </strong><span title='Показать все объекты в состоянии \"" + obj[10] + "\"' id= 'filter" + obj[2] + "_state~" + obj[9] + "' class='state_" + obj[9] + " actionLink' onClick='showConstruction(this)'>" + obj[10] + "</span></div>" 
	this.material = ((obj[18] == '')||(obj[18] == 0)) ? '' : '<div id="mat"><strong>Материал: </strong><span title="Показать все объекты из этого материала" id= "filter' + obj[2] + '_material~' + obj[17] + '" class="actionLink" onClick="showConstruction(this)">' + obj[18] + '</span></div>'; 
	if((obj[13] == '')||(obj[13] == 0))
		{
		tmpArr = obj[11].split(' ');
		tmpStr = tmpArr[0] + '#' + tmpArr[2];
		this.dateStart = '<div id="start"><strong>Начало мониторинга: </strong><span title="Показать все объекты,  строительство или наблюдение  за которыми началось в это время" id= "filter' + obj[2] + '_start~' + tmpStr + '" class="actionLink" onClick="showConstruction(this)">' + obj[11] + '</span></div>'; 
		}
	else
		{
		tmpArr = obj[13].split(' ');
		tmpStr = tmpArr[0] + '#' + tmpArr[2];
		this.dateStart = '<div id="start"><strong>Начало строительства: </strong><span title="Показать все объекты, строительство или наблюдение за которыми началось в это время" id= "filter' + obj[2] + '_start~' + tmpStr + '" class="actionLink" onClick="showConstruction(this)">' + obj[13] + '</span></div>'; 
		}
	tmpStr = '';
	if((obj[15] == '')||(obj[15] == 0))
		{
		tmpArr = obj[12].split(' ');
		tmpStr = tmpArr[0] + '#' + tmpArr[2];
		this.dateEnd = '<div id="end"><strong>Окончание мониторинга: </strong><span title="Показать все объекты, с такой же датой окончания строительства/наблюдения" id= "filter' + obj[2] + '_end~' + tmpStr + '" class="actionLink" onClick="showConstruction(this)">' + obj[12] + '</span></div>'; 
		}
	else
		{
		tmpArr = obj[15].split(' ');
		tmpStr = tmpArr[0] + '#' + tmpArr[2];
		this.dateEnd = '<div id="end"><strong>Окончание строительства: </strong><span title="Показать все объекты, с такой же датой окончания строительства/наблюдения" id= "filter' + obj.objId + '_end~' + tmpStr + '" class="actionLink" onClick="showConstruction(this)">' + obj[15] + '</span></div>'; 
		}
	tmpStr = '';
	this.foto = new Array();	
	this.dateLastFoto = obj[16];
	
	this.imgRender = new Array();	
	this.imgSheme = new Array();	
	this.imgInfo = new Array();	
	this.img = new Array();	
	
	var galleryStrInfo = galleryStrSheme = galleryStrRender = '';
	cnt = 0;
	if(obj[21]!='')		
		{
		var fotoInfo = obj[21].split('^^');
		tmpStr += '<div id="fotoInfo">';
		for(var i=0; i<fotoInfo.length; i++)
		if (fotoInfo[i] !='')
			{

			tmpArr = fotoInfo[i].split('size/');
			fileName =  tmpArr[1].split('.');
			this.imgInfo[cnt] = new setpointImg(tmpArr[0], fileName[0], fileName[1]);
			
			title 	= 	'Фото информационной доски объекта '+ obj[6] + ' город ' + $('#cityName').val();			
			imgLink = 	tmpArr[0] + imgSizeView + '/' + tmpArr[1];		
			if(i!=0)			
				galleryStrInfo += ',';			
			galleryStrInfo += '{href : \'' + imgLink + '\', title : \'' + title + '\'}';
			tmpStr += '<a   style="display:none" class="imgBaloonLink"  rel="gallery" href = "' + imgLink + '" title = "' +  title 
												+ '" target="_blank"><img id = "imgBaloonPrewInfo_' + tmpArr[1] + '" height="60" width="60" src="' 
												+ tmpArr[0] + '150' + '/' + tmpArr[1] + '" ></a>';
			cnt ++;
			}		
		tmpStr += '</div>';
		}
	this.fotoInfoSting = tmpStr;
	
	cnt = 0;
	tmpStr = '';
	if(obj[19]!='')	
		{
		var fotoRender = obj[19].split('^^');

		tmpStr += '<div id="fotoRender">';
		for(var i=0; i<fotoRender.length; i++)
		if (fotoRender[i] !='')
			{
			tmpArr = fotoRender[i].split('size/');
			fileName =  tmpArr[1].split('.');
			this.imgRender[cnt] = new setpointImg(tmpArr[0], fileName[0], fileName[1]);
			
			title 	= 	'Рендер объекта '+ obj[6] + ' город ' + $('#cityName').val();			
			imgLink = 	tmpArr[0] + imgSizeView + '/' + tmpArr[1];		
			if(i!=0)			
				galleryStrRender += ',';			
			galleryStrRender += '{href : \'' + imgLink + '\', title : \'' + title + '\'}';
			tmpStr += '<a   style="display:none" class="imgBaloonLink"  rel="gallery" href = "' + imgLink + '" title = "' +  title 
												+ '" target="_blank"><img id = "imgBaloonPrewInfo_' + tmpArr[1] + '" height="60" width="60" src="' 
												+ tmpArr[0] + '150' + '/' + tmpArr[1] + '" ></a>';
			cnt ++;
			}
		tmpStr += '</div>';			
		}
	this.fotoRenderSting = tmpStr;	

	cnt = 0;
	tmpStr = '';
	if(obj[20]!='')		
		{
		var fotoScheme = obj[20].split('^^');

		tmpStr += '<div id="fotoSheme">';
		for(var i=0; i<fotoScheme.length; i++)
		if (fotoScheme[i] !='')
			{
			tmpArr = fotoScheme[i].split('size/');
			fileName =  tmpArr[1].split('.');
			this.imgSheme[cnt] = new setpointImg(tmpArr[0], fileName[0], fileName[1]);						
			title 	= 	'Схема съёмки объекта '+ obj[6] + ' город ' + $('#cityName').val();
			imgLink = 	tmpArr[0] + imgSizeView + '/' + tmpArr[1];		
			if(i!=0)			
				galleryStrSheme += ',';			
			galleryStrSheme += '{href : \'' + imgLink + '\', title : \'' + title + '\'}';
			styleAdd = '';
			tmpStr += '<a   style="display:none" class="imgBaloonLink"'+ styleAdd + '  rel="gallery" href = "' + imgLink + '" title = "' +  title 
												+ '" target="_blank"><img id = "imgBaloonPrewSheme_' + tmpArr[1] + '" height="60" width="60" src="' 
												+ tmpArr[0] + '150' + '/' + tmpArr[1] + '" ></a>';
			
			cnt ++;
			}
		if(galleryStrRender != '')
			tmpStr += '<span class="actionLink imgBaloonMore" onClick="$.fancybox.open( [' + galleryStrRender + '] );">Рендеры</span>';			
		if(galleryStrInfo != '')
			tmpStr += '<span class="actionLink imgBaloonMore" onClick="$.fancybox.open( [' + galleryStrInfo + '] );">Информационные доски</span>';			
		tmpStr += '<span class="actionLink imgBaloonMore" onClick="$.fancybox.open( [' + galleryStrSheme + '] );">Схема съемки</span>';
		tmpStr += '</div>';
		}
	this.fotoShemeSting = tmpStr;	
	cnt = 0;
	tmpStr = '';
	if(obj[22]!='')
		{
		var fotoSet = obj[22].split('^^');

		tmpStr += '<div id="fotoSet">';
		for(var i=0; i<fotoSet.length; i++)
		if (fotoSet[i] !='')
			{
			tmpArr = fotoSet[i].split('size/');
			fileName =  tmpArr[1].split('.');
			this.foto[cnt] = new setpointImg(tmpArr[0], fileName[0], fileName[1]);

			title 	= 	'Фото c позиции ' + fileName[0] + '. Объект '+ obj[6] + ' город ' + $('#cityName').val();
			imgLink = 	tmpArr[0] + imgSizeView + '/' + tmpArr[1];		
			styleAdd = '';
			tmpStr += '<a  class="imgBaloonLink"'+ styleAdd + '  rel="gallery" href = "' + imgLink + '" title = "' +  title 
												+ '" target="_blank"><img id = "imgBaloonPrew_' + tmpArr[1] + '" height="60" width="60" src="' 
												+ tmpArr[0] + imgSizePrew + '/' + tmpArr[1] + '" ></a>';

			cnt ++;
			}
		tmpStr += '</div>';
		}
	this.fotoSting = tmpStr;	
		
		
		

			
	if(this.imgRender.length > 0)
		this.img[0] = this.imgRender[0];
	else
		this.img[0] = this.foto[0];
	this.logo = this.img[0].path + '150/' + this.img[0].fileName + '.' + this.img[0].fileExt;
	tmpStr = '';
	if(mngActions)
		{		
		tmpStr += '<div id = "mngStr">';
		tmpStr += '<span class="mngAct" id="af"  onClick="showEdtBox(\'' + mngActions.af + obj[2] + '\', 0)"><nobr>съёмка</nobr></span>';
		tmpStr += '<span class="mngAct" id="oe"  onClick="showEdtBox(\'' + mngActions.oe + obj[0] + '/' + obj[2] + '\', 0)"><nobr>изменить</nobr></span>';
		tmpStr += '<span class="mngAct" id="fe"  onClick="moveObj(\'' + obj[0] + '\', \'' + obj[2] + '\')"><nobr>переместить</nobr></span>';
		tmpStr += '<span class="mngAct" id="od"  onClick="delObj(\'' + mngActions.od + '\', 0)"><nobr>удалить</nobr></span></br>';
		tmpStr += '</div>';
		}
	this.mngSting = tmpStr;
	}	

function setPointFirm(objId, name, nameTrans, number, rate, logo, info, x, y, adr, phone, img) //поля метки для фирмы
	{
    this.number = 	number;
    this.objType = 	'firm';
    this.objId =	objId;
    this.name = name;
    this.x = x;
    this.y = y;
    this.coordinates = [x, y];
    this.adr = adr;
	this.phone = phone;	
	this.rate = rate;	
	this.info = info;	
	this.logo = logo;	
	this.nameTrans = nameTrans;	
	this.img = new Array();	
	var tmpStr = '';
	var tmpArr,  fileName;
	cnt = 0;
	if(img!='')		
		for(var i=0; i<img.length; i++)
		if (img[i] !='')
			{
			tmpArr = img[i].split('^^');
			fileName =  tmpArr[1].split('.');
			this.img[cnt] = new setpointImg(tmpArr[0], fileName[0], fileName[1]);
			cnt ++;
			}	
	if(mngActions)
		{		
		tmpStr += '<div id = "mngStr">';
		tmpStr += '<span class="mngAct" id="oe"  onClick="showEdtBox(\'' + mngActions.oe + this.objType + '/' + objId + '\', 0)"><nobr>изменить</nobr></span>';
		tmpStr += '<span class="mngAct" id="fe"  onClick="moveObj(\'' + this.objType + '\', \'' + objId + '\')"><nobr>переместить</nobr></span>';
		tmpStr += '<span class="mngAct" id="od"  onClick="delObj(\'' + mngActions.od + '\', 0)"><nobr>удалить</nobr></span></br>';
		tmpStr += '</div>';
		}
	this.mngSting = tmpStr;
	tmpStr = '';
	tmpStr += '<div id = "orgStr">';
	tmpStr += '<span class="orgAct" id="showAllOrgObjLink"  title="показать все объекты организации \'' + this.name + '\' на карте" onClick="showOrgObjects(\'' + this.objId + '\', 0)"><nobr>Показать все стройки с участием <b>' +this.name + '</b></nobr></span></br>';
	tmpStr += '</div>';		
	this.orgSting = tmpStr;
	}	
function getObjects(spdlType, objType, paramId,  city, show) //получение объектов с сервера и добавление их в геоколлекцию
	{
//	alert(filter.getParam());
	UI.pleaseWait();
	$.post("/spddl/", {type:spdlType, objType:objType, filter:filter.getParam(), object:paramId, city:city}, function(str) 
		{
		UI.pleaseWait();
//		alert('getObjects '+ objType);
		var titleStrArr = 	str.split('``');
		var titleStrParArr = 	titleStrArr[0].split('%%');
		parentObj = new setParentObj(titleStrParArr[0], objType, titleStrParArr[1], titleStrParArr[1]);
		

		var strArr = titleStrArr[1].split('~~');
		var valArr, layerArr, imgArr; //, showType;	
		var pointCnt = objCnt = 0;
		if(strArr.length <= 1)
			showType = 'empty';		
		else if((strArr.length == 2) && (strArr[0].length>5))
			showType = 'single';
		else if((strArr.length == 2) && (strArr[0].length<5))
			{
//			alert(strArr[0]);
			showType = 'empty';
			}
		else if(strArr.length <= startCluster)
			showType = 'marker';
		else if((strArr.length > startCluster) && (objType == 'construction'))
			showType = 'cluster';
		else if((strArr.length > startCluster) && (objType == 'firm'))
			showType = 'marker';
//		alert(showType);
		if(showType == 'empty')
			{
			show = 0;
			UI.showMessage('error', 'Объектов не найдено');			
			}		
		else
			{
			objCnt = strArr.length - 1;
			for(var i=0; i<strArr.length;  i++ )
				{
				if((strArr[i]!='')&&(strArr[i].length>10))
					{
					if(objType == 'construction')
						{
						
						valArr = strArr[i].split('##');
						pointC[pointCnt] =  new setPointConstructionStupid(valArr);
						objCollection.add(createPlacemarkConstruction(pointC[pointCnt]));
						if(showType == 'cluster')
							myCluster.add(createPlacemarkConstruction(pointC[pointCnt]));
						pointCnt ++;						
						
						}
					else
						{											
						valArr = strArr[i].split('##');
						if(objType == 'firm') 
							{
							if(valArr.length > 12)
								imgArr = valArr[12].split('@@');
							else
								imgArr = '';
							pointF[pointCnt] =  new setPointFirm(valArr[1], valArr[2], valArr[3], valArr[4], valArr[5], valArr[6], valArr[7], valArr[8], valArr[9],  valArr[10],  valArr[11], imgArr);
							objCollection.add(createPlacemarkFirm(pointF[pointCnt]));
							if(showType == 'cluster')
								myCluster.add(createPlacemarkFirm(pointF[pointCnt]));
							pointCnt ++;						
							}						
						else
							{
							if(valArr.length>1)
								{
								layerArr = valArr[9].split('%%');
								imgArr = valArr[10].split('@@');
								}	
							else
								{
								}
							}
						}
					}
				}
			}
		if(show)
			{
//			alert('show');
			myMap.geoObjects.add(objCollection);
		//alert('objCollection');
			if((showType == 'cluster')||(showType == 'marker'))
				{			
				myMap.setBounds(objCollection.getBounds(), { checkZoomRange: true,
				callback: function(err) {
					if (err) {alert('Ошибка масштаба - '+ myMap.getZoom());}}});
//				alert('showed');

				}
			else if (showType == 'single') //(objCnt == 1)
				{
				var point;
				if (objType == 'construction') 
					point = pointC[0];
				else if (objType == 'firm') 
					point = pointF[0];
				myMap.setCenter(point.coordinates);	
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
//			$('.ymaps-image-with-content').css(cssShadow);							
			}

		if((showType != 'empty'))
			{
			NAV.setSelectedObjProperties(parentObj.id, parentObj.type, parentObj.name, parentObj.title, objCnt);
			
			NAV.saveNavPosition();
			
			}
		}/*,  "json" */);	
	}
	
	
function showFirm() //показать единичный объект
	{
//	var constrState = GetStrPrt(obj.id, '_', 1);
	clearMapObjects(); 
	filter.clear();
	filter.updateForm();
//	NAV.setSelectedType('firm', 0, '', '');
	$('#objType').val('firm');		
	$('#objId').val('');		
	filter.setParam('type', $('#objType').val());
	getObjects('mapObjects', 'firm', '', $('#cityId').val(), 1); 
	}
function showConstruction(obj) //показать единичный объект
	{
	if(document.getElementById(obj.id))
		{
		var objId = obj.id;
		}
	else
		{
		var objId = obj;		
		}
	if(objId)
		{
//		alert(objId);
		filter.clear();
		filter.setFilterFromURL(objId);
		filter.updateForm();
		}
	else
		filter.setParam('id', '');		
	clearMapObjects(); 
	$('#objType').val('construction');		
	$('#objId').val('');		
	filter.setParam('type', $('#objType').val());
	getObjects('mapObjects', $('#objType').val(), '', $('#cityId').val(), 1); 
	}
function clearMapObjects() //показать единичный объект
	{
	if((mngActions != 0) &&(newObjectPlacemark))		
		myMap.geoObjects.remove(newObjectPlacemark);
	if(objCollection.getLength())
		{
		point = 	new Array();
		pointC = 	new Array();
		pointF = 	new Array();
		objCollection.removeAll();
		myMap.geoObjects.remove(objCollection);
		}
	myCluster.removeAll();
	if(selectedLayer)
		{
		$('#' + selectedLayer).removeClass("selected");		
		selectedLayer = '';		
		}
	}


function showObject(objId, objType, openBaloon) //показать единичный объект
	{
//	alert('showObject '+ objType);
/*	filter.clear();*/
	clearMapObjects(); 
/*	filter.updateForm();*/
	$('#objType').val(objType);		
	$('#objId').val(objId);		
	filter.setParam('type', $('#objType').val());
	filter.setParam('objId', objId);
	getObjects('mapSingleObj', objType, objId, document.getElementById('cityId').value, 1); 
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
	myMap.controls.add('mapTools');
	myMap.controls.add('typeSelector');
	myMap.controls.add('zoomControl');	
	myMap.copyrights.add('&copy; fotostroek.ru');
	myMap.behaviors.enable('scrollZoom');
	bounds = myMap.getBounds();
	var tplBaloonConstruction = "<div id='baloonPad' style='height:400px;'><div id='firmName'>" + 
		"<a title = 'Профиль стройки в каталоге' href='/list/construction/$[properties.objId]'>$[properties.firmName]</a>" + 
		"</div>" + 
		"$[properties.orgSting]" + 
		"<div id='info'>" + 
		"<img src='$[properties.logo]'>" + 
		"<p>$[properties.info]</p>" + 		
		"</div>" + 
		"<div id='adrActions'>" + 
		"<div id='adr'><strong>Адрес: </strong>$[properties.adress]</div>" + 
		"$[properties.state]" + 
		"$[properties.material]" + 
		"$[properties.dateStart]" + 
		"$[properties.dateEnd]" + 
		"<div id='labelFoto'><strong>$[properties.labelFoto]</strong> ($[properties.dateLastFoto])</div>" + 
		"$[properties.fotoInfoSting]" + 
		"$[properties.fotoRenderSting]" + 
		"$[properties.fotoShemeSting]" + 
		"$[properties.fotoSting]" + 
		"</div>" + 
		"<div id='historyLink'>" + 
		"<a title = 'Смотреть всю хронологию строительства в каталоге' href='/list/construction/$[properties.objId]#history'>История строительства</a>" + 
		"</div>" + 		
		"$[properties.mngSting]"+
		"";		

	var tplBaloonFirm = "<div id='baloonPad'><div id='firmName'>" + 
		"<a title = 'Профиль организации в каталоге' href='/list/firm/$[properties.firmId]'>$[properties.firmName]</a>" + 
		"</div>" + 
		"$[properties.orgSting]" + 
		"<div id='info'>" + 
		"<img src='$[properties.logo]'>" + 
		"<p>$[properties.info]</p>" + 		
		"</div'>" + 
		"<div id='adrActions'>" + 
		"<div id='adr'><strong>Адрес: </strong>$[properties.adress]</div>" + 
		"<div id='phone'><strong>Телефон: </strong>$[properties.phone]</div></div>" + 
		"$[properties.mngSting]"+
		"";		
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
	var tplFirm = ymaps.templateLayoutFactory.createClass(tplBaloonFirm);	
	var tplConstruction = ymaps.templateLayoutFactory.createClass(tplBaloonConstruction);	
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
//			alert('applyContent');
			FB.create('.imgBaloonLink', 'gallery');
			
            }
        });
        MainContentSubLayout = ymaps.templateLayoutFactory.createClass(tplBaloonConstruction);
        
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
	ymaps.layout.storage.add('my#tplConstruction', tplConstruction);	
	ymaps.layout.storage.add('my#tplFirm', tplFirm);	
	ymaps.layout.storage.add('my#tplStandardObj', tplStandardObj);	
	objCollection = new ymaps.GeoObjectCollection();
	myCluster = new ymaps.Clusterer(
		{
		clusterDisableClickZoom: false,
//		clusterDisableClickZoom: true,
		clusterBalloonMainContentLayout: MainContentLayout,
		clusterBalloonSidebarItemLayout: ItemLayout,
		clusterBalloonSidebarWidth: 170,
		clusterBalloonMaxWidth: 800,		
		clusterBalloonMaxHeight: 800,		
		clusterBalloonWidth: 600,		
		clusterBalloonHeight: 450		
		});
	myCluster.events.add('objectsaddtomap', function (e) 
		{
		changeIconsCluster();
		});		



	autoload();
	}	