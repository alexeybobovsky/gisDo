<SCRIPT src="/includes/JS/fs/panYM.js" type=text/javascript></SCRIPT>	
<script src="/includes/JS/fs/mapYMmini.js" type="text/javascript"></script>

{if $client.isMng}
<SCRIPT src="/includes/JS/fs/panAdmin.js" type=text/javascript></SCRIPT>	
<script src="/includes/JS/fs/mapYMadm.js" type="text/javascript"></script>

<link rel="stylesheet" href="/src/design/pickadate/themes/classic.css" id="theme_base">
<link rel="stylesheet" href="/src/design/pickadate/themes/classic.date.css" id="theme_date">

<script type="text/javascript" src="/includes/jquery/jquery.jeditable.js"></script>
<SCRIPT type="text/javascript" src="/includes/pickadate/picker.js" ></script>
<SCRIPT type="text/javascript" src="/includes/pickadate/picker.date.js" ></script>
<SCRIPT type="text/javascript" src="/includes/pickadate/legacy.js" ></script>
{/if}		
<script type="text/javascript">
{literal}
/**********************************Глобальные переменные****************************************************/	
var addPlacemark;
var curZoom;
var pointList  = new Array();
var gCollectionPoints, stylePoints;
var options = {
{/literal}
			width: {$panOpt.width},
			height: {$panOpt.height},
			titleUrl: "/src/design/main/pan/" + "{$panOpt.id}",			
			zoomEnabled: true,
			scrollZoomEnabled: true,
			mapCenter: new YMaps.Point({$panOpt.centerX}, {$panOpt.centerY}),
			mapZoom: {$panOpt.curZoom},
			maxZoom: {$panOpt.maxZoom},
			isTransparent: false,
			smoothZooming: true,
			copyright: "fotostroek.ru"
{literal}
		};
		var myData = new YMaps.TileDataSource(options.titleUrl, options.isTransparent, options.smoothZooming, {ERROR_TILE_URL : "/src/design/main/404_YM.gif"});	
		myData.getTileUrl = function (tile, zoom) 
			{
			return this.getTileUrlTemplate() + "/" +  zoom + "/tile-" + tile.x + "-" + tile.y + ".jpg";
	        }
		myData.getErrorTileUrl = function () 
			{
			return "/src/design/main/404_YM_fs.gif";
	        }
		var myLayer = function () 
			{
			return new YMaps.Layer(myData);
			};	
		YMaps.Layers.add('my#pan', myLayer);	
		var myType = new YMaps.MapType(['my#pan'], 'Панорама');		
		var myCoordSystem = new YMaps.CartesianCoordSystem(new YMaps.Point(0, options.height), new YMaps.Point(options.width, 0), 1, options.maxZoom);
{/literal}
{if $client.isMng}{literal}

$(document).ready(function() {
	$('#panAbout').addClass('p_valueTextArea');
	$('#panFloor').addClass('p_value');
	$('#panAuthor').addClass('p_valueTextArea');		
	panEditInit();
	});
{/literal}{/if}	
</script>
<div id="titleBarPan">
	<div id="titleContent">
		<div id="string">
			<nobr><h1 title='{$title}' >{$title} &nbsp;&nbsp;~ Гоголя 15 &middot; Панорамы Иркутска ~&nbsp;&nbsp;</h1></nobr>
		</div>
	</div>
</div>
<div id="pageContentPan">	
<div id="panOptions" style="">
	<div id='tablePropContaner'>
		<div class='tableProp'>
			<div class='label'>
				<h2>Точка съёмки</h2>
			</div>
			<div class='value'>
			{if $client.isMng}
				<input class='' type="text" id="pointName" name="pointName"  value='Гоголя 15'>		
			{else}
				Гоголя 15
			{/if}
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Описание</h2>
			</div>
			<div class='value' id='panAbout'>
				Вид на р. Ангара и на Правобережный район Иркутска
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Дата съёмки</h2>
			</div>
			<div class='value'>
			{if $client.isMng}
				<input class='datepicker' type="date" id="fotoDate" name="fotoDate" placeholder='8 октября' value=''>		
			{else}
				8 октября
			{/if}
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Высота съёмки</h2>
			</div>
			<div class='value' id='panFloor'>
				40 метров
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Автор фото</h2>
			</div>
			<div class='value' id='panAuthor'>
				<a href='#'>Admin</a>
			</div>
		</div>	
	</div>
	<div id='panObjList'>
		<div id='listHeader'>Объекты на карте <span> {$pointListCnt} </span></div>
		<ul>
		{section name=list loop=$pointList}
			<li id='list_{$smarty.section.list.index}' class='activeLink' onClick="$('#' + this.id).addClass('panSelected');">{$pointList[list].0}</li>		
		{/section}
		</ul>
	</div>
</div>
<div id="panContaner" style=""></div>
{if $client.isMng}

<input type="hidden" id="coord" name="coord" value="" />
<input type="hidden" id="panId" name="panId" value="{$panOpt.panId}" />
<input type="hidden" id="actionAddPoint" name="actionAddPoint" value="/pan/set/pointAdd/" />

{/if}
<div id='empty'></div>		
</div>