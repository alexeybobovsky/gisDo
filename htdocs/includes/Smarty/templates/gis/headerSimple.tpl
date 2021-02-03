<html>
<head>
	<meta name="description" content="{$meta.description}" />
	<title>{$title} | {$header.siteName}</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/src/design/main/css/gis/style.css" type="text/css">
	<link rel="stylesheet" href="/src/design/main/css/gis/popup.css" type="text/css">
	<script src="/includes/jquery/jquery.js"></script>
	<script src="/includes/JS/gis/service.js" type="text/javascript"></script>		
	<script src="/includes/JS/gis/userInterface.js" type="text/javascript"></script>		

	<script>
	{literal}
var titleString = 'Иркутская область';
var UI = new userInterface();   	
$(document).ready(function(){
	UI.setSize();   
	$("#waitBox").css({'display' : 'none'});	
	$('#mapid').css({'height' : UI.documentHeight-($('#topContaner').height()+35)});				
	$('#mapid').css({'width' : UI.documentWidth});
	$('#mapid').css({'cursor': 'wait'});
	$('#titleBar').text(titleString);
	$('#menuListContaner').css({'top' : '32px'});
	$('#menuListContaner').css({'display' : 'block'});
	
	UI.setPanel();   
	UI.toCenter('contaner_404'); 
	});	
	{/literal}
	</script>	
</head>
<body>
<div id="waitBox" {*style="display:none;"*} ><img id="waitImg" src="/src/design/main/img/blueBars.gif" border="0" alt="" /></div>
<div id="topToolBarContaner">
<div id="topToolBar">
	<div id='showMenu'>
		{*<span class='' title="Список слоёв объектов" id="show_accList"> Слои </span>*}
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

{*	
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="Регистрация текстовых файлов в Blockchain NEM с помощью механизма Apostille. Реализовано с помощью NEM-sdk.js" />

		<TITLE>{$header.title}</TITLE>
		
	</head>
	<body>
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
*}