<body >
<noscript>
<div  id='noScript' title='Часть функционала сайта недоступна'>&nbsp;&nbsp;В браузере отключен Java Script - функционал сайта частично недоступен!!!</div></noscript>
<script src="/includes/jquery/jquery.autocomplete.js" language="JavaScript"></script>
<input type="hidden" id="firmId" name="firmId" value=''>		
<input type="hidden" id="objId" name="objId" value=''>		
<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>
<div id="searchPad" >
<div id='mapMenu' class='mapMenu'>
	{section name=menu loop=$menuList}
	{if $menuList[menu].id != $menuActive}
	<div id='{$menuList[menu].id}' class='element selected'>
		<a href='{$menuList[menu].link}'>{$menuList[menu].title}</a>
	</div>		
	{else}
	<div id='{$menuList[menu].id}' class='element'>
		{$menuList[menu].title}
	</div>	
	{/if}
	{/section}
</div>	
	<!--Поиск-->
 <div id="searchStrCont"> 
 <input type="text" id="searchStr" name="searchStr" value='Поиск' onFocus='this.value=""; ' onBlur='clearSearchbar()'>
 <div id=procIndicator {*style='left: 250px; top: 3px;'*} ><span id=resMessage></span> 
		<img id='searchIndicatorImg' border=0 src='/src/design/tmp/main/_.gif'>
	</div></div>
 <!--input type="submit" id="searchRun" name="searchRun" value=' Найти ' -->	
</div>
<div id="mapContaner" >		

<div id="YMapsID"></div>
</div>

<div id="lockingPad" style='display:none;'></div>
<div id="messageBox"  style='display:none;' ><div id='mBody'>Message</div><input type='button' id='mConfirm' onClick="DLG.closeMessage(this); " value = ' Оk! '></div>
<div id="waitBox" style='display:none;'><img id='waitImg' border=0 src='/src/design/tmp/main/blueBars.gif'></div>

<div id="layerPad" style="">
<div id="layerTop" style="">
<div id='orgLabel' title= '{*Выбрать категорию*}' >Выбрать категорию&nbsp;&nbsp;&nbsp;</div>
<span  id='catLabelCont' ><span id='catLabelBlur' ></span><span id='catLabel' title= 'Выбрать рубрику' >Рубрики каталога</span></span>
</div>
{section name=lay loop=$layers}
{if !$layers[lay].lvl}
<div class=contaner {* id='layer_{$layers[lay].item.layer_id}' *} >
<div class=parent id='nameLayer_{$layers[lay].item.layer_id}'  onClick='{*toggleLayer(this);*}' title='{$layers[lay].item.layer_title}'>{$layers[lay].item.layer_name}</div>
{elseif $layers[lay].lvl}
<div class=child id='nameLayer_{$layers[lay].item.layer_id}'  onClick='clickLayer(this, 0);' title='{$layers[lay].item.layer_title}'>{$layers[lay].item.layer_name} {if $layers[lay].item.objCnt}({$layers[lay].item.objCnt}){/if}</div>
{/if}
{if !$layers[$smarty.section.lay.index_next].lvl || $smarty.section.lay.last}
</div>
{/if}
{/section}
</div>
{if $autoLoad}
<input type=hidden id='autoLoadType' value='{$autoLoad.type}'>
<input type=hidden id='autoLoadObj' value='{$autoLoad.obj}'>
{*<input type=hidden id='autoLoadLoc' value={$autoLoad.loc}>*}
{else}
<input type=hidden id='autoLoadType' value=''>
<input type=hidden id='autoLoadObj' value=''>
{*<input type=hidden id='autoLoadLoc' value=''>*}
{/if}
</body></html>

