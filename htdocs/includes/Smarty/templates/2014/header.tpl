<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="copyright" content="fotostroek.ru (c)" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta name="robots" content="index, follow" />
{*	<meta name="description" content="Ежемесячный фото мониторинг новостроек города Иркутска, Квартиры в новостройках Иркутска, планирови и цены, обсуждения и комментарии на ФОТОСТРОЕК.РУ. fotostroek.ru" />*}
{*	<meta name="keywords" content="новостройки, квартиры, продажа, фото, фотографии, новостроек, мониторинг, комментарии, застройщик, подрядчик, строительство, недвижимость" />	*}
	<meta name="description" content="{$meta.description}" />
    <title>{$title} | fotostroek.ru</title>
	<link href="http://www.fotostroek.ru/templates/feel_free/favicon.ico" rel="shortcut icon" type="image/x-icon" />	
	<link rel="stylesheet" href="/src/design/main/css/2014/style.css" type="text/css" />
	<link rel="stylesheet" href="/src/design/main/css/popup.css" type="text/css" />
	<link 	rel="stylesheet" href="/src/design/main/css/autoComlete.css" type="text/css" />
	
	<link rel="shortcut icon" href="http://www.fotostroek.ru/images/favicon.ico" type="image/x-icon" />
	<script src="/includes/jquery/jquery.js" type="text/javascript"></script>		
{if $client.mngAct }	
<!-- GB init-->	
	<script type="text/javascript">
		var GB_ROOT_DIR = "/includes/greybox/";
	</script>
	<script type="text/javascript" src="/includes/greybox/AJS.js"></script>
	<script type="text/javascript" src="/includes/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="/includes/greybox/gb_scripts.js"></script>
	<script src="/includes/JS/fs/adminRoutine.js" type="text/javascript"></script>	
		
	<link href="/includes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />				
<!-- GB init-->	
{/if}
	<script src="/includes/JS/fs/userInterface.js" type="text/javascript"></script>			
	<script src="/includes/JS/fs/userRoutine.js" type="text/javascript"></script>	
	<script src="/includes/jquery/jquery.autocomplete.js" type="text/javascript"></script>	
	<script src="/includes/JS/fs/searchFast.js" type="text/javascript"></script>
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
	
<!-- END slider-->	
	
	<script type="text/javascript">
	var startLocation = '{$header.startLink}';
	var curURI = 		'{$header.curURI}';
	var userCity = 		'{$header.userCity["id"]}';
	
	</script>
	
</head>
<body>
  <script type="text/javascript">
	var UI = new userInterface();
	var maxWidth = standartWidth = 0;
//	var maxWidth = $('#topToolBarContaner').width();
{literal}
	$(function(){
			maxWidth = 		$('#topToolBarContaner').width();
			standartWidth = $('#topToolBar').width();
				 var topPos = $('#topToolBar').offset().top; 
				 $(window).scroll(function() {				 
				  var top = $(document).scrollTop();
				  if (top > topPos) 
					{
					$('#topToolBar').addClass('fixed'); 
					$('#topToolBar').width(maxWidth); 
					$('#moveUp').show(); 
					}
				  else 
					{
					$('#topToolBar').width(standartWidth); 
//					$('#topToolBar').width(maxWidth); 
					$('#topToolBar').removeClass('fixed');
					$('#moveUp').hide(); 
					}
				 });
				});
	$(window).load(function () { 
		UI.setSize();   		
		if($('body').height() > UI.windowHeight)
			{
			var newHeight = $('body').height() - ($('#topToolBar').height()+ $('#topContaner').height());
			$('#pageRight').css({'height' : newHeight});				
			$('#pageLeft').css({'height' : newHeight});				
			}
	});
	$(document).ready(function(){
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
		$(window).bind("resize", function() {UI.setSize()});
		initSearch();		
		UI.setSize();   
		})
{/literal}
	</script>
{*
<noscript>
	<div  id='noScript' title='Часть функционала сайта недоступна'>&nbsp;&nbsp;В браузере отключен Java Script - функционал сайта частично недоступен!!!</div>
</noscript>*}
{if $client.isMng}
<input type='hidden' id='isMng' value='1'>
{/if}
{*<!----------------------						top toolbar					-->*}
<div id="topToolBarContaner">
<div id="topToolBar">
	<div id='userAuth'>
		{if !$header.userRegistered}						
		<span class='activeLink' title="Войти" id="show_site_enter">Вход</span>
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
		<input type = 'text' id="searchFast" name="searchFast" class="input_fast_search" value="Введите поисковый запрос..."  onfocus='this.value="";' onblur='clearSearchbarF()'/>  
		<span id='resMessageF'></span> 

	</div>
	<div id='compare' >
	{if $cmp.num>0}
	 <span onclick='apCmpStart(this)' title='сравнить квартиры' 		id='topCMPStart' class='cmpActive' >сравнить квартиры</span> <span id='topCMPNum'  class='cmpActiveNum' >({$cmp.num})</span> 
	{else}
	 <span onclick='apCmpStart(this)' title='список сравнения пуст' 	id='topCMPStart' class='cmpInactive' >сравнение квартир</span> <span id='topCMPNum'  class='cmpInactive' >({$cmp.num})</span>
	{/if}
	</div>
	{*<div id='minorLinks'>
	 <a title='о проекте' href='#'>?</a>
	 <span title='вверх' id='up'>&uarr;</span>
	</div>*}
	<div id='moveUp'>
	 {*<a title='о проекте' href='#'>?</a>*}
	 <span title='вверх' id='up' onclick='$(window).scrollTop(0);'>&uarr;</span>
	</div>
