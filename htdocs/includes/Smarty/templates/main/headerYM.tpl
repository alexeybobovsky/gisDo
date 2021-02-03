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
	<link rel="stylesheet" href="/src/design/main/css/popup.css" type="text/css">

	<link rel="stylesheet" href="/src/design/main/css/style.css" type="text/css">
	
	<link rel="shortcut icon" href="http://www.fotostroek.ru/images/favicon.ico" type="image/x-icon">
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />
	
	
	
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
<SCRIPT src="/includes/JS/fs/userRoutine.js" type=text/javascript></SCRIPT>			
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
	var mngActions = new setMngAction('{$client.mngAct.oe}', '{$client.mngAct.od}', '{$client.mngAct.fe}', '{$client.mngAct.af}' , '{$client.mngAct.fd}' );	
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
		$('#YMapsID').css({'height' : UI.windowHeight-($('#footerContaner').height()+ $('#topContaner').height() + 60)});				
		$('#centerContanerLeft').css({'height' : ($('#YMapsID').height()+ $('#titleBar').height())});				
		$(window).bind("resize", function() {UI.setSize()});



		$('#listConstrSrvc').bind("click", function() {showList_Service('construction')});
		$('#listFirmSrvc').bind("click", function() {showList_Service('firm')});
		$('#test').bind("click", function() {testSpddl()});
		$('#clear').bind("click", function() {clearMapObjects()});
		
		
		$('.showConstrLink').bind("click", function() {showConstruction(); return false;});
		$('.showFirmLink').bind("click", function() {showFirm(this); return false;});

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
<div id='page'>
	<div id='topContaner'>
		<div id='top'>
			<div id='topContanerLeft'>
				<div id="toptext"><a href="/">Мониторинг новостроек Иркутска</a></div>
				<div id="toptext2">актуальная информация о новостройках</div>
			</div>
			<div id='topContanerRight'>
				<a href="#">	<img src="/src/design/main/img/Irkutsk_Kuybyshevskiy_Polenova_UKS_21.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Kuybyshevskiy_Sarafanovskaya_81_03.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_4-Sovetskaya_80_Mairta_23.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Aleksandra_Nevskogo_i_Piskunova_23.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Baykalskaya_236b_ZhK_Fregat_02.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Oktyabrskiy_Dalnevostochnaya_164.jpg" height="80px" width="100px"></a>
				<a href="#"><img src="/src/design/main/img/Irkutsk_Sverdlovskiy_2-Zheleznodorozhnaya_19_07.jpg" height="80px" width="100px"></a>
			</div>
		</div>
	</div>
	<div id='centerContaner'>
		<div id='centerPage'>
			<div id='centerContanerLeft'>
				<div id="leftmenu">		
					<div class="moduletable-menu">					
						<ul class="menu">
							<li class="menuLvl1">
								<a href="#"><span>О проекте</span></a></li>
							<li class="menuLvl1">
								<a href="/list/construction/"><span class="showConstrLink" id="showConstr_0" >Стройки</span></li>
							<li class="menuLvl1">
								<a href="/list/firm/"><span class="showFirmLink" id="showFirms_0">Организации</span></a></li>
							<li class="menuLvl1">
								<a href="#"><span>Полезная информация</span></a></li>
							<li class="menuLvl1">
								<a href="#"><span>Контакты</span></a></li>
						</ul>		
					</div>
				</div>
				<div id="reklama">
						<a href="http://www.vssdom.ru/kvartiry/lisiha/lisiha3.html" target="_blank">
							<img src="/src/design/main/img/banner_Lisiha_3.gif" width="200px"></a>
				</div>
					&nbsp;
				<div id="reklama"><a href="http://www.vssdom.ru/kvartiry/primorsky.html" target="_blank">
						<img src="/src/design/main/img/banner_Primorsky.gif" width="200px"></a>
				</div>

				<div id="ramkalogin">
					<div id="login">		
						<div class="moduletable">
						{if !$header.userRegistered}						
							<FORM name='LOGFORM' action='/login/' method='post' encType='multipart/form-data'  >
							<label for="Username">Имя пользователя</label> 
							<div>
								<INPUT  name='Username'  type='text'   id='Username'   style='WIDTH: 100%' value=''>			
							</div>
							<label for="Password">Пароль</label> 
							<div>																
								<INPUT  name="Password"  type="password" id="Password" style="WIDTH: 100%"  value="">				
							</div>
							<label for="saveMe">Запомнить</label> 
							<div >
								<INPUT  name="saveMe"  type="checkbox"   id="saveMe"   checked>
							</div>	
								<INPUT  name="SUBMIT"  type="submit"   id="IDSUBMIT"   style="WIDTH: 100%"  value="Войти">
							</FORM>					
						{else}							
								<span {if $header.providerName} class = 'userName_{$header.providerName}' title='Вы зашли с помощью "{$header.providerTitle}"'{/if} id="show_site_userName"><a href='/login/logoff/' title="Выход" >{$header.userDisplayName}</a></span>					
						
						{/if}
						</div>
					</div>
				</div>
		{if  $client.isMng}
		<div id='serviceLnk' style='margin-left:20px'>
			<div id=listFirmSrvc >  Список фирм  </div>
			<div id=listConstrSrvc >  Список строек  </div>
			<div id=test >  Test  </div>
			<div id=clear >  Clear  </div>
		</div>

		{/if}

			</div>
			<div id='centerContanerCenter'>
				<div id="map_pic">	