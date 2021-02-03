<!DOCTYPE html>
<html>
<head>
	<meta name="description" content="{$meta.description}" />
	<title>{$title} | {$header.siteName}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{*<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />*}
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />	
	<link rel="stylesheet" href="/src/design/main/css/gis/style.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/gis/popup.css" type="text/css">

	<link rel="stylesheet" href="/src/design/main/css/gis/jquery-ui.structure.min.css" type="text/css" />
	<link rel="stylesheet" href="/src/design/main/css/gis/jquery-ui.min.css" type="text/css" />

	<link rel="stylesheet" href="/src/design/main/css/gis/autoComlete.css" type="text/css" />
	<link rel="stylesheet" href="/src/design/switchery/switchery.min.css" />
	<link rel="stylesheet" href="/src/design/leaflet-routing-machine/leaflet-routing-machine.css" />
	<link rel="stylesheet" href="/includes/leaflet/L.GeoSearch-master/src/css/l.geosearch.css" />	
	<link rel="stylesheet" href="/includes/leaflet/MarkerCluster/MarkerCluster.css" />
	<link rel="stylesheet" href="/includes/leaflet/MarkerCluster/MarkerCluster.Default.css" />
{if $client.isMng}	
{*	<link rel="stylesheet" href="/src/design/chosen/chosen.css" type="text/css" />	
	<link rel="stylesheet" href="/src/design/beautyForms.css" type="text/css" />*}
	<link rel="stylesheet" href="/src/design/fileuploader.css" type="text/css"/>
{/if}	
	<script src="/includes/jquery/jquery.js"></script>

	<script src="http://api-maps.yandex.ru/2.0/?load=package.map&lang=ru-RU" type="text/javascript"></script>	
	<script src="http://maps.api.2gis.ru/1.0" type="text/javascript"></script>
	{*<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>*}	
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
	
	<script src="/includes/leaflet/leaflet-plugins-1.9.0/layer/tile/Yandex.js"></script>
	<script src="/includes/leaflet/leaflet-plugins-1.9.0/layer/tile/Bing.js"></script>
	<script src="/includes/leaflet/leaflet-2gis-master/dgis.js"></script>
	<script src="/includes/leaflet/leaflet-routing-machine.min.js"></script>
	<script src="/includes/leaflet/MarkerCluster/leaflet.markercluster.js"></script>
	<script src="/includes/jquery/jquery-ui.min.js" type="text/javascript"></script>	
{*	<script src="/includes/jquery/jquery.autocomplete.js" type="text/javascript"></script>	*}
	<script src="/includes/jquery/jquery.nicescroll.min.js" type="text/javascript"></script>	
	<script src="/includes/switchery/switchery.min.js"></script>
{*	<script src="/includes/switchery/switchery.js"></script>*}
	<script src="/includes/JS/gis/searchFastUI.js" type="text/javascript"></script>	
	<script src="/includes/JS/gis/filterSimple.js" type="text/javascript"></script>	
	<script src="/includes/JS/gis/filterLayer.js" type="text/javascript"></script>		
	<script src="/includes/JS/gis/gis.js" type="text/javascript"></script>		
	<script src="/includes/JS/gis/service.js" type="text/javascript"></script>		
	<script src="/includes/JS/gis/userInterface.js" type="text/javascript"></script>		
{*	<script src="/includes/JS/gis/baseTmp/reg.js" type="text/javascript"></script>
	<script src="/includes/JS/gis/baseTmp/naspu.js" type="text/javascript"></script>*}
{if $client.isMng}	
	<script type="text/javascript" src="/includes/jquery/fileuploader.js" ></script>
	<script type="text/javascript" src="/includes/JS/gis/admAction.js" ></script>
{/if}	
	<!--script src="bsList.js" type="text/javascript"></script-->		
	<script>
{if $client.isMng}		
var startStr = '*69F727D4F74061CDEB44032B0A7FBE5EE6453E76';
{else}
var startStr = '*69F727D4F74061fDEB44032B0A7FBE5EE6453E76';
{/if}

{literal}
var titleString = 'Иркутская область';
var GIS = 	new gisRoutine();
var UI = new userInterface();   	
var ROUT =	new Routine();   	
var LF =	new layerFilter();   	
//var coords = []; 		
var locationList = [];
var BSIndexOver;
var pkkActive = false;
var distr;
//var searchObj;
var searchIndex = [];

