<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="copyright" content="fotostroek.ru (c)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Ежемесячный фото мониторинг новостроек города Иркутска, Квартиры в новостройках Иркутска, планирови и цены, обсуждения и комментарии на ФОТОСТРОЕК.РУ. fotostroek.ru">
	<meta name="keywords" content="новостройки, квартиры, продажа, фото, фотографии, новостроек, мониторинг, комментарии, застройщик, подрядчик, строительство, недвижимость">		
    <TITLE>{$title} | fotostroek.ru</TITLE>
	<link href="http://www.fotostroek.ru/templates/feel_free/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link rel="stylesheet" href="/src/design/main/css/2014/style.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/popup.css" type="text/css">
	<link 	rel="stylesheet" href="/src/design/main/css/autoComlete.css" type="text/css" />
	
	<link rel="shortcut icon" href="http://www.fotostroek.ru/images/favicon.ico" type="image/x-icon">
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />
	<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>		
{if $client.mngAct }	
<!-- GB init-->	
	<script type="text/javascript">
		var GB_ROOT_DIR = "/includes/greybox/";
	</script>
	<script type="text/javascript" src="/includes/greybox/AJS.js"></script>
	<script type="text/javascript" src="/includes/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="/includes/greybox/gb_scripts.js"></script>
	<SCRIPT src="/includes/JS/fs/adminRoutine.js" type=text/javascript></SCRIPT>	
		
	<link href="/includes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />				
<!-- GB init-->	
{/if}
	<script type="text/javascript" src="/includes/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/includes/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript">
var myMap;
var startLocation = '{$links.start}';
</script>
<!-- Yandex Maps init-->	
<script src="https://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>
<SCRIPT src="/includes/JS/fs/userNavigationMain.js" type=text/javascript></SCRIPT>
{if $client.isMng}
{/if}
<SCRIPT src="/includes/JS/fs/fbRoutine.js" type=text/javascript></SCRIPT>		
<SCRIPT src="/includes/JS/fs/userInterface.js" type=text/javascript></SCRIPT>			
<SCRIPT src="/includes/JS/fs/userRoutine.js" type=text/javascript></SCRIPT>			
<script src="/includes/jquery/jquery.autocomplete.js" language="JavaScript"></script>	
<SCRIPT src="/includes/JS/fs/searchFast.js" type=text/javascript></SCRIPT>
<!--slider-->	
	<script type="text/javascript" src="/includes/jquery/modernizr.custom.28468.js"></script>  
	<script type="text/javascript" src="/includes/jquery/jquery.cslider.js"></script>
	<link rel="stylesheet" type="text/css" href="/src/design/main/css/slider.css" />
	{literal}
		<!--[if lte IE 8]>
		  <style type="text/css">
		.da-slide h2{
			width: 724px;
			background:#e4e8d3;
			filter:alpha(opacity=80);
		}					   
		   
		   .da-slide h2 * {
			position:relative;
		   }
		  </style>
		 <![endif]-->				
	{/literal}
<!-- /slider-->	
	<script type="text/javascript">
	var startLocation = '{$header.startLink}';
	</script>	
