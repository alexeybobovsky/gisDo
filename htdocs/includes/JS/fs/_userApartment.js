var clickApSimple = function() {showApInfo('', UI.GetStrPrt(this.parentNode.id, '_', 1))};var clickApSelected = function() {apToggleSelectList(this, 'ApSelectAp')};var useLimit = 1;/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++apartment single+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/function apSelectMoreLink(obj) //2015_08_27 выбор панели дополнительных ариантов квартир	{		if(obj === undefined)		{		var index = 1;		$('#moreRes_1').addClass('selected');		}	else		{		var index = UI.GetStrPrt(obj.id, '_', 1); 		$('#moreResults .selector').removeClass('selected');		$("#" + obj.id).addClass('selected');		}//	var parValue = (action == 1) ? 'inline' : 'none';	$('[id ^= moreResCont_]').css({'display' : 'none'});	$('#moreResCont_' + index).css({'display' : 'block'});	}/*------------------------------------------------------------------apartment single--------------------------------------------------------------------------*/function apApplyFilterAuto(param) 	{	if(param)		{		filterAp.clear();		filterAp.setFilterFromURL(param);		apShowFiltered();		filterAp.updateForm();		}		}function apShowFull() 	{	useLimit = 0;	apShowFiltered();		}function apShowFiltered() 	{	var showMng = ($("input").is("#isMng")) ? 1 : 0;//	alert(userCity);	UI.pleaseWait();	if(showMng>0)		{		$('#apAdmMultyActContaner').hide();				}	$.post("/spddl/", {type:'filteredApList', filter:filterAp.getParam(), useLimit:useLimit}, function(str) 		{		UI.pleaseWait();//		alert(str);		var apHtmlStr = objHtmlStr = '';		var titleStrArr = 	str.split('``');		var titleStrParArr = 	titleStrArr[0].split('%%');		var title = titleStrParArr[0];		var searchCnt = titleStrParArr[1];		var searchCntStr  = titleStrParArr[2];		var limit = (useLimit>0) ? 300 : 0;//		alert(title + ' - ' + searchCnt + ' - ' + searchCntStr);		var apArr =  titleStrArr[1].split('~~');		var objArr =  titleStrArr[2].split('~~');//		alert(showProperties(objArr));//		alert(useLimit);				if(searchCnt != 0)			{			//				alert ('searchCnt = ' + searchCnt+ '; limit = '  + limit);			if((searchCnt>(limit-1))&&(limit>0))				{//				alert (1);				$('#apFilerAlarmNum').html(searchCntStr);				$('#apFilerAlarm').slideDown("slow", function() {});				}			else				{//				alert (2);				$('#apFilerAlarm').slideUp("slow", function() {});				}			for(var k=0; k<objArr.length; k++)				{				if(objArr[k].length > 10)					{					valArr = objArr[k].split('##');										objHtmlStr += 	'<div class="objItem" 	id="filterApObj_' + valArr[0] + '" title="">' + 										'<div class="filterApObjTitle" title="' + valArr[1] + '"><nobr>' + valArr[1] + ' </nobr></div>' + 										'<span class="filterApObjMore" title="количество найденных вариантов">' + valArr[2] + '</span>' + 									'</div>';					}				}			$('#apObjListResult').html(objHtmlStr);						$('#apObjListContaner div.objItem').bind("click", 	function() 	{apFilterObjToggle(this)}); 				$('#apObjListContaner div.sortTitle img ').hide();			$('#apObjListContaner').slideDown("slow", function() {});			for(var k=0; k<apArr.length; k++)				{				if(apArr[k].length > 10)					{					valArr = apArr[k].split('##');	//				alert (valArr[5] + ' - ' + valArr[5].length + '; ' + valArr[12] + ' - ' + valArr[12].length);					apHtmlStr += '<div class="listApItem" id="listApItem_' + valArr[8] + '_' + valArr[0] + '"';					apHtmlStr +=  (valArr[5] == 1) ? ' title="квартира продана"' : '';					apHtmlStr +=  '><ul><li class="apListDistrict'; 					apHtmlStr +=  (valArr[5] == 1) ? ' apSoldList">' : '">';					/*******************************************isMng*****************************************************/					if(showMng>0)						{												apHtmlStr +=  '<div class="apMngSingleBlock">';						apHtmlStr +=  '<input id= "apCheck_' + valArr[8] + '_' + valArr[0] + '" class="redDark" type = "checkbox" title="Отметить" onClick="apToggleSingleItem()" >';						apHtmlStr +=  '<span id= "apEdit_' + valArr[0] + '" class="activeLink redDark" title="Редактировать" onClick="showEdtBoxAp(this)" > E </span>';						apHtmlStr +=  '<span id= "apSingleAct_Update_' + valArr[0] + '" class="activeLink redDark" title="Обновить дату" onClick="apSingleAction(this)" > U </span>';						apHtmlStr +=  '<span class="activeLink redDark" onClick="apSingleAction(this)" '; 						apHtmlStr +=  (valArr[5] != 1) ? ' id= "apSingleAct_Sold_' + valArr[0] + '" title="Снять с продажи"> S </span>':'  id= "apSingleAct_Return_' + valArr[0] + '" title="Вернуть в продажу"> R </span>';						apHtmlStr +=  '<span class="mngInterval ' + valArr[16] + '" title="Полных недель - ' + valArr[15] + '; полных дней - ' + valArr[14] + '">' + valArr[15] + '</span>';						apHtmlStr +=  '</div>';						}					/*******************************************isMng*****************************************************/					apHtmlStr +=	'<a class="fbScheme activeLink"  href="/map/construction/' + valArr[8] + '"'  + 														'title = "';					apHtmlStr +=  (valArr[5]  == 1) ? 'квартира продана"' : 'Расположение квартиры"';						apHtmlStr +=	'onClick = "showMiniMap(\'construction\', \'' + valArr[8] + '\');  return false;"' + 														'target="_blank">' + 														valArr[7] + 													'</a>' + 												'</li>';					apHtmlStr +=	'<li class="apListObjName';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList">' : '">';					apHtmlStr +=	'<a href = "/list/construction/' + valArr[8] +'">' + valArr[9] + '</a>'; 										apHtmlStr +=  (valArr[17]  != '') ?'<span title="блок-секция ' + valArr[17] + '" class="apListBSSimple">б/с - ' + valArr[17] + '</span>' : '';										apHtmlStr +=	'</li>';					apHtmlStr +=	'<li class="apListRoomNum';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList">' : '">';					apHtmlStr +=	'' + valArr[1] + '</li>';										apHtmlStr +=	'<li class="apListArea';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList" title = "квартира продана" > ' : '" title = "квад. метр" >';					apHtmlStr +=	'' + valArr[2] + '</li>';										apHtmlStr +=	'<li class="apListState';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList" > ' : '" >';					apHtmlStr +=	'' + valArr[11] + '</li>';										apHtmlStr +=	'<li class="apListFinish';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList" > ' : '"  >';					apHtmlStr +=	'' + valArr[10] + '</li>';					apHtmlStr +=	'<li class="apListFloor';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList">' : '">';					apHtmlStr +=	'' + valArr[3] + '</li>';					/*										apHtmlStr +=	'<li class="apListPlan">';					apHtmlStr +=  (((valArr[12] !== undefined)&&(valArr[12] != '')&&(valArr[12] != 0))) ? ' <a  class="imgLink " href="' + str_replace ('size', '1024', valArr[12]) + '"' +  																					'rel="gallery_plan_' + valArr[0] + '" title="План квартиры" target="_blank">' + 																								'<img class="icon25"  src="' + str_replace ('size', '60', valArr[12]) +'"></a></li>' : '&nbsp;-&nbsp;</li>';*/										apHtmlStr +=	'<li class="apListPrice';					apHtmlStr +=  (valArr[5]  == 1) ? ' apSoldList">' : '">';					apHtmlStr +=	'<a href="/list/apartment/' + valArr[0] + '" class="activeLink"  onClick = "showApInfo(this, ' + valArr[0] + ');  return false;"	';					apHtmlStr +=  (valArr[5]  == 1) ? ' title = "квартира продана" > ' : ' title = "подробнее" >';					apHtmlStr +=  ((valArr[4] != '')&&(valArr[4] != 0)) ? valArr[4] + ' т.р.' : 'договор.';					apHtmlStr +=	'</a></li>';								apHtmlStr +=	'<li class="apListCmp"	>';					apHtmlStr +=  ((valArr[13] != '')&&(valArr[13] != 0)) ? '<img class="icon18" id="cmpIcon_' + valArr[0] + '" title="Убрать из сравнения" src="/src/design/main/cmpMove.png"  onCLick="apToCmpList(this)" style="display:inline">' : 										'<img class="icon18" id="cmpIcon_' + valArr[0] + '" title="Добавить к сравнению" src="/src/design/main/cmpAdd.png"  onCLick="apToCmpList(this)">';									apHtmlStr +=				'</li>';										apHtmlStr +=				'</ul>' + 											'</div>';					}				}	//		alert(htmlCode);			$('#listApStartContaner').css({'display' : 'none'});			$('#listApTableContaner').css({'display' : 'inherit'});			$('#apEmptyMessage').slideUp("slow");			$('#listApTable').html(apHtmlStr);			apListStriped();	//		alert('ready');			$('.listApItem').bind("mouseover", 		function() 		{toggleCmpIcon(1, this)}); 				$('.listApItem').bind("mouseleave", 	function() 			{toggleCmpIcon(0, this)}); 				}		else			{			$('#listApTableContaner').css({'display' : 'none'});			$('#apEmptyMessage').slideDown("slow");//			apHtmlStr += '<div id="apEmptyMessage" class="borderAlarm"  >По Вашему запросу ничего не найдено. Пожалуйста, измените критерии поиска.</div>';			$('#apObjListContaner').slideUp("slow", function() {});			$('#apFilerAlarm').slideUp("slow", function() {});//			$('#listApTable').html(apHtmlStr);						}		NAV.setSelectedObjProperties(0, 'apartment', '', title, searchCntStr);				NAV.saveNavPositionAp();		useLimit = 1;		});	}function submitFilterAp()	{	apFilterInpSubmit();//	alert(showProperties(filterAp.getParam()));	if(!filterAp.isEmpty())		{		var url = startLocation;		var filterStr = filterAp.getFilterURL();//		alert('location - ' + curURI );		if((window.NAV)&&(NAV.enable)&&(curURI.indexOf('filter') > 0)) 			{//			alert('ajax! ' + filterStr);						apShowFiltered();			}		else			{			url += '/list/apartment/';						url += filterStr;/*			alert(url);			alert('location ' + url);			*/			window.location = url;			}		}		}	function setFilterAp()	{	this.city = userCity;	this.room = '';	this.area = '';	this.areaStart = '';	this.areaEnd = '';	this.price = '';	this.priceStart = '';	this.priceEnd = '';	this.finish = '';	this.state = '';	this.district = '';	this.sold = '';	this.isEmpty = function()		{		var filterSumm = 	this.room + 							this.state + 							this.district + 							this.area + 							this.price + 							this.finish + 							this.sold;		return ((filterSumm=='')||(filterSumm==0)) ? 1 : 0;		}	this.clear = function()		{		this.room = '';		this.area = '';		this.areaStart = '';		this.areaEnd = '';		this.price = '';		this.priceStart = '';		this.priceEnd = '';		this.finish = '';		this.state = '';		this.district = '';		this.sold = '';		}	this.getParam = function()		{		function setFilterParam(city, room, area, areaStart, areaEnd, price, priceStart, priceEnd,  finish, state, district, sold)			{			this.city = city;			this.room = room;			this.area = area;			this.areaStart = areaStart;			this.areaEnd = areaEnd;			this.price = price;			this.priceStart = priceStart;			this.priceEnd = priceEnd;			this.finish = finish;			this.state = state;			this.district = district;			this.sold = sold;			}		var out = new setFilterParam(this.city, this.room, this.area, this.areaStart, this.areaEnd, this.price, this.priceStart, this.priceEnd,  this.finish, this.state, this.district, this.sold);			return out;		}	this.setFilterFromURL = function(url) /**/		{//		alert(url);//		var str = GetStrPrt(url, 'filter_', 1);		var str = GetStrPrt(url, '_', 1);//		alert(str);		if(str != undefined)			{			var filterArr = str.split('-');	//			alert(showProperties(par[i], 'par'));			//			alert(str);			for(var i=0; i<filterArr.length;  i++ )				{	//			alert(str);				parArr = filterArr[i].split('~');	//			alert(filterArr[i] + ': ' + parArr[0] + ' - ' + parArr[1]);				if(parArr[0] == 'state')					{					this.state = parArr[1];					}				else if(parArr[0] == 'district')					{					this.district = parArr[1];								}				else if(parArr[0] == 'finish')					{					this.finish = parArr[1];								}				else if(parArr[0] == 'room')					{					this.room = parArr[1];								}				else if(parArr[0] == 'sold')					{					this.sold = parArr[1];								}				else if(parArr[0] == 'areaStart')					{					this.areaStart = parArr[1];								}				else if(parArr[0] == 'areaEnd')					{					this.areaEnd = parArr[1];								}				else if(parArr[0] == 'priceStart')					{					this.priceStart = parArr[1];								}				else if(parArr[0] == 'priceEnd')					{					this.priceEnd = parArr[1];								}				}			}		}	this.getFilterURL = function()  /**/		{		var filterStr = '';		var filterStrOut;		if(this.objId)			filterStrOut = this.objId;		else			{			if(this.room)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'room~' + this.room;							}			if(this.state)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'state~' + this.state;							}			if(this.finish)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'finish~' + this.finish;							}			if(this.district)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'district~' + this.district;							}						if(this.sold)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'sold~' + this.sold;							}			if(this.areaStart)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'areaStart~' + this.areaStart;							}			if(this.areaEnd)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'areaEnd~' + this.areaEnd;							}			if(this.priceStart)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'priceStart~' + this.priceStart;							}			if(this.priceEnd)				{								filterStr +=  (filterStr == '' ) ? '' : '-';							filterStr +=  'priceEnd~' + this.priceEnd;							}			filterStrOut = 'filter_' + filterStr;					}		return filterStrOut;		}	this.getParamArray = function()		{		function setFilterParamSingle(name, value)				{			this.name = name;			this.value = value;			}		var param = new Array();			param[0] = new setFilterParamSingle('room', 			this.room);			param[1] = new setFilterParamSingle('area', 			this.area)	;		param[2] = new setFilterParamSingle('price', 			this.price)	;		param[3] = new setFilterParamSingle('finish', 			this.finish)	;		param[4] = new setFilterParamSingle('state', 			this.state)	;		param[5] = new setFilterParamSingle('district', 		this.district)	;		param[6] = new setFilterParamSingle('sold', 			this.sold)	;		param[7] = new setFilterParamSingle('areaStart', 		this.areaStart)	;		param[8] = new setFilterParamSingle('areaEnd', 			this.areaEnd)	;		param[9] = new setFilterParamSingle('priceStart', 		this.priceStart)	;		param[10] = new setFilterParamSingle('priceEnd', 		this.priceEnd)	;		return param;		}	this.setParam =  function(name, value)		{				if(value == 0)			value = '';//		alert(name + ' - ' + value);		if((name == 'room')  || (name == 'Room'))			{			this.room = value;						}		else if(((name == 'price')  || (name == 'Price'))&&(value == '')) //clear			{//			this.price = value;			this.priceStart = this.priceEnd = value;						}		else if((name == 'priceStart')  || (name == 'PriceStart')  || (name == 'pricestart'))			{			this.priceStart = value;						}		else if((name == 'priceEnd')  || (name == 'priceend')  || (name == 'PriceEnd'))			{			this.priceEnd = value;						}		else if(((name == 'area')  || (name == 'Area'))&&(value == '')) // clear			{//			this.area = value;						this.areaStart = this.areaEnd = value;						}		else if((name == 'areaStart')  || (name == 'areastart')  || (name == 'AreaStart'))			{			this.areaStart = value;						}		else if((name == 'areaEnd')  || (name == 'areaend')  || (name == 'AreaEnd'))			{			this.areaEnd = value;						}		else if((name == 'district')  || (name == 'District'))			{			this.district = value;						}		if((name == 'state') || (name == 'State'))			{			this.state = value;			}		else if((name == 'finish')  || (name == 'Finish'))			{			this.finish = value;						}		else if((name == 'sold')  || (name == 'Sold'))			{			this.sold = value;			}		}	this.updateForm =  function()		{		var obj, objArr, label;		var par = this.getParamArray()		var inpName = clearName = '';//		$('[id ^= filterValue_]').removeClass('sortSelected');			$('[id ^= filterAp_]').removeClass('sortSelected');		$('[id ^= filterAp_clear] img').css({'display' : 'none'});								for(var i=0; i<par.length; i++)			{			if((par[i].name.indexOf('Start') <0 ) && (par[i].name.indexOf('End') <0 ))				{				$('#filterAp_' + par[i].name + '\\~' + par[i].value).addClass('sortSelected');				if((par[i].value!='')&&(par[i].value!=0))									$('#filterAp_clear\\~' + par[i].name + ' img').css({'display' : 'inline'});						}			else 				{				inpName = '';				switch(par[i].name)					{					case 'areaStart' : {inpName = 'filterAp_area_Start'; clearName = 'filterAp_clear~area'; }						break;					case 'areaEnd' : {inpName = 'filterAp_area_End'; clearName = 'filterAp_clear~area'; }						break;					case 'priceStart' : {inpName = 'filterAp_price_Start'; clearName = 'filterAp_clear~price'; }						break;					case 'priceEnd' : {inpName = 'filterAp_price_End'; clearName = 'filterAp_clear~price'; }						break;					}				if(inpName != '')					{//					alert(inpName + ' - ' + par[i].value);					$('#' + inpName).val(par[i].value);									if((par[i].value!='')&&(par[i].value!=0))						{						$('#' + inpName).addClass('setted');						$('#' + clearName + ' img').css({'display' : 'inline'});								}					}				}/*			if((par[i].value!='')&&(par[i].value!=0))				$('#filterAp_clear\\~' + par[i].name + ' img').css({'display' : 'inline'});		*//*						if(document.getElementById('filterValue_' + par[i].name + '~' + par[i].value))				document.getElementById('filterValue_' + par[i].name + '~' + par[i].value).className = 'sortSelected';*/			}//		checkFilter();				}	}function toggleApContaner() 	{	if($("#apContaner").css('display') == 'none')		{		$("#apContaner").slideDown("slow", function() {			$('#apPrev').removeClass('borderAttention');			$('#apPrev').addClass('borderWhite');			$('#moreApContaner').attr('title', 'скрыть');			$('#moreApContaner').text('<< свернуть');			resize();		});		}	else		{		$("#apContaner").slideUp("slow", function() {			$('#apPrev').removeClass('borderWhite');			$('#apPrev').addClass('borderAttention');			$('#moreApContaner').attr('title', 'показать');			$('#moreApContaner').text('подробнее >>');			resize();					});		}			}function toggleApList() 	{	if($("#listApSingleContaner").css('display') == 'none')		{				$("#listApSingleContaner").slideDown("slow", function() {			$('#moreApList').attr('title', 'скрыть');			$('#moreApList').text('<< свернуть список');						resize();		});		}	else		{		$("#listApSingleContaner").slideUp("slow", function() {			$('#moreApList').attr('title', 'показать');			$('#moreApList').text('показать квартиры списком >>');			resize();					});		}			}function toggleCmpIcon(action, obj) /*показать иконку сравнения*/	{	var parValue = (action == 1) ? 'inline' : 'none';	var param = UI.GetStrPrt(obj.id, '_', 2); //	alert(UI.GetStrPrtLast($('#cmpIcon_' + param).attr('src'), '/') + ' != ' +  UI.GetStrPrtLast(imgCmpMove.src, '/'));	if(UI.GetStrPrtLast($('#cmpIcon_' + param).attr('src'), '/') != UI.GetStrPrtLast(imgCmpMove.src, '/'))		{		$('#cmpIcon_' + param).css({'display' : parValue});		}	}function apSortSingle(obj) /*сортировка таблицы*/	{	var param = order = '';	param = UI.GetStrPrt(obj.id, '_', 1); 	//	alert($(obj).attr("class"));//	alert(obj.parentNode.className);	var parentObj = obj.parentNode;	if((parentObj.className.indexOf('sortMe')>=0) || (parentObj.className.indexOf('sortDesc')>=0))		{		order = 'asc';			$('#pageContent .listApHeader ul li').removeClass('sortAsc');		$('#pageContent .listApHeader ul li').removeClass('sortDesc');		$('#pageContent .listApHeader ul li').addClass('sortMe');		$(parentObj).addClass('sortAsc');		$(parentObj).removeClass('sortMe');//		.parent		}	else if(parentObj.className.indexOf('sortAsc')>=0)		{		order = 'desc';		$('#pageContent .listApHeader ul li').removeClass('sortAsc');		$('#pageContent .listApHeader ul li').removeClass('sortDesc');		$('#pageContent .listApHeader ul li').addClass('sortMe');		$(parentObj).addClass('sortDesc');		$(parentObj).removeClass('sortMe');		}	if(param == 'bs')		sortPar = 'apListBS';	else if(param == 'room')		sortPar = 'apListRoomNum';			else if(param == 'floor')		sortPar = 'apListFloor';			else if(param == 'area')		sortPar = 'apListArea';			else if(param == 'finish')		sortPar = 'apListFinish';			else if(param == 'price')		sortPar = 'apListPrice';		//	alert($('#pageContent .listApItem  .' + sortPar).length);//	$('#listApContaner>div .listApItem').tsort();	$('#pageContent .listApItem ul li').css({'color' : 'inherit'});	$('#pageContent .listApItem .' + sortPar).css({'color' : '#038600'});	$('#pageContent .listApItem').tsort('.' + sortPar, {order:order});	$('#pageContent .apListPlan').removeClass('sortMe');	$('#pageContent .apListFoto').removeClass('sortMe');	$('#pageContent .apListCmp').removeClass('sortMe');	apListStriped();	}function testSort(obj) /*сортировка таблицы*/	{	var param = order = '';	param = UI.GetStrPrt(obj.id, '_', 1); 	//	alert($(obj).attr("class"));//	alert(obj.parentNode.className);	var parentObj = obj.parentNode;	if((parentObj.className.indexOf('sortMe')>=0) || (parentObj.className.indexOf('sortDesc')>=0))		{		order = 'asc';			$('#pageContent .listApHeader ul li').removeClass('sortAsc');		$('#pageContent .listApHeader ul li').removeClass('sortDesc');		$('#pageContent .listApHeader ul li').addClass('sortMe');		$(parentObj).addClass('sortAsc');		$(parentObj).removeClass('sortMe');//		.parent		}	else if(parentObj.className.indexOf('sortAsc')>=0)		{		order = 'desc';		$('#pageContent .listApHeader ul li').removeClass('sortAsc');		$('#pageContent .listApHeader ul li').removeClass('sortDesc');		$('#pageContent .listApHeader ul li').addClass('sortMe');		$(parentObj).addClass('sortDesc');		$(parentObj).removeClass('sortMe');		}	if(param == 'distr')		sortPar = 'apListDistrict';	else if(param == 'floor')		sortPar = 'apListFloor';			else if(param == 'room')		sortPar = 'apListRoomNum';			else if(param == 'bs')		sortPar = 'apListBSsearch';			else if(param == 'area')		sortPar = 'apListArea';			else if(param == 'obj')		sortPar = 'apListObjName';			else if(param == 'state')		sortPar = 'apListState';			else if(param == 'finish')		sortPar = 'apListFinish';			else if(param == 'price')		sortPar = 'apListPrice';		//	alert($('#pageContent .listApItem  .' + sortPar).length);//	$('#listApContaner>div .listApItem').tsort();	$('#pageContent .listApItem ul li').css({'color' : 'inherit', 'font-weight' : 'inherit' });	$('#pageContent .listApItem .' + sortPar).css({'color' : '#038600', 'font-weight' : 'bold'});	$('#pageContent .listApItem').tsort('.' + sortPar, {order:order});	$('#pageContent .apListPlan').removeClass('sortMe');	$('#pageContent .apListFoto').removeClass('sortMe');	$('#pageContent .apListCmp').removeClass('sortMe');	apListStriped();	}function apListStriped() /*полосатая таблица*/	{	var counter = 0;	$("#pageContent .listApItem").each(function (i) {		if(this.style.display !='none')			{			counter ++; 			this.style.backgroundColor = (Math.floor(counter/2) * 2 == counter) ? '#efefef' : '#ffffff';			}		});		}	function apFilterObjReset() /**/	{	$('[id ^= filterApObj_]').each(function (i) 		{		$('#' + this.id).removeClass("objActive");		$('#' + this.id).removeClass("objInactive");				});	$('[id ^= listApItem_]').each(function (i) 		{		$('#' + this.id).show();		});	$('#apObjListContaner div.sortTitle img ').hide();			}function apFilterObjToggle(obj) /**/	{/*	alert(showProperties(obj, 'd'));	alert(obj.id);*///	var state;	var selectCnt = unSelectCnt = 0;	var selected = 		new Array();		var unselected = 	new Array();		if(	$(obj).hasClass('objActive'))		{		$(obj).removeClass("objActive");		$(obj).addClass("objInactive");	//		state = 0;		}	else if($(obj).hasClass('objInactive'))		{		$(obj).removeClass("objInactive");		$(obj).addClass("objActive");		//		state = 1;				}	else		{		$(obj).addClass("objActive");				}	$('[id ^= filterApObj_]').each(function (i) 			{			if(	$('#' + this.id).hasClass('objActive'))				{				selected[selectCnt] = UI.GetStrPrt(this.id, '_', 1);				selectCnt ++;				}			else				{				$('#' + this.id).addClass('objInactive')				unselected[unSelectCnt] =  UI.GetStrPrt(this.id, '_', 1);				unSelectCnt ++;				}						});	for(var i=0; i<unselected.length;  i++ )		{		$('[id ^= listApItem_' + unselected[i] + ']').each(function (i) 			{			$('#' + this.id).hide();			});		}	for(var i=0; i<selected.length;  i++ )		{		$('[id ^= listApItem_' + selected[i] + ']').each(function (i) 			{			$('#' + this.id).show();			});		}	setTimeout(function () {	$('#apObjListContaner div.sortTitle img ').show();	apListStriped();	UI.setSize();		}, 500);	}function apFilterInpSubmit() /**/	{	var param;	var paramArr = new Array();		paramArr[0] = 'area';		paramArr[1] = 'price';		for(var i=0; i<paramArr.length;  i++ )		{		param = paramArr[i];		if(($('#filterAp_' + param + '_Start').val() != '')||($('#filterAp_' + param + '_End').val() != ''))			{			$('#filterAp_clear\\~' + param + ' img').css({'display' : 'inline'});			}		else			$('#filterAp_clear\\~' + param + ' img').css({'display' : 'none'});							if($('#filterAp_' + param + '_Start').val() != '')			$('#filterAp_' + param + '_Start').addClass('setted');		else			{			$('#filterAp_' + param + '_Start').removeClass('setted');					filterAp.setParam(param + 'start' , 0);				}		if($('#filterAp_' + param + '_End').val() != '')			$('#filterAp_' + param + '_End').addClass('setted');					else			{			$('#filterAp_' + param + '_End').removeClass('setted');					filterAp.setParam(param + 'end' , 0);				}		}	}function apFilterInpChange(obj) /*добавить в сравнение из списка*/	{//	if(obj.id === )	var id = param = value = '';//	var saveParam;	if(obj.id === undefined)		{		id = obj.attr('id');		value = obj.val();	//		saveParam = 1;		}	else		{		id = obj.id;		value = obj.value;	//		alert(value);//		saveParam = 0;		}		var paramArr = id.split('_'); 	param = paramArr[1]; 	paramPos = paramArr[2]; //	if(saveParam>0)		filterAp.setParam(param + paramPos , value);		if(($('#filterAp_' + param + '_Start').val() != '')||($('#filterAp_' + param + '_End').val() != ''))		{		$('#filterAp_clear\\~' + param + ' img').css({'display' : 'inline'});		}	else		$('#filterAp_clear\\~' + param + ' img').css({'display' : 'none'});					if($('#filterAp_' + param + '_Start').val() != '')		$('#filterAp_' + param + '_Start').addClass('setted');	else		{		$('#filterAp_' + param + '_Start').removeClass('setted');				filterAp.setParam(param + 'start' , 0);			}	if($('#filterAp_' + param + '_End').val() != '')		$('#filterAp_' + param + '_End').addClass('setted');				else		{		$('#filterAp_' + param + '_End').removeClass('setted');				filterAp.setParam(param + 'end' , 0);			}	}function apFilterClick(obj) /*добавить в сравнение из списка*/	{	var param = value = '';	var paramArr = UI.GetStrPrt(obj.id, '_', 1).split('~'); 	param = trim(paramArr[0]); 	value = trim(paramArr[1]); //	$("#" + obj.id).css("border","3px solid red");//	alert(param);	if(param != 'clear')		{		filterAp.setParam(param, value);					$('[id ^= filterAp_' + param + ']').removeClass('sortSelected');		$('#filterAp_' + param + '\\~' + value).addClass('sortSelected');		$('#filterAp_clear\\~' + param + ' img').css({'display' : 'inline'});				}	else if(param == 'clear')		{				filterAp.setParam(value, 0);					$('[id ^= filterAp_' + value + ']').removeClass('4');		$('[id ^= filterAp_' + value + ']').removeClass('sortSelected');		$('[id ^= filterAp_' + value + ']').val('');		$('#filterAp_clear\\~' + value + ' img').css({'display' : 'none'});						}//	alert(document.getElementById('filterAp_' + param + '~' + value));//	alert($('#filterAp_' + param + '~' + value));	}function apToCmpList(obj) /*добавить в сравнение из списка*/	{	var objId = UI.GetStrPrt(obj.id, '_', 1); 	//	alert($('#apId').val());	UI.pleaseWait();	$.post("/apartment/set/cmp/", {objId:objId}, function(str) 		{		UI.pleaseWait();		var valArr = str.split('__');		$(obj).fadeTo(500, 0.1, function(){			if(valArr[1] == 0)				{				$('#topCMPNum').html('(' + '0' + ')');				$('#topCMPStart').html('сравнение квартир');				$('#topCMPNum').removeClass('cmpActiveNum');				$('#topCMPNum').addClass('cmpInactive');				$('#topCMPStart').removeClass('cmpActive');				$('#topCMPStart').addClass('cmpInactive');				}			else				{				$('#topCMPNum').html('(' + valArr[1] + ')');				$('#topCMPStart').html('сравнить квартиры');				$('#topCMPNum').removeClass('cmpInactive');				$('#topCMPNum').addClass('cmpActiveNum');				$('#topCMPStart').removeClass('cmpInactive');				$('#topCMPStart').addClass('cmpActive');										}			$(obj).attr( 'title', (valArr[0] > 0) ? 'Убрать из сравнения' : 'Добавить к сравнению');			$(obj).attr( 'src', (valArr[0] > 0) ? imgCmpMove.src : imgCmpAdd.src);			$(obj).fadeTo(500, 1);			});		});		}function apToCmp(obj) /*добавить в сравнение*/	{//	alert($('#apId').val());	UI.pleaseWait();	$.post("/apartment/set/cmp/", {objId:$('#apId').val()}, function(str) 		{				UI.pleaseWait();		var valArr = str.split('__');		$('#apCompare').html( (valArr[0] > 0) ? 'из сравнения' : 'в сравнение');		$('#apCompare').attr('title' , (valArr[0] > 0) ? 'Убрать из сравнения' : 'Добавить к сравнению');		$("#compare").fadeTo(500, 0.1, function(){		if(valArr[1] == 0)			{			$('#topCMPNum').html('(' + '0' + ')');			$('#topCMPStart').html('сравнение квартир');			$('#topCMPNum').removeClass('cmpActiveNum');			$('#topCMPNum').addClass('cmpInactive');			$('#topCMPStart').removeClass('cmpActive');			$('#topCMPStart').addClass('cmpInactive');			}		else			{			$('#topCMPNum').html('(' + valArr[1] + ')');			$('#topCMPStart').html('сравнить квартиры');			$('#topCMPNum').removeClass('cmpInactive');			$('#topCMPNum').addClass('cmpActiveNum');			$('#topCMPStart').removeClass('cmpInactive');			$('#topCMPStart').addClass('cmpActive');									}			$("#compare").fadeTo(500, 1);			});		});		}function apSelectFloor(obj) 	{	var isStr = is_string(obj);	var floor = (isStr) ? obj : UI.GetStrPrt(obj.parentNode.id, '_', 1);	UI.pleaseWait();	$.post("/spddl/", {type:'floorApartment', objId:$('#objid').val(), floor:floor}, function(str) 		{		UI.pleaseWait();		var apArr =  str.split('~~');//		var valArr;				var htmlCode = apHtmlStr = apClass ='';		for(var k=0; k<apArr.length; k++)			{			apHtmlStr = '';			if(apArr[k].length > 10)				{				valArr = apArr[k].split('##');				if(k == 0 ) $('#apFirstApOnFloor').val(valArr[0]);				apHtmlStr += (valArr[1] > 0) ? valArr[1] + '-к' : '';				apHtmlStr += (apHtmlStr == '') ? '' : '/';				apHtmlStr += (valArr[2] > 0) ? valArr[2] + 'м' : '';				apHtmlStr += (apHtmlStr == '') ? '' : '/';				apHtmlStr += (valArr[4] > 0) ? valArr[4] + ' т.р.' : 'договор';				apHtmlStr += (apHtmlStr == '') ? 'квартира №' + valArr[0] : '';								htmlCode += '<li id="apList_'+ valArr[0] +'"  title="">';				apClass = (valArr[5] > 0) ? 'apSold' : '';				htmlCode += '<span class="' + apClass + '">' + apHtmlStr  + '</span> </li>';				}			}//		alert(htmlCode);		$('#ApSelectAp #ApSelectPanelList ul').html(htmlCode);		if(!isStr)			showApInfo('', $('#apFirstApOnFloor').val());		else			{//			alert($('#apId').val());			$('[id ^= apList_] span').removeClass('apSelected');			$('[id ^= apList_] span').bind("click", clickApSimple);							$("#apList_" + $('#apId').val() + " span").addClass('apSelected');			$("#apList_" + $('#apId').val() + " span").unbind("click", clickApSimple);			$("#apList_" + $('#apId').val() + " span").bind("click", clickApSelected);						}		});		}function apToggleSelectList(obj) 	{	if(apPanelMode == 'single')		{		var type;		if(obj.id == 'floorText')			{			type = 'floor';						}		else			{			type = 'single';									}		if(type == 'floor')			{			var liId = $('[id ^= floorList_] span.apSelected').eq(0).parent('li').attr('id');			var counter = liPos = 0;			$("[id ^= floorList_]").each(function (i) 				{				if(this.id == liId)					{					this.title = 'Закрыть';					liPos = counter;					}				else if(this.id != 'floorList_0')					{					this.title = 'Показать все квартиры на ' + UI.GetStrPrt(this.id, '_', 1)  + ' этаже';									}				else					{					this.title = 'Показать все квартиры без этажа';													}				counter ++ ;				});			}		else if(type == 'single')			{			var liId = $('[id ^= apList_] span.apSelected').eq(0).parent('li').attr('id');			var counter = liPos = 0;			$("[id ^= apList_]").each(function (i) 				{				if(this.id == liId)					{					this.title = 'Закрыть';					liPos = counter;					}				else					{					this.title = 'Показать квартиру';					}								counter ++ ;				});						}		UIap.apTogglePanel(obj, panelName, liPos);		}	}function showApInfo(contaner, id) 	{	UIap.apTogglePanel('', '', 0);	var flooStr = '';	var hidePlanCont, hideFotoCont;	UI.pleaseWait();	$.post("/spddl/", {type:'singleApartment', objId:id}, function(str) 		{		UI.pleaseWait();//		alert(str);		$('#apId').val(id);		var valArr = str.split('##');		if(valArr[3].length > 0)			{			$("#p_firm a").text(valArr[3]);			$("#p_firm a").attr('href', '/list/firm/' +  valArr[2]);			}		else			$("#p_contFirm").css({'display':'none'});//		alert(valArr[12]);//		$("#p_roomNum").text(valArr[5]);		if((valArr[4].length > 0) && (apPanelMode == 'list'))			{			$("#mainTitle").text('Квартира в ' + valArr[4]);			}		if(valArr[5] > 0)			{			$("#p_roomNum").css({'color':'inherit'});			$("#p_roomNum").text(valArr[5]);			flooStr += (flooStr == '') ? '' : '/';			flooStr += valArr[5] + '-к';			}		else			{			$("#p_roomNum").css({'color':'#ccc'});			$("#p_roomNum").text('не указана');			}//		$("#p_area").text(valArr[6]);		if(valArr[6] > 0)			{			$("#p_area").css({'color':'inherit'});			$("#p_area").text(valArr[6]);			flooStr += (flooStr == '') ? '' : '/';/*			flooStr += valArr[6] + 'м<sup>2</sup>';*/			flooStr += valArr[6] + 'м';			}		else			{			$("#p_area").css({'color':'#ccc'});			$("#p_area").text('не указана');			}		if(valArr[8].length > 0)			{			$("#p_finish").css({'color':'inherit'});			$("#p_finish").text(valArr[8]);			}		else			{			$("#p_finish").css({'color':'#ccc'});			$("#p_finish").text('не указана');			}		if(valArr[14].length > 0)			{			$("#p_kontact").css({'color':'inherit'});			$("#p_kontact").text(valArr[14]);			}		else			{			$("#p_kontact").css({'color':'#ccc'});			$("#p_kontact").text('не указан');			}		if(valArr[7] > 0)			{			$("#p_floor").css({'color':'inherit'});			$("#p_floor").text(valArr[7]);			}		else			{			$("#p_floor").css({'color':'#ccc'});			$("#p_floor").text('не указан');			}		if(valArr[9] > 0)			{//			$("#p_contPrice").css({'display':''});			$("#p_pricePost").css({'display':'inherit'});			$("#p_price").text(valArr[9]);			flooStr += (flooStr == '') ? '' : '/';			flooStr += valArr[9] + ' т.р.';			}		else			{			$("#p_pricePost").css({'display':'none'});			$("#p_price").text('договорная');			flooStr += (flooStr == '') ? '' : '/';			flooStr += 'договор';			}								if(valArr[10].length > 3)			{			$("#p_info").css({'color':'inherit'});			$("#p_info").html(valArr[10]);			}		else			{			$("#p_info").css({'color':'#ccc'});			$("#p_info").text('нет');			}		if((valArr[11]	!= '') &&(valArr[11]	!= 0 )) //продана			{			$('#apSold').val('1');				$('#aps').html('<nobr>вернуть в продажу</nobr>');			}		else			{			$('#apSold').val('0');									$('#aps').html('<nobr>снять с продаж</nobr>');			}		if(valArr[12].length > 0)			{			$("#p_BS").css({'color':'inherit'});			$("#p_BS").html(valArr[12]);			}		else			{			$("#p_BS").css({'color':'#ccc'});			$("#p_BS").text('не указана');			}		if((valArr[13]	!= '') &&(valArr[13]	!= 0 )) //изменение			{						if($('#apSold').val() == 1)				{				$('.apStatusOn').css({'display':'none'});				$('.apStatusOff').css({'display':'inherit'});				$('#apStatusOff').html(valArr[13]);				}			else				{								$('.apStatusOn').css({'display':'inherit'});				$('.apStatusOff').css({'display':'none'});				$('#apStatusOn').html(valArr[13]);				}//			$('#aps').html('<nobr>вернуть в продажу</nobr>');			}		if(valArr[15] != '')			{			var planArr =  valArr[15].split('~~');			var htmlCode = '';			for(var k=0; k<planArr.length; k++)				{				if(planArr[k]!='')					{					htmlCode += '<a class="imgLink"  href="' + str_replace ('size', '1024', planArr[k]) +'" rel= "gallery_plan" title="План квартиры №' + id + '" target="_blank">';					htmlCode += '<img class="icon60"  src="' + str_replace ('size', '60', planArr[k]) +'"></a>';					}				}			if(htmlCode.length>0)				{				hidePlanCont = 0;				$("#p_contImgPlan").css({'display':'inherit'});				$('#p_imgPlan').html(htmlCode);				}			else				{				hidePlanCont = 1;								}			}		else			{			hidePlanCont = 1;							}		if(valArr[16] != '')			{//			alert(valArr[13]);			var fotoArr =  valArr[16].split('~~');			var htmlCode = '';			for(var k=0; k<fotoArr.length; k++)				{				if(fotoArr[k].length > 10)					{//					alert(fotoArr[k].length);										htmlCode += '<a class="imgLink"  href="' + str_replace ('size', '1024', fotoArr[k]) +'" rel= "gallery_aFoto" title="Фото квартиры №' + id + '" target="_blank">';					htmlCode += '<img class="icon60"  src="' + str_replace ('size', '60', fotoArr[k]) +'"></a>';					}				}			if(htmlCode.length>0)				{				hideFotoCont = 0;				$("#p_contImgFoto").css({'display':'inherit'});				$('#p_imgFoto').html(htmlCode);				}			else				{				hideFotoCont = 1;								}						}		else			{			hideFotoCont = 1;							}		if(hideFotoCont)			$("#p_contImgFoto").css({'display':'none'});		if(hidePlanCont)			$("#p_contImgPlan").css({'display':'none'});					if (flooStr == '' )			flooStr += 'Квартира #' + id;					var cmpText = 'в сравнение';		var cmpTitle = 'Добавить к сравнению';					if(valArr[17] != '') //compare			{//			alert(valArr[13]);			var cmpArr =  valArr[17].split('~~');			for(var k=0; k<cmpArr.length; k++)				{				if(cmpArr[k] == valArr[0])					{					cmpText = 'из сравнения';					cmpTitle = 'Убрать из сравнения';										}				}			}		$('#apCompare').html(cmpText);		$('#apCompare').attr('title' , cmpTitle);		$('#apLink').attr('href' , '/list/apartment/' + valArr[0]);		$('#apLink').attr('target','_blank');								$("#numText").html(flooStr);				$("#floorText").html((valArr[7] > 0) ? valArr[7] + ' этаж' : 'этаж не указан');		$('[id ^= floorList_] span').removeClass('apSelected');		$('[id ^= floorList_] span').bind("click", function() 	{apSelectFloor(this)});				$('[id ^= apList_] span').removeClass('apSelected');		$('[id ^= apList_] span').bind("click", clickApSimple);								$("#floorList_" + valArr[7] + " span").addClass('apSelected');		$("#floorList_" + valArr[7] + " span").unbind("click", function() 	{apSelectFloor(this)});		$("#floorList_" + valArr[7] + " span").bind("click", function() 	{apToggleSelectList(this, 'ApSelectFloor')});		$("#apList_" + id + " span").addClass('apSelected');		$("#apList_" + id + " span").unbind("click", clickApSimple);		$("#apList_" + id + " span").bind("click", clickApSelected);						$('#apFloor').val(valArr[7]);//		alert(showProperties(contaner, 'd'));		if(contaner!='')			apSelectFloor(valArr[7]);		if(UI.panelVisible == false)			{			$("#uniPanel").css({'width':'400px', 'height':'482px'});					UI.togglePanel('', 'uniPanel', 0, '');						}					});		}