//var settlements = []; 
var UL = [];	
var ULayers = [], ULayerIndex = [], UObjects = [], UGeo = [], UO2L = [], ULSwitch = [], ULFilter = [];
var ULCluster =  new L.MarkerClusterGroup();
var switchULObj;
var distrLayerPar = '1007';

$(document).ready(function(){
	UI.setSize();   
	UI.toCenter(UI.waitBox);

//	UI.pleaseWait();
	$('#mapid').css({'height' : UI.documentHeight-($('#topContaner').height()+35)});				
	$('#mapid').css({'width' : UI.documentWidth});
	$('#mapid').css({'cursor': 'wait'});
	$('.balContaner').css({'max-height' : UI.documentHeight-($('#topContaner').height()+100)}); 
	$('#show_accList').bind("click", 	function () {/*loadReg();*/ UI.menuToggle(); } 	);	
	$('#titleBar').text(titleString);
	$('#menuListContaner').css({'top' : '32px'});
	$('#menuListContaner').css({'display' : 'block'});
	/*$('#titlePoly').bind("mouseover", 	function () {reg[BSIndexOver].poly.setStyle({'fillOpacity' : 0.6}); $(this).css({'display' : 'block'})});
	$('#titlePoly').bind("mouseout", 	function () {reg[BSIndexOver].poly.setStyle({'fillOpacity' : 0.2});  $(this).css({'display' : 'none'})});
	$('#titlePoly').bind("click", 	function () {reg[BSIndexOver].poly.openPopup();  $(this).css({'display' : 'none'})});
	$('#switchDistr').bind("change", 	function () {GIS.toggleRegAll(reg)});*/
	$('[id ^= switchUL_]').on("change", function (event){/*console.log('extend'); */GIS.toggleAllObjUL(event.currentTarget.id);});
	$('#objFloatBar').on('mouseover', function (event) {event.stopPropagation();$(this).css({'display' : 'block'});});
	$('#objFloatBar').on('mouseout', function (event) {$(this).css({'display' : 'none'});});
	$('.buttOptions').on('click', function (event) {event.stopPropagation();});
	$('#layerFloatBar').on('mouseover', function (event) {event.stopPropagation();$(this).css({'display' : 'block'});});
	$('#layerFloatBar').on('mouseout', function (event) {$(this).css({'display' : 'none'});});
	$('#layerFloatBar').on('click', function (event) {event.stopPropagation()});
	$('#switchULObj').on('change', function (event) {GIS.toggleObjVisibleUL(ULObjListOver)});
	$('#toolBox  .headCont ul li').on('click', function (event) {UI.TBClick(event.currentTarget.id)});
	$('#TBToolsZoom').on('click', function (event) {GIS.zoomAll()});
	$('#TBfilterClear').on('click', function (event) {LF.clear(); GIS.toggleAllObjListUL(); GIS.toggleAllObjUL(); UI.TBFilterContent(0);});
	$('#TBborderAction').on('change', function (event) {UI.TBBorderClick(event.currentTarget.id)});
	$('#menu2Pad .closeBtn').on("click", 	function (event) {
		GIS.erasePanel2();
		});
/*	GIS.loadReg(reg);	*/
//	settlements = 	GIS.parseGISFlow(geoMun, 'settlements');
//	GIS.testPr();
	GIS.loadUL();
//	$('#cityList').html(GIS.genTextBigList(settlements));

/*	var switchCity = new Switchery(document.querySelector('#switchCity'), { size: 'min'});		*/
//	$('#switchCity').bind("change", 	function () {GIS.togglePolyArr(settlements)});
	$('#toggleSearchBar').bind("click", 	function () {UI.toggleSearchBar('searchCityContaner')});
	$('#toggleSearchBarObj').bind("click", 	function () {UI.toggleSearchBar('searchObjContaner')});
	$('#searchBtn2Pad').bind("click", 	function () {UI.toggleSearchBar('filter2PadContaner')});
	
	UI.setPanel();   
//	initSearch('searchCity');	
//	initFilter('filter2Pad');	
	$("#filter2Pad").filterSimple({delay:"600", outerControl:"#searchBtn2Pad"});
	switchULObj = new Switchery(document.querySelector('#switchULObj'), { size: 'min'});	
	$("#ULContaner").niceScroll({cursorcolor:"#cfcfcf", cursorwidth:"4px"});
	$(".userLayerContent").niceScroll({cursorcolor:"#cfcfcf", cursorwidth:"4px"});
	$("#ULContaner").css({display:"inherit"});
	UI.TBClick('TBborder'); 
	});