</div>	
</div>	

<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'/>
<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'/>
<input type="hidden" id="filterStr" name="filterStr" value='{if $filterString}{$filterString}{else}{/if}'/>

{*<!----------------------						End Of top toolbar					-->*}
<div id="page">
		<div id="topContaner">
			<div id="top" class='softborder1'>
{*<!----------------------						Logo								-->*}
				<!--noindex--><div id="topContanerLeft">
					<div id="toptext"><a href="/" rel="nofollow">FOTOSTROEK.RU</a></div>
					<div id="toptext2">Мониторинг новостроек Иркутска{*актуальная информация о новостройках*}</div>
				</div>
{*<!----------------------						Baner								-->*}
			{include file='2014/topSlider.tpl'}	
			<!--/noindex-->
				
			</div>	

{*<!----------------------						menu								-->*}
			<div id="menu">
				<div id="menuLeft">
					&nbsp;
				</div>
				<div id="menuRight" class='softborder1'>
					<div id="menuContent" class='softborder1' {*title='С Днём Победы!'*}>					
						<ul>
							<li {if $menuItems.curentItem == 'construction'}class='current'{/if}><a href='/{$menuItems.startLink}/construction/filter_state~1' title='Новостройки в Иркутске' >Новостройки</a></li>
							<li {if $menuItems.curentItem == 'apartment'}class='current'{/if}><a href='/{$menuItems.startLink}/apartment' title='Квартиры в новостройках Иркутска' {*style='color: #d33;'*} >Квартиры</a></li>
							<li {if $menuItems.curentItem == 'firm'}class='current'{/if}><a href='/{$menuItems.startLink}/firm'  title='Застройщики Иркутска' >Застройщики</a></li>
							<li {if $menuItems.curentItem == 'news'}class='current'{/if}><a href='/news' title='Новости' >Новости</a></li>
							<li {if $menuItems.curentItem == 'doc'}class='current'{/if}><a href='/doc' title='Полезная Информация' >Информация</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="centerPage">
			<div id="main">
				<div style="" id="pageLeft">
{*<!----------------------						filter								-->*}
					<div id='filter'>
						<div id='filterLabel'>
							<span>Поиск новостроек</span>
							<span><img src='/src/design/main/close.png' onclick=""  title='очистить фильтр'  alt='очистить фильтр' id='clearFilterImg' /></span>
							
						</div>
						<div class='filterOptionTitle'>
							Состояние стройки
						</div>
						<div class='filterOptionList'>
							<ul>
								<li><span id='filterValue_state~1' >В процессе</span></li>
								<li><span id='filterValue_state~2' >Готовые</span></li>
								<li><span id='filterValue_state~3' >В планах</span></li>
								<li><span id='filterValue_state~4' >Замороженные</span></li>
							</ul>							
						</div>
						<div class='filterOptionTitle'>
							Район
						</div>
						<div class='filterOptionList'>
							<ul>
								<li><span id='filterValue_district~4' >Ленинский</span></li>
								<li><span id='filterValue_district~2' >Октябрьский</span></li>
								<li><span id='filterValue_district~1' >Правобережный</span></li>
								<li><span id='filterValue_district~3' >Свердловский</span></li>
							</ul>							
						</div>
						{*<div id='filterMore'>
							<span>дополнительные параметры</span>
						</div>*}
						<div id='filterSubmit'>
							<div id="filterSubmitMap" class='inactiveButton' onclick='submitFilter(this)'>на карте</div>
							<div id="filterSubmitList" class="inactiveButton" onclick='submitFilter(this)'>списком</div>
						</div>
						
						
					</div>
					{include file='2014/leftColumn.tpl'}	
								
{*<!----------------------						center Page							-->*}					
				</div>
				<div id="pageRight">