</head>
<body>
   <script type="text/javascript">
	{if $client.name == 'Explorer'}
	var ie = true;
	{else}		
	var ie = false;
	{/if}
	{if $client.isMng}
	{/if}
	var NAV = new navigation(window.history.emulate, '{$links.start}', '{$title} | FotoStroek.ru');	
	var FB = new fancyBox();
	var UI = new userInterface();   
	{literal}  	
	if(NAV.enable)
		window.onpopstate = function( e ) {NAV.backward( e ) };
	$(window).load(function () { 
	});
	$(document).ready(function(){
		map = new YMaps.Map(document.getElementById("YMapsID"), {coordSystem: myCoordSystem});
		map.setCenter(options.mapCenter, options.mapZoom, myType);
		curZoom = options.mapZoom;
		if (options.zoomEnabled)
			map.addControl(new YMaps.Zoom({noTips: true}));
		map.addCopyright("© fotostroek.ru");
		map.enableScrollZoom();	
		
/*		var placemark = new YMaps.Placemark(new YMaps.Point(4321, 152));
		map.addOverlay(placemark);*/
		YMaps.Events.observe(map, map.Events.Click, function (obj, e) 
			{
			if(this._state.zoom>3)
				{
				var clickPoint = e.getCoordPoint();
				$('#coord').val(clickPoint);
				addPlacemark = new YMaps.Placemark(clickPoint);			
				addPlacemark.setOptions({style:styleNew, draggable: false});
				map.addOverlay(addPlacemark);		
				addPlacemark.openBalloon();
				}
			else
				alert('Необходимо увеличить масштаб для точности позиционирования!');
			});			
		YMaps.Events.observe(map, map.Events.Update, function (obj) 
			{
			if(this._state.zoom != curZoom)
				{
				curZoom = this._state.zoom;
				panDrawPoints();
				}
//			alert(this._state.zoom + ' upd');
			});					
		panGetPoints();
		UI.setSize();   
		if($('body').height() < UI.windowHeight)
			{
			$('#YMapsID').css({'height' : UI.windowHeight-(/*$('#footerContaner').height()+ */$('#topContaner').height() + 80)});				
			$('#centerContanerLeft').css({'height' : ($('#YMapsID').height()+ $('#titleBar').height())});				
			$('#pageLeft').css({'height' : ($('#pageRight').height())});				
			}
		else
			{
			$('#YMapsID').css({'height' : UI.windowHeight-(/*$('#footerContaner').height()+ */$('#topContaner').height() + 80)});				
			var newHeight = $('body').height() - ($('#topToolBar').height()+ $('#topContaner').height()+ $('#footerContaner').height()) + 50;
			$('#pageRight').css({'height' : newHeight});				
			$('#pageLeft').css({'height' : newHeight});							
			}
		$(window).bind("resize", function() {UI.setSize()});



		imgSizeView = (UI.documentWidth> 1100) ? 1024 : 600;
		initSearch();
		})
	{/literal}
	</script>
<noscript>
	<div  id='noScript' title='Часть функционала сайта недоступна'>&nbsp;&nbsp;В браузере отключен Java Script - функционал сайта частично недоступен!!!</div>
</noscript>
{if $client.isMng}
<input type=hidden id='isMng' value='1'>
{/if}
{*<!----------------------						top toolbar					-->*}
<div id="topToolBarContaner">
<div id="topToolBar">
	<div id='userAuth'>
		{if !$header.userRegistered}						
		<span class=activeLink title="Войти" id="show_site_enter">Вход</span>
		{else}
		<span {if $header.providerName} class = 'userName_{$header.providerName}' title='Вы зашли с помощью "{$header.providerTitle}"'{else}
				class = 'userName_fs' title='Пользователь сайта "ФОТОСТРОЕК"'{/if} 
			id="show_site_userName"><a href='/login/logoff/' title="Выход" >{$header.userDisplayName}</a></span>							
		{/if}
	</div>
	<div id='searchBar'>
		<span>
		Поиск по сайту
		</span>
{*		<input >*}
		<input type = 'text' id="searchFast" name="searchFast" class="input_fast_search" value="Введите поисковый запрос..."  onFocus='this.value=""; ' onBlur='clearSearchbarF()'/>  
		<span id='resMessageF'></span> 

	</div>
	<div id='compare' >
	{if $cmp.num>0}
	 <span onClick='apCmpStart(this)' title='сравнить квартиры' 		id='topCMPStart' class='cmpActive' >сравнить квартиры</span> <span id='topCMPNum'  class='cmpActiveNum' >({$cmp.num})</span> 
	{else}
	 <span onClick='apCmpStart(this)' title='список сравнения пуст' 	id='topCMPStart' class='cmpInactive' >сравнение квартир</span> <span id='topCMPNum'  class='cmpInactive' >({$cmp.num})</span>
	{/if}
	</div>
	{*<div id='minorLinks'>
	 <a title='о проекте' href='#'>?</a>
	 <span title='вверх' id='up'>&uarr;</span>
	</div>*}
	<div id='moveUp'>
	 {*<a title='о проекте' href='#'>?</a>*}
	 <span title='вверх' id='up' onClick='$(window).scrollTop(0);'>&uarr;</span>
	</div>
