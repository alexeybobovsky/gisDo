{if $Form.noList}
<p> 
Не найдено ни одной рассылки.
</p>
{else}
      <TABLE cellSpacing=0 cellPadding=1 border=0 id = '{$Form.table.body_id}' class='Order1-1' width='98%' >
	  <THEAD>
		<TR>
			{section name=headers loop=$Form.table.table_colHeader}			
					<th align={$Form.table.table_headerAlign[headers]}>
						<nobr>{$Form.table.table_colHeader[headers]}</nobr>
					</th>
			{/section}
		</TR>
	</THEAD>
  <TBODY>
	{section name=cats loop=$Form.content}
		<tr style='background:{cycle name="tr" values="#ffffff,#f8f8f8"}'  
			onmouseover="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='#f9f9d9';" 
			onmouseout="if (document.getElementById('IDcurNode').value!=this.id) this.style.background='{cycle  name="js" values="#ffffff,#f8f8f8"}';"
			id='{$Form.content[cats].id}'
			onClick='itemSelect(this)'
		>
		{section name=cols loop=$Form.table.table_colAlias}								
		{assign var="SMRT_col" value=$Form.table.table_colAlias[cols]}		
		{assign var="SMRT_INDX" value=$smarty.section.cols.index}
		<td align='{$Form.align[cats].$SMRT_col}' >
					<nobr>{$Form.content[cats].$SMRT_col}</nobr>
		</td>		
		{/section}					
		</tr>

	{/section}
</tbody>
</table>
{/if}
{if $Form.selected} 
<img src='{$header.body.imgSrc}_.gif'  id='fake' width=0 height=0 style="DISPLAY: none" onLoad='itemSelectAuto("{$Form.selected}");'>
{/if} 
