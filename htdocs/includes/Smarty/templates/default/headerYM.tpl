<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://
www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
  <HEAD>
    <TITLE>{$menu.lastTitle} | {$header.body.title}{*Город-авто.ком Автоинформационный портал*}</TITLE>
    <LINK href="{$header.body.cssSrc}site.css" rel=stylesheet>
    <LINK href="{$header.body.cssSrc}r-star.css" rel=stylesheet>	 
    <LINK rel='icon' href="{$header.body.imgSrc}favicon.ico" type='image/x-icon'>
    <LINK rel='shortcut icon' href="{$header.body.imgSrc}favicon.ico" type='image/x-icon'>
    <META http-equiv=Content-Type content="text/html; charset=windows-1251">
	<meta name="copyright" content="gorod-avto.com (с)">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Каталог автофирм г.Иркутска, рейтинги, комментарии и еще много чего интересного.">
	<meta name="keywords" content="автофирмы иркутска, автоуслуги, отзывы, рейтинг автофирм, автомобильный иркутск, каталог, информационный портал, барахолка, объявления, продажа, цены иркутска, поиск автомобиля, автомобиль, Иркутск, Рынок автомобилей, все фирмы иркутска, подержанные и новые автомобили, автоцентры, все авто иркутска">	
<!-- Yandex Maps init-->	
	<script src="http://api-maps.yandex.ru/1.1/index.xml?key=ACXeaEsBAAAAg1c3LgIAZep2oCh-cH_rneIptZPKv_rJ9-IAAAAAAAAAAABUbF_6-rly18fHyemUTiaDVDfifA=="
   type="text/javascript"></script>
   <script type="text/javascript">
	{if $isAdmin}
	var isAdmin = true;		
	{else}
	var isAdmin = false;		
	{/if}
   {literal}

	var map, geoResult, gCollection, bounds;
	window.onload =  function () 
		{ 
	{/literal}		
		{if !$marketId} {*карта города*}
		map = new YMaps.Map(document.getElementById("YMapsID"));
		map.setCenter(new YMaps.GeoPoint(104.27563, 52.313021), 11);
		map.addControl(new YMaps.ToolBar());
		map.addControl(new YMaps.Zoom());
		map.addControl(new YMaps.TypeControl());
		gCollection = new YMaps.GeoObjectCollection();
		map.addCopyright("© ГОРОД-АВТО.РФ");
		{literal}
		if (autoload)
			{
			var autoAction = (document.getElementById('firm').value) ? 'name' : 'layer';
			showSearchedObjects(autoAction);
			}
		{/literal}
		{else}
		{literal}
	     var myLayer = function () 
			{
	        return new YMaps.Layer(myData);
	        }
	     YMaps.Layers.add(options.layerKey, myLayer);
		var myType = new YMaps.MapType([options.layerKey], options.mapType.name);
		map = new YMaps.Map(document.getElementById("YMapsID"), {coordSystem: myCoordSystem});
		map.setCenter(options.mapCenter, options.mapZoom, myType);
//		map.disableDragging();

		for(var i =0; i<pavPoly.length; i++)
			{
			map.addOverlay(pavPoly[i]);
			YMaps.Events.observe(pavPoly[i], pavPoly[i].Events.Click, function (obj, e) 
				{
				polyClick(obj, e);
				});			
			}
//			polyClickAuto(autoload);
		if (options.zoomEnabled)
			map.addControl(new YMaps.Zoom({noTips: true}));
		{/literal}
		gCollection = new YMaps.GeoObjectCollection();
		gCollectionAdvert = new YMaps.GeoObjectCollection();
		map.addCopyright("© ГОРОД-АВТО.РФ");
		generateAdvert();
		if (autoload)			
			autoClick(autoload);
		else
			map.addOverlay(gCollectionAdvert);	
//			showAdvert();
		{/if}
	{literal}
		}
	{/literal}

   </script>
<!-- Yandex Maps init-->	
{if $GBInit}
<!-- GB init-->	
	<script type="text/javascript">
		var GB_ROOT_DIR = "/includes/greybox/";
	</script>
	<script type="text/javascript" src="/includes/greybox/AJS.js"></script>
	<script type="text/javascript" src="/includes/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="/includes/greybox/gb_scripts.js"></script>
	<link href="/includes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
	{if $isAdmin}
	<script src="/includes/JS/admAction.js" type=text/javascript></script>
	{/if}
<!-- GB init-->	
{/if}
</HEAD>
<body >