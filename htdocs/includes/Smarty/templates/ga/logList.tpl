{if !$content.list}
      <TABLE cellSpacing=0 cellPadding=1 border=0 width='100%' >
		<TR> <TD width='100%'align = center >
		Записей  не найдено.
		</TD>
		</TR>
		</TABLE> 		
{else}
	<TABLE cellSpacing=0 cellPadding=1 border=0 id = 'logTable' class='din' width='99%' >
		<THEAD>
			<TR>
			{section name=headers loop=$content.colums}			
					<th align='center'>						
					<nobr>{$content.colums[headers]}</nobr>
					</th>
			{/section}
			</TR>
		</THEAD>
		<TBODY>
		{section name=lst loop=$content.list}			
			<TR>
			{section name=lstcol loop=$content.list[lst]}
			{assign var="SMRT_COL" value=$content.colums[lstcol]}	
					<td align='left' title='{$content.list[lst].$SMRT_COL}'>						
					<nobr>{$content.list[lst].$SMRT_COL|truncate:30:"...":true}</nobr>
					</th>
			{/section}
			</TR>
		{/section}		
		</TBODY>		
	</TABLE>
{/if}		
