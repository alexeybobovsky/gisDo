{if !$renew}
<SCRIPT src="/includes/jquery/jquery.js" type=text/javascript></SCRIPT>
<script>
var curURL = '{$curURL}';
var curNODE = '{$curNode.product_id}';
{literal}
function itemOrder(prodId, propId, dir)
	{
	var action = curURL + 'set/orderProp2Item';
	var actionRenew = curURL + 'productPropListRenewUsed';
	var contaner = document.getElementById('usedList');
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	$.post(action, {node:curNODE, propId:propId, dir:dir, prodId:prodId}, function(str) 
		{
		if(str == 0)
			{
			$.post(actionRenew, {node:curNODE}, function(str1) 
				{
				contaner.innerHTML = str1;
				$(contaner).animate( { opacity: 1.0 }, 500 );
				});
			}
		else
			{
			alert(str);			
			}				
		});			
	}
function confirmLink(confirmMsg)
	{
	var is_confirmed = confirm(confirmMsg);
	return is_confirmed;
	}
function deleteProp2Item(propId, prodId)
	{
	var contaner = document.getElementById('content');
	var action = curURL + 'set/deleteProp2Item';
	var actionRenew = curURL + 'productPropListRenewAll';
//	alert(action);
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	$.post(action, {node:curNODE, propId:propId, prodId:prodId}, function(str) 
		{
		if(str == 0)
			{
			$.post(actionRenew, {node:curNODE}, function(str1) 
				{
//				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				$(contaner).animate( { opacity: 1.0 }, 500 );
//				$(contaner).fadeIn("fast", function(){});					
				});
			}
		else
			{
			alert(str);			
			}				
		});			
	}
function addProp2Item(propId, prodId)
	{
	var contaner = document.getElementById('content');
	var action = curURL + 'set/addProp2Item';
	var actionRenew = curURL + 'productPropListRenewAll';
//	alert(action);
	$(contaner).animate( { opacity: 0.2 }, 10 , function() { } );
	$.post(action, {node:curNODE, propId:propId, prodId:prodId}, function(str) 
		{
		if(str == 0)
			{
			$.post(actionRenew, {node:curNODE}, function(str1) 
				{
//				$(contaner).fadeOut("fast");
				contaner.innerHTML = str1;
				$(contaner).animate( { opacity: 1.0 }, 500 );
//				$(contaner).fadeIn("fast", function(){});					
				});
			}
		else
			{
			alert(str);			
			}				
		});			
	}
</script>
{/literal}
<div id='content'>
{/if}
{if !$renewUsed}
<fieldset>
<legend>Назначенные на элемент {$curNode.product_name} ({$curNode.product_id})</legend>				
	<DIV  id='usedList' style="HEIGHT: 200px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 95%">
{/if}	
	{if $propList}
		<table id='tableUsed' width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>
		  <THEAD>
			<tr>
				<th>
				Свойство

				<th>
				Унаследован от
				</th>
			</tr>
		</THEAD>
		{section name=rows loop=$propList}	
			<tr>
				<td align='left' id='name_{$propList[rows].pp_id}'>
						{if $propList[rows].pp_type != 'group'}				
						<img src='/src/design/admin/properties.gif' title='Свойство'>
						{else}
						<img src='/src/design/admin/propertiesGrp.gif' title='Группа свойств'>
						{/if}
					{$propList[rows].pp_name}
						<span  id=propId_{$propList[rows].product_id} style='color:#aaaaaa;' >&nbsp;({$propList[rows].pp_id})</span>				
				{if !$smarty.section.rows.first}
				<span  id=propUp_{$propList[rows].product_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
						onClick='itemOrder({$propList[rows].product_id}, {$propList[rows].pp_id}, 1);'  title='Поднять'>
					&#8593;
				</span>{else}&nbsp;
				{/if}
				{if !$smarty.section.rows.last}								
				<span  id=propDown_{$propList[rows].product_id} style='color:#6495ED;' onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
						onClick='itemOrder({$propList[rows].product_id}, {$propList[rows].pp_id}, 2);'  title='Опустить'>
					&#8595;
				</span>{else}&nbsp;
				{/if}				
				</td>

				<td align='left' id='inherit_{$propList[rows].pp_id}'>
					{if $curNode.product_id != $propList[rows].product_id}
						{$propList[rows].product_name} 
						<span  id=itemId_{$propList[rows].product_id} style='color:#aaaaaa;' >&nbsp;({$propList[rows].product_id})</span>
					{else}
						<img src='/src/design/tree/drop.gif' title = 'Удалить' border='0' onClick='if (confirmLink("Вы действительно желаете удалить свойство?")) deleteProp2Item({$propList[rows].pp_id}, {$curNode.product_id})' onMouseMove='this.style.cursor="pointer"; this.style.cursor="hand"; return false;'>									
					{/if}
				</td>
			</tr>
		{/section}
		</table>
	{else}
	Ни одно свойство не назначено
	{/if}
{if !$renewUsed}	
	</div>
</fieldset>
{assign var="SMRT_count" value=$users.list}
<fieldset>
	<legend>Не назначенные</legend>				
	<DIV id='unusedList' style="HEIGHT: 200px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 95%">	
	{if $propListUnused}
		<table id=tableUnused width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>		
		{section name=unused loop=$propListUnused}	
			<tr>
				<td align='left' > <nobr>
					{if $propListUnused[unused].pp_type != 'group'}				
					<img src='/src/design/admin/properties.gif' title='Свойство'>
					{else}
					<img src='/src/design/admin/propertiesGrp.gif' title='Группа свойств'>
					{/if}
				{$propListUnused[unused].pp_name} <span  id=propUnusedId_{$propListUnused[unused].pp_id} style='color:#aaaaaa;' >&nbsp;({$propListUnused[unused].pp_id})</span>
				</td>
				<td align='left' >
				<img src='/src/design/tree/plus.gif' title='Добавить свойство'
						onMouseMove='this.style.cursor="hand"; this.style.cursor="pointer"; return false;'
						onClick='addProp2Item({$propListUnused[unused].pp_id}, {$curNode.product_id}); '>
				 
				</td>
			</tr>
		{/section}
		</table>
	{else}
	Ни осталось неназначенных свойств	
	{/if}
	</div>									
</fieldset>
{/if}
{if !$renew}
</div>
{/if}