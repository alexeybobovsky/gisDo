<table id=UserList width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>
  <THEAD>
	<tr>
		<th valign='middle' width="10%">
			 атегори€
		</th>
		<th  valign='middle' colspan = '10'>
			им€
		</th>
	</tr>
</THEAD>							
{section name=users loop=$SMRT_cnt}	
	<tr>
		<td> 
			{if $SMRT_cnt[users].user_type == 'users'}
			<img src='/src/design/admin/user.gif'> пользователь
			{else}
			<img src='/src/design/admin/groups.gif'> группа
			{/if}		
		<td> 
		{$SMRT_cnt[users].user_name} &nbsp;
		</td>
		<td>
		<img src='/src/design/admin/keys.gif' title='установить права на чтение (по умолчанию)'
				onMouseMove='this.style.cursor="hand"; return false;'
				onClick='addRight({$SMRT_node}, {$SMRT_cnt[users].user_id}); '>
		 
		</td>
	</tr>
{/section}
</table>