//	$(window).bind("resize", function() {UI.setSize()});
	$(window).bind("load", 	function() {/*UI.pleaseWait(); 	*/	});
//	UI.waitShow = true;
	$("#waitBox").css({'display' : 'block'});

	var UL_selected = 0;
	var ULObjListOver =  '';
	var ULLayerOver;


{/literal}	
	</script>
{if $client.isMng}	
	<script>
	var actionUF = '{$client.mngAct.uf}';
	var actionAL = '{$client.mngAct.al}';
	var actionAO = '{$client.mngAct.ao}';
	var MNG = 	new gisManage();
	var OBJ =  	new gisObject();
{literal}	
	var uploader = new Array();
	var fileUploadParam = new Array();
	$(document).ready(function(){
		var cntUF;
		for(var i = 0; i < fileUploadParam.length; i++)
			{
//			console.log(i  + ' - ' + fileUploadParam[i].name);
			if(document.getElementById('file_' + fileUploadParam[i].name))
				{
//				console.log(fileUploadParam[i].name);
				uploader[cntUF] = new createFileUploader('Выбрать ' + fileUploadParam[i].title, fileUploadParam[i].name, actionUF);
				cntUF ++;
				}
			}
		MNG.initElements();
		OBJ.init();
		$('#objType').on("change", 	function (event) {OBJ.setType($(this).context.value);/* MNG.drawObjectForm();*/});		
		$('#tpMore').on("click", 	function (event) {MNG.ULtogglePointList()});
		$('#editObjUL').on('click', function (event) 	{MNG.ULEditObj(ULObjListOver)});
		
	});
{/literal}	
	</script>
{/if}		
</head>
<body>
<div id="waitBox" {*style="display:none;"*} ><img id="waitImg" src="/src/design/main/img/blueBars.gif" border="0" alt="" /></div>
<div id="topToolBarContaner">
<div id="topToolBar">
	<div id='showMenu'>
		<span class='' title="Список слоёв объектов" id="show_accList"> Слои </span>
	</div>
	<div id='titleBar'>


	</div>
	<div id='userAuth'>
		{if !$header.userRegistered}						
		<span class='activeLink' title="Войти" id="show_site_enter">Вход</span>
		{else}
		<span {if $header.providerName} class = 'userName_{$header.providerName}' title='Вы зашли с помощью "{$header.providerTitle}"'{else}
				class = 'userName_fs' title='Пользователь сайта ""'{/if} 
			id="show_site_userName"><a href='/login/logoff/' title="Выход" >{$header.userDisplayName}</a></span>							
		{/if}
	</div>
