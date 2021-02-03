  <script type="text/javascript">
{literal}
	var imgCmpAdd 	= new Image(); 
	var imgCmpMove 	= new Image(); 
{/literal}
</script>
<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<link 	rel="stylesheet" type="text/css" href="/src/design/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" />

<script src="http://api-maps.yandex.ru/2.0/?load=package.standard,&mode=release&lang=ru-RU" type="text/javascript"></script>
<script src="/includes/JS/fs/mapYMmini.js" type="text/javascript"></script>
<script src="/includes/JS/fs/userApartment.js" type="text/javascript"></script>
<script src="/includes/jquery/jquery.tinysort.min.js" type="text/javascript"></script>

<script type="text/javascript" src="/includes/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/includes/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script>

					<div id="titleBar">
						<div id="titleContent">
							<div id="sting">
								<nobr><h1 title='{$titleAp.t2}' >{$titleAp.t2}</h1></nobr>
								<div id='titleBlur' title='{$titleExt}'></div>
							</div>
						</div>
					</div>
				<div id="pageContent">	
				{if $navi}	
					<div id="navigation">
						<ul class="navigation">
							{section name=nav loop=$navi} 
							{if $navi[nav].src}
							<li><a href="{$navi[nav].src}" title="{$navi[nav].title}" >{$navi[nav].caption}</a></li>
							{elseif $navi[nav].actionLink}
							<li><p  class="activeLink" id = 'newsCatSelect'   title="{$navi[nav].title}" onClick="UI.togglePanel(this, 'keywordPanel', 0, '')" >{$navi[nav].caption}</p></li>
							{else}
							<li><p  title="{$navi[nav].title}" >{$navi[nav].caption}</p></li>
							{/if}
							{if $navi[$smarty.section.nav.index_next].caption}
							<li><p>/</p></li>
							{/if}
							{/section}
						</ul>
					</div>  
				{/if}						
{*							<div id="listContaner">	*}
						{*if $client.isMng*}
{if $client.isMng}			
			<INPUT  name='apeUrl' id='apeUrl' type='hidden' value='{$client.mngAct.ape}'>					
{/if}
  <script type="text/javascript">
{literal}
	$(document).ready(function(){	
/*	imgCmpAdd.src = "/src/design/main/cmpAdd.png";
	imgCmpMove.src = "/src/design/main/cmpMove.png";
	
	apListStriped();
	$('[id ^= sortHdr]').bind("click", 	function() 	{testSort(this)}); 	
	$('.listApItem').bind("mouseover", 		function() 		{toggleCmpIcon(1, this)}); 	
	$('.listApItem').bind("mouseleave", function() 			{toggleCmpIcon(0, this)}); 	*/
	apSelectMoreLink();	
	$('#moreResults .selector').bind("click", function(){apSelectMoreLink(this)}); 	
	$('.imgLink').fancybox({
					wrapCSS    : 'fancybox-custom',
					closeClick : true,
					openEffect : 'none',

					helpers : {
						title : {
							type : 'inside'
						},
						overlay : {
							css : {
								'background' : 'rgba(238,238,238,0.85)'
							}
						},
						thumbs : {
							width: 50,
							height: 50
						}
					},
					afterLoad: function() 
						{
						$('.fancybox-skin').bind("mouseover", function() {$('.fancybox-close').css({'top' : '-4px', 'right' : '-4px'})}); 
						UI.fancyboxActive = true;
						},
					beforeClose: function() 
						{
	//					alert(UI.fancyboxActive);
						},			
					afterClose: function() 
						{
						UI.fancyboxActive = false;
						}			
					});
	resize();
	});
{/literal}
</script>
			{if $obj.ap_sold}
			<div id='apSolded' class='borderAlarm'>
					Квартира продана или снята с продажи {$obj.modifyDate}.
			</div>
			{/if}
			<div id='tablePropContaner'>
				<div class='tableProp'>
					<div class='label'>
						<h2>Район</h2>
					</div>
					<div class='value'>
						{$obj.district}
					</div>
				</div>
				<div class='tableProp'>
					<div class='label'>
						<h2>Расположение</h2>
					</div>
					<div class='value'>
						<a class=''  href='/list/construction/{$obj.obj_id}' 
								title='{$obj.obj_name}' 
								target="_blank">					
							{$obj.obj_name}
							</a>
					</div>
				</div>						
				{if $obj.ap_blockSection}												
				<div class='tableProp'>
					<div class='label'>
						<h2>Блок-секция</h2>
					</div>
					<div class='value'>
						{$obj.ap_blockSection}
					</div>
				</div>			
				{/if}
				<div class='tableProp'>
					<div class='label'>
						<h2>Адрес</h2>
					</div>
					<div class='value'>
						<a class='fbScheme activeLink'  href='/map/construction/{$obj.id}' 
								title='{$obj.obj_name} схема проезда' 
								onClick = 'showMiniMap("construction", "{$obj.obj_id}");  return false;'
								target="_blank">					
							{$obj.obj_adrString}
							</a>
					</div>
				</div>						
				<div class='tableProp'>
					<div class='label'>
						<h2>Состояние строительства</h2>
					</div>
					<div class='value state_{$obj.obj_state}'>
						{$obj.state}
					</div>
				</div>				
				{if $obj.obj_dateEnd}												
				<div class='tableProp'>
					<div class='label'>
						<h2>Окончание строительства</h2>
					</div>
					<div class='value'>
						{$obj.obj_dateEnd}
					</div>
				</div>			
				{/if}
				{if $obj.ap_roomNum}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Количество комнат</h2>
					</div>
					<div class='value state_{$obj.stateId}'>
						{$obj.ap_roomNum} 
					</div>
				</div>				
				{/if}								
				{if $obj.ap_area}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Площадь</h2>
					</div>
					<div class='value state_{$obj.stateId}'>
						{$obj.ap_area} м<sup>2</sup>
					</div>
				</div>				
				{/if}								
				{if $obj.ap_floor}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Этаж</h2>
					</div>
					<div class='value state_{$obj.stateId}'>
						{$obj.ap_floor}
					</div>
				</div>				
				{/if}								
				{if $obj.finish}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Отделка</h2>
					</div>
					<div class='value state_{$obj.stateId}'>
						{$obj.finish}
					</div>
				</div>				
				{/if}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Цена</h2>
					</div>
					<div class='value state_{$obj.stateId}'>
						{if $obj.ap_price}{$obj.ap_price} тыс. рублей{else}договорная{/if}
					</div>
				</div>				
				{if $obj.firm_name}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Продавец</h2>
					</div>
					<div class='value'>
						<a href='/list/firm/{$obj.firmId}'>{$obj.firm_name}</a>
					</div>
				</div>
				{/if}
				{if $obj.obj_sales}								
				<div class='tableProp'>
					<div class='label'>
						<h2>Контакт</h2>
					</div>
					<div class='value'>
						{$obj.obj_sales}
					</div>
				</div>
				{/if}
				<div class='tableProp'>
					<div class='label'>
						Количество просмотров
					</div>
					<div class='value'>
						{if $obj.ap_viewCnt}{$obj.ap_viewCnt}{else}первый просмотр{/if}
					</div>
				</div>
				{if !$obj.ap_sold}
				<div class='tableProp'>
					<div class='label'>
						<h2>Последнее изменение</h2>
					</div>
					<div class='value'>
						{$obj.modifyDate}
					</div>
				</div>
				{/if}
			</div>
			<div id='fotoBig'>				
			<h2>Планировки и фото</h2>

	{if $obj.img}
		{section name=img loop=$obj.img}
			{if $smarty.section.img.first}
				<div class='renderPad'>
					<a  class='renderFull' onClick='showRender("apartment");  return false;' href='{$obj.img[img].src|replace:"size":"1024"}' 
							{if $obj.img[img].type ==1 }
							 title='План {$titleAp.t3}' 
							{else}
							 title='Фото {$titleAp.t3} ' 
							{/if}
							 target="_blank">
						<img id='renderFull' {if $obj.img[img].type ==1 }
							 title='План {$titleAp.t3}' 
							{else}
							 title='Фото {$titleAp.t3} ' 
							{/if} class= 'prew' src='{$obj.img[img].src|replace:"size":"640"}'>
					</a>
				</div>
			{/if}
			{if $smarty.section.img.first && $smarty.section.img.last}
			{else}
					<a  class='renderIco'  onClick='previewRenderAp(this);  return false;' 
							href='{$obj.img[img].src|replace:"size":"1024"}' 
							{if $obj.img[img].type ==1 }
							 title='План {$titleAp.t3}'  alt='План {$titleAp.t3}' 
							{elseif $obj.img[img].type ==2 }
							 title='Фото {$titleAp.t3}'  alt='Фото {$titleAp.t3}' 
							{else}
							 title='Фото дома {$titleAp.t3}' alt='Фото дома {$titleAp.t3}' 
							{/if}
							target="_blank">
						<img class='icon  {if $smarty.section.img.first}iconSelected{/if}' src='{$obj.img[img].src|replace:"size":"60"}'>					
					</a>
			{/if}
		{/section}
				<img id='load' src='/src/design/main/_.gif'>					
	{/if}
			</div>
			<div id='apSinglePrice'  title='стоимость квартиры'>
				{if $obj.ap_priceShow}{$obj.ap_priceShow}<span class=rur>i</span>{else}договорная{/if}
			</div>
		{*if $obj.ap_info*}
				<h2>Описание квартиры</h2>
				<div id="infoTextHolder">	
					<div id="prew">					
					<p>{$obj.autoInfo}</p>
					<p>{$obj.ap_info}</p>
					</div>				
				</div>
		{*/if*}
		<DIV  class='lawLinkOffert'>
		<sup>*</sup>Актуальность информации следует уточнять у продавца квартиры.	
		</br>
		<sup>**</sup>Предложения квартир на данном сайте не являются публичной офертой и носят исключительно информационный характер.	
		</div>
		{if $client.isMng}
		<div id='manageHolder'>
		<span class="mngAct" id="apc"  onClick="showEdtBox('{$client.mngAct.ape}{$obj.ap_id}', 0)"><nobr>изменить</nobr></span>
		<span class="mngAct" id="oe"  onClick="soldApFast('{$client.mngAct.aps}', '{$obj.ap_id}', '{$obj.ap_sold}')"><nobr>{if $obj.ap_sold}вернуть в продажу{else}снять с продажи{/if}</nobr></span>
		<span class="mngAct" id="od"  onClick="showEdtBox('{$client.mngAct.apc}', 0)"><nobr>добавить квартиры</nobr></span>
		</div>
		{/if}
	<div id='moreResults'>	
	<h2 title='Продажа квартир в {$title}'>Похожие квартиры</h2>						
		<span id='moreRes_1' class='selector activeLink' {if !$more[0]}style='display:none'{/if}>в этом доме</span>
		<span id='moreRes_2' class='selector activeLink' {if !$more[1]}style='display:none'{/if}>рядом</span>
		<span id='moreRes_3' class='selector activeLink' {if !$obj.ap_price || !$more[2]}style='display:none'{/if}>за ту же цену</span>
	</div>
	<div id='moreResultsContaner'>	
	{section name=apm loop=$more}
		<div id='moreResCont_{$smarty.section.apm.iteration}'>	
		{if $more[apm]!=0}
		{section name=more loop=$more[apm]}
			<div class='moreResItem'>	
				<div class='moreItemLeft'>	
					<div class='itemTitle'><a href='{$more[apm][more].link}'>{$more[apm][more].title}</a></div>
					<div class='itemImgContaner'>
						{section name=img loop=$more[apm][more].img}
							<img class='moreIcon' src='{$more[apm][more].img[img]|replace:"size":"60"}'>
						{/section}
					</div>
					<div class='itemBuilding'  title='расположение'><a href='{$more[apm][more].objLink}'>{$more[apm][more].objName}</a></div>					
				</div>
				<div class='moreItemRight'>					
					<div class='itemPrice'>{if $more[apm][more].price}  {$more[apm][more].price}  <span class=rur>i</span>{else}договорная{/if}</div>
{*					<div class='itemCompare activeLink'>в сравнение</div>*}
					<div class='itemSeller' title='продавец'><a href='{$more[apm][more].firmLink}'>{$more[apm][more].firmName}</a></div>
				</div>
			</div>			
		{/section}		
		{else}
			<INPUT  name='apMoreSkip_{$smarty.section.apm.iteration}' id='apMoreSkip_{$smarty.section.apm.iteration}' type='hidden' value='1'>							
		{/if}
		</div>
	{/section}
{*		<div id='moreResCont_1'>	
		{section name=more loop=$more.sameBuilding}
			<div class='moreResItem'>	
				<div class='moreItemLeft'>	
					<div class='itemTitle'><a href='{$more.sameBuilding[more].link}'>{$more.sameBuilding[more].title}</a></div>
					<div class='itemImgContaner'>
						{section name=img loop=$more.sameBuilding[more].img}
							<img class='moreIcon' src='{$more.sameBuilding[more].img[img]|replace:"size":"60"}'>
						{/section}
					</div>
					<div class='itemBuilding'  title='расположение'><a href='{$more.sameBuilding[more].objLink}'>{$more.sameBuilding[more].objName}</a></div>					
				</div>
				<div class='moreItemRight'>					
					<div class='itemPrice'>{if $more.sameBuilding[more].price}  {$more.sameBuilding[more].price}  <span class=rur>i</span>{else}договорная{/if}</div>
					<div class='itemSeller' title='продавец'><a href='{$more.sameBuilding[more].firmLink}'>{$more.sameBuilding[more].firmName}</a></div>
				</div>
			</div>			
		{/section}		
		</div>*}
	</div>
					
					<div id='empty'></div>		
			</div>	
