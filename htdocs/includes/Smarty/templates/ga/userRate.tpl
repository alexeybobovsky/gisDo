{if $firmRate.total}
<table width="100%" border="0" cellpadding="0" >
	  <tr>
		<td height='100%' width='100%' valign='top'>
<fieldset>
<legend>Оценка фирмы</legend> 				
<table width='100%'>
<tr>
<td align='center' width = '50%'>
	<span >Число оценок: <font color='red'><strong>{$firmRate.num}</strong></font></span>
	{*if $Admin}
	&nbsp;
	<img src='{$header.body.imgSrc}open_new_window.gif'
	 onClick = 'showRank({$Rank.src});'>
	{/if*}
</td>
<td align='center' width = '50%'>
<div id='BodyRNK'>
	<span id='resultRNK'>Средний бал: <font color='red'><strong>{$firmRate.total}</strong></font></span>
	{*if $Admin}
	&nbsp;
	<img src='{$header.body.imgSrc}open_new_window.gif'
	 onClick = 'showRank({$Rank.src});'>
	{/if*}
</td></tr></table>
</fieldset>
			</td>
		</tr>		
	</table>
{/if}