{if $orders.noOrder || !$orders.content}
      <TABLE cellSpacing=0 cellPadding=1 border=0 id = '{$orders.table.body_id}'  width='100%' >
		<TR> <TD width='100%'align = center >
		Записей, соответсвующих Вашему запросу, не найдено. Измените критерии поиска.
		</TD>
		{if $filter}
		<td>
			<img  id='filterImg' src='{$header.body.cssSrc}admin/filter.gif'  class='hand' title='Показать фильтр' style='filter:alpha(opacity=50)'  
						onClick='showFilter(this);'>
		</td>
		{/if}
		</TR></TABLE> 
		
{else}
      <TABLE cellSpacing=0 cellPadding=1 border=0 id = '{$orders.table.body_id}' class='{*Order1-1*}din' width='100%' >
	  <THEAD>
		<TR>
			{section name=headers loop=$orders.table.table_colHeader}			
					<th align={$orders.table.table_headerAlign[headers]}>						
					{if $smarty.section.headers.last}
					<table cellSpacing=0 cellPadding=0 border=0 >
					<tr>
						<td width='100%' style='BORDER: 0px;'>
							<nobr>{$orders.table.table_colHeader[headers]}</nobr>
						</td>
		{if $filter}
						<td style='BORDER: 0px;'>
						<img  id='filterImg' src='{$header.body.cssSrc}admin/filter.gif'  class='hand' title='Показать фильтр' style='filter:alpha(opacity=50)'  
									onClick='showFilter(this);'>					
						</td>
		{/if}
				</tr>
					</table>
					{else}
						<nobr>{$orders.table.table_colHeader[headers]}</nobr>
					{/if}
					</th>
			{/section}
		</TR>
	</THEAD>
  <TBODY>
	{section name=cats loop=$orders.content}
		<tr style='background:{cycle name="tr" values="#ffffff,#f8f8f8"}'  
			onmouseover="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='#f9f9d9';" 
			onmouseout="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='{cycle name="tr1" values="#ffffff,#f8f8f8"}';"
			id='item_{$orders.content[cats].id}'
			onClick='itemSelect(this)'
		>
		{section name=cols loop=$orders.table.table_colAlias}								
		{assign var="SMRT_col" value=$orders.table.table_colAlias[cols]}		
		{assign var="SMRT_INDX" value=$smarty.section.cols.index}
		<td align='{$orders.align[cats].$SMRT_col}' >
			{if $orders.content[cats].hidden}
			<span class='disabled'>
			{/if}
					<nobr>{$orders.content[cats].$SMRT_col}</nobr>
			{if $orders.content[cats].hidden}
			</span >
			{/if}
		</td>		
		{/section}					
		</tr>

	{/section}
</tbody>
</table>
{/if}
{if $orders.selected} 
<img src='{$header.body.imgSrc}_.gif'  id='fake' width=0 height=0 style="DISPLAY: none" onLoad='itemSelectAuto("{$orders.selected}");'>
{/if} 
