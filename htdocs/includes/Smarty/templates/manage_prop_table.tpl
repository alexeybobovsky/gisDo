	<table width='100%'  height='100%' border='0' cellpadding='0'  class = 'din'>
	<tr>
				<th colspan ='10' align='center'>&nbsp;
				  Основные свойства
				</th>
	</tr>
	{section name=body loop=$content.mainProp}
	<tr>
		<td width = '30%'>&nbsp;
		  {$content.mainProp[body].label}
		</td>
		<td   class='{$content.mainProp[body].JQClass}'   id='{$content.mainProp[body].idTag}'> 
		{*if $content.mainProp[body].value*}
		  {$content.mainProp[body].value}
			</td>
	</tr>	
	{/section}
	<tr>
		<td  colspan ='10' class='list_th_big'>
			<table> 
				<tr>
				<th width='100%' align='center'  >&nbsp;
				{if $content.addProp.num}
					Дополнительные свойства
				{else}
					<font color="red">Дополнительные свойства не определены</font>
				{/if}
				</th>
				<th>
				<img src='/src/design/tree/plus.gif' title = 'Добавить свойство' border='0' 
				onMouseMove='this.style.cursor="hand"; return false;'
				onClick='addNewNodePar({$content.addProp.nodeid})'>
				</th>
				</tr>
			</table>
		</td>
	</tr>
	{section name=body loop=$content.addProp.num}
			<tr>
				<td width = '30%' >&nbsp;
				  {$content.addProp[body].label}
				</td>
				<td> 
				<table> 
					<tr>
					<td width='100%'>&nbsp;
					{if $content.addProp[body].type == 'text'}
						<font color ='blue'>
					{else}
						<font color ='brown'>
					{/if}
					{if $content.addProp[body].value}
						{$content.addProp[body].value|truncate:40:"...":true}
					{else}
						&nbsp;
					{/if}
						</font>
					</td>					
					<td>
						<img src='/src/design/tree/edit.gif' title = 'Редактировать' border='0' 
						onMouseMove='this.style.cursor="hand"; return false;' 
						onClick='editCaption({$content.addProp[body].id})' >
					</td>
					<td>
						<img src='/src/design/tree/drop.gif' title = 'Удалить' border='0' onClick='confirmLink("Вы действительно желаете удалить свойство?"); 
						deleteCaption({$content.addProp[body].id})'
						 onMouseMove='this.style.cursor="hand"; return false;'>
					</td>
					</tr>
				</table>
				</td>
			</tr>
	{/section}	
	</table>	
