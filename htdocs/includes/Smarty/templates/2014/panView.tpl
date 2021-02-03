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
			titleUrl: "/src/design/main/pan/" + "{$panOpt.panId}",			
			zoomEnabled: true,
			scrollZoomEnabled: true,
			mapCenter: new YMaps.Point({$panOpt.centerX}, {$panOpt.centerY}),
			mapZoom: {$panOpt.curZoom},
			maxZoom: {$panOpt.maxZoom},
			panGeoX: {$panOpt.poGeoX},
			panGeoY: {$panOpt.poGeoY},
			panName: '{$panOpt.poName}',
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
{/literal}
		
{section name=list loop=$pointList}	
pointList[{$smarty.section.list.index}] = new pointObj('{$pointList[list].po_name}', {$pointList[list].pp_x}, {$pointList[list].pp_y}, new YMaps.Point({$pointList[list].pp_x}, {$pointList[list].pp_y}), {$pointList[list].poId}, {$pointList[list].po_geoX}, {$pointList[list].po_geoY}, {$pointList[list].constr_id});
{/section}
{if $client.isMng}{literal}

$(document).ready(function() {
	$('#panAbout').addClass('p_valueTextArea');
	$('#panFloor').addClass('p_value');
	$('#panWidth').addClass('p_value');
	$('#panHeight').addClass('p_value');
	$('#panMaxZoom').addClass('p_value');
	$('#panCurZoom').addClass('p_value');
	$('#panAuthor').addClass('p_valueTextArea');		
	panEditInit();
	});
{/literal}{/if}
</script>
<div id="titleBarPan">
	<div id="titleContent">
		<div id="string">
			<nobr><h1 title='{$title}' >&nbsp;&nbsp;~ Панорамы Иркутска &middot; {$panOpt.poName} ~&nbsp;&nbsp;</h1></nobr>
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
				<input class='' type="text" id="pointName" name="pointName"  value='{$panOpt.poName}'>		
			{else}
				{if $panOpt.constrId}
				<a class=''  href='/list/construction/{$panOpt.constrId}' 
								title='{$panOpt.poName}' 
								target="_blank">					
							{$panOpt.poName}
							</a>	
				{else}
					{$panOpt.poName}
				{/if}
				{*if $panOpt.poName}{$panOpt.poName}{else}&nbsp;{/if*}
			{/if}
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Описание</h2>
			</div>
			<div class='value' id='panAbout'>{if $panOpt.panInfo}{$panOpt.panInfo}{else}&nbsp;{/if}</div>
		</div>		
		<div class='tableProp'>
			<div class='label'>
				<h2>Размер</h2>
			</div>
			<div class='value' id='panSize'>{if $panOpt.panSize}{$panOpt.panSize} МПикс{else}&nbsp;{/if}</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Дата съёмки</h2>
			</div>
			<div class='value'>
			{if $client.isMng}
				<input class='datepicker' type="date" id="fotoDate" name="fotoDate" placeholder='{$panOpt.panDate}' value=''>		
			{else}
				{if $panOpt.panDate}{$panOpt.panDate}{else}&nbsp;{/if}
			{/if}
			</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Высота съёмки</h2>
			</div>
			<div class='value' id='panFloor'>{if $panOpt.panTall}{$panOpt.panTall}{else}&nbsp;{/if}</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Автор фото</h2>
			</div>
			<div class='value' id='panAuthor'>{if $panOpt.userName}{$panOpt.userName}{else}&nbsp;{$panOpt.panAuthInfo}{/if}</div>
		</div>			
		<div class='tableProp'>
			<div class='label'>
				<h2>Схема съёмки</h2>
			</div>
			<div class='value' id='panObjOnMap'><span id='panPointInfo'  onClick='showMiniMapPanFull();' class='activeLink' title='показать все объекты на карте'>показать карту</span></div>
		</div>	
		{if $client.isMng}
		<div class='tableProp'>
			<div class='label'>
				<h2>Ширина</h2>
			</div>
			<div class='value' id='panWidth'>{$panOpt.width}</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Высота</h2>
			</div>
			<div class='value' id='panHeight'>{$panOpt.height}</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Макс. масштаб</h2>
			</div>
			<div class='value' id='panMaxZoom'>{$panOpt.maxZoom}</div>
		</div>	
		<div class='tableProp'>
			<div class='label'>
				<h2>Нач. масштаб</h2>
			</div>
			<div class='value' id='panCurZoom'>{$panOpt.curZoom}</div>
		</div>	
		<input type="hidden" id="coord" name="coord" value="" />
		<input type="hidden" id="panId" name="panId" value="{$panOpt.panId}" />
		<input type="hidden" id="actionAddPoint" name="actionAddPoint" value="/pan/set/pointAdd/" />

		{/if}	
	</div>
	<div id='panObjList'>
		<div id='listHeader'>Объекты на фото <span> {$pointListCnt} </span> {*<span id='objOnMap' class='activeLink' > показать на карте </span>*}</div>
		<ul>
		{section name=list loop=$pointList}
			<li id='list_{$pointList[list].poId}' class='activeLink' onClick="panShowPoint (this);">{$pointList[list].po_name}</li>		
		{/section}
		</ul>
	</div>
</div>
<div id="panContaner" style=""></div>

<div id='empty'></div>		
</div>