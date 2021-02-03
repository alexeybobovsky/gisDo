<div id='content'>
{assign var="SMRT_cnt" value=$rights}
{assign var="SMRT_node" value=$users.node}
<fieldset>
<legend>{$rights.table.table_label}</legend>				
	<DIV  id='rightList' style="HEIGHT: 200px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 95%">
	{assign var="SMRT_cnt" value=$rights}
	<table id={$SMRT_cnt.table.body_id} width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>
	  <THEAD>
		<tr>
	{section name=headers loop=$SMRT_cnt.table.table_colHeader}			
			<th >
				{$SMRT_cnt.table.table_colHeader[headers]}
			</th>
	{/section}
		</tr>
	</THEAD>
	{section name=users loop=$SMRT_cnt.rights}	
		<tr>
		{section name=cols loop=$SMRT_cnt.table.table_colAlias}								
		{assign var="SMRT_INDX" value=$smarty.section.cols.index}
		{assign var="SMRT_col" value=$SMRT_cnt.table.table_colAlias[cols]}						
			<td {if $SMRT_cnt.table.table_colStyle[cols]} 
				class='{$SMRT_cnt.table.table_colStyle[cols]}'
				{/if} 
				align='left' id='{$SMRT_col}*{$SMRT_node}_{$SMRT_cnt.rights[users].userId}#{$SMRT_cnt.rights[users].rightId}'>
				{if $SMRT_INDX}
					{if $SMRT_col == 'userName' && $SMRT_cnt.rights[users].userType == 'group'}				
					<img src='/src/design/admin/groups.gif'>
					{elseif  $SMRT_col == 'userName' && $SMRT_cnt.rights[users].userType == 'user'}
					<img src='/src/design/admin/user.gif'>
					{/if}
					{if $SMRT_cnt.rights[users].$SMRT_col}
						{$SMRT_cnt.rights[users].$SMRT_col}
					{else}
						&nbsp;
					{/if}
				{else}
					{$smarty.section.users.iteration}
				{/if}
			</td>
		{/section}
		<td align='center'>
			{if $SMRT_cnt.rights[users].rightId && !$SMRT_cnt.rights[users].inherit}
				<img src='/src/design/tree/drop.gif' title = 'Удалить' border='0' onClick='if (confirmLink("Вы действительно желаете удалить права?")) deleteRight({$SMRT_node}, {$SMRT_cnt.rights[users].rightId})' onMouseMove='this.style.cursor="hand"; return false;'>				
			{else}
				&nbsp;
			{/if}
		</td>
		</tr>
	{/section}
	</table>
	</div>
</fieldset>
{assign var="SMRT_count" value=$users.list}
<fieldset>
	<legend>группы и пользователи</legend>				
	<DIV id='userList' style="HEIGHT: 200px; OVERFLOW: auto; PADDING-LEFT: 5px; WIDTH: 95%">	
		<table id=UserList width="100%" border="0" cellpadding='2' cellSpacing='0' class='din'>
		  <THEAD>
			<tr>
				<th valign='middle' width="10%">
					Категория
				</th>
				<th  valign='middle' colspan = '10' align = 'left'>
					Имя
				</th>
			</tr>
		</THEAD>							
		{section name=users loop=$SMRT_count}	
			<tr>
				<td align='left' width=40% > <nobr>
					{if $SMRT_count[users].user_type == 'users'}
					<img src='/src/design/admin/user.gif'> &nbsp;пользователь
					{else $SMRT_count[users].user_type == 'groups'}
					<img src='/src/design/admin/groups.gif'> &nbsp;группа
					{/if}		</nobr>
				<td align='left' width=40% > 
				{$SMRT_count[users].user_name} &nbsp;
				</td>
				<td>
				<img src='/src/design/admin/keys.gif' title='установить права на чтение (по умолчанию)'
						onMouseMove='this.style.cursor="hand"; return false;'
						onClick='addRight({$SMRT_node}, {$SMRT_count[users].user_id}); '>
				 
				</td>
			</tr>
		{/section}
		</table>
	</div>									
</fieldset>
</div>
{if $showCheckbox}
<DIV >	
	<table width="100%" border="0" cellpadding='2' cellSpacing='5' >
		<tr>
			<td align=left valign='middle' >
				<input type=checkbox name=showUsers id=IDshowUsers {if $checkboxValue} checked {/if} onClick='showUsers()' onChange='showUsers()'>
			</td>
			<td  valign='middle' align = 'left' width="100%">
				показывать пользователей
			</tв>
		</tr>
	</table>							
</div>
{/if}