<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://
www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
  <HEAD>
    <TITLE>{$menu.lastTitle} </TITLE>
    <LINK href="{$header.body.cssSrc}site.css" rel=stylesheet>
    <LINK href="{$header.body.cssSrc}r-star.css" rel=stylesheet>	 
    <LINK href="{$header.body.cssSrc}jquery.autocomplete.css" rel=stylesheet>	 
<!-- Yandex Maps init-->	
	<script src="http://api-maps.yandex.ru/1.1/index.xml?key=ACXeaEsBAAAAg1c3LgIAZep2oCh-cH_rneIptZPKv_rJ9-IAAAAAAAAAAABUbF_6-rly18fHyemUTiaDVDfifA=="
   type="text/javascript"></script>
   <script type="text/javascript">
   {literal}
	var map, geoResult, gCollection, bounds;	
//	var adrBox;
//	var res = new Array();
	var pointAdr;
	window.onload =  function () 
		{ 
		var mapHeightValue = getClientHeight()-5;
		var mapWidthValue = getClientWidth();
/*		var mapHeightValue = '400';
		var mapWidthValue = '500';*/
		var mapHeight = mapHeightValue + 'px'; 
		var mapWidth = mapWidthValue + 'px';
		
		document.getElementById("YMapsID").style.height = mapHeight;
		document.getElementById("YMapsID").style.width = mapWidth;
		map = new YMaps.Map(document.getElementById("YMapsID"));
		map.setCenter(new YMaps.GeoPoint(104.27563, 52.313021), 11);
		map.addControl(new YMaps.ToolBar());
		map.addControl(new YMaps.Zoom());
		map.addControl(new YMaps.TypeControl());
		var searchControl = new YMaps.SearchControl
			({
			resultsPerPage: 2, // Количество объектов на странице
			useMapBounds: 1, // Объекты, найденные в видимой области карты
			noCentering: false,
			noPlacemark: true
			});
		YMaps.Events.observe(searchControl, searchControl.Events.Select, function (searchControl, obj) 
			{
			if(pointAdr)
				map.removeOverlay(pointAdr);
			pointAdr = obj;
			var clickPoint = obj.getGeoPoint();
			YMaps.Events.observe(pointAdr, pointAdr.Events.DragEnd, function (obj) 
				{
				pointAdr.setIconContent("Загрузка &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
				getNewAdr(obj, pointAdr);
//				pointAdr.setOptions({draggable: false});
				});					
			showPointAdr(pointAdr);
			coord = clickPoint.copy();

			});
		{/literal}
		{if !$objEdit}
			alertPad = new YMAlert('Для начала работы, введите адрес офиса в строке поиска');
			map.addControl(alertPad);	
		{else}
			{if $objEdit.geo_x && $objEdit.geo_y}
				var startPoint = new YMaps.GeoPoint({$objEdit.geo_x}, {$objEdit.geo_y});
			{else}
				var startPoint = new YMaps.GeoPoint(104.27563, 52.313021);				
				alertPad = new YMAlert('Внимание! Необходимо скорректировать местоположение объекта.');
				map.addControl(alertPad);	
			{/if}
			{literal}		
			pointAdr = new YMaps.Placemark(startPoint, {style: styleAdr, draggable: false});
			YMaps.Events.observe(pointAdr, pointAdr.Events.DragEnd, function (obj) 
				{
				pointAdr.setIconContent("Загрузка &nbsp;<img src='/src/design/main/blueBars.gif' border=0>");
				getNewAdr(obj, pointAdr);
//				pointAdr.setOptions({draggable: false});
				});					
			{/literal}
			pointAdr.adr = street + ', ' + bld;							
			pointAdr.street = street;
			pointAdr.bld = bld;
			bounds = new YMaps.GeoCollectionBounds();		
			bounds.add(startPoint);
			map.addOverlay(pointAdr);		
			map.setCenter(startPoint);
			map.setBounds(bounds);		
			pointAdr.openBalloon();
//		alertPad = new YMAlert('Для начала работы, введите адрес офиса в строке поиска');
		{/if}
		map.addControl(searchControl);
		map.addCopyright("© ГОРОД-АВТО.КОМ");
		{literal}
		}
	{/literal}

   </script>
<!-- Yandex Maps init-->	
</HEAD>
<body >
<SCRIPT src="/includes/jquery/jquery_.js" type=text/javascript></SCRIPT>
<script language="JavaScript" src="/includes/JS/scriptUsers.js"></script>
<script language="JavaScript" src="/includes/JS/scriptMapYM.js"></script>   
<script language="JavaScript" src="/includes/JS/ga/userProfile.js"></script>
<script language="JavaScript" src="/includes/jquery/jquery.autocomplete.js"></script>

{literal}
<style type="text/css">

<!--
.ac_results {
	padding: 0px;
	border: 1px solid WindowFrame;
	background-color: Window;
	z-index:10000000;
	overflow: hidden;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results iframe {
	display:none;/*sorry for IE5*/
	display/**/:block;/*sorry for IE5*/
	position:absolute;
	top:0;
	left:0;
	z-index:-1;
/*	z-index:10000;*/
	filter:mask();
	width:3000px;
	height:3000px;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: pointer;
	display: block;
	width: 100%;
	font: menu;
	font-size: 12px;
	overflow: hidden;
}

.ac_loading {
//	background : Window url('./src/design/main/blueBars.gif') right center no-repeat;
	background-color: grey;
}

.ac_over {
	background-color: Highlight;
	background-color: infobackground;
	color: black;
}
.ac_searched {
	color: darkgreen;
	text-decoration: underline;
}
.ac_extName {
	color: darkgreen;
	margin-left: 15px;
	font-style: italic ;
}
-->
</style>	
<script type="text/javascript">
function formatStreet(row, i, num) 
	{	
//	alert(row);
	var result;
	var string = row[0].toLowerCase();
	var searched = row[1].toLowerCase();	
//	document.getElementById('firm').value = row[2];
	var start = string.indexOf(searched);
	var end = start + searched.length;
	result = string.substring(0,   start) + '<span class="ac_searched">' +  searched + '</span>'  + string.substring(end);				
	return result;
	}
/*	
$(document).ready(function(){
//alert('ready');
  $("#streetHand").autocomplete('/spddl/',
    {
    minChars:3,
	lineSeparator:"##",
	cellSeparator:"**",
	maxItemsToShow:30,
	formatItem:formatStreet,
	extraParams:{type:"streets"}
//	cacheLength:0,
//    autoFill:false
    }
  );
});*/
{/literal}
</SCRIPT>
<div id="YMapsID" style="z-index:1; width:100%; height:600px;"></div>
<input type="hidden" id="city" name="city" value="Иркутск" />
<input type="hidden" id="street" name="street" value="{if $objEdit.street}{$objEdit.street}{/if}" />
<input type="hidden" id="bld" name="bld" value="{if $objEdit.bld}{$objEdit.bld}{/if}" />
<input type="hidden" id="coord" name="coord" value="{if $objEdit.geo_x}{$objEdit.geo_x},{$objEdit.geo_y}{/if}" />
{if $objEdit}
<input type="hidden" id="object" name="object" value="{$objEdit.object}" />
{/if}
<input type="hidden" id="firm" name="firm" value="{$firm}" />
<script type="text/javascript">
var city = document.getElementById("city").value;   
var street = document.getElementById("street").value;
var bld = document.getElementById("bld").value;
var coord = document.getElementById("coord").value;
var firm = document.getElementById("firm").value;
{if $objEdit}
var object = document.getElementById("object").value;
{/if}

</script>  

</body>
</html>