<input type="hidden" id="cityId" name="cityId" value='{$client.city.id}'>
<input type="hidden" id="cityName" name="cityName" value='{$client.city.name}'>

	<div id="titleBar">
		<div id='titleContent'>
		<h2>{$title}</h2>
		<div id='filtershow' class='simple' onClick='UI.togglePanel(document.getElementById("titleBar"), "filterPanel", 0, "highlightFilterStarter");'>Фильтр</div>
		</div>
	</div>
	<div id="pageContent">	
		<div id="listContaner">	
			<div id="listHeader0" class = 'listHeader' >	
				<ul class="news_list">
					<li>Сортировать</li>
					<li><a href="/catalog/{$curLayer.layer_name}/{$sort.paramStr}Asc{if $sort.limitStr}/{$sort.curNumOnPage}_1{*$sort.limitStr*}{/if}" title="" {if $sort.curDir == 'Asc'} class="news_list-current" {/if} >по возрастанию</a></li>
					<li>/</li>
					<li><a href="/catalog/{$curLayer.layer_name}/{$sort.paramStr}Desc{if $sort.limitStr}/{$sort.curNumOnPage}_1{*$sort.limitStr*}{/if}"title="" {if $sort.curDir == 'Desc'} class="news_list-current" {/if}>по убыванию</a></li>                 
					<li>&nbsp;</li>
					<li>Результатов на страницу</li>
					<li><a href="/catalog/{$curLayer.layer_name}/{$sort.paramStr}{$sort.curDir}/10_1{*$sort.curPage*}"title=""{if $sort.curNumOnPage == '10'} class="news_list-current" {/if} >10</a></li>                 
					<li>/</li>
					<li><a href="/catalog/{$curLayer.layer_name}/{$sort.paramStr}{$sort.curDir}/50_1{*$sort.curPage*}"title=""{if $sort.curNumOnPage == '50'} class="news_list-current" {/if} >50</a></li>                 
					<li>/</li>
					<li><a href="/catalog/{$curLayer.layer_name}/{$sort.paramStr}{$sort.curDir}/0_1"title="" {if $sort.curNumOnPage == '0'} class="news_list-current" {/if} >Все</a></li>                 
				</ul>								
			</div>
			<div id="listItem1" class = 'listItem' >	
				dslkjslkjfsl kdfjlsdkj flsdjkflskjf
			</div> 
			<div id="listItem2" class = 'listItem' >	
				dslkjslkjfsl kdfjlsdkj flsdjkflskjf			
			</div>
		
		</div>	
	<div id='empty'></div>		
	</div>