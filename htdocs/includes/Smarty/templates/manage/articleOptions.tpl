<TABLE cellSpacing=2  width = '95%'  cellPadding=3 border=0>
<TBODY id='{$Properties.table.body_id}'>									
	<TR>
		<td colspan ='10' valign=top width="100%" height = 100%>
			<table align="left" cellpadding="1" cellspacing="0"  width = '100%' height = 100%>
				<tr>
					<td align='center'  colspan='10' width = '100%' height = 100%>
						<div id=optionBody>
						{if $contentHTML}
							{include file='manage/catalogOptions.tpl'}						
						{/if}
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</tbody>
</table>