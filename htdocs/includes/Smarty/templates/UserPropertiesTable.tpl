<table width="100%" border="0" cellpadding='2' cellSpacing='1' class='din'>
{*	<tr>
		<th colspan='10'>
			<b>{$content.table.table_label}</b>
		</th>
	</tr>*}
{*if $content.is_system}	
	<tr>
		<th colspan='10'><h2>
			Внимание! это системная учетная запись - она не редактируемая.</h1>
		</th>
	</tr>
{/if*}	
{section name=par loop=$content.table.table_colHeader}			
{assign var="SMRT_col" value=$content.table.table_colAlias[par]}
	<tr>
		<td align='left'>
			<b>{$content.table.table_colHeader[par]}</b>
		</td>
		<td align='left' >
			{if $content.content.$SMRT_col}{$content.content.$SMRT_col}{else}&nbsp;{/if}
		</td>
	</tr>
	{if $smarty.section.par.index_next}
	<tr>
	<th colspan='10'>
	</th>
	</tr>
	{/if}
{/section}
</table>
