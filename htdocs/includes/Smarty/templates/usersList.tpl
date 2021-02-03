{if $orders.noOrder || !$orders.content}
<p>
Записей, соответсвующих Вашему запросу, не найдено. Измените критерии поиска.
</p>
{else}
      <TABLE cellSpacing=0 cellPadding=1 border=0 id = '{$orders.table.body_id}' class='{*Order1-1*}din' width='98%' >
	  <THEAD>
		<TR>
			{section name=headers loop=$orders.table.table_colHeader}			
					<th align={$orders.table.table_headerAlign[headers]}>
						<nobr>{$orders.table.table_colHeader[headers]}</nobr>
					</th>
			{/section}
		</TR>
	</THEAD>
  <TBODY>
	{section name=cats loop=$orders.content}
	{math equation="index / 2 - 0.1" index = $smarty.section.cats.iteration assign=SMRT_dev_val}
	{math equation="2 * round(dev) " index = $smarty.section.cats.iteration dev = $SMRT_dev_val assign=SMRT_dev_val_round}
	{if  $SMRT_dev_val_round == $smarty.section.cats.iteration}
		{assign var="SMRT_TDSTYLE" value='#f8f8f8'}
	{else}
		{assign var="SMRT_TDSTYLE" value='#ffffff'}
	{/if}
		<tr style='background:{$SMRT_TDSTYLE}'  
			onmouseover="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='#f9f9d9';" 
			onmouseout="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='{$SMRT_TDSTYLE}';"
			id='{$orders.content[cats].id}'
			onClick='itemSelect(this)'
		>
		{section name=cols loop=$orders.table.table_colAlias}								
		{assign var="SMRT_col" value=$orders.table.table_colAlias[cols]}		
		{assign var="SMRT_INDX" value=$smarty.section.cols.index}
		<td align='{$orders.align[cats].$SMRT_col}' >
					<nobr>{$orders.content[cats].$SMRT_col}</nobr>
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
