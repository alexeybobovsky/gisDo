<TD width="100%" valign=top>
<table border="0" align="left" cellpadding="1" cellspacing="10"  width = '500'  {*style='padding-left:10px;'*}>
	<TBODY>
	<tr>
		<td align='left' colspan='10' width = '100%'>
		<H1 class='{$MESS->style}'>{$MESS->Header}</H1>
		<DIV id='result' class='{$MESS->style}' >
		{$MESS->Body}
		{*if $MESS->Header=='Error 404'}
		Страница, на которую Вы пытаетесь попасть не существует. Уточните адрес в строке 
		{else}
		
		{$MESS->Body}
		{/if*}
		{*if $MESS->Link}<a href='http://{$MESS->Link}'>вернуться</a>{/if*}
		</DIV>
		</td>
	</tr>
	</TBODY>
</table>