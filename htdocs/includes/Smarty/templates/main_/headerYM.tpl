<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <TITLE>{$title} | Город-детям.рф</TITLE>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="copyright" content="gorod-detyam.ru (с)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Каталог организаций занятых воспитанием, лечением и развлечением детей в Иркутске">
	<meta name="keywords" content="Детские сады, школы Иркутска, частные детсады Иркутска, лицеи, кружки, танцы, школы раннего развития Иркутска">	

	<link href="/src/design/main/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/src/design/main/css/layout.css" rel="stylesheet" type="text/css" />
	<link href="/src/design/main/css/position_absolute.css" rel="stylesheet" type="text/css" />
	<link href="/src/design/main/css/popup.css" rel="stylesheet" type="text/css" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />
	<link 	rel="stylesheet" href="/src/design/main/css/autoComlete.css" type="text/css" />

	<script src="/includes/history/history.js" type="text/javascript" ></script>
	<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>

{if $client.isMng}	
<!-- GB init-->	
	<script type="text/javascript">
		var GB_ROOT_DIR = "/includes/greybox/";
	</script>
	<script type="text/javascript" src="/includes/greybox/AJS.js"></script>
	<script type="text/javascript" src="/includes/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="/includes/greybox/gb_scripts.js"></script>
		
	<link href="/includes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />			
<!-- GB init-->	
{/if}

	<script type="text/javascript" src="/includes/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/includes/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
var myMap;
var startLocation = '{$links.start}';
</script>

<script src="http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>
{*<script src="http://api-maps.yandex.ru/2.0.26/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>*}
<SCRIPT src="/includes/JS/gd/userNavigationMain.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/gd/mapYMmain.js" type=text/javascript></SCRIPT>
{if $client.isMng}
<SCRIPT src="/includes/JS/gd/mapYMadm.js" type=text/javascript></SCRIPT>
{/if}
<SCRIPT src="/includes/JS/gd/fbRoutine.js" type=text/javascript></SCRIPT>

	
	
	<SCRIPT src="/includes/JS/gd/userInterface.js" type=text/javascript></SCRIPT>
	<SCRIPT src="/includes/JS/gd/auth.js" type=text/javascript></SCRIPT>
</head>
<body>
   <script type="text/javascript">
	{if $client.name == 'Explorer'}
	var ie = true;
	{else}		
	var ie = false;
	{/if}
	{if $client.isMng}
	{literal}
	function setMngAction(objEdit, objDel, objMove)
		{
		this.oe = objEdit;
		this.od = objDel;
		this.om = objMove;
//		this.fd = firmDel;
		}
	{/literal}	
	var mngActions = new setMngAction('{$client.mnnAct.oe}', '{$client.mnnAct.od}', '{$client.mnnAct.fe}', '{$client.mnnAct.fd}' );	
	{else}
	var mngActions = 0;
	{/if}
	var NAV = new navigation(window.history.emulate, '{$links.start}', '{$title} | Город-детям.рф');	
	var FB = new fancyBox();
	var UI = new userInterface();   
	{literal}  	
	if(NAV.enable)
		window.onpopstate = function( e ) {NAV.backward( e ) };
	$(window).load(function () {
			$('#map_middle_left').css({'height' : $('#map_container_middle').height()});
			$('#map_middle_right').css({'height' : $('#map_container_middle').height()});
	});
	$(document).ready(function(){
		UI.setSize();   
/*		if($('#page').height() < UI.windowHeight)
			{*/
//			$('#center_container').css({'height' : UI.windowHeight-($('#footer_container').height() +  $('#top_container').height())});
//			}
			$('#map_pic').css({'height' : UI.windowHeight-($('#map_header_container').height() +  $('#map_container_top').height() +  $('#top_container').height() + 30)});
		$(window).bind("resize", function() {UI.setSize()});
		imgSizeView = (UI.documentWidth> 1100) ? 1024 : 600;
		$("#category_panel_map").css({'display':'none'});
		var pos = UI.getOffset('map_search_middle');		
		$("#resMessage").css({'top': (pos.top + 10) , 'left': ($('#map_search_middle').width() -150) });	
		})
	ymaps.ready(function(){		
		init(); 

		
	{/literal}
		{if  $client.isMng}
		initAdm(); 		
		{/if}
	{literal}		
		});		
		
	{/literal}
	</script>
<noscript>
	<div  id='noScript' title='Часть функционала сайта недоступна'>&nbsp;&nbsp;В браузере отключен Java Script - функционал сайта частично недоступен!!!</div>
</noscript>
{if $client.isMng}
<input type=hidden id='isMng' value='1'>
{/if}
<div id="page">
<!-- TOP --> 
	<div id="top_container">
    	<div id="top">
			<div id="top_menu_left">
                    <ul class="top_menu_left">
						{if !$header.userRegistered}
                        <li><span class="activeLink" title="Войти" id="show_site_enter">Вход</span></li>
						{else}
                        <li><span {if $header.providerName} class = 'userName_{$header.providerName}' title='Вы зашли с помощью "{$header.providerTitle}"'{/if} id="show_site_userName"><a href='/login/logoff/' title="Выход" >{$header.userDisplayName}</a></span></li>						
						{/if}
                        <li class="line-01"></li>
                        <!--li><a href="#" title="" id="show_city">Выбрать город</a></li-->
                        <li><span class = 'selectedMenuItem'> {$header.userCity.name}</span></li>
                    </ul>          
            </div>
            
            <div id="top_menu_middle">
                    <ul class="top_menu_middle">
						{section name=menu loop=$menuList}
						{if !$smarty.section.menu.first}
						<li class="line-01"></li>		
						{/if}
                        <li>
						<span title="{$menuList[menu].title}" id="{$menuList[menu].id}"
						{if  $menuList[menu].more} onClick="UI.togglePanel(this, 'category_panel', 0, 'selectedMenuItem')" {/if} class="{if  $menuList[menu].more}activeLink{/if}  {if $menuList[menu].id == $menuActive} selectedMenuItem {/if} {if $menuList[menu].id == $menuActive &&  !$menuList[menu].more}underline{/if}">
						{if $menuList[menu].id != $menuActive && !$menuList[menu].more}
						<a href="{$menuList[menu].link}">{$menuList[menu].title}</a>
						{else}
						{$menuList[menu].title}
						{/if}
						</span>
						</li>
						{/section}
                    </ul>                       
            </div>
            
            <div id="top_search">
                 <div id="search">
                      <div id="search-l">
                   		<input type="text" value="Поиск" />
                     </div>  
                      <div id="search-r">
                   		<a href="#" title="search">OK</a>
                     </div>                
                </div>          
            </div>
        
        </div>
    </div>
<!-- End Of TOP --> 
<!-- CENTER -->    
	<div id="center_container">