<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://
www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
  <HEAD>
    <TITLE>{$title} | Город-детям.рф</TITLE>
     <!--META http-equiv=Content-Type content="text/html; charset=windows-1251"-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <LINK rel='icon' href="/src/design/main/favicon.ico" type='image/x-icon'>
    <LINK rel='shortcut icon' href="/src/design/main/favicon.ico" type='image/x-icon'>	 
	<meta name="copyright" content="gorod-detyam.ru (с)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Каталог организаций занятых воспитанием, лечением и развлечением детей в Иркутску">
	<meta name="keywords" content="Детские сады, школы Иркутска, частные детсады Иркутска, лицеи, кружки, танцы, школы раннего развития Иркутска">	

	<link  	rel="stylesheet" type="text/css" href="/src/design/mapGlobal.css" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
	<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />
	<link 	rel="stylesheet" href="/src/design/autoComlete.css" type="text/css" />

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
{*<script src="http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>*}
<script src="http://api-maps.yandex.ru/2.0.26/?load=package.standard,package.clusters&mode=debug&lang=ru-RU" type="text/javascript"></script>

<SCRIPT src="/includes/JS/gd/userNavigation.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/gd/userDialog.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/gd/userSize.js" type=text/javascript></SCRIPT>
<SCRIPT src="/includes/JS/gd/mapYM.js" type=text/javascript></SCRIPT>
{if $client.isMng}
<SCRIPT src="/includes/JS/gd/mapYMadm.js" type=text/javascript></SCRIPT>
{/if}
<SCRIPT src="/includes/JS/gd/fbRoutine.js" type=text/javascript></SCRIPT>
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
	var DLG = new dialog('messageBox', 'mBody', 'mConfirm', 'waitBox');
	var NAV = new navigation(window.history.emulate, '{$links.start}', '{$title} | Город-детям.рф');
	var SZ = new sizing();
	var FB = new fancyBox();
	{literal}	
	if(NAV.enable)
		window.onpopstate = function( e ) {NAV.backward( e ) };
		
	$(document).ready(function(){
		$("#catLabel").click(function(){SZ.toggleLayerPad()});
/*		$("#orgLabel").click(function(){SZ.toggleLabels()});*/
		SZ.setSize();
		imgSizeView = (SZ.documentWidth> 1100) ? 1024 : 600;
		})
	$(window).bind("load resize", function() {SZ.setSize()});
	ymaps.ready(function(){		
		init(); 

		
	{/literal}
		{if  $client.isMng}
		initAdm(); 		
		{/if}
	{literal}		
		});		
   </script>
   {/literal}
<!-- Yandex Maps init-->	
</HEAD>