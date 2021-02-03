								<input type="hidden" id="firmId" name="firmId" value=''>		
								<input type="hidden" id="objId" 	name="objId" value=''>		
								<input type="hidden" id="objType" 	name="objType" value=''>		
								<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
								<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>
								{if $autoLoad}
								<input type=hidden id='autoLoadType' value='{$autoLoad.type}'>
								<input type=hidden id='autoLoadObj' value='{$autoLoad.obj}'>
								<input type=hidden id='autoLoadFilter' value='{$autoLoad.filter}'>
								{else}
								<input type=hidden id='autoLoadType' value=''>
								<input type=hidden id='autoLoadObj' value=''>
								<input type=hidden id='autoLoadFilter' value=''>
								{/if}
		{if  $client.isMng}{literal}							
								<div id="ObjListSrvc" >
								<span id=close onClick="$('#ObjListSrvc').css({'display' : 'none'});">  x  </span>
								<div id='objListContaner'></div>
								</div>
		{/literal}{/IF}
								<div id="titleBar">
									<div id='titleContent'>
									<h2 id='pageTitle'>Стройки Иркутска</h2>
									<span id='pageTitleMore'></span>
									{*<div id='filtershow' onClick='UI.togglePanel(document.getElementById("titleBar"), "filterPanel", 0);'>Фильтр</div>*}
									<div id='filtershow' class='simple' onClick='UI.togglePanel(document.getElementById("titleBar"), "filterPanel", 0, "highlightFilterStarter");'>Фильтр</div>
									</div>
								</div>
								<div id="mapContaner" ><div id="YMapsID"></div>
								</div>							
								
