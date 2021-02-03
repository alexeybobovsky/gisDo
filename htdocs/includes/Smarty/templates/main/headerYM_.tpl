<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="copyright" content="fotostroek.ru (c)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Ежемесячный фото мониторинг новостроек города Иркутска, обсуждения и комментарии, ФОТОСТРОЕК.РУ, fotostroek.ru">
	<meta name="keywords" content="новостройки, фото, фотографии, новостроек, мониторинг, комментарии, заказчик, подрядчик, Иркутск, ФОТОСТРОЕК.РУ, fotostroek.ru">	
    <TITLE>{$title} | fotostroek.ru</TITLE>
	<link href="http://www.fotostroek.ru/templates/feel_free/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link rel="stylesheet" href="/src/design/main/css/system.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/general.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/template.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/popup.css" type="text/css">

	<link rel="stylesheet" href="/src/design/main/css/style.css" type="text/css">
	
	<link rel="shortcut icon" href="http://www.fotostroek.ru/images/favicon.ico" type="image/x-icon">
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />
	
{*	<link 	rel="stylesheet" href="/src/design/main/css/autoComlete.css" type="text/css" />*}
	
	
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

{*<script src="http://api-maps.yandex.ru/2.0.35/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>*}
<script src="http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>
{*<script src="http://api-maps.yandex.ru/2.0.26/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>*}

<SCRIPT src="/includes/JS/fs/userNavigationMain.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/fs/mapYMmain.js" type=text/javascript></SCRIPT>
{if $client.isMng}
<SCRIPT src="/includes/JS/fs/mapYMadm.js" type=text/javascript></SCRIPT>
{/if}
<SCRIPT src="/includes/JS/fs/fbRoutine.js" type=text/javascript></SCRIPT>		
<SCRIPT src="/includes/JS/fs/userInterface.js" type=text/javascript></SCRIPT>			
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
	function setMngAction(objEdit, objDel, objMove, addFoto)
		{
		this.af = addFoto;
		this.oe = objEdit;
		this.od = objDel;
		this.om = objMove;
//		this.fd = firmDel;
		}
	{/literal}	
	var mngActions = new setMngAction('{$client.mnnAct.oe}', '{$client.mnnAct.od}', '{$client.mnnAct.fe}', '{$client.mnnAct.af}' , '{$client.mnnAct.fd}' );	
	{else}
	var mngActions = 0;
	{/if}
	var NAV = new navigation(window.history.emulate, '{$links.start}', '{$title} | FotoStroek.ru');	
	var FB = new fancyBox();
	var UI = new userInterface();   
	{literal}  	
	if(NAV.enable)
		window.onpopstate = function( e ) {NAV.backward( e ) };
	$(window).load(function () {
/*		alert($('#isMng').val());*/
/*			$('#map_middle_left').css({'height' : $('#map_container_middle').height()});
			$('#map_middle_right').css({'height' : $('#map_container_middle').height()});*/
	});
	$(document).ready(function(){
		UI.setSize();   
/*		if($('#mainPad').height() < UI.windowHeight)*/
		$('#YMapsID').css({'height' : UI.windowHeight-($('#footer_container').height()+ $('#header_container').height() + 55)});				
/*		$('#map_pic').css({'height' : UI.windowHeight-($('#map_header_container').height() +  $('#map_container_top').height() +  $('#top_container').height() + 30)});*/
		$(window).bind("resize", function() {UI.setSize()});



		$('#listConstrSrvc').bind("click", function() {showList_Service('construction')});
		$('#listFirmSrvc').bind("click", function() {showList_Service('firm')});
		$('#test').bind("click", function() {testSpddl()});
		$('#clear').bind("click", function() {clearMapObjects()});
		
		
		$('.showConstrLink').bind("click", function() {showConstruction(this)});
		$('.showFirmLink').bind("click", function() {showFirm(this)});




		imgSizeView = (UI.documentWidth> 1100) ? 1024 : 600;
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

<table border="0" cellpadding="0" cellspacing="0" width="100%" id='mainPad'><tbody><tr><td align="left" valign="top">

<table border="0" cellpadding="0" cellspacing="0" width="100%" id = 'header_container'>
<tbody><tr><td align="center" valign="top" width="40%">
<div id="toptext"><a href="/">Мониторинг новостроек Иркутска</a></div>
<div id="toptext2">актуальная информация о новостройках</div>
</td>
<td align="left" valign="top" width="60%">

<div id="bann2">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
	<tr>
		<td align="left" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=3&amp;category_id=17&amp;Itemid=29"><img src="/src/design/main/img/Irkutsk_Kuybyshevskiy_Polenova_UKS_21.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=10&amp;category_id=17&amp;Itemid=29"><img src="/src/design/main/img/Irkutsk_Kuybyshevskiy_Sarafanovskaya_81_03.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=42&amp;category_id=19&amp;Itemid=18"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_4-Sovetskaya_80_Mairta_23.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=49&amp;category_id=19&amp;Itemid=18"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Aleksandra_Nevskogo_i_Piskunova_23.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=53&amp;category_id=19&amp;Itemid=18"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Baykalskaya_236b_ZhK_Fregat_02.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=58&amp;category_id=19&amp;Itemid=18"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Dalnevostochnaya_164.jpg" height="80px" width="100px"></a></td>
		<td align="center" valign="top" width="12%"><a href="http://www.fotostroek.ru/index.php?option=com_resource&amp;controller=article&amp;article=90&amp;category_id=22&amp;Itemid=56"><img src="/src/design/main/img/Irkutsk_Sverdlovskiy_2-Zheleznodorozhnaya_19_07.jpg" height="80px" width="100px"></a></td>
	</tr>
</tr></tbody>

</table>
</div>

</td>

</tr>
</tbody></table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
	<tr>
		<td align="left" valign="top" width="210px">
	<div id="leftmenu">		
		<div class="moduletable-menu">					
			<ul class="menu">
				<li class="item28">
					<a href="http://www.fotostroek.ru/index.php?option=com_content&amp;view=article&amp;id=47&amp;Itemid=28"><span>О проекте</span></a></li>
				<li class="item55">
					<span class='showConstrLink' id='showConstr1_state~0'>Все стройки</span></li>
				<li class="item29">
					<span class='showConstrLink'  id='showConstr2_state~1'>Строящиеся</span></li>
				<li class="item18">
					<span class='showConstrLink'  id='showConstr3_state~2'>Готовые</span></li>
				<li class="item56">
					<span class='showConstrLink'  id='showConstr4_state~4'>Замороженные</span></li>
				<li class="item57">
					<span  class='showConstrLink' id='showConstr5_state~3'>В планах</span></li>
				<li class="item63">
					<span class='showFirmLink' id='showFirms_0'>Заказчики</span></li>
				<li class="item59">
					<a href="http://www.fotostroek.ru/index.php?option=com_content&amp;view=category&amp;id=40&amp;Itemid=59"><span>Полезная информация</span></a></li>
				<li class="item60">
					<a href="http://www.fotostroek.ru/index.php?option=com_content&amp;view=article&amp;id=49&amp;Itemid=60"><span>Контакты</span></a></li>
			</ul>		
		</div>
	</div>



<div id="reklama">
	<a href="http://www.vssdom.ru/kvartiry/lisiha/lisiha3.html" target="_blank">
		<img src="/src/design/main/img/banner_Lisiha_3.gif" width="200px"></a><div>
&nbsp;
<div id="reklama"><a href="http://www.vssdom.ru/kvartiry/primorsky.html" target="_blank">
	<img src="/src/design/main/img/banner_Primorsky.gif" width="200px"></a><div>



<div id="ramkalogin"><div id="login">		<div class="moduletable">
					<form action="http://www.fotostroek.ru/index.php?option=com_comprofiler&amp;task=login" method="post" id="mod_loginform" style="margin:0px;">
<table class="mod_login" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr><td><span id="mod_login_usernametext"><label for="mod_login_username">Имя пользователя (логин)</label></span><br>
<input name="username" id="mod_login_username" class="inputbox" size="14" type="text"><br>
<span id="mod_login_passwordtext"><label for="mod_login_password">Пароль</label></span><br><span><input name="passwd" id="mod_login_password" class="inputbox" size="14" type="password"></span><br>
<input name="op2" value="login" type="hidden">
<input name="lang" value="russian" type="hidden">
<input name="force_session" value="1" type="hidden">
<input name="return" value="B:aHR0cDovL3d3dy5mb3Rvc3Ryb2VrLnJ1Lw==" type="hidden">
<input name="message" value="0" type="hidden">
<input name="loginfrom" value="loginmodule" type="hidden">
<input name="cbsecuritym3" value="cbm_78d439b7_52f25c6f_451168a29b6ba28e7bbe2ed9981e8335" type="hidden">
<input name="remember" id="mod_login_remember" value="yes" type="checkbox"> <span id="mod_login_remembermetext"><label for="mod_login_remember">Запомни меня</label></span><br>
<input name="Submit" class="button" value="Вход" type="submit"></td></tr>
<tr><td><a href="http://www.fotostroek.ru/index.php?option=com_comprofiler&amp;task=lostPassword" class="mod_login">Забыли логин?</a></td></tr>
<tr><td>Нет учетной записи? <a href="http://www.fotostroek.ru/index.php?option=com_comprofiler&amp;task=registers" class="mod_login">Зарегистрироваться</a></td></tr>
</tbody></table></form>		</div>
	</div></div>

		{if  $client.isMng}

{*<input name="test" id='test' class="button" value="Вход" type="submit">*}
								
		<div id=listFirmSrvc >  Список фирм  </div>
		<div id=listConstrSrvc >  Список строек  </div>
		<div id=test >  Test  </div>
		<div id=clear >  Clear  </div>

		{/if}



</div></div></div></div></td>
<td align="left" valign="top" width="83%">
<table border="0" cellpadding="0" cellspacing="0" width="100%" id='mainContent'>
<tbody>