</div>	
</div>	


<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>
<input type="hidden" id="filterStr" name="filterStr" value='{if $filterString}{$filterString}{else}''{/if}'>

{*<!----------------------						End Of top toolbar					-->*}
<div id="page">
		<div id="topContaner">
			<div id="top" class=softborder1>
{*<!----------------------						Logo								-->*}
				<div id="topContanerLeft">
					<div id="toptext"><a href="/">FOTOSTROEK.RU</a></div>
					<div id="toptext2">Мониторинг новостроек Иркутска{*актуальная информация о новостройках*}</div>
				</div>
{*<!----------------------						Baner								-->*}
			{include file='2014/topSlider.tpl'}					
			</div>		
			
{*<!----------------------						menu								-->*}
			<div id="menu">
				<div id="menuLeft">
					&nbsp;
				</div>
				<div id="menuRight" class=softborder1>
					<div id="menuContent" class=softborder1 {*title='С Днём Победы!'*}>					
						<ul>
							<li {if $menuItems.curentItem == 'construction'}class=current{/if}><a href='/{$menuItems.startLink}/construction/filter_state~1/' title='Новостройки в Иркутске' >Новостройки</a></li>
							<li {if $menuItems.curentItem == 'apartment'}class=current{/if}><a href='/list/apartment/' title='Квартиры в новостройках Иркутска' {*style='color: #d33;'*} >Квартиры</a></li>
							<li {if $menuItems.curentItem == 'firm'}class=current{/if}><a href='/{$menuItems.startLink}/firm/'  title='Застройщики Иркутска' >Застройщики</a></li>
							<li {if $menuItems.curentItem == 'news'}class=current{/if}><a href='/news/' title='Новости' >Новости</a></li>
							<li {if $menuItems.curentItem == 'doc'}class=current{/if}><a href='/doc/' title='Полезная Информация' >Информация</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="centerPage">
			<div id="main">
				<div style="" id="pageLeft">&nbsp;{*
					<div id='filter'>
						<div id='filterLabel'>
							<span>Поиск новостроек</span>
							<span><img src='/src/design/main/close.png' onClick=""  title='очистить фильтр' id='clearFilterImg'></span>							
						</div>
						<div class=filterOptionTitle>
							Состояние стройки
						</div>
						<div class=filterOptionList>
							<ul>
								<li><span id='filterValue_state~1' >В процессе</span></li>
								<li><span id='filterValue_state~2' >Готовые</span></li>
								<li><span id='filterValue_state~3' >В планах</span></li>
								<li><span id='filterValue_state~4' >Замороженные</span></li>
							</ul>							
						</div>
						<div class=filterOptionTitle>
							Район
						</div>
						<div class=filterOptionList>
							<ul>
								<li><span id='filterValue_district~4' >Ленинский</span></li>
								<li><span id='filterValue_district~2' >Октябрьский</span></li>
								<li><span id='filterValue_district~1' >Правобережный</span></li>
								<li><span id='filterValue_district~3' >Свердловский</span></li>
							</ul>							
						</div>
						<div id='filterSubmit'>
							<div id="filterSubmitMap" class=inactiveButton onClick='submitFilter(this)'>на карте</div>
							<div id="filterSubmitList" class="inactiveButton" onClick='submitFilter(this)'>списком</div>
						</div>
						
						
					</div>
					{include file='2014/leftColumn.tpl'}	*}
<!----------------SHARE--------------------------->	
<script type="text/javascript" src="//yandex.st/share/share.js"		charset="utf-8"></script>
					<div id="listLeft">
						<div class='listLabel'>
							<span>Поделиться ссылкой</span>
						</div>						
</br>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"
></div> 				
					</div>
<!----------------SHARE--------------------------->				


					
				</div>
				<div id="pageRight">
