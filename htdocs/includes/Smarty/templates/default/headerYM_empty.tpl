<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://
www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
  <HEAD>
    <TITLE>{$title} | Автоинформационный портал ГОРОД-АВТО.КОМ</TITLE>
     <META http-equiv=Content-Type content="text/html; charset=windows-1251">
    <LINK rel='icon' href="/src/design/main/favicon.ico" type='image/x-icon'>
    <LINK rel='shortcut icon' href="/src/design/main/favicon.ico" type='image/x-icon'>	 
	<meta name="copyright" content="gorod-avto.com (с)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Каталог автофирм г.Иркутска, рейтинги, комментарии и еще много чего интересного.">
	<meta name="keywords" content="автофирмы иркутска, автоуслуги, отзывы, рейтинг автофирм, автомобильный иркутск, каталог, информационный портал, барахолка, объявления, продажа, цены иркутска, поиск автомобиля, автомобиль, Иркутск, Рынок автомобилей, все фирмы иркутска, подержанные и новые автомобили, автоцентры, все авто иркутска">	
<!-- GB init-->	
	<script type="text/javascript">
		var GB_ROOT_DIR = "/includes/greybox/";
	</script>
	<script type="text/javascript" src="/includes/greybox/AJS.js"></script>
	<script type="text/javascript" src="/includes/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="/includes/greybox/gb_scripts.js"></script>
	<link href="/includes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<!-- GB init-->	
<!-- Yandex Maps init-->	
	<script src="http://api-maps.yandex.ru/1.1/index.xml?key=ACXeaEsBAAAAg1c3LgIAZep2oCh-cH_rneIptZPKv_rJ9-IAAAAAAAAAAABUbF_6-rly18fHyemUTiaDVDfifA==&modules=traffic~plainstyle"
   type="text/javascript"></script>
   <script type="text/javascript">
	{if $client.name == 'Explorer'}
	var ie = true;
	{else}		
	var ie = false;
	{/if}
	var map, geoResult, gCollection, bounds;
		{literal}		
	window.onload =  function () 
		{
		if(ie)
			{
			var html = document.documentElement;  
//		alert("Размер вьюпорта: "+ html.clientWidth +"х"+ html.clientHeight); 	
			document.getElementById("YMapsID").style.height = html.clientHeight-75;
//		document.getElementById("YMapsID").style.width = html.clientWidth-30;
			document.getElementById("objList").style.height = html.clientHeight-30;
			document.getElementById("layerTree").style.height = html.clientHeight-30;
			}
		map = new YMaps.Map(document.getElementById("YMapsID"));
		var toolbar = new YMaps.ToolBar();
		var traffic = new YMaps.Traffic.Control();
		map.addControl(toolbar);
		gCollection = new YMaps.GeoObjectCollection();
		map.addControl(new YMaps.Zoom());
		map.addControl(new YMaps.TypeControl());
		map.addControl(traffic);
		map.addCopyright("© ГОРОД-АВТО.РФ");
		map.addOverlay(gCollection);

		map.setCenter(new YMaps.GeoPoint(104.27563, 52.313021), 11);
		if(self.parent.length == 0) //showLogo
			{
			document.getElementById("logo").style.display = '';
//			document.getElementById("layerTree").style.top = 90; 
			}
		else
			{
			document.getElementById("logo").style.display = 'none';
//			document.getElementById("logoMap").
			}
		showObj();
//		map.addControl(traffic, new YMaps.ControlPosition(YMaps.ControlPosition.TOP_RIGHT, new YMaps.Point(205, 5)));
//		traffic.show();
//		map.addControl(searchControl);
		}
   </script>
   {/literal}
<!-- Yandex Maps init-->	
</HEAD>
<body >
<noscript>
<div  id='noScript' title='Часть функционала сайта недоступна'>&nbsp;&nbsp;В браузере отключен Java Script - функционал сайта частично недоступен!!!</div></noscript>