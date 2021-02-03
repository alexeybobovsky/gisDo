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
	<link rel="stylesheet" href="/src/design/main/css/style.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/popup.css" type="text/css">
	
	<link rel="shortcut icon" href="http://www.fotostroek.ru/images/favicon.ico" type="image/x-icon">
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
	<SCRIPT src="/includes/JS/fs/userInterface.js" type=text/javascript></SCRIPT>			
	<SCRIPT src="/includes/JS/fs/userRoutine.js" type=text/javascript></SCRIPT>	
	<script type="text/javascript">
	var startLocation = '{$header.startLink}';
	</script>
	
</head>
<body>
  <script type="text/javascript">
	var UI = new userInterface();    
{literal}
	$(window).load(function () { 
		UI.setSize();   		
		if($('#page').height() > UI.windowHeight)
			{
			$('#centerContanerLeft').css({'height' : ($('#map_pic').height())});				
			}
	});
	$(document).ready(function(){
		UI.setSize();   
//		alert(UI.documentHeight)
		if($('#page').height() < UI.windowHeight)
			{
			$('#map_pic').css({'height' : UI.windowHeight-($('#footerContaner').height()+ $('#topContaner').height())});				
			$('#centerContanerLeft').css({'height' : ($('#map_pic').height())});				
			}
		else
			{
			$('#centerContanerLeft').css({'height' : ($('#map_pic').height())});				
			}
		$(window).bind("resize", function() {UI.setSize()});
		})
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
								<a href="/list/construction/"><span class="showFirmLink" id="showConstr_0" >Стройки</span></li>
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
			</div>
			<div id='centerContanerCenter'>
				<div id="map_pic">	