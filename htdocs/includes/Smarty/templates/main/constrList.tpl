<script src="http://api-maps.yandex.ru/2.0/?load=package.standard,&mode=release&lang=ru-RU" type="text/javascript"></script><script src="/includes/JS/fs/mapYMmini.js" type="text/javascript"></script><script type="text/javascript">{literal}$(document).ready(function() {		filter.clear();		filter.setFilterFromURL($('#filterStr').val());		filter.updateForm();	});</script>			{/literal}<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'><input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'><input type="hidden" id="filterStr" name="filterStr" value='{$filterStr}'>	<div id="titleBar">		<div id='titleContent'>		<h2>{$title}</h2>		<span id='pageTitleMore'>({$objCount})</span>		<div id='filtershow' class='simple' onClick='UI.togglePanel(document.getElementById("titleBar"), "filterPanel", 0, "highlightFilterStarter");'>Фильтр</div>		</div>	</div>	<div id="pageContent">			<div id="listContaner">				<ul class="news_list">				<li class='sortLabel' >Сортировать</li>			{if $sort.curDir == 'Asc'}				<li class='sortValue sortSelected'>по возрастанию</li>			{else}				<li class='sortValue' > <a href="{$startUrl}{$sort.paramStr}Asc{if $sort.limitStr}/limit_{$sort.curNumOnPage}~1{/if}" title="">по возрастанию</a></li>                 						{/if}				<li>/</li>			{if $sort.curDir == 'Asc'}				<li class='sortValue' > <a href="{$startUrl}{$sort.paramStr}Desc{if $sort.limitStr}/limit_{$sort.curNumOnPage}~1{/if}" title="">по убыванию</a></li>                 			{else}				<li class='sortValue sortSelected' > по убыванию</li>                 						{/if}				<li>&nbsp;</li>				<li class='sortLabel'>Результатов на страницу</li>			{if $sort.curNumOnPage == '10'}				<li class='sortValue sortSelected'>10</li>                 				<li>/</li>				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_50~1" title="">50</a></li>                 				<li>/</li>				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}" title="">Все</a></li>                 			{elseif $sort.curNumOnPage == '50' }				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_10~1" title="">10</a></li>                 				<li>/</li>				<li class='sortValue sortSelected'>50</li>                 							<li>/</li>				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}" title="">Все</a></li>                 			{else}				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_10~1" title="">10</a></li>                 				<li>/</li>				<li class='sortValue'><a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_50~1" title="">50</a></li>                 				<li>/</li>				<li class='sortValue sortSelected'>Все</li>                 						{/if}			</ul>									{section name=list loop=$list}			<div id="listItem1" class="listItem">					<div class="itemTop">					 <div class="itemNum"><p>{*$smarty.section.list.iteration*}{$list[list].number}.</p>					 </div>					 <div class="itemName">						<h3><a title="{$list[list].name} в городе Иркутск" href="/list/construction/{$list[list].id}">{$list[list].name}</a></h3>					 </div>					<div title="Средняя оценка - " class="itemRate">					&nbsp;					</div>					 <div class="itemMore">						 <a class="оrganization_events_more" title="Подробнее о {$list[list].name} в городе Иркутск" href="/list/construction/{$list[list].id}"> Подробнее&nbsp;»</a>					 </div>                       				</div>                    				<div class="itemMiddle">   					<div class="itemIcon">						<img alt="Фото {$list[list].name} в городе Иркутск" title="Фото {$list[list].name} в городе Иркутск" class="itemIconImg" src="{$list[list].icon|replace:"size":"150"}">                             					</div>                             					<div class="itemInfo">						{if $list[list].firmName}						<div class='tablePropList'>							<div class='label'>								Застройщик							</div>							<div class='value'>								<a href='/list/firm/{$list[list].firmId}'>{$list[list].firmName}</a>							</div>						</div>						{/if}						{if $list[list].podrId}						<div class='tablePropList'>							<div class='label'>								Подрядчик							</div>							<div class='value'>								<a href='/list/firm/{$list[list].podrId}'>{$list[list].podrName}</a>							</div>						</div>						{/if}						<div class='tablePropList'>							<div class='label'>								Адрес							</div>							<div class='value'>								<a target="_blank" 									onclick="showMiniMap('{$list[list].type}', '{$list[list].id}');  return false;" 									title="{$list[list].name} схема проезда" 									href="/map/construction/{$list[list].id}" 									class="fbScheme activeLink" >{$list[list].location}</a>							</div>						</div>						<div class='tablePropList'>							<div class='label'>								Район							</div>							<div class='value'>								{$list[list].district}							</div>						</div>						<div class='tablePropList'>							<div class='label'>								Состояние стройки							</div>							<div class='value state_{$list[list].stateId}'>								{$list[list].state}							</div>						</div>						<div class='tablePropList'>							<div class='label'>								Последнее фото:							</div>							<div class='value'>								 {$list[list].fotoLastDate}							</div>						</div>										 </div>                                										</div>                    			</div> 	{/section}						<div class='emptyH50'></div>{if $sort.pagerFullCnt > 1}   							<ul class="news_list">					<li class='sortValue'>		{if $sort.prewPage}						<a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_{$sort.curNumOnPage}~{$sort.prewPage}"title="назад" ><<</a>		{else}						<<		{/if}					</li>					<li class='sortValue'>&nbsp;</li>		{section name=pager loop=$sort.pagerFullCnt} 			{if $smarty.section.pager.iteration == $sort.curPage}					<li class='sortValue sortSelected'>{$smarty.section.pager.iteration}</li>			{else}					<li class='sortValue'>						<a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_{$sort.curNumOnPage}~{$smarty.section.pager.iteration}" title="перейти на страницу {$smarty.section.pager.iteration}" alt="">{$smarty.section.pager.iteration}</a>					</li>			{/if}		{/section}					<li class='sortValue'>&nbsp;</li>					<li class='sortValue'>		{if $sort.nextPage}						<a href="{$startUrl}{$sort.paramStr}{$sort.curDir}/limit_{$sort.curNumOnPage}~{$sort.nextPage}"title="вперёд" >>></a>		{else}						>>		{/if}					</li>				</ul>{/if}						</div>			<div id='empty'></div>			</div>