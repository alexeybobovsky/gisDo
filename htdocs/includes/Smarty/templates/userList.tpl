
<table id={$SMRT_cnt.table.body_id} width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>
  <THEAD>
	<tr>
{section name=headers loop=$SMRT_cnt.table.table_colHeader}			
		<th >
			{$SMRT_cnt.table.table_colHeader[headers]}
		</th>
{/section}
		<th colspan='10'>
			операции
		</th>
	</tr>
</THEAD>
{section name=users loop=$SMRT_cnt.content}	
	<tr>
	{section name=cols loop=$SMRT_cnt.table_cols}								
	{assign var="SMRT_INDX" value=$smarty.section.cols.index}
	{assign var="SMRT_col" value=$SMRT_cnt.table_cols[cols]}						
		<td {if $SMRT_cnt.table.table_colStyle[cols] &&  !$SMRT_cnt.content[users].is_system} class='{$SMRT_cnt.table.table_colStyle[cols]}'{/if} 
			align='left' id='{$SMRT_cnt.table_cols[cols]}#{$SMRT_cnt.content[users].user_id}'>
			{if $SMRT_INDX}
				{if $SMRT_col=='user_time_last_update'}
					{$SMRT_cnt.content[users].$SMRT_col|date_format:"%a, %d %b %y"}  				
				{elseif  $SMRT_col=='membership' &&  !$SMRT_cnt.content[users].is_system} 			
					{*<a href="/admin/membership/{$SMRT_cnt.content[users].user_id}" title="Членство в группах" class="greybox"  width='500' height='300'>Изменить</a>*}
					<div title="Членство в группах" onMouseMove='this.style.cursor="hand"; return false;' onClick="open_window('/admin/users/membership/{$SMRT_cnt.content[users].user_id}', 'console', 500, 300, 0);"> Изменить</div>
				{elseif  $SMRT_col=='memebers' &&  !$SMRT_cnt.content[users].is_system}	
					{*<a href="/admin/members/{$SMRT_cnt.content[users].user_id}" title="Члены группы" class="greybox"  width='500' height='300'>Изменить</a>*}
					<div title="Члены группы" onMouseMove='this.style.cursor="hand"; return false;' onClick="open_window('/admin/users/members/{$SMRT_cnt.content[users].user_id}', 'console', 500, 300, 0);"> Изменить</div>
				{elseif !$SMRT_cnt.content[users].$SMRT_col}
					&nbsp;
				{else}
					{$SMRT_cnt.content[users].$SMRT_col}
				{/if}
			{else}
				{$smarty.section.users.iteration}
			{/if}
		</td>
	{/section}
	<td align='center'>
		{if $SMRT_cnt.content[users].user_password}
{*		<a href="/admin/userProperties/{$SMRT_cnt.content[users].user_id}" title="Cвойства пользователя" class="greybox"  width='500' height='300'>*}
		<img src='/src/design/admin/edit.gif' title = 'Дополнительные свойства' border='0' onMouseMove='this.style.cursor="hand"; return false;' onClick="open_window('/admin/users/userProperties/{$SMRT_cnt.content[users].user_id}', 'console', 500, 300, 0);" >
		{*</a>*}
	</td>
	<td>
		{/if}		
		{if !$SMRT_cnt.content[users].is_system}
			<img src='/src/design/tree/drop.gif' title = 'Удалить' border='0' onClick='if (confirmLink("Вы действительно желаете удалить объект?")) formSubmit("RMUSER", {$SMRT_cnt.content[users].user_id})' onMouseMove='this.style.cursor="hand"; return false;'>				
		{else}	
			&nbsp;
		{/if}
	</td>
	</tr>
{/section}
</table>
			