</div>	
</div>	
	<div id="titlePoly" >
	</div>
	<div id="mapid" style=''>
	</div>
	<div id="menuListContaner">
		<div id='accList'>
			<div class='accHeader  hEnbl' id="ULHeader"> 
				<div class='lbl'><span class="accHIcon accHIconEnbl"></span> Пользовательские слои </div>
				<div class='switchContaner' style='height:22px;'><div id='toggleSearchBarObj' class='activeButton' title='Быстрый поиск объектов'></div></div>
				<!--div class='switchContaner'>&nbsp;</div!-->
			</div>
			<div class='accContent'  id="ULContaner" >			
			
				<div id='objFloatBar' ><div id='objFloatCont'>
					<span id='objFloatSwitch'><input type='checkbox' class='js-switch' id='switchULObj'  /></span>
					{if $client.isMng}		
					<div id='editObjUL' 	 class='buttEdit activeButton' title='Изменить свойства объекта'></div>
					<div id='deleteObjUL' 	 class='buttDelete activeButton' title='Удалить объект'></div>
					{/if}
					</div>
				</div>
{*				
				<div id='searchObjContaner'>
					<!--div id='locationSearchActionStr'>
						<span class='activeButton'>Искать</span>
					</div-->
						<!--input id="searchCity"  /-->  
					<input type = 'text' id="searchObj" name="searchObj" class="input_fast_search" value="Введите поисковый запрос..."  onFocus='this.value=""; ' />  
					<span id='resMessageObj'></span> 				
				</div>			
*}				
				<div id='layerFloatBar' class='iconContanerFloat' >
					<div id='zoomDefUL' onClick='GIS.zoomDef_UL({$layerList[layer].l_id})'  class='buttZoomDefS activeButton' title='Уместить слой на экране'></div>
					<div id='infoUL' 	class='buttInfoS activeButton' title='Информация о слое'></div>
					<div id='objListUL' onClick='GIS.showObjListUL()'  class='buttList activeButton' title='Список объектов'></div>							
					{if $client.isMng}		
					<div id='editUL' 	onClick='MNG.ULEditLayer(this)' class='buttEditS activeButton' title='Изменить свойства слоя'></div>
					<div id='addObjUL' 	onClick='MNG.ULAddObj(this)' class='buttAddS activeButton' title='Добавить объекты'></div>
					{/if}
				</div>
				
				<div id='layerList' class='userLayerList'>
				{if $layerList}	
					{section name=layer loop=$layerList}{if !$layerList[layer].l_parId}
					<div class='userLayerContaner ULParent_0' id='ulH_{$layerList[layer].l_id}'>
						<div class="accHIconCont ULlvl_0" >
							<span class="accHIcon accHIconDsbl"></span>		
						</div>
						<div class='lbl'>{if $smarty.section.layer.index}{$layerList[layer].l_name}{else}{$layerList[layer].l_name}{/if}</div>
						<div class='switchContaner'{* style='height:22px;'*} >
							{*<input type='checkbox' class='js-switch' id='switchUL_{$layerList[layer].l_id}'  />*}
						</div>
						<div class='iconContaner' {* style='height:22px;'*} >
							<div id='layerOptUL_{$layerList[layer].l_id}' {*class='buttOptions' title='Действия'  
								onClick='GIS.toggleActionPanelLayerUL("ulH_{$layerList[layer].l_id}", 1);'*} ></div>							
						</div>
					</div>{*
					<script>
						var switchUL_{$layerList[layer].l_id} = new Switchery(document.querySelector('#switchUL_{$layerList[layer].l_id}'), {literal}{ size: 'min'}{/literal});		
					</script>*}
					{/if}{/section}
				{/if}
				</div>
{if $client.isMng}						
				<div id='layerAdd' class='paddingTop20 alignCenter'>	
					<span id='layerAddButton' class='activeButton'>Создать новый слой</span>					
				</div>				
				<div id='layerReload' class='paddingTop20 alignCenter'>	
					<span id='layerReloadButton' class='activeButton' onClick='GIS.genLayerListUL()'>Перегрузить слои</span>					
				</div>
{/if}					
				

			</div>			
			<div class='accHeader  hDsbl' id="searchHeader"> 
				<div class='lbl'><span class="accHIcon accHIconDsbl"></span> Маршруты </div>
				<div class='switchContaner' style='height:22px;'><div id='toggleSearchBar' class='activeButton' title='Поиск'></div></div>
			</div>
			<div class='accContent'  id="searchContaner" >			
				<div id='searchCityContaner'>
					<!--div id='locationSearchActionStr'>
						<span class='activeButton'>Искать</span>
					</div-->
						<!--input id="searchCity"  /-->  
					<input type = 'text' id="searchCity" name="searchCity" class="input_fast_search" value="Введите поисковый запрос..."  onFocus='this.value=""; ' {*onBlur='clearSearchbarF(this.id)'*}/>  
					<span id='resMessageF'></span> 				
				</div>
				<div id='locationContaner' >
					<div id='cityLabel'>					
					</div>
					<div id='detailAdrContaner'>					
						<div id='detailAdrSearchToggle' ><span class='activeLinkLittle'>уточнить местоположение</span></div>
						<div id='detailAdrSearchLabel'>Гоголя, 15</div>
						<div id='detailAdrSearchContaner'>
							<input type = 'text' id="detailAdrSearchInput" name="searchCity"  value='пример: "ул Ленина 14"'  onFocus='this.value=""; ' onBlur='if($(this).val() == "") $(this).val("пример: \"ул Ленина 14\"");'/>  
							<span id='detailAdrSearchSubmit' class='activeButton' title='Поиск'></span>
						</div>
						<div id='detailAdrSearchRenew'><span class='activeLinkLittle'>изменить</span></div>
					</div>					
				</div>
			</div>
			{*
			<div class='accHeader  hDsbl' id="distrHeader"> 
				<div class='lbl'><span class="accHIcon accHIconDsbl"></span> Районы  </div>
				<div class='switchContaner'><!--label for='switchDistr'>Отображать</label--><input type='checkbox' class='js-switch' id='switchDistr'  /></div>
			</div>
			<div class='accContent'  id="distrContaner" >			
				<ul class='accItem' id="distrList" >
				</ul>
			</div>
			
			<div class='accHeader hDsbl' id="cityHeader">
				<div class='lbl'><span class="accHIcon accHIconDsbl"></span>Границы Населённых пунктов</div>
				<div class='switchContaner'><!--label for='switchCity'>Отображать</label--><input type='checkbox' class='js-switch' id='switchCity'  /></div>
			</div>
			<div class='accContent' id="cityContaner"  >			
				<ul class='accItem '  id="cityList" >
				</ul>
			</div>
			*}
		</div>	
	</div>	
	<div id="toolBox">
		<div class='headCont' >
			<ul>
				<li id='TBborder'>
				<div class = 'activeButton' id='' title='Работа с границами'>
					Границы
				</div>
				</li>
				<li id='TBsearch'>
				<div class = 'activeButton' id='' title='фильтровать список'>
					Поиск
				</div>
				</li>
				<li id='TBtools'>
				<div class = 'activeButton' id='' title='фильтровать список'>
					Инструменты
				</div>
				</li>
				<li id='TBfilter'>
				<div class = 'activeButton' id='' title='фильтровать список'>
					Фильтр
				</div>
				</li>
				<li id='TBroute'>
				<div class = 'activeButton' id='' title='фильтровать список'>
					Маршрут
				</div>
				</li>
			</ul>			
		</div>
		<div class='bodyCont' >
			<div id='TBborderContaner' class='bodyContItem' >
				{*<p>TBborderContaner</p>*}
				<div>
				<label for='TBborderAction'>Границы районов</label> 
				<select id='TBborderAction' name='TBborderAction' >
					<option value='distrEmpty'>Без заливки</option>	
					<option value='distrFill'>С заливкой</option>	
					<option value='distrFillHeat'>С тепловой заливкой</option>	
					<option value='distrClear' selected>Не отображать</option>	
				</select>
				</div>
			</div>
			<div id='TBsearchContaner' class='bodyContItem' >
				{*<div id='searchObjContaner'>*}
					<!--div id='locationSearchActionStr'>
						<span class='activeButton'>Искать</span>
					</div-->
						<!--input id="searchCity"  /-->  
				<div>
				<label for='searchObj'>Искать</label> 
					<input type = 'text' id="searchObj" name="searchObj" class="input_fast_search" value="Введите поисковый запрос..."  onFocus='this.value=""; ' {*onBlur='clearSearchbarF(this.id)'*}/>  
					<span id='resMessageObj'></span> 				
				</div>
				{*</div>			*}
			</div>
			<div id='TBfilterContaner' class='bodyContItem' >
				<div>Фильтр не установлен!</div>
				<ul>
					<li class = 'activeButton' title='Сбросить фильтр' id='TBfilterClear'>					
						Сбросить фильтр
					</li>				
				</ul>
			</div>
			<div id='TBtoolsContaner' class='bodyContItem' >				
				<ul>
					<li class = 'activeButton' title='Вписать в масштаб' id='TBToolsZoom'>					
						Вписать в масштаб					
					</li>				
				</ul>
			</div>
			<div id='TBrouteContaner' class='bodyContItem' >
				TBrouteContaner
			</div>
		</div>
	</div>
	<div id="menu2Pad">
{*	<div class = 'buttSearch'id='searchBtn2Pad' title='фильтр по названию'></div>
	<div class = 'closeBtn'id='closeBtn' title='Отмена'></div>*}
	<div class = 'filterBtn buttFilter activeButton' id='searchBtn2Pad' title='фильтровать список'></div>
	<div class = 'closeBtn buttClose activeButton'id='closeBtn' title='Отмена'></div>
	<div class = 'menuPad' id='menuLayerObjList'>
	
		<h3></h3>				
		<div class='objPropertiesContaner'>
			<div  class='userLayerContent' id='ulC_0'>
				<div id="filter2PadContaner" class='filter2PadContaner' >
					<input type = 'text' id="filter2Pad" name="filter2Pad" class="input_fast_search" />  
					<div class = 'closeFilter cursorPointer'id='closeBtnFilter' title='Отмена'></div>
				</div>
				<div  class='objListUL' id='ulO_0'>
				</div>
			</div>
		
		</div>
	</div>		
{if $client.isMng}			
	{include file='gis/managePanel.tpl'}			
{/if}		
	</div>			
	
	<script>
	{literal}
	var mymap = L.map('mapid', {zoomControl : false});	
	{/literal}
	</script>
	<script src="/includes/JS/gis/baseLayers.js" type="text/javascript"></script>	
	<script>
	</script>