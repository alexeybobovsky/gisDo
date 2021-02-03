{include file='emptyHeader.tpl'}
{if $messBox->Type=='Info'}
	{assign var="SMRT_MType" value='notice'}
{elseif $messBox->Type=='Error'}
	{assign var="SMRT_MType" value='error'}
{/if}
<table border="0" align="left" cellpadding="1" cellspacing="10"  width = '100%' >
	<TBODY>
	<tr>
		<td align='left' colspan='10' width = '100%'>
		<H1 class='{$SMRT_MType}'>{$messBox->Header}</H1>
		<DIV id='result' class='{$SMRT_MType}' >
		{$messBox->Body}
		</DIV>
		</td>
	</tr>
	</TBODY>
</table>
{include file='emptyFooter.tpl'}