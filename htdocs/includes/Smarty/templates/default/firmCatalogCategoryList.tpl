<hr color="#999999" size="1" />
<!-- тематический банер в данном разделе -->
<br />
<!-- Начало каталога -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
   <tr>
<td valign="top" width="300">
{section  name=lst loop=$leftMenu}
	{if $leftMenu[lst].type == 'products' || $leftMenu[lst].type == 'markets'}
		{section  name=lstDet loop=$leftMenu[lst].list}
		{if $leftMenu[lst].list[lstDet].lvl == 0}
		<div class="info">
			<b>{$leftMenu[lst].list[lstDet].name}</b>
		</div>	
		{else}
			{if $leftMenu[lst].list[$smarty.section.lstDet.index_prev].lvl == 0}
			<div class="firmcard">
				<div class="info">
			{/if}
			<a class="{if $leftMenu[lst].list[lstDet].link == $menuTopLvlUse.activeSub}leftMenuActive{/if}" href="{$leftMenu[lst].list[lstDet].link}">{$leftMenu[lst].list[lstDet].name}</a><br>
			{if $smarty.section.lstDet.last}
				</div>
			</div>
			{/if}	
		{/if}
		{/section}
	{else}
		<div class="info">
			<b>Категории компаний</b>
		</div>
		<div class="firmcard">
		{section  name=lstDet loop=$leftMenu[lst].list}
			{if $leftMenu[lst].list[$smarty.section.lstDet.index_prev].lvl && $leftMenu[lst].list[lstDet].lvl < $leftMenu[lst].list[$smarty.section.lstDet.index_prev].lvl}
				</div>
			{/if}
			{if $leftMenu[lst].list[lstDet].link && $leftMenu[lst].list[lstDet].lvl>1}
				<a class="{if $leftMenu[lst].list[lstDet].link == $menuTopLvlUse.activeSub}leftMenuActive{/if}" href='{$leftMenu[lst].list[lstDet].link}' title='{$leftMenu[lst].list[lstDet].name}'>{elseif $leftMenu[lst].list[lstDet].lvl==1}<h3>{/if}{*<nobr>*}{$leftMenu[lst].list[lstDet].name}{*</nobr>*}{if $leftMenu[lst].list[lstDet].link && $leftMenu[lst].list[lstDet].lvl>1}</a><br />{elseif $leftMenu[lst].list[lstDet].lvl==1}</h3>{else}<br />{/if}	
			{if $leftMenu[lst].list[$smarty.section.lstDet.index_next].lvl && $leftMenu[lst].list[lstDet].lvl < $leftMenu[lst].list[$smarty.section.lstDet.index_next].lvl}
			<div  class="info">{/if}
			{if $smarty.section.lstDet.last}
			</div>{/if}
		{/section}
		</div>	
	{/if}
{/section}
</td>